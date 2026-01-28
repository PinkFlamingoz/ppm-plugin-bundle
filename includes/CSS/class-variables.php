<?php

/**
 * CSS Variables generator for Enhanced Plugin Bundle.
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
 * Class Variables
 *
 * Generates CSS custom properties (variables) from theme options.
 * Separates variable generation logic for cleaner organization.
 */
class Variables
{
    /**
     * Generates all CSS custom properties.
     *
     * @param array<string, mixed> $options CSS options.
     * @return string CSS :root block with all variables.
     */
    public static function get_all(array $options): string
    {
        $css  = "/* GLOBAL */\n:root {\n";
        $css .= self::get_color_variables($options);
        $css .= self::get_breakpoint_variables($options);
        $css .= self::get_typography_variables($options);
        $css .= self::get_spacing_variables($options);
        $css .= "}\n";

        return $css;
    }

    /**
     * Generates color CSS custom properties.
     *
     * @param array<string, mixed> $options CSS options.
     * @return string CSS variables for colors.
     */
    public static function get_color_variables(array $options): string
    {
        return <<<EOT

    /* Text Colors */
    --muted-color: {$options['muted_color']};
    --emphasis-color: {$options['emphasis_color']};
    --primary-color: {$options['primary_color']};
    --secondary-color: {$options['secondary_color']};
    --success-color: {$options['success_color']};
    --warning-color: {$options['warning_color']};
    --danger-color: {$options['danger_color']};
    --text-background-color: {$options['text_background_color']};
    --body-color: {$options['body_color']};

    /* Background Colors */
    --background-default: {$options['background_default_color']};
    --background-muted: {$options['background_muted_color']};
    --background-primary: {$options['background_primary_color']};
    --background-secondary: {$options['background_secondary_color']};

    /* Button Colors - Default */
    --button-default-color: {$options['button_default_color']};
    --button-default-hover-color: {$options['button_default_hover_color']};
    --button-default-text-color: {$options['button_default_text_color']};
    --button-default-hover-text-color: {$options['button_default_hover_text_color']};

    /* Button Colors - Primary */
    --button-primary-color: {$options['button_primary_color']};
    --button-primary-hover-color: {$options['button_primary_hover_color']};
    --button-primary-text-color: {$options['button_primary_text_color']};
    --button-primary-hover-text-color: {$options['button_primary_hover_text_color']};

    /* Button Colors - Secondary */
    --button-secondary-color: {$options['button_secondary_color']};
    --button-secondary-hover-color: {$options['button_secondary_hover_color']};
    --button-secondary-text-color: {$options['button_secondary_text_color']};
    --button-secondary-hover-text-color: {$options['button_secondary_hover_text_color']};

    /* Button Colors - Danger */
    --button-danger-color: {$options['button_danger_color']};
    --button-danger-hover-color: {$options['button_danger_hover_color']};
    --button-danger-text-color: {$options['button_danger_text_color']};
    --button-danger-hover-text-color: {$options['button_danger_hover_text_color']};

    /* Button Colors - Text & Link */
    --button-text-color: {$options['button_text_color']};
    --button-text-hover-color: {$options['button_text_hover_color']};
    --button-link-color: {$options['button_link_color']};
    --button-link-hover-color: {$options['button_link_hover_color']};

EOT;
    }

    /**
     * Generates breakpoint CSS custom properties.
     *
     * @param array<string, mixed> $options CSS options.
     * @return string CSS variables for breakpoints.
     */
    public static function get_breakpoint_variables(array $options): string
    {
        return <<<EOT

    /* Breakpoints */
    --ppm-breakpoint-s: {$options['ppm_breakpoint_s']};
    --ppm-breakpoint-m: {$options['ppm_breakpoint_m']};
    --ppm-breakpoint-l: {$options['ppm_breakpoint_l']};
    --ppm-breakpoint-xl: {$options['ppm_breakpoint_xl']};

    --uk-breakpoint-s: {$options['ppm_breakpoint_s']}px;
    --uk-breakpoint-m: {$options['ppm_breakpoint_m']}px;
    --uk-breakpoint-l: {$options['ppm_breakpoint_l']}px;
    --uk-breakpoint-xl: {$options['ppm_breakpoint_xl']}px;

EOT;
    }

