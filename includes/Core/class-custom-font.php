<?php

/**
 * Custom Font manager for Enhanced Plugin Bundle.
 *
 * Handles custom font file uploads, storage, and @font-face generation
 * for frontend use with YOOtheme and its child themes.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 * @since 4.4.0
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Custom_Font
 *
 * Manages custom font uploads, file storage, and CSS generation.
 */
class Custom_Font
{
    /**
     * Allowed font MIME types and extensions.
     *
     * @var array<string, string>
     */
    private const ALLOWED_TYPES = [
        'woff2' => 'font/woff2',
        'woff'  => 'font/woff',
        'ttf'   => 'font/sfnt',
        'otf'   => 'font/sfnt',
    ];

    /**
     * CSS format identifiers for each extension.
     *
     * @var array<string, string>
     */
    private const FORMAT_MAP = [
        'woff2' => 'woff2',
        'woff'  => 'woff',
        'ttf'   => 'truetype',
        'otf'   => 'opentype',
    ];

    /**
     * Maximum file size in bytes (5 MB).
     *
     * @var int
     */
    private const MAX_FILE_SIZE = 5 * 1024 * 1024;

    /**
     * Initialize frontend hook to enqueue @font-face CSS.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_font_face_css'], 5);

        // Allow font MIME types in WordPress uploads.
        add_filter('upload_mimes', [self::class, 'add_font_mime_types']);
    }

    /**
     * Add font MIME types to WordPress allowed uploads.
     *
     * @param array<string, string> $mimes Existing MIME types.
     * @return array<string, string> Modified MIME types.
     */
    public static function add_font_mime_types(array $mimes): array
    {
        $mimes['woff2'] = 'font/woff2';
        $mimes['woff']  = 'font/woff';
        $mimes['ttf']   = 'font/sfnt';
        $mimes['otf']   = 'font/otf';

        return $mimes;
    }

    /**
     * Enqueue inline @font-face CSS on the frontend.
     *
     * @return void
     */
    public static function enqueue_font_face_css(): void
    {
        $css = self::generate_font_face_css();

        if (empty($css)) {
            return;
        }

        // Register a dummy handle and attach inline CSS.
        wp_register_style('epb-custom-fonts', false);
        wp_enqueue_style('epb-custom-fonts');
        wp_add_inline_style('epb-custom-fonts', $css);
    }

    /**
     * Get the upload directory path for custom fonts.
     *
     * @return string Absolute path to the fonts directory.
     */
    public static function get_fonts_dir(): string
    {
        $upload_dir = wp_upload_dir();
        return $upload_dir['basedir'] . '/epb-fonts';
    }

    /**
     * Get the upload directory URL for custom fonts.
     *
     * @return string URL to the fonts directory.
     */
    public static function get_fonts_url(): string
    {
        $upload_dir = wp_upload_dir();
        return $upload_dir['baseurl'] . '/epb-fonts';
    }

    /**
     * Ensure the fonts directory exists and is protected.
     *
     * @return bool True if the directory exists or was created.
     */
    public static function ensure_fonts_dir(): bool
    {
        $dir = self::get_fonts_dir();

        if (!wp_mkdir_p($dir)) {
            return false;
        }

        // Add an index.php to prevent directory listing.
        $index_file = $dir . '/index.php';
        if (!file_exists($index_file)) {
            global $wp_filesystem;
            if (!function_exists('WP_Filesystem')) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
            }
            WP_Filesystem();
            $wp_filesystem->put_contents($index_file, "<?php\n// Silence is golden.\n", FS_CHMOD_FILE);
        }

