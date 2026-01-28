<?php

/**
 * CSS Options manager for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage CSS
 */

namespace EPB\CSS;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Options
 *
 * Manages the CSS options for the child theme by providing default values,
 * retrieving saved options from the database, and saving/sanitizing submitted options.
 */
class Options
{
    /**
     * Option name in the database.
     *
     * @var string
     */
    public const OPTION_NAME = 'ppm_child_theme_css_options';

    /**
     * Retrieves the CSS options saved in the database and merges them with the defaults.
     *
     * If no saved options exist, the defaults are used.
     *
     * @return array<string, mixed> The merged CSS options.
     */
    public static function get(): array
    {
        $defaults      = self::get_defaults();
        $saved_options = get_option(self::OPTION_NAME, []);
        return wp_parse_args($saved_options, $defaults);
    }

    /**
     * Saves and sanitizes submitted CSS options.
     *
     * For options with "color" in the key, sanitizes using sanitize_hex_color().
     * All other options are cast to a float value.
     * Only allowed keys (from default options) are saved to prevent arbitrary data storage.
     *
     * @param array<string, mixed> $submitted_options The submitted CSS options.
     * @return void
     */
    public static function save(array $submitted_options): void
    {
        // Get allowed keys from default options to prevent arbitrary data storage.
        $defaults     = self::get_defaults();
        $allowed_keys = array_keys($defaults);

        $new_options = [];
        foreach ($submitted_options as $key => $value) {
            // Only process allowed keys.
            if (!in_array($key, $allowed_keys, true)) {
                continue;
            }

            // Sanitize based on key type.
            if (false !== strpos($key, 'color')) {
                // Sanitize hex color values.
                $sanitized           = sanitize_hex_color($value);
                // If sanitization fails, use default value.
                $new_options[$key] = $sanitized ?: $defaults[$key];
            } else {
                // Ensure numeric values are within reasonable bounds.
                $float_value = floatval($value);
                // Prevent negative values and extremely large values.
                if ($float_value < 0) {
                    $float_value = 0;
                } elseif ($float_value > 10000) {
                    $float_value = 10000;
                }
                $new_options[$key] = $float_value;
            }
        }

        // Merge with defaults to ensure all keys exist.
        $new_options = wp_parse_args($new_options, $defaults);

        update_option(self::OPTION_NAME, $new_options);

        // Log if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] CSS options saved successfully.');
        }
    }

    /**
     * Returns the default CSS options.
     *
     * These default options define colors, breakpoints, container dimensions,
     * typography, and spacing values used to generate the child theme's CSS.
     *
     * @return array<string, mixed> An associative array of default CSS options.
     */
    public static function get_defaults(): array
    {
        return [
            // Text Colors
            'muted_color'                             => '#B4B5BA',
            'emphasis_color'                          => '#2D2E33',
            'primary_color'                           => '#303033',
            'secondary_color'                         => '#242427',
            'success_color'                           => '#3DC372',
            'warning_color'                           => '#FF9E45',
            'danger_color'                            => '#E44E56',
            'text_background_color'                   => '#303033',
            'body_color'                              => '#000',

            // Background Colors
            'background_default_color'                => '#FFFFFF',
            'background_muted_color'                  => '#F7F7F7',
            'background_primary_color'                => '#303033',
            'background_secondary_color'              => '#242427',

            // Button Default Colors
            'button_default_color'                    => '#F7F7F7',
            'button_default_hover_color'              => '#F7F7F7',
            'button_default_text_color'               => '#000000',
            'button_default_hover_text_color'         => '#000000',

            // Button Primary Colors
            'button_primary_color'                    => '#303033',
            'button_primary_hover_color'              => '#303033',
            'button_primary_text_color'               => '#FFFFFF',
            'button_primary_hover_text_color'         => '#FFFFFF',

            // Button Secondary Colors
            'button_secondary_color'                  => '#242427',
            'button_secondary_hover_color'            => '#242427',
            'button_secondary_text_color'             => '#FFFFFF',
            'button_secondary_hover_text_color'       => '#FFFFFF',

            // Button Danger Colors
            'button_danger_color'                     => '#E44E56',
            'button_danger_hover_color'               => '#E44E56',
            'button_danger_text_color'                => '#FFFFFF',
            'button_danger_hover_text_color'          => '#FFFFFF',

            // Button Text Colors
            'button_text_color'                       => '#2D2E33',
            'button_text_hover_color'                 => '#2D2E33',

            // Button Link Colors
            'button_link_color'                       => '#6C6D74',
            'button_link_hover_color'                 => '#6C6D74',

            // Breakpoints
            'ppm_breakpoint_s'                        => '600',
            'ppm_breakpoint_m'                        => '900',
            'ppm_breakpoint_l'                        => '1200',
            'ppm_breakpoint_xl'                       => '1600',

            // Container Padding Horizontal
            'container_padding_horizontal_mobile'     => 15,
            'container_padding_horizontal_s'          => 20,
            'container_padding_horizontal_m'          => 40,

            // Container Max Widths
            'container_max_width_default'             => 1920,
            'container_max_width_xsmall'              => 750,
            'container_max_width_small'               => 900,
            'container_max_width_large'               => 1400,
            'container_max_width_xlarge'              => 1600,

            // Column Gutters
            'column_gutter_mobile'                    => 20,
            'column_gutter_l'                         => 40,

            // Container Padding Vertical
            'container_padding_vertical_default_mobile' => 40,
            'container_padding_vertical_default_m'    => 70,
            'container_padding_vertical_xsmall_mobile' => 20,
            'container_padding_vertical_xsmall_m'     => 25,
            'container_padding_vertical_small_mobile' => 40,
            'container_padding_vertical_small_m'      => 45,
            'container_padding_vertical_large_mobile' => 70,
            'container_padding_vertical_large_m'      => 140,
            'container_padding_vertical_xlarge_mobile' => 140,
            'container_padding_vertical_xlarge_m'     => 210,

            // Element Widths
            'element_width_small'                     => 150,
            'element_width_medium'                    => 300,
            'element_width_large'                     => 450,
            'element_width_xlarge'                    => 600,
            'element_width_2xlarge'                   => 750,

            // Element Margins
            'element_margin_default_mobile'           => 15,
            'element_margin_default_l'                => 20,
            'element_margin_xsmall_mobile'            => 3,
            'element_margin_xsmall_l'                 => 5,
            'element_margin_small_mobile'             => 5,
            'element_margin_small_l'                  => 10,
            'element_margin_medium_mobile'            => 20,
            'element_margin_medium_l'                 => 40,
            'element_margin_large_mobile'             => 40,
            'element_margin_large_l'                  => 70,
            'element_margin_xlarge_mobile'            => 70,
            'element_margin_xlarge_l'                 => 140,

            // Base Font Size
            'base_font_size'                          => 16,

            // Heading Typography
            'heading_3xlarge_mobile'                  => 32,
            'heading_3xlarge_desktop'                 => 48,
            'heading_3xlarge_font_weight'             => 700,
            'heading_2xlarge_mobile'                  => 24,
            'heading_2xlarge_desktop'                 => 36,
            'heading_2xlarge_font_weight'             => 700,
            'heading_xlarge_mobile'                   => 20,
            'heading_xlarge_desktop'                  => 28,
            'heading_xlarge_font_weight'              => 600,
            'heading_large_mobile'                    => 18,
            'heading_large_desktop'                   => 24,
            'heading_large_font_weight'               => 600,
            'heading_medium_mobile'                   => 16,
            'heading_medium_desktop'                  => 20,
            'heading_medium_font_weight'              => 500,
            'heading_small_mobile'                    => 14,
            'heading_small_desktop'                   => 18,
            'heading_small_font_weight'               => 500,

            // Button Typography
            'button_default_mobile'                   => 16,
            'button_default_desktop'                  => 18,
            'button_default_font_weight'              => 600,
            'button_primary_mobile'                   => 16,
            'button_primary_desktop'                  => 18,
            'button_primary_font_weight'              => 600,
            'button_secondary_mobile'                 => 16,
            'button_secondary_desktop'                => 18,
            'button_secondary_font_weight'            => 600,
            'button_danger_mobile'                    => 16,
            'button_danger_desktop'                   => 18,
            'button_danger_font_weight'               => 600,
            'button_text_mobile'                      => 14,
            'button_text_desktop'                     => 16,
            'button_text_font_weight'                 => 500,
            'button_link_mobile'                      => 14,
            'button_link_desktop'                     => 16,
            'button_link_font_weight'                 => 500,

            // Navbar Typography
            'navbar_link_mobile'                      => 16,
            'navbar_link_desktop'                     => 18,
            'navbar_link_font_weight'                 => 600,

            // Text Typography
            'text_default_mobile'                     => 14,
            'text_default_desktop'                    => 16,
            'text_default_font_weight'                => 400,
            'text_small_mobile'                       => 12,
            'text_small_desktop'                      => 14,
            'text_small_font_weight'                  => 400,
            'text_large_mobile'                       => 16,
            'text_large_desktop'                      => 20,
            'text_large_font_weight'                  => 500,
        ];
    }

    /**
     * Gets the list of color option keys.
     *
     * @return array<string> List of color option keys.
     */
    public static function get_color_keys(): array
    {
        $defaults = self::get_defaults();
        return array_filter(
            array_keys($defaults),
            static fn($key) => false !== strpos($key, 'color')
        );
    }

    /**
     * Gets the list of numeric option keys.
     *
     * @return array<string> List of numeric option keys.
     */
    public static function get_numeric_keys(): array
    {
        $defaults = self::get_defaults();
        return array_filter(
            array_keys($defaults),
            static fn($key) => false === strpos($key, 'color')
        );
    }
}
