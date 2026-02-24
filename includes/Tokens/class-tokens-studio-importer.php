<?php

/**
 * Tokens Studio importer for Figma integration.
 *
 * Imports Tokens Studio JSON format and converts to UIkit component settings.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Tokens
 */

namespace EPB\Tokens;

use EPB\Ajax\Component_Saver;
use EPB\Core\Constants;
use WP_Error;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Tokens_Studio_Importer
 *
 * Imports Tokens Studio JSON format from Figma and converts to component settings.
 */
class Tokens_Studio_Importer
{
    /**
     * Token lookup table: token-name => set-name.
     *
     * @var array
     */
    private static array $token_lookup = [];

    /**
     * Import Tokens Studio JSON and save to component settings.
     *
     * @param array $tokens The parsed Tokens Studio JSON data.
     * @return array{success: bool, message: string, imported: int, skipped: int}
     */
    public static function import(array $tokens): array
    {
        $imported = 0;
        $skipped = 0;
        $components_data = [];
        $debug_logs = [];

        // Build token lookup table first (token-name => set-name).
        self::$token_lookup = self::build_token_lookup($tokens);
        $debug_logs[] = 'Built token lookup with ' . count(self::$token_lookup) . ' tokens';

        // Log import start.
        $debug_logs[] = 'Starting import with ' . count($tokens) . ' token groups';

        // Process each group in the Tokens Studio format.
        foreach ($tokens as $group => $group_tokens) {
            // Skip $themes and $metadata sections.
            if ($group === '$themes' || $group === '$metadata') {
                $debug_logs[] = 'Skipping metadata section: ' . $group;
                continue;
            }

            if (!is_array($group_tokens)) {
                $debug_logs[] = 'Skipping non-array group: ' . $group;
                continue;
            }

            $debug_logs[] = 'Processing group: ' . $group . ' with ' . count($group_tokens) . ' tokens';

            foreach ($group_tokens as $token_name => $token_data) {
                // Skip if not a valid token structure.
                if (!is_array($token_data) || !isset($token_data['value'])) {
                    $skipped++;
                    continue;
                }

                $value = $token_data['value'];

                // Check if this token was exported with a CSS keyword (inherit,
                // transparent, etc.). The exporter stores the original keyword
                // and the fallback value it sent to Figma in $extensions.epb.less.
                // If the value hasn't changed from the fallback, restore the
                // keyword. If the user changed it in Figma, use the new value.
                $epb_ext = $token_data['$extensions']['epb.less'] ?? null;
                if (is_array($epb_ext) && isset($epb_ext['original'])) {
                    $original_keyword = $epb_ext['original'];
                    $exported_fallback = $epb_ext['fallback'] ?? null;
                    $figma_value       = $epb_ext['figmaValue'] ?? null;

                    // Determine if the value is unchanged from what we exported.
                    // For CSS keywords: compare with the fallback value.
                    // For Figma-mapped fonts: compare with the figmaValue string.
                    $is_unchanged = false;
                    if ($figma_value !== null && (string) $value === (string) $figma_value) {
                        $is_unchanged = true;
                    } elseif ($exported_fallback !== null && (string) $value === (string) $exported_fallback) {
                        $is_unchanged = true;
                    }

                    if ($is_unchanged) {
                        // Value unchanged in Figma — restore the original CSS value.
                        $value = $original_keyword;
                        $debug_logs[] = 'Restored CSS value: ' . $token_name . ' = ' . $value;

                        $uikit_var = self::build_uikit_variable_name($group, $token_name);
                        $target_component = self::get_target_component($uikit_var);
                        if (!isset($components_data[$target_component])) {
                            $components_data[$target_component] = [];
                        }
                        $components_data[$target_component][$uikit_var] = $value;
                        $debug_logs[] = 'Imported: ' . $uikit_var . ' = ' . $value . ' -> ' . $target_component;
                        $imported++;
                        continue;
                    } else {
                        // Value was changed in Figma — reverse-map Figma font
                        // strings back to CSS values if this was a font mapping.
                        if ($figma_value !== null) {
                            $css_weight_map = [
                                'thin'        => '100',
                                'extra light' => '200',
                                'light'       => '300',
                                'regular'     => 'normal',
                                'medium'      => '500',
                                'semi bold'   => '600',
                                'bold'        => 'bold',
                                'extra bold'  => '800',
                                'black'       => '900',
                                'italic'      => 'italic',
                            ];
                            $val_lower = strtolower(trim($value));
                            if (isset($css_weight_map[$val_lower])) {
                                $value = $css_weight_map[$val_lower];
                                $debug_logs[] = 'Reverse-mapped Figma font value: ' . $token_name . ' "' . $val_lower . '" -> "' . $value . '"';
                            } else {
                                $debug_logs[] = 'Figma font value changed: ' . $token_name . ' was "' . $original_keyword . '", now "' . $value . '"';
                            }
                        } else {
                            $debug_logs[] = 'CSS keyword overridden in Figma: ' . $token_name . ' was "' . $original_keyword . '", now "' . $value . '"';
                        }
                        // Fall through to normal processing below.
                    }
                }

                // Check if this token has a color modifier (Tokens Studio format).
                // These need to be converted back to Less functions.
                $has_modifier = isset($token_data['$extensions']['studio.tokens']['modify']);

                if ($has_modifier) {
                    // Check if we have the original Less expression stored in description.
                    // This preserves nested functions like lighten(tint(...)) that can't be
                    // represented accurately with a single Tokens Studio modifier.
                    $description = $token_data['description'] ?? '';
                    if (preg_match('/^Less:\s*(.+)$/', $description, $desc_match)) {
                        // Use the original Less expression, just convert references.
                        $original_less = $desc_match[1];
                        $value = self::convert_references_to_less($original_less);
                        $debug_logs[] = 'Restored original Less: ' . $token_name . ' = ' . $value;
                    } else {
                        // No original - use the modifier approximation.
                        $value = self::convert_modifier_to_less($value, $token_data['$extensions']['studio.tokens']['modify']);
                        $debug_logs[] = 'Converted modifier: ' . $token_name . ' = ' . $value;
                    }
                } elseif (is_string($value) && preg_match('/^(darken|lighten|fade|fadein|fadeout|tint|shade|mix)\(/', $value)) {
                    // Value already contains Less function from external source - keep it
                    $value = self::convert_references_to_less($value);
                    $debug_logs[] = 'Keeping Less function: ' . $group . '.' . $token_name . ' = ' . $value;
                } elseif (is_string($value)) {
                    // Convert reference values from Tokens Studio format to Less variable format.
                    // {global.emphasis-color} -> @global-emphasis-color
                    // {button.primary-background} -> @button-primary-background
                    $value = self::convert_references_to_less($value);
                }

                // Normalise values that the exporter converted for Figma
                // compatibility back to their original Less representation.
                $token_type = $token_data['type'] ?? '';

                // borderWidth "0px" → "0": the exporter added the 'px' unit
                // for Figma dimension parsing, but Less defaults use bare "0".
                if ($token_type === 'borderWidth' && trim($value) === '0px') {
                    $value = '0';
                }

                // boxShadow empty shadow → "none": the exporter converted
                // CSS "none" to "0 0 0 0 rgba(0,0,0,0)" for Figma. If the
                // $extensions round-trip didn't catch it (e.g. extensions
                // stripped), normalise it back here.
                if ($token_type === 'boxShadow' && trim($value) === '0 0 0 0 rgba(0,0,0,0)') {
                    $value = 'none';
                }

                // Build the UIkit variable name.
                $uikit_var = self::build_uikit_variable_name($group, $token_name);

                // Determine which component this variable belongs to.
                $target_component = self::get_target_component($uikit_var);

                if (!isset($components_data[$target_component])) {
                    $components_data[$target_component] = [];
                }

                $components_data[$target_component][$uikit_var] = $value;
                $debug_logs[] = 'Imported: ' . $uikit_var . ' = ' . $value . ' -> ' . $target_component;
                $imported++;
            }
        }

        $debug_logs[] = 'Finished processing. Imported: ' . $imported . ', Skipped: ' . $skipped;

        // Save to component storage.
        $components_updated = 0;
        foreach ($components_data as $component => $values) {
            $debug_logs[] = 'Processing ' . count($values) . ' values for component: ' . $component;

            // Filter out values that match UIkit defaults - only keep actual modifications.
            $modified = Component_Saver::filter_modified_values($component, $values);

            if (empty($modified)) {
                $debug_logs[] = 'Skipped ' . $component . ' - all values match defaults';
                continue;
            }

            $debug_logs[] = 'Saving ' . count($modified) . ' modified values to component: ' . $component;
            $existing = get_option(Constants::OPTION_PREFIX . $component, []);
            $merged = array_merge($existing, $modified);
            update_option(Constants::OPTION_PREFIX . $component, $merged);
            $components_updated++;
        }

        $debug_logs[] = 'Updated ' . $components_updated . ' components';

        return [
            'success'    => true,
            'message'    => sprintf(
                /* translators: 1: number of tokens imported, 2: number of components */
                __('%1$d tokens imported to %2$d components.', 'enhanced-plugin-bundle'),
                $imported,
                $components_updated
            ),
            'imported'   => $imported,
            'skipped'    => $skipped,
            'debug_logs' => $debug_logs,
        ];
    }

