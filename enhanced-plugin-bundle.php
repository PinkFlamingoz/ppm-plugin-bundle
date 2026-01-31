<?php

/**
 * Plugin Name: Enhanced Plugin Bundle and Theme Manager
 * Description: Simplifies and centralizes the management of plugins and themes in WordPress.
 * Version: 4.0
 * Author: Stavrov
 * Author URI: https://github.com/PinkFlamingoz
 * Text Domain: enhanced-plugin-bundle
 * Domain Path: /languages
 * Requires PHP: 7.4
 *
 * This file bootstraps the Enhanced Plugin Bundle and Theme Manager.
 * It sets up constants, loads all necessary dependencies, and triggers the plugin initialization.
 */

// Enhanced direct access protection with proper HTTP headers.
if (!function_exists('add_filter')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

// -----------------------------------------------------------------------------
// Plugin Constants
// -----------------------------------------------------------------------------

/**
 * EPB_VERSION
 *
 * Current plugin version.
 */
define('EPB_VERSION', '4.0');

/**
 * EPB_PLUGIN_DIR
 *
 * Absolute file system path to the plugin directory.
 */
define('EPB_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * EPB_PLUGIN_URL
 *
 * URL to the plugin directory used for enqueuing assets and links.
 */
define('EPB_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * EPB_PLUGIN_BASENAME
 *
 * Plugin basename for hooks and filters.
 */
define('EPB_PLUGIN_BASENAME', plugin_basename(__FILE__));

// -----------------------------------------------------------------------------
// Required Files
// -----------------------------------------------------------------------------

// Load the TGM Plugin Activation library for managing plugin dependencies.
require_once EPB_PLUGIN_DIR . 'vendor/class-tgm-plugin-activation.php';

// Load and register the PSR-4 autoloader for plugin classes.
require_once EPB_PLUGIN_DIR . 'includes/class-autoloader.php';
EPB_Autoloader::register();

// -----------------------------------------------------------------------------
// Initialization
// -----------------------------------------------------------------------------

/**
 * Initializes the Enhanced Plugin Bundle and Theme Manager.
 *
 * This function is hooked to 'plugins_loaded' to ensure that all plugins
 * are fully loaded before initializing the plugin's admin interfaces and core functionality.
 * It sets up the administrative components and conditionally loads additional modules as needed.
 *
 * @return void
 */
function epb_init(): void
{
    // Load plugin text domain for translations.
    load_plugin_textdomain('enhanced-plugin-bundle', false, dirname(EPB_PLUGIN_BASENAME) . '/languages');

    // Run upgrade routines if needed.
    EPB\Core\Upgrader::maybe_upgrade();

    // Initialize the notices system for displaying admin notices.
    EPB\Core\Notices::init();

    // Initialize admin interface.
    EPB\Admin\Controller::init();

    // Initialize AJAX handlers.
    EPB\Ajax\Handler::init();

    // Initialize child theme hooks (for auto CSS regeneration).
    EPB\Themes\Child_Theme::init();
}
add_action('plugins_loaded', 'epb_init');

// -----------------------------------------------------------------------------
// Activation and Deactivation Hooks
// -----------------------------------------------------------------------------

register_activation_hook(__FILE__, [EPB\Core\Activator::class, 'activate']);
register_deactivation_hook(__FILE__, [EPB\Core\Deactivator::class, 'deactivate']);

// -----------------------------------------------------------------------------
// Plugin Action Links
// -----------------------------------------------------------------------------

/**
 * Adds settings link to the plugin action links on the Plugins page.
 *
 * @param array $links Existing plugin action links.
 * @return array Modified plugin action links.
 */
function epb_plugin_action_links(array $links): array
{
    $settings_link = sprintf(
        '<a href="%s">%s</a>',
        esc_url(admin_url('admin.php?page=plugin-bundle-settings')),
        esc_html__('Settings', 'enhanced-plugin-bundle')
    );
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . EPB_PLUGIN_BASENAME, 'epb_plugin_action_links');

/**
 * Adds additional meta links to the plugin row on the Plugins page.
 *
 * @param array  $links Plugin meta links.
 * @param string $file  Plugin file path.
 * @return array Modified plugin meta links.
 */
function epb_plugin_row_meta(array $links, string $file): array
{
    if (EPB_PLUGIN_BASENAME === $file) {
        $links[] = sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            esc_url('https://github.com/PinkFlamingoz'),
            esc_html__('Documentation', 'enhanced-plugin-bundle')
        );
    }
    return $links;
}
add_filter('plugin_row_meta', 'epb_plugin_row_meta', 10, 2);
