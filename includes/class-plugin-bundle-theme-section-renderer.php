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
            <h2><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_PARENT_THEME)); ?>
                <?php
                // Display the parent theme status badge based on whether YOOtheme is installed and active.
                if (Plugin_Bundle_Themes::is_yootheme_installed()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INSTALLED)); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INACTIVE)); ?></span>
                <?php endif; ?>
            </h2>
            <p><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_INSTRUCTIONS)); ?></p>
            <div class="new-plugin-container">
                <input type="file" name="theme_zip" id="theme-zip" class="form-input file-input">
                <button type="submit" name="upload_theme" class="ppm-button ppm-button-primary">
                    <?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::UPLOAD_BUTTON)); ?>
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
        $regenerate_functions_requested = ! empty($_POST['regenerate_child_functions']);
    ?>
        <div class="ppm-section child-theme-options">
            <h2><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CREATE_CHILD_THEME)); ?>
                <?php
                // Display child theme status badge based on current state.
                if (Plugin_Bundle_Themes::is_child_theme_active()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_ACTIVE)); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_STATUS_INACTIVE)); ?></span>
                <?php endif; ?>
            </h2>
            <p>
                <?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_THEME_INSTRUCTIONS)); ?>
            </p>
            <form method="post" action="">
                <div class="child-theme-form">
                    <div class="ppm-left">
                        <!-- Color Options -->
                        <fieldset id="COLOROPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_COLOR_OPTIONS)); ?></legend>
                            <!-- Text Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_TEXT_COLORS)); ?></legend>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_COLORS)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'muted_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MUTED_COLOR), 'type' => 'color'],
                                            ['name' => 'emphasis_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_EMPHASIS_COLOR), 'type' => 'color'],
                                            ['name' => 'primary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_PRIMARY_COLOR), 'type' => 'color'],
                                            ['name' => 'secondary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SECONDARY_COLOR), 'type' => 'color'],
                                            ['name' => 'success_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SUCCESS_COLOR), 'type' => 'color'],
                                            ['name' => 'warning_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WARNING_COLOR), 'type' => 'color'],
                                            ['name' => 'danger_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DANGER_COLOR), 'type' => 'color'],
                                            ['name' => 'text_background_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_TEXT_BACKGROUND_COLOR), 'type' => 'color'],
                                            ['name' => 'body_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BODY_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                            </fieldset>
                            <!-- Background Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BACKGROUND_COLORS)); ?></legend>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_COLORS)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'background_default_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BACKGROUND_DEFAULT), 'type' => 'color'],
                                            ['name' => 'background_muted_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BACKGROUND_MUTED), 'type' => 'color'],
                                            ['name' => 'background_primary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BACKGROUND_PRIMARY), 'type' => 'color'],
                                            ['name' => 'background_secondary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BACKGROUND_SECONDARY), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                            </fieldset>
                            <!-- Button Colors -->
                            <fieldset class="fieldset-group-inner group-styles button-accordion">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_COLORS)); ?></legend>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_DEFAULT_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_default_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DEFAULT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_default_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DEFAULT_HOVER_COLOR), 'type' => 'color'],
                                            ['name' => 'button_default_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DEFAULT_TEXT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_default_hover_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DEFAULT_HOVER_TEXT_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_PRIMARY_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_primary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_PRIMARY_COLOR), 'type' => 'color'],
                                            ['name' => 'button_primary_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_PRIMARY_HOVER_COLOR), 'type' => 'color'],
                                            ['name' => 'button_primary_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_PRIMARY_TEXT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_primary_hover_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_PRIMARY_HOVER_TEXT_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_SECONDARY_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_secondary_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_SECONDARY_COLOR), 'type' => 'color'],
                                            ['name' => 'button_secondary_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_SECONDARY_HOVER_COLOR), 'type' => 'color'],
                                            ['name' => 'button_secondary_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_SECONDARY_TEXT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_secondary_hover_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_SECONDARY_HOVER_TEXT_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_DANGER_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_danger_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DANGER_COLOR), 'type' => 'color'],
                                            ['name' => 'button_danger_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DANGER_HOVER_COLOR), 'type' => 'color'],
                                            ['name' => 'button_danger_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DANGER_TEXT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_danger_hover_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_DANGER_HOVER_TEXT_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_TEXT_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_text_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_TEXT_COLOR), 'type' => 'color'],
                                            ['name' => 'button_text_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_TEXT_HOVER_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                                <details>
                                    <summary><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUMMARY_LINK_BUTTON)); ?></summary>
                                    <div class="picker-group">
                                        <?php
                                        self::render_input_fields([
                                            ['name' => 'button_link_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_LINK_COLOR), 'type' => 'color'],
                                            ['name' => 'button_link_hover_color', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BUTTON_LINK_HOVER_COLOR), 'type' => 'color'],
                                        ], $options);
                                        ?>
                                    </div>
                                </details>
                            </fieldset>
                        </fieldset>
                        <!-- Element Options -->
                        <fieldset id="ELEMENTOPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_ELEMENT_OPTIONS)); ?></legend>
                            <fieldset class="fieldset-group-inner-outer  ">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_MARGINS)); ?></legend>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_DEFAULT)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_default_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DEFAULT_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_default_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DEFAULT_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_XSMALL)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_xsmall_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XSMALL_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_xsmall_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XSMALL_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_SMALL)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_small_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SMALL_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_small_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SMALL_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_MEDIUM)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_medium_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MEDIUM_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_medium_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MEDIUM_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_LARGE)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_large_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_LARGE_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_large_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_LARGE_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_XLARGE)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'element_margin_xlarge_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XLARGE_MOBILE_PX), 'step' => 1],
                                        ['name' => 'element_margin_xlarge_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XLARGE_L_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles fieldset-flex">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_WIDTHS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'element_width_small', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_SMALL_PX), 'step' => 1],
                                    ['name' => 'element_width_medium', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_MEDIUM_PX), 'step' => 1],
                                    ['name' => 'element_width_large', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_LARGE_PX), 'step' => 1],
                                    ['name' => 'element_width_xlarge', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_XLARGE_PX), 'step' => 1],
                                    ['name' => 'element_width_2xlarge', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_2XLARGE_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>

                        </fieldset>

                        <!-- Container Options -->
                        <fieldset id="CONTAINEROPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_CONTAINER_OPTIONS)); ?></legend>
                            <fieldset class="fieldset-group-inner-outer ">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_PADDING_VERTICAL)); ?></legend>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_DEFAULT)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'container_padding_vertical_default_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DEFAULT_MOBILE_PX), 'step' => 1],
                                        ['name' => 'container_padding_vertical_default_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DEFAULT_M_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_XSMALL)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'container_padding_vertical_xsmall_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XSMALL_MOBILE_PX), 'step' => 1],
                                        ['name' => 'container_padding_vertical_xsmall_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XSMALL_M_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_SMALL)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'container_padding_vertical_small_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SMALL_MOBILE_PX), 'step' => 1],
                                        ['name' => 'container_padding_vertical_small_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SMALL_M_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_LARGE)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'container_padding_vertical_large_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_LARGE_MOBILE_PX), 'step' => 1],
                                        ['name' => 'container_padding_vertical_large_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_LARGE_M_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                                <fieldset class="fieldset-group-inner group-styles">
                                    <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_XLARGE)); ?></legend>
                                    <?php
                                    self::render_input_fields([
                                        ['name' => 'container_padding_vertical_xlarge_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XLARGE_MOBILE_PX), 'step' => 1],
                                        ['name' => 'container_padding_vertical_xlarge_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XLARGE_M_PX), 'step' => 1],
                                    ], $options);
                                    ?>
                                </fieldset>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_MAX_WIDTH)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'container_max_width_default', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DEFAULT_PX), 'step' => 1],
                                    ['name' => 'container_max_width_xsmall', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_XSMALL_PX), 'step' => 1],
                                    ['name' => 'container_max_width_small', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_SMALL_PX), 'step' => 1],
                                    ['name' => 'container_max_width_large', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_LARGE_PX), 'step' => 1],
                                    ['name' => 'container_max_width_xlarge', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_WIDTH_XLARGE_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>

                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_PADDING_HORIZONTAL)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'container_padding_horizontal_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'container_padding_horizontal_s', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SIZE_S_PX), 'step' => 1],
                                    ['name' => 'container_padding_horizontal_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SIZE_M_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_COLUMN_GUTTER)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'column_gutter_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'column_gutter_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_SIZE_L_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                        </fieldset>

                    </div>
                    <div class="ppm-right">
                        <!-- Text Options -->
                        <fieldset id="TEXTOPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_TEXT_OPTIONS)); ?></legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_TEXT_DEFAULT_OPTIONS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'text_default_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'text_default_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'text_default_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_TEXT_SMALL_OPTIONS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'text_small_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'text_small_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'text_small_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_TEXT_LARGE_OPTIONS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'text_large_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'text_large_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'text_large_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                        </fieldset>
                        <!-- Base Options -->
                        <fieldset id="BASEOPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BASE_OPTIONS)); ?></legend>

                            <!-- Breakpoints -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BREAKPOINTS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'ppm_breakpoint_s', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BREAKPOINT_S_PX), 'step' => 1],
                                    ['name' => 'ppm_breakpoint_m', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BREAKPOINT_M_PX), 'step' => 1],
                                    ['name' => 'ppm_breakpoint_l', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BREAKPOINT_L_PX), 'step' => 1, 'id' => 'ppm_breakpoint_l'],
                                    ['name' => 'ppm_breakpoint_xl', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BREAKPOINT_XL_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>



                            <!-- Navbar Link Options -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_NAVBAR_LINK_OPTIONS)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'navbar_link_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'navbar_link_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'navbar_link_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>

                            <!-- Base Font Size -->
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BASE_FONT)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'base_font_size', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_BASE_FONT_SIZE_PX), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                        </fieldset>

                        <!-- Headline Font Options -->
                        <fieldset id="HEADLINEOPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADLINE_OPTIONS)); ?></legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_3XL)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_3xlarge_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_3xlarge_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_3xlarge_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_2XL)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_2xlarge_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_2xlarge_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_2xlarge_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_XL)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_xlarge_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_xlarge_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_xlarge_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_LARGE)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_large_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_large_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_large_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_MEDIUM)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_medium_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_medium_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_medium_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_HEADING_SMALL)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'heading_small_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'heading_small_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'heading_small_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                        </fieldset>

                        <!-- Button Font Options -->
                        <fieldset id="BUTTONOPTIONS" class="fieldset-group group-options">
                            <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_OPTIONS)); ?></legend>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_DEFAULT)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_default_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_default_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_default_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_PRIMARY)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_primary_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_primary_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_primary_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_SECONDARY)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_secondary_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_secondary_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_secondary_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_DANGER)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_danger_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_danger_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_danger_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_TEXT)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_text_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_text_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_text_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                            <fieldset class="fieldset-group-inner group-styles">
                                <legend><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LEGEND_BUTTON_LINK)); ?></legend>
                                <?php
                                self::render_input_fields([
                                    ['name' => 'button_link_mobile', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_MOBILE_PX), 'step' => 1],
                                    ['name' => 'button_link_desktop', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_DESKTOP_PX), 'step' => 1],
                                    ['name' => 'button_link_font_weight', 'label' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_LABEL_FONT_WEIGHT), 'step' => 1],
                                ], $options);
                                ?>
                            </fieldset>
                        </fieldset>
                    </div>





                </div>

                <?php
                $checkbox_id   = self::escape_attr('regenerate_child_functions');
                $checkbox_name = $checkbox_id;
                $checkbox_value = self::escape_attr('1');
                $checkbox_label = self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_THEME_REGENERATE_FUNCTIONS_LABEL));
                $checkbox_help  = self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_THEME_REGENERATE_FUNCTIONS_HELP));
                $checked_attr   = $regenerate_functions_requested ? ' checked="checked"' : '';
                ?>
                <div class="form-group form-group--checkbox">
                    <label class="checkbox" for="<?php echo $checkbox_id; ?>">
                        <input type="checkbox" name="<?php echo $checkbox_name; ?>" id="<?php echo $checkbox_id; ?>" value="<?php echo $checkbox_value; ?>" <?php echo $checked_attr; ?>>
                        <span><?php echo $checkbox_label; ?></span>
                    </label>
                    <p class="description"><?php echo $checkbox_help; ?></p>
                </div>

                <button type="submit" name="create_child_theme" class="ppm-button ppm-button-primary "><?php echo self::escape_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::CHILD_SUBMIT_SAVE_OPTIONS)); ?></button>
            </form>
        </div>
