<?php

/**
 * Component AJAX Handler for Enhanced Plugin Bundle.
 *
 * Main coordinator that delegates to specialized component classes.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Ajax
 * @since 4.1.0
 */

namespace EPB\Ajax;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Less_Parser;
use EPB\CSS\Component_Registry;
use EPB\CSS\Generator;
use EPB\Core\Constants;
use EPB\Core\Utils;
use EPB\Themes\Child_Theme;

/**
 * Class Component_Handler
 *
 * Manages AJAX operations for the component-based theming system.
 * Delegates to specialized classes for specific operations.
 */
class Component_Handler
{

    /**
     * Register AJAX handlers.
     *
     * @return void
     */
    public static function register(): void
    {
        // Loading operations - delegated to Component_Loader.
        add_action('wp_ajax_epb_load_component', [Component_Loader::class, 'load_component']);
        add_action('wp_ajax_epb_get_components_menu', [Component_Loader::class, 'get_components_menu']);
        add_action('wp_ajax_epb_get_component_preview', [Component_Loader::class, 'get_component_preview']);
        add_action('wp_ajax_epb_get_preview_page', [Component_Loader::class, 'get_preview_page']);

        // Saving/resetting operations - delegated to Component_Saver.
        add_action('wp_ajax_epb_save_component', [Component_Saver::class, 'save_component']);
        add_action('wp_ajax_epb_reset_component', [Component_Saver::class, 'reset_component']);
        add_action('wp_ajax_epb_reset_field', [Component_Saver::class, 'reset_field']);
        add_action('wp_ajax_epb_reset_all_components', [Component_Saver::class, 'reset_all_components']);

        // Export operations - delegated to Component_Exporter.
        add_action('wp_ajax_epb_export_all_components', [Component_Exporter::class, 'export_all_components']);
        add_action('wp_ajax_epb_export_yootheme_less', [Component_Exporter::class, 'export_yootheme_less']);

        // Import operations - delegated to Component_Importer.
        add_action('wp_ajax_epb_import_components', [Component_Importer::class, 'import_components']);

        // Resolve variable references.
        add_action('wp_ajax_epb_resolve_variable', [self::class, 'resolve_variable']);

        // Global settings.
        add_action('wp_ajax_epb_save_fluid_scale_ratio', [self::class, 'save_fluid_scale_ratio']);
        add_action('wp_ajax_epb_save_adobe_font', [self::class, 'save_adobe_font']);
        add_action('wp_ajax_epb_save_branding', [self::class, 'save_branding']);
    }

    /**
     * Regenerate the CSS cache after changes.
     *
     * @return void
     */
    public static function regenerate_css(): void
    {
        // Clear any cached CSS.
        delete_transient(Constants::TRANSIENT_CSS);

        // Flag that YOOtheme needs to recompile its styles on next customizer load.
        update_option('epb_needs_recompile', true, false);

        // Optionally trigger child theme CSS regeneration.
        do_action('epb_component_settings_updated');
    }

    /**
     * Resolve a Less variable reference via AJAX.
     *
     * Accepts a value like '@global-color' and returns its resolved value.
     *
     * @return void
     */
    public static function resolve_variable(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $value = sanitize_text_field($_POST['value'] ?? '');

        if (empty($value)) {
            wp_send_json_error(['message' => __('No value specified.', 'enhanced-plugin-bundle')]);
            return;
        }

        $resolved = Less_Parser::resolve_value($value);

        wp_send_json_success([
            'original' => $value,
            'resolved' => $resolved,
        ]);
    }

    /**
     * Save fluid typography scale ratios via AJAX.
     *
     * Accepts one or more ratio values: ratio, ratio_navbar, ratio_nav.
     *
     * @return void
     */
    public static function save_fluid_scale_ratio(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $ratio_map = [
            'ratio'        => [Constants::OPTION_FLUID_SCALE_RATIO, Constants::DEFAULT_FLUID_SCALE_RATIO],
            'ratio_navbar' => [Constants::OPTION_FLUID_SCALE_RATIO_NAVBAR, Constants::DEFAULT_FLUID_SCALE_RATIO_NAVBAR],
            'ratio_nav'    => [Constants::OPTION_FLUID_SCALE_RATIO_NAV, Constants::DEFAULT_FLUID_SCALE_RATIO_NAV],
        ];

        $updated = [];

        foreach ($ratio_map as $post_key => [$option_key, $default]) {
            if (!isset($_POST[$post_key]) || !is_string($_POST[$post_key]) || $_POST[$post_key] === '') {
                continue;
            }

            $value = sanitize_text_field(wp_unslash($_POST[$post_key]));

            if (!is_numeric($value)) {
                wp_send_json_error(['message' => sprintf(
                    /* translators: %s: field name */
                    __('Invalid value for %s.', 'enhanced-plugin-bundle'),
                    $post_key
                )]);
                return;
            }

            $val = (float) $value;

            if ($val < 0.1 || $val > 2.0) {
                wp_send_json_error(['message' => __('Ratios must be between 0.1 and 2.0.', 'enhanced-plugin-bundle')]);
                return;
            }

            $updated[$option_key] = number_format($val, 2, '.', '');
        }

        if (empty($updated)) {
            wp_send_json_error(['message' => __('No ratio values provided.', 'enhanced-plugin-bundle')]);
            return;
        }

        foreach ($updated as $option_key => $formatted) {
            update_option($option_key, $formatted, false);
        }

        // Regenerate CSS since the ratios affect the output.
        self::regenerate_css();

        wp_send_json_success([
            'message' => __('Fluid scale ratios saved.', 'enhanced-plugin-bundle'),
            'ratios'  => $updated,
        ]);
    }

