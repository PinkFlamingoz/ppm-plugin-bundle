<?php

/**
 * Plugin Name: Enhanced Plugin Bundle and Theme Manager
 * Description: Simplifies and centralizes the management of plugins and themes in WordPress.
 * Version: 3.3
 * Author: Stavrov
 * Author URI: https://github.com/PinkFlamingoz
 *
 * This file bootstraps the Enhanced Plugin Bundle and Theme Manager.
 * It sets up constants, loads all necessary dependencies, and triggers the plugin initialization.
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access to the file for security reasons.
}

// -----------------------------------------------------------------------------
// Plugin Constants
// -----------------------------------------------------------------------------

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

// -----------------------------------------------------------------------------
// Required Files
// -----------------------------------------------------------------------------

// Load the TGM Plugin Activation library for managing plugin dependencies.
require_once EPB_PLUGIN_DIR . 'vendor/class-tgm-plugin-activation.php';

// Load common utility functions that support various operations across the plugin.
require_once EPB_PLUGIN_DIR . 'includes/plugin-bundle-functions.php';

// Load the class that handles plugin configuration options and settings.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-plugins-options.php';

// Load the class responsible for managing CSS-related configuration settings.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-css-options.php';

// Load the class that dynamically generates CSS based on stored configuration options.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-css-generator.php';

// Load the class that renders the user interface sections for managing themes.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-theme-section-renderer.php';

// Load the class that manages plugin operations such as installation, activation, and removal.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-plugins.php';

// Load the class that renders the user interface for plugin management.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-plugin-section-renderer.php';

// Load the class that handles theme-related operations including uploads and child theme creation.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-themes.php';

// Load the class that manages localization, translation strings, and plugin messages.
require_once EPB_PLUGIN_DIR . 'includes/class-plugin-bundle-texts.php';

// Load the class that manages all admin-side interactions such as menu creation, form processing, and asset loading.
require_once EPB_PLUGIN_DIR . 'admin/class-plugin-bundle-admin.php';

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
    Plugin_Bundle_Admin::init();
    // Other modules like Plugin_Bundle_Plugins and Plugin_Bundle_Themes load conditionally.
}
add_action('plugins_loaded', 'epb_init');
