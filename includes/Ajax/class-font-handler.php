<?php

/**
 * Font AJAX Handler for Enhanced Plugin Bundle.
 *
 * Handles font upload and deletion via AJAX.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.4.0
 */

namespace EPB\Ajax;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\Core\Constants;
use EPB\Core\Custom_Font;

/**
 * Class Font_Handler
 *
 * Manages AJAX operations for custom font uploads and management.
 */
class Font_Handler
{
    /**
     * Register AJAX handlers.
     *
     * @return void
     */
    public static function register(): void
    {
        add_action('wp_ajax_epb_upload_custom_font', [self::class, 'upload_font']);
        add_action('wp_ajax_epb_delete_custom_font', [self::class, 'delete_font']);
        add_action('wp_ajax_epb_update_custom_font', [self::class, 'update_font']);
        add_action('wp_ajax_epb_get_custom_fonts', [self::class, 'get_fonts']);
    }

    /**
     * Upload a custom font file via AJAX.
     *
     * @return void
     */
    public static function upload_font(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        // Validate file was sent.
        if (empty($_FILES['font_file'])) {
            wp_send_json_error(['message' => __('No font file was uploaded.', 'enhanced-plugin-bundle')]);
            return;
        }

        $family  = sanitize_text_field(wp_unslash($_POST['font_family'] ?? ''));
        $weights = sanitize_text_field(wp_unslash($_POST['font_weights'] ?? 'normal'));
        $style   = sanitize_text_field(wp_unslash($_POST['font_style'] ?? 'normal'));

        if (empty($family)) {
            wp_send_json_error(['message' => __('Font family name is required.', 'enhanced-plugin-bundle')]);
            return;
        }

        $result = Custom_Font::upload($_FILES['font_file'], $family, $weights, $style);

        if ($result['success']) {
            // Trigger CSS regeneration so child theme gets updated @font-face rules.
            Component_Handler::regenerate_css();

            wp_send_json_success([
                'message' => $result['message'],
                'font'    => $result['font'],
                'fonts'   => Custom_Font::get_fonts(),
            ]);
        } else {
            wp_send_json_error(['message' => $result['message']]);
        }
    }

    /**
     * Delete a custom font via AJAX.
     *
     * @return void
     */
    public static function delete_font(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $font_id = sanitize_text_field(wp_unslash($_POST['font_id'] ?? ''));

        if (empty($font_id)) {
            wp_send_json_error(['message' => __('Font ID is required.', 'enhanced-plugin-bundle')]);
            return;
        }

        $result = Custom_Font::delete($font_id);

        if ($result['success']) {
            // Trigger CSS regeneration.
            Component_Handler::regenerate_css();

            wp_send_json_success([
                'message' => $result['message'],
                'fonts'   => Custom_Font::get_fonts(),
            ]);
        } else {
            wp_send_json_error(['message' => $result['message']]);
        }
    }

    /**
     * Update a custom font's weights and style via AJAX.
     *
     * @return void
     */
    public static function update_font(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $font_id = sanitize_text_field(wp_unslash($_POST['font_id'] ?? ''));
        $weights = sanitize_text_field(wp_unslash($_POST['font_weights'] ?? 'normal'));
        $style   = sanitize_text_field(wp_unslash($_POST['font_style'] ?? 'normal'));

        if (empty($font_id)) {
            wp_send_json_error(['message' => __('Font ID is required.', 'enhanced-plugin-bundle')]);
            return;
        }

        $result = Custom_Font::update($font_id, $weights, $style);

        if ($result['success']) {
            // Trigger CSS regeneration so child theme gets updated @font-face rules.
            Component_Handler::regenerate_css();

            wp_send_json_success([
                'message' => $result['message'],
                'font'    => $result['font'],
                'fonts'   => Custom_Font::get_fonts(),
            ]);
        } else {
            wp_send_json_error(['message' => $result['message']]);
        }
    }

    /**
     * Get all custom fonts via AJAX.
     *
     * @return void
     */
    public static function get_fonts(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        wp_send_json_success([
            'fonts'    => Custom_Font::get_fonts(),
            'families' => Custom_Font::get_font_families(),
        ]);
    }
}
