<?php

/**
 * Token exporter for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Tokens
 */

namespace EPB\Tokens;

use EPB\CSS\Options as CSSOptions;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Exporter
 *
 * Handles exporting CSS options to Tokens Studio JSON format.
 */
class Exporter
{
    /**
     * Exports current CSS options to Tokens Studio format.
     *
     * @return array The tokens in Tokens Studio format.
     */
    public static function export(): array
    {
        $options = CSSOptions::get();

        return [
            'colors'      => self::export_colors($options),
            'breakpoints' => self::export_breakpoints($options),
            'spacing'     => self::export_spacing($options),
            'sizing'      => self::export_sizing($options),
            'typography'  => self::export_typography($options),
        ];
    }

    /**
     * Exports color tokens.
     *
     * @param array $options CSS options.
     * @return array Color tokens.
     */
    private static function export_colors(array $options): array
    {
        return [
            'text'       => [
                'muted'      => ['value' => $options['muted_color'], 'type' => 'color'],
                'emphasis'   => ['value' => $options['emphasis_color'], 'type' => 'color'],
                'primary'    => ['value' => $options['primary_color'], 'type' => 'color'],
                'secondary'  => ['value' => $options['secondary_color'], 'type' => 'color'],
                'success'    => ['value' => $options['success_color'], 'type' => 'color'],
                'warning'    => ['value' => $options['warning_color'], 'type' => 'color'],
                'danger'     => ['value' => $options['danger_color'], 'type' => 'color'],
                'background' => ['value' => $options['text_background_color'], 'type' => 'color'],
                'body'       => ['value' => $options['body_color'], 'type' => 'color'],
            ],
            'background' => [
                'default'   => ['value' => $options['background_default_color'], 'type' => 'color'],
                'muted'     => ['value' => $options['background_muted_color'], 'type' => 'color'],
                'primary'   => ['value' => $options['background_primary_color'], 'type' => 'color'],
                'secondary' => ['value' => $options['background_secondary_color'], 'type' => 'color'],
            ],
            'button'     => [
                'default'   => [
                    'background'      => ['value' => $options['button_default_color'], 'type' => 'color'],
                    'backgroundHover' => ['value' => $options['button_default_hover_color'], 'type' => 'color'],
                    'text'            => ['value' => $options['button_default_text_color'], 'type' => 'color'],
                    'textHover'       => ['value' => $options['button_default_hover_text_color'], 'type' => 'color'],
                ],
                'primary'   => [
                    'background'      => ['value' => $options['button_primary_color'], 'type' => 'color'],
                    'backgroundHover' => ['value' => $options['button_primary_hover_color'], 'type' => 'color'],
                    'text'            => ['value' => $options['button_primary_text_color'], 'type' => 'color'],
                    'textHover'       => ['value' => $options['button_primary_hover_text_color'], 'type' => 'color'],
                ],
                'secondary' => [
                    'background'      => ['value' => $options['button_secondary_color'], 'type' => 'color'],
                    'backgroundHover' => ['value' => $options['button_secondary_hover_color'], 'type' => 'color'],
                    'text'            => ['value' => $options['button_secondary_text_color'], 'type' => 'color'],
                    'textHover'       => ['value' => $options['button_secondary_hover_text_color'], 'type' => 'color'],
                ],
                'danger'    => [
                    'background'      => ['value' => $options['button_danger_color'], 'type' => 'color'],
                    'backgroundHover' => ['value' => $options['button_danger_hover_color'], 'type' => 'color'],
                    'text'            => ['value' => $options['button_danger_text_color'], 'type' => 'color'],
                    'textHover'       => ['value' => $options['button_danger_hover_text_color'], 'type' => 'color'],
                ],
                'textStyle' => [
                    'color'      => ['value' => $options['button_text_color'], 'type' => 'color'],
                    'hoverColor' => ['value' => $options['button_text_hover_color'], 'type' => 'color'],
                ],
                'link'      => [
                    'color'      => ['value' => $options['button_link_color'], 'type' => 'color'],
                    'hoverColor' => ['value' => $options['button_link_hover_color'], 'type' => 'color'],
                ],
            ],
        ];
    }

