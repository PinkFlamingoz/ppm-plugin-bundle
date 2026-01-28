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

        // Set default CSS options if they don't exist.
        if (false === get_option('ppm_child_theme_css_options')) {
            add_option('ppm_child_theme_css_options', \EPB\CSS\Options::get_defaults());
        }

        // Store the plugin version for future upgrade checks.
        update_option('epb_version', EPB_VERSION);

        // Log activation if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Enhanced Plugin Bundle activated. Version: ' . EPB_VERSION);
        }
    }
}
