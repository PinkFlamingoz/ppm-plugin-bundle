<?php

/**
 * CSS Generator for Enhanced Plugin Bundle.
 *
 * Generates CSS from component-based UIkit variable settings.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage CSS
 */

namespace EPB\CSS;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Component_Registry;

/**
 * Class Generator
 *
 * Generates CSS custom properties from saved UIkit component variables.
 * Uses Less.js for live preview compilation and outputs CSS variables
 * for the final child theme stylesheet.
 */
class Generator
{
    /**
     * Option prefix for component storage.
     *
     * @var string
     */
    private const COMPONENT_PREFIX = 'epb_component_';

    /**
     * Generates the complete CSS content for the child theme.
     *
     * Outputs CSS custom property definitions followed by fluid typography
     * rules that use those properties.
     *
     * @return string The CSS content with variables and fluid typography.
     */
    public static function generate(): string
    {
        $css = self::generate_component_variables();
        $css .= self::generate_fluid_typography();

        return $css;
    }

    /**
     * Variables used in fluid typography CSS.
     * These are the only variables that need to be output.
     *
     * @var array<string>
     */
    private const FLUID_TYPOGRAPHY_VARIABLES = [
        // Global
        'global-font-size',
        'global-line-height',
        'global-small-font-size',
        'global-medium-font-size',
        'global-large-font-size',
        'global-xlarge-font-size',
        'global-2xlarge-font-size',

        // Breakpoints
        'breakpoint-s',
        'breakpoint-l',
        'breakpoint-xl',

        // Base
        'base-body-font-size',
        'base-body-line-height',
        'base-h1-font-size',
        'base-h1-font-size-m',
        'base-h2-font-size',
        'base-h2-font-size-m',
        'base-h3-font-size',
        'base-h4-font-size',
        'base-h5-font-size',
        'base-h6-font-size',

        // Heading
        'heading-small-font-size',
        'heading-small-font-size-m',
        'heading-medium-font-size',
        'heading-medium-font-size-l',
        'heading-large-font-size',
        'heading-large-font-size-l',
        'heading-xlarge-font-size',
        'heading-xlarge-font-size-l',
        'heading-2xlarge-font-size',
        'heading-2xlarge-font-size-l',
        'heading-3xlarge-font-size',
        'heading-3xlarge-font-size-l',

        // Text
        'text-lead-font-size',
        'text-lead-line-height',
        'text-meta-font-size',
        'text-small-font-size',
        'text-large-font-size',

        // Button
        'button-font-size',
        'button-small-font-size',
        'button-large-font-size',

        // Navbar
        'navbar-nav-item-font-size',
        'navbar-subtitle-font-size',

        // Form
        'form-font-size',
        'form-small-font-size',
        'form-large-font-size',
        'form-legend-font-size',

        // Accordion
        'accordion-default-title-font-size',

        // Article
        'article-title-font-size',
        'article-title-font-size-m',
        'article-meta-font-size',

        // Badge
        'badge-font-size',

        // Breadcrumb
        'breadcrumb-item-font-size',
        'breadcrumb-divider-font-size',

        // Card
        'card-title-font-size',
        'card-badge-font-size',

        // Comment
        'comment-title-font-size',
        'comment-meta-font-size',

        // Countdown
        'countdown-separator-font-size',

        // Dropdown
        'dropdown-nav-subtitle-font-size',

        // Modal
        'modal-title-font-size',

        // Label
        'label-font-size',

        // Nav
        'nav-header-font-size',
        'nav-default-font-size',
        'nav-default-subtitle-font-size',
        'nav-default-sublist-font-size',
        'nav-primary-font-size',
        'nav-primary-subtitle-font-size',
        'nav-primary-sublist-font-size',
        'nav-secondary-font-size',
        'nav-secondary-subtitle-font-size',
        'nav-secondary-sublist-font-size',
        'nav-medium-font-size',
        'nav-medium-font-size-l',
        'nav-large-font-size',
        'nav-large-font-size-l',
        'nav-xlarge-font-size',
        'nav-xlarge-font-size-l',

        // Navbar dropdown
        'navbar-dropdown-nav-subtitle-font-size',

        // Notification
        'notification-message-font-size',

        // Search
        'search-medium-font-size',
        'search-large-font-size',

        // Table
        'table-header-cell-font-size',
        'table-footer-font-size',
        'table-caption-font-size',

        // Tooltip
        'tooltip-font-size',

        // Utility
        'dropcap-font-size',
        'logo-font-size',

        // Base typography
        'base-blockquote-font-size',
        'base-blockquote-footer-font-size',
        'base-pre-font-size',
        'base-code-font-size',
        'base-small-font-size',

        // Border radius
        'border-rounded-border-radius',
        'badge-border-radius',
        'tooltip-border-radius',
        'dotnav-item-border-radius',
        'icon-button-border-radius',
        'form-range-thumb-border-radius',
    ];