    /**
     * Generates typography CSS custom properties.
     *
     * @param array<string, mixed> $options CSS options.
     * @return string CSS variables for typography.
     */
    public static function get_typography_variables(array $options): string
    {
        $base_font_size = isset($options['base_font_size']) ? floatval($options['base_font_size']) : 16;

        return <<<EOT

    /* Base Font Size */
    --base-font-size: {$base_font_size}px;

    /* Heading 3XL */
    --heading-3xlarge-mobile: {$options['heading_3xlarge_mobile']};
    --heading-3xlarge-desktop: {$options['heading_3xlarge_desktop']};
    --heading-3xlarge-font-weight: {$options['heading_3xlarge_font_weight']};

    /* Heading 2XL */
    --heading-2xlarge-mobile: {$options['heading_2xlarge_mobile']};
    --heading-2xlarge-desktop: {$options['heading_2xlarge_desktop']};
    --heading-2xlarge-font-weight: {$options['heading_2xlarge_font_weight']};

    /* Heading XL */
    --heading-xlarge-mobile: {$options['heading_xlarge_mobile']};
    --heading-xlarge-desktop: {$options['heading_xlarge_desktop']};
    --heading-xlarge-font-weight: {$options['heading_xlarge_font_weight']};

    /* Heading Large */
    --heading-large-mobile: {$options['heading_large_mobile']};
    --heading-large-desktop: {$options['heading_large_desktop']};
    --heading-large-font-weight: {$options['heading_large_font_weight']};

    /* Heading Medium */
    --heading-medium-mobile: {$options['heading_medium_mobile']};
    --heading-medium-desktop: {$options['heading_medium_desktop']};
    --heading-medium-font-weight: {$options['heading_medium_font_weight']};

    /* Heading Small */
    --heading-small-mobile: {$options['heading_small_mobile']};
    --heading-small-desktop: {$options['heading_small_desktop']};
    --heading-small-font-weight: {$options['heading_small_font_weight']};

    /* Button Typography - Default */
    --button-default-mobile: {$options['button_default_mobile']};
    --button-default-desktop: {$options['button_default_desktop']};
    --button-default-font-weight: {$options['button_default_font_weight']};

    /* Button Typography - Primary */
    --button-primary-mobile: {$options['button_primary_mobile']};
    --button-primary-desktop: {$options['button_primary_desktop']};
    --button-primary-font-weight: {$options['button_primary_font_weight']};

    /* Button Typography - Secondary */
    --button-secondary-mobile: {$options['button_secondary_mobile']};
    --button-secondary-desktop: {$options['button_secondary_desktop']};
    --button-secondary-font-weight: {$options['button_secondary_font_weight']};

    /* Button Typography - Danger */
    --button-danger-mobile: {$options['button_danger_mobile']};
    --button-danger-desktop: {$options['button_danger_desktop']};
    --button-danger-font-weight: {$options['button_danger_font_weight']};

    /* Button Typography - Text */
    --button-text-mobile: {$options['button_text_mobile']};
    --button-text-desktop: {$options['button_text_desktop']};
    --button-text-font-weight: {$options['button_text_font_weight']};

    /* Button Typography - Link */
    --button-link-mobile: {$options['button_link_mobile']};
    --button-link-desktop: {$options['button_link_desktop']};
    --button-link-font-weight: {$options['button_link_font_weight']};

    /* Navbar */
    --navbar-link-mobile: {$options['navbar_link_mobile']};
    --navbar-link-desktop: {$options['navbar_link_desktop']};
    --navbar-link-font-weight: {$options['navbar_link_font_weight']};

    /* Text Default */
    --text-default-mobile: {$options['text_default_mobile']};
    --text-default-desktop: {$options['text_default_desktop']};
    --text-default-font-weight: {$options['text_default_font_weight']};

    /* Text Small */
    --text-small-mobile: {$options['text_small_mobile']};
    --text-small-desktop: {$options['text_small_desktop']};
    --text-small-font-weight: {$options['text_small_font_weight']};

    /* Text Large */
    --text-large-mobile: {$options['text_large_mobile']};
    --text-large-desktop: {$options['text_large_desktop']};
    --text-large-font-weight: {$options['text_large_font_weight']};

EOT;
    }

