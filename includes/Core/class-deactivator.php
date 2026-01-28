<?php

/**
 * Plugin deactivation handler for Enhanced Plugin Bundle.
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

/**
 * Class Deactivator
 *
 * Handles all deactivation routines for the plugin.
 * Performs cleanup tasks when the plugin is deactivated.
 */
class Deactivator
{
    /**
     * Runs on plugin deactivation.
     *
     * Performs cleanup tasks when the plugin is deactivated.
     * Note: Options are NOT deleted here. Use uninstall.php for complete removal.
     *
     * @return void
     */
    public static function deactivate(): void
    {
        // Remove custom capabilities from roles.
        Capabilities::unregister();

        // Clear any cached data.
        delete_transient('epb_plugin_cache');

        // Log deactivation if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Enhanced Plugin Bundle deactivated.');
        }
    }
}
