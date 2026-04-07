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

        // Recover component values from an existing child theme's Less file
        // when the database options are missing (e.g. after a delete + reinstall).
        self::maybe_recover_from_child_theme();

        // Store the plugin version for future upgrade checks.
        update_option('epb_version', EPB_VERSION);

        // Log activation if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Enhanced Plugin Bundle activated. Version: ' . EPB_VERSION);
        }
    }

    /**
     * Recover saved component values from the child theme's Less file.
     *
     * When the plugin is deleted and reinstalled, uninstall.php removes all
     * epb_component_* options from the database. However the child theme's
     * Less file (theme.ct-style.less) still contains the variable overrides.
     * This method parses those overrides and restores the database options
     * so the admin UI shows the correct customised values.
     *
     * @return void
     */
    private static function maybe_recover_from_child_theme(): void
    {
        // Check if any component options already exist in the database.
        // If they do, there's nothing to recover.
        global $wpdb;
        $existing = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s",
                $wpdb->esc_like(Constants::OPTION_PREFIX) . '%'
            )
        );

        if ((int) $existing > 0) {
            return;
        }

        // Locate the child theme's Less file.
        $less_file = WP_CONTENT_DIR . '/themes/' . Child_Theme::THEME_SLUG
            . '/less/theme.' . Child_Theme::LESS_STYLE_NAME . '.less';

        if (!file_exists($less_file)) {
            return;
        }

        $content = file_get_contents($less_file);

        if ($content === false || empty($content)) {
            return;
        }

        // Extract all @variable: value; declarations from the overrides section.
        // Skip import lines and comments.
        $overrides = self::parse_less_overrides($content);

        if (empty($overrides)) {
            return;
        }

        // Build a map from variable name → component by scanning the registry.
        $var_to_component = self::build_variable_component_map();

        if (empty($var_to_component)) {
            return;
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

        // Save each component's values back to the database.
        foreach ($component_values as $component => $values) {
            // Filter to only truly modified values (differ from defaults).
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
            }
        }

        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Recovered component values from child theme Less file.');
        }
    }

    /**
     * Parse Less variable override declarations from a Less file's content.
     *
     * Extracts lines matching `@variable-name: value;` while ignoring
     * import statements, comments, and re-assertion blocks metadata.
     *
     * @param string $content Less file content.
     * @return array<string, string> Variable name → value pairs.
     */
    private static function parse_less_overrides(string $content): array
    {
        $overrides = [];
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            $trimmed = trim($line);

            // Skip empty lines, comments, and imports.
            if (
                $trimmed === '' ||
                str_starts_with($trimmed, '//') ||
                str_starts_with($trimmed, '/*') ||
                str_starts_with($trimmed, '*') ||
                str_starts_with($trimmed, '@import')
            ) {
                continue;
            }

            // Match Less variable definitions: @variable-name: value;
            if (preg_match('/^@([a-z0-9_-]+)\s*:\s*(.+?)\s*;$/i', $trimmed, $match)) {
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
     * Scans all registered components and their Less files to create
     * a reverse mapping of variable-name → component-name.
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
                // First component to define the variable owns it.
                if (!isset($map[$var_name])) {
                    $map[$var_name] = $component;
                }
            }
        }

        return $map;
    }
}
