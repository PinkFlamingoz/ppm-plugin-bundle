<?php

/**
 * Token AJAX actions for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 */

namespace EPB\Ajax;

use EPB\Tokens\Tokens_Studio_Exporter;
use EPB\Tokens\Tokens_Studio_Importer;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Token_Actions
 *
 * Handles AJAX requests for token operations.
 */
class Token_Actions
{
    /**
     * Exports all UIkit Less variables to Tokens Studio format for Figma.
     *
     * @return void
     */
    public static function export_figma(): void
    {
        // Verify nonce and permissions (uses component picker nonce).
        if (!Handler::verify_request('epb_component_nonce')) {
            return;
        }

        // Get exported tokens using the Tokens Studio exporter.
        $tokens = Tokens_Studio_Exporter::export();

        wp_send_json_success([
            'tokens'   => $tokens,
            'filename' => 'tokens-studio-' . gmdate('Y-m-d') . '.json',
        ]);
    }

    /**
     * Imports Tokens Studio format from Figma via AJAX.
     *
     * @return void
     */
    public static function import_figma(): void
    {
        try {
            // Verify nonce and permissions (uses component picker nonce).
            if (!Handler::verify_request('epb_component_nonce')) {
                return;
            }

            // Get and decode the tokens JSON from POST data.
            // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verified above.
            $tokens_json = isset($_POST['tokens']) ? wp_unslash($_POST['tokens']) : '';

            if (empty($tokens_json) || !is_string($tokens_json)) {
                wp_send_json_error([
                    'message' => __('No token data provided.', 'enhanced-plugin-bundle'),
                ]);
                return;
            }

            $tokens = json_decode($tokens_json, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($tokens)) {
                wp_send_json_error([
                    'message' => __('Invalid JSON format. Please paste valid Tokens Studio JSON.', 'enhanced-plugin-bundle'),
                ]);
                return;
            }

            // Validate Tokens Studio format.
            $validation = Tokens_Studio_Importer::validate($tokens);

            if (is_wp_error($validation)) {
                wp_send_json_error([
                    'message' => $validation->get_error_message(),
                ]);
                return;
            }

            // Import the tokens.
            $result = Tokens_Studio_Importer::import($tokens);

            if (!$result['success']) {
                wp_send_json_error([
                    'message' => $result['message'],
                ]);
                return;
            }

            // Regenerate CSS after import.
            delete_transient('epb_component_css');
            do_action('epb_component_settings_updated');

            wp_send_json_success([
                'message'    => $result['message'],
                'imported'   => $result['imported'],
                'skipped'    => $result['skipped'],
                'debug_logs' => $result['debug_logs'] ?? [],
            ]);
        } catch (\Throwable $e) {
            wp_send_json_error([
                'message' => 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
            ]);
        }
    }
}
