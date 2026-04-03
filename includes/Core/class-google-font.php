<?php

/**
 * Google Font manager for Enhanced Plugin Bundle.
 *
 * Manages Google Fonts entries (family + weights) and builds the
 * Google Fonts API v2 stylesheet URL for frontend loading.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 * @since 4.5.0
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Google_Font
 *
 * Manages Google Fonts configuration and frontend enqueue.
 */
class Google_Font
{
    /**
     * Initialize frontend hook to enqueue Google Fonts stylesheet.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_google_fonts'], 5);
    }

    /**
     * Enqueue the Google Fonts stylesheet on the frontend.
     *
     * @return void
     */
    public static function enqueue_google_fonts(): void
    {
        $url = self::build_url();

        if (empty($url)) {
            return;
        }

        wp_enqueue_style('epb-google-fonts', $url, [], null);
    }

    /**
     * Get all saved Google Fonts entries.
     *
     * @return array<int, array{family: string, weights: string}> Font entries.
     */
    public static function get_fonts(): array
    {
        $fonts = get_option(Constants::OPTION_GOOGLE_FONTS, []);
        return is_array($fonts) ? $fonts : [];
    }

    /**
     * Add a Google Font entry.
     *
     * @param string $family  The font-family name (e.g. 'Roboto').
     * @param string $weights Comma-separated weights (e.g. '300,400,700').
     * @return array{success: bool, message: string, fonts?: array} Result.
     */
    public static function add(string $family, string $weights): array
    {
        $family = sanitize_text_field(trim($family));
        if (empty($family)) {
            return ['success' => false, 'message' => __('Font family name is required.', 'enhanced-plugin-bundle')];
        }

        $weights = self::sanitize_weights($weights);
        $fonts   = self::get_fonts();

        // Check for duplicate family.
        foreach ($fonts as $font) {
            if (strcasecmp($font['family'], $family) === 0) {
                return [
                    'success' => false,
                    'message' => sprintf(
                        __('Google Font "%s" already exists. Edit its weights instead.', 'enhanced-plugin-bundle'),
                        esc_html($family)
                    ),
                ];
            }
        }

        $fonts[] = [
            'family'  => $family,
            'weights' => $weights,
        ];

        update_option(Constants::OPTION_GOOGLE_FONTS, $fonts, false);

        return [
            'success' => true,
            'message' => sprintf(
                __('Google Font "%s" added successfully.', 'enhanced-plugin-bundle'),
                esc_html($family)
            ),
            'fonts' => $fonts,
        ];
    }

    /**
     * Update a Google Font entry's weights.
     *
     * @param string $family  The font-family name (used as identifier).
     * @param string $weights New comma-separated weights.
     * @return array{success: bool, message: string, fonts?: array} Result.
     */
    public static function update(string $family, string $weights): array
    {
        $family = sanitize_text_field(trim($family));
        $fonts  = self::get_fonts();
        $found  = false;

        foreach ($fonts as &$font) {
            if ($font['family'] === $family) {
                $new_weights = self::sanitize_weights($weights);
                if ($font['weights'] === $new_weights) {
                    return ['success' => true, 'message' => __('No changes detected.', 'enhanced-plugin-bundle'), 'fonts' => $fonts];
                }
                $font['weights'] = $new_weights;
                $found = true;
                break;
            }
        }
        unset($font);

        if (!$found) {
            return ['success' => false, 'message' => __('Google Font not found.', 'enhanced-plugin-bundle')];
        }

        update_option(Constants::OPTION_GOOGLE_FONTS, $fonts, false);

        return [
            'success' => true,
            'message' => __('Google Font updated successfully.', 'enhanced-plugin-bundle'),
            'fonts'   => $fonts,
        ];
    }

    /**
     * Delete a Google Font entry.
     *
     * @param string $family The font-family name.
     * @return array{success: bool, message: string, fonts?: array} Result.
     */
    public static function delete(string $family): array
    {
        $family = sanitize_text_field(trim($family));
        $fonts  = self::get_fonts();
        $found  = false;

        foreach ($fonts as $index => $font) {
            if ($font['family'] === $family) {
                unset($fonts[$index]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            return ['success' => false, 'message' => __('Google Font not found.', 'enhanced-plugin-bundle')];
        }

        update_option(Constants::OPTION_GOOGLE_FONTS, array_values($fonts), false);

        return [
            'success' => true,
            'message' => __('Google Font removed successfully.', 'enhanced-plugin-bundle'),
            'fonts'   => array_values($fonts),
        ];
    }

    /**
     * Build the Google Fonts API v2 URL from all saved entries.
     *
     * @return string The full stylesheet URL, or empty string if no fonts.
     */
    public static function build_url(): string
    {
        $fonts = self::get_fonts();

        if (empty($fonts)) {
            return '';
        }

        $families = [];

        foreach ($fonts as $font) {
            $name = str_replace(' ', '+', $font['family']);
            $weights = array_filter(array_map('trim', explode(',', $font['weights'])));

            if (empty($weights) || $weights === ['400']) {
                $families[] = "family={$name}";
            } else {
                // Sort numerically.
                sort($weights, SORT_NUMERIC);
                $families[] = "family={$name}:wght@" . implode(';', $weights);
            }
        }

        return 'https://fonts.googleapis.com/css2?' . implode('&', $families) . '&display=swap';
    }

    /**
     * Sanitize a comma-separated font-weights string.
     *
     * @param string $weights Comma-separated weights input.
     * @return string Sanitized comma-separated weights.
     */
    private static function sanitize_weights(string $weights): string
    {
        $parts = array_map('trim', explode(',', $weights));
        $valid = [];

        foreach ($parts as $w) {
            if (preg_match('/^[1-9]00$/', $w)) {
                $valid[] = $w;
            }
        }

        return !empty($valid) ? implode(',', array_unique($valid)) : '400';
    }
}