    /**
     * Generates spacing CSS custom properties.
     *
     * @param array<string, mixed> $options CSS options.
     * @return string CSS variables for spacing.
     */
    public static function get_spacing_variables(array $options): string
    {
        return <<<EOT

    /* Column Gutter */
    --column-gutter-mobile: {$options['column_gutter_mobile']}px;
    --column-gutter-l: {$options['column_gutter_l']}px;

    /* Container Padding Vertical - Default */
    --container-padding-vertical-default-mobile: {$options['container_padding_vertical_default_mobile']}px;
    --container-padding-vertical-default-m: {$options['container_padding_vertical_default_m']}px;

    /* Container Padding Vertical - XSmall */
    --container-padding-vertical-xsmall-mobile: {$options['container_padding_vertical_xsmall_mobile']}px;
    --container-padding-vertical-xsmall-m: {$options['container_padding_vertical_xsmall_m']}px;

    /* Container Padding Vertical - Small */
    --container-padding-vertical-small-mobile: {$options['container_padding_vertical_small_mobile']}px;
    --container-padding-vertical-small-m: {$options['container_padding_vertical_small_m']}px;

    /* Container Padding Vertical - Large */
    --container-padding-vertical-large-mobile: {$options['container_padding_vertical_large_mobile']}px;
    --container-padding-vertical-large-m: {$options['container_padding_vertical_large_m']}px;

    /* Container Padding Vertical - XLarge */
    --container-padding-vertical-xlarge-mobile: {$options['container_padding_vertical_xlarge_mobile']}px;
    --container-padding-vertical-xlarge-m: {$options['container_padding_vertical_xlarge_m']}px;

    /* Container Padding Horizontal */
    --container-padding-horizontal-mobile: {$options['container_padding_horizontal_mobile']}px;
    --container-padding-horizontal-s: {$options['container_padding_horizontal_s']}px;
    --container-padding-horizontal-m: {$options['container_padding_horizontal_m']}px;

    /* Container Max Width */
    --container-max-width-default: {$options['container_max_width_default']}px;
    --container-max-width-xsmall: {$options['container_max_width_xsmall']}px;
    --container-max-width-small: {$options['container_max_width_small']}px;
    --container-max-width-large: {$options['container_max_width_large']}px;
    --container-max-width-xlarge: {$options['container_max_width_xlarge']}px;

    /* Element Widths */
    --element-width-small: {$options['element_width_small']}px;
    --element-width-medium: {$options['element_width_medium']}px;
    --element-width-large: {$options['element_width_large']}px;
    --element-width-xlarge: {$options['element_width_xlarge']}px;
    --element-width-2xlarge: {$options['element_width_2xlarge']}px;

    /* Element Margins - Default */
    --element-margin-default-mobile: {$options['element_margin_default_mobile']}px;
    --element-margin-default-l: {$options['element_margin_default_l']}px;

    /* Element Margins - XSmall */
    --element-margin-xsmall-mobile: {$options['element_margin_xsmall_mobile']}px;
    --element-margin-xsmall-l: {$options['element_margin_xsmall_l']}px;

    /* Element Margins - Small */
    --element-margin-small-mobile: {$options['element_margin_small_mobile']}px;
    --element-margin-small-l: {$options['element_margin_small_l']}px;

    /* Element Margins - Medium */
    --element-margin-medium-mobile: {$options['element_margin_medium_mobile']}px;
    --element-margin-medium-l: {$options['element_margin_medium_l']}px;

    /* Element Margins - Large */
    --element-margin-large-mobile: {$options['element_margin_large_mobile']}px;
    --element-margin-large-l: {$options['element_margin_large_l']}px;

    /* Element Margins - XLarge */
    --element-margin-xlarge-mobile: {$options['element_margin_xlarge_mobile']}px;
    --element-margin-xlarge-l: {$options['element_margin_xlarge_l']}px;

EOT;
    }
}
