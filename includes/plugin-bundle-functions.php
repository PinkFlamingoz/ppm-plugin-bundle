<?php
if (! defined('ABSPATH')) {
    exit; // Prevent direct access for security reasons.
}
/**
 * Place for shared classes and functions.
 */


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
            // Display an error notice with the error message from the WP_Error object.
            self::print_notice(
                'error',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_ACTION_PLUGIN),
                    $action,
                    $slug,
                    $result->get_error_message()
                )
            );
        } else {
            // Display a success notice indicating the action completed successfully.
            self::print_notice(
                'success',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SUCCESS_ACTION_PLUGIN),
                    $slug,
                    $action
                )
            );
        }
    }
}
