<?php
if (! defined('ABSPATH')) {
    exit; // Prevent direct access for security reasons.
}
/**
 * Place for shared classes and functions.
 */

if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('esc_url')) {
    function esc_url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL) ?: '';
    }
}

if (!function_exists('is_wp_error')) {
    function is_wp_error($thing)
    {
        return false;
    }
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $accepted_args = 1)
    {
        return true;
    }
}

if (!function_exists('add_menu_page')) {
    function add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '', $position = null)
    {
        return true;
    }
}

if (!function_exists('wp_enqueue_style')) {
    function wp_enqueue_style($handle, $src = '', $deps = [], $ver = false, $media = 'all')
    {
        return true;
    }
}

if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle, $src = '', $deps = [], $ver = false, $in_footer = false)
    {
        return true;
    }
}

if (!function_exists('wp_localize_script')) {
    function wp_localize_script($handle, $object_name, $l10n)
    {
        return true;
    }
}


/**
 * Class Plugin_Bundle_Plugins_Notices
 *
 * Handles the display of administrative notices for plugin actions.
 * It provides methods to output success or error messages in the admin interface.
 */
class Plugin_Bundle_Plugins_Notices
{
    /**
     * Outputs a formatted notice message in the admin area.
     *
     * Displays a dismissible notice styled according to the message type.
     *
     * @param string $type    The type of notice ('success' or 'error').
     * @param string $message The message content to display.
     * @return void
     */
    public static function print_notice(string $type, string $message): void
    {
        // Determine the CSS class based on the notice type.
        $class = ('error' === $type) ? 'notice-error' : 'notice-success';
        // Output the formatted notice HTML.
        printf(
            '<div class="notice %s is-dismissible"><p>%s</p></div>',
            esc_attr($class),
            esc_html($message)
        );
    }

    /**
     * Displays the result of a plugin action in the admin interface.
     *
     * Checks whether the action returned an error or was successful, and prints
     * an appropriate notice message styled accordingly.
     *
     * @param string $slug   The plugin slug (identifier).
     * @param mixed  $result The result of the action; either true or a WP_Error object.
     * @param string $action The action that was attempted (e.g., 'activate', 'deactivate').
     * @return void
     */
    public static function display_action_result(string $slug, $result, string $action): void
    {
        if (is_wp_error($result)) {
            self::print_notice(
                'error',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_ACTION_PLUGIN),
                    $action,
                    $slug,
                    $result->get_error_message()
                )
            );

            return;
        }

        $action_key = strtolower($action);
        $success_actions = [
            'install'    => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTION_PAST_INSTALLED),
            'activate'   => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTION_PAST_ACTIVATED),
            'deactivate' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTION_PAST_DEACTIVATED),
            'delete'     => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTION_PAST_DELETED),
            'upload'     => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTION_PAST_UPLOADED),
        ];

        $success_action = $success_actions[$action_key] ?? $action;

        self::print_notice(
            'success',
            sprintf(
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SUCCESS_ACTION_PLUGIN),
                $slug,
                $success_action
            )
        );
    }
}
