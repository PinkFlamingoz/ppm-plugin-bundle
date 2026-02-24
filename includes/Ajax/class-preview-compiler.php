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

        // Check if debug mode requested.
        $debug = !empty($_POST['debug']);
        $debug_info = [];

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

            if ($debug) {
                $debug_info['component'] = $component;
                $debug_info['timestamp'] = gmdate('Y-m-d H:i:s');
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

            if ($debug) {
                $debug_info['overrides_count'] = count($sanitized_overrides);
                // Include a few sample override keys (not all, to keep response small).
                $debug_info['override_keys_sample'] = array_slice(array_keys($sanitized_overrides), 0, 20);
            }

            // Check if Less compiler is available.
            if (!Less_Compiler::is_available()) {
                wp_send_json_error([
                    'message'    => 'Less compiler not available. Please run: composer install',
                    'debug_info' => $debug ? $debug_info : null,
                ], 500);
            }

            // Build the Less source.
            $builder = new Component_Less_Builder();

            if ($debug) {
                $requirements = $builder->check_requirements();
                $debug_info['requirements_check'] = $requirements === true ? 'OK' : $requirements;

                // Check UIkit component file existence.
                $uikit_path = WP_CONTENT_DIR . '/themes/yootheme/vendor/assets/uikit/src/less/components/' . $component . '.less';
                $debug_info['uikit_component_file'] = $uikit_path;
                $debug_info['uikit_component_exists'] = file_exists($uikit_path);
            }

            $less_source = $builder->build_for_preview($component, $sanitized_overrides);

            if ($less_source === false) {
                if ($debug) {
                    $debug_info['build_result'] = 'false (failed)';
                }
                wp_send_json_error([
                    'message'    => 'Failed to build Less source for component: ' . $component,
                    'debug_info' => $debug ? $debug_info : null,
                ], 400);
            }

            if ($debug) {
                $debug_info['less_source_length'] = strlen($less_source);
                // Show first/last 200 chars of Less source for debugging.
                $debug_info['less_source_head'] = substr($less_source, 0, 300);
                $debug_info['less_source_tail'] = substr($less_source, -300);
            }

            // Compile the Less.
            $compiler = new Less_Compiler([
                'compress' => false,
            ]);

            $css = $compiler->compile($less_source);

            if ($css === false) {
                $error = $compiler->get_error();
                $error_context = [];

                // Always extract error context on compilation failure.
                if (preg_match('/index:\s*(\d+)/', $error, $idx_match)) {
                    $err_idx = (int) $idx_match[1];
                    // Use the preprocessed source since the error index refers to
                    // the source after preprocessing (what the parser actually sees).
                    $pp_source = $compiler->get_preprocessed_source();
                    $use_source = !empty($pp_source) ? $pp_source : $less_source;
                    $start = max(0, $err_idx - 300);
                    $error_context['error_index'] = $err_idx;
                    $error_context['source_around_error'] = substr($use_source, $start, 600);
                    $error_context['source_around_start'] = $start;

                    // Find the line number.
                    $before_error = substr($use_source, 0, $err_idx);
                    $line_number = substr_count($before_error, "\n") + 1;
                    $error_context['error_line_number'] = $line_number;

                    // Show the specific line.
                    $lines = explode("\n", $use_source);
                    if (isset($lines[$line_number - 1])) {
                        $error_context['error_line'] = $lines[$line_number - 1];
                    }
                    // Show 5 lines before and after.
                    $context_start = max(0, $line_number - 6);
                    $context_end = min(count($lines) - 1, $line_number + 5);
                    $error_context['error_context_lines'] = [];
                    for ($cl = $context_start; $cl <= $context_end; $cl++) {
                        $prefix = ($cl === $line_number - 1) ? '>>> ' : '    ';
                        $error_context['error_context_lines'][] = $prefix . ($cl + 1) . ': ' . $lines[$cl];
                    }
                }

                if ($debug) {
                    $debug_info['compile_error'] = $error;
                    $debug_info = array_merge($debug_info, $error_context);
                }

                wp_send_json_error([
                    'message'       => 'Less compilation failed: ' . $error,
                    'error_context' => $error_context,
                    'debug_info'    => $debug ? $debug_info : null,
                ], 500);
            }

            if ($debug) {
                $debug_info['css_length'] = strlen($css);
            }

            // Return the compiled CSS.
            $response = [
                'css'       => $css,
                'component' => $component,
                'variables' => count($sanitized_overrides),
            ];

            if ($debug) {
                $response['debug_info'] = $debug_info;
            }

            wp_send_json_success($response);
        } catch (\Throwable $e) {
            if ($debug) {
                $debug_info['exception_class'] = get_class($e);
                $debug_info['exception_message'] = $e->getMessage();
                $debug_info['exception_file'] = $e->getFile() . ':' . $e->getLine();
                $debug_info['exception_trace'] = array_slice(
                    array_map(function ($frame) {
                        return ($frame['file'] ?? '?') . ':' . ($frame['line'] ?? '?') . ' ' . ($frame['class'] ?? '') . ($frame['type'] ?? '') . ($frame['function'] ?? '');
                    }, $e->getTrace()),
                    0,
                    10
                );
            }
            wp_send_json_error([
                'message'    => 'PHP Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
                'debug_info' => $debug ? $debug_info : null,
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
