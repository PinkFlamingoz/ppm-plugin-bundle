<?php

/**
 * Tokens Studio exporter for Figma integration.
 *
 * Exports UIkit Less variables to Tokens Studio JSON format for use in Figma.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Tokens
 */

namespace EPB\Tokens;

use EPB\CSS\Less_Parser;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Tokens_Studio_Exporter
 *
 * Exports UIkit Less variables to Tokens Studio JSON format for Figma.
 */
class Tokens_Studio_Exporter
{
    /**
     * Path to Less files directory.
     *
     * @var string
     */
    private static string $less_dir = '';

    /**
     * All parsed variables.
     *
     * @var array
     */
    private static array $all_variables = [];

    /**
     * Export UIkit Less variables to Tokens Studio format.
     *
     * @return array The tokens in Tokens Studio format.
     */
    public static function export(): array
    {
        self::$less_dir = EPB_PLUGIN_DIR . 'docs/uikit-less-consolidated';
        self::$all_variables = [];

        // Parse all Less files.
        self::parse_less_files();

        // Build token structure.
        return self::build_tokens();
    }

    /**
     * Export as JSON string.
     *
     * @param int $flags JSON encode flags.
     * @return string JSON-encoded tokens.
     */
    public static function export_json(int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES): string
    {
        return json_encode(self::export(), $flags);
    }

    /**
     * Parse all Less files and extract variables.
     *
     * @return void
     */
    private static function parse_less_files(): void
    {
        $files = glob(self::$less_dir . '/*.less');

        if (!$files) {
            return;
        }

        foreach ($files as $file) {
            $content = file_get_contents($file);
            $filename = basename($file, '.less');

            // Extract variables: @variable-name: value;
            preg_match_all('/^@([a-z0-9-]+):\s*([^;]+);/m', $content, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $var_name = $match[1];
                $var_value = trim($match[2]);

                // Skip internal/hook/deprecated variables.
                if (
                    $var_name === 'deprecated' ||
                    strpos($var_name, 'internal') !== false ||
                    strpos($var_name, 'hook-') === 0
                ) {
                    continue;
                }

                // Skip empty Less values (~'' or ~"").
                if ($var_value === "~''" || $var_value === '~""' || $var_value === '') {
                    continue;
                }

                self::$all_variables[$var_name] = [
                    'value' => $var_value,
                    'file'  => $filename,
                ];
            }
        }
    }

