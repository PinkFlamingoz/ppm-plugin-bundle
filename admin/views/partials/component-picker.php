<?php

/**
 * Component Picker Template
 *
 * Renders the component-based theme customization interface.
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.1.0
 */

// Prevent direct access.
if (!defined('ABSPATH')) {
    exit();
}

use EPB\CSS\Component_Registry;
use EPB\CSS\Less_Parser;
use EPB\Ajax\Component_Handler;
use EPB\Themes\Manager as ThemesManager;
use EPB\Themes\Child_Theme;

$categories = Component_Registry::get_components_by_category();
$total_vars = Component_Registry::get_total_variable_count();

// Get saved counts for each component to show modified indicator.
$modified_components = Component_Handler::get_all_modified_counts();

// Check child theme status.
$child_theme_exists = file_exists(Child_Theme::get_child_theme_dir());
$child_theme_active = ThemesManager::is_child_theme_active();
?>

<div class="ppm-theme-builder" id="epb-component-picker">
    <!-- Sidebar: Component Menu -->
    <aside class="ppm-component-menu">
        <div class="menu-header">
            <h3><?php esc_html_e('Components', 'enhanced-plugin-bundle'); ?></h3>
            <div class="menu-header-actions">
                <button type="button" id="export-figma" class="ppm-button-icon" title="<?php esc_attr_e('Export for Figma Tokens Studio', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-share-alt2"></span>
                </button>
                <button type="button" id="import-figma" class="ppm-button-icon" title="<?php esc_attr_e('Import from Figma Tokens Studio', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-migrate"></span>
                </button>
                <button type="button" id="export-yootheme-less" class="ppm-button-icon" title="<?php esc_attr_e('Export YOOtheme Style JSON', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-editor-code"></span>
                </button>
                <button type="button" id="export-all-components" class="ppm-button-icon" title="<?php esc_attr_e('Export All (JSON)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-download"></span>
                </button>
                <button type="button" id="import-components" class="ppm-button-icon" title="<?php esc_attr_e('Import (JSON)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-upload"></span>
                </button>
                <button type="button" id="setup-child-theme" class="ppm-button-icon" title="<?php esc_attr_e('Create or update child theme structure (functions.php, config.php)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <?php if ($child_theme_exists) : ?>
                        <span class="child-theme-status-dot <?php echo $child_theme_active ? 'active' : 'exists'; ?>"></span>
                    <?php endif; ?>
                </button>
            </div>
            <span class="total-vars"><?php printf(esc_html__('%d variables', 'enhanced-plugin-bundle'), $total_vars); ?></span>
        </div>

        <div class="menu-global-actions">
            <button type="button" class="ppm-button ppm-button-small" id="reset-all-components" title="<?php esc_attr_e('Reset all components to defaults', 'enhanced-plugin-bundle'); ?>">
                <span class="dashicons dashicons-image-rotate"></span>
                <?php esc_html_e('Reset All', 'enhanced-plugin-bundle'); ?>
            </button>
            <button type="button" class="ppm-button ppm-button-small ppm-button-primary" id="save-all-components" title="<?php esc_attr_e('Save all component changes', 'enhanced-plugin-bundle'); ?>">
                <span class="dashicons dashicons-saved"></span>
                <?php esc_html_e('Save All', 'enhanced-plugin-bundle'); ?>
            </button>
        </div>

        <div class="menu-search">
            <span class="dashicons dashicons-search"></span>
            <input type="text"
                placeholder="<?php esc_attr_e('Search components or variables...', 'enhanced-plugin-bundle'); ?>"
                id="component-search"
                autocomplete="off">
        </div>

        <nav class="menu-categories">
            <?php foreach ($categories as $cat_key => $cat_data) : ?>
                <?php if (!empty($cat_data['components'])) : ?>
                    <?php
                    // Check if any component in this category has modifications.
                    $category_has_modified = false;
                    foreach ($cat_data['components'] as $comp_key => $comp_data) {
                        if (!empty($modified_components[$comp_key])) {
                            $category_has_modified = true;
                            break;
                        }
                    }
                    ?>
                    <div class="menu-category collapsed<?php echo $category_has_modified ? ' has-modified' : ''; ?>" data-category="<?php echo esc_attr($cat_key); ?>">
                        <h4 class="category-label">
                            <span class="dashicons dashicons-arrow-right-alt2 toggle-icon"></span>
                            <span class="dashicons dashicons-<?php echo esc_attr($cat_data['icon']); ?>"></span>
                            <span class="category-label-text"><?php echo esc_html($cat_data['label']); ?></span>
                            <?php if ($category_has_modified) : ?>
                                <span class="category-modified-dot" title="<?php esc_attr_e('Contains modified components', 'enhanced-plugin-bundle'); ?>"></span>
                            <?php endif; ?>
                            <span class="category-count"><?php echo count($cat_data['components']); ?></span>
                        </h4>
                        <ul class="component-list">
                            <?php foreach ($cat_data['components'] as $comp_key => $comp_data) : ?>
                                <?php
                                $has_modified   = !empty($modified_components[$comp_key]);
                                $variable_names = implode(' ', array_keys(Less_Parser::parse_component($comp_key)));
                                ?>
                                <li>
                                    <a href="#"
                                        data-component="<?php echo esc_attr($comp_key); ?>"
                                        data-variables="<?php echo esc_attr($variable_names); ?>"
                                        class="component-link<?php echo $has_modified ? ' has-modified' : ''; ?>">
                                        <span class="dashicons dashicons-<?php echo esc_attr($comp_data['icon']); ?>"></span>
                                        <span class="component-name"><?php echo esc_html($comp_data['label']); ?></span>
                                        <?php if ($has_modified) : ?>
                                            <span class="component-modified-dot" title="<?php echo esc_attr(sprintf(__('%d modified', 'enhanced-plugin-bundle'), $modified_components[$comp_key])); ?>"></span>
                                        <?php endif; ?>
                                        <span class="component-vars"><?php echo Less_Parser::get_variable_count($comp_key); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </aside>

    <!-- Main: Component Variables -->
    <main class="ppm-component-editor">
        <header class="component-header">
            <div class="header-content">
                <span class="component-icon dashicons dashicons-admin-site" id="component-icon"></span>
                <div class="header-text">
                    <h2 id="component-title"><?php esc_html_e('Select a Component', 'enhanced-plugin-bundle'); ?></h2>
                    <p id="component-description"><?php esc_html_e('Choose a component from the menu to customize its variables.', 'enhanced-plugin-bundle'); ?></p>
                </div>
            </div>
            <div class="header-meta">
                <span class="variable-count" id="variable-count"></span>
            </div>
        </header>

        <div class="component-loading" id="component-loading" style="display: none;">
            <span class="spinner is-active"></span>
            <span><?php esc_html_e('Loading component...', 'enhanced-plugin-bundle'); ?></span>
        </div>

        <form id="component-form" method="post">
            <?php wp_nonce_field('epb_component_nonce', 'epb_component_nonce_field'); ?>
            <input type="hidden" name="current_component" id="current-component" value="">

            <div class="component-actions" id="component-actions" style="display: none;">
                <div class="actions-left">
                    <button type="button" class="ppm-button" id="toggle-all-groups" title="<?php esc_attr_e('Collapse/Expand All', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                        <?php esc_html_e('Expand All', 'enhanced-plugin-bundle'); ?>
                    </button>
                    <button type="button" class="ppm-button" id="reset-component">
                        <span class="dashicons dashicons-image-rotate"></span>
                        <?php esc_html_e('Reset to Defaults', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
                <div class="actions-right">
                    <button type="submit" class="ppm-button ppm-button-primary" id="save-component">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Save Changes', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </div>

            <div id="component-fields" class="component-fields">
                <!-- Fields loaded dynamically via AJAX -->
                <div class="component-placeholder">
                    <span class="dashicons dashicons-layout"></span>
                    <p><?php esc_html_e('Select a component from the sidebar to start customizing.', 'enhanced-plugin-bundle'); ?></p>
                </div>
            </div>
        </form>

        <div class="component-toast" id="component-toast" style="display: none;">
            <span class="toast-icon dashicons"></span>
            <span class="toast-message"></span>
        </div>
    </main>

    <!-- Preview Panel -->
    <aside class="ppm-preview-panel">
        <div class="preview-tabs">
            <button type="button" class="preview-tab active" data-tab="preview">
                <span class="dashicons dashicons-visibility"></span>
                <?php esc_html_e('Preview', 'enhanced-plugin-bundle'); ?>
            </button>
            <button type="button" class="preview-tab" data-tab="css">
                <span class="dashicons dashicons-editor-code"></span>
                <?php esc_html_e('CSS', 'enhanced-plugin-bundle'); ?>
            </button>
            <button type="button" class="preview-collapse-toggle" title="<?php esc_attr_e('Toggle Preview Panel', 'enhanced-plugin-bundle'); ?>">
                <span class="dashicons dashicons-arrow-right-alt2"></span>
            </button>
        </div>

        <!-- Component Preview Tab -->
        <div class="preview-tab-content active" id="preview-tab-preview">
            <div class="preview-iframe-container">
                <div class="preview-iframe-placeholder" id="preview-placeholder">
                    <span class="dashicons dashicons-visibility"></span>
                    <p><?php esc_html_e('Select a component to see a live preview', 'enhanced-plugin-bundle'); ?></p>
                </div>
                <iframe id="component-preview-frame" src="about:blank" title="<?php esc_attr_e('Component Preview', 'enhanced-plugin-bundle'); ?>" style="display:none;"></iframe>
            </div>
        </div>

        <!-- CSS Tab -->
        <div class="preview-tab-content" id="preview-tab-css">
            <div class="preview-header">
                <h3><?php esc_html_e('Generated CSS', 'enhanced-plugin-bundle'); ?></h3>
                <button type="button" id="copy-css" class="ppm-button ppm-button-primary" title="<?php esc_attr_e('Copy to clipboard', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-clipboard"></span>
                    <?php esc_html_e('Copy', 'enhanced-plugin-bundle'); ?>
                </button>
            </div>
            <div class="preview-css-content">
                <pre id="generated-css"><code></code></pre>
            </div>
        </div>
    </aside>
</div>

<!-- Import Modal -->
<div id="import-modal" class="ppm-modal" style="display: none;">
    <div class="modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3><?php esc_html_e('Import Component Settings', 'enhanced-plugin-bundle'); ?></h3>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <p><?php esc_html_e('Paste your exported JSON data below:', 'enhanced-plugin-bundle'); ?></p>
            <textarea id="import-data" rows="10" placeholder='{"button": {"button-color": "#fff"}, ...}'></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="ppm-button modal-cancel"><?php esc_html_e('Cancel', 'enhanced-plugin-bundle'); ?></button>
            <button type="button" class="ppm-button ppm-button-primary" id="confirm-import"><?php esc_html_e('Import', 'enhanced-plugin-bundle'); ?></button>
        </div>
    </div>
</div>

<!-- Import Figma Modal -->
<div id="import-figma-modal" class="ppm-modal" style="display: none;">
    <div class="modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3><?php esc_html_e('Import from Figma Tokens Studio', 'enhanced-plugin-bundle'); ?></h3>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <p><?php esc_html_e('Paste your Tokens Studio JSON export from Figma:', 'enhanced-plugin-bundle'); ?></p>
            <p class="description"><?php esc_html_e('Only tokens with actual values will be imported. References and calculations will be skipped.', 'enhanced-plugin-bundle'); ?></p>
            <textarea id="import-figma-data" rows="12" placeholder='{"global": {"font-size": {"value": "16px", "type": "fontSizes"}}, ...}'></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="ppm-button modal-cancel"><?php esc_html_e('Cancel', 'enhanced-plugin-bundle'); ?></button>
            <button type="button" class="ppm-button ppm-button-primary" id="confirm-import-figma"><?php esc_html_e('Import', 'enhanced-plugin-bundle'); ?></button>
        </div>
    </div>
</div>