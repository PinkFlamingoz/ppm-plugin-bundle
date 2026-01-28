<?php

/**
 * Token mapping for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Tokens
 */

namespace EPB\Tokens;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Mapper
 *
 * Provides mapping between plugin option keys and Tokens Studio paths.
 * This class defines the bidirectional relationship between the plugin's
 * internal option names and the Tokens Studio JSON structure.
 */
class Mapper
{
    /**
     * Returns the complete mapping of plugin option keys to Tokens Studio paths.
     *
     * @return array<string, string> Mapping of plugin keys to token paths.
     */
    public static function get_mapping(): array
    {
        return [
            // =================================================================
            // COLOR TOKENS
            // =================================================================

            // Text Colors
            'muted_color'                          => 'colors.text.muted.value',
            'emphasis_color'                       => 'colors.text.emphasis.value',
            'primary_color'                        => 'colors.text.primary.value',
            'secondary_color'                      => 'colors.text.secondary.value',
            'success_color'                        => 'colors.text.success.value',
            'warning_color'                        => 'colors.text.warning.value',
            'danger_color'                         => 'colors.text.danger.value',
            'text_background_color'                => 'colors.text.background.value',
            'body_color'                           => 'colors.text.body.value',

            // Background Colors
            'background_default_color'             => 'colors.background.default.value',
            'background_muted_color'               => 'colors.background.muted.value',
            'background_primary_color'             => 'colors.background.primary.value',
            'background_secondary_color'           => 'colors.background.secondary.value',

            // Button Default Colors
            'button_default_color'                 => 'colors.button.default.background.value',
            'button_default_hover_color'           => 'colors.button.default.backgroundHover.value',
            'button_default_text_color'            => 'colors.button.default.text.value',
            'button_default_hover_text_color'      => 'colors.button.default.textHover.value',

            // Button Primary Colors
            'button_primary_color'                 => 'colors.button.primary.background.value',
            'button_primary_hover_color'           => 'colors.button.primary.backgroundHover.value',
            'button_primary_text_color'            => 'colors.button.primary.text.value',
            'button_primary_hover_text_color'      => 'colors.button.primary.textHover.value',

            // Button Secondary Colors
            'button_secondary_color'               => 'colors.button.secondary.background.value',
            'button_secondary_hover_color'         => 'colors.button.secondary.backgroundHover.value',
            'button_secondary_text_color'          => 'colors.button.secondary.text.value',
            'button_secondary_hover_text_color'    => 'colors.button.secondary.textHover.value',

            // Button Danger Colors
            'button_danger_color'                  => 'colors.button.danger.background.value',
            'button_danger_hover_color'            => 'colors.button.danger.backgroundHover.value',
            'button_danger_text_color'             => 'colors.button.danger.text.value',
            'button_danger_hover_text_color'       => 'colors.button.danger.textHover.value',

            // Button Text & Link Colors
            'button_text_color'                    => 'colors.button.textStyle.color.value',
            'button_text_hover_color'              => 'colors.button.textStyle.hoverColor.value',
            'button_link_color'                    => 'colors.button.link.color.value',
            'button_link_hover_color'              => 'colors.button.link.hoverColor.value',

            // =================================================================
            // BREAKPOINT TOKENS
            // =================================================================

            'ppm_breakpoint_s'                     => 'breakpoints.s.value',
            'ppm_breakpoint_m'                     => 'breakpoints.m.value',
            'ppm_breakpoint_l'                     => 'breakpoints.l.value',
            'ppm_breakpoint_xl'                    => 'breakpoints.xl.value',

            // =================================================================
            // SPACING TOKENS - Container Padding Horizontal
            // =================================================================

            'container_padding_horizontal_mobile'  => 'spacing.container.padding.horizontal.mobile.value',
            'container_padding_horizontal_s'       => 'spacing.container.padding.horizontal.s.value',
            'container_padding_horizontal_m'       => 'spacing.container.padding.horizontal.m.value',

            // =================================================================
            // SPACING TOKENS - Container Padding Vertical
            // =================================================================

            'container_padding_vertical_default_mobile' => 'spacing.container.padding.vertical.default.mobile.value',
            'container_padding_vertical_default_m'      => 'spacing.container.padding.vertical.default.m.value',
            'container_padding_vertical_xsmall_mobile'  => 'spacing.container.padding.vertical.xsmall.mobile.value',
            'container_padding_vertical_xsmall_m'       => 'spacing.container.padding.vertical.xsmall.m.value',
            'container_padding_vertical_small_mobile'   => 'spacing.container.padding.vertical.small.mobile.value',
            'container_padding_vertical_small_m'        => 'spacing.container.padding.vertical.small.m.value',
            'container_padding_vertical_large_mobile'   => 'spacing.container.padding.vertical.large.mobile.value',
            'container_padding_vertical_large_m'        => 'spacing.container.padding.vertical.large.m.value',
            'container_padding_vertical_xlarge_mobile'  => 'spacing.container.padding.vertical.xlarge.mobile.value',
            'container_padding_vertical_xlarge_m'       => 'spacing.container.padding.vertical.xlarge.m.value',

            // =================================================================
            // SPACING TOKENS - Column Gutter
            // =================================================================

            'column_gutter_mobile'                 => 'spacing.column.gutter.mobile.value',
            'column_gutter_l'                      => 'spacing.column.gutter.l.value',

            // =================================================================
            // SPACING TOKENS - Element Margins
            // =================================================================

            'element_margin_default_mobile'        => 'spacing.element.margin.default.mobile.value',
            'element_margin_default_l'             => 'spacing.element.margin.default.l.value',
            'element_margin_xsmall_mobile'         => 'spacing.element.margin.xsmall.mobile.value',
            'element_margin_xsmall_l'              => 'spacing.element.margin.xsmall.l.value',
            'element_margin_small_mobile'          => 'spacing.element.margin.small.mobile.value',
            'element_margin_small_l'               => 'spacing.element.margin.small.l.value',
            'element_margin_medium_mobile'         => 'spacing.element.margin.medium.mobile.value',
            'element_margin_medium_l'              => 'spacing.element.margin.medium.l.value',
            'element_margin_large_mobile'          => 'spacing.element.margin.large.mobile.value',
            'element_margin_large_l'               => 'spacing.element.margin.large.l.value',
            'element_margin_xlarge_mobile'         => 'spacing.element.margin.xlarge.mobile.value',
            'element_margin_xlarge_l'              => 'spacing.element.margin.xlarge.l.value',

            // =================================================================
            // SIZING TOKENS - Container Max Width
            // =================================================================

            'container_max_width_default'          => 'sizing.container.maxWidth.default.value',
            'container_max_width_xsmall'           => 'sizing.container.maxWidth.xsmall.value',
            'container_max_width_small'            => 'sizing.container.maxWidth.small.value',
            'container_max_width_large'            => 'sizing.container.maxWidth.large.value',
            'container_max_width_xlarge'           => 'sizing.container.maxWidth.xlarge.value',

            // =================================================================
            // SIZING TOKENS - Element Width
            // =================================================================

            'element_width_small'                  => 'sizing.element.width.small.value',
            'element_width_medium'                 => 'sizing.element.width.medium.value',
            'element_width_large'                  => 'sizing.element.width.large.value',
            'element_width_xlarge'                 => 'sizing.element.width.xlarge.value',
            'element_width_2xlarge'                => 'sizing.element.width.2xlarge.value',

            // =================================================================
            // TYPOGRAPHY TOKENS - Base
            // =================================================================

            'base_font_size'                       => 'typography.fontSize.base.value',

            // =================================================================
            // TYPOGRAPHY TOKENS - Headings
            // =================================================================

            // 3XLarge Heading
            'heading_3xlarge_mobile'               => 'typography.heading.3xlarge.mobile.value',
            'heading_3xlarge_desktop'              => 'typography.heading.3xlarge.desktop.value',
            'heading_3xlarge_font_weight'          => 'typography.heading.3xlarge.fontWeight.value',

            // 2XLarge Heading
            'heading_2xlarge_mobile'               => 'typography.heading.2xlarge.mobile.value',
            'heading_2xlarge_desktop'              => 'typography.heading.2xlarge.desktop.value',
            'heading_2xlarge_font_weight'          => 'typography.heading.2xlarge.fontWeight.value',

            // XLarge Heading
            'heading_xlarge_mobile'                => 'typography.heading.xlarge.mobile.value',
            'heading_xlarge_desktop'               => 'typography.heading.xlarge.desktop.value',
            'heading_xlarge_font_weight'           => 'typography.heading.xlarge.fontWeight.value',

            // Large Heading
            'heading_large_mobile'                 => 'typography.heading.large.mobile.value',
            'heading_large_desktop'                => 'typography.heading.large.desktop.value',
            'heading_large_font_weight'            => 'typography.heading.large.fontWeight.value',

            // Medium Heading
            'heading_medium_mobile'                => 'typography.heading.medium.mobile.value',
            'heading_medium_desktop'               => 'typography.heading.medium.desktop.value',
            'heading_medium_font_weight'           => 'typography.heading.medium.fontWeight.value',

            // Small Heading
            'heading_small_mobile'                 => 'typography.heading.small.mobile.value',
            'heading_small_desktop'                => 'typography.heading.small.desktop.value',
            'heading_small_font_weight'            => 'typography.heading.small.fontWeight.value',

            // =================================================================
            // TYPOGRAPHY TOKENS - Button Typography
            // =================================================================

            // Default Button
            'button_default_mobile'                => 'typography.button.default.mobile.value',
            'button_default_desktop'               => 'typography.button.default.desktop.value',
            'button_default_font_weight'           => 'typography.button.default.fontWeight.value',

            // Primary Button
            'button_primary_mobile'                => 'typography.button.primary.mobile.value',
            'button_primary_desktop'               => 'typography.button.primary.desktop.value',
            'button_primary_font_weight'           => 'typography.button.primary.fontWeight.value',

            // Secondary Button
            'button_secondary_mobile'              => 'typography.button.secondary.mobile.value',
            'button_secondary_desktop'             => 'typography.button.secondary.desktop.value',
            'button_secondary_font_weight'         => 'typography.button.secondary.fontWeight.value',

            // Danger Button
            'button_danger_mobile'                 => 'typography.button.danger.mobile.value',
            'button_danger_desktop'                => 'typography.button.danger.desktop.value',
            'button_danger_font_weight'            => 'typography.button.danger.fontWeight.value',

            // Text Button
            'button_text_mobile'                   => 'typography.button.text.mobile.value',
            'button_text_desktop'                  => 'typography.button.text.desktop.value',
            'button_text_font_weight'              => 'typography.button.text.fontWeight.value',

            // Link Button
            'button_link_mobile'                   => 'typography.button.link.mobile.value',
            'button_link_desktop'                  => 'typography.button.link.desktop.value',
            'button_link_font_weight'              => 'typography.button.link.fontWeight.value',

            // =================================================================
            // TYPOGRAPHY TOKENS - Navbar
            // =================================================================

            'navbar_link_mobile'                   => 'typography.navbar.link.mobile.value',
            'navbar_link_desktop'                  => 'typography.navbar.link.desktop.value',
            'navbar_link_font_weight'              => 'typography.navbar.link.fontWeight.value',

            // =================================================================
            // TYPOGRAPHY TOKENS - Text Styles
            // =================================================================

            // Default Text
            'text_default_mobile'                  => 'typography.text.default.mobile.value',
            'text_default_desktop'                 => 'typography.text.default.desktop.value',
            'text_default_font_weight'             => 'typography.text.default.fontWeight.value',

            // Small Text
            'text_small_mobile'                    => 'typography.text.small.mobile.value',
            'text_small_desktop'                   => 'typography.text.small.desktop.value',
            'text_small_font_weight'               => 'typography.text.small.fontWeight.value',

            // Large Text
            'text_large_mobile'                    => 'typography.text.large.mobile.value',
            'text_large_desktop'                   => 'typography.text.large.desktop.value',
            'text_large_font_weight'               => 'typography.text.large.fontWeight.value',
        ];
    }

    /**
     * Gets a nested value from an array using dot notation path.
     *
     * @param array  $array The array to search.
     * @param string $path  The dot-notation path (e.g., 'colors.text.primary.value').
     * @return mixed|null The value or null if not found.
     */
    public static function get_nested_value(array $array, string $path): mixed
    {
        $keys  = explode('.', $path);
        $value = $array;

        foreach ($keys as $key) {
            if (!is_array($value) || !array_key_exists($key, $value)) {
                return null;
            }
            $value = $value[$key];
        }

        return $value;
    }

    /**
     * Sets a nested value in an array using dot notation path.
     *
     * @param array  $array The array to modify.
     * @param string $path  The dot-notation path.
     * @param mixed  $value The value to set.
     * @return array The modified array.
     */
    public static function set_nested_value(array $array, string $path, mixed $value): array
    {
        $keys = explode('.', $path);
        $ref  = &$array;

        foreach ($keys as $key) {
            if (!isset($ref[$key]) || !is_array($ref[$key])) {
                $ref[$key] = [];
            }
            $ref = &$ref[$key];
        }

        $ref = $value;

        return $array;
    }
}
