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
use EPB\CSS\Generator;
use EPB\Core\Constants;
use EPB\Core\Utils;

/**
 * Class Component_Handler
 *
 * Manages AJAX operations for the component-based theming system.
 * Delegates to specialized classes for specific operations.
 */
class Component_Handler
{

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
     * Regenerate the CSS cache after changes.
     *
     * @return void
     */
    public static function regenerate_css(): void
    {
        // Clear any cached CSS.
        delete_transient(Constants::TRANSIENT_CSS);

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
        $saved = get_option(Constants::OPTION_PREFIX . $component, []);
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
        return get_option(Constants::OPTION_PREFIX . $component, []);
    }

    /**
     * Get the generated CSS for all components.
     *
     * @return string Generated CSS.
     * @deprecated Use Generator::generate_all_component_css() directly.
     */
    public static function generate_component_css(): string
    {
        return Generator::generate_all_component_css();
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
            $saved = get_option(Constants::OPTION_PREFIX . $component, []);
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
                    $normalized_saved = Utils::normalize_less_escape($value);
                    $normalized_original = Utils::normalize_less_escape($original);

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