    /**
     * Generate CSS variables for all values used in fluid typography.
     *
     * Pulls values from the component picker's Less parser (UIkit defaults)
     * and merges with any saved component values.
     *
     * @return string CSS content with variable definitions.
     */
    public static function generate_component_variables(): string
    {
        if (!class_exists(Component_Registry::class) || !class_exists(Less_Parser::class)) {
            return '';
        }

        $variables = [];
        $components = Component_Registry::get_all();

        // First pass: get ALL variables from Less parser (needed for resolution).
        $all_variables = [];
        foreach (array_keys($components) as $component) {
            $grouped = Less_Parser::get_grouped_variables($component);

            foreach ($grouped as $group_vars) {
                foreach ($group_vars as $var_name => $meta) {
                    if (!isset($all_variables[$var_name])) {
                        $all_variables[$var_name] = $meta['resolved'] ?? $meta['value'];
                    }
                }
            }
        }

        // Second pass: override with saved component values.
        foreach (array_keys($components) as $component) {
            $saved = get_option(self::COMPONENT_PREFIX . $component, []);

            foreach ($saved as $var_name => $value) {
                $all_variables[$var_name] = $value;
            }
        }

        // Third pass: resolve Less variable references in all variables.
        $resolved_variables = self::resolve_all_less_variables($all_variables);

        // Fourth pass: filter to only needed variables.
        foreach (self::FLUID_TYPOGRAPHY_VARIABLES as $name) {
            if (isset($resolved_variables[$name])) {
                $variables[$name] = $resolved_variables[$name];
            }
        }

        if (empty($variables)) {
            return '';
        }

        // Build CSS output in the same order as FLUID_TYPOGRAPHY_VARIABLES.
        $css = "\n/* ==========================================================================\n";
        $css .= "   UIkit CSS Custom Properties\n";
        $css .= "   ========================================================================== */\n\n";
        $css .= ":root {\n";

        foreach (self::FLUID_TYPOGRAPHY_VARIABLES as $name) {
            if (isset($variables[$name])) {
                $css .= "    --uk-{$name}: {$variables[$name]};\n";
            }
        }

        $css .= "}\n";

        return $css;
    }

    /**
     * Resolve all Less variable references in a variables array.
     *
     * Iterates multiple times to handle chained references like:
     * @heading-small-font-size-m which references @heading-medium-font-size-l
     *
     * @param array<string, string> $variables The variables array with potential @references.
     * @return array<string, string> The resolved variables array.
     */
    private static function resolve_all_less_variables(array $variables): array
    {
        $max_iterations = 10; // Prevent infinite loops.
        $iteration = 0;

        do {
            $changed = false;
            $iteration++;

            foreach ($variables as $name => $value) {
                $resolved = self::resolve_less_value($value, $variables);
                if ($resolved !== $value) {
                    $variables[$name] = $resolved;
                    $changed = true;
                }
            }
        } while ($changed && $iteration < $max_iterations);

        return $variables;
    }

