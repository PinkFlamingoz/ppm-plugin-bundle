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
use EPB\Core\Constants;

$categories = Component_Registry::get_components_by_category();
$total_vars = Component_Registry::get_total_variable_count();

// Get saved counts for each component to show modified indicator.
$modified_components = Component_Handler::get_all_modified_counts();

// Get the current fluid scale ratios.
$fluid_scale_ratio = get_option(Constants::OPTION_FLUID_SCALE_RATIO, Constants::DEFAULT_FLUID_SCALE_RATIO);
$fluid_scale_ratio_navbar = get_option(Constants::OPTION_FLUID_SCALE_RATIO_NAVBAR, Constants::DEFAULT_FLUID_SCALE_RATIO_NAVBAR);
$fluid_scale_ratio_nav = get_option(Constants::OPTION_FLUID_SCALE_RATIO_NAV, Constants::DEFAULT_FLUID_SCALE_RATIO_NAV);

// Get the current Adobe Font settings.
$adobe_font_enabled = get_option(Constants::OPTION_ADOBE_FONT_ENABLED, '0');
$adobe_font_url = get_option(Constants::OPTION_ADOBE_FONT_URL, '');

// Get the hyphenation setting.
$hyphenation_enabled = get_option(Constants::OPTION_HYPHENATION_ENABLED, '1');

// Get the current branding settings.
$branding = Child_Theme::get_branding();

// Check child theme status.
$child_theme_exists = file_exists(Child_Theme::get_child_theme_dir());
$child_theme_active = ThemesManager::is_child_theme_active();
?>

