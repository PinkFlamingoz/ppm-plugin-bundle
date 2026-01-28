<?php

/**
 * Color Fields Renderer
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
 * Class Color_Fields
 *
 * Renders color-related form fields for theme customization.
 */
class Color_Fields
{

    /**
     * Renders all color option fieldsets.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render(array $options): void
    {
?>
        <fieldset id="COLOROPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Color Options', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            self::render_text_colors($options);
            self::render_background_colors($options);
            self::render_button_colors($options);
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders text color fields.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_text_colors(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles button-accordion">
            <legend><?php esc_html_e('Text Colors', 'enhanced-plugin-bundle'); ?></legend>
            <details>
                <summary><?php esc_html_e('Colors', 'enhanced-plugin-bundle'); ?></summary>
                <div class="picker-group">
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => 'muted_color', 'label' => __('Muted Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'emphasis_color', 'label' => __('Emphasis Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'primary_color', 'label' => __('Primary Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'secondary_color', 'label' => __('Secondary Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'success_color', 'label' => __('Success Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'warning_color', 'label' => __('Warning Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'danger_color', 'label' => __('Danger Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'text_background_color', 'label' => __('Text Background Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'body_color', 'label' => __('Body Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                        ],
                        $options
                    );
                    ?>
                </div>
            </details>
        </fieldset>
    <?php
    }

    /**
     * Renders background color fields.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_background_colors(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles button-accordion">
            <legend><?php esc_html_e('Background Colors', 'enhanced-plugin-bundle'); ?></legend>
            <details>
                <summary><?php esc_html_e('Colors', 'enhanced-plugin-bundle'); ?></summary>
                <div class="picker-group">
                    <?php
                    Form_Builder::render_input_fields(
                        [
                            ['name' => 'background_default_color', 'label' => __('Background Default', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'background_muted_color', 'label' => __('Background Muted', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'background_primary_color', 'label' => __('Background Primary', 'enhanced-plugin-bundle'), 'type' => 'color'],
                            ['name' => 'background_secondary_color', 'label' => __('Background Secondary', 'enhanced-plugin-bundle'), 'type' => 'color'],
                        ],
                        $options
                    );
                    ?>
                </div>
            </details>
        </fieldset>
    <?php
    }

    /**
     * Renders button color fields.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    public static function render_button_colors(array $options): void
    {
    ?>
        <fieldset class="fieldset-group-inner group-styles button-accordion">
            <legend><?php esc_html_e('Button Colors', 'enhanced-plugin-bundle'); ?></legend>
            <?php self::render_button_color_group('default', __('Default Button', 'enhanced-plugin-bundle'), $options); ?>
            <?php self::render_button_color_group('primary', __('Primary Button', 'enhanced-plugin-bundle'), $options); ?>
            <?php self::render_button_color_group('secondary', __('Secondary Button', 'enhanced-plugin-bundle'), $options); ?>
            <?php self::render_button_color_group('danger', __('Danger Button', 'enhanced-plugin-bundle'), $options); ?>
            <?php self::render_text_button_colors($options); ?>
            <?php self::render_link_button_colors($options); ?>
        </fieldset>
    <?php
    }

    /**
     * Renders a button color group (color, hover, text color, hover text color).
     *
     * @param string               $type    Button type (default, primary, secondary, danger).
     * @param string               $label   Section label.
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_button_color_group(string $type, string $label, array $options): void
    {
    ?>
        <details>
            <summary><?php echo esc_html($label); ?></summary>
            <div class="picker-group">
                <?php
                Form_Builder::render_input_fields(
                    [
                        ['name' => "button_{$type}_color", 'label' => sprintf(__('Button %s Color', 'enhanced-plugin-bundle'), ucfirst($type)), 'type' => 'color'],
                        ['name' => "button_{$type}_hover_color", 'label' => sprintf(__('Button %s Hover Color', 'enhanced-plugin-bundle'), ucfirst($type)), 'type' => 'color'],
                        ['name' => "button_{$type}_text_color", 'label' => sprintf(__('Button %s Text Color', 'enhanced-plugin-bundle'), ucfirst($type)), 'type' => 'color'],
                        ['name' => "button_{$type}_hover_text_color", 'label' => sprintf(__('Button %s Hover Text Color', 'enhanced-plugin-bundle'), ucfirst($type)), 'type' => 'color'],
                    ],
                    $options
                );
                ?>
            </div>
        </details>
    <?php
    }

    /**
     * Renders text button color fields.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_text_button_colors(array $options): void
    {
    ?>
        <details>
            <summary><?php esc_html_e('Text Button', 'enhanced-plugin-bundle'); ?></summary>
            <div class="picker-group">
                <?php
                Form_Builder::render_input_fields(
                    [
                        ['name' => 'button_text_color', 'label' => __('Button Text Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                        ['name' => 'button_text_hover_color', 'label' => __('Button Text Hover Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                    ],
                    $options
                );
                ?>
            </div>
        </details>
    <?php
    }

    /**
     * Renders link button color fields.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_link_button_colors(array $options): void
    {
    ?>
        <details>
            <summary><?php esc_html_e('Link Button', 'enhanced-plugin-bundle'); ?></summary>
            <div class="picker-group">
                <?php
                Form_Builder::render_input_fields(
                    [
                        ['name' => 'button_link_color', 'label' => __('Button Link Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                        ['name' => 'button_link_hover_color', 'label' => __('Button Link Hover Color', 'enhanced-plugin-bundle'), 'type' => 'color'],
                    ],
                    $options
                );
                ?>
            </div>
        </details>
<?php
    }
}