    /**
     * Build Tokens Studio structure from parsed variables.
     *
     * @return array Token structure with $themes and $metadata.
     */
    private static function build_tokens(): array
    {
        $token_sets = self::get_initial_token_groups();

        foreach (self::$all_variables as $name => $data) {
            $value = $data['value'];

            // Determine component from variable name.
            $parts = explode('-', $name);
            $component = $parts[0];

            // Determine group and token name.
            // IMPORTANT: Keep the FULL variable name as the token name to ensure uniqueness.
            // This avoids conflicts like list.emphasis-color vs global.emphasis-color
            // both becoming just "emphasis-color".
            if ($component === 'global') {
                $group = 'global';
                $token_name = $name; // Keep full name: global-emphasis-color
            } elseif ($component === 'base') {
                $group = 'base';
                $token_name = $name; // Keep full name: base-body-color
            } elseif ($component === 'breakpoint') {
                $group = 'global';
                $token_name = $name;
            } else {
                $group = $component;
                $token_name = $name; // Keep full name: list-emphasis-color
            }

            // Ensure group exists.
            if (!isset($token_sets[$group])) {
                $token_sets[$group] = [];
            }

            // Get token type.
            $type = self::detect_token_type($name, $value);

            // Check if this is a color function that can be converted to Tokens Studio modify format.
            $color_modifier = self::parse_color_function($value);

            if ($color_modifier !== null) {
                // Create token with color modifier.
                $token_sets[$group][$token_name] = [
                    'value'       => $color_modifier['value'],
                    'type'        => 'color',
                    '$extensions' => [
                        'studio.tokens' => [
                            'modify' => $color_modifier['modify'],
                        ],
                    ],
                ];

                // For nested/complex functions, store original Less in description
                // so we can restore it exactly on import (the modifier is just an approximation for Figma).
                if (!empty($color_modifier['isNested'])) {
                    $token_sets[$group][$token_name]['description'] = 'Less: ' . $value;
                }
            } else {
                // Resolve value (convert Less references to Tokens Studio format).
                $resolved_value = self::parse_value($value);

                // Create token.
                $token_sets[$group][$token_name] = [
                    'value' => $resolved_value,
                    'type'  => $type,
                ];

                // Add description for referenced values.
                if (preg_match('/^@/', $value)) {
                    $token_sets[$group][$token_name]['description'] = "Less: $value";
                }
            }
        }

        // Remove empty groups.
        $token_sets = array_filter($token_sets, function ($group) {
            return !empty($group);
        });

        // Get token set names for $metadata and $themes.
        $set_names = array_keys($token_sets);

        // Build selectedTokenSets with all sets enabled.
        // This is crucial for Tokens Studio to resolve references between sets.
        $selected_token_sets = [];
        foreach ($set_names as $set_name) {
            $selected_token_sets[$set_name] = 'enabled';
        }

        // Build the final structure with $themes and $metadata.
        $result = [];

        // Add token sets first (they come before $themes and $metadata).
        foreach ($token_sets as $set_name => $tokens) {
            $result[$set_name] = $tokens;
        }

        // Add $themes - defines which token sets are enabled together.
        // A default theme with all sets enabled ensures references resolve.
        $result['$themes'] = [
            [
                'id'                => 'default',
                'name'              => 'Default',
                'selectedTokenSets' => $selected_token_sets,
            ],
        ];

        // Add $metadata - defines the order of token sets.
        // Global should be first so its tokens are available to other sets.
        $result['$metadata'] = [
            'tokenSetOrder' => $set_names,
        ];

        return $result;
    }

    /**
     * Get initial token group structure dynamically from available Less components.
     *
     * @return array Empty token groups.
     */
    private static function get_initial_token_groups(): array
    {
        $groups = [];

        // Always include 'global' first for core variables.
        $groups['global'] = [];

        // Get all available components from Less files.
        $components = Less_Parser::get_available_components();

        foreach ($components as $component) {
            // Skip 'variables' as it's mapped to 'global'.
            if ($component === 'variables') {
                continue;
            }
            $groups[$component] = [];
        }

        return $groups;
    }

