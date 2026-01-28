<?php

/**
 * Plugin installer for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Plugins
 */

namespace EPB\Plugins;

use EPB\Core\Notices;
use WP_Error;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Installer
 *
 * Handles plugin installation, activation, deactivation, and deletion operations.
 * Supports both immediate (single) and queued (bulk) notice modes.
 */
class Installer
{
    /**
     * Installs a plugin if not already present and updates its init path.
     *
     * @param string $slug  The plugin slug.
     * @param bool   $queue Whether to queue notices for redirect (bulk mode).
     * @return bool True if installed successfully or already installed.
     */
    public static function install(string $slug, bool $queue = false): bool
    {
        if (!Manager::plugin_exists_in_list($slug)) {
            $message = sprintf(
                /* translators: %s: plugin slug */
                __('Plugin "%s" is not managed by this bundle.', 'enhanced-plugin-bundle'),
                $slug
            );
            $queue ? Notices::error($message) : Notices::print_notice('error', $message);
            return false;
        }

        $already_installed = is_dir(WP_PLUGIN_DIR . '/' . $slug);

        if (!$already_installed) {
            $result = self::download_and_install($slug);

            if (is_wp_error($result)) {
                Notices::display_action_result($slug, $result, 'install', $queue);
                return false;
            }
        }

        // Update the initialization path after installation.
        $dynamic = Options::get();
        foreach ($dynamic as &$plugin) {
            if ($plugin['slug'] === $slug) {
                $detected = self::auto_detect_init_path($slug);
                if (!empty($detected)) {
                    $plugin['init_path'] = $detected;
                }
            }
        }

        Options::update($dynamic);

        if ($already_installed) {
            $message = sprintf(
                /* translators: %s: plugin slug */
                __('Plugin "%s" is already installed.', 'enhanced-plugin-bundle'),
                $slug
            );
            $queue ? Notices::success($message) : Notices::print_notice('success', $message);
            return true;
        }

        Notices::display_action_result($slug, true, 'install', $queue);
        return true;
    }

    /**
     * Downloads and installs a plugin from WordPress.org.
     *
     * @param string $slug The plugin slug.
     * @return true|WP_Error Result of the installation attempt.
     */
    public static function download_and_install(string $slug): true|WP_Error
    {
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $api = plugins_api('plugin_information', ['slug' => $slug]);
        if (is_wp_error($api)) {
            self::log_error('Failed to fetch plugin info for: ' . $slug . ' - ' . $api->get_error_message());
            return $api;
        }

        $upgrader = new \Plugin_Upgrader(new \Automatic_Upgrader_Skin());
        $result   = $upgrader->install($api->download_link);

        if (is_wp_error($result)) {
            self::log_error('Failed to install plugin: ' . $slug . ' - ' . $result->get_error_message());
            return $result;
        }

        if (true !== $result) {
            self::log_error('Plugin installation returned non-true result for: ' . $slug);
            return new WP_Error(
                'plugin_install_failed',
                sprintf(
                    /* translators: %s: plugin slug */
                    __('Failed to install plugin "%s".', 'enhanced-plugin-bundle'),
                    $slug
                )
            );
        }

        self::log_info('Successfully installed plugin: ' . $slug);
        return true;
    }

    /**
     * Activates a plugin if it is installed and currently inactive.
     *
     * Uses silent activation to prevent plugin hooks from firing during bulk operations.
     *
     * @param string $slug   The plugin slug.
     * @param bool   $silent Whether to use silent activation (default: true).
     * @param bool   $queue  Whether to queue notices for redirect (bulk mode).
     * @return bool True if activated successfully.
     */
    public static function activate(string $slug, bool $silent = true, bool $queue = false): bool
    {
        $plugin_file = Manager::resolve_plugin_file($slug, $queue);
        if (null === $plugin_file) {
            return false;
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            self::install($slug, $queue);

            $plugin_file = Manager::resolve_plugin_file($slug, $queue);
            if (null === $plugin_file) {
                return false;
            }

            if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
                $message = sprintf(
                    /* translators: %s: plugin slug */
                    __('Plugin "%s" is not installed.', 'enhanced-plugin-bundle'),
                    $slug
                );
                $queue ? Notices::error($message) : Notices::print_notice('error', $message);
                return false;
            }
        }

        if (is_plugin_inactive($plugin_file)) {
            $result = activate_plugin($plugin_file, '', false, $silent);
            Notices::display_action_result($slug, $result, 'activate', $queue);
            return !is_wp_error($result);
        }

