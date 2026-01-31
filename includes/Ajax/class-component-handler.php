<?php

/**
 * Component AJAX Handler for Enhanced Plugin Bundle.
 *
 * Main coordinator that delegates to specialized component classes.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.1.0
 */

namespace EPB\Ajax;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Less_Parser;
use EPB\CSS\Component_Registry;

/**
 * Class Component_Handler
 *
 * Manages AJAX operations for the component-based theming system.
 * Delegates to specialized classes for specific operations.
 */
class Component_Handler
{
    /**
     * Option prefix for component storage.
     *
     * @var string
     */
    public const OPTION_PREFIX = 'epb_component_';

    /**
     * Nonce action for security.
     *
     * @var string
     */
    public const NONCE_ACTION = 'epb_component_nonce';

    /**
     * Register AJAX handlers.
     *
     * @return void
     */
    public static function register(): void
    {
        // Loading operations - delegated to Component_Loader.
        add_action('wp_ajax_epb_load_component', [Component_Loader::class, 'load_component']);
        add_action('wp_ajax_epb_get_components_menu', [Component_Loader::class, 'get_components_menu']);
        add_action('wp_ajax_epb_get_component_preview', [Component_Loader::class, 'get_component_preview']);
        add_action('wp_ajax_epb_get_preview_page', [Component_Loader::class, 'get_preview_page']);

        // Saving/resetting operations - delegated to Component_Saver.
        add_action('wp_ajax_epb_save_component', [Component_Saver::class, 'save_component']);
        add_action('wp_ajax_epb_reset_component', [Component_Saver::class, 'reset_component']);
        add_action('wp_ajax_epb_reset_all_components', [Component_Saver::class, 'reset_all_components']);

        // Export operations - delegated to Component_Exporter.
        add_action('wp_ajax_epb_export_all_components', [Component_Exporter::class, 'export_all_components']);
        add_action('wp_ajax_epb_export_yootheme_less', [Component_Exporter::class, 'export_yootheme_less']);

        // Import operations - delegated to Component_Importer.
        add_action('wp_ajax_epb_import_components', [Component_Importer::class, 'import_components']);
    }

    /**
     * Normalize Less escape syntax to use consistent single quotes.
     *
     * Converts ~\\'...\\' or ~\"...\" to ~'...' for consistent comparison.
     *
     * @param string $value The value to normalize.
     * @return string The normalized value.
     */
    public static function normalize_less_escape(string $value): string
    {
        // Replace escaped quotes in Less escape syntax: ~\\'...\\' or ~'...' -> ~'...'
        $normalized = preg_replace("/~\\\\?['\"](.+?)\\\\?['\"]/", "~'$1'", $value);

        // Normalize math expression parentheses: strip outer parens if it's a simple math expression.
        // Matches: (@var + 10), (10 + @var), (@var - @var2), etc.
        // Only strip if no nested parentheses (to avoid breaking function calls).
        if (preg_match('/^\([^()]+\)$/', $normalized)) {
            // It's wrapped in parens with no nested parens - strip them.
            $normalized = substr($normalized, 1, -1);
        }

        // Normalize spaces around operators for consistency.
        $normalized = preg_replace('/\s*([\+\-\*\/])\s*/', ' $1 ', $normalized);
        $normalized = preg_replace('/\s+/', ' ', trim($normalized));

        return $normalized;
    }

    /**
     * Regenerate the CSS cache after changes.
     *
     * @return void
     */
    public static function regenerate_css(): void
    {
        // Clear any cached CSS.
        delete_transient('epb_component_css');

        // Optionally trigger child theme CSS regeneration.
        do_action('epb_component_settings_updated');
    }

    /**
     * Get saved value for a specific variable.
     *
     * @param string $component Component name.
     * @param string $variable  Variable name.
     * @return mixed|null Saved value or null.
     */
    public static function get_saved_value(string $component, string $variable)
    {
        $saved = get_option(self::OPTION_PREFIX . $component, []);
        return $saved[$variable] ?? null;
    }

