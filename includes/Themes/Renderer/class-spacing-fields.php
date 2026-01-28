<?php

/**
 * Spacing Fields Renderer
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 */

namespace EPB\Themes\Renderer;

if (! defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Spacing_Fields
 *
 * Renders spacing-related form fields (margins, padding, widths) for theme customization.
 */
class Spacing_Fields
{

    /**
     * Renders element margins fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_element_margins(array $options): void
    {
?>
        <fieldset class="fieldset-group-inner-outer">
            <legend><?php esc_html_e('Margins', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            $sizes = [
                'default' => __('Default', 'enhanced-plugin-bundle'),
                'xsmall'  => __('XSmall', 'enhanced-plugin-bundle'),
                'small'   => __('Small', 'enhanced-plugin-bundle'),
                'medium'  => __('Medium', 'enhanced-plugin-bundle'),
                'large'   => __('Large', 'enhanced-plugin-bundle'),
                'xlarge'  => __('XLarge', 'enhanced-plugin-bundle'),
            ];

            foreach ($sizes as $size => $label) :
            ?>
                <fieldset class="fieldset-group-inner group-styles">
                    <legend><?php echo esc_html($label); ?></legend>
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => "element_margin_{$size}_mobile", 'label' => sprintf(__('%s Mobile (px)', 'enhanced-plugin-bundle'), $label), 'step' => 1],
                            ['name' => "element_margin_{$size}_l", 'label' => sprintf(__('%s L (px)', 'enhanced-plugin-bundle'), $label), 'step' => 1],
                        ],
                        $options
                    );
                    ?>
                </fieldset>
            <?php
            endforeach;
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders element widths fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_element_widths(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles fieldset-flex">
            <legend><?php esc_html_e('Widths', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => 'element_width_small', 'label' => __('Small (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'element_width_medium', 'label' => __('Medium (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'element_width_large', 'label' => __('Large (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'element_width_xlarge', 'label' => __('XLarge (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'element_width_2xlarge', 'label' => __('2XLarge (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders container vertical padding fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_container_padding_vertical(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner-outer">
            <legend><?php esc_html_e('Padding Vertical', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            $sizes = [
                'default' => __('Default', 'enhanced-plugin-bundle'),
                'xsmall'  => __('XSmall', 'enhanced-plugin-bundle'),
                'small'   => __('Small', 'enhanced-plugin-bundle'),
                'large'   => __('Large', 'enhanced-plugin-bundle'),
                'xlarge'  => __('XLarge', 'enhanced-plugin-bundle'),
            ];

            foreach ($sizes as $size => $label) :
            ?>
                <fieldset class="fieldset-group-inner group-styles">
                    <legend><?php echo esc_html($label); ?></legend>
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => "container_padding_vertical_{$size}_mobile", 'label' => sprintf(__('%s Mobile (px)', 'enhanced-plugin-bundle'), $label), 'step' => 1],
                            ['name' => "container_padding_vertical_{$size}_m", 'label' => sprintf(__('%s M (px)', 'enhanced-plugin-bundle'), $label), 'step' => 1],
                        ],
                        $options
                    );
                    ?>
                </fieldset>
            <?php
            endforeach;
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders container max width fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_container_max_width(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles">
            <legend><?php esc_html_e('Max Width', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => 'container_max_width_default', 'label' => __('Default (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_max_width_xsmall', 'label' => __('XSmall (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_max_width_small', 'label' => __('Small (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_max_width_large', 'label' => __('Large (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_max_width_xlarge', 'label' => __('XLarge (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders container horizontal padding fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_container_padding_horizontal(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles">
            <legend><?php esc_html_e('Padding Horizontal', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => 'container_padding_horizontal_mobile', 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_padding_horizontal_s', 'label' => __('S (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'container_padding_horizontal_m', 'label' => __('M (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders column gutter fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_column_gutter(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles">
            <legend><?php esc_html_e('Column Gutter', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => 'column_gutter_mobile', 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'column_gutter_l', 'label' => __('L (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders breakpoints fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_breakpoints(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles">
            <legend><?php esc_html_e('Breakpoints', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => 'ppm_breakpoint_s', 'label' => __('Breakpoint S (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'ppm_breakpoint_m', 'label' => __('Breakpoint M (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'ppm_breakpoint_l', 'label' => __('Breakpoint L (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => 'ppm_breakpoint_xl', 'label' => __('Breakpoint XL (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
<?php
    }
}
