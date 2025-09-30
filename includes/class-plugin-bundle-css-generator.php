<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access.
}

/**
 * Class Plugin_Bundle_Css_Generator
 *
 * Responsible for generating the complete CSS content for the child theme's style.css file.
 * This class takes an array of CSS options (such as colors, typography, and spacing) and converts
 * them into CSS custom properties along with the necessary theme styles.
 */
class Plugin_Bundle_Css_Generator
{
    /**
     * Generates the complete CSS content for the child theme.
     *
     * This method uses the provided CSS options to create CSS custom properties and styles.
     *
     * @param array $options An associative array of CSS options.
     * @return string The complete CSS content.
     */
    public static function generate_css($options)
    {
        // Determine the HTML root font size (px) so global typography can scale predictably.
        $base_font_size = isset($options['base_font_size']) ? floatval($options['base_font_size']) : 16;

        // Use a heredoc string to generate the full CSS content, including custom properties and theme styles.
        $css = <<<EOT
/* GLOBAL */
:root {

    --muted-color: {$options['muted_color']};
    --emphasis-color: {$options['emphasis_color']};
    --primary-color: {$options['primary_color']};
    --secondary-color: {$options['secondary_color']};
    --success-color: {$options['success_color']};
    --warning-color: {$options['warning_color']};
    --danger-color: {$options['danger_color']};
    --text-background-color: {$options['text_background_color']};
    --body-color: {$options['body_color']};
    --background-default: {$options['background_default_color']};
    --background-muted: {$options['background_muted_color']};
    --background-primary: {$options['background_primary_color']};
    --background-secondary: {$options['background_secondary_color']};
    
    --button-default-color: {$options['button_default_color']};
    --button-default-hover-color: {$options['button_default_hover_color']};
    --button-default-text-color: {$options['button_default_text_color']};
    --button-default-hover-text-color: {$options['button_default_hover_text_color']};
   
    --button-primary-color: {$options['button_primary_color']};
    --button-primary-hover-color: {$options['button_primary_hover_color']};
    --button-primary-text-color: {$options['button_primary_text_color']};
    --button-primary-hover-text-color: {$options['button_primary_hover_text_color']};
    
    --button-secondary-color: {$options['button_secondary_color']};
    --button-secondary-hover-color: {$options['button_secondary_hover_color']};
    --button-secondary-text-color: {$options['button_secondary_text_color']};
    --button-secondary-hover-text-color: {$options['button_secondary_hover_text_color']};
    
    --button-danger-color: {$options['button_danger_color']};
    --button-danger-hover-color: {$options['button_danger_hover_color']};
    --button-danger-text-color: {$options['button_danger_text_color']};
    --button-danger-hover-text-color: {$options['button_danger_hover_text_color']};
   
    --button-text-color: {$options['button_text_color']};
    --button-text-hover-color: {$options['button_text_hover_color']};
    
    --button-link-color: {$options['button_link_color']};
    --button-link-hover-color: {$options['button_link_hover_color']};

    /* Breakpoints */
    --ppm-breakpoint-s: {$options['ppm_breakpoint_s']};
    --ppm-breakpoint-m: {$options['ppm_breakpoint_m']};
    --ppm-breakpoint-l: {$options['ppm_breakpoint_l']};
    --ppm-breakpoint-xl: {$options['ppm_breakpoint_xl']};
    
    --uk-breakpoint-s: {$options['ppm_breakpoint_s']}px;
    --uk-breakpoint-m: {$options['ppm_breakpoint_m']}px;
    --uk-breakpoint-l: {$options['ppm_breakpoint_l']}px;
    --uk-breakpoint-xl: {$options['ppm_breakpoint_xl']}px;


    /* Base font size */
    --base-font-size: {$base_font_size}px;

    /* Headline font sizes */
    --heading-3xlarge-mobile: {$options['heading_3xlarge_mobile']};
    --heading-3xlarge-desktop: {$options['heading_3xlarge_desktop']};
    --heading-3xlarge-font-weight: {$options['heading_3xlarge_font_weight']};

    --heading-2xlarge-mobile: {$options['heading_2xlarge_mobile']};
    --heading-2xlarge-desktop: {$options['heading_2xlarge_desktop']};
    --heading-2xlarge-font-weight: {$options['heading_2xlarge_font_weight']};

    --heading-xlarge-mobile: {$options['heading_xlarge_mobile']};
    --heading-xlarge-desktop: {$options['heading_xlarge_desktop']};
    --heading-xlarge-font-weight: {$options['heading_xlarge_font_weight']};

    --heading-large-mobile: {$options['heading_large_mobile']};
    --heading-large-desktop: {$options['heading_large_desktop']};
    --heading-large-font-weight: {$options['heading_large_font_weight']};

    --heading-medium-mobile: {$options['heading_medium_mobile']};
    --heading-medium-desktop: {$options['heading_medium_desktop']};
    --heading-medium-font-weight: {$options['heading_medium_font_weight']};

    --heading-small-mobile: {$options['heading_small_mobile']};
    --heading-small-desktop: {$options['heading_small_desktop']};
    --heading-small-font-weight: {$options['heading_small_font_weight']};

    --button-default-mobile: {$options['button_default_mobile']};
    --button-default-desktop: {$options['button_default_desktop']};
    --button-default-font-weight: {$options['button_default_font_weight']};

    --button-primary-mobile: {$options['button_primary_mobile']};
    --button-primary-desktop: {$options['button_primary_desktop']};
    --button-primary-font-weight: {$options['button_primary_font_weight']};

    --button-secondary-mobile: {$options['button_secondary_mobile']};
    --button-secondary-desktop: {$options['button_secondary_desktop']};
    --button-secondary-font-weight: {$options['button_secondary_font_weight']};

    --button-danger-mobile: {$options['button_danger_mobile']};
    --button-danger-desktop: {$options['button_danger_desktop']};
    --button-danger-font-weight: {$options['button_danger_font_weight']};

    --button-text-mobile: {$options['button_text_mobile']};
    --button-text-desktop: {$options['button_text_desktop']};
    --button-text-font-weight: {$options['button_text_font_weight']};

    --button-link-mobile: {$options['button_link_mobile']};
    --button-link-desktop: {$options['button_link_desktop']};
    --button-link-font-weight: {$options['button_link_font_weight']};

    --navbar-link-mobile: {$options['navbar_link_mobile']};
    --navbar-link-desktop: {$options['navbar_link_desktop']};
    --navbar-link-font-weight: {$options['navbar_link_font_weight']};

    --text-default-mobile: {$options['text_default_mobile']};
    --text-default-desktop: {$options['text_default_desktop']};
    --text-default-font-weight: {$options['text_default_font_weight']};

    --text-small-mobile: {$options['text_small_mobile']};
    --text-small-desktop: {$options['text_small_desktop']};
    --text-small-font-weight: {$options['text_small_font_weight']};

    --text-large-mobile: {$options['text_large_mobile']};
    --text-large-desktop: {$options['text_large_desktop']};
    --text-large-font-weight: {$options['text_large_font_weight']};

    /* Container */
    --column-gutter-mobile: {$options['column_gutter_mobile']}px;
    --column-gutter-l: {$options['column_gutter_l']}px;

    --container-padding-vertical-default-mobile: {$options['container_padding_vertical_default_mobile']}px;
    --container-padding-vertical-default-m: {$options['container_padding_vertical_default_m']}px;
    --container-padding-vertical-xsmall-mobile: {$options['container_padding_vertical_xsmall_mobile']}px;
    --container-padding-vertical-xsmall-m: {$options['container_padding_vertical_xsmall_m']}px;
    --container-padding-vertical-small-mobile: {$options['container_padding_vertical_small_mobile']}px;
    --container-padding-vertical-small-m: {$options['container_padding_vertical_small_m']}px;
    --container-padding-vertical-large-mobile: {$options['container_padding_vertical_large_mobile']}px;
    --container-padding-vertical-large-m: {$options['container_padding_vertical_large_m']}px;
    --container-padding-vertical-xlarge-mobile: {$options['container_padding_vertical_xlarge_mobile']}px;
    --container-padding-vertical-xlarge-m: {$options['container_padding_vertical_xlarge_m']}px;

    --container-padding-horizontal-mobile: {$options['container_padding_horizontal_mobile']}px;
    --container-padding-horizontal-s: {$options['container_padding_horizontal_s']}px;
    --container-padding-horizontal-m: {$options['container_padding_horizontal_m']}px;

    --container-max-width-default: {$options['container_max_width_default']}px;
    --container-max-width-xsmall: {$options['container_max_width_xsmall']}px;
    --container-max-width-small: {$options['container_max_width_small']}px;
    --container-max-width-large: {$options['container_max_width_large']}px;
    --container-max-width-xlarge: {$options['container_max_width_xlarge']}px;

    /* Element */
    --element-width-small: {$options['element_width_small']}px;
    --element-width-medium: {$options['element_width_medium']}px;
    --element-width-large: {$options['element_width_large']}px;
    --element-width-xlarge: {$options['element_width_xlarge']}px;
    --element-width-2xlarge: {$options['element_width_2xlarge']}px;

    --element-margin-default-mobile: {$options['element_margin_default_mobile']}px;
    --element-margin-default-l: {$options['element_margin_default_l']}px;
    --element-margin-xsmall-mobile: {$options['element_margin_xsmall_mobile']}px;
    --element-margin-xsmall-l: {$options['element_margin_xsmall_l']}px;
    --element-margin-small-mobile: {$options['element_margin_small_mobile']}px;
    --element-margin-small-l: {$options['element_margin_small_l']}px;
    --element-margin-medium-mobile: {$options['element_margin_medium_mobile']}px;
    --element-margin-medium-l: {$options['element_margin_medium_l']}px;
    --element-margin-large-mobile: {$options['element_margin_large_mobile']}px;
    --element-margin-large-l: {$options['element_margin_large_l']}px;
    --element-margin-xlarge-mobile: {$options['element_margin_xlarge_mobile']}px;
    --element-margin-xlarge-l: {$options['element_margin_xlarge_l']}px;
}   
     
.uk-text-muted {
    color: var(--muted-color) !important;
}

.uk-text-emphasis {
    color: var(--emphasis-color) !important;
}

.uk-text-primary {
    color: var(--primary-color) !important;
}

.uk-text-secondary {
    color: var(--secondary-color) !important;
}

.uk-text-success {
    color: var(--success-color) !important;
}

.uk-text-warning {
    color: var(--warning-color) !important;
}

.uk-text-danger {
    color: var(--danger-color) !important;
}

.uk-text-background {
    background-color: var(--text-background-color) !important;
}

.uk-section-default,
.uk-background-default {
    background-color: var(--background-default) !important;
}

.uk-section-muted,
.uk-background-muted {
    background-color: var(--background-muted) !important;
}

.uk-section-primary,
.uk-background-primary {
    background-color: var(--background-primary) !important;
}

.uk-section-secondary,
.uk-background-secondary {
    background-color: var(--background-secondary) !important;
}



/* TEXT */
body {
    --mobile-font-size: var(--text-default-mobile);
    --desktop-font-size: var(--text-default-desktop);
    font-weight: var(--text-default-font-weight) !important;
}

.uk-text-small {
    --mobile-font-size: var(--text-small-mobile);
    --desktop-font-size: var(--text-small-desktop);
    font-weight: var(--text-small-font-weight) !important;
}

.uk-text-default {
    --mobile-font-size: var(--text-default-mobile);
    --desktop-font-size: var(--text-default-desktop);
    font-weight: var(--text-default-font-weight) !important;
}

.uk-text-large {
    --mobile-font-size: var(--text-large-mobile);
    --desktop-font-size: var(--text-large-desktop);
    font-weight: var(--text-large-font-weight) !important;
}

/* HEADING */
.uk-heading-small {
    --mobile-font-size: var(--heading-small-mobile);
    --desktop-font-size: var(--heading-small-desktop);
    font-weight: var(--heading-small-font-weight) !important;
}

.uk-heading-medium {
    --mobile-font-size: var(--heading-medium-mobile);
    --desktop-font-size: var(--heading-medium-desktop);
    font-weight: var(--heading-medium-font-weight) !important;
}

.uk-heading-large {
    --mobile-font-size: var(--heading-large-mobile);
    --desktop-font-size: var(--heading-large-desktop);
    font-weight: var(--heading-large-font-weight) !important;
}

.uk-heading-xlarge {
    --mobile-font-size: var(--heading-xlarge-mobile);
    --desktop-font-size: var(--heading-xlarge-desktop);
    font-weight: var(--heading-xlarge-font-weight) !important;
}

.uk-heading-2xlarge {
    --mobile-font-size: var(--heading-2xlarge-mobile);
    --desktop-font-size: var(--heading-2xlarge-desktop);
    font-weight: var(--heading-2xlarge-font-weight) !important;
}

.uk-heading-3xlarge {
    --mobile-font-size: var(--heading-3xlarge-mobile);
    --desktop-font-size: var(--heading-3xlarge-desktop);
    font-weight: var(--heading-3xlarge-font-weight) !important;
}

/* NAV */
.uk-navbar-nav>li>a {
    --mobile-font-size: var(--navbar-link-mobile);
    --desktop-font-size: var(--navbar-link-desktop);
    font-weight: var(--navbar-link-font-weight) !important;
}

/* BUTTON */
.uk-button-default {
    --mobile-font-size: var(--button-default-mobile);
    --desktop-font-size: var(--button-default-desktop);
    font-weight: var(--button-default-font-weight) !important;
}

.uk-button-default {
    background-color: var(--button-default-color) !important;
    color: var(--button-default-text-color) !important;
}

.uk-button-default:hover {
    background-color: var(--button-default-hover-color) !important;
    color: var(--button-default-hover-text-color) !important;
}

.uk-button-primary {
    --mobile-font-size: var(--button-primary-mobile);
    --desktop-font-size: var(--button-primary-desktop);
    font-weight: var(--button-primary-font-weight) !important;
}

.uk-button-primary {
    background-color: var(--button-primary-color) !important;
    color: var(--button-primary-text-color) !important;
}

.uk-button-primary:hover {
    background-color: var(--button-primary-hover-color) !important;
    color: var(--button-primary-hover-text-color) !important;
}

.uk-button-secondary {
    --mobile-font-size: var(--button-secondary-mobile);
    --desktop-font-size: var(--button-secondary-desktop);
    font-weight: var(--button-secondary-font-weight) !important;
}

.uk-button-secondary {
    background-color: var(--button-secondary-color) !important;
    color: var(--button-secondary-text-color) !important;
}

.uk-button-secondary:hover {
    background-color: var(--button-secondary-hover-color) !important;
    color: var(--button-secondary-hover-text-color) !important;
}

.uk-button-danger {
    --mobile-font-size: var(--button-danger-mobile);
    --desktop-font-size: var(--button-danger-desktop);
    font-weight: var(--button-danger-font-weight) !important;
}

.uk-button-danger {
    background-color: var(--button-danger-color) !important;
    color: var(--button-danger-text-color) !important;
}

.uk-button-danger:hover {
    background-color: var(--button-danger-hover-color) !important;
    color: var(--button-danger-hover-text-color) !important;
}

.uk-button-text {
    --mobile-font-size: var(--button-text-mobile);
    --desktop-font-size: var(--button-text-desktop);
    font-weight: var(--button-text-font-weight) !important;
}

.uk-button-text {
    color: var(--button-text-color) !important;
}

.uk-button-text:hover {
    color: var(--button-text-hover-color) !important;
}

.uk-button-link {
    --mobile-font-size: var(--button-link-mobile);
    --desktop-font-size: var(--button-link-desktop);
    font-weight: var(--button-link-font-weight) !important;
}

.uk-button-link a {
    color: var(--button-link-color) !important;
}

.uk-button-link:hover,
.uk-button-link a:hover {
    color: var(--button-link-hover-color) !important;
}

[class*="uk-column-"] {
    padding-left: var(--column-gutter-mobile);
    padding-right: var(--column-gutter-mobile);
}

@media (min-width: 1200px) {
    [class*="uk-column-"] {
        padding-left: var(--column-gutter-l);
        padding-right: var(--column-gutter-l);
    }
}

.uk-container {
    max-width: var(--container-max-width-default);
    padding-left: var(--container-padding-horizontal-mobile);
    padding-right: var(--container-padding-horizontal-mobile);
}

.uk-container-xsmall {
    max-width: var(--container-max-width-xsmall);
}

.uk-container-small {
    max-width: var(--container-max-width-small);
}

.uk-container-large {
    max-width: var(--container-max-width-large);
}

.uk-container-xlarge {
    max-width: var(--container-max-width-xlarge);
}

@media (min-width: 600px) {
    .uk-container {
        padding-left: var(--container-padding-horizontal-s);
        padding-right: var(--container-padding-horizontal-s);
    }
}

@media (min-width: 900px) {
    .uk-container {
        padding-left: var(--container-padding-horizontal-m);
        padding-right: var(--container-padding-horizontal-m);
    }
}

.uk-section {
    padding-top: var(--container-padding-vertical-default-mobile);
    padding-bottom: var(--container-padding-vertical-default-mobile);
}

@media (min-width: 900px) {
    .uk-section {
        padding-top: var(--container-padding-vertical-default-m);
        padding-bottom: var(--container-padding-vertical-default-m);
    }
}

.uk-section-xsmall {
    padding-top: var(--container-padding-vertical-xsmall-mobile);
    padding-bottom: var(--container-padding-vertical-xsmall-mobile);
}

@media (min-width: 900px) {
    .uk-section-xsmall {
        padding-top: var(--container-padding-vertical-xsmall-m);
        padding-bottom: var(--container-padding-vertical-xsmall-m);
    }
}

.uk-section-small {
    padding-top: var(--container-padding-vertical-small-mobile);
    padding-bottom: var(--container-padding-vertical-small-mobile);
}

@media (min-width: 900px) {
    .uk-section-small {
        padding-top: var(--container-padding-vertical-small-m);
        padding-bottom: var(--container-padding-vertical-small-m);
    }
}

.uk-section-large {
    padding-top: var(--container-padding-vertical-large-mobile);
    padding-bottom: var(--container-padding-vertical-large-mobile);
}

@media (min-width: 900px) {
    .uk-section-large {
        padding-top: var(--container-padding-vertical-large-m);
        padding-bottom: var(--container-padding-vertical-large-m);
    }
}

.uk-section-xlarge {
    padding-top: var(--container-padding-vertical-xlarge-mobile);
    padding-bottom: var(--container-padding-vertical-xlarge-mobile);
}

@media (min-width: 900px) {
    .uk-section-xlarge {
        padding-top: var(--container-padding-vertical-xlarge-m);
        padding-bottom: var(--container-padding-vertical-xlarge-m);
    }
}

.uk-width-small {
    width: var(--element-width-small);
}

.uk-width-medium {
    width: var(--element-width-medium);
}

.uk-width-large {
    width: var(--element-width-large);
}

.uk-width-xlarge {
    width: var(--element-width-xlarge);
}

.uk-width-2xlarge {
    width: var(--element-width-2xlarge);
}

.uk-margin {
    margin-top: var(--element-margin-default-mobile);
    margin-bottom: var(--element-margin-default-mobile);
}

@media (min-width: 1200px) {
    .uk-margin {
        margin-top: var(--element-margin-default-l);
        margin-bottom: var(--element-margin-default-l);
    }
}

.uk-margin-xsmall {
    margin-top: var(--element-margin-xsmall-mobile);
    margin-bottom: var(--element-margin-xsmall-mobile);
}

@media (min-width: 1200px) {
    .uk-margin-xsmall {
        margin-top: var(--element-margin-xsmall-l);
        margin-bottom: var(--element-margin-xsmall-l);
    }
}

.uk-margin-small {
    margin-top: var(--element-margin-small-mobile);
    margin-bottom: var(--element-margin-small-mobile);
}

@media (min-width: 1200px) {
    .uk-margin-small {
        margin-top: var(--element-margin-small-l);
        margin-bottom: var(--element-margin-small-l);
    }
}

.uk-margin-medium {
    margin-top: var(--element-margin-medium-mobile);
    margin-bottom: var(--element-margin-medium-mobile);
}

@media (min-width: 1200px) {
    .uk-margin-medium {
        margin-top: var(--element-margin-medium-l);
        margin-bottom: var(--element-margin-medium-l);
    }
}

.uk-margin-large {
    margin-top: var(--element-margin-large-mobile);
    margin-bottom: var(--element-margin-large-mobile);
}

@media (min-width: 1200px) {
    .uk-margin-large {
        margin-top: var(--element-margin-large-l);
        margin-bottom: var(--element-margin-large-l);
    }
}

.uk-margin-xlarge {
    margin-top: var(--element-margin-xlarge-mobile);
    margin-bottom: var(--element-margin-xlarge-mobile);
}

@media (min-width: 1200px) {
    .uk-margin-xlarge {
        margin-top: var(--element-margin-xlarge-l);
        margin-bottom: var(--element-margin-xlarge-l);
    }
}

html {
    font-size: var(--base-font-size) !important;
    -webkit-hyphens: auto !important;
    -moz-hyphens: auto !important;
    -ms-hyphens: auto !important;
    hyphens: auto !important;
    overflow-wrap: anywhere !important;
}

body {
    color: var(--body-color) !important;
}

body,
.uk-text-small,
.uk-text-default,
.uk-text-large,
.uk-heading-small,
.uk-heading-medium,
.uk-heading-large,
.uk-heading-xlarge,
.uk-heading-2xlarge,
.uk-heading-3xlarge,
.uk-navbar-nav>li>a,
.uk-button-default,
.uk-button-primary,
.uk-button-secondary,
.uk-button-danger,
.uk-button-text,
.uk-button-link {
    font-size: clamp(calc(var(--mobile-font-size) * 1px),
            calc((var(--mobile-font-size) * 1px) + ((var(--desktop-font-size) - var(--mobile-font-size)) * ((100vw - (var(--ppm-breakpoint-s) * 1px)) / (var(--ppm-breakpoint-xl) - var(--ppm-breakpoint-s))))),
            calc(var(--desktop-font-size) * 1px)) !important;
	-webkit-hyphens: auto !important;
	-moz-hyphens: auto !important;
	-ms-hyphens: auto !important;
	hyphens: auto !important;
	overflow-wrap: break-word !important;
	white-space: wrap !important;
    text-wrap: pretty !important;
    word-break: break-word !important;
}


EOT;
        return $css;
    }
}
