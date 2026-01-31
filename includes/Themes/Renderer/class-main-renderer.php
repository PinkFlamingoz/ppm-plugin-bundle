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

use EPB\Themes\Manager as ThemesManager;

/**
 * Class Main_Renderer
 *
 * Main orchestrator for theme section rendering.
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
     * Renders the component-based theming section.
     *
     * This provides access to all UIkit component variables through a menu-based interface.
     *
     * @return void
     */
    public static function render_component_picker_section(): void
    {
        // Enqueue component picker assets.
        wp_enqueue_style(
            'epb-component-picker',
            EPB_PLUGIN_URL . 'assets/css/component-picker.css',
            [],
            EPB_VERSION
        );

        wp_enqueue_script(
            'epb-component-picker',
            EPB_PLUGIN_URL . 'assets/js/component-picker.js',
            ['jquery'],
            EPB_VERSION,
            true
        );

        wp_localize_script('epb-component-picker', 'epbComponentPicker', [
            'ajaxUrl'    => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('epb_component_nonce'),
            'previewUrl' => add_query_arg([
                'action' => 'epb_get_preview_page',
                'nonce'  => wp_create_nonce('epb_component_nonce'),
            ], admin_url('admin-ajax.php')),
            'strings'    => [
                'loading'         => __('Loading...', 'enhanced-plugin-bundle'),
                'saving'          => __('Saving...', 'enhanced-plugin-bundle'),
                'saved'           => __('Changes saved successfully.', 'enhanced-plugin-bundle'),
                'reset'           => __('Component reset to defaults.', 'enhanced-plugin-bundle'),
                'error'           => __('An error occurred. Please try again.', 'enhanced-plugin-bundle'),
                'confirmReset'    => __('Are you sure you want to reset all values for this component to defaults?', 'enhanced-plugin-bundle'),
                'confirmResetAll' => __('Are you sure you want to reset ALL components to their defaults? This cannot be undone.', 'enhanced-plugin-bundle'),
                'exportSuccess'   => __('Export downloaded successfully.', 'enhanced-plugin-bundle'),
                'importSuccess'   => __('Components imported successfully.', 'enhanced-plugin-bundle'),
                'selectFile'      => __('Please select a file to import.', 'enhanced-plugin-bundle'),
                'variables'       => __('variables', 'enhanced-plugin-bundle'),
                'collapseAll'     => __('Collapse All', 'enhanced-plugin-bundle'),
                'expandAll'       => __('Expand All', 'enhanced-plugin-bundle'),
                'copied'          => __('Copied!', 'enhanced-plugin-bundle'),
                'noComponent'     => __('Please select a component first.', 'enhanced-plugin-bundle'),
                'noChanges'       => __('No unsaved changes to save.', 'enhanced-plugin-bundle'),
                'savedAllCount'   => __('Saved %d component(s) successfully.', 'enhanced-plugin-bundle'),
                'savedWithErrors' => __('Saved %d component(s), %d failed.', 'enhanced-plugin-bundle'),
            ],
        ]);

        // Include the component picker template.
        include EPB_PLUGIN_DIR . 'admin/views/partials/component-picker.php';
    }
}
