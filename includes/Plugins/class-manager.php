<?php

/**
 * Plugin manager for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Plugins
 */

namespace EPB\Plugins;

use EPB\Core\Notices;
use EPB\Core\Capabilities;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Manager
 *
 * Main orchestrator for plugin bundle operations.
 * Handles plugin list retrieval, status checking, and form action processing.
 */
class Manager
{
    /**
     * Returns a map of plugin slugs to their display names.
     *
     * @return array<string, string>
     */
    public static function get_plugin_list(): array
    {
        $dynamic = Options::get();
        $plugins = [];
        foreach ($dynamic as $plugin) {
            $plugins[$plugin['slug']] = $plugin['name'];
        }

        return $plugins;
    }

    /**
     * Maps plugin slugs to their main initialization file paths.
     *
     * For each dynamic plugin, uses the 'init_path' if set; otherwise, guesses a default path.
     *
     * @return array<string, string> Array mapping plugin slug to its file path.
     */
    public static function get_plugin_files(): array
    {
        $dynamic = Options::get();
        $files   = [];
        foreach ($dynamic as $plugin) {
            $files[$plugin['slug']] = !empty($plugin['init_path'])
                ? $plugin['init_path']
                : "{$plugin['slug']}/{$plugin['slug']}.php";
        }
        return $files;
    }

    /**
     * Resolves the plugin file registered for the provided slug.
     *
     * Prints an error notice and returns null when the slug is not part of the tracked list.
     *
     * @param string $slug  The plugin slug to resolve.
     * @param bool   $queue Whether to queue notices for redirect (bulk mode).
     * @return string|null The plugin file relative path or null when not found.
     */
    public static function resolve_plugin_file(string $slug, bool $queue = false): ?string
    {
        $files = self::get_plugin_files();

        if (empty($files[$slug])) {
            $message = sprintf(
                /* translators: %s: plugin slug */
                __('Plugin "%s" is not managed by this bundle.', 'enhanced-plugin-bundle'),
                $slug
            );
            $queue ? Notices::error($message) : Notices::print_notice('error', $message);

            return null;
        }

        return $files[$slug];
    }

    /**
     * Determines the current status of a plugin.
     *
     * Checks whether the plugin is installed (its folder exists) and if it's active.
     * Returns a status label and a corresponding CSS class for UI display.
     *
     * @param string $slug The plugin slug.
     * @return array{label: string, css_class: string} Status label and CSS class.
     */
    public static function get_plugin_status(string $slug): array
    {
        $files       = self::get_plugin_files();
        $plugin_file = $files[$slug] ?? '';

        if (!is_dir(WP_PLUGIN_DIR . '/' . $slug)) {
            return [
                'label'     => __('Not Installed', 'enhanced-plugin-bundle'),
                'css_class' => 'ppm-status-danger',
            ];
        }
        return is_plugin_active($plugin_file)
            ? [
                'label'     => __('Installed & Active', 'enhanced-plugin-bundle'),
                'css_class' => 'ppm-status-success',
            ]
            : [
                'label'     => __('Installed & Deactivated', 'enhanced-plugin-bundle'),
                'css_class' => 'ppm-status-warning',
            ];
    }

    /**
     * Delegates plugin actions to the corresponding helper methods.
     *
     * Based on the action parameter (install, activate, deactivate, delete), calls
     * the appropriate internal function to perform the action.
     *
     * @param string $slug   The plugin slug.
     * @param string $action The action to perform.
     * @return void
     */
    public static function handle_plugin_action(string $slug, string $action): void
    {
        switch ($action) {
            case 'install':
                Installer::install($slug);
                break;
            case 'activate':
                Installer::activate($slug);
                break;
            case 'deactivate':
                Installer::deactivate($slug);
                break;
            case 'delete':
                Installer::delete($slug);
                break;
        }
    }

    /**
     * Checks if a plugin with the given slug exists in the dynamic list.
     *
     * @param string $slug The plugin slug.
     * @return bool True if the plugin exists, false otherwise.
     */
    public static function plugin_exists_in_list(string $slug): bool
    {
        $dynamic = Options::get();
        foreach ($dynamic as $plugin) {
            if ($plugin['slug'] === $slug) {
                return true;
            }
        }
        return false;
    }

    /**
     * Processes all form actions submitted from the admin interface.
     *
     * Handles plugin addition and bulk actions (including removing plugins from the tracked list)
     * by delegating to the respective processing methods.
     *
     * @return void
     */
    public static function handle_form_actions(): void
    {
        // Check user capability first (custom EPB capability with fallback).
        if (!Capabilities::current_user_can('epb_manage_plugins')) {
            return;
        }

        // Verify nonce for plugin actions.
        $nonce = isset($_POST['epb_plugin_nonce']) && is_string($_POST['epb_plugin_nonce'])
            ? sanitize_text_field(wp_unslash($_POST['epb_plugin_nonce']))
            : '';

        if (!wp_verify_nonce($nonce, 'epb_plugin_actions')) {
            if (isset($_POST['add_plugin']) || isset($_POST['bulk_action_submit'])) {
                Notices::error(__('Security check failed. Please try again.', 'enhanced-plugin-bundle'));
                Notices::save_queued_notices();
                wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
                exit;
            }
            return;
        }

        self::process_add_plugin();
        self::process_bulk_actions();
    }

