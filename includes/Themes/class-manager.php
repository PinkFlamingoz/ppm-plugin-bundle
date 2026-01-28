<?php

/**
 * Theme manager for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Themes
 */

namespace EPB\Themes;

use EPB\Core\Notices;
use EPB\CSS\Options as CSSOptions;
use EPB\Tokens\Importer as TokenImporter;
use EPB\Themes\Renderer\Main_Renderer;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Manager
 *
 * Orchestrates theme-related operations including parent theme uploads,
 * child theme creation, and token imports.
 */
class Manager
{
    /**
     * Parent theme slug.
     *
     * @var string
     */
    public const PARENT_THEME_SLUG = 'yootheme';

    /**
     * Processes form submissions from the theme manager admin page.
     *
     * Handles parent theme uploads and child theme creation.
     * For parent themes, it processes file uploads.
     * For child themes, it saves CSS options and then creates and activates a child theme.
     *
     * @return void
     */
    public static function handle_form_actions(): void
    {
        // Check user capability first (custom EPB capability with fallback).
        if (!epb_current_user_can('epb_manage_themes')) {
            return;
        }

        // Process parent theme upload if a file is provided.
        if (isset($_POST['upload_theme']) && isset($_FILES['theme_zip']) && is_array($_FILES['theme_zip'])) {
            self::handle_parent_theme_upload();
        }

        // Process child theme creation.
        if (isset($_POST['create_child_theme'])) {
            self::handle_child_theme_creation();
        }

        // Process token import.
        if (isset($_POST['import_tokens']) && isset($_FILES['tokens_json']) && is_array($_FILES['tokens_json'])) {
            self::handle_token_import();
        }
    }

    /**
     * Handles parent theme file upload.
     *
     * @return void
     */
    private static function handle_parent_theme_upload(): void
    {
        // Verify nonce for theme upload.
        $theme_nonce = isset($_POST['epb_theme_nonce']) && is_string($_POST['epb_theme_nonce'])
            ? sanitize_text_field(wp_unslash($_POST['epb_theme_nonce']))
            : '';

        if (!wp_verify_nonce($theme_nonce, 'epb_upload_theme')) {
            Notices::error(__('Security check failed. Please try again.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        // Use WordPress wp_handle_upload() which requires the original $_FILES array.
        Uploader::upload_parent_theme($_FILES['theme_zip']);
    }

    /**
     * Handles child theme creation request.
     *
     * @return void
     */
    private static function handle_child_theme_creation(): void
    {
        // Verify nonce for child theme creation.
        $child_nonce = isset($_POST['epb_child_nonce']) && is_string($_POST['epb_child_nonce'])
            ? sanitize_text_field(wp_unslash($_POST['epb_child_nonce']))
            : '';

        if (!wp_verify_nonce($child_nonce, 'epb_create_child')) {
            Notices::error(__('Security check failed. Please try again.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        $regenerate_functions = !empty($_POST['regenerate_child_functions']);

        if (isset($_POST['css_options']) && is_array($_POST['css_options'])) {
            // Sanitize and save CSS options using the CSS options manager.
            // Note: wp_unslash is applied inside save_theme_options for proper sanitization.
            $css_options = map_deep(wp_unslash($_POST['css_options']), 'sanitize_text_field');
            CSSOptions::save($css_options);
        }

        // Child theme creation queues notices directly.
        Child_Theme::create_and_activate($regenerate_functions);

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Handles token import request.
     *
     * @return void
     */
    private static function handle_token_import(): void
    {
        // Verify nonce for token import.
        $token_nonce = isset($_POST['epb_token_nonce']) && is_string($_POST['epb_token_nonce'])
            ? sanitize_text_field(wp_unslash($_POST['epb_token_nonce']))
            : '';

        if (!wp_verify_nonce($token_nonce, 'epb_import_tokens')) {
            Notices::error(__('Security check failed. Please try again.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        // Process the token import.
        $result = TokenImporter::process_upload($_FILES['tokens_json']);

        if (is_wp_error($result)) {
            Notices::error($result->get_error_message());
        } else {
            Notices::success(__('Design tokens imported successfully!', 'enhanced-plugin-bundle'));
        }

        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Checks if the YOOtheme parent theme is installed.
     *
     * @return bool True if YOOtheme is installed, false otherwise.
     */
    public static function is_yootheme_installed(): bool
    {
        $yootheme_dir = WP_CONTENT_DIR . '/themes/' . self::PARENT_THEME_SLUG;
        return file_exists($yootheme_dir);
    }

    /**
     * Checks if the child theme is active.
     *
     * @return bool True if a child theme is active and its parent is YOOtheme.
     */
    public static function is_child_theme_active(): bool
    {
        return is_child_theme() && get_template() === self::PARENT_THEME_SLUG;
    }

    /**
     * Gets the child theme directory path.
     *
     * @return string
     */
    public static function get_child_theme_dir(): string
    {
        return Child_Theme::get_child_theme_dir();
    }

    /**
     * Renders the section for uploading and installing the parent theme.
     *
     * Delegates to the Theme Section Renderer.
     *
     * @return void
     */
    public static function render_upload_parent_theme_section(): void
    {
        Main_Renderer::render_upload_section();
    }

    /**
     * Renders the section for creating and activating the child theme.
     *
     * Populates form fields with current CSS options retrieved via CSS Options.
     *
     * @return void
     */
    public static function render_create_child_theme_section(): void
    {
        Main_Renderer::render_child_theme_section();
    }

    /**
     * Renders the section for importing design tokens from Tokens Studio.
     *
     * @return void
     */
    public static function render_import_tokens_section(): void
    {
        Main_Renderer::render_import_tokens_section();
    }
}
