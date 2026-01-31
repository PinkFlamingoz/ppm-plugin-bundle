<?php

/**
 * Admin Controller
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 */

namespace EPB\Admin;

if (! defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\Plugins\Manager as PluginManager;
use EPB\Themes\Manager as ThemesManager;

/**
 * Class Controller
 *
 * Handles all administrative functions for the Enhanced Plugin Bundle Manager.
 * Uses template-based views for rendering.
 */
class Controller
{

    /**
     * Sets up the admin hooks for the Plugin Bundle Manager.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('admin_menu', [self::class, 'register_admin_menu']);
        add_action('admin_enqueue_scripts', [self::class, 'enqueue_assets']);
        add_action('admin_init', [self::class, 'handle_form_submissions']);
    }

    /**
     * Registers the plugin's admin menu page.
     *
     * @return void
     */
    public static function register_admin_menu(): void
    {
        add_menu_page(
            __('Plugin Bundle Manager', 'enhanced-plugin-bundle'),
            __('Plugin Bundle', 'enhanced-plugin-bundle'),
            'manage_options',
            'plugin-bundle-settings',
            [self::class, 'render_admin_page']
        );
    }

    /**
     * Enqueues CSS and JavaScript assets for the admin page.
     *
     * @param string $hook The current admin page hook.
     * @return void
     */
    public static function enqueue_assets(string $hook): void
    {
        if ('toplevel_page_plugin-bundle-settings' !== $hook) {
            return;
        }

        // External font stylesheet.
        wp_enqueue_style('epb-adobe-fonts', 'https://use.typekit.net/ome1ekv.css', [], null);

        // Custom admin CSS.
        wp_enqueue_style(
            'epb-admin-style',
            EPB_PLUGIN_URL . 'assets/css/admin.css',
            [],
            EPB_VERSION
        );

        // Custom admin JavaScript.
        wp_enqueue_script(
            'epb-admin-script',
            EPB_PLUGIN_URL . 'assets/js/admin.js',
            ['jquery'],
            EPB_VERSION,
            true
        );

        // Localize script with translations and AJAX settings.
        wp_localize_script(
            'epb-admin-script',
            'EPBAdmin',
            self::get_localized_data()
        );
    }

    /**
     * Gets localized data for JavaScript.
     *
     * @return array<string, mixed>
     */
    private static function get_localized_data(): array
    {
        return [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('epb_ajax_nonce'),
            'i18n'    => [
                'pluginSelectionUnavailable' => __('Plugin selection interface not available.', 'enhanced-plugin-bundle'),
                'selectAtLeastOne'           => __('Please select at least one plugin.', 'enhanced-plugin-bundle'),
                'processing'                 => __('Processing...', 'enhanced-plugin-bundle'),
                'success'                    => __('Success!', 'enhanced-plugin-bundle'),
                'error'                      => __('An error occurred.', 'enhanced-plugin-bundle'),
                'confirmDelete'              => __('Are you sure you want to delete this plugin?', 'enhanced-plugin-bundle'),
            ],
        ];
    }

    /**
     * Processes form submissions on the admin page.
     *
     * @return void
     */
    public static function handle_form_submissions(): void
    {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Page check only.
        $page = isset($_GET['page']) && is_string($_GET['page'])
            ? sanitize_text_field(wp_unslash($_GET['page']))
            : '';

        if ('plugin-bundle-settings' !== $page) {
            return;
        }

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            ThemesManager::handle_form_actions();
            PluginManager::handle_form_actions();
        }
    }

    /**
     * Renders the Plugin Bundle Manager admin page.
     *
     * @return void
     */
    public static function render_admin_page(): void
    {
        // Get grouped list of available plugins.
        $plugins = PluginManager::get_plugin_list();

        // Load the admin page template.
        require EPB_PLUGIN_DIR . 'admin/views/admin-page.php';
    }
}