    /**
     * Removes one or more plugins from the dynamic tracking list.
     *
     * Updates the stored option and queues a success notice, then redirects.
     *
     * @param array<int, string> $slugs List of plugin slugs to remove.
     * @return void
     */
    private static function remove_plugins_from_list(array $slugs): void
    {
        $sanitized = array_unique(array_filter(array_map('sanitize_text_field', $slugs)));
        if (empty($sanitized)) {
            return;
        }

        $dynamic        = Options::get();
        $original_count = count($dynamic);

        $dynamic = array_values(array_filter(
            $dynamic,
            static function ($plugin) use ($sanitized) {
                return !in_array($plugin['slug'], $sanitized, true);
            }
        ));

        if ($original_count === count($dynamic)) {
            return;
        }

        Options::update($dynamic);
        Notices::success(__('Selected plugin(s) removed from configuration.', 'enhanced-plugin-bundle'));
        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Processes the addition of a new plugin via a submitted URL.
     *
     * Validates the URL, extracts the plugin slug, checks for duplicates, fetches plugin info
     * from WordPress.org, and adds the plugin to the dynamic list if all validations pass.
     *
     * @return void
     */
    private static function process_add_plugin(): void
    {
        if (!isset($_POST['add_plugin'])) {
            return;
        }

        $url = isset($_POST['new_plugin_url']) && is_string($_POST['new_plugin_url'])
            ? sanitize_text_field(wp_unslash($_POST['new_plugin_url']))
            : '';

        if (empty($url)) {
            Notices::error(__('Please enter a plugin URL.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        $host = (string) parse_url($url, PHP_URL_HOST);
        $path = (string) parse_url($url, PHP_URL_PATH);
        if (!preg_match('/(^|\.)wordpress\.org$/i', $host) || strpos($path, '/plugins/') !== 0) {
            Notices::error(__('Please provide a valid WordPress.org plugin URL.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        $slug = self::extract_plugin_slug($url);
        if (!$slug) {
            Notices::error(__('Please provide a valid WordPress.org plugin URL.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        if (self::plugin_exists_in_list($slug)) {
            Notices::error(__('Plugin with that slug already exists.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        $plugin_info = self::fetch_plugin_info($slug);
        if (!$plugin_info) {
            Notices::error(__('Could not retrieve plugin information from WordPress.org.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        self::add_plugin_to_list($slug, $plugin_info['name']);
        Notices::success(__('New plugin added successfully.', 'enhanced-plugin-bundle'));
        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Extracts the plugin slug from a given WordPress.org plugin URL.
     *
     * The slug is typically the second segment of the URL path.
     *
     * @param string $url The plugin URL.
     * @return string|null The extracted plugin slug, or null if extraction fails.
     */
    private static function extract_plugin_slug(string $url): ?string
    {
        $parsed_url = parse_url($url, PHP_URL_PATH);
        $parts = explode('/', trim($parsed_url, '/'));

        return $parts[1] ?? null;
    }

    /**
     * Fetches plugin information from WordPress.org using the plugins API.
     *
     * Retrieves details such as the plugin's name and attempts to auto-detect the initialization file path.
     *
     * @param string $slug The plugin slug.
     * @return array|null An associative array with 'name' and 'init_path', or null on failure.
     */
    private static function fetch_plugin_info(string $slug): ?array
    {
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        $api = plugins_api('plugin_information', ['slug' => $slug]);
        if (is_wp_error($api)) {
            return null;
        }

        return [
            'name'      => $api->name,
            'init_path' => Installer::auto_detect_init_path($slug),
        ];
    }

    /**
     * Adds a new plugin to the dynamic list and updates the options.
     *
     * Appends the new plugin with its slug, name, and auto-detected initialization path
     * to the dynamic plugins list.
     *
     * @param string $slug The plugin slug.
     * @param string $name The plugin display name.
     * @return void
     */
    private static function add_plugin_to_list(string $slug, string $name): void
    {
        $dynamic = Options::get();
        $dynamic[] = [
            'slug'      => $slug,
            'name'      => $name,
            'init_path' => Installer::auto_detect_init_path($slug),
        ];

        Options::update($dynamic);
    }

    /**
     * Processes bulk actions on selected plugins from the admin form.
     *
     * Sanitizes input and applies the selected bulk action (install, activate, deactivate, or delete)
     * to each chosen plugin. Uses redirect-safe notice queuing.
     *
     * @return void
     */
    private static function process_bulk_actions(): void
    {
        if (!isset($_POST['bulk_action_submit'], $_POST['selected_plugins'])) {
            return;
        }
        $bulk_action      = isset($_POST['bulk_action']) && is_string($_POST['bulk_action'])
            ? sanitize_text_field(wp_unslash($_POST['bulk_action']))
            : '';
        $raw_plugins      = isset($_POST['selected_plugins']) && is_array($_POST['selected_plugins'])
            ? array_map('sanitize_text_field', wp_unslash($_POST['selected_plugins']))
            : [];
        $selected_plugins = array_unique(array_filter($raw_plugins));

        if (empty($selected_plugins)) {
            return;
        }

        if ('delete_from_list' === $bulk_action) {
            self::remove_plugins_from_list($selected_plugins);
            return;
        }

        // Use bulk methods for all actions - they handle queued notices and proper redirects.
        switch ($bulk_action) {
            case 'install':
                Installer::bulk_install($selected_plugins);
                break;
            case 'activate':
                Installer::bulk_activate($selected_plugins);
                break;
            case 'deactivate':
                Installer::bulk_deactivate($selected_plugins);
                break;
            case 'delete':
                Installer::bulk_delete($selected_plugins);
                break;
        }
    }

    /**
     * Renders bulk action controls.
     *
     * @return void
     */
    public static function render_bulk_controls(): void
    {
        Renderer::render_bulk_controls();
    }

    /**
     * Renders the complete plugins table.
     *
     * @param array<string, string> $plugins Associative array mapping plugin slug to display name.
     * @return void
     */
    public static function render_plugin_table(array $plugins): void
    {
        Renderer::render_plugin_table($plugins);
    }
}