    /**
     * Validate Tokens Studio format.
     *
     * @param array $tokens The token data to validate.
     * @return bool|WP_Error True if valid, WP_Error if invalid.
     */
    public static function validate(array $tokens): bool|WP_Error
    {
        if (empty($tokens)) {
            return new WP_Error(
                'empty_tokens',
                __('Token file is empty.', 'enhanced-plugin-bundle')
            );
        }

        // Check for Tokens Studio format (groups with value/type structure).
        $has_valid_structure = false;
        foreach ($tokens as $group => $group_tokens) {
            if (!is_array($group_tokens)) {
                continue;
            }

            foreach ($group_tokens as $token_name => $token_data) {
                if (is_array($token_data) && isset($token_data['value'])) {
                    $has_valid_structure = true;
                    break 2;
                }
            }
        }

        if (!$has_valid_structure) {
            return new WP_Error(
                'invalid_structure',
                __('File does not appear to be in Tokens Studio format. Expected structure: {"group": {"token-name": {"value": "...", "type": "..."}}}', 'enhanced-plugin-bundle')
            );
        }

        return true;
    }

    /**
     * Normalize component name from Tokens Studio group.
     *
     * @param string $group The group name from Tokens Studio.
     * @return string Normalized component name.
     */
    private static function normalize_component_name(string $group): string
    {
        // Convert to lowercase and replace spaces/underscores with hyphens.
        return strtolower(str_replace(['_', ' '], '-', $group));
    }

