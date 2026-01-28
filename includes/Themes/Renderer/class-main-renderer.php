<?php

/**
 * Main Theme Renderer
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

use EPB\CSS\Options as CSSOptions;
use EPB\Themes\Manager as ThemesManager;
use EPB\Tokens\Mapper as TokenMapper;

/**
 * Class Main_Renderer
 *
 * Main orchestrator for theme section rendering.
 * Delegates to specialized field renderers for different sections.
 */
class Main_Renderer
{

    /**
     * Renders the section for uploading and installing the parent theme.
     *
     * @return void
     */
    public static function render_upload_section(): void
    {
?>
        <div class="ppm-section">
            <h2><?php esc_html_e('Upload Parent Theme', 'enhanced-plugin-bundle'); ?>
                <?php if (ThemesManager::is_yootheme_installed()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php esc_html_e('Installed', 'enhanced-plugin-bundle'); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php esc_html_e('Inactive', 'enhanced-plugin-bundle'); ?></span>
                <?php endif; ?>
            </h2>
            <p><?php esc_html_e('Upload your parent theme ZIP file below to install it:', 'enhanced-plugin-bundle'); ?></p>
            <div class="new-plugin-container">
                <input type="file" name="theme_zip" id="theme-zip" class="form-input file-input">
                <button type="submit" name="upload_theme" class="ppm-button ppm-button-primary">
                    <?php esc_html_e('Upload and Install Parent Theme', 'enhanced-plugin-bundle'); ?>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Renders the section for creating and activating the child theme.
     *
     * @return void
     */
    public static function render_child_theme_section(): void
    {
        $options = CSSOptions::get();
        $regenerate_functions_requested = self::is_regenerate_functions_requested();
    ?>
        <div class="ppm-section child-theme-options">
            <h2><?php esc_html_e('Create Child Theme', 'enhanced-plugin-bundle'); ?>
                <?php if (ThemesManager::is_child_theme_active()) : ?>
                    <span class="theme-status-badge theme-status-active"><?php esc_html_e('Active', 'enhanced-plugin-bundle'); ?></span>
                <?php else : ?>
                    <span class="theme-status-badge theme-status-not-installed"><?php esc_html_e('Inactive', 'enhanced-plugin-bundle'); ?></span>
                <?php endif; ?>
            </h2>
            <p>
                <?php esc_html_e('Customize the CSS options for your child theme below. Use the color pickers for color options and enter numeric values (in pixels) for font sizes. When you are ready, click the button to save your options and create/activate the child theme.', 'enhanced-plugin-bundle'); ?>
            </p>
            <form method="post" action="">
                <?php wp_nonce_field('epb_create_child', 'epb_child_nonce'); ?>
                <div class="child-theme-form">
                    <div class="ppm-left">
                        <?php
                        // Color Options
                        Color_Fields::render($options);

                        // Element Options
                        self::render_element_options($options);

                        // Container Options
                        self::render_container_options($options);
                        ?>
                    </div>
                    <div class="ppm-right">
                        <?php
                        // Text Options
                        Typography_Fields::render_text_options($options);

                        // Base Options
                        Typography_Fields::render_base_options($options);

                        // Headline Options
                        Typography_Fields::render_heading_options($options);

                        // Button Options
                        Typography_Fields::render_button_typography($options);
                        ?>
                    </div>
                </div>

                <?php
                Form_Builder::render_checkbox(
                    'regenerate_child_functions',
                    __('Regenerate child theme functions.php', 'enhanced-plugin-bundle'),
                    __('Leave unchecked to preserve your existing child theme functions.php file. Check to overwrite it with the default template.', 'enhanced-plugin-bundle'),
                    $regenerate_functions_requested
                );
                ?>

                <button type="submit" name="create_child_theme" class="ppm-button ppm-button-primary">
                    <?php esc_html_e('Save Options & Create Child Theme', 'enhanced-plugin-bundle'); ?>
                </button>
            </form>
        </div>
    <?php
    }

    /**
     * Renders the element options fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_element_options(array $options): void
    {
    ?>
        <fieldset id="ELEMENTOPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Element Options', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Spacing_Fields::render_element_margins($options);
            Spacing_Fields::render_element_widths($options);
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders the container options fieldset.
     *
     * @param array<string, mixed> $options Current theme options.
     * @return void
     */
    private static function render_container_options(array $options): void
    {
    ?>
        <fieldset id="CONTAINEROPTIONS" class="fieldset-group group-options">
            <legend><?php esc_html_e('Container Options', 'enhanced-plugin-bundle'); ?></legend>
            <?php
            Spacing_Fields::render_container_padding_vertical($options);
            Spacing_Fields::render_container_max_width($options);
            Spacing_Fields::render_container_padding_horizontal($options);
            Spacing_Fields::render_column_gutter($options);
            ?>
        </fieldset>
    <?php
    }

    /**
     * Renders the section for importing design tokens from Tokens Studio.
     *
     * @return void
     */
    public static function render_import_tokens_section(): void
    {
    ?>
        <div class="ppm-section">
            <h2><?php esc_html_e('Import Design Tokens', 'enhanced-plugin-bundle'); ?>
                <span class="theme-status-badge theme-status-active"><?php esc_html_e('Tokens Studio', 'enhanced-plugin-bundle'); ?></span>
            </h2>
            <p>
                <?php esc_html_e('Import design tokens from Tokens Studio for Figma. Upload a JSON file exported from Tokens Studio to automatically update all CSS options.', 'enhanced-plugin-bundle'); ?>
            </p>
            <div class="token-import-info">
                <details>
                    <summary><?php esc_html_e('Token Format Information', 'enhanced-plugin-bundle'); ?></summary>
                    <div class="token-info-content">
                        <p><?php esc_html_e('The JSON file should follow the Tokens Studio format with the following structure:', 'enhanced-plugin-bundle'); ?></p>
                        <ul>
                            <li><strong><?php esc_html_e('colors', 'enhanced-plugin-bundle'); ?></strong> - <?php esc_html_e('Text, background, and button colors', 'enhanced-plugin-bundle'); ?></li>
                            <li><strong><?php esc_html_e('breakpoints', 'enhanced-plugin-bundle'); ?></strong> - <?php esc_html_e('Responsive breakpoint values', 'enhanced-plugin-bundle'); ?></li>
                            <li><strong><?php esc_html_e('spacing', 'enhanced-plugin-bundle'); ?></strong> - <?php esc_html_e('Container padding, margins, gutters', 'enhanced-plugin-bundle'); ?></li>
                            <li><strong><?php esc_html_e('sizing', 'enhanced-plugin-bundle'); ?></strong> - <?php esc_html_e('Container max-widths, element widths', 'enhanced-plugin-bundle'); ?></li>
                            <li><strong><?php esc_html_e('typography', 'enhanced-plugin-bundle'); ?></strong> - <?php esc_html_e('Font sizes and weights for headings, buttons, text', 'enhanced-plugin-bundle'); ?></li>
                        </ul>
                        <p>
                            <strong><?php esc_html_e('Supported tokens:', 'enhanced-plugin-bundle'); ?></strong>
                            <?php
                            $mapping = TokenMapper::get_mapping();
                            printf(
                                /* translators: %d: number of supported tokens */
                                esc_html__('%d CSS variables can be imported from your token file.', 'enhanced-plugin-bundle'),
                                count($mapping)
                            );
                            ?>
                        </p>
                    </div>
                </details>
            </div>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('epb_import_tokens', 'epb_token_nonce'); ?>
                <div class="new-plugin-container">
                    <input type="file" name="tokens_json" id="tokens-json" class="form-input file-input" accept=".json,application/json">
                    <button type="submit" name="import_tokens" class="ppm-button ppm-button-primary">
                        <?php esc_html_e('Import Tokens', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </form>
            <div class="token-export-section" style="margin-top: 20px;">
                <p><?php esc_html_e('You can also export your current settings to use in Tokens Studio:', 'enhanced-plugin-bundle'); ?></p>
                <button type="button" id="export-tokens" class="ppm-button ppm-button-secondary">
                    <?php esc_html_e('Export Current Tokens', 'enhanced-plugin-bundle'); ?>
                </button>
            </div>
        </div>
<?php
    }

    /**
     * Checks if regenerate functions was requested with valid nonce.
     *
     * @return bool
     */
    private static function is_regenerate_functions_requested(): bool
    {
        if (
            isset($_POST['regenerate_child_functions'], $_POST['epb_child_nonce']) &&
            wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['epb_child_nonce'])), 'epb_create_child')
        ) {
            return true;
        }
        return false;
    }
}
