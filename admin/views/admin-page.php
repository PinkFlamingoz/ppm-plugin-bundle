<?php

/**
 * Admin Page Template
 *
 * Main template for the Plugin Bundle Manager admin page.
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 *
 * @var array $plugins List of plugins to display.
 */

if (! defined('ABSPATH')) {
    exit;
}

use EPB\Plugins\Manager as PluginManager;
use EPB\Themes\Manager as ThemesManager;
?>
<div class="wrap">
    <?php require EPB_PLUGIN_DIR . 'admin/views/partials/header.php'; ?>

    <!-- Form for handling bulk actions on plugins -->
    <form method="post">
        <?php wp_nonce_field('epb_plugin_actions', 'epb_plugin_nonce'); ?>
        <div class="ppm-section">
            <?php PluginManager::render_bulk_controls(); ?>
            <?php PluginManager::render_plugin_table($plugins); ?>
        </div>
    </form>

    <!-- Form for uploading a parent theme -->
    <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('epb_upload_theme', 'epb_theme_nonce'); ?>
        <?php ThemesManager::render_upload_parent_theme_section(); ?>
    </form>

    <!-- Component-based theming section -->
    <?php ThemesManager::render_component_picker_section(); ?>

    <?php require EPB_PLUGIN_DIR . 'admin/views/partials/footer.php'; ?>
</div>