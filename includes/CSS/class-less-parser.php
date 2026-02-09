<?php

/**
 * Less File Parser for Enhanced Plugin Bundle.
 *
 * Parses UIkit Less files to extract CSS variables and their metadata.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage CSS
 * @since 4.1.0
 */

namespace EPB\CSS;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Less_Parser
 *
 * Extracts variables from UIkit Less files for dynamic theming.
 */
class Less_Parser
{
    /**
     * Path to the Less files directory (consolidated from all UIkit layers).
     *
     * @var string
     */
    private const LESS_DIR = EPB_PLUGIN_DIR . 'docs/uikit-less-consolidated/';

    /**
     * Cache for parsed components.
     *
     * @var array<string, array>
     */
    private static array $cache = [];

    /**
     * Parse a Less file and extract all variables.
     *
     * @param string $component Component name (e.g., 'button', 'card').
     * @return array<string, array> Variables with metadata.
     */
    public static function parse_component(string $component): array
    {
        // Return cached result if available.
        if (isset(self::$cache[$component])) {
            return self::$cache[$component];
        }

        $file_path = self::LESS_DIR . $component . '.less';

        if (!file_exists($file_path)) {
            return [];
        }

        $content = file_get_contents($file_path);

        // Check for file read failure.
        if ($content === false) {
            return [];
        }

        $variables = self::extract_variables($content, $component);

        // Cache the result.
        self::$cache[$component] = $variables;

        return $variables;
    }

    /**
     * Extract variables from Less content.
     *
     * Parses Less files and extracts variables with their metadata.
     * Supports `// @group: Group Name` annotations in Less files for semantic grouping.
     *
     * @param string $content   Less file content.
     * @param string $component Component name for context.
     * @return array<string, array> Extracted variables.
     */
    private static function extract_variables(string $content, string $component): array
    {
        $variables     = [];
        $current_group = 'base'; // Default group.

        // Split content into lines for group tracking.
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            // Check for group annotation: // @group: Group Name
            if (preg_match('/^\/\/\s*@group:\s*(.+?)\s*$/i', trim($line), $group_match)) {
                $current_group = self::normalize_group_key($group_match[1]);
                continue;
            }

            // Match Less variable definition: @variable-name: value;
            if (preg_match('/^@([a-z0-9_-]+)\s*:\s*(.+?)\s*;/i', trim($line), $match)) {
                $name  = $match[1];
                $value = trim($match[2]);

                // Skip internal/hook variables (those starting with internal- or hook-).
                if (
                    str_starts_with($name, 'internal-') ||
                    str_starts_with($name, 'hook-')
                ) {
                    continue;
                }

                // Skip empty Less values (~'' or ~"" or just empty).
                if (
                    $value === "~''" ||
                    $value === '~""' ||
                    $value === ''
                ) {
                    continue;
                }

                $type = self::detect_variable_type($value);

                // If type is 'reference', 'mixed', or 'keyword', try to infer the actual type from the variable name.
                // This handles both simple references (@var), expressions (@var * 0.85), and generic keywords like 'inherit'.
                if ('reference' === $type || 'mixed' === $type || 'keyword' === $type) {
                    $inferred = self::infer_type_from_name($name, $value);
                    // Only use inferred type if we got something more specific than 'reference'.
                    if ('reference' !== $inferred) {
                        $type = $inferred;
                    }
                }

                $variables[$name] = [
                    'name'      => $name,
                    'value'     => $value,
                    'type'      => $type,
                    'component' => $component,
                    'label'     => self::variable_to_label($name, $component),
                    'resolved'  => self::resolve_value($value),
                    'group'     => $current_group,
                ];
            }
        }

