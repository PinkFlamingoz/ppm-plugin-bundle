<?php

/**
 * Token importer for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Tokens
 */

namespace EPB\Tokens;

use EPB\CSS\Options as CSSOptions;
use WP_Error;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Importer
 *
 * Handles importing design tokens from Tokens Studio JSON format
 * and converting them to the plugin's CSS options format.
 */
class Importer
{
    /**
     * Processes an uploaded token JSON file.
     *
     * @param array $file The uploaded file from $_FILES.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public static function process_upload(array $file): bool|WP_Error
    {
        // Check for upload errors.
        if (!empty($file['error']) && $file['error'] !== UPLOAD_ERR_OK) {
            return new WP_Error(
                'upload_error',
                sprintf(
                    /* translators: %s: error code */
                    __('File upload failed with error code: %s', 'enhanced-plugin-bundle'),
                    esc_html($file['error'])
                )
            );
        }

        // Validate file type.
        $file_type = wp_check_filetype(basename($file['name']), ['json' => 'application/json']);
        if (empty($file_type['ext']) || 'json' !== $file_type['ext']) {
            return new WP_Error(
                'invalid_type',
                __('Invalid file type. Please upload a JSON file.', 'enhanced-plugin-bundle')
            );
        }

        // Read file contents.
        $json_content = file_get_contents($file['tmp_name']);
        if (false === $json_content) {
            return new WP_Error(
                'read_error',
                __('Failed to read the uploaded file.', 'enhanced-plugin-bundle')
            );
        }

        // Parse JSON.
        $tokens = json_decode($json_content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error(
                'parse_error',
                sprintf(
                    /* translators: %s: JSON error message */
                    __('Failed to parse JSON: %s', 'enhanced-plugin-bundle'),
                    json_last_error_msg()
                )
            );
        }

        // Transform and save tokens.
        return self::import($tokens);
    }

    /**
     * Imports tokens from Tokens Studio format and saves them.
     *
     * @param array $tokens The parsed token data.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public static function import(array $tokens): bool|WP_Error
    {
        $transformed = self::transform($tokens);

        if (empty($transformed)) {
            return new WP_Error(
                'empty_tokens',
                __('No valid tokens found in the uploaded file.', 'enhanced-plugin-bundle')
            );
        }

        // Get current options and merge with transformed tokens.
        $current_options = CSSOptions::get();
        $merged_options  = array_merge($current_options, $transformed);

        // Save the merged options.
        CSSOptions::save($merged_options);

        // Log import if debugging.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Imported ' . count($transformed) . ' tokens successfully.');
        }

        return true;
    }

    /**
     * Transforms Tokens Studio format to plugin options format.
     *
     * @param array $tokens The Tokens Studio token data.
     * @return array The transformed options.
     */
    public static function transform(array $tokens): array
    {
        $options = [];
        $mapping = Mapper::get_mapping();

        foreach ($mapping as $plugin_key => $token_path) {
            $value = Mapper::get_nested_value($tokens, $token_path);
            if (null !== $value) {
                $options[$plugin_key] = $value;
            }
        }

        return $options;
    }

    /**
     * Validates a token structure.
     *
     * @param array $tokens The token data to validate.
     * @return bool|WP_Error True if valid, WP_Error if invalid.
     */
    public static function validate(array $tokens): bool|WP_Error
    {
        if (empty($tokens)) {
            return new WP_Error(
                'empty_tokens',
                __('Token file is empty.', 'enhanced-plugin-bundle')
            );
        }

        // Check for at least one recognized top-level key.
        $valid_keys = ['colors', 'breakpoints', 'spacing', 'sizing', 'typography'];
        $has_valid_key = false;

        foreach ($valid_keys as $key) {
            if (isset($tokens[$key]) && is_array($tokens[$key])) {
                $has_valid_key = true;
                break;
            }
        }

        if (!$has_valid_key) {
            return new WP_Error(
                'invalid_structure',
                __('Token file does not contain recognized token categories.', 'enhanced-plugin-bundle')
            );
        }

        return true;
    }
}