    /**
     * Get all saved values for a component.
     *
     * @param string $component Component name.
     * @return array<string, mixed> Saved values.
     */
    public static function get_component_values(string $component): array
    {
        return get_option(self::OPTION_PREFIX . $component, []);
    }

    /**
     * Get the generated CSS for all components.
     *
     * @return string Generated CSS.
     */
    public static function generate_component_css(): string
    {
        $cached = get_transient('epb_component_css');

        if ($cached !== false) {
            return $cached;
        }

        // Build a map of all parsed variables with their resolved values.
        $all_parsed = [];
        $components = Component_Registry::get_all();

        // First pass: collect all parsed variable data.
        foreach (array_keys($components) as $component) {
            $parsed = Less_Parser::parse_component($component);
            foreach ($parsed as $var_name => $meta) {
                $all_parsed[$var_name] = $meta;
            }
        }

        $css = "/* EPB Component Theme Variables */\n:root {\n";

        foreach (array_keys($components) as $component) {
            $parsed = Less_Parser::parse_component($component);
            $saved  = get_option(self::OPTION_PREFIX . $component, []);

            if (empty($saved)) {
                continue;
            }

            $css .= "\n    /* " . ucfirst($component) . " */\n";

            foreach ($saved as $var_name => $saved_value) {
                $meta = $parsed[$var_name] ?? null;
                if (!$meta) {
                    continue;
                }

                // Determine the final CSS value.
                $css_value = self::resolve_to_css_value($saved_value, $meta, $all_parsed);

                // Convert Less variable to CSS custom property.
                $css_var = '--uk-' . $var_name;
                $css .= "    {$css_var}: {$css_value};\n";
            }
        }

        $css .= "}\n";

        // Cache for 1 hour.
        set_transient('epb_component_css', $css, HOUR_IN_SECONDS);

        return $css;
    }

    /**
     * Resolve a saved value to a CSS-compatible value.
     *
     * @param string $saved_value The saved value (could be reference or direct).
     * @param array  $meta        Variable metadata from parser.
     * @param array  $all_parsed  All parsed variables for reference lookup.
     * @return string CSS-compatible value.
     */
    private static function resolve_to_css_value(string $saved_value, array $meta, array $all_parsed): string
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $original_value;

        // If saved value equals original value (unchanged), use parser's resolved value.
        if ($saved_value === $original_value) {
            return $resolved;
        }

        // If saved value is a simple reference like @global-color.
        if (preg_match('/^@([\w-]+)$/', $saved_value, $matches)) {
            $ref_name = $matches[1];
            // Look up the referenced variable's resolved value.
            if (isset($all_parsed[$ref_name])) {
                return $all_parsed[$ref_name]['resolved'] ?? $all_parsed[$ref_name]['value'];
            }
        }

        // If saved value contains Less functions like darken(), use parser's resolved.
        if (preg_match('/(darken|lighten|fade|saturate|spin)\s*\(/', $saved_value)) {
            return $resolved;
        }

        // Otherwise, saved value is a direct value (like #ff5500 or 16px).
        return $saved_value;
    }

    /**
     * Get the count of modified variables for all components.
     *
     * @return array<string, int> Component key => modified count.
     */
    public static function get_all_modified_counts(): array
    {
        $counts = [];
        $components = Component_Registry::get_all();

        foreach (array_keys($components) as $component) {
            $saved = get_option(self::OPTION_PREFIX . $component, []);
            if (!empty($saved)) {
                // Count only values that are actually different from defaults.
                $variables = Less_Parser::parse_component($component);
                $actual_modified = 0;

                foreach ($saved as $key => $value) {
                    if (!isset($variables[$key])) {
                        continue;
                    }
                    $original = $variables[$key]['value'];

                    // Normalize and compare.
                    $normalized_saved = self::normalize_less_escape($value);
                    $normalized_original = self::normalize_less_escape($original);

                    if ($normalized_saved !== $normalized_original) {
                        $actual_modified++;
                    }
                }

                if ($actual_modified > 0) {
                    $counts[$component] = $actual_modified;
                }
            }
        }

        return $counts;
    }
}
