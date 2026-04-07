<?php

/**
 * Plugin activation handler for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Component_Registry;
use EPB\CSS\Less_Parser;
use EPB\Themes\Child_Theme;

/**
 * Class Activator
 *
 * Handles all activation routines for the plugin.
 * Sets up default options and performs necessary initialization when activated.
 */
class Activator
{
    /**
     * Runs on plugin activation.
     *
     * Sets up default options and performs any necessary initialization
     * when the plugin is activated.
     *
     * @return void
     */
    public static function activate(): void
    {
        // Register custom capabilities for the administrator role.
        Capabilities::register();

        // Set default plugin options if they don't exist.
        if (false === get_option('epb_dynamic_plugins')) {
            add_option('epb_dynamic_plugins', \EPB\Plugins\Options::get_defaults());
        }

        // Recover component values from the child theme when the database
        // options are missing (e.g. after a delete + reinstall).
        self::maybe_recover_settings();

        // Store the plugin version for future upgrade checks.
        update_option('epb_version', EPB_VERSION);

        // Log activation if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Enhanced Plugin Bundle activated. Version: ' . EPB_VERSION);
        }
    }

    /**
     * Check if component settings need recovery and run it if so.
     *
     * Called on activation and also from admin_init (via Upgrader) as a
     * safety net in case the activation hook didn't fire or recovery
     * failed the first time.
     *
     * @return void
     */
    public static function maybe_recover_settings(): void
    {
        // Check if any component options already exist in the database.
        if (self::has_component_options()) {
            return;
        }

        // Check if a child theme directory exists at all.
        $child_dir = WP_CONTENT_DIR . '/themes/' . Child_Theme::THEME_SLUG;
        if (!file_exists($child_dir)) {
            return;
        }

        // Strategy 1: Recover from JSON backup (most reliable).
        if (self::recover_from_json_backup()) {
            return;
        }

        // Strategy 2: Recover from the Less file (fallback for older installs).
        self::recover_from_less_file($child_dir);
    }

    /**
     * Check whether any epb_component_* options exist in the database.
     *
     * @return bool True if at least one component option exists.
     */
    private static function has_component_options(): bool
    {
        global $wpdb;
        $count = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s",
                $wpdb->esc_like(Constants::OPTION_PREFIX) . '%'
            )
        );

        return (int) $count > 0;
    }

    /**
     * Recover component settings from the JSON backup in the child theme.
     *
     * The backup file is written automatically whenever settings change
     * (via Child_Theme::write_settings_backup). It contains the exact
     * data that was in the database, keyed by component name.
     *
     * @return bool True if recovery succeeded, false if no backup found.
     */
    private static function recover_from_json_backup(): bool
    {
        $backup = Child_Theme::read_settings_backup();

        if ($backup === null) {
            return false;
        }

        $restored = 0;
        $components = $backup['components'];

        foreach ($components as $component => $values) {
            $component = sanitize_key($component);

            if (empty($values) || !is_array($values)) {
                continue;
            }

            // Sanitize each value.
            $clean = [];
            foreach ($values as $var_name => $value) {
                $var_name = sanitize_key($var_name);
                if (!empty($var_name) && is_string($value)) {
                    $clean[$var_name] = sanitize_text_field($value);
                }
            }

            if (!empty($clean)) {
                update_option(Constants::OPTION_PREFIX . $component, $clean);
                $restored++;
            }
        }

        if ($restored > 0 && defined('WP_DEBUG') && WP_DEBUG) {
            error_log("[EPB] Recovered {$restored} component(s) from settings backup JSON.");
        }

        return $restored > 0;
    }

    /**
     * Recover component settings by parsing the child theme's Less file.
     *
     * Fallback for child themes generated before the JSON backup was
     * introduced. Parses variable overrides from theme.ct-style.less
     * and maps them back to their source components.
     *
     * @param string $child_dir Path to the child theme directory.
     * @return bool True if recovery succeeded.
     */
    private static function recover_from_less_file(string $child_dir): bool
    {
        $less_file = $child_dir . '/less/theme.' . Child_Theme::LESS_STYLE_NAME . '.less';

        if (!file_exists($less_file)) {
            return false;
        }

        $content = file_get_contents($less_file);

        if ($content === false || empty($content)) {
            return false;
        }

        $overrides = self::parse_less_overrides($content);

        if (empty($overrides)) {
            return false;
        }

        // Build a map from variable name → component.
        $var_to_component = self::build_variable_component_map();

        if (empty($var_to_component)) {
            return false;
        }

        // Group overrides by component.
        $component_values = [];
        foreach ($overrides as $var_name => $value) {
            $component = $var_to_component[$var_name] ?? null;

            if ($component === null) {
                continue;
            }

            if (!isset($component_values[$component])) {
                $component_values[$component] = [];
            }

            $component_values[$component][$var_name] = $value;
        }

        // Save each component's values, filtering out unchanged defaults.
        $restored = 0;
        foreach ($component_values as $component => $values) {
            $defaults = Less_Parser::parse_component($component);
            $modified = [];

            foreach ($values as $var_name => $value) {
                $default_value = $defaults[$var_name]['value'] ?? null;

                if ($default_value === null || $value !== $default_value) {
                    $modified[$var_name] = $value;
                }
            }

            if (!empty($modified)) {
                update_option(Constants::OPTION_PREFIX . $component, $modified);
                $restored++;
            }
        }

        if ($restored > 0 && defined('WP_DEBUG') && WP_DEBUG) {
            error_log("[EPB] Recovered {$restored} component(s) from child theme Less file.");
        }

        return $restored > 0;
    }

    /**
     * Parse Less variable override declarations from file content.
     *
     * @param string $content Less file content.
     * @return array<string, string> Variable name → value pairs.
     */
    private static function parse_less_overrides(string $content): array
    {
        $overrides = [];
        $in_block_comment = false;
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            $trimmed = trim($line);

            // Track block comments (/* ... */).
            if (!$in_block_comment && str_starts_with($trimmed, '/*')) {
                $in_block_comment = true;
                // Check if comment closes on same line.
                if (str_contains($trimmed, '*/')) {
                    $in_block_comment = false;
                }
                continue;
            }
            if ($in_block_comment) {
                if (str_contains($trimmed, '*/')) {
                    $in_block_comment = false;
                }
                continue;
            }

            // Skip empty lines, line comments, and imports.
            if (
                $trimmed === '' ||
                str_starts_with($trimmed, '//') ||
                str_starts_with($trimmed, '@import')
            ) {
                continue;
            }

            // Match Less variable definitions: @variable-name: value;
            if (preg_match('/^@([a-z0-9_-]+)\s*:\s*(.+?)\s*;\s*$/i', $trimmed, $match)) {
                $name  = $match[1];
                $value = trim($match[2]);

                // Skip internal/hook variables.
                if (str_starts_with($name, 'internal-') || str_starts_with($name, 'hook-')) {
                    continue;
                }

                // Skip empty Less values.
                if ($value === '' || $value === "~''" || $value === '~""') {
                    continue;
                }

                $overrides[$name] = $value;
            }
        }

        return $overrides;
    }

    /**
     * Build a lookup map from variable name to its source component.
     *
     * @return array<string, string> Variable name → component name.
     */
    private static function build_variable_component_map(): array
    {
        $map = [];
        $components = Component_Registry::get_all();

        foreach (array_keys($components) as $component) {
            $variables = Less_Parser::parse_component($component);

            foreach (array_keys($variables) as $var_name) {
                if (!isset($map[$var_name])) {
                    $map[$var_name] = $component;
                }
            }
        }

        return $map;
    }
}
