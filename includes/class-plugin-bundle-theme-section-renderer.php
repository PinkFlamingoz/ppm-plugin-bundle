<?php
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Class Plugin_Bundle_Theme_Renderer
 *
 * Handles the rendering of UI sections for theme management in the admin interface.
 * It provides methods for displaying the parent theme upload section as well as the
 * child theme creation and customization section.
 */
class Plugin_Bundle_Theme_Renderer
{
    /**
     * Renders the section for uploading and installing the parent theme.
     *
     * Displays a header with the current installation/activation status of the parent theme
     * and provides a file input along with a submit button to upload a ZIP file.
     *
     * @return void
     */
    public static function render_upload_parent_theme_section()
    {
?>
        <div class="ppm-section">
            <h2><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_PARENT_THEME)); ?>
                <?php
                // Display the parent theme status badge based on whether YOOtheme is installed and active.
                if (Plugin_Bundle_Themes::is_yootheme_installed()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INSTALLED)); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INACTIVE)); ?></span>
                <?php endif; ?>
            </h2>
            <p><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_INSTRUCTIONS)); ?></p>
            <div class="new-plugin-container">
                <input type="file" name="theme_zip" id="theme-zip" class="form-input file-input">
                <button type="submit" name="upload_theme" class="ppm-button ppm-button-primary">
                    <?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_BUTTON)); ?>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Renders the section for creating and activating the child theme.
     *
     * Displays a form pre-populated with the current CSS options used for styling the child theme.
     * The form is divided into several fieldsets for color options, element options,
     * container options, text options, base options, headline options, and button options.
     * When the form is submitted, these options will be saved and the child theme created/activated.
     *
     * @return void
     */
    public static function render_create_child_theme_section()
    {
        // Retrieve the current theme CSS options.
        $options = Plugin_Bundle_Css_Options::get_theme_options();
    ?>
        <div class="ppm-section child-theme-options">
            <h2><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CREATE_CHILD_THEME)); ?>
                <?php
                // Display child theme status badge based on current state.
                if (Plugin_Bundle_Themes::is_child_theme_active()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_ACTIVE)); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INACTIVE)); ?></span>
                <?php endif; ?>
            </h2>
            <p>
                <?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_THEME_INSTRUCTIONS)); ?>
            </p>
            <form method="post" action="">
                <div class="child-theme-form">
                    <div class="ppm-left">
                        <!-- Color Options -->
                        <fieldset id="COLOROPTIONS" class="fieldset-group group-options">
                            <legend>Color Options</legend>
                            <!-- Text Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend>Text Colors</legend>
                                <details>
                                    <summary>Colors</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[muted_color]" id="muted_color" placeholder=" " value="<?php echo esc_attr($options['muted_color']); ?>">
                                                <span class="input__label">Muted Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[emphasis_color]" id="emphasis_color" placeholder=" " value="<?php echo esc_attr($options['emphasis_color']); ?>">
                                                <span class="input__label">Emphasis Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[primary_color]" id="primary_color" placeholder=" " value="<?php echo esc_attr($options['primary_color']); ?>">
                                                <span class="input__label">Primary Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[secondary_color]" id="secondary_color" placeholder=" " value="<?php echo esc_attr($options['secondary_color']); ?>">
                                                <span class="input__label">Secondary Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[success_color]" id="success_color" placeholder=" " value="<?php echo esc_attr($options['success_color']); ?>">
                                                <span class="input__label">Success Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[warning_color]" id="warning_color" placeholder=" " value="<?php echo esc_attr($options['warning_color']); ?>">
                                                <span class="input__label">Warning Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[danger_color]" id="danger_color" placeholder=" " value="<?php echo esc_attr($options['danger_color']); ?>">
                                                <span class="input__label">Danger Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[text_background_color]" id="text_background_color" placeholder=" " value="<?php echo esc_attr($options['text_background_color']); ?>">
                                                <span class="input__label">Text Background Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[body_color]" id="body_color" placeholder=" " value="<?php echo esc_attr($options['body_color']); ?>">
                                                <span class="input__label">Body Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                            </fieldset>
                            <!-- Background Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend>Background Colors</legend>
                                <details>
                                    <summary>Colors</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[background_default_color]" id="background_default_color" placeholder=" " value="<?php echo esc_attr($options['background_default_color']); ?>">
                                                <span class="input__label">Background Default</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[background_muted_color]" id="background_muted_color" placeholder=" " value="<?php echo esc_attr($options['background_muted_color']); ?>">
                                                <span class="input__label">Background Muted</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[background_primary_color]" id="background_primary_color" placeholder=" " value="<?php echo esc_attr($options['background_primary_color']); ?>">
                                                <span class="input__label">Background Primary</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[background_secondary_color]" id="background_secondary_color" placeholder=" " value="<?php echo esc_attr($options['background_secondary_color']); ?>">
                                                <span class="input__label">Background Secondary</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                            </fieldset>
                            <!-- Button Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend>Button Colors</legend>
                                <details>
                                    <summary>Default Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_default_color]" id="button_default_color" placeholder=" " value="<?php echo esc_attr($options['button_default_color']); ?>">
                                                <span class="input__label">Button Default Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_default_hover_color]" id="button_default_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_default_hover_color']); ?>">
                                                <span class="input__label">Button Default Hover Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_default_text_color]" id="button_default_text_color" placeholder=" " value="<?php echo esc_attr($options['button_default_text_color']); ?>">
                                                <span class="input__label">Button Default Text Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_default_hover_text_color]" id="button_default_hover_text_color" placeholder=" " value="<?php echo esc_attr($options['button_default_hover_text_color']); ?>">
                                                <span class="input__label">Button Default Hover Text Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                                <details>
                                    <summary>Primary Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_primary_color]" id="button_primary_color" placeholder=" " value="<?php echo esc_attr($options['button_primary_color']); ?>">
                                                <span class="input__label">Button Primary Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_primary_hover_color]" id="button_primary_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_primary_hover_color']); ?>">
                                                <span class="input__label">Button Primary Hover Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_primary_text_color]" id="button_primary_text_color" placeholder=" " value="<?php echo esc_attr($options['button_primary_text_color']); ?>">
                                                <span class="input__label">Button Primary Text Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_primary_hover_text_color]" id="button_primary_hover_text_color" placeholder=" " value="<?php echo esc_attr($options['button_primary_hover_text_color']); ?>">
                                                <span class="input__label">Button Primary Hover Text Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                                <details>
                                    <summary>Secondary Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_secondary_color]" id="button_secondary_color" placeholder=" " value="<?php echo esc_attr($options['button_secondary_color']); ?>">
                                                <span class="input__label">Button Secondary Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_secondary_hover_color]" id="button_secondary_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_secondary_hover_color']); ?>">
                                                <span class="input__label">Button Secondary Hover Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_secondary_text_color]" id="button_secondary_text_color" placeholder=" " value="<?php echo esc_attr($options['button_secondary_text_color']); ?>">
                                                <span class="input__label">Button Secondary Text Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_secondary_hover_text_color]" id="button_secondary_hover_text_color" placeholder=" " value="<?php echo esc_attr($options['button_secondary_hover_text_color']); ?>">
                                                <span class="input__label">Button Secondary Hover Text Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                                <details>
                                    <summary>Danger Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_danger_color]" id="button_danger_color" placeholder=" " value="<?php echo esc_attr($options['button_danger_color']); ?>">
                                                <span class="input__label">Button Danger Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_danger_hover_color]" id="button_danger_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_danger_hover_color']); ?>">
                                                <span class="input__label">Button Danger Hover Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_danger_text_color]" id="button_danger_text_color" placeholder=" " value="<?php echo esc_attr($options['button_danger_text_color']); ?>">
                                                <span class="input__label">Button Danger Text Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_danger_hover_text_color]" id="button_danger_hover_text_color" placeholder=" " value="<?php echo esc_attr($options['button_danger_hover_text_color']); ?>">
                                                <span class="input__label">Button Danger Hover Text Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                                <details>
                                    <summary>Text Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_text_color]" id="button_text_color" placeholder=" " value="<?php echo esc_attr($options['button_text_color']); ?>">
                                                <span class="input__label">Button Text Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_text_hover_color]" id="button_text_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_text_hover_color']); ?>">
                                                <span class="input__label">Button Text Hover Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                                <details>
                                    <summary>Link Button</summary>
                                    <div class="picker-group">
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_link_color]" id="button_link_color" placeholder=" " value="<?php echo esc_attr($options['button_link_color']); ?>">
                                                <span class="input__label">Button Link Color</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="input">
                                                <input class="input__field color" type="color" name="css_options[button_link_hover_color]" id="button_link_hover_color" placeholder=" " value="<?php echo esc_attr($options['button_link_hover_color']); ?>">
                                                <span class="input__label">Button Link Hover Color</span>
                                            </label>
                                        </div>
                                    </div>
                                </details>
                            </fieldset>
                        </fieldset>
                        <!-- Element Options -->
                        <fieldset id="ELEMENTOPTIONS" class="fieldset-group group-options">
                            <legend>Element Options</legend>
                            <fieldset class="fieldset-group-inner-outer  ">
                                <legend>Margins</legend>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Default</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_default_mobile]" id="element_margin_default_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_default_mobile']); ?>" step="1">
                                            <span class="input__label">Default Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_default_l]" id="element_margin_default_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_default_l']); ?>" step="1">
                                            <span class="input__label">Default L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>XSmall</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_xsmall_mobile]" id="element_margin_xsmall_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_xsmall_mobile']); ?>" step="1">
                                            <span class="input__label">XSmall Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_xsmall_l]" id="element_margin_xsmall_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_xsmall_l']); ?>" step="1">
                                            <span class="input__label">XSmall L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Small</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_small_mobile]" id="element_margin_small_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_small_mobile']); ?>" step="1">
                                            <span class="input__label">Small Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_small_l]" id="element_margin_small_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_small_l']); ?>" step="1">
                                            <span class="input__label">Small L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Medium</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_medium_mobile]" id="element_margin_medium_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_medium_mobile']); ?>" step="1">
                                            <span class="input__label">Medium Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_medium_l]" id="element_margin_medium_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_medium_l']); ?>" step="1">
                                            <span class="input__label">Medium L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Large</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_large_mobile]" id="element_margin_large_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_large_mobile']); ?>" step="1">
                                            <span class="input__label">Large Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_large_l]" id="element_margin_large_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_large_l']); ?>" step="1">
                                            <span class="input__label">Large L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>XLarge</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_xlarge_mobile]" id="element_margin_xlarge_mobile" placeholder=" " value="<?php echo esc_attr($options['element_margin_xlarge_mobile']); ?>" step="1">
                                            <span class="input__label">XLarge Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[element_margin_xlarge_l]" id="element_margin_xlarge_l" placeholder=" " value="<?php echo esc_attr($options['element_margin_xlarge_l']); ?>" step="1">
                                            <span class="input__label">XLarge L (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles fieldset-flex">
                                <legend>Widths</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[element_width_small]" id="element_width_small" placeholder=" " value="<?php echo esc_attr($options['element_width_small']); ?>" step="1">
                                        <span class="input__label">Small (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[element_width_medium]" id="element_width_medium" placeholder=" " value="<?php echo esc_attr($options['element_width_medium']); ?>" step="1">
                                        <span class="input__label">Medium (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[element_width_large]" id="element_width_large" placeholder=" " value="<?php echo esc_attr($options['element_width_large']); ?>" step="1">
                                        <span class="input__label">Large (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[element_width_xlarge]" id="element_width_xlarge" placeholder=" " value="<?php echo esc_attr($options['element_width_xlarge']); ?>" step="1">
                                        <span class="input__label">XLarge (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[element_width_2xlarge]" id="element_width_2xlarge" placeholder=" " value="<?php echo esc_attr($options['element_width_2xlarge']); ?>" step="1">
                                        <span class="input__label">2XLarge (px)</span>
                                    </label>
                                </div>
                            </fieldset>

                        </fieldset>

                        <!-- Container Options -->
                        <fieldset id="CONTAINEROPTIONS" class="fieldset-group group-options">
                            <legend>Container Options</legend>
                            <fieldset class="fieldset-group-inner-outer ">
                                <legend>Padding Vertical</legend>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Default</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_default_mobile]" id="container_padding_vertical_default_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_default_mobile']); ?>" step="1">
                                            <span class="input__label">Default Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_default_m]" id="container_padding_vertical_default_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_default_m']); ?>" step="1">
                                            <span class="input__label">Default M (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>XSmall</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_xsmall_mobile]" id="container_padding_vertical_xsmall_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_xsmall_mobile']); ?>" step="1">
                                            <span class="input__label">XSmall Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_xsmall_m]" id="container_padding_vertical_xsmall_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_xsmall_m']); ?>" step="1">
                                            <span class="input__label">XSmall M (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Small</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_small_mobile]" id="container_padding_vertical_small_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_small_mobile']); ?>" step="1">
                                            <span class="input__label">Small Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_small_m]" id="container_padding_vertical_small_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_small_m']); ?>" step="1">
                                            <span class="input__label">Small M (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>Large</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_large_mobile]" id="container_padding_vertical_large_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_large_mobile']); ?>" step="1">
                                            <span class="input__label">Large Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_large_m]" id="container_padding_vertical_large_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_large_m']); ?>" step="1">
                                            <span class="input__label">Large M (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend>XLarge</legend>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_xlarge_mobile]" id="container_padding_vertical_xlarge_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_xlarge_mobile']); ?>" step="1">
                                            <span class="input__label">XLarge Mobile (px)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="input">
                                            <input class="input__field" type="number" name="css_options[container_padding_vertical_xlarge_m]" id="container_padding_vertical_xlarge_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_vertical_xlarge_m']); ?>" step="1">
                                            <span class="input__label">XLarge M (px)</span>
                                        </label>
                                    </div>
                                </fieldset>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Max Width</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_max_width_default]" id="container_max_width_default" placeholder=" " value="<?php echo esc_attr($options['container_max_width_default']); ?>" step="1">
                                        <span class="input__label">Default (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_max_width_xsmall]" id="container_max_width_xsmall" placeholder=" " value="<?php echo esc_attr($options['container_max_width_xsmall']); ?>" step="1">
                                        <span class="input__label">XSmall (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_max_width_small]" id="container_max_width_small" placeholder=" " value="<?php echo esc_attr($options['container_max_width_small']); ?>" step="1">
                                        <span class="input__label">Small (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_max_width_large]" id="container_max_width_large" placeholder=" " value="<?php echo esc_attr($options['container_max_width_large']); ?>" step="1">
                                        <span class="input__label">Large (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_max_width_xlarge]" id="container_max_width_xlarge" placeholder=" " value="<?php echo esc_attr($options['container_max_width_xlarge']); ?>" step="1">
                                        <span class="input__label">XLarge (px)</span>
                                    </label>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Padding Horizontal</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_padding_horizontal_mobile]" id="container_padding_horizontal_mobile" placeholder=" " value="<?php echo esc_attr($options['container_padding_horizontal_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_padding_horizontal_s]" id="container_padding_horizontal_s" placeholder=" " value="<?php echo esc_attr($options['container_padding_horizontal_s']); ?>" step="1">
                                        <span class="input__label">S (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[container_padding_horizontal_m]" id="container_padding_horizontal_m" placeholder=" " value="<?php echo esc_attr($options['container_padding_horizontal_m']); ?>" step="1">
                                        <span class="input__label">M (px)</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Column Gutter</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[column_gutter_mobile]" id="column_gutter_mobile" placeholder=" " value="<?php echo esc_attr($options['column_gutter_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[column_gutter_l]" id="column_gutter_l" placeholder=" " value="<?php echo esc_attr($options['column_gutter_l']); ?>" step="1">
                                        <span class="input__label">L (px)</span>
                                    </label>
                                </div>
                            </fieldset>
                        </fieldset>

                    </div>
                    <div class="ppm-right">
                        <!-- Text Options -->
                        <fieldset id="TEXTOPTIONS" class="fieldset-group group-options">
                            <legend>Text Options</legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Text Default Options (Body)</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_default_mobile]" id="text_default_mobile" placeholder=" " value="<?php echo esc_attr($options['text_default_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_default_desktop]" id="text_default_desktop" placeholder=" " value="<?php echo esc_attr($options['text_default_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_default_font_weight]" id="text_default_font_weight" placeholder=" " value="<?php echo esc_attr($options['text_default_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Text Small Options</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_small_mobile]" id="text_small_mobile" placeholder=" " value="<?php echo esc_attr($options['text_small_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_small_desktop]" id="text_small_desktop" placeholder=" " value="<?php echo esc_attr($options['text_small_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_small_font_weight]" id="text_small_font_weight" placeholder=" " value="<?php echo esc_attr($options['text_small_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Text Large Options</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_large_mobile]" id="text_large_mobile" placeholder=" " value="<?php echo esc_attr($options['text_large_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_large_desktop]" id="text_large_desktop" placeholder=" " value="<?php echo esc_attr($options['text_large_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[text_large_font_weight]" id="text_large_font_weight" placeholder=" " value="<?php echo esc_attr($options['text_large_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                        </fieldset>
                        <!-- Base Options -->
                        <fieldset id="BASEOPTIONS" class="fieldset-group group-options">
                            <legend>Base Options</legend>

                            <!-- Breakpoints -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Breakpoints</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[ppm_breakpoint_s]" id="ppm_breakpoint_s" placeholder=" " value="<?php echo esc_attr($options['ppm_breakpoint_s']); ?>" step="1">
                                        <span class="input__label">Breakpoint S (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[ppm_breakpoint_m]" id="ppm_breakpoint_m" placeholder=" " value="<?php echo esc_attr($options['ppm_breakpoint_m']); ?>" step="1">
                                        <span class="input__label">Breakpoint M (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[ppm_breakpoint_x]" id="ppm_breakpoint_l" placeholder=" " value="<?php echo esc_attr($options['ppm_breakpoint_l']); ?>" step="1">
                                        <span class="input__label">Breakpoint L (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[ppm_breakpoint_xl]" id="ppm_breakpoint_xl" placeholder=" " value="<?php echo esc_attr($options['ppm_breakpoint_xl']); ?>" step="1">
                                        <span class="input__label">Breakpoint XL (px)</span>
                                    </label>
                                </div>
                            </fieldset>



                            <!-- Navbar Link Options -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Navbar Link Options</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[navbar_link_mobile]" id="navbar_link_mobile" placeholder=" " value="<?php echo esc_attr($options['navbar_link_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[navbar_link_desktop]" id="navbar_link_desktop" placeholder=" " value="<?php echo esc_attr($options['navbar_link_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[navbar_link_font_weight]" id="navbar_link_font_weight" placeholder=" " value="<?php echo esc_attr($options['navbar_link_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>

                            <!-- Base Font Size -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Base Font (HTML)</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[base_font_size]" id="base_font_size" placeholder=" " value="<?php echo esc_attr($options['base_font_size']); ?>" step="1">
                                        <span class="input__label">Base Font Size (px)</span>
                                    </label>
                                </div>
                            </fieldset>
                        </fieldset>

                        <!-- Headline Font Options -->
                        <fieldset id="HEADLINEOPTIONS" class="fieldset-group group-options">
                            <legend>Headline Font Sizes &amp; Weights</legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading 3XL</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_3xlarge_mobile]" id="heading_3xlarge_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_3xlarge_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_3xlarge_desktop]" id="heading_3xlarge_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_3xlarge_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_3xlarge_font_weight]" id="heading_3xlarge_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_3xlarge_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading 2XL</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_2xlarge_mobile]" id="heading_2xlarge_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_2xlarge_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_2xlarge_desktop]" id="heading_2xlarge_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_2xlarge_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_2xlarge_font_weight]" id="heading_2xlarge_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_2xlarge_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading XL</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_xlarge_mobile]" id="heading_xlarge_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_xlarge_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_xlarge_desktop]" id="heading_xlarge_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_xlarge_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_xlarge_font_weight]" id="heading_xlarge_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_xlarge_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading Large</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_large_mobile]" id="heading_large_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_large_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_large_desktop]" id="heading_large_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_large_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_large_font_weight]" id="heading_large_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_large_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading Medium</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_medium_mobile]" id="heading_medium_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_medium_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_medium_desktop]" id="heading_medium_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_medium_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_medium_font_weight]" id="heading_medium_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_medium_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Heading Small</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_small_mobile]" id="heading_small_mobile" placeholder=" " value="<?php echo esc_attr($options['heading_small_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_small_desktop]" id="heading_small_desktop" placeholder=" " value="<?php echo esc_attr($options['heading_small_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[heading_small_font_weight]" id="heading_small_font_weight" placeholder=" " value="<?php echo esc_attr($options['heading_small_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                        </fieldset>

                        <!-- Button Font Options -->
                        <fieldset id="BUTTONOPTIONS" class="fieldset-group group-options">
                            <legend>Button Font Sizes &amp; Weights</legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Default</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_default_mobile]" id="button_default_mobile" placeholder=" " value="<?php echo esc_attr($options['button_default_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_default_desktop]" id="button_default_desktop" placeholder=" " value="<?php echo esc_attr($options['button_default_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_default_font_weight]" id="button_default_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_default_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Primary</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_primary_mobile]" id="button_primary_mobile" placeholder=" " value="<?php echo esc_attr($options['button_primary_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_primary_desktop]" id="button_primary_desktop" placeholder=" " value="<?php echo esc_attr($options['button_primary_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_primary_font_weight]" id="button_primary_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_primary_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Secondary</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_secondary_mobile]" id="button_secondary_mobile" placeholder=" " value="<?php echo esc_attr($options['button_secondary_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_secondary_desktop]" id="button_secondary_desktop" placeholder=" " value="<?php echo esc_attr($options['button_secondary_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_secondary_font_weight]" id="button_secondary_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_secondary_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Danger</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_danger_mobile]" id="button_danger_mobile" placeholder=" " value="<?php echo esc_attr($options['button_danger_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_danger_desktop]" id="button_danger_desktop" placeholder=" " value="<?php echo esc_attr($options['button_danger_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_danger_font_weight]" id="button_danger_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_danger_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Text</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_text_mobile]" id="button_text_mobile" placeholder=" " value="<?php echo esc_attr($options['button_text_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_text_desktop]" id="button_text_desktop" placeholder=" " value="<?php echo esc_attr($options['button_text_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_text_font_weight]" id="button_text_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_text_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend>Button Link</legend>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_link_mobile]" id="button_link_mobile" placeholder=" " value="<?php echo esc_attr($options['button_link_mobile']); ?>" step="1">
                                        <span class="input__label">Mobile (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_link_desktop]" id="button_link_desktop" placeholder=" " value="<?php echo esc_attr($options['button_link_desktop']); ?>" step="1">
                                        <span class="input__label">Desktop (px)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="input">
                                        <input class="input__field" type="number" name="css_options[button_link_font_weight]" id="button_link_font_weight" placeholder=" " value="<?php echo esc_attr($options['button_link_font_weight']); ?>" step="1">
                                        <span class="input__label">Font Weight</span>
                                    </label>
                                </div>
                            </fieldset>
                        </fieldset>
                    </div>





                </div>

                <button type="submit" name="create_child_theme" class="ppm-button ppm-button-primary ">Save Options &amp; Create Child Theme</button>
            </form>
        </div>
<?php
    }
}
?>