    /**
     * Exports breakpoint tokens.
     *
     * @param array $options CSS options.
     * @return array Breakpoint tokens.
     */
    private static function export_breakpoints(array $options): array
    {
        return [
            's'  => ['value' => $options['ppm_breakpoint_s'], 'type' => 'dimension'],
            'm'  => ['value' => $options['ppm_breakpoint_m'], 'type' => 'dimension'],
            'l'  => ['value' => $options['ppm_breakpoint_l'], 'type' => 'dimension'],
            'xl' => ['value' => $options['ppm_breakpoint_xl'], 'type' => 'dimension'],
        ];
    }

    /**
     * Exports spacing tokens.
     *
     * @param array $options CSS options.
     * @return array Spacing tokens.
     */
    private static function export_spacing(array $options): array
    {
        return [
            'container' => [
                'padding' => [
                    'horizontal' => [
                        'mobile' => ['value' => (string) $options['container_padding_horizontal_mobile'], 'type' => 'spacing'],
                        's'      => ['value' => (string) $options['container_padding_horizontal_s'], 'type' => 'spacing'],
                        'm'      => ['value' => (string) $options['container_padding_horizontal_m'], 'type' => 'spacing'],
                    ],
                    'vertical'   => [
                        'default' => [
                            'mobile' => ['value' => (string) $options['container_padding_vertical_default_mobile'], 'type' => 'spacing'],
                            'm'      => ['value' => (string) $options['container_padding_vertical_default_m'], 'type' => 'spacing'],
                        ],
                        'xsmall'  => [
                            'mobile' => ['value' => (string) $options['container_padding_vertical_xsmall_mobile'], 'type' => 'spacing'],
                            'm'      => ['value' => (string) $options['container_padding_vertical_xsmall_m'], 'type' => 'spacing'],
                        ],
                        'small'   => [
                            'mobile' => ['value' => (string) $options['container_padding_vertical_small_mobile'], 'type' => 'spacing'],
                            'm'      => ['value' => (string) $options['container_padding_vertical_small_m'], 'type' => 'spacing'],
                        ],
                        'large'   => [
                            'mobile' => ['value' => (string) $options['container_padding_vertical_large_mobile'], 'type' => 'spacing'],
                            'm'      => ['value' => (string) $options['container_padding_vertical_large_m'], 'type' => 'spacing'],
                        ],
                        'xlarge'  => [
                            'mobile' => ['value' => (string) $options['container_padding_vertical_xlarge_mobile'], 'type' => 'spacing'],
                            'm'      => ['value' => (string) $options['container_padding_vertical_xlarge_m'], 'type' => 'spacing'],
                        ],
                    ],
                ],
            ],
            'column'    => [
                'gutter' => [
                    'mobile' => ['value' => (string) $options['column_gutter_mobile'], 'type' => 'spacing'],
                    'l'      => ['value' => (string) $options['column_gutter_l'], 'type' => 'spacing'],
                ],
            ],
            'element'   => [
                'margin' => [
                    'default' => [
                        'mobile' => ['value' => (string) $options['element_margin_default_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_default_l'], 'type' => 'spacing'],
                    ],
                    'xsmall'  => [
                        'mobile' => ['value' => (string) $options['element_margin_xsmall_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_xsmall_l'], 'type' => 'spacing'],
                    ],
                    'small'   => [
                        'mobile' => ['value' => (string) $options['element_margin_small_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_small_l'], 'type' => 'spacing'],
                    ],
                    'medium'  => [
                        'mobile' => ['value' => (string) $options['element_margin_medium_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_medium_l'], 'type' => 'spacing'],
                    ],
                    'large'   => [
                        'mobile' => ['value' => (string) $options['element_margin_large_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_large_l'], 'type' => 'spacing'],
                    ],
                    'xlarge'  => [
                        'mobile' => ['value' => (string) $options['element_margin_xlarge_mobile'], 'type' => 'spacing'],
                        'l'      => ['value' => (string) $options['element_margin_xlarge_l'], 'type' => 'spacing'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Exports sizing tokens.
     *
     * @param array $options CSS options.
     * @return array Sizing tokens.
     */
    private static function export_sizing(array $options): array
    {
        return [
            'container' => [
                'maxWidth' => [
                    'default' => ['value' => (string) $options['container_max_width_default'], 'type' => 'sizing'],
                    'xsmall'  => ['value' => (string) $options['container_max_width_xsmall'], 'type' => 'sizing'],
                    'small'   => ['value' => (string) $options['container_max_width_small'], 'type' => 'sizing'],
                    'large'   => ['value' => (string) $options['container_max_width_large'], 'type' => 'sizing'],
                    'xlarge'  => ['value' => (string) $options['container_max_width_xlarge'], 'type' => 'sizing'],
                ],
            ],
            'element'   => [
                'width' => [
                    'small'   => ['value' => (string) $options['element_width_small'], 'type' => 'sizing'],
                    'medium'  => ['value' => (string) $options['element_width_medium'], 'type' => 'sizing'],
                    'large'   => ['value' => (string) $options['element_width_large'], 'type' => 'sizing'],
                    'xlarge'  => ['value' => (string) $options['element_width_xlarge'], 'type' => 'sizing'],
                    '2xlarge' => ['value' => (string) $options['element_width_2xlarge'], 'type' => 'sizing'],
                ],
            ],
        ];
    }

    /**
     * Exports typography tokens.
     *
     * @param array $options CSS options.
     * @return array Typography tokens.
     */
    private static function export_typography(array $options): array
    {
        return [
            'fontSize' => [
                'base' => ['value' => (string) $options['base_font_size'], 'type' => 'fontSizes'],
            ],
            'heading'  => [
                '3xlarge' => [
                    'mobile'     => ['value' => (string) $options['heading_3xlarge_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_3xlarge_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_3xlarge_font_weight'], 'type' => 'fontWeights'],
                ],
                '2xlarge' => [
                    'mobile'     => ['value' => (string) $options['heading_2xlarge_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_2xlarge_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_2xlarge_font_weight'], 'type' => 'fontWeights'],
                ],
                'xlarge'  => [
                    'mobile'     => ['value' => (string) $options['heading_xlarge_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_xlarge_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_xlarge_font_weight'], 'type' => 'fontWeights'],
                ],
                'large'   => [
                    'mobile'     => ['value' => (string) $options['heading_large_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_large_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_large_font_weight'], 'type' => 'fontWeights'],
                ],
                'medium'  => [
                    'mobile'     => ['value' => (string) $options['heading_medium_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_medium_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_medium_font_weight'], 'type' => 'fontWeights'],
                ],
                'small'   => [
                    'mobile'     => ['value' => (string) $options['heading_small_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['heading_small_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['heading_small_font_weight'], 'type' => 'fontWeights'],
                ],
            ],
            'button'   => [
                'default'   => [
                    'mobile'     => ['value' => (string) $options['button_default_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_default_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_default_font_weight'], 'type' => 'fontWeights'],
                ],
                'primary'   => [
                    'mobile'     => ['value' => (string) $options['button_primary_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_primary_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_primary_font_weight'], 'type' => 'fontWeights'],
                ],
                'secondary' => [
                    'mobile'     => ['value' => (string) $options['button_secondary_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_secondary_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_secondary_font_weight'], 'type' => 'fontWeights'],
                ],
                'danger'    => [
                    'mobile'     => ['value' => (string) $options['button_danger_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_danger_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_danger_font_weight'], 'type' => 'fontWeights'],
                ],
                'text'      => [
                    'mobile'     => ['value' => (string) $options['button_text_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_text_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_text_font_weight'], 'type' => 'fontWeights'],
                ],
                'link'      => [
                    'mobile'     => ['value' => (string) $options['button_link_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['button_link_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['button_link_font_weight'], 'type' => 'fontWeights'],
                ],
            ],
            'navbar'   => [
                'link' => [
                    'mobile'     => ['value' => (string) $options['navbar_link_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['navbar_link_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['navbar_link_font_weight'], 'type' => 'fontWeights'],
                ],
            ],
            'text'     => [
                'default' => [
                    'mobile'     => ['value' => (string) $options['text_default_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['text_default_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['text_default_font_weight'], 'type' => 'fontWeights'],
                ],
                'small'   => [
                    'mobile'     => ['value' => (string) $options['text_small_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['text_small_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['text_small_font_weight'], 'type' => 'fontWeights'],
                ],
                'large'   => [
                    'mobile'     => ['value' => (string) $options['text_large_mobile'], 'type' => 'fontSizes'],
                    'desktop'    => ['value' => (string) $options['text_large_desktop'], 'type' => 'fontSizes'],
                    'fontWeight' => ['value' => (string) $options['text_large_font_weight'], 'type' => 'fontWeights'],
                ],
            ],
        ];
    }

    /**
     * Exports tokens as a JSON string.
     *
     * @param int $flags JSON encode flags.
     * @return string JSON-encoded tokens.
     */
    public static function export_json(int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES): string
    {
        return json_encode(self::export(), $flags);
    }
}
