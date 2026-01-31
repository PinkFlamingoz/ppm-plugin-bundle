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
     * @return string The complete CSS content with UIkit variables.
     */
    public static function generate(): string
    {
        $css = self::generate_component_variables();
        $css .= self::generate_fluid_typography();

        return $css;
    }

    /**
     * Generate CSS variables from component-based settings.
     *
     * @return string CSS content with UIkit-style variables.
     */
    public static function generate_component_variables(): string
    {
        if (!class_exists(Component_Registry::class)) {
            return '';
        }

        $css = "\n/* UIkit Component Variables */\n:root {\n";
        $has_variables = false;

        $components = Component_Registry::get_all();

        foreach (array_keys($components) as $component) {
            $saved = get_option(self::COMPONENT_PREFIX . $component, []);

            if (empty($saved)) {
                continue;
            }

            $has_variables = true;
            $css .= "\n    /* " . ucfirst(str_replace('-', ' ', $component)) . " */\n";

            foreach ($saved as $var_name => $value) {
                // Convert Less variable name to CSS custom property.
                $css_var = '--uk-' . $var_name;
                $css .= "    {$css_var}: {$value};\n";
            }
        }

        $css .= "}\n";

        return $has_variables ? $css : '';
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
    color: var(--uk-base-body-color, var(--uk-global-color, #666));
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