    /**
     * Resolve Less variable references in a single value.
     *
     * Handles patterns like:
     * - @variable-name
     * - @variable-name * 0.85
     * - ((@global-line-height * 3) * 1em)
     *
     * @param string $value The value that may contain @variable references.
     * @param array<string, string> $variables The variables array for lookups.
     * @return string The resolved value.
     */
    private static function resolve_less_value(string $value, array $variables): string
    {
        // If value doesn't contain @, no resolution needed.
        if (strpos($value, '@') === false) {
            return $value;
        }

        // Replace @variable-name references with their values.
        $resolved = preg_replace_callback(
            '/@([a-zA-Z][a-zA-Z0-9_-]*)/',
            function ($matches) use ($variables) {
                $var_name = $matches[1];
                if (isset($variables[$var_name])) {
                    return $variables[$var_name];
                }
                // Variable not found, return original.
                return $matches[0];
            },
            $value
        );

        // If still contains @, we can't fully resolve yet.
        if (strpos($resolved, '@') !== false) {
            return $resolved;
        }

        // Try to evaluate simple math expressions.
        return self::evaluate_less_math($resolved);
    }

    /**
     * Evaluate simple Less math expressions.
     *
     * Handles patterns like:
     * - 2.625rem * 0.85
     * - ((1.5 * 3) * 1em)
     *
     * @param string $expression The expression to evaluate.
     * @return string The evaluated result or original expression if evaluation fails.
     */
    private static function evaluate_less_math(string $expression): string
    {
        // Clean up the expression.
        $expr = trim($expression);

        // Simple case: just a value with no math.
        if (!preg_match('/[*\/+\-]/', $expr)) {
            return $expr;
        }

        // Extract the unit (rem, em, px, %) from the expression.
        $unit = '';
        if (preg_match('/(rem|em|px|%)/', $expr, $unit_matches)) {
            $unit = $unit_matches[1];
        }

        // Remove units for calculation.
        $calc_expr = preg_replace('/([\d.]+)(rem|em|px|%)/', '$1', $expr);

        // Remove parentheses and evaluate.
        try {
            // Sanitize: only allow numbers, operators, parentheses, dots, spaces.
            $sanitized = preg_replace('/[^0-9.+\-*\/() ]/', '', $calc_expr);

            if (empty($sanitized)) {
                return $expression;
            }

            // Use a simple expression evaluator.
            $result = self::safe_eval_math($sanitized);

            if ($result !== null) {
                // Round to reasonable precision.
                $result = round($result, 4);

                // Remove trailing zeros.
                $result = rtrim(rtrim((string) $result, '0'), '.');

                return $result . $unit;
            }
        } catch (\Exception $e) {
            // Evaluation failed, return original.
        }

        return $expression;
    }