    /**
     * Build UIkit variable name from group and token name.
     *
     * @param string $group      The group name (e.g., "global", "button").
     * @param string $token_name The token name (e.g., "font-size", "primary-background").
     * @return string The UIkit variable name (e.g., "global-font-size", "button-primary-background").
     */
    private static function build_uikit_variable_name(string $group, string $token_name): string
    {
        $group = self::normalize_component_name($group);

        // If the token name already starts with the group, don't duplicate.
        if (strpos($token_name, $group . '-') === 0) {
            return $token_name;
        }

        return $group . '-' . $token_name;
    }

    /**
     * Determine which component a variable belongs to.
     *
     * @param string $variable_name The UIkit variable name.
     * @return string The component name.
     */
    private static function get_target_component(string $variable_name): string
    {
        // Extract the first part of the variable name as the component.
        $parts = explode('-', $variable_name);
        $component = $parts[0];

        // Map certain prefixes to their proper component.
        $component_map = [
            'global'      => 'variables',
            'base'        => 'base',
            'breakpoint'  => 'variables',
            'inverse'     => 'inverse',
        ];

        return $component_map[$component] ?? $component;
    }

    /**
     * Build a lookup table mapping token names to their set names.
     *
     * @param array $tokens The full token data.
     * @return array Token name => set name mapping.
     */
    private static function build_token_lookup(array $tokens): array
    {
        $lookup = [];

        foreach ($tokens as $set_name => $set_tokens) {
            // Skip metadata sections.
            if ($set_name === '$themes' || $set_name === '$metadata') {
                continue;
            }

            if (!is_array($set_tokens)) {
                continue;
            }

            foreach ($set_tokens as $token_name => $token_data) {
                if (is_array($token_data) && isset($token_data['value'])) {
                    $lookup[$token_name] = $set_name;
                }
            }
        }

        return $lookup;
    }