<div class="epb-theme-builder" id="epb-component-picker">
    <!-- Sidebar: Component Menu -->
    <aside class="epb-component-menu">
        <div class="menu-header">
            <h3><?php esc_html_e('Components', 'enhanced-plugin-bundle'); ?></h3>
            <div class="menu-header-actions">
                <button type="button" id="export-figma" class="epb-button-icon" title="<?php esc_attr_e('Export for Figma Tokens Studio', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-share-alt2"></span>
                </button>
                <button type="button" id="import-figma" class="epb-button-icon" title="<?php esc_attr_e('Import from Figma Tokens Studio', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-migrate"></span>
                </button>
                <button type="button" id="export-yootheme-less" class="epb-button-icon" title="<?php esc_attr_e('Export YOOtheme Style JSON', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-editor-code"></span>
                </button>
                <button type="button" id="export-all-components" class="epb-button-icon" title="<?php esc_attr_e('Export All (JSON)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-download"></span>
                </button>
                <button type="button" id="import-components" class="epb-button-icon" title="<?php esc_attr_e('Import (JSON)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-upload"></span>
                </button>
                <button type="button" id="setup-child-theme" class="epb-button-icon" title="<?php esc_attr_e('Create or update child theme structure (functions.php, config.php)', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <?php if ($child_theme_exists) : ?>
                        <span class="child-theme-status-dot <?php echo $child_theme_active ? 'active' : 'exists'; ?>"></span>
                    <?php endif; ?>
                </button>
            </div>
            <span class="total-vars"><?php printf(esc_html__('%d variables', 'enhanced-plugin-bundle'), $total_vars); ?></span>
        </div>

        <div class="menu-global-actions">
            <button type="button" class="epb-button epb-button-small" id="reset-all-components" title="<?php esc_attr_e('Reset all components to defaults', 'enhanced-plugin-bundle'); ?>">
                <span class="dashicons dashicons-image-rotate"></span>
                <?php esc_html_e('Reset All', 'enhanced-plugin-bundle'); ?>
            </button>
            <button type="button" class="epb-button epb-button-small epb-button-primary" id="save-all-components" title="<?php esc_attr_e('Save all component changes', 'enhanced-plugin-bundle'); ?>">
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

        <div class="menu-global-settings collapsed">
            <h4 class="global-settings-label global-settings-toggle">
                <span class="dashicons dashicons-arrow-right-alt2 toggle-icon"></span>
                <span class="dashicons dashicons-admin-settings"></span>
                <?php esc_html_e('Fluid Scale Ratios', 'enhanced-plugin-bundle'); ?>
                <span class="setting-hint" title="<?php esc_attr_e('Controls how much font-sizes shrink on mobile. 0.85 = 85% of desktop size. Lower values = smaller mobile text.', 'enhanced-plugin-bundle'); ?>">?</span>
            </h4>
            <div class="global-settings-body">
                <div class="global-setting-row">
                    <label for="fluid-scale-ratio">
                        <?php esc_html_e('General', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <div class="setting-input-group">
                        <input type="range"
                            class="fluid-ratio-range"
                            data-target="fluid-scale-ratio"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio); ?>">
                        <input type="number"
                            id="fluid-scale-ratio"
                            name="fluid_scale_ratio"
                            data-option="fluid_scale_ratio"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio); ?>"
                            class="setting-number-input fluid-ratio-number">
                    </div>
                </div>
                <div class="global-setting-row">
                    <label for="fluid-scale-ratio-navbar">
                        <?php esc_html_e('Navbar', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <div class="setting-input-group">
                        <input type="range"
                            class="fluid-ratio-range"
                            data-target="fluid-scale-ratio-navbar"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio_navbar); ?>">
                        <input type="number"
                            id="fluid-scale-ratio-navbar"
                            name="fluid_scale_ratio_navbar"
                            data-option="fluid_scale_ratio_navbar"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio_navbar); ?>"
                            class="setting-number-input fluid-ratio-number">
                    </div>
                </div>
                <div class="global-setting-row">
                    <label for="fluid-scale-ratio-nav">
                        <?php esc_html_e('Nav', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <div class="setting-input-group">
                        <input type="range"
                            class="fluid-ratio-range"
                            data-target="fluid-scale-ratio-nav"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio_nav); ?>">
                        <input type="number"
                            id="fluid-scale-ratio-nav"
                            name="fluid_scale_ratio_nav"
                            data-option="fluid_scale_ratio_nav"
                            min="0.1"
                            max="2"
                            step="0.01"
                            value="<?php echo esc_attr($fluid_scale_ratio_nav); ?>"
                            class="setting-number-input fluid-ratio-number">
                    </div>
                </div>
                <div class="global-setting-row setting-row-actions">
                    <button type="button" id="save-fluid-ratios" class="epb-button epb-button-small epb-button-primary" title="<?php esc_attr_e('Save all ratios', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Save', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="menu-global-settings collapsed">
            <h4 class="global-settings-label global-settings-toggle">
                <span class="dashicons dashicons-arrow-right-alt2 toggle-icon"></span>
                <span class="dashicons dashicons-editor-spellcheck"></span>
                <?php esc_html_e('Hyphenation & Word Wrap', 'enhanced-plugin-bundle'); ?>
                <span class="setting-hint" title="<?php esc_attr_e('Adds CSS hyphens and overflow-wrap rules to html, headings, and text elements for better word breaking on small screens.', 'enhanced-plugin-bundle'); ?>">?</span>
            </h4>
            <div class="global-settings-body">
                <div class="global-setting-row">
                    <label class="setting-toggle-label" for="hyphenation-enabled">
                        <input type="checkbox"
                            id="hyphenation-enabled"
                            class="setting-toggle-checkbox"
                            value="1"
                            <?php checked($hyphenation_enabled, '1'); ?>>
                        <span class="setting-toggle-switch"></span>
                        <?php esc_html_e('Enable Hyphenation & Word Wrap', 'enhanced-plugin-bundle'); ?>
                    </label>
                </div>
                <div class="global-setting-row setting-row-actions">
                    <button type="button" id="save-hyphenation" class="epb-button epb-button-small epb-button-primary" title="<?php esc_attr_e('Save hyphenation setting', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Save', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="menu-global-settings collapsed">
            <h4 class="global-settings-label global-settings-toggle">
                <span class="dashicons dashicons-arrow-right-alt2 toggle-icon"></span>
                <span class="dashicons dashicons-tagcloud"></span>
                <?php esc_html_e('Adobe Fonts', 'enhanced-plugin-bundle'); ?>
                <span class="setting-hint" title="<?php esc_attr_e('Load an Adobe Fonts (Typekit) stylesheet on your site. Paste the CSS URL from your Adobe Fonts project.', 'enhanced-plugin-bundle'); ?>">?</span>
            </h4>
            <div class="global-settings-body">
                <div class="global-setting-row">
                    <label class="setting-toggle-label" for="adobe-font-enabled">
                        <input type="checkbox"
                            id="adobe-font-enabled"
                            class="setting-toggle-checkbox"
                            value="1"
                            <?php checked($adobe_font_enabled, '1'); ?>>
                        <span class="setting-toggle-switch"></span>
                        <?php esc_html_e('Enable Adobe Fonts', 'enhanced-plugin-bundle'); ?>
                    </label>
                </div>
                <div class="global-setting-row adobe-font-url-row" <?php echo $adobe_font_enabled !== '1' ? 'style="display:none"' : ''; ?>>
                    <label for="adobe-font-url">
                        <?php esc_html_e('CSS URL', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="url"
                        id="adobe-font-url"
                        class="setting-text-input"
                        value="<?php echo esc_attr($adobe_font_url); ?>"
                        placeholder="https://use.typekit.net/abc1234.css">
                </div>
                <div class="global-setting-row setting-row-actions">
                    <button type="button" id="save-adobe-font" class="epb-button epb-button-small epb-button-primary" title="<?php esc_attr_e('Save Adobe Font settings', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Save', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="menu-global-settings collapsed">
            <h4 class="global-settings-label global-settings-toggle">
                <span class="dashicons dashicons-arrow-right-alt2 toggle-icon"></span>
                <span class="dashicons dashicons-admin-customizer"></span>
                <?php esc_html_e('Child Theme Branding', 'enhanced-plugin-bundle'); ?>
                <span class="setting-hint" title="<?php esc_attr_e('Customize the child theme identity. These values are used when generating the child theme files.', 'enhanced-plugin-bundle'); ?>">?</span>
            </h4>
            <div class="global-settings-body">
                <div class="global-setting-row">
                    <label for="branding-theme-name">
                        <?php esc_html_e('Theme Name', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="text"
                        id="branding-theme-name"
                        class="setting-text-input branding-field"
                        data-key="theme_name"
                        value="<?php echo esc_attr($branding['theme_name']); ?>"
                        placeholder="CT Child">
                </div>
                <div class="global-setting-row">
                    <label for="branding-company-name">
                        <?php esc_html_e('Company Name', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="text"
                        id="branding-company-name"
                        class="setting-text-input branding-field"
                        data-key="company_name"
                        value="<?php echo esc_attr($branding['company_name']); ?>"
                        placeholder="Plappermaul OG">
                </div>
                <div class="global-setting-row">
                    <label for="branding-company-url">
                        <?php esc_html_e('Company URL', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="url"
                        id="branding-company-url"
                        class="setting-text-input branding-field"
                        data-key="company_url"
                        value="<?php echo esc_attr($branding['company_url']); ?>"
                        placeholder="https://www.example.com">
                </div>
                <div class="global-setting-row">
                    <label for="branding-logo-url">
                        <?php esc_html_e('Login Logo URL', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="url"
                        id="branding-logo-url"
                        class="setting-text-input branding-field"
                        data-key="logo_url"
                        value="<?php echo esc_attr($branding['logo_url']); ?>"
                        placeholder="https://www.example.com/logo.svg">
                </div>
                <div class="global-setting-row">
                    <label for="branding-description">
                        <?php esc_html_e('Theme Description', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="text"
                        id="branding-description"
                        class="setting-text-input branding-field"
                        data-key="description"
                        value="<?php echo esc_attr($branding['description']); ?>"
                        placeholder="Child theme generated by Enhanced Plugin Bundle.">
                </div>
                <div class="global-setting-row">
                    <label for="branding-version">
                        <?php esc_html_e('Theme Version', 'enhanced-plugin-bundle'); ?>
                    </label>
                    <input type="text"
                        id="branding-version"
                        class="setting-text-input branding-field"
                        data-key="version"
                        value="<?php echo esc_attr($branding['version']); ?>"
                        placeholder="1.0.0">
                </div>
                <div class="global-setting-row setting-row-actions">
                    <button type="button" id="save-branding" class="epb-button epb-button-small epb-button-primary" title="<?php esc_attr_e('Save branding settings', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Save', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
            </div>
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
    <main class="epb-component-editor">
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
                    <button type="button" class="epb-button" id="toggle-all-groups" title="<?php esc_attr_e('Collapse/Expand All', 'enhanced-plugin-bundle'); ?>">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                        <?php esc_html_e('Expand All', 'enhanced-plugin-bundle'); ?>
                    </button>
                    <button type="button" class="epb-button" id="reset-component">
                        <span class="dashicons dashicons-image-rotate"></span>
                        <?php esc_html_e('Reset to Defaults', 'enhanced-plugin-bundle'); ?>
                    </button>
                </div>
                <div class="actions-right">
                    <button type="submit" class="epb-button epb-button-primary" id="save-component">
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
    <aside class="epb-preview-panel">
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
                <button type="button" id="copy-css" class="epb-button epb-button-primary" title="<?php esc_attr_e('Copy to clipboard', 'enhanced-plugin-bundle'); ?>">
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
<div id="import-modal" class="epb-modal" style="display: none;">
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
            <button type="button" class="epb-button modal-cancel"><?php esc_html_e('Cancel', 'enhanced-plugin-bundle'); ?></button>
            <button type="button" class="epb-button epb-button-primary" id="confirm-import"><?php esc_html_e('Import', 'enhanced-plugin-bundle'); ?></button>
        </div>
    </div>
</div>

<!-- Import Figma Modal -->
<div id="import-figma-modal" class="epb-modal" style="display: none;">
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
            <button type="button" class="epb-button modal-cancel"><?php esc_html_e('Cancel', 'enhanced-plugin-bundle'); ?></button>
            <button type="button" class="epb-button epb-button-primary" id="confirm-import-figma"><?php esc_html_e('Import', 'enhanced-plugin-bundle'); ?></button>
        </div>
    </div>
</div>