    /**
     * Detect token type from variable name and value.
     *
     * @param string $name  Variable name.
     * @param string $value Variable value.
     * @return string Token type.
     */
    private static function detect_token_type(string $name, string $value): string
    {
        // === SPECIAL CASES - Check these FIRST before general type detection ===

        // Color-mode variables are NOT colors - they're string values like "dark" or "light".
        if (strpos($name, 'color-mode') !== false) {
            return 'other';
        }

        // CSS keyword values that aren't actually colors (transparent, inherit, etc.).
        // These need to stay as plain strings, not be parsed as colors.
        if (preg_match('/^(transparent|inherit|initial|unset|currentColor)$/i', $value)) {
            return 'other';
        }

        // === GENERAL TYPE DETECTION ===

        // Color detection.
        if (
            preg_match('/^#[0-9a-fA-F]{3,8}$/', $value) ||
            preg_match('/^rgba?\(/', $value) ||
            (strpos($name, 'color') !== false) ||
            (strpos($name, 'background') !== false) ||
            (strpos($name, 'border') !== false && strpos($name, 'width') === false && strpos($name, 'radius') === false)
        ) {
            return 'color';
        }

        // Font size.
        if (strpos($name, 'font-size') !== false) {
            return 'fontSizes';
        }

        // Font family.
        if (strpos($name, 'font-family') !== false) {
            return 'fontFamilies';
        }

        // Line height.
        if (strpos($name, 'line-height') !== false) {
            return 'lineHeights';
        }

        // Font weight.
        if (strpos($name, 'font-weight') !== false || strpos($name, 'weight') !== false) {
            return 'fontWeights';
        }

        // Border radius.
        if (strpos($name, 'border-radius') !== false || strpos($name, 'radius') !== false) {
            return 'borderRadius';
        }

        // Border width.
        if (strpos($name, 'border-width') !== false) {
            return 'borderWidth';
        }

        // Spacing (margin, padding, gutter).
        if (
            strpos($name, 'margin') !== false ||
            strpos($name, 'padding') !== false ||
            strpos($name, 'gutter') !== false ||
            strpos($name, 'gap') !== false
        ) {
            return 'spacing';
        }

        // Sizing (height, width).
        if (strpos($name, 'height') !== false || strpos($name, 'width') !== false) {
            return 'sizing';
        }

        // Box shadow.
        if (strpos($name, 'box-shadow') !== false || strpos($name, 'shadow') !== false) {
            return 'boxShadow';
        }

        // Breakpoints.
        if (strpos($name, 'breakpoint') !== false) {
            return 'sizing';
        }

        // Z-index.
        if (strpos($name, 'z-index') !== false) {
            return 'other';
        }

        // Default to dimension for px/rem values.
        if (preg_match('/^\d+(\.\d+)?(px|rem|em|%)$/', $value)) {
            return 'dimension';
        }

        return 'other';
    }

    /**
     * Parse Less variable value, resolving references to Tokens Studio format.
     *
     * @param string $value The Less value.
     * @return string Resolved value.
     */
    private static function parse_value(string $value): string
    {
        // Remove comments.
        $value = preg_replace('/\/\/.*$/', '', $value);
        $value = trim($value);

        // Replace ALL @variable references with {token-name} format.
        // In Tokens Studio, references search all enabled sets by token name.
        //
        // IMPORTANT: We keep the FULL variable name to ensure uniqueness.
        // Less: @global-emphasis-color -> Tokens: {global-emphasis-color}
        // Less: @button-primary-background -> Tokens: {button-primary-background}
        //
        // This avoids conflicts where multiple sets have tokens with the same
        // stripped name (e.g., list.emphasis-color vs global.emphasis-color).
        $value = preg_replace_callback(
            '/@([a-z0-9-]+)/',
            function ($matches) {
                $ref_name = $matches[1];
                // Keep the full variable name - just replace @ with {}.
                return '{' . $ref_name . '}';
            },
            $value
        );

        // Remove outer parentheses from simple math expressions.
        // Less requires: (@var - 1) but Tokens Studio wants: {var} - 1
        // Match pattern: (expression with operators) where expression contains { references
        if (preg_match('/^\((.+)\)$/', $value, $outer_match)) {
            $inner = $outer_match[1];
            // Check if this is a simple math expression (contains {reference} and operator).
            // Don't strip parentheses from complex nested expressions or function calls.
            if (
                preg_match('/\{[^}]+\}/', $inner) &&               // Contains a token reference
                preg_match('/[\+\-\*\/]/', $inner) &&              // Contains a math operator
                !preg_match('/^(darken|lighten|fade|mix|tint|shade|rgba?|hsla?)\(/', $inner) // Not a function call
            ) {
                // Ensure proper spacing around operators that are OUTSIDE of curly braces.
                // Split by curly braces, process only the parts outside.
                $inner = preg_replace_callback(
                    '/(\{[^}]+\})|([^{}]+)/',
                    function ($m) {
                        if (!empty($m[1])) {
                            // Inside braces - keep as-is
                            return $m[1];
                        } else {
                            // Outside braces - ensure spacing around operators
                            return preg_replace('/\s*([\+\-\*\/])\s*/', ' $1 ', $m[2]);
                        }
                    },
                    $inner
                );
                $value = trim($inner);
            }
        }

        return $value;
    }