    /**
     * Safely evaluate a simple math expression.
     *
     * Only supports: numbers, +, -, *, /, parentheses.
     *
     * @param string $expr The sanitized expression.
     * @return float|null The result or null if evaluation fails.
     */
    private static function safe_eval_math(string $expr): ?float
    {
        // Remove spaces.
        $expr = str_replace(' ', '', $expr);

        if (empty($expr)) {
            return null;
        }

        // Handle parentheses recursively.
        while (preg_match('/\(([^()]+)\)/', $expr, $matches)) {
            $inner_result = self::safe_eval_math($matches[1]);
            if ($inner_result === null) {
                return null;
            }
            $expr = str_replace($matches[0], (string) $inner_result, $expr);
        }

        // Parse and evaluate: handle multiplication and division first.
        // Split by + and - (keeping the operators).
        $tokens = preg_split('/([+\-])/', $expr, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if ($tokens === false || empty($tokens)) {
            return null;
        }

        // Evaluate multiplication/division in each token.
        $processed = [];
        foreach ($tokens as $token) {
            if ($token === '+' || $token === '-') {
                $processed[] = $token;
            } else {
                $result = self::eval_mul_div($token);
                if ($result === null) {
                    return null;
                }
                $processed[] = $result;
            }
        }

        // Now evaluate addition/subtraction.
        $result = 0.0;
        $operator = '+';
        foreach ($processed as $item) {
            if ($item === '+' || $item === '-') {
                $operator = $item;
            } else {
                if ($operator === '+') {
                    $result += (float) $item;
                } else {
                    $result -= (float) $item;
                }
            }
        }

        return $result;
    }

    /**
     * Evaluate multiplication and division in an expression.
     *
     * @param string $expr Expression containing only * and / operators.
     * @return float|null The result or null if evaluation fails.
     */
    private static function eval_mul_div(string $expr): ?float
    {
        $tokens = preg_split('/([*\/])/', $expr, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if ($tokens === false || empty($tokens)) {
            return null;
        }

        $result = null;
        $operator = '*';

        foreach ($tokens as $token) {
            if ($token === '*' || $token === '/') {
                $operator = $token;
            } else {
                $num = (float) $token;
                if ($result === null) {
                    $result = $num;
                } elseif ($operator === '*') {
                    $result *= $num;
                } elseif ($operator === '/') {
                    if ($num == 0) {
                        return null;
                    }
                    $result /= $num;
                }
            }
        }

        return $result;
    }

    /**
     * Generate CSS for a single component.
     *
     * @param string $component Component name.
     * @return string CSS content.
     */
    public static function generate_single_component_css(string $component): string
    {
        if (!class_exists(Component_Registry::class)) {
            return '';
        }

        $saved = get_option(self::COMPONENT_PREFIX . $component, []);

        if (empty($saved)) {
            return '';
        }

        $css = "/* " . ucfirst(str_replace('-', ' ', $component)) . " Variables */\n:root {\n";

        foreach ($saved as $var_name => $value) {
            $css_var = '--uk-' . $var_name;
            $css .= "    {$css_var}: {$value};\n";
        }

        $css .= "}\n";

        return $css;
    }

    /**
     * Generate fluid typography styles using UIkit variables.
     *
     * This uses CSS clamp() for smooth font scaling between breakpoints.
     * The formula creates fluid typography that scales based on viewport width.
     *
     * @return string CSS content for fluid typography.
     */
    private static function generate_fluid_typography(): string
    {
        return <<<'CSS'

/* ==========================================================================
   Fluid Typography Base Styles
   ========================================================================== */

html {
    font-size: var(--uk-global-font-size, 16px);
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    overflow-wrap: anywhere;
}

body {
    font-size: var(--uk-base-body-font-size, var(--uk-global-font-size, 1rem));
    line-height: var(--uk-base-body-line-height, var(--uk-global-line-height, 1.5));
}

/* ==========================================================================
   Base Headings (h1-h6) - Fluid scaling
   ========================================================================== */

h1, .uk-h1 {
    font-size: clamp(
        var(--uk-base-h1-font-size, 2.23rem),
        calc(var(--uk-base-h1-font-size, 2.23rem) + (var(--uk-base-h1-font-size-m, 2.625rem) - var(--uk-base-h1-font-size, 2.23rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-l, 1200px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-base-h1-font-size-m, 2.625rem)
    );
}

h2, .uk-h2 {
    font-size: clamp(
        var(--uk-base-h2-font-size, 1.7rem),
        calc(var(--uk-base-h2-font-size, 1.7rem) + (var(--uk-base-h2-font-size-m, 2rem) - var(--uk-base-h2-font-size, 1.7rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-l, 1200px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-base-h2-font-size-m, 2rem)
    );
}

h3, .uk-h3 {
    font-size: var(--uk-base-h3-font-size, var(--uk-global-large-font-size, 1.5rem));
}

h4, .uk-h4 {
    font-size: var(--uk-base-h4-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

h5, .uk-h5 {
    font-size: var(--uk-base-h5-font-size, var(--uk-global-font-size, 1rem));
}

h6, .uk-h6 {
    font-size: var(--uk-base-h6-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Heading Component Classes - Fluid scaling for larger displays
   ========================================================================== */

.uk-heading-small {
    font-size: clamp(
        var(--uk-heading-small-font-size, 2.4rem),
        calc(var(--uk-heading-small-font-size, 2.4rem) + (var(--uk-heading-small-font-size-m, 3.25rem) - var(--uk-heading-small-font-size, 2.4rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-l, 1200px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-small-font-size-m, 3.25rem)
    );
}

.uk-heading-medium {
    font-size: clamp(
        var(--uk-heading-medium-font-size, 2.5rem),
        calc(var(--uk-heading-medium-font-size, 2.5rem) + (var(--uk-heading-medium-font-size-l, 4rem) - var(--uk-heading-medium-font-size, 2.5rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-medium-font-size-l, 4rem)
    );
}

.uk-heading-large {
    font-size: clamp(
        var(--uk-heading-large-font-size, 3.4rem),
        calc(var(--uk-heading-large-font-size, 3.4rem) + (var(--uk-heading-large-font-size-l, 6rem) - var(--uk-heading-large-font-size, 3.4rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-large-font-size-l, 6rem)
    );
}

.uk-heading-xlarge {
    font-size: clamp(
        var(--uk-heading-xlarge-font-size, 4rem),
        calc(var(--uk-heading-xlarge-font-size, 4rem) + (var(--uk-heading-xlarge-font-size-l, 8rem) - var(--uk-heading-xlarge-font-size, 4rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-xlarge-font-size-l, 8rem)
    );
}

.uk-heading-2xlarge {
    font-size: clamp(
        var(--uk-heading-2xlarge-font-size, 6rem),
        calc(var(--uk-heading-2xlarge-font-size, 6rem) + (var(--uk-heading-2xlarge-font-size-l, 11rem) - var(--uk-heading-2xlarge-font-size, 6rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-2xlarge-font-size-l, 11rem)
    );
}

.uk-heading-3xlarge {
    font-size: clamp(
        var(--uk-heading-3xlarge-font-size, 8rem),
        calc(var(--uk-heading-3xlarge-font-size, 8rem) + (var(--uk-heading-3xlarge-font-size-l, 15rem) - var(--uk-heading-3xlarge-font-size, 8rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-heading-3xlarge-font-size-l, 15rem)
    );
}

/* ==========================================================================
   Text Utilities
   ========================================================================== */

.uk-text-lead {
    font-size: var(--uk-text-lead-font-size, var(--uk-global-large-font-size, 1.5rem));
    line-height: var(--uk-text-lead-line-height, 1.5);
}

.uk-text-meta {
    font-size: var(--uk-text-meta-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-text-small {
    font-size: var(--uk-text-small-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-text-large {
    font-size: var(--uk-text-large-font-size, var(--uk-global-large-font-size, 1.5rem));
}

.uk-text-default {
    font-size: var(--uk-global-font-size, 1rem);
}

/* ==========================================================================
   Buttons
   ========================================================================== */

.uk-button {
    font-size: var(--uk-button-font-size, var(--uk-global-font-size, 1rem));
}

.uk-button-small {
    font-size: var(--uk-button-small-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-button-large {
    font-size: var(--uk-button-large-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

/* ==========================================================================
   Navbar
   ========================================================================== */

.uk-navbar-nav > li > a {
    font-size: var(--uk-navbar-nav-item-font-size, var(--uk-global-font-size, 1rem));
}

.uk-navbar-subtitle {
    font-size: var(--uk-navbar-subtitle-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Forms
   ========================================================================== */

.uk-input,
.uk-select,
.uk-textarea {
    font-size: var(--uk-form-font-size, var(--uk-global-font-size, 1rem));
}

.uk-form-small:is(.uk-input, .uk-select, .uk-textarea) {
    font-size: var(--uk-form-small-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-form-large:is(.uk-input, .uk-select, .uk-textarea) {
    font-size: var(--uk-form-large-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

.uk-legend {
    font-size: var(--uk-form-legend-font-size, var(--uk-global-large-font-size, 1.5rem));
}

/* ==========================================================================
   Accordion
   ========================================================================== */

.uk-accordion-title {
    font-size: var(--uk-accordion-default-title-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

/* ==========================================================================
   Article
   ========================================================================== */

.uk-article-title {
    font-size: clamp(
        var(--uk-article-title-font-size, 2.23rem),
        calc(var(--uk-article-title-font-size, 2.23rem) + (var(--uk-article-title-font-size-m, 2.625rem) - var(--uk-article-title-font-size, 2.23rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-l, 1200px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-article-title-font-size-m, 2.625rem)
    );
}

.uk-article-meta {
    font-size: var(--uk-article-meta-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Badge
   ========================================================================== */

.uk-badge {
    font-size: var(--uk-badge-font-size, 11px);
}

/* ==========================================================================
   Breadcrumb
   ========================================================================== */

.uk-breadcrumb > * > * {
    font-size: var(--uk-breadcrumb-item-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-breadcrumb > :nth-child(n+2):not(.uk-first-column)::before {
    font-size: var(--uk-breadcrumb-divider-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Card
   ========================================================================== */

.uk-card-title {
    font-size: var(--uk-card-title-font-size, var(--uk-global-large-font-size, 1.5rem));
}

.uk-card-badge {
    font-size: var(--uk-card-badge-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Comment
   ========================================================================== */

.uk-comment-title {
    font-size: var(--uk-comment-title-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

.uk-comment-meta {
    font-size: var(--uk-comment-meta-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Countdown
   ========================================================================== */

.uk-countdown-separator {
    font-size: var(--uk-countdown-separator-font-size, 0.5em);
}

/* ==========================================================================
   Dropdown
   ========================================================================== */

.uk-dropdown-nav .uk-nav-subtitle {
    font-size: var(--uk-dropdown-nav-subtitle-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Modal
   ========================================================================== */

.uk-modal-title {
    font-size: var(--uk-modal-title-font-size, var(--uk-global-xlarge-font-size, 2rem));
}

/* ==========================================================================
   Label
   ========================================================================== */

.uk-label {
    font-size: var(--uk-label-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Nav
   ========================================================================== */

.uk-nav-header {
    font-size: var(--uk-nav-header-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-nav-default > li > a {
    font-size: var(--uk-nav-default-font-size, var(--uk-global-font-size, 1rem));
}

.uk-nav-default .uk-nav-subtitle {
    font-size: var(--uk-nav-default-subtitle-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-nav-default .uk-nav-sub a {
    font-size: var(--uk-nav-default-sublist-font-size, var(--uk-global-font-size, 1rem));
}

.uk-nav-primary > li > a {
    font-size: var(--uk-nav-primary-font-size, var(--uk-global-large-font-size, 1.5rem));
}

.uk-nav-primary .uk-nav-subtitle {
    font-size: var(--uk-nav-primary-subtitle-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

.uk-nav-primary .uk-nav-sub a {
    font-size: var(--uk-nav-primary-sublist-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

.uk-nav-secondary > li > a {
    font-size: var(--uk-nav-secondary-font-size, var(--uk-global-font-size, 1rem));
}

.uk-nav-secondary .uk-nav-subtitle {
    font-size: var(--uk-nav-secondary-subtitle-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-nav-secondary .uk-nav-sub a {
    font-size: var(--uk-nav-secondary-sublist-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* Nav Medium - Fluid scaling */
.uk-nav-medium > li > a {
    font-size: clamp(
        var(--uk-nav-medium-font-size, 2.5rem),
        calc(var(--uk-nav-medium-font-size, 2.5rem) + (var(--uk-nav-medium-font-size-l, 4rem) - var(--uk-nav-medium-font-size, 2.5rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-nav-medium-font-size-l, 4rem)
    );
}

/* Nav Large - Fluid scaling */
.uk-nav-large > li > a {
    font-size: clamp(
        var(--uk-nav-large-font-size, 3.4rem),
        calc(var(--uk-nav-large-font-size, 3.4rem) + (var(--uk-nav-large-font-size-l, 6rem) - var(--uk-nav-large-font-size, 3.4rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-nav-large-font-size-l, 6rem)
    );
}

/* Nav XLarge - Fluid scaling */
.uk-nav-xlarge > li > a {
    font-size: clamp(
        var(--uk-nav-xlarge-font-size, 4rem),
        calc(var(--uk-nav-xlarge-font-size, 4rem) + (var(--uk-nav-xlarge-font-size-l, 8rem) - var(--uk-nav-xlarge-font-size, 4rem)) * ((100vw - var(--uk-breakpoint-s, 640px)) / (var(--uk-breakpoint-xl, 1600px) - var(--uk-breakpoint-s, 640px)))),
        var(--uk-nav-xlarge-font-size-l, 8rem)
    );
}

/* ==========================================================================
   Navbar Dropdown
   ========================================================================== */

.uk-navbar-dropdown-nav .uk-nav-subtitle {
    font-size: var(--uk-navbar-dropdown-nav-subtitle-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Notification
   ========================================================================== */

.uk-notification-message {
    font-size: var(--uk-notification-message-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

/* ==========================================================================
   Search
   ========================================================================== */

.uk-search-medium .uk-search-input {
    font-size: var(--uk-search-medium-font-size, var(--uk-global-large-font-size, 1.5rem));
}

.uk-search-large .uk-search-input {
    font-size: var(--uk-search-large-font-size, var(--uk-global-2xlarge-font-size, 2.625rem));
}

/* ==========================================================================
   Table
   ========================================================================== */

.uk-table th {
    font-size: var(--uk-table-header-cell-font-size, var(--uk-global-font-size, 1rem));
}

.uk-table tfoot {
    font-size: var(--uk-table-footer-font-size, var(--uk-global-small-font-size, 0.875rem));
}

.uk-table caption {
    font-size: var(--uk-table-caption-font-size, var(--uk-global-small-font-size, 0.875rem));
}

/* ==========================================================================
   Tooltip
   ========================================================================== */

.uk-tooltip {
    font-size: var(--uk-tooltip-font-size, 12px);
}

/* ==========================================================================
   Utility
   ========================================================================== */

.uk-dropcap::first-letter {
    font-size: var(--uk-dropcap-font-size, 4.5em);
}

.uk-logo {
    font-size: var(--uk-logo-font-size, var(--uk-global-large-font-size, 1.5rem));
}

/* ==========================================================================
   Base Typography Elements
   ========================================================================== */

blockquote,
.uk-blockquote {
    font-size: var(--uk-base-blockquote-font-size, var(--uk-global-medium-font-size, 1.25rem));
}

blockquote footer,
.uk-blockquote footer {
    font-size: var(--uk-base-blockquote-footer-font-size, var(--uk-global-small-font-size, 0.875rem));
}

pre {
    font-size: var(--uk-base-pre-font-size, var(--uk-global-small-font-size, 0.875rem));
}

code {
    font-size: var(--uk-base-code-font-size, var(--uk-global-small-font-size, 0.875rem));
}

small {
    font-size: var(--uk-base-small-font-size, 80%);
}

/* ==========================================================================
   Word Wrap and Hyphenation for all text elements
   ========================================================================== */

h1, h2, h3, h4, h5, h6,
.uk-h1, .uk-h2, .uk-h3, .uk-h4, .uk-h5, .uk-h6,
.uk-heading-small,
.uk-heading-medium,
.uk-heading-large,
.uk-heading-xlarge,
.uk-heading-2xlarge,
.uk-heading-3xlarge,
.uk-text-lead {
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    overflow-wrap: break-word;
    word-break: break-word;
}

/* ==========================================================================
   Border Radius
   ========================================================================== */

.uk-border-rounded {
    border-radius: var(--uk-border-rounded-border-radius, 5px);
}

.uk-badge {
    border-radius: var(--uk-badge-border-radius, 500px);
}

.uk-tooltip {
    border-radius: var(--uk-tooltip-border-radius, 2px);
}

.uk-dotnav > * > * {
    border-radius: var(--uk-dotnav-item-border-radius, 50%);
}

.uk-icon-button {
    border-radius: var(--uk-icon-button-border-radius, 500px);
}

.uk-form-range::-webkit-slider-thumb {
    border-radius: var(--uk-form-range-thumb-border-radius, 500px);
}

.uk-form-range::-moz-range-thumb {
    border-radius: var(--uk-form-range-thumb-border-radius, 500px);
}

CSS;
    }
}
