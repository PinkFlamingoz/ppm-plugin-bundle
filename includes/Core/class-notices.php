<?php

/**
 * Admin notices handler for Enhanced Plugin Bundle.
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
 * Class Notices
 *
 * Handles the display of administrative notices for plugin and theme actions.
 * Supports both immediate output and queued notices for redirect-safe operations.
 */
class Notices
{
    /**
     * The transient key prefix for storing notices.
     */
    private const TRANSIENT_PREFIX = 'epb_notices_';

    /**
     * Notices queued for display after redirect.
     *
     * @var array<int, array{type: string, message: string}>
     */
    private static array $queued_notices = [];

    /**
     * Initializes the notices system.
     *
     * Hooks into current_screen to suppress other plugin notices on our page.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('current_screen', [self::class, 'maybe_suppress_notices']);
    }

    /**
     * Suppresses all admin notices on our plugin page.
     *
     * Other plugins may add notices that interfere with our layout.
     * We remove all notice hooks on our page - our notices are shown via header.php.
     *
     * @return void
     */
    public static function maybe_suppress_notices(): void
    {
        $screen = get_current_screen();
        if (!$screen || 'toplevel_page_plugin-bundle-settings' !== $screen->id) {
            return;
        }

        // Remove all admin_notices hooks to prevent other plugins from outputting notices.
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
    }

    /**
     * Outputs a formatted notice message immediately.
     *
     * Use this only when you're certain no redirect will follow.
     * For redirect-safe operations, use queue_notice() instead.
     * The 'inline' class prevents WordPress from relocating the notice.
     *
     * @param string $type    The type of notice ('success', 'error', or 'warning').
     * @param string $message The message content to display.
     * @return void
     */
    public static function print_notice(string $type, string $message): void
    {
        $class_map = [
            'error'   => 'notice-error',
            'warning' => 'notice-warning',
            'success' => 'notice-success',
        ];
        $class = $class_map[$type] ?? 'notice-success';

        // 'inline' class prevents WordPress JS from relocating the notice after h1/h2
        printf(
            '<div class="notice %s is-dismissible inline"><p>%s</p></div>',
            esc_attr($class),
            esc_html($message)
        );
    }

    /**
     * Queues a notice for display after redirect.
     *
     * Use this for bulk operations or any action that will redirect.
     * The notice will be stored in a transient and displayed on the next page load.
     *
     * @param string $type    The type of notice ('success', 'error', or 'warning').
     * @param string $message The message content to display.
     * @return void
     */
    public static function queue_notice(string $type, string $message): void
    {
        self::$queued_notices[] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Saves all queued notices to a transient for display after redirect.
     *
     * Call this before wp_safe_redirect() to persist notices.
     *
     * @return void
     */
    public static function save_queued_notices(): void
    {
        if (empty(self::$queued_notices)) {
            return;
        }

        $user_id      = get_current_user_id();
        $transient_key = self::TRANSIENT_PREFIX . $user_id;

        // Merge with any existing notices (in case of multiple operations).
        $existing = get_transient($transient_key);
        if (is_array($existing)) {
            self::$queued_notices = array_merge($existing, self::$queued_notices);
        }

        set_transient($transient_key, self::$queued_notices, 60);
        self::$queued_notices = [];
    }

    /**
     * Displays queued notices from transient on admin_notices hook.
     *
     * Automatically clears the transient after display.
     *
     * @return void
     */
    public static function display_queued_notices(): void
    {
        $user_id       = get_current_user_id();
        $transient_key = self::TRANSIENT_PREFIX . $user_id;
        $notices       = get_transient($transient_key);

        if (!is_array($notices) || empty($notices)) {
            return;
        }

        // Delete transient immediately to prevent duplicate display.
        delete_transient($transient_key);

        foreach ($notices as $notice) {
            if (isset($notice['type'], $notice['message'])) {
                self::print_notice($notice['type'], $notice['message']);
            }
        }
    }

    /**
     * Displays the result of an action.
     *
     * When $queue is true, stores the notice for display after redirect.
     * When $queue is false, outputs the notice immediately.
     *
     * @param string $slug   The item slug (plugin or theme identifier).
     * @param mixed  $result The result of the action; either true or a WP_Error object.
     * @param string $action The action that was attempted (e.g., 'activate', 'deactivate').
     * @param bool   $queue  Whether to queue the notice for redirect (default: false).
     * @return void
     */
    public static function display_action_result(string $slug, $result, string $action, bool $queue = false): void
    {
        if (is_wp_error($result)) {
            $message = sprintf(
                /* translators: 1: action name, 2: item slug, 3: error message */
                __('Failed to %1$s "%2$s": %3$s', 'enhanced-plugin-bundle'),
                $action,
                $slug,
                $result->get_error_message()
            );

            if ($queue) {
                self::queue_notice('error', $message);
            } else {
                self::print_notice('error', $message);
            }

            return;
        }

        $action_key      = strtolower($action);
        $success_actions = [
            'install'    => __('installed', 'enhanced-plugin-bundle'),
            'activate'   => __('activated', 'enhanced-plugin-bundle'),
            'deactivate' => __('deactivated', 'enhanced-plugin-bundle'),
            'delete'     => __('deleted', 'enhanced-plugin-bundle'),
            'upload'     => __('uploaded', 'enhanced-plugin-bundle'),
        ];

        $success_action = $success_actions[$action_key] ?? $action;

        $message = sprintf(
            /* translators: 1: item slug, 2: action past tense */
            __('"%1$s" %2$s successfully.', 'enhanced-plugin-bundle'),
            $slug,
            $success_action
        );

        if ($queue) {
            self::queue_notice('success', $message);
        } else {
            self::print_notice('success', $message);
        }
    }

    /**
     * Helper to add a success notice to the queue.
     *
     * @param string $message The success message.
     * @return void
     */
    public static function success(string $message): void
    {
        self::queue_notice('success', $message);
    }

    /**
     * Helper to add an error notice to the queue.
     *
     * @param string $message The error message.
     * @return void
     */
    public static function error(string $message): void
    {
        self::queue_notice('error', $message);
    }

    /**
     * Helper to add a warning notice to the queue.
     *
     * @param string $message The warning message.
     * @return void
     */
    public static function warning(string $message): void
    {
        self::queue_notice('warning', $message);
    }
}
