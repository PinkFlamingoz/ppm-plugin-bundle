<?php

/**
 * Preview Compiler AJAX Handler.
 *
 * Handles AJAX requests for server-side Less compilation for live preview.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.2.0
 */

namespace EPB\Ajax;

use EPB\CSS\Less_Compiler;
use EPB\CSS\Component_Less_Builder;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Preview_Compiler
 *
 * Handles live preview compilation via AJAX.
 */
class Preview_Compiler
{

    /**
     * Register AJAX actions.
     *
     * @return void
     */
    public static function register(): void
    {
        add_action('wp_ajax_epb_compile_preview', [self::class, 'compile']);
    }

    /**
     * Handle the compilation request.
     *
     * Expected POST data:
     * - nonce: Security nonce
     * - component: Component name (e.g., 'button')
     * - overrides: JSON string of variable overrides
     *
     * @return void
     */
    public static function compile(): void
    {
        // Enable error reporting for debugging.
        error_reporting(E_ALL);
        ini_set('display_errors', '0');

        try {
            // Verify nonce.
            if (!Handler::verify_nonce()) {
                wp_send_json_error([
                    'message' => 'Security check failed.',
                ], 403);
            }

            // Check capabilities.
            if (!current_user_can('manage_options')) {
                wp_send_json_error([
                    'message' => 'Insufficient permissions.',
                ], 403);
            }

            // Get component name.
            $component = isset($_POST['component']) ? sanitize_key($_POST['component']) : '';
            if (empty($component)) {
                wp_send_json_error([
                    'message' => 'Component name is required.',
                ], 400);
            }

            // Get variable overrides.
            $overrides = [];
            if (isset($_POST['overrides']) && is_string($_POST['overrides'])) {
                $overrides_json = sanitize_text_field(wp_unslash($_POST['overrides']));
                $overrides = json_decode($overrides_json, true);
                if (!is_array($overrides)) {
                    $overrides = [];
                }
            }

            // Sanitize override values.
            $sanitized_overrides = self::sanitize_overrides($overrides);

            // Check if Less compiler is available.
            if (!Less_Compiler::is_available()) {
                wp_send_json_error([
                    'message' => 'Less compiler not available. Please run: composer install',
                ], 500);
            }

            // Build the Less source.
            $builder = new Component_Less_Builder();
            $less_source = $builder->build_for_preview($component, $sanitized_overrides);

            if ($less_source === false) {
                wp_send_json_error([
                    'message' => 'Failed to build Less source for component: ' . $component,
                ], 400);
            }

            // Compile the Less.
            $compiler = new Less_Compiler([
                'compress' => false,
            ]);

            $css = $compiler->compile($less_source);

            if ($css === false) {
                wp_send_json_error([
                    'message' => 'Less compilation failed: ' . $compiler->get_error(),
                ], 500);
            }

            // Return the compiled CSS.
            wp_send_json_success([
                'css'       => $css,
                'component' => $component,
                'variables' => count($sanitized_overrides),
            ]);
        } catch (\Throwable $e) {
            wp_send_json_error([
                'message' => 'PHP Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
            ], 500);
        }
    }

    /**
     * Sanitize variable overrides.
     *
     * @param array $overrides Raw overrides from request.
     * @return array Sanitized overrides.
     */
    private static function sanitize_overrides(array $overrides): array
    {
        $sanitized = [];

        foreach ($overrides as $name => $value) {
            // Sanitize variable name (alphanumeric, dash, underscore).
            $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
            if (empty($name)) {
                continue;
            }

            // Sanitize value (basic CSS value sanitization).
            // Allow common CSS characters but prevent injection.
            $value = trim($value);

            // Remove any semicolons, braces, or comments that could break CSS.
            $value = preg_replace('/[;{}]/', '', $value);
            $value = preg_replace('/\/\*.*?\*\//s', '', $value);

            // Limit length.
            if (strlen($value) > 500) {
                $value = substr($value, 0, 500);
            }

            if (!empty($value)) {
                $sanitized[$name] = $value;
            }
        }

        return $sanitized;
    }
}
