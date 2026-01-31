<?php

/**
 * Uninstall handler for Enhanced Plugin Bundle and Theme Manager.
 *
 * This file is executed when the plugin is deleted from WordPress.
 * It cleans up all plugin data from the database.
 *
 * @package Enhanced_Plugin_Bundle
 */

// Exit if not called by WordPress during uninstall.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove plugin options from the database.
delete_option('epb_dynamic_plugins');
delete_option('epb_version');

// Remove CSS options (pre-component system).
delete_option('ppm_child_theme_css_options');

// Remove component-based CSS options.
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'epb_component_%'");

// Clean up any transients if they exist.
delete_transient('epb_plugin_cache');

// Remove custom capabilities from administrator role.
$admin_role = get_role('administrator');
if (null !== $admin_role) {
    $admin_role->remove_cap('epb_manage_plugins');
    $admin_role->remove_cap('epb_manage_themes');
    $admin_role->remove_cap('epb_access_settings');
}

/**
 * Note: We intentionally do NOT delete the child theme created by this plugin
 * as it may contain user customizations. Users should manually delete
 * the child theme from Appearance > Themes if desired.
 */
