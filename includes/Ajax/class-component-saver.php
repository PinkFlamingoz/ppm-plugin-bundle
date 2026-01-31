<?php

/**
 * Component Saver for Enhanced Plugin Bundle.
 *
 * Handles saving and resetting component values.
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

use EPB\CSS\Less_Parser;
use EPB\CSS\Component_Registry;

/**
 * Class Component_Saver
 *
 * Handles saving and resetting component variable values.
 */
class Component_Saver
{
    /**
     * Save a component's variables via AJAX.
     *
     * @return void
     */
    public static function save_component(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        $component = sanitize_key($_POST['component'] ?? '');
        $values    = $_POST['values'] ?? [];

        if (empty($component)) {
            wp_send_json_error(['message' => __('No component specified.', 'enhanced-plugin-bundle')]);
            return;
        }

        if (!Component_Registry::has_component($component)) {
            wp_send_json_error(['message' => __('Invalid component.', 'enhanced-plugin-bundle')]);
            return;
        }

        // Sanitize values and filter out unchanged ones.
        $sanitized = self::sanitize_component_values($component, $values);
        $modified = self::filter_modified_values($component, $sanitized);

        // Save only modified values to database (or delete if none modified).
        if (empty($modified)) {
            delete_option(Component_Handler::OPTION_PREFIX . $component);
        } else {
            update_option(Component_Handler::OPTION_PREFIX . $component, $modified);
        }

        // Regenerate CSS cache.
        Component_Handler::regenerate_css();

        wp_send_json_success([
            'message' => sprintf(
                /* translators: %s: component name */
                __('%s settings saved successfully.', 'enhanced-plugin-bundle'),
                Component_Registry::get_component($component)['label'] ?? $component
            ),
        ]);
    }

    /**
     * Reset a component's variables to defaults.
     *
     * @return void
     */
    public static function reset_component(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        $component = sanitize_key($_POST['component'] ?? '');

        if (empty($component)) {
            wp_send_json_error(['message' => __('No component specified.', 'enhanced-plugin-bundle')]);
            return;
        }

        // Delete saved options for this component.
        delete_option(Component_Handler::OPTION_PREFIX . $component);

        // Regenerate CSS.
        Component_Handler::regenerate_css();

        wp_send_json_success([
            'message' => sprintf(
                /* translators: %s: component name */
                __('%s reset to defaults.', 'enhanced-plugin-bundle'),
                Component_Registry::get_component($component)['label'] ?? $component
            ),
        ]);
    }

    /**
     * Reset all component customizations.
     *
     * @return void
     */
    public static function reset_all_components(): void
    {
        if (!Handler::verify_request(Component_Handler::NONCE_ACTION)) {
            return;
        }

        // Get all components and delete their options.
        $components = Component_Registry::get_all();
        $count = 0;

        foreach ($components as $component_id => $component) {
            if (delete_option(Component_Handler::OPTION_PREFIX . $component_id)) {
                $count++;
            }
        }

        // Regenerate CSS.
        Component_Handler::regenerate_css();

        wp_send_json_success([
            'message' => sprintf(
                /* translators: %d: number of components reset */
                __('Reset %d component(s) to defaults.', 'enhanced-plugin-bundle'),
                $count
            ),
            'count' => $count,
        ]);
    }

    /**
     * Filter out values that are the same as the default.
     *
     * @param string $component Component name.
     * @param array  $values    Sanitized values.
     * @return array Values that differ from defaults.
     */
    public static function filter_modified_values(string $component, array $values): array
    {
        $variables = Less_Parser::parse_component($component);
        $modified = [];

        foreach ($values as $key => $value) {
            if (!isset($variables[$key])) {
                continue;
            }

            $original = $variables[$key]['value'];

            // Normalize Less escape syntax for comparison.
            $normalized_value = Component_Handler::normalize_less_escape($value);
            $normalized_original = Component_Handler::normalize_less_escape($original);

            // Compare values - only keep if different from original.
            if ($normalized_value !== $normalized_original) {
                // Store the normalized value to avoid escaped quote issues.
                $modified[$key] = $normalized_value;
            }
        }

        return $modified;
    }

    /**
     * Sanitize component variable values.
     *
     * @param string $component Component name.
     * @param array  $values    Raw values to sanitize.
     * @return array<string, mixed> Sanitized values.
     */
    public static function sanitize_component_values(string $component, array $values): array
    {
        $variables = Less_Parser::parse_component($component);
        $sanitized = [];

        foreach ($values as $key => $value) {
            $key = sanitize_key($key);

            // Skip keys that are too long (prevent database issues).
            if (strlen($key) > 100) {
                continue;
            }

            // Skip unit fields (they're combined with their parent).
            if (str_ends_with($key, '_unit')) {
                continue;
            }

            // Check if this variable exists in the component.
            if (!isset($variables[$key])) {
                continue;
            }

            $type = $variables[$key]['type'];

            // Combine value with unit if applicable.
            if (in_array($type, ['size', 'duration'], true) && isset($values[$key . '_unit'])) {
                $unit  = sanitize_text_field($values[$key . '_unit']);
                $value = floatval($value) . $unit;
            }

            // Sanitize based on type.
            $sanitized[$key] = match ($type) {
                'color'       => sanitize_hex_color($value) ?: sanitize_text_field($value),
                'size'        => sanitize_text_field($value),
                'number'      => sanitize_text_field($value), // Keep as string for consistent comparison.
                'font-weight' => self::sanitize_font_weight($value),
                'duration'    => sanitize_text_field($value),
                'font'        => wp_strip_all_tags(stripslashes($value)),
                default       => wp_strip_all_tags(stripslashes($value)),
            };
        }

        return $sanitized;
    }

    /**
     * Sanitize a font-weight value.
     *
     * Preserves valid CSS font-weight keywords (normal, bold, bolder, lighter, inherit, etc.)
     * and numeric values (100-900).
     *
     * @param string $value The font-weight value to sanitize.
     * @return string The sanitized font-weight value.
     */
    private static function sanitize_font_weight(string $value): string
    {
        // Valid CSS font-weight keywords.
        $keywords = ['normal', 'bold', 'bolder', 'lighter', 'inherit', 'initial', 'unset'];

        $value = strtolower(trim($value));

        // If it's a valid keyword, return it.
        if (in_array($value, $keywords, true)) {
            return $value;
        }

        // If it's a valid numeric weight (100-900), return it as a string.
        if (is_numeric($value)) {
            $numeric = intval($value);
            // Clamp to valid font-weight range.
            $numeric = max(100, min(900, $numeric));
            // Round to nearest 100.
            $numeric = round($numeric / 100) * 100;
            return (string) $numeric;
        }

        // If it's a variable reference, preserve it.
        if (strpos($value, '@') === 0) {
            return sanitize_text_field($value);
        }

        // Default to 'normal' for invalid values.
        return 'normal';
    }
}