    /**
     * Parse Less color functions and convert to Tokens Studio modify format.
     *
     * Handles simple functions: lighten(@color, 20%), darken(@color, 10%), etc.
     * Also handles nested functions: lighten(tint(@color, 40%), 20%)
     *
     * @param string $value The Less value.
     * @return array|null Array with 'value' and 'modify' keys, or null if not a color function.
     */
    private static function parse_color_function(string $value): ?array
    {
        // Map Less functions to Tokens Studio modify types and their "direction".
        // Direction: 1 = lighten/positive, -1 = darken/negative
        // For alpha functions: fadein increases, fadeout decreases
        $function_map = [
            'lighten' => ['type' => 'lighten', 'dir' => 1],
            'darken'  => ['type' => 'darken', 'dir' => -1],
            'tint'    => ['type' => 'lighten', 'dir' => 1],   // tint = mix with white
            'shade'   => ['type' => 'darken', 'dir' => -1],   // shade = mix with black
            'fade'    => ['type' => 'alpha', 'dir' => 0],     // sets absolute alpha
            'fadein'  => ['type' => 'alphaIn', 'dir' => 1],   // increases alpha (more opaque)
            'fadeout' => ['type' => 'alphaOut', 'dir' => -1], // decreases alpha (more transparent)
        ];

        // Try to match simple function: function(@variable, percentage)
        $simple_pattern = '/^(lighten|darken|fade|fadein|fadeout|tint|shade)\s*\(\s*@([a-z0-9-]+)\s*,\s*(\d+(?:\.\d+)?)\s*%?\s*\)$/i';

        if (preg_match($simple_pattern, $value, $matches)) {
            $function = strtolower($matches[1]);
            $var_name = $matches[2];
            $amount = floatval($matches[3]) / 100;

            $modify_type = $function_map[$function]['type'] ?? 'lighten';

            return [
                'value'  => '{' . $var_name . '}',
                'modify' => [
                    'type'  => $modify_type,
                    'value' => $amount,
                    'space' => 'hsl',
                ],
            ];
        }

        // Try to match nested function: outerFunc(innerFunc(@variable, pct1), pct2)
        $nested_pattern = '/^(lighten|darken|tint|shade)\s*\(\s*(lighten|darken|tint|shade)\s*\(\s*@([a-z0-9-]+)\s*,\s*(\d+(?:\.\d+)?)\s*%?\s*\)\s*,\s*(\d+(?:\.\d+)?)\s*%?\s*\)$/i';

        if (preg_match($nested_pattern, $value, $matches)) {
            $outer_func = strtolower($matches[1]);
            $inner_func = strtolower($matches[2]);
            $var_name = $matches[3];
            $inner_amount = floatval($matches[4]) / 100;
            $outer_amount = floatval($matches[5]) / 100;

            // Get directions for each function.
            $inner_dir = $function_map[$inner_func]['dir'] ?? 1;
            $outer_dir = $function_map[$outer_func]['dir'] ?? 1;

            // Combine the amounts based on direction.
            // Both lighten: add them
            // Both darken: add them (as darken)
            // Mixed: subtract
            if ($inner_dir === $outer_dir) {
                // Same direction - combine amounts (cap at 1.0)
                $combined_amount = min($inner_amount + $outer_amount, 1.0);
                $final_type = $inner_dir > 0 ? 'lighten' : 'darken';
            } else {
                // Opposite directions - find net effect
                $net = ($inner_amount * $inner_dir) + ($outer_amount * $outer_dir);
                $combined_amount = abs($net);
                $final_type = $net >= 0 ? 'lighten' : 'darken';
            }

            return [
                'value'    => '{' . $var_name . '}',
                'modify'   => [
                    'type'  => $final_type,
                    'value' => $combined_amount,
                    'space' => 'hsl',
                ],
                'isNested' => true, // Flag to indicate this was a nested function
            ];
        }

        return null;
    }
}
