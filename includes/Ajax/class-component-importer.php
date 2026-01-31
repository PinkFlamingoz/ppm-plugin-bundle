<?php

/**
 * Component Importer for Enhanced Plugin Bundle.
 *
 * Handles importing component settings.
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

use EPB\CSS\Component_Registry;

/**
 * Class Component_Importer
 *
 * Handles importing component settings.
 */
class Component_Importer
{
    /**
     * Import component settings.
     *
     * @return void
     */
    public static function import_components(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        $import = $_POST['import'] ?? [];

        if (empty($import) || !is_array($import)) {
            wp_send_json_error(['message' => __('No valid import data provided.', 'enhanced-plugin-bundle')]);
            return;
        }

        $imported = 0;

        foreach ($import as $component => $values) {
            $component = sanitize_key($component);

            if (!Component_Registry::has_component($component)) {
                continue;
            }

            $sanitized = Component_Saver::sanitize_component_values($component, $values);

            // Filter out values that match defaults - only keep actual modifications.
            $modified = Component_Saver::filter_modified_values($component, $sanitized);

            if (empty($modified)) {
                // No changes from defaults for this component.
                continue;
            }

            update_option(Component_Handler::OPTION_PREFIX . $component, $modified);
            $imported++;
        }

        // Regenerate CSS.
        Component_Handler::regenerate_css();

        wp_send_json_success([
            'message' => sprintf(
                /* translators: %d: number of components imported */
                __('%d component(s) imported successfully.', 'enhanced-plugin-bundle'),
                $imported
            ),
            'imported' => $imported,
        ]);
    }
}