    /**
     * Save Adobe Font settings via AJAX.
     *
     * Accepts 'enabled' (0/1) and 'url' (CSS URL string).
     *
     * @return void
     */
    public static function save_adobe_font(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $enabled = sanitize_text_field(wp_unslash($_POST['enabled'] ?? '0'));
        $url     = esc_url_raw(wp_unslash($_POST['url'] ?? ''));

        // Validate enabled is 0 or 1.
        $enabled = ($enabled === '1') ? '1' : '0';

        // If enabling, URL is required.
        if ($enabled === '1' && empty($url)) {
            wp_send_json_error([
                'message' => __('Please enter an Adobe Fonts CSS URL.', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        // Validate URL format if provided.
        if (!empty($url) && !preg_match('#^https?://#i', $url)) {
            wp_send_json_error([
                'message' => __('Please enter a valid URL starting with https://', 'enhanced-plugin-bundle'),
            ]);
            return;
        }

        update_option(Constants::OPTION_ADOBE_FONT_ENABLED, $enabled, false);
        update_option(Constants::OPTION_ADOBE_FONT_URL, $url, false);

        wp_send_json_success([
            'message' => $enabled === '1'
                ? __('Adobe Fonts enabled and saved.', 'enhanced-plugin-bundle')
                : __('Adobe Fonts disabled.', 'enhanced-plugin-bundle'),
            'enabled' => $enabled,
            'url'     => $url,
        ]);
    }

    /**
     * Save child theme branding settings via AJAX.
     *
     * @return void
     */
    public static function save_branding(): void
    {
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $defaults = Constants::DEFAULT_BRANDING;
        $branding = [];

        foreach (array_keys($defaults) as $key) {
            $value = isset($_POST[$key]) ? sanitize_text_field(wp_unslash($_POST[$key])) : '';

            // Use default if empty.
            $branding[$key] = !empty($value) ? $value : $defaults[$key];
        }

        // Validate URLs.
        foreach (['company_url', 'logo_url'] as $url_key) {
            if (!empty($branding[$url_key]) && !preg_match('#^https?://#i', $branding[$url_key])) {
                wp_send_json_error([
                    'message' => sprintf(
                        /* translators: %s: field name */
                        __('%s must be a valid URL starting with https://', 'enhanced-plugin-bundle'),
                        $url_key
                    ),
                ]);
                return;
            }
        }

        update_option(Constants::OPTION_BRANDING, $branding, false);

        // Regenerate child theme files (style.css + functions.php) with new branding.
        $child_dir = Child_Theme::get_child_theme_dir();
        $files_updated = false;

        if (file_exists($child_dir)) {
            Child_Theme::create_and_activate(true);
            $files_updated = true;
        }

        wp_send_json_success([
            'message'       => $files_updated
                ? __('Branding saved and child theme files updated.', 'enhanced-plugin-bundle')
                : __('Branding settings saved.', 'enhanced-plugin-bundle'),
            'branding'      => $branding,
            'files_updated' => $files_updated,
        ]);
    }

    /**
     * Get saved value for a specific variable.
     *
     * @param string $component Component name.
     * @param string $variable  Variable name.
     * @return mixed|null Saved value or null.
     */
    public static function get_saved_value(string $component, string $variable)
    {
        $saved = get_option(Constants::OPTION_PREFIX . $component, []);
        return $saved[$variable] ?? null;
    }

    /**
     * Get all saved values for a component.
     *
     * @param string $component Component name.
     * @return array<string, mixed> Saved values.
     */
    public static function get_component_values(string $component): array
    {
        return get_option(Constants::OPTION_PREFIX . $component, []);
    }

    /**
     * Get the generated CSS for all components.
     *
     * @return string Generated CSS.
     * @deprecated Use Generator::generate_all_component_css() directly.
     */
    public static function generate_component_css(): string
    {
        return Generator::generate_all_component_css();
    }

    /**
     * Get the count of modified variables for all components.
     *
     * @return array<string, int> Component key => modified count.
     */
    public static function get_all_modified_counts(): array
    {
        $counts = [];
        $components = Component_Registry::get_all();

        foreach (array_keys($components) as $component) {
            $saved = get_option(Constants::OPTION_PREFIX . $component, []);
            if (!empty($saved)) {
                // Count only values that are actually different from defaults.
                $variables = Less_Parser::parse_component($component);
                $actual_modified = 0;

                foreach ($saved as $key => $value) {
                    if (!isset($variables[$key])) {
                        continue;
                    }
                    if (Utils::is_value_modified($value, $variables[$key])) {
                        $actual_modified++;
                    }
                }

                if ($actual_modified > 0) {
                    $counts[$component] = $actual_modified;
                }
            }
        }

        return $counts;
    }
}
