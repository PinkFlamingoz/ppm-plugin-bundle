<?php

/**
 * Token AJAX actions for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 */

namespace EPB\Ajax;

use EPB\Tokens\Exporter as TokenExporter;

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
     * Exports current CSS options as Tokens Studio format via AJAX.
     *
     * @return void
     */
    public static function export(): void
    {
        // Verify nonce.
        if (!Handler::verify_nonce()) {
            Handler::send_security_error();
            return;
        }

        // Check capability.
        if (!epb_current_user_can('epb_manage_themes')) {
            wp_send_json_error([
                'message' => __('You do not have permission to export tokens.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Get exported tokens using the new exporter.
        $tokens = TokenExporter::export();

        wp_send_json_success([
            'tokens'   => $tokens,
            'filename' => 'tokens-' . gmdate('Y-m-d') . '.json',
        ]);
    }

    /**
     * Validates tokens structure via AJAX.
     *
     * @return void
     */
    public static function validate(): void
    {
        // Verify nonce.
        if (!Handler::verify_nonce()) {
            Handler::send_security_error();
            return;
        }

        // Check capability.
        if (!epb_current_user_can('epb_manage_themes')) {
            wp_send_json_error([
                'message' => __('You do not have permission to validate tokens.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        $tokens_json = Handler::get_post_param('tokens');

        if (empty($tokens_json)) {
            wp_send_json_error([
                'message' => __('No token data provided.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Parse JSON.
        $tokens = json_decode($tokens_json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error([
                'message' => sprintf(
                    /* translators: %s: JSON error message */
                    __('Failed to parse JSON: %s', 'enhanced-plugin-bundle'),
                    json_last_error_msg()
                ),
            ]);
            return;
        }

        // Validate structure.
        $validation = \EPB\Tokens\Importer::validate($tokens);

        if (is_wp_error($validation)) {
            wp_send_json_error([
                'message' => $validation->get_error_message(),
            ]);
            return;
        }

        // Count recognized tokens.
        $transformed = \EPB\Tokens\Importer::transform($tokens);

        wp_send_json_success([
            'message'     => __('Token structure is valid.', 'enhanced-plugin-bundle'),
            'token_count' => count($transformed),
        ]);
    }
}
