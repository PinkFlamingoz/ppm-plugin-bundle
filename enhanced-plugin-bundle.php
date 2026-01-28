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
    epb_maybe_upgrade();

    // Initialize the notices system for displaying admin notices.
    EPB\Core\Notices::init();

    // Initialize admin interface.
    EPB\Admin\Controller::init();

    // Initialize AJAX handlers.
    EPB\Ajax\Handler::init();
}
add_action('plugins_loaded', 'epb_init');

// -----------------------------------------------------------------------------
// Upgrade Routine
// -----------------------------------------------------------------------------

/**
 * Runs upgrade routines when the plugin version changes.
 *
 * Compares the stored version with the current version and runs
 * any necessary migration or update routines.
 *
 * @return void
 */
function epb_maybe_upgrade(): void
{
    $stored_version = get_option('epb_version', '0');

    // Skip if already up to date.
    if (version_compare($stored_version, EPB_VERSION, '>=')) {
        return;
    }

    // Upgrade from version < 3.5 (sanitization and security improvements).
    if (version_compare($stored_version, '3.5', '<')) {
        // Clear any cached data to ensure fresh state.
        delete_transient('epb_plugin_cache');

        // Log upgrade if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Upgraded from version ' . $stored_version . ' to ' . EPB_VERSION);
        }
    }

    // Upgrade to version 4.0 (modular architecture).
    if (version_compare($stored_version, '4.0', '<')) {
        // Clear cached data for fresh initialization.
        delete_transient('epb_plugin_cache');

        // Log upgrade if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Upgraded to v4.0 modular architecture.');
        }
    }

    // Update the stored version.
    update_option('epb_version', EPB_VERSION);
}

// -----------------------------------------------------------------------------
// Activation and Deactivation Hooks
// -----------------------------------------------------------------------------

/**
 * Plugin activation callback.
 *
 * Sets up default options and performs any necessary initialization
 * when the plugin is activated.
 *
 * @return void
 */
function epb_activate(): void
{
    // Register custom capabilities for the administrator role.
    epb_register_capabilities();

    // Set default plugin options if they don't exist.
    if (false === get_option('epb_dynamic_plugins')) {
        add_option('epb_dynamic_plugins', EPB\Plugins\Options::get_defaults());
    }

    // Set default CSS options if they don't exist.
    if (false === get_option('ppm_child_theme_css_options')) {
        add_option('ppm_child_theme_css_options', EPB\CSS\Options::get_defaults());
    }

    // Store the plugin version for future upgrade checks.
    update_option('epb_version', EPB_VERSION);

    // Log activation if debugging is enabled.
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[EPB] Enhanced Plugin Bundle activated. Version: ' . EPB_VERSION);
    }
}
register_activation_hook(__FILE__, 'epb_activate');

/**
 * Plugin deactivation callback.
 *
 * Performs cleanup tasks when the plugin is deactivated.
 * Note: Options are NOT deleted here. Use uninstall.php for complete removal.
 *
 * @return void
 */
function epb_deactivate(): void
{
    // Remove custom capabilities from roles.
    epb_unregister_capabilities();

    // Clear any cached data.
    delete_transient('epb_plugin_cache');

    // Log deactivation if debugging is enabled.
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[EPB] Enhanced Plugin Bundle deactivated.');
    }
}

// -----------------------------------------------------------------------------
// Custom Capabilities
// -----------------------------------------------------------------------------

/**
 * Registers custom capabilities for the plugin.
 *
 * Adds custom capabilities to the administrator role for fine-grained access control.
 * This allows site owners to grant specific EPB permissions to other roles if needed.
 *
 * @return void
 */
function epb_register_capabilities(): void
{
    $admin_role = get_role('administrator');

    if (null === $admin_role) {
        return;
    }

    // Core plugin management capability.
    $admin_role->add_cap('epb_manage_plugins');

    // Theme management capability.
    $admin_role->add_cap('epb_manage_themes');

    // Settings access capability.
    $admin_role->add_cap('epb_access_settings');
}

/**
 * Removes custom capabilities on plugin deactivation.
 *
 * Cleans up the custom capabilities from all roles.
 *
 * @return void
 */
function epb_unregister_capabilities(): void
{
    $admin_role = get_role('administrator');

    if (null === $admin_role) {
        return;
    }

    $admin_role->remove_cap('epb_manage_plugins');
    $admin_role->remove_cap('epb_manage_themes');
    $admin_role->remove_cap('epb_access_settings');
}

/**
 * Checks if the current user has a specific EPB capability.
 *
 * Falls back to 'manage_options' for backwards compatibility.
 *
 * @param string $capability The capability to check.
 * @return bool Whether the user has the capability.
 */
function epb_current_user_can(string $capability): bool
{
    // First check the EPB-specific capability.
    if (current_user_can($capability)) {
        return true;
    }

    // Fall back to manage_options for backwards compatibility.
    return current_user_can('manage_options');
}
register_deactivation_hook(__FILE__, 'epb_deactivate');

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
