<?php

/**
 * Theme uploader for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Themes
 */

namespace EPB\Themes;

use EPB\Core\Notices;
use WP_Error;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Uploader
 *
 * Handles theme file uploads and installation.
 */
class Uploader
{
    /**
     * Uploads and installs the parent theme.
     *
     * Uses WordPress wp_handle_upload() for secure file handling,
     * then unzips the theme to the themes directory.
     *
     * @param array $file Uploaded file details from $_FILES['theme_zip'].
     * @return void
     */
    public static function upload_parent_theme(array $file): void
    {
        // Check for file upload errors.
        if (!empty($file['error']) && $file['error'] !== UPLOAD_ERR_OK) {
            Notices::error(
                sprintf(
                    /* translators: %s: error code */
                    __('File upload failed with error code: %s', 'enhanced-plugin-bundle'),
                    esc_html($file['error'])
                )
            );
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        // Validate file type - must be a ZIP file.
        // Use wp_check_filetype_and_ext for more thorough validation.
        $file_type = wp_check_filetype_and_ext($file['tmp_name'], $file['name'], ['zip' => 'application/zip']);
        if (empty($file_type['ext']) || 'zip' !== $file_type['ext']) {
            Notices::error(__('Invalid file type. Please upload a valid ZIP file.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        // Additional verification: check ZIP file is readable.
        $zip = new \ZipArchive();
        if ($zip->open($file['tmp_name']) !== true) {
            Notices::error(__('The uploaded file is not a valid ZIP archive.', 'enhanced-plugin-bundle'));
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }
        $zip->close();

        $theme_slug = sanitize_file_name(basename($file['name'], '.zip'));

        // If the parent theme is already installed, display a warning.
        if (Manager::is_yootheme_installed()) {
            Notices::warning(
                sprintf(
                    /* translators: %s: theme slug */
                    __('The theme "%s" is already uploaded.', 'enhanced-plugin-bundle'),
                    esc_html($theme_slug)
                )
            );
            Notices::save_queued_notices();
            wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
            exit;
        }

        // Process the theme file upload and installation.
        $result = self::process_upload($file);

        // Queue the outcome notice.
        Notices::display_action_result($theme_slug, $result, 'upload', true);
        Notices::save_queued_notices();
        wp_safe_redirect(admin_url('admin.php?page=plugin-bundle-settings'));
        exit;
    }

    /**
     * Processes the uploaded theme file using WordPress wp_handle_upload().
     *
     * Uses WordPress's built-in upload handler for security and compatibility,
     * then unzips the theme to the themes directory.
     *
     * @param array $file Uploaded file details from $_FILES.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public static function process_upload(array $file): bool|WP_Error
    {
        // Load required WordPress file handling functions.
        if (!function_exists('wp_handle_upload')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        // Configure upload overrides - we handle validation ourselves.
        $upload_overrides = [
            'test_form' => false, // We've already verified the nonce.
            'mimes'     => ['zip' => 'application/zip'], // Only allow ZIP files.
        ];

        // Use WordPress's secure upload handler.
        $upload_result = wp_handle_upload($file, $upload_overrides);

        // Check for upload errors.
        if (isset($upload_result['error'])) {
            return new WP_Error('upload_failed', $upload_result['error']);
        }

        // Get the uploaded file path.
        $uploaded_file = $upload_result['file'];
        $theme_dir     = WP_CONTENT_DIR . '/themes/';

        // Initialize WordPress Filesystem for unzipping.
        global $wp_filesystem;
        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }
        WP_Filesystem();

        // Unzip the file to the themes directory.
        $unzip_result = unzip_file($uploaded_file, $theme_dir);

        // Clean up the uploaded ZIP file (it's in the uploads directory).
        wp_delete_file($uploaded_file);

        if (is_wp_error($unzip_result)) {
            return new WP_Error(
                'install_theme_failed',
                sprintf(
                    /* translators: %s: error message */
                    __('Failed to install the theme: %s', 'enhanced-plugin-bundle'),
                    esc_html($unzip_result->get_error_message())
                )
            );
        }

        return true;
    }
}
