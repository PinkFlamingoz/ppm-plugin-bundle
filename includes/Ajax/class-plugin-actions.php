<?php

/**
 * Plugin AJAX actions for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 */

namespace EPB\Ajax;

use EPB\Plugins\Manager as PluginManager;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Plugin_Actions
 *
 * Handles AJAX requests for plugin operations.
 */
class Plugin_Actions
{
    /**
     * Handles AJAX plugin action requests.
     *
     * Performs install, activate, deactivate, or delete actions on plugins.
     *
     * @return void
     */
    public static function handle_action(): void
    {
        // Verify nonce and permissions.
        if (!Handler::verify_request()) {
            return;
        }

        // Get and sanitize parameters.
        $slug   = Handler::get_post_param('slug');
        $action = Handler::get_post_param('plugin_action');

        if (empty($slug) || empty($action)) {
            wp_send_json_error([
                'message' => __('Invalid request parameters.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Validate action.
        $allowed_actions = ['install', 'activate', 'deactivate', 'delete'];
        if (!in_array($action, $allowed_actions, true)) {
            wp_send_json_error([
                'message' => __('Invalid action specified.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Capture output to prevent it from breaking JSON response.
        ob_start();

        // Perform the action using the plugin manager.
        PluginManager::handle_plugin_action($slug, $action);

        // Get any notices that were generated.
        $notices = ob_get_clean();

        // Get updated status.
        $status = PluginManager::get_plugin_status($slug);

        // Map actions to proper past tense.
        $past_tense = [
            'install'    => 'installed',
            'activate'   => 'activated',
            'deactivate' => 'deactivated',
            'delete'     => 'deleted',
        ];

        wp_send_json_success([
            'message' => sprintf(
                /* translators: 1: plugin slug, 2: action performed */
                __('Plugin "%1$s" has been %2$s successfully.', 'enhanced-plugin-bundle'),
                $slug,
                $past_tense[$action] ?? $action
            ),
            'status'  => $status,
            'notices' => $notices,
        ]);
    }

    /**
     * Gets the current status of a plugin via AJAX.
     *
     * @return void
     */
    public static function get_status(): void
    {
        // Verify nonce and permissions.
        if (!Handler::verify_request()) {
            return;
        }

        $slug = Handler::get_post_param('slug');

        if (empty($slug)) {
            wp_send_json_error([
                'message' => __('Plugin slug is required.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Get plugin status.
        $status = PluginManager::get_plugin_status($slug);

        wp_send_json_success([
            'slug'   => $slug,
            'status' => $status,
        ]);
    }
}
