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
}