<?php
    }

    /**
     * Renders a list of input fields based on a provided configuration.
     *
     * Each field definition supports the following keys:
     * - name  (string, required): option key stored under css_options.
     * - label (string, required): label text displayed in the form.
     * - type  (string, optional): input type, defaults to "number".
     * - step  (scalar, optional): step attribute for number inputs.
     * - class (string, optional): custom CSS class appended to the input element.
     *
     * @param array<int, array<string, mixed>> $fields  List of field definitions.
     * @param array<string, mixed>             $options Current option values.
     * @return void
     */
    private static function render_input_fields(array $fields, array $options): void
    {
        foreach ($fields as $field) {
            if (empty($field['name']) || empty($field['label'])) {
                continue;
            }

            $name  = (string) $field['name'];
            $label = (string) $field['label'];
            $type  = isset($field['type']) ? (string) $field['type'] : 'number';
            $class = 'input__field';

            if ('color' === $type) {
                $class .= ' color';
            }
            if (!empty($field['class'])) {
                $class .= ' ' . trim((string) $field['class']);
            }

            $value   = self::escape_attr($options[$name] ?? '');
            $step    = isset($field['step']) ? sprintf(' step="%s"', self::escape_attr((string) $field['step'])) : '';
            $type    = self::escape_attr($type);
            $class   = self::escape_attr($class);
            $nameAttr = self::escape_attr($name);
            $labelAttr = self::escape_html($label);

            printf(
                '<div class="form-group"><label class="input"><input class="%1$s" type="%2$s" name="css_options[%3$s]" id="%3$s" placeholder=" " value="%4$s"%5$s><span class="input__label">%6$s</span></label></div>',
                $class,
                $type,
                $nameAttr,
                $value,
                $step,
                $labelAttr
            );
        }
    }

    private static function escape_attr($value): string
    {
        if (function_exists('esc_attr')) {
            return (string) call_user_func('esc_attr', $value);
        }

        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private static function escape_html($value): string
    {
        if (function_exists('esc_html')) {
            return (string) call_user_func('esc_html', $value);
        }

        return htmlspecialchars((string) $value, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
?>