        return true;
    }

    /**
     * Deactivates an active plugin.
     *
     * @param string $slug  The plugin slug.
     * @param bool   $queue Whether to queue notices for redirect (bulk mode).
     * @return bool True if deactivated successfully.
     */
    public static function deactivate(string $slug, bool $queue = false): bool
    {
        $plugin_file = Manager::resolve_plugin_file($slug, $queue);
        if (null === $plugin_file) {
            return false;
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            $message = sprintf(
                /* translators: %s: plugin slug */
                __('Plugin "%s" is not installed.', 'enhanced-plugin-bundle'),
                $slug
            );
            $queue ? Notices::error($message) : Notices::print_notice('error', $message);
            return false;
        }

        if (is_plugin_active($plugin_file)) {
            $result = deactivate_plugins($plugin_file);
            Notices::display_action_result($slug, $result, 'deactivate', $queue);
            return true;
        }

        return true;
    }

    /**
     * Deletes a plugin from the system.
     *
     * First deactivates the plugin and then deletes it.
     *
     * @param string $slug  The plugin slug.
     * @param bool   $queue Whether to queue notices for redirect (bulk mode).
     * @return bool True if deletion was successful.
     */
    public static function delete(string $slug, bool $queue = false): bool
    {
        $plugin_file = Manager::resolve_plugin_file($slug, $queue);
        if (null === $plugin_file) {
            return false;
        }

        $plugin_full_path = WP_PLUGIN_DIR . '/' . $plugin_file;

        if (!file_exists($plugin_full_path)) {
            $message = sprintf(
                /* translators: %s: plugin slug */
                __('Plugin "%s" was already removed.', 'enhanced-plugin-bundle'),
                $slug
            );
            $queue ? Notices::success($message) : Notices::print_notice('success', $message);
            return true;
        }

        if (is_plugin_active($plugin_file)) {
            deactivate_plugins($plugin_file, true); // Silent deactivation.
        }

        if (!function_exists('delete_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        if (!class_exists('Plugin_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $result = delete_plugins([$plugin_file]);
        if (is_wp_error($result)) {
            $message = sprintf(
                /* translators: 1: action name, 2: plugin slug, 3: error message */
                __('Failed to %1$s "%2$s": %3$s', 'enhanced-plugin-bundle'),
                'delete',
                $slug,
                $result->get_error_message()
            );
            $queue ? Notices::error($message) : Notices::print_notice('error', $message);
            return false;
        }

        Notices::display_action_result($slug, true, 'delete', $queue);
        return true;
    }

    /**
     * Bulk install plugins.
     *
     * @param array<string> $slugs Array of plugin slugs to install.
     * @return void
     */
    public static function bulk_install(array $slugs): void
    {
        if (empty($slugs)) {
            return;
        }

        // Buffer output to suppress any PHP warnings from WordPress core or plugins
        ob_start();

        foreach ($slugs as $slug) {
            self::install($slug, true);
        }

        // Discard any buffered output (warnings, notices, etc.)
        ob_end_clean();

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Bulk activate plugins.
     *
     * @param array<string> $slugs Array of plugin slugs to activate.
     * @return void
     */
    public static function bulk_activate(array $slugs): void
    {
        if (empty($slugs)) {
            return;
        }

        // Buffer output to suppress any PHP warnings from WordPress core or plugins
        ob_start();

        foreach ($slugs as $slug) {
            self::activate($slug, true, true);
        }

        // Discard any buffered output (warnings, notices, etc.)
        ob_end_clean();

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Bulk deactivate plugins.
     *
     * @param array<string> $slugs Array of plugin slugs to deactivate.
     * @return void
     */
    public static function bulk_deactivate(array $slugs): void
    {
        if (empty($slugs)) {
            return;
        }

        // Buffer output to suppress any PHP warnings from WordPress core or plugins
        ob_start();

        foreach ($slugs as $slug) {
            self::deactivate($slug, true);
        }

        // Discard any buffered output (warnings, notices, etc.)
        ob_end_clean();

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Bulk delete plugins.
     *
     * @param array<string> $slugs Array of plugin slugs to delete.
     * @return void
     */
    public static function bulk_delete(array $slugs): void
    {
        if (empty($slugs)) {
            return;
        }

        // Buffer output to suppress any PHP warnings from WordPress core or plugins
        ob_start();

        foreach ($slugs as $slug) {
            self::delete($slug, true);
        }

        // Discard any buffered output (warnings, notices, etc.)
        ob_end_clean();

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Auto-detects a plugin's initialization file path.
     *
     * @param string $slug The plugin slug.
     * @return string The detected initialization file path, or empty string.
     */
    public static function auto_detect_init_path(string $slug): string
    {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $all_plugins = get_plugins();
        foreach ($all_plugins as $plugin_file => $plugin_data) {
            if (strpos($plugin_file, $slug . '/') === 0) {
                return $plugin_file;
            }
        }
        return '';
    }

    /**
     * Logs an error message if WP_DEBUG is enabled.
     *
     * @param string $message The error message to log.
     * @return void
     */
    private static function log_error(string $message): void
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB Error] ' . $message);
        }
    }

    /**
     * Logs an info message if WP_DEBUG is enabled.
     *
     * @param string $message The info message to log.
     * @return void
     */
    private static function log_info(string $message): void
    {
        if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            error_log('[EPB Info] ' . $message);
        }
    }
}