    /**
     * Convert Tokens Studio references to Less variable format.
     *
     * Converts {emphasis-color} to @global-emphasis-color (using lookup to find the set)
     * Also handles math expressions: {breakpoint-xlarge} - 1 -> (@global-breakpoint-xlarge - 1)
     *
     * @param string $value The value with Tokens Studio references.
     * @return string The value with Less variable references.
     */
    private static function convert_references_to_less(string $value): string
    {
        // Check if this value contains any references.
        if (strpos($value, '{') === false) {
            return $value;
        }

        // Check if this is a math expression (contains operators outside of braces).
        // But NOT if it's already wrapped in a function like round(), floor(), ceil()
        // Important: Don't match hyphens that are part of variable names inside braces.
        // Math operators must be OUTSIDE of braces or between a } and a number/brace.
        $has_math = preg_match('/\}\s*[\+\-\*\/]\s*[\d\{]/', $value) ||  // } followed by operator and number/brace
            preg_match('/[\d\)]\s*[\+\-\*\/]\s*\{/', $value);           // number/) followed by operator and {

        // Check if the value starts with a Less function (math, color, etc.)
        $is_function_call = preg_match('/^(round|floor|ceil|abs|min|max|percentage|sqrt|pow|lighten|darken|fade|fadein|fadeout|tint|shade|mix|saturate|desaturate|spin)\s*\(/', $value);

        // Handle references with dot notation: {group.token-name} -> @group-token-name
        // (This handles legacy format or nested tokens)
        $converted = preg_replace_callback(
            '/\{([a-z0-9-]+)\.([a-z0-9-]+)\}/',
            function ($matches) {
                $group = $matches[1];
                $token = $matches[2];
                return '@' . $group . '-' . $token;
            },
            $value
        );

        // Handle simple references: {token-name} -> @token-name
        // Since tokens now keep their full names (e.g., global-emphasis-color),
        // we just replace { } with @.
        $converted = preg_replace_callback(
            '/\{([a-z0-9-]+)\}/',
            function ($matches) {
                $token_name = $matches[1];
                // Token names are already fully qualified (e.g., global-emphasis-color).
                // Just add the @ prefix for Less.
                return '@' . $token_name;
            },
            $converted
        );

        // If this is a math expression (not a function call), wrap in parentheses for Less.
        // Don't wrap if already a function call like round(...) or if already has outer parens.
        if ($has_math && strpos($converted, '@') !== false && !$is_function_call) {
            // Also don't wrap if already wrapped in parentheses
            if (!preg_match('/^\(.+\)$/', $converted)) {
                $converted = '(' . $converted . ')';
            }
        }

        return $converted;
    }

    /**
     * Convert Tokens Studio modifier format back to Less color function.
     *
     * Tokens Studio format:
     * {
     *   "value": "{base-color}",
     *   "$extensions": {
     *     "studio.tokens": {
     *       "modify": { "type": "lighten", "value": 0.2, "space": "hsl" }
     *     }
     *   }
     * }
     *
     * Converts to Less: lighten(@base-color, 20%)
     *
     * @param string $value    The base value (reference).
     * @param array  $modifier The modifier data.
     * @return string Less function string.
     */
    private static function convert_modifier_to_less(string $value, array $modifier): string
    {
        // Convert the base reference to Less format first.
        $less_ref = self::convert_references_to_less($value);

        // Get modifier properties.
        $type = $modifier['type'] ?? 'lighten';
        $amount = $modifier['value'] ?? 0;

        // Convert decimal to percentage (0.2 -> 20%).
        $percentage = round($amount * 100);

        // Map Tokens Studio modifier types to Less functions.
        $function_map = [
            'lighten'  => 'lighten',
            'darken'   => 'darken',
            'alpha'    => 'fade',      // Tokens Studio alpha = Less fade (sets absolute alpha)
            'alphaIn'  => 'fadein',    // Increase alpha (more opaque)
            'alphaOut' => 'fadeout',   // Decrease alpha (more transparent)
            'mix'      => 'mix',
        ];

        $less_function = $function_map[$type] ?? $type;

        return sprintf('%s(%s, %d%%)', $less_function, $less_ref, $percentage);
    }

    /**
     * Get a preview of what would be imported without actually importing.
     *
     * @param array $tokens The Tokens Studio data.
     * @return array{components: array, total: int, skipped: int}
     */
    public static function preview(array $tokens): array
    {
        $components = [];
        $total = 0;
        $skipped = 0;

        foreach ($tokens as $group => $group_tokens) {
            if (!is_array($group_tokens)) {
                continue;
            }

            foreach ($group_tokens as $token_name => $token_data) {
                if (!is_array($token_data) || !isset($token_data['value'])) {
                    $skipped++;
                    continue;
                }

                $value = $token_data['value'];

                // Skip Less functions that can't be converted.
                if (is_string($value) && preg_match('/^(darken|lighten|fade|tint|shade|mix)\(/', $value)) {
                    $skipped++;
                    continue;
                }

                $uikit_var = self::build_uikit_variable_name($group, $token_name);
                $target_component = self::get_target_component($uikit_var);

                if (!isset($components[$target_component])) {
                    $components[$target_component] = 0;
                }

                $components[$target_component]++;
                $total++;
            }
        }

        return [
            'components' => $components,
            'total'      => $total,
            'skipped'    => $skipped,
        ];
    }
}
