<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access.
}

/**
 * Class Plugin_Bundle_Css_Options
 *
 * Manages the CSS options for the child theme by providing default values,
 * retrieving saved options from the database, and saving/sanitizing submitted options.
 */
class Plugin_Bundle_Css_Options
{

    /**
     * Retrieves the CSS options saved in the database and merges them with the defaults.
     *
     * If no saved options exist, the defaults are used.
     *
     * @return array The merged CSS options.
     */
    public static function get_theme_options()
    {
        $defaults      = self::get_default_options();
        $saved_options = get_option('ppm_child_theme_css_options', []);
        return wp_parse_args($saved_options, $defaults);
    }

    /**
     * Saves and sanitizes submitted CSS options.
     *
     * For options with "color" in the key, sanitizes using sanitize_hex_color().
     * All other options are cast to a float value.
     *
     * @param array $submitted_options The submitted CSS options.
     * @return void
     */
    public static function save_theme_options($submitted_options)
    {
        if (!is_array($submitted_options)) {
            return;
        }
        $new_options = [];
        foreach ($submitted_options as $key => $value) {
            if (false !== strpos($key, 'color')) {
                $new_options[$key] = sanitize_hex_color($value);
            } else {
                $new_options[$key] = floatval($value);
            }
        }
        update_option('ppm_child_theme_css_options', $new_options);
    }

    /**
     * Returns the default CSS options.
     *
     * These default options define colors, breakpoints, container dimensions,
     * typography, and spacing values used to generate the child theme's CSS.
     *
     * @return array An associative array of default CSS options.
     */
    public static function get_default_options()
    {
        return [
            'muted_color'                => '#B4B5BA',
            'emphasis_color'             => '#2D2E33',
            'primary_color'              => '#303033',
            'secondary_color'            => '#242427',
            'success_color'              => '#3DC372',
            'warning_color'              => '#FF9E45',
            'danger_color'               => '#E44E56',
            'text_background_color'      => '#303033',
            'body_color'                 => '#000',
            'background_default_color'         => '#FFFFFF',
            'background_muted_color'           => '#F7F7F7',
            'background_primary_color'         => '#303033',
            'background_secondary_color'       => '#242427',
            'button_default_color'       => '#F7F7F7',
            'button_default_hover_color'       => '#F7F7F7',
            'button_default_text_color'       => '#000000',
            'button_default_hover_text_color'       => '#000000',
            'button_primary_color'       => '#303033',
            'button_primary_hover_color'       => '#303033',
            'button_primary_text_color'       => '#FFFFFF',
            'button_primary_hover_text_color'       => '#FFFFFF',
            'button_secondary_color'     => '#242427',
            'button_secondary_hover_color'     => '#242427',
            'button_secondary_text_color'     => '#FFFFFF',
            'button_secondary_hover_text_color'     => '#FFFFFF',
            'button_danger_color'        => '#E44E56',
            'button_danger_hover_color'        => '#E44E56',
            'button_danger_text_color'        => '#FFFFFF',
            'button_danger_hover_text_color'        => '#FFFFFF',
            'button_text_color'          => '#2D2E33',
            'button_text_hover_color'          => '#2D2E33',
            'button_link_color'          => '#6C6D74',
            'button_link_hover_color'          => '#6C6D74',
            'ppm_breakpoint_s'           => '600',
            'ppm_breakpoint_m'           => '900',
            'ppm_breakpoint_l'           => '1200',
            'ppm_breakpoint_xl'          => '1600',
            'container_padding_horizontal_mobile' => 15,
            'container_padding_horizontal_s' => 20,
            'container_padding_horizontal_m' => 40,
            'container_max_width_default' => 1920,
            'container_max_width_xsmall' => 750,
            'container_max_width_small'  => 900,
            'container_max_width_large'  => 1400,
            'container_max_width_xlarge' => 1600,
            'column_gutter_mobile'       => 20,
            'column_gutter_l'            => 40,
            'container_padding_vertical_default_mobile' => 40,
            'container_padding_vertical_default_m' => 70,
            'container_padding_vertical_xsmall_mobile' => 20,
            'container_padding_vertical_xsmall_m' => 25,
            'container_padding_vertical_small_mobile' => 40,
            'container_padding_vertical_small_m' => 45,
            'container_padding_vertical_large_mobile' => 70,
            'container_padding_vertical_large_m' => 140,
            'container_padding_vertical_xlarge_mobile' => 140,
            'container_padding_vertical_xlarge_m' => 210,
            'element_width_small'        => 150,
            'element_width_medium'       => 300,
            'element_width_large'        => 450,
            'element_width_xlarge'       => 600,
            'element_width_2xlarge'      => 750,
            'element_margin_default_mobile' => 15,
            'element_margin_default_l'   => 20,
            'element_margin_xsmall_mobile' => 3,
            'element_margin_xsmall_l'    => 5,
            'element_margin_small_mobile' => 5,
            'element_margin_small_l'     => 10,
            'element_margin_medium_mobile' => 20,
            'element_margin_medium_l'    => 40,
            'element_margin_large_mobile' => 40,
            'element_margin_large_l'     => 70,
            'element_margin_xlarge_mobile' => 70,
            'element_margin_xlarge_l'    => 140,
            'base_font_size'             => 16,
            'heading_3xlarge_mobile'     => 32,
            'heading_3xlarge_desktop'    => 48,
            'heading_3xlarge_font_weight' => 700,
            'heading_2xlarge_mobile'     => 24,
            'heading_2xlarge_desktop'    => 36,
            'heading_2xlarge_font_weight' => 700,
            'heading_xlarge_mobile'      => 20,
            'heading_xlarge_desktop'     => 28,
            'heading_xlarge_font_weight' => 600,
            'heading_large_mobile'       => 18,
            'heading_large_desktop'      => 24,
            'heading_large_font_weight'  => 600,
            'heading_medium_mobile'      => 16,
            'heading_medium_desktop'     => 20,
            'heading_medium_font_weight' => 500,
            'heading_small_mobile'       => 14,
            'heading_small_desktop'      => 18,
            'heading_small_font_weight'  => 500,
            'button_default_mobile'      => 16,
            'button_default_desktop'     => 18,
            'button_default_font_weight' => 600,
            'button_primary_mobile'      => 16,
            'button_primary_desktop'     => 18,
            'button_primary_font_weight' => 600,
            'button_secondary_mobile'    => 16,
            'button_secondary_desktop'   => 18,
            'button_secondary_font_weight' => 600,
            'button_danger_mobile'       => 16,
            'button_danger_desktop'      => 18,
            'button_danger_font_weight'  => 600,
            'button_text_mobile'         => 14,
            'button_text_desktop'        => 16,
            'button_text_font_weight'    => 500,
            'button_link_mobile'         => 14,
            'button_link_desktop'        => 16,
            'button_link_font_weight'    => 500,
            'navbar_link_mobile'         => 16,
            'navbar_link_desktop'        => 18,
            'navbar_link_font_weight'    => 600,
            'text_default_mobile'        => 14,
            'text_default_desktop'       => 16,
            'text_default_font_weight'   => 400,
            'text_small_mobile'          => 12,
            'text_small_desktop'         => 14,
            'text_small_font_weight'     => 400,
            'text_large_mobile'          => 16,
            'text_large_desktop'         => 20,
            'text_large_font_weight'     => 500,
        ];
    }
}
