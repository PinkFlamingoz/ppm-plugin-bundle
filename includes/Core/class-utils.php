<?php

/**
 * Utility Functions for Enhanced Plugin Bundle.
 *
 * Shared utility functions used across the plugin.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 * @since 4.2.0
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Utils
 *
 * Provides shared utility functions.
 */
class Utils
{
    /**
     * Normalize Less escape syntax to use consistent single quotes.
     *
     * Converts ~\\'...\\' or ~\"...\" to ~'...' for consistent comparison.
     * Also normalizes math expressions and spacing around operators.
     *
     * @param string $value The value to normalize.
     * @return string The normalized value.
     */
    public static function normalize_less_escape(string $value): string
    {
        // Replace escaped quotes in Less escape syntax: ~\\'...\\' or ~'...' -> ~'...'
        $normalized = preg_replace("/~\\\\?['\"](.+?)\\\\?['\"]/", "~'$1'", $value);

        // Normalize spaces around math operators for consistency.
        // Only normalize +, *, / (not minus, which is too ambiguous with variable names).
        $normalized = preg_replace('/\s*([\+\*\/])\s*/', ' $1 ', $normalized);

        // For minus sign: only normalize when there's already a space on at least one side,
        // indicating it's clearly meant as a math operator, not part of a variable name.
        // This avoids breaking @base-h1-font-size-m into @base-h1 - font-size-m.
        $normalized = preg_replace('/\s+-\s*/', ' - ', $normalized);  // space before minus
        $normalized = preg_replace('/\s*-\s+/', ' - ', $normalized);  // space after minus

        // Collapse multiple spaces.
        $normalized = preg_replace('/\s+/', ' ', trim($normalized));

        return $normalized;
    }

    /**
     * Convert a color value to a normalized 6-character hex string.
     *
     * Expands shorthand hex (#fff → #ffffff), converts rgb()/rgba(), falls back to #000000.
     *
     * @param string $value Color value.
     * @return string Hex color string.
     */
    public static function to_hex_color(string $value): string
    {
        // Already hex.
        if (preg_match('/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/', $value)) {
            // Expand 3-char hex to 6-char.
            if (strlen($value) === 4) {
                return '#' . $value[1] . $value[1] . $value[2] . $value[2] . $value[3] . $value[3];
            }
            return strtolower($value);
        }

        // RGB/RGBA - try to extract.
        if (preg_match('/rgba?\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)/', $value, $matches)) {
            return sprintf('#%02x%02x%02x', (int) $matches[1], (int) $matches[2], (int) $matches[3]);
        }

        // Fallback.
        return '#000000';
    }

    /**
     * Determine if a variable value is modified compared to its original/default.
     *
     * Centralised comparison used by the sidebar indicators, group heading badges
     * and the save filter so they all behave identically.
     *
     * @param string $saved_value    The value to test (user-saved or current).
     * @param array  $meta           Variable metadata from Less_Parser (value, resolved, type).
     * @return bool True when the value should be considered "modified".
     */
    public static function is_value_modified(string $saved_value, array $meta): bool
    {
        $original = $meta['value'];
        $resolved = $meta['resolved'] ?? $original;

        // Normalize Less escape syntax for both values.
        $normalized_saved    = self::normalize_less_escape($saved_value);
        $normalized_original = self::normalize_less_escape($original);

        // Identical after normalisation ⇒ not modified.
        if ($normalized_saved === $normalized_original) {
            return false;
        }

        // For fields whose original is a Less reference (@something), also check
        // whether the saved value matches the resolved value (e.g. user chose the
        // same weight from a select that the reference resolved to).
        $original_is_reference = (strpos($original, '@') === 0);
        if ($original_is_reference && $normalized_saved === $resolved) {
            return false;
        }

        // For color fields, compare normalised hex values so #fff === #ffffff.
        if (($meta['type'] ?? '') === 'color') {
            // CSS color keywords (transparent, currentColor, etc.) cannot be
            // meaningfully converted to a 6-digit hex, so compare them as strings
            // instead of going through to_hex_color() which would map e.g.
            // "transparent" to #000000 and falsely match a resolved #000000.
            $color_keywords = ['transparent', 'currentcolor', 'inherit', 'initial', 'unset'];
            $saved_lower    = strtolower(trim($saved_value));
            $original_lower = strtolower(trim($original));

            if (in_array($saved_lower, $color_keywords, true) || in_array($original_lower, $color_keywords, true)) {
                return $saved_lower !== $original_lower;
            }

            $resolved_hex = self::to_hex_color($resolved);
            $saved_hex    = self::to_hex_color($saved_value);
            return $saved_hex !== $resolved_hex;
        }

        // All other types: already know strings differ → modified.
        return true;
    }
}
