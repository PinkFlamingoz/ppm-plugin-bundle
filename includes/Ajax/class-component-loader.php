<?php

/**
 * Component Loader for Enhanced Plugin Bundle.
 *
 * Handles loading components and menu data.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.2.0
 */

namespace EPB\Ajax;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Component_Registry;
use EPB\Themes\Renderer\Dynamic_Renderer;
use EPB\Core\Constants;

/**
 * Class Component_Loader
 *
 * Handles loading components and their fields.
 */
class Component_Loader
{
    /**
     * Load a component's fields via AJAX.
     *
     * @return void
     */
    public static function load_component(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $component = sanitize_key($_POST['component'] ?? '');

        if (empty($component)) {
            wp_send_json_error(['message' => __('No component specified.', 'enhanced-plugin-bundle')]);
            return;
        }

        // Get component data.
        $data = Component_Registry::get_component($component);

        if (!$data) {
            wp_send_json_error(['message' => __('Component not found.', 'enhanced-plugin-bundle')]);
            return;
        }

        // Get saved values.
        $saved = get_option(Constants::OPTION_PREFIX . $component, []);

        // Render fields to HTML string.
        ob_start();
        Dynamic_Renderer::render_component_fields($component, $saved);
        $fields_html = ob_get_clean();

        wp_send_json_success([
            'label'          => $data['label'],
            'description'    => $data['description'],
            'icon'           => $data['icon'],
            'fields'         => $fields_html,
            'variable_count' => $data['variable_count'],
            'component'      => $component,
        ]);
    }

    /**
     * Get the components menu structure.
     *
     * @return void
     */
    public static function get_components_menu(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $grouped = Component_Registry::get_components_by_category();

        wp_send_json_success([
            'categories' => $grouped,
        ]);
    }

    /**
     * Get component preview HTML via AJAX.
     *
     * @return void
     */
    public static function get_component_preview(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $component = sanitize_key($_POST['component'] ?? '');

        if (empty($component)) {
            wp_send_json_error(['message' => __('No component specified.', 'enhanced-plugin-bundle')]);
            return;
        }

        // Get preview HTML.
        $preview_html = \EPB\Themes\Renderer\Preview_Renderer::get_preview($component);

        wp_send_json_success([
            'html'      => $preview_html,
            'component' => $component,
        ]);
    }

    /**
     * Serve the full preview page for iframe embedding.
     *
     * @return void
     */
    public static function get_preview_page(): void
    {
        // Verify nonce.
        if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], Constants::NONCE_ACTION)) {
            wp_die(__('Security check failed.', 'enhanced-plugin-bundle'));
        }

        // Check permissions.
        if (!current_user_can('manage_options')) {
            wp_die(__('Permission denied.', 'enhanced-plugin-bundle'));
        }

        $component = sanitize_key($_GET['component'] ?? '');

        // Include the preview page template.
        $template_path = EPB_PLUGIN_DIR . 'admin/views/partials/component-preview.php';
        if (!file_exists($template_path)) {
            wp_die(__('Preview template not found.', 'enhanced-plugin-bundle'));
        }
        include $template_path;
        exit;
    }
}
