<?php

/**
 * Child Theme AJAX actions for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 */

namespace EPB\Ajax;

use EPB\Themes\Child_Theme;
use EPB\Themes\Manager as ThemesManager;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Child_Theme_Actions
 *
 * Handles AJAX requests for child theme operations.
 */
class Child_Theme_Actions
{
    /**
     * Creates and activates the child theme.
     *
     * @return void
     */
    public static function create(): void
    {
        // Verify nonce and permissions (uses component picker nonce).
        if (!Handler::verify_request('epb_component_nonce')) {
            return;
        }

        // Check if parent theme is installed.
        if (!ThemesManager::is_yootheme_installed()) {
            wp_send_json_error([
                'message' => __('YOOtheme Pro is not installed. Please install YOOtheme Pro first.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Capture output to prevent it from breaking JSON response.
        ob_start();

        // Create and activate child theme (structure files + styles).
        Child_Theme::create_and_activate(true);

        ob_get_clean();

        // Check if child theme now exists and is active.
        $child_exists = file_exists(Child_Theme::get_child_theme_dir());
        $child_active = ThemesManager::is_child_theme_active();

        if ($child_exists) {
            wp_send_json_success([
                'message'      => $child_active
                    ? __('Child theme created and activated successfully.', 'enhanced-plugin-bundle')
                    : __('Child theme created successfully.', 'enhanced-plugin-bundle'),
                'child_exists' => $child_exists,
                'child_active' => $child_active,
            ]);
        } else {
            wp_send_json_error([
                'message' => __('Failed to create child theme.', 'enhanced-plugin-bundle'),
            ]);
        }
    }
}