        return $variables;
    }

    /**
     * Normalize a group label to a consistent key format.
     *
     * @param string $label Group label from annotation.
     * @return string Normalized key (lowercase, hyphenated).
     */
    private static function normalize_group_key(string $label): string
    {
        $key = strtolower(trim($label));
        $key = preg_replace('/[^a-z0-9]+/', '-', $key);
        $key = trim($key, '-');

        return $key ?: 'base';
    }

    /**
     * Get variables grouped by their semantic group.
     *
     * @param string $component Component name.
     * @return array<string, array> Variables grouped by group key.
     */
    public static function get_grouped_variables(string $component): array
    {
        $variables = self::parse_component($component);
        $grouped   = [];

        foreach ($variables as $name => $meta) {
            $group = $meta['group'] ?? 'base';
            if (!isset($grouped[$group])) {
                $grouped[$group] = [];
            }
            $grouped[$group][$name] = $meta;
        }

        return $grouped;
    }

    /**
     * Convert a group key to a human-readable label.
     *
     * @param string $group_key Group key (e.g., 'nav-items').
     * @return string Human-readable label (e.g., 'Nav Items').
     */
    public static function group_key_to_label(string $group_key): string
    {
        return ucwords(str_replace('-', ' ', $group_key));
    }

    /**
     * Detect the type of a variable based on its value.
     *
     * @param string $value Variable value.
     * @return string Type identifier (color, size, number, reference, keyword, font, mixed).
     */
    private static function detect_variable_type(string $value): string
    {
        $value = trim($value);

        // Color: hex, rgb, rgba, hsl, hsla.
        if (preg_match('/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6}|[0-9A-Fa-f]{8})$/', $value)) {
            return 'color';
        }

        if (preg_match('/^(rgb|rgba|hsl|hsla)\s*\(/', $value)) {
            return 'color';
        }

        // Color keywords (NOT 'inherit' - that's a generic keyword for many properties).
        $color_keywords = ['transparent', 'currentColor'];
        if (in_array($value, $color_keywords, true)) {
            return 'color';
        }

        // Generic CSS keywords that could apply to any property.
        // Return 'keyword' type - the actual UI will be inferred from the variable name.
        if ($value === 'inherit') {
            return 'keyword';
        }

        // Reference to another variable.
        if (preg_match('/^@[a-z0-9_-]+$/i', $value)) {
            return 'reference';
        }

        // Size with unit: px, em, rem, %, vh, vw.
        if (preg_match('/^-?[\d.]+\s*(px|em|rem|%|vh|vw|vmin|vmax)$/i', $value)) {
            return 'size';
        }

        // Pure number (including negative and decimal).
        if (preg_match('/^-?[\d.]+$/', $value)) {
            return 'number';
        }

        // Font family (quoted string).
        if (preg_match('/^["\'].*["\']/', $value)) {
            return 'font';
        }

        // Font weight keywords or numbers.
        if (preg_match('/^(normal|bold|bolder|lighter|[1-9]00)$/i', $value)) {
            return 'font-weight';
        }

        // CSS keywords.
        $keywords = ['none', 'auto', 'inherit', 'initial', 'unset', 'hidden', 'visible', 'solid', 'dashed', 'dotted'];
        if (in_array(strtolower($value), $keywords, true)) {
            return 'keyword';
        }

        // Border shorthand (e.g., "1px solid #ddd").
        if (preg_match('/^\d+px\s+(solid|dashed|dotted)\s+/', $value)) {
            return 'border';
        }

        // Box shadow.
        if (preg_match('/^\d+px\s+\d+px/', $value)) {
            return 'shadow';
        }

        // Duration (e.g., "0.3s", "300ms").
        if (preg_match('/^[\d.]+\s*(s|ms)$/i', $value)) {
            return 'duration';
        }

        // Easing function.
        if (preg_match('/^(ease|ease-in|ease-out|ease-in-out|linear|cubic-bezier)/i', $value)) {
            return 'easing';
        }

        // Mixed/complex value.
        return 'mixed';
    }

    /**
     * Infer the type from the variable name when the value is a reference.
     *
     * This allows color pickers to show for variables like @link-heading-hover-color
     * even when they reference another variable like @global-primary-background.
     *
     * @param string $name  Variable name.
     * @param string $value Variable value (the reference).
     * @return string Inferred type.
     */
    private static function infer_type_from_name(string $name, string $value): string
    {
        // Color patterns in variable names.
        $color_patterns = [
            '-color$',
            '-background$',
            '-border$',
            '-fill$',
            '-stroke$',
            '-outline$',
            '^color-',
            '^background-',
        ];

        foreach ($color_patterns as $pattern) {
            if (preg_match('/' . $pattern . '/i', $name)) {
                return 'color';
            }
        }

        // Also check if the referenced variable name suggests a color.
        $ref_name = ltrim($value, '@');
        foreach ($color_patterns as $pattern) {
            if (preg_match('/' . $pattern . '/i', $ref_name)) {
                return 'color';
            }
        }

        // Size patterns in variable names.
        $size_patterns = [
            '-width$',
            '-height$',
            '-size$',
            '-margin',
            '-padding',
            '-gap$',
            '-gutter',
            '-radius$',
            '-offset$',
            '-top$',
            '-right$',
            '-bottom$',
            '-left$',
        ];

        foreach ($size_patterns as $pattern) {
            if (preg_match('/' . $pattern . '/i', $name)) {
                return 'size';
            }
        }

        // Font-family patterns.
        $font_patterns = [
            '-font-family$',
            '-font$',
        ];

        foreach ($font_patterns as $pattern) {
            if (preg_match('/' . $pattern . '/i', $name)) {
                return 'font';
            }
        }

        // Font-weight patterns.
        if (preg_match('/-font-weight$/i', $name)) {
            return 'font-weight';
        }

        // Font-style patterns (normal, italic, oblique).
        if (preg_match('/-font-style$/i', $name)) {
            return 'keyword';
        }

        // Letter-spacing patterns.
        if (preg_match('/-letter-spacing$/i', $name)) {
            return 'size';
        }

        // Text-transform patterns (none, uppercase, lowercase, capitalize).
        if (preg_match('/-text-transform$/i', $name)) {
            return 'keyword';
        }

        // Font size.
        if (preg_match('/-font-size$/i', $name)) {
            return 'size';
        }

        // Line height.
        if (preg_match('/-line-height$/i', $name)) {
            return 'number';
        }

        // Z-index.
        if (preg_match('/-z-index$/i', $name)) {
            return 'number';
        }

        // Duration.
        if (preg_match('/-duration$/i', $name)) {
            return 'duration';
        }

        // Default to reference if we can't infer.
        return 'reference';
    }

    /**
     * Convert Less variable name to human-readable label.
     *
     * @param string $var_name  Variable name (e.g., 'button-primary-background').
     * @param string $component Component name to strip from label.
     * @return string Human-readable label (e.g., 'Primary Background').
     */
    private static function variable_to_label(string $var_name, string $component): string
    {
        // Remove component prefix if present.
        $label = $var_name;
        if (str_starts_with($label, $component . '-')) {
            $label = substr($label, strlen($component) + 1);
        }

        // Also handle 'global-' prefix for variables.less.
        if ($component === 'variables' && str_starts_with($label, 'global-')) {
            $label = substr($label, 7);
        }

        // Replace hyphens with spaces and capitalize.
        $label = str_replace(['-', '_'], ' ', $label);
        $label = ucwords($label);

        return $label;
    }

    /**
     * Attempt to resolve a variable reference to its actual value.
     *
     * @param string $value     Original value (may be a reference).
     * @param int    $depth     Current recursion depth (default 0).
     * @param int    $max_depth Maximum recursion depth to prevent infinite loops (default 10).
     * @return string Resolved value or original if not resolvable.
     */
    private static function resolve_value(string $value, int $depth = 0, int $max_depth = 10): string
    {
        // Prevent infinite recursion from circular references.
        if ($depth >= $max_depth) {
            return $value;
        }

        // If it's a reference, try to resolve it.
        if (preg_match('/^@([a-z0-9_-]+)$/i', $value, $match)) {
            $ref_name = $match[1];

            // Check saved user overrides first (across all components).
            $saved_value = self::get_saved_variable_value($ref_name);
            if (null !== $saved_value) {
                // If the saved value is itself a reference, resolve recursively.
                if (preg_match('/^@/', $saved_value)) {
                    return self::resolve_value($saved_value, $depth + 1, $max_depth);
                }
                return $saved_value;
            }

            // Fall back to default values from variables.less (global definitions).
            $globals = self::parse_component('variables');
            if (isset($globals[$ref_name])) {
                $resolved = $globals[$ref_name]['value'];
                // Recursively resolve if still a reference.
                if (preg_match('/^@/', $resolved)) {
                    return self::resolve_value($resolved, $depth + 1, $max_depth);
                }
                return $resolved;
            }
        }

        return $value;
    }

    /**
     * Look up a saved (user-customized) value for a variable across all components.
     *
     * @param string $variable_name Variable name (without @).
     * @return string|null The saved value, or null if not customized.
     */
    private static function get_saved_variable_value(string $variable_name): ?string
    {
        static $saved_cache = null;

        // Build a flat lookup of all saved variable overrides (cached).
        if (null === $saved_cache) {
            $saved_cache = [];
            $components  = self::get_consolidated_components();

            foreach ($components as $component) {
                $saved = get_option(\EPB\Core\Constants::OPTION_PREFIX . $component, []);
                if (is_array($saved)) {
                    foreach ($saved as $var_name => $var_value) {
                        // Only store if the value is non-empty and different from default.
                        if ('' !== $var_value) {
                            $saved_cache[$var_name] = $var_value;
                        }
                    }
                }
            }
        }

        return $saved_cache[$variable_name] ?? null;
    }

    /**
     * Get all available components from the consolidated Less directory.
     *
     * Returns component names from the plugin's consolidated UIkit Less files.
     *
     * @return array<string> List of component names.
     */
    public static function get_consolidated_components(): array
    {
        $components = [];
        $files      = glob(self::LESS_DIR . '*.less');

        // Handle both false (error) and empty array cases.
        if (!$files) {
            return [];
        }

        foreach ($files as $file) {
            $name = basename($file, '.less');

            // Skip internal files.
            if (str_starts_with($name, '_')) {
                continue;
            }

            $components[] = $name;
        }

        sort($components);

        return $components;
    }

    /**
     * Get variables of a specific type from a component.
     *
     * @param string $component Component name.
     * @param string $type      Variable type to filter by.
     * @return array<string, array> Filtered variables.
     */
    public static function get_variables_by_type(string $component, string $type): array
    {
        $all = self::parse_component($component);

        return array_filter($all, static fn($var) => $var['type'] === $type);
    }

    /**
     * Get all color variables from a component.
     *
     * @param string $component Component name.
     * @return array<string, array> Color variables.
     */
    public static function get_color_variables(string $component): array
    {
        return self::get_variables_by_type($component, 'color');
    }

    /**
     * Get all size variables from a component.
     *
     * @param string $component Component name.
     * @return array<string, array> Size variables.
     */
    public static function get_size_variables(string $component): array
    {
        return self::get_variables_by_type($component, 'size');
    }

    /**
     * Get variable count for a component.
     *
     * @param string $component Component name.
     * @return int Number of variables.
     */
    public static function get_variable_count(string $component): int
    {
        return count(self::parse_component($component));
    }

    /**
     * Clear the parser cache.
     *
     * @return void
     */
    public static function clear_cache(): void
    {
        self::$cache = [];
    }

    /**
     * Get all variables from all components.
     *
     * @return array<string, array> All variables keyed by name.
     */
    public static function get_all_variables(): array
    {
        $all        = [];
        $components = self::get_consolidated_components();

        foreach ($components as $component) {
            $vars = self::parse_component($component);
            foreach ($vars as $name => $data) {
                $all[$name] = $data;
            }
        }

        return $all;
    }
}
