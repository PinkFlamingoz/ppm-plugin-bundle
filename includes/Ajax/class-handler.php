<?php

/**
 * AJAX handler for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 */

namespace EPB\Ajax;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Handler
 *
 * Main AJAX handler that registers action hooks and delegates
 * to specialized action classes.
 */
class Handler
{
    /**
     * Registers all AJAX action hooks.
     *
     * @return void
     */
    public static function init(): void
    {
        // Plugin operations.
        add_action('wp_ajax_epb_plugin_action', [Plugin_Actions::class, 'handle_action']);
        add_action('wp_ajax_epb_get_plugin_status', [Plugin_Actions::class, 'get_status']);

        // Token operations (Figma / Tokens Studio).
        add_action('wp_ajax_epb_export_figma', [Token_Actions::class, 'export_figma']);
        add_action('wp_ajax_epb_import_figma', [Token_Actions::class, 'import_figma']);

        // Child theme operations.
        add_action('wp_ajax_epb_create_child_theme', [Child_Theme_Actions::class, 'create']);

        // Component-based theming operations.
        Component_Handler::register();

        // Preview compilation (server-side Less).
        Preview_Compiler::register();
    }

    /**
     * Verifies the AJAX nonce.
     *
     * @param string $nonce_name  The name of the nonce action.
     * @param string $nonce_field POST field containing the nonce.
     * @return bool True if valid, false otherwise.
     */
    public static function verify_nonce(string $nonce_name = 'epb_ajax_nonce', string $nonce_field = 'nonce'): bool
    {
        $nonce = isset($_POST[$nonce_field]) && is_string($_POST[$nonce_field])
            ? sanitize_text_field(wp_unslash($_POST[$nonce_field]))
            : '';

        return wp_verify_nonce($nonce, $nonce_name);
    }

    /**
     * Sends a JSON error response for security failures.
     *
     * @return void
     */
    public static function send_security_error(): void
    {
        wp_send_json_error([
            'message' => __('Security check failed.', 'enhanced-plugin-bundle'),
        ]);
    }

    /**
     * Sends a JSON error response for permission failures.
     *
     * @return void
     */
    public static function send_permission_error(): void
    {
        wp_send_json_error([
            'message' => __('You do not have permission to perform this action.', 'enhanced-plugin-bundle'),
        ]);
    }

    /**
     * Verifies the AJAX request (nonce and permissions).
     *
     * @param string $nonce_name   The name of the nonce action.
     * @param string $nonce_field  POST field containing the nonce.
     * @param string $capability   Required capability (default: manage_options).
     * @return bool True if valid, sends JSON error and returns false otherwise.
     */
    public static function verify_request(
        string $nonce_name = 'epb_ajax_nonce',
        string $nonce_field = 'nonce',
        string $capability = 'manage_options'
    ): bool {
        // Verify nonce.
        if (!self::verify_nonce($nonce_name, $nonce_field)) {
            self::send_security_error();
            return false;
        }

        // Check permissions.
        if (!current_user_can($capability)) {
            self::send_permission_error();
            return false;
        }

        return true;
    }

    /**
     * Gets a sanitized POST parameter.
     *
     * @param string $key     The parameter key.
     * @param string $default Default value if not set.
     * @return string The sanitized value.
     */
    public static function get_post_param(string $key, string $default = ''): string
    {
        return isset($_POST[$key]) && is_string($_POST[$key])
            ? sanitize_text_field(wp_unslash($_POST[$key]))
            : $default;
    }
}
