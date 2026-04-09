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

use EPB\Core\Constants;
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
     * Resolved variable values cache (lazy-loaded in build_tokens).
     *
     * @var array<string, string>|null
     */
    private static ?array $resolved_variables = null;

    /**
     * Export UIkit Less variables to Tokens Studio format.
     *
     * @return array The tokens in Tokens Studio format.
     */
    public static function export(): array
    {
        self::$less_dir = EPB_PLUGIN_DIR . 'docs/uikit-less-consolidated';
        self::$all_variables = [];
        self::$resolved_variables = null;

        // Parse all Less files (defaults).
        self::parse_less_files();

        // Overlay saved user settings on top of defaults.
        self::apply_saved_overrides();

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

                // Skip internal/hook/deprecated/escape variables.
                // escape-* are internal SVG data-URI helpers, not design tokens.
                if (
                    $var_name === 'deprecated' ||
                    strpos($var_name, 'internal') !== false ||
                    strpos($var_name, 'hook-') === 0 ||
                    strpos($var_name, 'escape-') === 0
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
     * Apply saved user overrides on top of Less defaults.
     *
     * Reads component settings from the database and overrides the default
     * values so that exports reflect the user's customised theme, not just
     * UIkit defaults.
     *
     * @return void
     */
    private static function apply_saved_overrides(): void
    {
        $components = Less_Parser::get_consolidated_components();

        foreach ($components as $component) {
            $saved = get_option(Constants::OPTION_PREFIX . $component, []);

            if (!is_array($saved)) {
                continue;
            }

            foreach ($saved as $var_name => $var_value) {
                // Only override when the user actually saved a value.
                if ('' === $var_value) {
                    continue;
                }

                // If the variable exists in our parsed defaults, override its value.
                if (isset(self::$all_variables[$var_name])) {
                    // Preserve the Less default so we can fall back to it when the
                    // override is a CSS keyword (inherit, transparent, etc.) that
                    // Figma/Tokens Studio cannot resolve.
                    if (!isset(self::$all_variables[$var_name]['original'])) {
                        self::$all_variables[$var_name]['original'] = self::$all_variables[$var_name]['value'];
                    }
                    self::$all_variables[$var_name]['value'] = $var_value;
                }
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

            // Handle CSS keywords (transparent, inherit, initial, unset, currentColor).
            // These need special handling because Figma/Tokens Studio can't resolve
            // CSS cascade keywords. We export a usable fallback value for Figma and
            // store the original keyword in $extensions for round-trip fidelity.
            $css_keywords = ['transparent', 'currentcolor', 'inherit', 'initial', 'unset'];
            if (in_array(strtolower(trim($value)), $css_keywords, true)) {
                $keyword       = trim($value);
                $keyword_lower = strtolower($keyword);

                // Determine the token's natural type from its variable name.
                $intended_type = self::detect_token_type($name, $data['original'] ?? '');

                if ($keyword_lower === 'transparent') {
                    // transparent has a concrete color equivalent: fully transparent black.
                    $token_sets[$group][$token_name] = [
                        'value'       => 'rgba(0,0,0,0)',
                        'type'        => 'color',
                        'description' => 'CSS: transparent',
                        '$extensions' => [
                            'epb.less' => [
                                'original' => $keyword,
                                'fallback' => 'rgba(0,0,0,0)',
                            ],
                        ],
                    ];
                } elseif (
                    isset($data['original']) &&
                    !in_array(strtolower(trim($data['original'])), $css_keywords, true)
                ) {
                    // User override – fall back to the original Less default so
                    // Figma has a concrete value to display.
                    $fallback_value = self::parse_value($data['original']);
                    $desc           = "CSS: {$keyword} (default shown for Figma)";
                    if (preg_match('/^@/', $data['original'])) {
                        $desc .= " | Less: {$data['original']}";
                    }
                    $token_sets[$group][$token_name] = [
                        'value'       => $fallback_value,
                        'type'        => $intended_type,
                        'description' => $desc,
                        '$extensions' => [
                            'epb.less' => [
                                'original' => $keyword,
                                'fallback' => $fallback_value,
                            ],
                        ],
                    ];
                } else {
                    // No fallback available (the Less default itself is a keyword).
                    // For 'inherit', resolve to the effective CSS inherited/initial
                    // value so Figma has a concrete value to work with.
                    $resolved = self::resolve_inherit_value($name, $keyword_lower, $intended_type);
                    if ($resolved !== null) {
                        $ext = array_merge(
                            ['original' => $keyword],
                            $resolved['ext']
                        );
                        $token_sets[$group][$token_name] = [
                            'value'       => $resolved['value'],
                            'type'        => $resolved['type'],
                            'description' => 'CSS: ' . $keyword . ' → ' . $resolved['source'],
                            '$extensions' => [
                                'epb.less' => $ext,
                            ],
                        ];
                    } else {
                        // Genuinely unresolvable CSS keyword — skip.
                        // These have no meaningful representation in Figma.
                    }
                }
                continue;
            }

            // Resolve CSS clamp()/min()/max() functions to static values.
            // Figma has no concept of viewport-relative values, so we resolve
            // to a concrete value and store the original for round-trip fidelity.
            $clamp_resolved = self::resolve_css_math_function($value);
            if ($clamp_resolved !== null) {
                $type = self::detect_token_type($name, $clamp_resolved['static']);

                if ($type === 'other') {
                    // Fallback: infer dimension from the resolved px value.
                    $type = 'dimension';
                }

                $token_sets[$group][$token_name] = [
                    'value'       => $clamp_resolved['static'],
                    'type'        => $type,
                    'description' => 'CSS: ' . trim($value),
                    '$extensions' => [
                        'epb.less' => [
                            'original' => trim($value),
                            'fallback' => $clamp_resolved['static'],
                        ],
                    ],
                ];
                continue;
            }

            // Get token type.
            $type = self::detect_token_type($name, $value);

            // Skip type:other — these are CSS values (z-index, animation names,
            // border-style keywords, etc.) that have no Figma token equivalent.
            if ($type === 'other') {
                continue;
            }

            // Convert boxShadow "none" to an invisible shadow shorthand.
            // Tokens Studio/Figma expect a parseable shadow value, not the CSS
            // keyword "none". An all-zero transparent shadow is the equivalent.
            if ($type === 'boxShadow' && strtolower(trim($value)) === 'none') {
                $token_sets[$group][$token_name] = [
                    'value'       => '0 0 0 0 rgba(0,0,0,0)',
                    'type'        => 'boxShadow',
                    'description' => 'CSS: none (no shadow)',
                    '$extensions' => [
                        'epb.less' => [
                            'original' => 'none',
                            'fallback' => '0 0 0 0 rgba(0,0,0,0)',
                        ],
                    ],
                ];
                continue;
            }

            // Normalise borderWidth "0" → "0px" for Figma dimension parsing.
            if ($type === 'borderWidth' && trim($value) === '0') {
                $value = '0px';
                $data['value'] = '0px';
            }

            // Convert unitless scalar line-heights to pixel values.
            // Designers work in pixels; UIkit uses unitless multipliers (e.g. 1.5).
            // We export as px and store the original scalar for round-trip import.
            if ($type === 'lineHeights') {
                $trimmed = trim($value);
                // Unitless scalar: digits/dots only, no units, no @references.
                // Convert to px so designers always work in pixels.
                // On import the px value is used directly (no scalar restoration).
                if (preg_match('/^\d+(\.\d+)?$/', $trimmed) && strpos($trimmed, '@') === false) {
                    $px_value = self::convert_line_height_to_px($name, $trimmed);
                    if ($px_value !== null) {
                        $token_sets[$group][$token_name] = [
                            'value'       => $px_value,
                            'type'        => 'lineHeights',
                            'description' => 'Converted from scalar: ' . $trimmed,
                        ];
                        continue;
                    }
                }
            }

            // Map CSS font-weight keywords to Figma-compatible string values.
            // Figma expects exact strings like "Regular", "Bold" — not CSS keywords.
            // Tokens Studio auto-converts numeric values (400→Regular) but NOT
            // CSS keywords (normal, bold, bolder). We convert them here.
            // Font-style values (italic, oblique) also need Figma-compatible strings.
            if ($type === 'fontWeights') {
                $figma_weight_map = [
                    'normal'  => 'Regular',
                    'bold'    => 'Bold',
                    'bolder'  => 'Bold',
                    'lighter' => 'Light',
                    '100'     => 'Thin',
                    '200'     => 'Extra Light',
                    '300'     => 'Light',
                    '400'     => 'Regular',
                    '500'     => 'Medium',
                    '600'     => 'Semi Bold',
                    '700'     => 'Bold',
                    '800'     => 'Extra Bold',
                    '900'     => 'Black',
                    // Font-style values that Figma combines with weight.
                    'italic'  => 'Italic',
                    'oblique' => 'Italic',
                ];
                $val_lower = strtolower(trim($value));
                if (isset($figma_weight_map[$val_lower]) && strpos($value, '@') === false) {
                    $figma_value = $figma_weight_map[$val_lower];
                    $token_sets[$group][$token_name] = [
                        'value'       => $figma_value,
                        'type'        => 'fontWeights',
                        'description' => 'CSS: ' . trim($value),
                        '$extensions' => [
                            'epb.less' => [
                                'original'    => trim($value),
                                'figmaValue'  => $figma_value,
                            ],
                        ],
                    ];
                    continue;
                }
            }

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

        // Get all available components from consolidated Less files.
        $components = Less_Parser::get_consolidated_components();

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
     * Resolve CSS clamp(), min(), max() functions to a static value.
     *
     * Figma/Tokens Studio cannot handle viewport-relative values (vw, vh, etc.)
     * or CSS math functions. This resolves them to a concrete px value:
     * - clamp(MIN, preferred, MAX): average of MIN and MAX (preferred usually contains vw).
     * - min(a, b): the smaller value.
     * - max(a, b): the larger value.
     *
     * @param string $value The CSS value.
     * @return array|null Array with 'static' key, or null if not a CSS math function.
     */
    private static function resolve_css_math_function(string $value): ?array
    {
        $trimmed = trim($value);

        // Match clamp(MIN, PREFERRED, MAX).
        if (preg_match('/^clamp\(\s*(.+?)\s*,\s*(.+?)\s*,\s*(.+?)\s*\)$/i', $trimmed, $m)) {
            $min_val = self::extract_px_value($m[1]);
            $max_val = self::extract_px_value($m[3]);

            if ($min_val !== null && $max_val !== null) {
                // Use the midpoint between min and max as the static value.
                $mid = round(($min_val + $max_val) / 2, 2);
                // Clean up trailing zeros.
                $static = rtrim(rtrim((string) $mid, '0'), '.') . 'px';
                return ['static' => $static];
            }

            // If min/max contain references, try the preferred value.
            $pref_val = self::extract_px_value($m[2]);
            if ($pref_val !== null) {
                $static = rtrim(rtrim((string) $pref_val, '0'), '.') . 'px';
                return ['static' => $static];
            }

            return null;
        }

        // Match min(a, b) or max(a, b).
        if (preg_match('/^(min|max)\(\s*(.+?)\s*,\s*(.+?)\s*\)$/i', $trimmed, $m)) {
            $fn = strtolower($m[1]);
            $a  = self::extract_px_value($m[2]);
            $b  = self::extract_px_value($m[3]);

            if ($a !== null && $b !== null) {
                $result = ($fn === 'min') ? min($a, $b) : max($a, $b);
                $static = rtrim(rtrim((string) round($result, 2), '0'), '.') . 'px';
                return ['static' => $static];
            }

            return null;
        }

        return null;
    }

    /**
     * Extract a numeric px value from a CSS length string.
     *
     * Handles plain numbers, px, rem (assumes 16px base), and em.
     * Returns null for viewport units (vw, vh, etc.) or complex expressions.
     *
     * @param string $value A CSS length value like "30px", "2rem", etc.
     * @return float|null The value in pixels, or null if not resolvable.
     */
    private static function extract_px_value(string $value): ?float
    {
        $value = trim($value);

        if (preg_match('/^(-?\d+(?:\.\d+)?)\s*px$/', $value, $m)) {
            return (float) $m[1];
        }

        if (preg_match('/^(-?\d+(?:\.\d+)?)\s*rem$/', $value, $m)) {
            return (float) $m[1] * 16.0;
        }

        if (preg_match('/^(-?\d+(?:\.\d+)?)\s*em$/', $value, $m)) {
            return (float) $m[1] * 16.0;
        }

        // Plain number (no unit) — treat as px.
        if (preg_match('/^(-?\d+(?:\.\d+)?)$/', $value, $m)) {
            return (float) $m[1];
        }

        return null;
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

        // Opacity values (0-1 range).
        if (strpos($name, 'opacity') !== false) {
            return 'opacity';
        }

        // NOTE: CSS keywords (transparent, inherit, etc.) are NOT short-circuited
        // here. They are handled in build_tokens() with special $extensions
        // metadata for Figma round-trip. Name-based detection below determines
        // the token's intended type (color, fontFamilies, fontWeights, etc.).

        // === GENERAL TYPE DETECTION ===

        // Color detection.
        // Many variable names contain generic words like "border", "background",
        // "outline" or "color" that also appear in non-colour properties.
        // We exclude specific sub-property patterns that are NOT colour values.
        if (
            preg_match('/^#[0-9a-fA-F]{3,8}$/', $value) ||
            preg_match('/^rgba?\(/', $value) ||
            (strpos($name, 'color') !== false
                && strpos($name, 'color-mode') === false  // handled above, safety net
            ) ||
            (strpos($name, 'background') !== false
                && strpos($name, 'background-position') === false
                && strpos($name, 'background-size') === false
                && strpos($name, 'padding') === false  // e.g. text-background-padding-right
            ) ||
            (strpos($name, 'border') !== false
                && strpos($name, 'width') === false
                && strpos($name, 'radius') === false
                && strpos($name, 'border-style') === false
                && strpos($name, 'border-mode') === false
                && strpos($name, 'border-height') === false
                && strpos($name, 'transition') === false  // e.g. theme-transition-border-*
            ) ||
            (strpos($name, 'outline') !== false
                && strpos($name, 'outline-style') === false
                && strpos($name, 'outline-width') === false
                && strpos($name, 'outline-offset') === false
            )
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

        // Font style (italic, normal, etc.).
        // Figma combines font-style with font-weight, but we export it
        // separately so round-trip preserves the Less variable structure.
        if (strpos($name, 'font-style') !== false) {
            return 'fontWeights';
        }

        // Text decoration (none, underline, inherit, etc.).
        if (strpos($name, 'text-decoration') !== false) {
            return 'textDecoration';
        }

        // Text transform (uppercase, lowercase, capitalize, none, inherit).
        if (strpos($name, 'text-transform') !== false) {
            return 'textCase';
        }

        // Letter spacing.
        if (strpos($name, 'letter-spacing') !== false) {
            return 'letterSpacing';
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
        // Only classify as boxShadow when the value looks like a CSS box-shadow
        // shorthand (x y blur spread color), "none", or a variable reference.
        // Sub-properties (blur amount, duration, etc.) fall through to later checks.
        if (strpos($name, 'box-shadow') !== false || strpos($name, 'shadow') !== false) {
            $val_trimmed = trim($value);
            if (
                strtolower($val_trimmed) === 'none' ||
                // Shorthand: at least two space-separated numeric values (x y).
                preg_match('/^(inset\s+)?-?\d+\S*\s+-?\d/', $val_trimmed) ||
                // Variable reference (could be referencing another shadow).
                preg_match('/^@/', $val_trimmed)
            ) {
                return 'boxShadow';
            }
            // Sub-property — fall through to dimension/other/etc.
        }

        // Breakpoints.
        if (strpos($name, 'breakpoint') !== false) {
            return 'sizing';
        }

        // Z-index.
        if (strpos($name, 'z-index') !== false) {
            return 'other';
        }

        // Position offsets (top, right, bottom, left, position).
        // These are dimensional/spacing values for element positioning.
        if (
            preg_match('/-(top|right|bottom|left)$/', $name) ||
            (strpos($name, 'position') !== false && strpos($name, 'position-mode') === false)
        ) {
            return 'spacing';
        }

        // Default to dimension for px/rem values (including negative).
        if (preg_match('/^-?\d+(\.\d+)?(px|rem|em|%)$/', $value)) {
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

    /**
     * Resolve CSS 'inherit' (and 'initial'/'unset') to a concrete value
     * that Figma can actually use.
     *
     * CSS 'inherit' means "use the parent element's computed value".
     * In UIkit's theme structure this maps to well-known defaults:
     *  - color        → @global-color (parent text colour)
     *  - background   → transparent (CSS initial for backgrounds)
     *  - font-family  → @global-font-family (the body font stack)
     *  - font-weight  → CSS initial 'normal' → Figma "Regular"
     *  - font-style   → CSS initial 'normal' → Figma "Regular"
     *  - font-size    → @global-font-size (parent font size)
     *  - line-height  → @global-line-height (parent line height)
     *  - letter-spacing → CSS initial 'normal' → 0
     *  - text-transform → CSS initial 'none'
     *  - text-decoration → CSS initial 'none'
     *
     * Returns null when the keyword cannot be meaningfully resolved.
     *
     * @param string $name          Less variable name (without @).
     * @param string $keyword_lower Lowercase CSS keyword (inherit, initial, unset).
     * @param string $intended_type Token type detected from the variable name.
     * @return array|null Array with 'value', 'type', 'source', 'ext' keys, or null.
     */
    private static function resolve_inherit_value(
        string $name,
        string $keyword_lower,
        string $intended_type
    ): ?array {
        // Only resolve cascade keywords that mean "use another value".
        if (!in_array($keyword_lower, ['inherit', 'initial', 'unset', 'currentcolor'], true)) {
            return null;
        }

        // --- currentColor: always references the element's computed text colour.
        // In UIkit's context this is @global-color.
        if ($keyword_lower === 'currentcolor') {
            return [
                'value'  => '{global-color}',
                'type'   => 'color',
                'source' => '@global-color (currentColor)',
                'ext'    => ['fallback' => '{global-color}'],
            ];
        }

        // --- Color: distinguish background (→ transparent) from foreground (→ text colour).
        if ($intended_type === 'color') {
            if (strpos($name, 'background') !== false) {
                return [
                    'value'  => 'rgba(0,0,0,0)',
                    'type'   => 'color',
                    'source' => 'CSS default: transparent',
                    'ext'    => ['fallback' => 'rgba(0,0,0,0)'],
                ];
            }
            // Foreground colour — reference @global-color.
            return [
                'value'  => '{global-color}',
                'type'   => 'color',
                'source' => '@global-color',
                'ext'    => ['fallback' => '{global-color}'],
            ];
        }

        // --- Font family: inherit → reference @global-font-family.
        // This creates a proper Tokens Studio reference so changes propagate.
        if ($intended_type === 'fontFamilies') {
            if (isset(self::$all_variables['global-font-family'])) {
                return [
                    'value'  => '{global-font-family}',
                    'type'   => 'fontFamilies',
                    'source' => '@global-font-family',
                    'ext'    => ['fallback' => '{global-font-family}'],
                ];
            }
        }

        // --- Font weight / font style: inherit → CSS initial is 'normal'.
        // Figma represents 'normal' weight/style as "Regular".
        if ($intended_type === 'fontWeights') {
            return [
                'value'  => 'Regular',
                'type'   => 'fontWeights',
                'source' => 'CSS default: normal',
                'ext'    => ['figmaValue' => 'Regular'],
            ];
        }

        // --- Font size: inherit → reference @global-font-size.
        if ($intended_type === 'fontSizes') {
            return [
                'value'  => '{global-font-size}',
                'type'   => 'fontSizes',
                'source' => '@global-font-size',
                'ext'    => ['fallback' => '{global-font-size}'],
            ];
        }

        // --- Line height: inherit → reference @global-line-height.
        if ($intended_type === 'lineHeights') {
            return [
                'value'  => '{global-line-height}',
                'type'   => 'lineHeights',
                'source' => '@global-line-height',
                'ext'    => ['fallback' => '{global-line-height}'],
            ];
        }

        // --- Letter spacing: inherit → CSS initial is 'normal' (no extra spacing).
        if (strpos($name, 'letter-spacing') !== false) {
            return [
                'value'  => '0',
                'type'   => 'letterSpacing',
                'source' => 'CSS default: normal (0)',
                'ext'    => ['fallback' => '0'],
            ];
        }

        // --- Text transform: inherit → CSS initial is 'none'.
        if (strpos($name, 'text-transform') !== false) {
            return [
                'value'  => 'none',
                'type'   => 'textCase',
                'source' => 'CSS default: none',
                'ext'    => ['fallback' => 'none'],
            ];
        }

        // --- Text decoration: inherit → CSS initial is 'none'.
        if (strpos($name, 'text-decoration') !== false) {
            return [
                'value'  => 'none',
                'type'   => 'textDecoration',
                'source' => 'CSS default: none',
                'ext'    => ['fallback' => 'none'],
            ];
        }

        return null;
    }

    /**
     * Resolve all Less variables to their final values.
     *
     * Iteratively substitutes @references and evaluates math expressions.
     *
     * @return array<string, string> Variable name => resolved value.
     */
    private static function resolve_all_variables(): array
    {
        if (self::$resolved_variables !== null) {
            return self::$resolved_variables;
        }

        // Flatten to name => value.
        $vars = [];
        foreach (self::$all_variables as $name => $data) {
            $vars[$name] = $data['value'];
        }

        // Iteratively resolve @references (max 10 passes).
        for ($i = 0; $i < 10; $i++) {
            $changed = false;
            foreach ($vars as $name => &$val) {
                if (strpos($val, '@') === false) {
                    continue;
                }
                $new_val = preg_replace_callback(
                    '/@([a-zA-Z][a-zA-Z0-9_-]*)/',
                    function ($m) use ($vars) {
                        return $vars[$m[1]] ?? $m[0];
                    },
                    $val
                );
                if ($new_val !== $val) {
                    $val = $new_val;
                    $changed = true;
                }
            }
            unset($val);
            if (!$changed) {
                break;
            }
        }

        // Evaluate math expressions where possible.
        foreach ($vars as $name => &$val) {
            if (strpos($val, '@') !== false) {
                continue;
            }
            if (!preg_match('/[*\/+\-]/', $val)) {
                continue;
            }
            $unit = '';
            if (preg_match('/(rem|em|px|%)/', $val, $um)) {
                $unit = $um[1];
            }
            $calc = preg_replace('/(\d+\.?\d*)(rem|em|px|%)/', '$1', $val);
            $calc = preg_replace('/[^0-9.+\-*\/() ]/', '', $calc);
            if (empty(trim($calc))) {
                continue;
            }
            $result = self::safe_eval_simple($calc);
            if ($result !== null) {
                $result = round($result, 4);
                $val = rtrim(rtrim((string) $result, '0'), '.') . $unit;
            }
        }
        unset($val);

        self::$resolved_variables = $vars;
        return $vars;
    }

    /**
     * Safely evaluate a simple math expression.
     *
     * Supports: numbers, +, -, *, /, parentheses.
     *
     * @param string $expr The sanitized expression.
     * @return float|null The result or null on failure.
     */
    private static function safe_eval_simple(string $expr): ?float
    {
        $expr = str_replace(' ', '', $expr);
        if (empty($expr)) {
            return null;
        }

        // Handle parentheses recursively.
        while (preg_match('/\(([^()]+)\)/', $expr, $m)) {
            $inner = self::safe_eval_simple($m[1]);
            if ($inner === null) {
                return null;
            }
            $expr = str_replace($m[0], (string) $inner, $expr);
        }

        // Split by + and - (keeping delimiters).
        $tokens = preg_split('/([+\-])/', $expr, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        if (!$tokens) {
            return null;
        }

        $processed = [];
        foreach ($tokens as $t) {
            if ($t === '+' || $t === '-') {
                $processed[] = $t;
            } else {
                $parts = preg_split('/([*\/])/', $t, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                if (!$parts) {
                    return null;
                }
                $r = null;
                $op = '*';
                foreach ($parts as $p) {
                    if ($p === '*' || $p === '/') {
                        $op = $p;
                    } else {
                        $n = (float) $p;
                        if ($r === null) {
                            $r = $n;
                        } elseif ($op === '*') {
                            $r *= $n;
                        } elseif ($n != 0) {
                            $r /= $n;
                        } else {
                            return null;
                        }
                    }
                }
                $processed[] = $r ?? 0.0;
            }
        }

        $result = 0.0;
        $op = '+';
        foreach ($processed as $item) {
            if ($item === '+' || $item === '-') {
                $op = $item;
            } else {
                $result = $op === '+' ? $result + (float) $item : $result - (float) $item;
            }
        }

        return $result;
    }

    /**
     * Convert a unitless scalar line-height to pixels.
     *
     * Finds the paired font-size variable (e.g. base-h1-line-height → base-h1-font-size),
     * resolves it to a px value, and computes: scalar × font-size-in-px.
     *
     * @param string $var_name     The line-height variable name (e.g. 'base-h1-line-height').
     * @param string $scalar_value The unitless scalar (e.g. '1.5').
     * @return string|null The pixel value (e.g. '24px') or null if conversion fails.
     */
    private static function convert_line_height_to_px(string $var_name, string $scalar_value): ?string
    {
        $scalar = (float) $scalar_value;
        if ($scalar <= 0) {
            return null;
        }

        // Find the paired font-size variable: replace -line-height with -font-size.
        $font_size_var = preg_replace('/-line-height$/', '-font-size', $var_name);
        if ($font_size_var === $var_name) {
            return null;
        }

        $resolved = self::resolve_all_variables();

        // Try the direct pair first.
        $font_size_str = $resolved[$font_size_var] ?? null;

        // Fallback: if the paired variable doesn't exist or still has unresolved
        // references, use @global-font-size.
        if ($font_size_str === null || strpos($font_size_str, '@') !== false) {
            $font_size_str = $resolved['global-font-size'] ?? '16px';
        }

        $font_size_px = self::value_to_px($font_size_str, $resolved);
        if ($font_size_px === null) {
            return null;
        }

        $line_height_px = round($scalar * $font_size_px, 2);
        $formatted = rtrim(rtrim((string) $line_height_px, '0'), '.');

        return $formatted . 'px';
    }

    /**
     * Convert a CSS value string to a numeric pixel amount.
     *
     * @param string               $value    The CSS value (e.g. '16px', '2.625rem').
     * @param array<string,string> $resolved Resolved variables for root font-size lookup.
     * @return float|null The pixel value or null.
     */
    private static function value_to_px(string $value, array $resolved): ?float
    {
        $value = trim($value);

        if (preg_match('/^(-?[\d.]+)px$/', $value, $m)) {
            return (float) $m[1];
        }

        // rem/em — relative to root font-size.
        if (preg_match('/^(-?[\d.]+)(rem|em)$/', $value, $m)) {
            $root = 16.0;
            if (
                isset($resolved['global-font-size'])
                && preg_match('/^([\d.]+)px$/', $resolved['global-font-size'], $rm)
            ) {
                $root = (float) $rm[1];
            }
            return (float) $m[1] * $root;
        }

        // Bare number (unitless, assume px).
        if (preg_match('/^-?[\d.]+$/', $value)) {
            return (float) $value;
        }

        return null;
    }
}