        return true;
    }

    /**
     * Get all saved custom fonts.
     *
     * @return array<int, array{id: string, family: string, file: string, ext: string, weights: string, style: string}> Font entries.
     */
    public static function get_fonts(): array
    {
        $fonts = get_option(Constants::OPTION_CUSTOM_FONTS, []);
        return is_array($fonts) ? $fonts : [];
    }

    /**
     * Upload a custom font file.
     *
     * @param array  $file    The $_FILES entry for the uploaded font.
     * @param string $family  The font-family name.
     * @param string $weights Comma-separated font-weights (e.g. '100,400,700').
     * @param string $style   The font-style (e.g. 'normal', 'italic').
     * @return array{success: bool, message: string, font?: array} Result.
     */
    public static function upload(array $file, string $family, string $weights = 'normal', string $style = 'normal'): array
    {
        // Validate file was uploaded properly.
        if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => __('No file uploaded or upload error occurred.', 'enhanced-plugin-bundle')];
        }

        // Validate file size.
        if ($file['size'] > self::MAX_FILE_SIZE) {
            return ['success' => false, 'message' => __('Font file exceeds the 5 MB size limit.', 'enhanced-plugin-bundle')];
        }

        // Get and validate extension.
        $original_name = sanitize_file_name($file['name']);
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if (!isset(self::ALLOWED_TYPES[$ext])) {
            return [
                'success' => false,
                'message' => sprintf(
                    __('Invalid font file type "%s". Allowed: woff2, woff, ttf, otf.', 'enhanced-plugin-bundle'),
                    esc_html($ext)
                ),
            ];
        }

        // Validate the file is actually a font by checking magic bytes.
        if (!self::validate_font_file($file['tmp_name'], $ext)) {
            return ['success' => false, 'message' => __('The uploaded file does not appear to be a valid font file.', 'enhanced-plugin-bundle')];
        }

        // Sanitize font-family name.
        $family = sanitize_text_field(trim($family));
        if (empty($family)) {
            return ['success' => false, 'message' => __('Font family name is required.', 'enhanced-plugin-bundle')];
        }

        // Sanitize weights (comma-separated) and style.
        $weights = self::sanitize_font_weights($weights);
        $style   = in_array($style, ['normal', 'italic', 'oblique'], true) ? $style : 'normal';

        // Ensure upload directory exists.
        if (!self::ensure_fonts_dir()) {
            return ['success' => false, 'message' => __('Could not create the fonts directory.', 'enhanced-plugin-bundle')];
        }

        // Generate a safe, unique filename.
        $safe_name = sanitize_file_name(strtolower(str_replace(' ', '-', $family)));
        $font_id   = wp_generate_uuid4();
        $filename  = $safe_name . '-' . $style . '-' . substr($font_id, 0, 8) . '.' . $ext;
        $dest_path = self::get_fonts_dir() . '/' . $filename;

        // Move the uploaded file.
        if (!move_uploaded_file($file['tmp_name'], $dest_path)) {
            return ['success' => false, 'message' => __('Failed to save the font file.', 'enhanced-plugin-bundle')];
        }

        // Set proper file permissions.
        chmod($dest_path, 0644);

        // Save font metadata.
        $font_entry = [
            'id'      => $font_id,
            'family'  => $family,
            'file'    => $filename,
            'ext'     => $ext,
            'weights' => $weights,
            'style'   => $style,
        ];

        $fonts = self::get_fonts();
        $fonts[] = $font_entry;
        update_option(Constants::OPTION_CUSTOM_FONTS, $fonts, false);

        return [
            'success' => true,
            'message' => sprintf(
                __('Font "%s" uploaded successfully.', 'enhanced-plugin-bundle'),
                esc_html($family)
            ),
            'font' => $font_entry,
        ];
    }

    /**
     * Update a custom font's weights and style.
     *
     * @param string $font_id The font UUID.
     * @param string $weights New comma-separated font-weights.
     * @param string $style   New font-style.
     * @return array{success: bool, message: string, font?: array} Result.
     */
    public static function update(string $font_id, string $weights, string $style): array
    {
        $fonts = self::get_fonts();
        $found_index = null;

        foreach ($fonts as $index => $font) {
            if ($font['id'] === $font_id) {
                $found_index = $index;
                break;
            }
        }

        if ($found_index === null) {
            return ['success' => false, 'message' => __('Font not found.', 'enhanced-plugin-bundle')];
        }

        $weights = self::sanitize_font_weights($weights);
        $style   = in_array($style, ['normal', 'italic', 'oblique'], true) ? $style : 'normal';

        // Check if anything actually changed.
        if ($fonts[$found_index]['weights'] === $weights && $fonts[$found_index]['style'] === $style) {
            return ['success' => true, 'message' => __('No changes detected.', 'enhanced-plugin-bundle'), 'font' => $fonts[$found_index]];
        }

        $fonts[$found_index]['weights'] = $weights;
        $fonts[$found_index]['style']   = $style;

        update_option(Constants::OPTION_CUSTOM_FONTS, $fonts, false);

        return [
            'success' => true,
            'message' => __('Font updated successfully.', 'enhanced-plugin-bundle'),
            'font'    => $fonts[$found_index],
        ];
    }

    /**
     * Delete a custom font by ID.
     *
     * @param string $font_id The font UUID.
     * @return array{success: bool, message: string} Result.
     */
    public static function delete(string $font_id): array
    {
        $fonts = self::get_fonts();
        $found = false;

        foreach ($fonts as $index => $font) {
            if ($font['id'] === $font_id) {
                // Delete the file.
                $file_path = self::get_fonts_dir() . '/' . $font['file'];
                if (file_exists($file_path)) {
                    wp_delete_file($file_path);
                }

                unset($fonts[$index]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            return ['success' => false, 'message' => __('Font not found.', 'enhanced-plugin-bundle')];
        }

        // Re-index and save.
        update_option(Constants::OPTION_CUSTOM_FONTS, array_values($fonts), false);

        return ['success' => true, 'message' => __('Font deleted successfully.', 'enhanced-plugin-bundle')];
    }

    /**
     * Generate @font-face CSS for all uploaded custom fonts.
     *
     * @return string The @font-face CSS declarations.
     */
    public static function generate_font_face_css(): string
    {
        $fonts = self::get_fonts();

        if (empty($fonts)) {
            return '';
        }

        $fonts_url = self::get_fonts_url();
        $css = "/* Custom Fonts — Enhanced Plugin Bundle */\n";

        foreach ($fonts as $font) {
            $format  = self::FORMAT_MAP[$font['ext']] ?? 'truetype';
            $url     = esc_url($fonts_url . '/' . $font['file']);
            $family  = self::escape_css_string($font['family']);
            $weights = self::expand_weights($font['weights'] ?? 'normal');

            foreach ($weights as $w) {
                $css .= "@font-face {\n";
                $css .= "    font-family: '{$family}';\n";
                $css .= "    src: url('{$url}') format('{$format}');\n";
                $css .= "    font-weight: {$w};\n";
                $css .= "    font-style: {$font['style']};\n";
                $css .= "    font-display: swap;\n";
                $css .= "}\n\n";
            }
        }

        return $css;
    }

    /**
     * Generate @font-face CSS using relative paths for child theme embedding.
     *
     * Uses a path relative from the child theme's css/ directory to wp-content/uploads/.
     *
     * @return string The @font-face CSS with relative URLs.
     */
    public static function generate_font_face_css_relative(): string
    {
        $fonts = self::get_fonts();

        if (empty($fonts)) {
            return '';
        }

        // Build a relative path from child-theme/css/ to wp-content/uploads/epb-fonts/.
        // Child theme is at: wp-content/themes/YOOthemechildtheme/css/
        // Fonts are at:      wp-content/uploads/epb-fonts/
        // Relative:          ../../../uploads/epb-fonts/
        $relative_base = '../../../uploads/epb-fonts';

        $css = "/* Custom Fonts — Enhanced Plugin Bundle */\n";

        foreach ($fonts as $font) {
            $format   = self::FORMAT_MAP[$font['ext']] ?? 'truetype';
            $filename = sanitize_file_name($font['file']);
            $family   = self::escape_css_string($font['family']);
            $weights  = self::expand_weights($font['weights'] ?? 'normal');

            foreach ($weights as $w) {
                $css .= "@font-face {\n";
                $css .= "    font-family: '{$family}';\n";
                $css .= "    src: url('{$relative_base}/{$filename}') format('{$format}');\n";
                $css .= "    font-weight: {$w};\n";
                $css .= "    font-style: {$font['style']};\n";
                $css .= "    font-display: swap;\n";
                $css .= "}\n\n";
            }
        }

        return $css;
    }

    /**
     * Get unique font family names from uploaded fonts.
     *
     * @return array<string> List of distinct font-family names.
     */
    public static function get_font_families(): array
    {
        $fonts = self::get_fonts();
        $families = [];

        foreach ($fonts as $font) {
            $families[$font['family']] = true;
        }

        return array_keys($families);
    }

    /**
     * Validate a font file by checking magic bytes.
     *
     * @param string $file_path Path to the file.
     * @param string $ext       File extension.
     * @return bool True if the file appears valid.
     */
    private static function validate_font_file(string $file_path, string $ext): bool
    {
        $handle = fopen($file_path, 'rb');
        if (!$handle) {
            return false;
        }

        $header = fread($handle, 12);
        fclose($handle);

        if (strlen($header) < 4) {
            return false;
        }

        switch ($ext) {
            case 'woff2':
                // wOF2 magic number.
                return substr($header, 0, 4) === 'wOF2';

            case 'woff':
                // wOFF magic number.
                return substr($header, 0, 4) === 'wOFF';

            case 'ttf':
                // TrueType: starts with 0x00010000 or 'true'.
                $sig = substr($header, 0, 4);
                return $sig === "\x00\x01\x00\x00" || $sig === 'true';

            case 'otf':
                // OpenType: starts with 'OTTO' or TrueType signature.
                $sig = substr($header, 0, 4);
                return $sig === 'OTTO' || $sig === "\x00\x01\x00\x00";

            default:
                return false;
        }
    }

    /**
     * Sanitize a comma-separated font-weights string.
     *
     * Accepts values like '100,400,700' or 'normal,bold'.
     * Returns a cleaned string with only valid weights.
     *
     * @param string $weights Comma-separated weights input.
     * @return string Sanitized comma-separated weights.
     */
    private static function sanitize_font_weights(string $weights): string
    {
        $parts = array_map('trim', explode(',', $weights));
        $valid = [];
        $named = ['normal', 'bold', 'lighter', 'bolder'];

        foreach ($parts as $w) {
            if (in_array($w, $named, true) || preg_match('/^[1-9]00$/', $w)) {
                $valid[] = $w;
            }
        }

        return !empty($valid) ? implode(',', array_unique($valid)) : 'normal';
    }

    /**
     * Expand a comma-separated weights string into an array.
     *
     * @param string $weights Comma-separated weights (e.g. '100,400,700').
     * @return array<string> Individual weight values.
     */
    private static function expand_weights(string $weights): array
    {
        $parts = array_map('trim', explode(',', $weights));
        return array_filter($parts, fn($w) => $w !== '');
    }

    /**
     * Escape a string for safe use inside CSS quotes.
     *
     * @param string $str The string to escape.
     * @return string The escaped string.
     */
    private static function escape_css_string(string $str): string
    {
        return str_replace(["'", '"', '\\'], ["\\'", '\\"', '\\\\'], $str);
    }
}
