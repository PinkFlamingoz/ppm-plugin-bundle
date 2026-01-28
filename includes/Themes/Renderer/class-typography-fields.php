<?php

/**
 * Typography Fields Renderer
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
 * Class Typography_Fields
 *
 * Renders typography-related form fields for theme customization.
 */
class Typography_Fields
{

    /**
     * Renders text options fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_text_options(array $options): void
    {
?>
        <fieldset id="TEXTOPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Text Options', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            self::render_text_size_group('default', __('Text Default Options (Body)', 'enhanced-plugin-bundle'), $options);
            self::render_text_size_group('small', __('Text Small Options', 'enhanced-plugin-bundle'), $options);
            self::render_text_size_group('large', __('Text Large Options', 'enhanced-plugin-bundle'), $options);
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders a text size group (mobile, desktop, font weight).
     *
     * @param string               $size    Size identifier.
     * @param string               $label   Section label.
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_text_size_group(string $size, string $label, array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles">
            <legend><?php echo esc_html($label); ?></legend>
            <?php
            Form_Builder::render_input_fields(
                [
                    ['name' => "text_{$size}_mobile", 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => "text_{$size}_desktop", 'label' => __('Desktop (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ['name' => "text_{$size}_font_weight", 'label' => __('Font Weight', 'enhanced-plugin-bundle'), 'step' => 1],
                ],
                $options
            );
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders headline options fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_heading_options(array $options): void
    {
    ?>
        <fieldset id="HEADLINEOPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Headline Font Sizes & Weights', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            $headings = [
                '3xlarge' => __('Heading 3XL', 'enhanced-plugin-bundle'),
                '2xlarge' => __('Heading 2XL', 'enhanced-plugin-bundle'),
                'xlarge'  => __('Heading XL', 'enhanced-plugin-bundle'),
                'large'   => __('Heading Large', 'enhanced-plugin-bundle'),
                'medium'  => __('Heading Medium', 'enhanced-plugin-bundle'),
                'small'   => __('Heading Small', 'enhanced-plugin-bundle'),
            ];

            foreach ($headings as $size => $label) :
            ?>
                <fieldset class="fieldset-group-inner group-styles">
                    <legend><?php echo esc_html($label); ?></legend>
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => "heading_{$size}_mobile", 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                            ['name' => "heading_{$size}_desktop", 'label' => __('Desktop (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                            ['name' => "heading_{$size}_font_weight", 'label' => __('Font Weight', 'enhanced-plugin-bundle'), 'step' => 1],
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
     * Renders button typography options fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_button_typography(array $options): void
    {
    ?>
        <fieldset id="BUTTONOPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Button Font Sizes & Weights', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            $buttons = [
                'default'   => __('Button Default', 'enhanced-plugin-bundle'),
                'primary'   => __('Button Primary', 'enhanced-plugin-bundle'),
                'secondary' => __('Button Secondary', 'enhanced-plugin-bundle'),
                'danger'    => __('Button Danger', 'enhanced-plugin-bundle'),
                'text'      => __('Button Text', 'enhanced-plugin-bundle'),
                'link'      => __('Button Link', 'enhanced-plugin-bundle'),
            ];

            foreach ($buttons as $type => $label) :
            ?>
                <fieldset class="fieldset-group-inner group-styles">
                    <legend><?php echo esc_html($label); ?></legend>
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => "button_{$type}_mobile", 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                            ['name' => "button_{$type}_desktop", 'label' => __('Desktop (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                            ['name' => "button_{$type}_font_weight", 'label' => __('Font Weight', 'enhanced-plugin-bundle'), 'step' => 1],
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
     * Renders base options fieldset (breakpoints, navbar, base font).
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_base_options(array $options): void
    {
    ?>
        <fieldset id="BASEOPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Base Options', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            // Breakpoints.
            Spacing_Fields::render_breakpoints($options);
            ?>
            <!-- Navbar Link Options -->
            <fieldset class="fieldset-group-inner group-styles">
                <legend><?php esc_html_e('Navbar Link Options', 'enhanced-plugin-bundle'); ?></legend>
                <?php
                Form_Builder::render_input_fields(
                    [
                        ['name' => 'navbar_link_mobile', 'label' => __('Mobile (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                        ['name' => 'navbar_link_desktop', 'label' => __('Desktop (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                        ['name' => 'navbar_link_font_weight', 'label' => __('Font Weight', 'enhanced-plugin-bundle'), 'step' => 1],
                    ],
                    $options
                );
                ?>
            </fieldset>
            <!-- Base Font Size -->
            <fieldset class="fieldset-group-inner group-styles">
                <legend><?php esc_html_e('Base Font (HTML)', 'enhanced-plugin-bundle'); ?></legend>
                <?php
                Form_Builder::render_input_fields(
                    [
                        ['name' => 'base_font_size', 'label' => __('Base Font Size (px)', 'enhanced-plugin-bundle'), 'step' => 1],
                    ],
                    $options
                );
                ?>
            </fieldset>
        </fieldset>
<?php
    }
}
