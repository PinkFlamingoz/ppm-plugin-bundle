<?php

/**
 * Component Exporter for Enhanced Plugin Bundle.
 *
 * Handles exporting component settings.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.2.0
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
 * Class Component_Exporter
 *
 * Handles exporting component settings in various formats.
 */
class Component_Exporter
{
    /**
     * Export all component settings.
     *
     * @return void
     */
    public static function export_all_components(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        $export = [];
        $components = Component_Registry::get_all();

        foreach (array_keys($components) as $component) {
            // Get all variables for this component from the Less parser.
            $grouped = Less_Parser::get_grouped_variables($component);
            $saved = get_option(Component_Handler::OPTION_PREFIX . $component, []);

            $component_vars = [];
            foreach ($grouped as $group_vars) {
                foreach ($group_vars as $var_name => $meta) {
                    // Use saved value if exists, otherwise use original value.
                    $component_vars[$var_name] = $saved[$var_name] ?? $meta['value'];
                }
            }

            if (!empty($component_vars)) {
                $export[$component] = $component_vars;
            }
        }

        wp_send_json_success([
            'export' => $export,
            'meta'   => [
                'exported_at' => current_time('c'),
                'site_url'    => home_url(),
                'version'     => EPB_VERSION ?? '4.1.0',
            ],
        ]);
    }

    /**
     * Export all modified component settings as YOOtheme JSON style format.
     *
     * Generates a JSON file compatible with YOOtheme Pro's style import.
     * Format: {"style":"base-style","less":{"@var-name":"value"},"modified":"ISO-date","name":"style-name"}
     *
     * @return void
     */
    public static function export_yootheme_less(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        $components = Component_Registry::get_all();
        $base_style = get_option('epb_yootheme_base_style', 'fuse') ?: 'fuse';
        $style_name = get_option('epb_yootheme_style_name', 'custom-style') ?: 'custom-style';

        // Build the Less variables object.
        $less_vars = [];

        foreach ($components as $component_key => $component_data) {
            $saved = get_option(Component_Handler::OPTION_PREFIX . $component_key, []);

            if (empty($saved)) {
                continue;
            }

            // Get the original variables to preserve order.
            $grouped = Less_Parser::get_grouped_variables($component_key);

            foreach ($grouped as $group_vars) {
                foreach ($group_vars as $var_name => $meta) {
                    if (isset($saved[$var_name])) {
                        // Use @ prefix for variable names in YOOtheme format.
                        $less_vars['@' . $var_name] = $saved[$var_name];
                    }
                }
            }
        }

        // Build the YOOtheme style JSON structure.
        $yootheme_style = [
            'style'    => $base_style,
            'less'     => (object) $less_vars, // Cast to object for proper JSON encoding.
            'modified' => gmdate('Y-m-d\TH:i:s.v\Z'),
            'name'     => sanitize_title($style_name),
        ];

        // Generate a clean filename.
        $filename = sanitize_file_name($style_name) . '.json';

        wp_send_json_success([
            'json'     => $yootheme_style,
            'filename' => $filename,
        ]);
    }
}
