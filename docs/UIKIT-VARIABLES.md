# UIkit Less Variables Reference

> Auto-generated documentation of all UIkit/YOOtheme Less variables.
> Generated on: 2026-02-02 13:52:54

## Summary

| Metric | Value |
|--------|-------|
| Total Components | 71 |
| Total Variables | 2705 |
| Variables with Overrides | 207 |

## Layer Structure

Variables are consolidated from three layers (in order of precedence):

1. **Component** (`uikit/src/less/components/`) - Base UIkit variables
2. **Theme** (`uikit/src/less/theme/`) - Theme-level overrides
3. **Master** (`uikit-themes/master/`) - YOOtheme Pro customizations
   - `base/` - Core variable overrides
   - `typo/` - Typography settings
   - `border/` - Border styles
   - `border-radius/` - Border radius values
   - `box-shadow/` - Shadow effects
   - `background-image/` - Background patterns
   - `transform/` - CSS transforms

## Components

| Component | Variables | Overrides |
|-----------|-----------|-----------|
| [accordion](#accordion) | 36 | 2 |
| [alert](#alert) | 27 | 2 |
| [align](#align) | 3 | 0 |
| [animation](#animation) | 10 | 0 |
| [article](#article) | 23 | 2 |
| [background](#background) | 4 | 0 |
| [badge](#badge) | 18 | 0 |
| [base](#base) | 161 | 12 |
| [breadcrumb](#breadcrumb) | 22 | 0 |
| [button](#button) | 227 | 25 |
| [card](#card) | 152 | 20 |
| [close](#close) | 4 | 0 |
| [column](#column) | 5 | 0 |
| [comment](#comment) | 18 | 2 |
| [container](#container) | 8 | 0 |
| [countdown](#countdown) | 2 | 0 |
| [description-list](#description-list) | 18 | 3 |
| [divider](#divider) | 30 | 0 |
| [dotnav](#dotnav) | 33 | 7 |
| [drop](#drop) | 5 | 0 |
| [dropbar](#dropbar) | 17 | 6 |
| [dropdown](#dropdown) | 50 | 6 |
| [dropnav](#dropnav) | 1 | 0 |
| [form](#form) | 124 | 23 |
| [form-range](#form-range) | 21 | 6 |
| [grid](#grid) | 21 | 0 |
| [heading](#heading) | 104 | 0 |
| [height](#height) | 3 | 0 |
| [icon](#icon) | 55 | 0 |
| [iconnav](#iconnav) | 15 | 0 |
| [inverse](#inverse) | 8 | 0 |
| [label](#label) | 31 | 2 |
| [leader](#leader) | 8 | 0 |
| [lightbox](#lightbox) | 13 | 0 |
| [link](#link) | 19 | 0 |
| [list](#list) | 31 | 2 |
| [margin](#margin) | 8 | 0 |
| [marker](#marker) | 18 | 0 |
| [mixin](#mixin) | 4 | 0 |
| [modal](#modal) | 47 | 9 |
| [nav](#nav) | 218 | 7 |
| [navbar](#navbar) | 186 | 15 |
| [notification](#notification) | 33 | 11 |
| [offcanvas](#offcanvas) | 15 | 0 |
| [overlay](#overlay) | 14 | 0 |
| [padding](#padding) | 5 | 0 |
| [pagination](#pagination) | 67 | 0 |
| [placeholder](#placeholder) | 9 | 3 |
| [position](#position) | 4 | 0 |
| [progress](#progress) | 7 | 1 |
| [search](#search) | 136 | 20 |
| [section](#section) | 39 | 0 |
| [slidenav](#slidenav) | 30 | 0 |
| [slider](#slider) | 4 | 0 |
| [sortable](#sortable) | 3 | 0 |
| [spinner](#spinner) | 5 | 0 |
| [sticky](#sticky) | 3 | 0 |
| [subnav](#subnav) | 88 | 2 |
| [svg](#svg) | 6 | 0 |
| [tab](#tab) | 57 | 7 |
| [table](#table) | 37 | 5 |
| [text](#text) | 39 | 3 |
| [thumbnav](#thumbnav) | 22 | 4 |
| [tile](#tile) | 32 | 0 |
| [tooltip](#tooltip) | 10 | 0 |
| [totop](#totop) | 32 | 0 |
| [transition](#transition) | 5 | 0 |
| [utility](#utility) | 32 | 0 |
| [variables](#variables) | 62 | 0 |
| [width](#width) | 5 | 0 |
| [yootheme-theme](#yootheme-theme) | 96 | 0 |

---

## Accordion

**36 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-content-padding-bottom` | `@accordion-default-content-padding-horizontal` | master |
| `@accordion-default-content-padding-horizontal` | `0` | master |
| `@accordion-default-icon-color` ⚡ | `@global-color` | theme, master |
| `@accordion-default-item-active-background` | `@accordion-default-item-background` | master |
| `@accordion-default-item-background` | `transparent` | master |
| `@accordion-default-item-mode` | `divider` | master |
| `@accordion-default-item-transition-duration` | `0.1s` | master |
| `@accordion-default-title-padding-horizontal` | `0` | master |
| `@accordion-default-title-padding-vertical` | `0` | master |
| `@inverse-accordion-default-icon-color` ⚡ | `@inverse-global-color` | theme, master |
| `@inverse-accordion-default-item-active-background` | `@inverse-accordion-default-item-background` | master |
| `@inverse-accordion-default-item-background` | `transparent` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-item-active-border` | `@accordion-default-item-border` | master |
| `@accordion-default-item-border` | `transparent` | master |
| `@accordion-default-item-border-width` | `0` | master |
| `@inverse-accordion-default-item-active-border` | `@inverse-accordion-default-item-border` | master |
| `@inverse-accordion-default-item-border` | `@inverse-global-border` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-item-active-box-shadow` | `@accordion-default-item-box-shadow` | master |
| `@accordion-default-item-box-shadow` | `none` | master |
| `@inverse-accordion-default-item-active-box-shadow` | `@inverse-accordion-default-item-box-shadow` | master |
| `@inverse-accordion-default-item-box-shadow` | `none` | master |

### Content

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-content-margin-top` | `@global-margin` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-accordion-default-title-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-accordion-default-title-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-item-margin-top` | `@global-margin` | component |

### Title

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-title-color` | `@global-emphasis-color` | component |
| `@accordion-default-title-font-size` | `@global-medium-font-size` | component |
| `@accordion-default-title-gap` | `15px` | component |
| `@accordion-default-title-hover-color` | `@global-color` | component |
| `@accordion-default-title-line-height` | `1.4` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@accordion-default-title-font-family` | `@global-primary-font-family` | master |
| `@accordion-default-title-font-style` | `@global-primary-font-style` | master |
| `@accordion-default-title-font-weight` | `@global-primary-font-weight` | master |
| `@accordion-default-title-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@accordion-default-title-text-transform` | `@global-primary-text-transform` | master |

---

## Alert

**27 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-backdrop-filter` | `~''` | master |
| `@alert-background` | `@global-muted-background` | component |
| `@alert-close-hover-opacity` ⚡ | `0.8` | theme, master |
| `@alert-close-opacity` ⚡ | `0.4` | theme, master |
| `@alert-color` | `@global-color` | component |
| `@alert-margin-vertical` | `@global-margin` | component |
| `@alert-padding` | `15px` | component |
| `@alert-padding-right` | `@alert-padding + 14px` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-border` | `transparent` | master |
| `@alert-border-mode` | `~''` | master |
| `@alert-border-width` | `0` | master |
| `@alert-danger-border` | `transparent` | master |
| `@alert-primary-border` | `transparent` | master |
| `@alert-success-border` | `transparent` | master |
| `@alert-warning-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-box-shadow` | `none` | master |

### Close Button

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-close-right` | `@alert-padding` | component |
| `@alert-close-top` | `@alert-padding + 5px` | component |

### Danger

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-danger-background` | `lighten(tint(@global-danger-background, 40%), 20%)` | component |
| `@alert-danger-color` | `@global-danger-background` | component |

### Primary

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-primary-background` | `lighten(tint(@global-primary-background, 40%), 20%)` | component |
| `@alert-primary-color` | `@global-primary-background` | component |

### Success

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-success-background` | `lighten(tint(@global-success-background, 40%), 25%)` | component |
| `@alert-success-color` | `@global-success-background` | component |

### Warning

| Variable | Value | Sources |
|----------|-------|---------|
| `@alert-warning-background` | `lighten(tint(@global-warning-background, 45%), 15%)` | component |
| `@alert-warning-color` | `@global-warning-background` | component |

---

## Align

**3 variables** (0 with overrides)

### Margin

| Variable | Value | Sources |
|----------|-------|---------|
| `@align-margin-horizontal` | `@global-gutter` | component |
| `@align-margin-horizontal-l` | `@global-medium-gutter` | component |
| `@align-margin-vertical` | `@global-gutter` | component |

---

## Animation

**10 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-glitch-text-shadow` | `2px` | master |
| `@internal-glitch-text-shadow-color-1` | `@global-primary-background` | master |
| `@internal-glitch-text-shadow-color-2` | `@global-secondary-background` | master |

### Duration

| Variable | Value | Sources |
|----------|-------|---------|
| `@animation-duration` | `0.5s` | component |
| `@animation-fade-duration` | `0.8s` | component |
| `@animation-fast-duration` | `0.1s` | component |
| `@animation-kenburns-duration` | `15s` | component |
| `@animation-stroke-duration` | `2s` | component |

### Slide

| Variable | Value | Sources |
|----------|-------|---------|
| `@animation-slide-medium-translate` | `50px` | component |
| `@animation-slide-small-translate` | `10px` | component |

---

## Article

**23 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@article-margin-top` | `@global-large-margin` | component |
| `@article-margin-top-m` | `@article-margin-top` | master |
| `@article-meta-link-color` ⚡ | `@article-meta-color` | theme, master |
| `@article-meta-link-hover-color` ⚡ | `@global-color` | theme, master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-article-meta-color` | `@inverse-global-muted-color` | component |

### Meta

| Variable | Value | Sources |
|----------|-------|---------|
| `@article-meta-color` | `@global-muted-color` | component |
| `@article-meta-font-size` | `@global-small-font-size` | component |
| `@article-meta-line-height` | `1.4` | component |

### Title

| Variable | Value | Sources |
|----------|-------|---------|
| `@article-title-font-size` | `@article-title-font-size-m * 0.85` | component |
| `@article-title-font-size-m` | `@global-2xlarge-font-size` | component |
| `@article-title-line-height` | `1.2` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@article-meta-font-family` | `@global-secondary-font-family` | master |
| `@article-meta-font-style` | `@global-secondary-font-style` | master |
| `@article-meta-font-weight` | `@global-secondary-font-weight` | master |
| `@article-meta-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@article-meta-text-transform` | `@global-secondary-text-transform` | master |
| `@article-title-color` | `@global-emphasis-color` | master |
| `@article-title-font-family` | `@global-primary-font-family` | master |
| `@article-title-font-style` | `@global-primary-font-style` | master |
| `@article-title-font-weight` | `@global-primary-font-weight` | master |
| `@article-title-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@article-title-text-transform` | `@global-primary-text-transform` | master |
| `@inverse-article-title-color` | `@inverse-global-emphasis-color` | master |

---

## Background

**4 variables** (0 with overrides)

### Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@background-default-background` | `@global-background` | component |
| `@background-muted-background` | `@global-muted-background` | component |
| `@background-primary-background` | `@global-primary-background` | component |
| `@background-secondary-background` | `@global-secondary-background` | component |

---

## Badge

**18 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-badge-gradient` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@badge-background` | `@global-primary-background` | component |
| `@badge-border-radius` | `500px` | component |
| `@badge-color` | `@global-inverse-color` | component |
| `@badge-font-size` | `11px` | component |
| `@badge-font-weight` | `normal` | master |
| `@badge-padding-horizontal` | `5px` | component |
| `@badge-padding-vertical` | `0` | component |
| `@badge-size` | `18px` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@badge-border` | `transparent` | master |
| `@badge-border-width` | `0` | master |
| `@inverse-badge-border` | `transparent` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@badge-box-shadow` | `none` | master |
| `@inverse-badge-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-badge-background` | `@inverse-global-primary-background` | component |
| `@inverse-badge-color` | `@inverse-global-inverse-color` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@badge-font-family` | `@global-secondary-font-family` | master |
| `@badge-font-style` | `@global-secondary-font-style` | master |

---

## Base

**161 variables** (12 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-blockquote-background` | `transparent` | master |
| `@base-blockquote-footer-em-dash` | `true` | master |
| `@base-blockquote-padding-left` | `0` | master |
| `@base-blockquote-padding-right` | `0` | master |
| `@base-blockquote-padding-vertical` | `0` | master |
| `@base-code-background` ⚡ | `transparent` | theme, master |
| `@base-code-padding-horizontal` ⚡ | `0` | theme, master |
| `@base-code-padding-vertical` ⚡ | `0` | theme, master |
| `@base-pre-background` ⚡ | `transparent` | theme, master |
| `@base-pre-padding` ⚡ | `0` | theme, master |
| `@internal-base-body-mode` | `none` | master |
| `@internal-base-body-overlay-background-repeat` | `repeat` | master |
| `@internal-base-body-overlay-background-size` | `auto` | master |
| `@internal-base-body-overlay-blend-mode` | `~''` | master |
| `@internal-base-body-overlay-image` | `~''` | master |
| `@internal-base-body-overlay-image-2` | `~''` | master |
| `@internal-base-body-overlay-opacity` | `0.1` | master |
| `@internal-base-body-overlay-z-index` | `@global-z-index + 100` | master |
| `@inverse-base-blockquote-background` | `transparent` | master |
| `@inverse-base-code-background` | `transparent` | master |

### Blockquote

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-blockquote-font-size` | `@global-medium-font-size` | component |
| `@base-blockquote-font-style` | `italic` | component |
| `@base-blockquote-footer-font-size` | `@global-small-font-size` | component |
| `@base-blockquote-footer-line-height` | `1.5` | component |
| `@base-blockquote-footer-margin-top` | `@global-small-margin` | component |
| `@base-blockquote-line-height` | `1.5` | component |
| `@base-blockquote-margin-vertical` | `@global-margin` | component |

### Body

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-body-background` | `@global-background` | component |
| `@base-body-color` | `@global-color` | component |
| `@base-body-font-family` | `@global-font-family` | component |
| `@base-body-font-size` | `@global-font-size` | component |
| `@base-body-font-weight` | `normal` | component |
| `@base-body-line-height` | `@global-line-height` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-blockquote-border` | `transparent` | master |
| `@base-blockquote-border-mode` | `~''` | master |
| `@base-blockquote-border-width` | `0` | master |
| `@base-code-border` | `transparent` | master |
| `@base-code-border-width` | `0` | master |
| `@base-pre-border` ⚡ | `transparent` | theme, master |
| `@base-pre-border-mode` | `~''` | master |
| `@base-pre-border-width` ⚡ | `0` | theme, master |
| `@inverse-base-blockquote-border` | `transparent` | master |
| `@inverse-base-code-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-code-border-radius` | `0` | master |
| `@base-pre-border-radius` ⚡ | `0` | theme, master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-hr-box-shadow` | `none` | master |
| `@inverse-base-hr-box-shadow` | `none` | master |

### Focus

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-focus-outline` | `@global-emphasis-color` | component |
| `@base-focus-outline-offset` | `1px` | component |
| `@base-focus-outline-style` | `dotted` | component |
| `@base-focus-outline-width` | `2px` | component |
| `@base-selection-background` | `#39f` | component |
| `@base-selection-color` | `@global-inverse-color` | component |

### Headings

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-h1-font-size` | `@base-h1-font-size-m * 0.85` | component |
| `@base-h1-font-size-m` | `@global-2xlarge-font-size` | component |
| `@base-h1-line-height` | `1.2` | component |
| `@base-h2-font-size` | `@base-h2-font-size-m * 0.85` | component |
| `@base-h2-font-size-m` | `@global-xlarge-font-size` | component |
| `@base-h2-line-height` | `1.3` | component |
| `@base-h3-font-size` | `@global-large-font-size` | component |
| `@base-h3-line-height` | `1.4` | component |
| `@base-h4-font-size` | `@global-medium-font-size` | component |
| `@base-h4-line-height` | `1.4` | component |
| `@base-h5-font-size` | `@global-font-size` | component |
| `@base-h5-line-height` | `1.4` | component |
| `@base-h6-font-size` | `@global-small-font-size` | component |
| `@base-h6-line-height` | `1.4` | component |
| `@base-heading-color` | `@global-emphasis-color` | component |
| `@base-heading-font-family` | `@global-font-family` | component |
| `@base-heading-font-weight` | `normal` | component |
| `@base-heading-margin-top` | `@global-medium-margin` | component |
| `@base-heading-text-transform` | `none` | component |

### Horizontal Rule

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-hr-border` | `@global-border` | component |
| `@base-hr-border-width` | `@global-border-width` | component |
| `@base-hr-margin-vertical` | `@global-margin` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-base-code-color` | `@inverse-global-color` | component |
| `@inverse-base-color` | `@inverse-global-color` | component |
| `@inverse-base-em-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-base-focus-outline` | `@inverse-global-emphasis-color` | component |
| `@inverse-base-heading-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-base-hr-border` | `@inverse-global-border` | component |
| `@inverse-base-link-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-base-link-hover-color` | `@inverse-global-emphasis-color` | component |

### Links

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-link-color` | `@global-link-color` | component |
| `@base-link-hover-color` | `@global-link-hover-color` | component |
| `@base-link-hover-text-decoration` | `underline` | component |
| `@base-link-text-decoration` | `none` | component |

### Lists

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-list-padding-left` | `30px` | component |

### Margins

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-margin-vertical` | `@global-margin` | component |

### Preformatted

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-pre-color` | `@global-color` | component |
| `@base-pre-font-family` | `@base-code-font-family` | component |
| `@base-pre-font-size` | `@global-small-font-size` | component |
| `@base-pre-line-height` | `1.5` | component |

### Text Elements

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-code-color` | `@global-danger-background` | component |
| `@base-code-font-family` | `Consolas, monaco, monospace` | component |
| `@base-code-font-size` | `@global-small-font-size` | component |
| `@base-em-color` | `@global-danger-background` | component |
| `@base-ins-background` | `#ffd` | component |
| `@base-ins-color` | `@global-color` | component |
| `@base-mark-background` | `#ffd` | component |
| `@base-mark-color` | `@global-color` | component |
| `@base-quote-font-style` | `italic` | component |
| `@base-small-font-size` | `80%` | component |
| `@base-strong-font-weight` | `bolder` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@base-blockquote-color` ⚡ | `@global-emphasis-color` | theme, master |
| `@base-blockquote-font-family` | `@global-primary-font-family` | master |
| `@base-blockquote-font-weight` | `@global-primary-font-weight` | master |
| `@base-blockquote-footer-color` ⚡ | `@global-color` | theme, master |
| `@base-blockquote-footer-font-family` | `@global-secondary-font-family` | master |
| `@base-blockquote-footer-font-style` | `inherit` | master |
| `@base-blockquote-footer-font-weight` | `@global-secondary-font-weight` | master |
| `@base-blockquote-footer-letter-spacing` | `inherit` | master |
| `@base-blockquote-footer-text-transform` | `@global-secondary-text-transform` | master |
| `@base-blockquote-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@base-blockquote-text-transform` | `@global-primary-text-transform` | master |
| `@base-h1-color` | `@base-heading-color` | master |
| `@base-h1-font-family` | `@global-primary-font-family` | master |
| `@base-h1-font-style` | `@global-primary-font-style` | master |
| `@base-h1-font-weight` | `@global-primary-font-weight` | master |
| `@base-h1-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@base-h1-text-transform` | `@global-primary-text-transform` | master |
| `@base-h2-color` | `@base-heading-color` | master |
| `@base-h2-font-family` | `@global-primary-font-family` | master |
| `@base-h2-font-style` | `@global-primary-font-style` | master |
| `@base-h2-font-weight` | `@global-primary-font-weight` | master |
| `@base-h2-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@base-h2-text-transform` | `@global-primary-text-transform` | master |
| `@base-h3-color` | `@base-heading-color` | master |
| `@base-h3-font-family` | `@global-primary-font-family` | master |
| `@base-h3-font-style` | `@global-primary-font-style` | master |
| `@base-h3-font-weight` | `@global-primary-font-weight` | master |
| `@base-h3-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@base-h3-text-transform` | `@global-primary-text-transform` | master |
| `@base-h4-color` | `@base-heading-color` | master |
| `@base-h4-font-family` | `@global-secondary-font-family` | master |
| `@base-h4-font-style` | `@global-secondary-font-style` | master |
| `@base-h4-font-weight` | `@global-secondary-font-weight` | master |
| `@base-h4-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@base-h4-text-transform` | `@global-secondary-text-transform` | master |
| `@base-h5-color` | `@base-heading-color` | master |
| `@base-h5-font-family` | `@global-secondary-font-family` | master |
| `@base-h5-font-style` | `@global-secondary-font-style` | master |
| `@base-h5-font-weight` | `@global-secondary-font-weight` | master |
| `@base-h5-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@base-h5-text-transform` | `@global-secondary-text-transform` | master |
| `@base-h6-color` | `@base-heading-color` | master |
| `@base-h6-font-family` | `@global-secondary-font-family` | master |
| `@base-h6-font-style` | `@global-secondary-font-style` | master |
| `@base-h6-font-weight` | `@global-secondary-font-weight` | master |
| `@base-h6-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@base-h6-text-transform` | `@global-secondary-text-transform` | master |
| `@base-heading-font-style` | `@global-primary-font-style` | master |
| `@base-heading-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@inverse-base-blockquote-color` ⚡ | `@inverse-global-emphasis-color` | theme, master |
| `@inverse-base-blockquote-footer-color` ⚡ | `@inverse-global-color` | theme, master |
| `@inverse-base-h1-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-base-h2-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-base-h3-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-base-h4-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-base-h5-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-base-h6-color` | `@inverse-global-emphasis-color` | master |

---

## Breadcrumb

**22 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-breadcrumb-divider-background-image` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@breadcrumb-item-active-text-decoration` | `none` | master |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@breadcrumb-divider` | `"/"` | component |
| `@breadcrumb-divider-color` | `@global-muted-color` | component |
| `@breadcrumb-divider-font-size` | `@breadcrumb-item-font-size` | component |
| `@breadcrumb-divider-margin-horizontal` | `20px` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-breadcrumb-divider-color` | `@inverse-global-muted-color` | component |
| `@inverse-breadcrumb-item-active-color` | `@inverse-global-color` | component |
| `@inverse-breadcrumb-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-breadcrumb-item-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@breadcrumb-item-active-color` | `@global-color` | component |
| `@breadcrumb-item-color` | `@global-muted-color` | component |
| `@breadcrumb-item-font-size` | `@global-small-font-size` | component |
| `@breadcrumb-item-hover-color` | `@global-color` | component |
| `@breadcrumb-item-hover-text-decoration` | `none` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@breadcrumb-item-disabled-color` | `@breadcrumb-item-color` | master |
| `@breadcrumb-item-font-family` | `@global-secondary-font-family` | master |
| `@breadcrumb-item-font-style` | `@global-secondary-font-style` | master |
| `@breadcrumb-item-font-weight` | `@global-secondary-font-weight` | master |
| `@breadcrumb-item-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@breadcrumb-item-text-transform` | `@global-secondary-text-transform` | master |
| `@inverse-breadcrumb-item-disabled-color` | `@inverse-breadcrumb-item-color` | master |

---

## Button

**227 variables** (25 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-background-position-x` | `0` | master |
| `@button-background-size` | `auto` | master |
| `@button-hover-background-position-x` | `0` | master |
| `@internal-button-danger-active-gradient` | `~''` | master |
| `@internal-button-danger-gradient` | `~''` | master |
| `@internal-button-danger-hover-gradient` | `~''` | master |
| `@internal-button-default-active-gradient` | `~''` | master |
| `@internal-button-default-gradient` | `~''` | master |
| `@internal-button-default-hover-gradient` | `~''` | master |
| `@internal-button-primary-active-gradient` | `~''` | master |
| `@internal-button-primary-gradient` | `~''` | master |
| `@internal-button-primary-hover-gradient` | `~''` | master |
| `@internal-button-secondary-active-gradient` | `~''` | master |
| `@internal-button-secondary-gradient` | `~''` | master |
| `@internal-button-secondary-hover-gradient` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-danger-backdrop-filter` | `~''` | master |
| `@button-default-backdrop-filter` | `~''` | master |
| `@button-disabled-backdrop-filter` | `~''` | master |
| `@button-primary-backdrop-filter` | `~''` | master |
| `@button-secondary-backdrop-filter` | `~''` | master |
| `@button-text-border` ⚡ | `currentColor` | theme, master |
| `@button-text-border-width` ⚡ | `@global-border-width` | theme, master |
| `@button-text-hover-border` | `currentColor` | master |
| `@button-text-icon-mode` | `~''` | master |
| `@button-text-mode` | `line` | master |
| `@button-transition-duration` | `0.1s` | master |
| `@internal-button-default-glow-filter` | `~''` | master |
| `@internal-button-default-glow-gradient` | `~''` | master |
| `@internal-button-default-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-button-default-hover-glitch-duration` | `0.2s` | master |
| `@internal-button-default-hover-glow-filter` | `~''` | master |
| `@internal-button-default-hover-mode` | `~''` | master |
| `@internal-button-default-mode` | `~''` | master |
| `@internal-button-mode` | `~''` | master |
| `@internal-button-primary-glow-filter` | `~''` | master |
| `@internal-button-primary-glow-gradient` | `~''` | master |
| `@internal-button-primary-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-button-primary-hover-glitch-duration` | `0.2s` | master |
| `@internal-button-primary-hover-glow-filter` | `~''` | master |
| `@internal-button-primary-hover-mode` | `~''` | master |
| `@internal-button-primary-mode` | `~''` | master |
| `@internal-button-ripple-position-x` | `50%` | master |
| `@internal-button-ripple-position-y` | `100%` | master |
| `@internal-button-ripple-transition-duration` | `0.5s` | master |
| `@internal-button-ripple-transition-timing-function` | `cubic-bezier(.165,.85,.45,1)` | master |
| `@internal-button-secondary-glow-filter` | `~''` | master |
| `@internal-button-secondary-glow-gradient` | `~''` | master |
| `@internal-button-secondary-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-button-secondary-hover-glitch-duration` | `0.2s` | master |
| `@internal-button-secondary-hover-glow-filter` | `~''` | master |
| `@internal-button-secondary-hover-mode` | `~''` | master |
| `@internal-button-secondary-mode` | `~''` | master |
| `@internal-button-text-arrow-background` | `transparent` | master |
| `@internal-button-text-arrow-border-radius` | `0` | master |
| `@internal-button-text-arrow-color` | `@button-text-color` | master |
| `@internal-button-text-arrow-hover-color` | `@button-text-hover-color` | master |
| `@internal-button-text-arrow-hover-width` | `@internal-button-text-arrow-width` | master |
| `@internal-button-text-arrow-image` | `"../../../../uikit-themes/master/images/button-text-arrow...` | master |
| `@internal-button-text-arrow-image-offset` | `5px` | master |
| `@internal-button-text-arrow-image-position` | `100%` | master |
| `@internal-button-text-arrow-padding` | `5px` | master |
| `@internal-button-text-arrow-position` | `right` | master |
| `@internal-button-text-arrow-transition-duration` | `0.2s` | master |
| `@internal-button-text-arrow-transition-timing-function` | `ease-out` | master |
| `@internal-button-text-arrow-width` | `22px` | master |
| `@internal-button-text-dash-padding` | `8px` | master |
| `@internal-button-text-dash-size` | `20px` | master |
| `@internal-button-text-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-button-text-hover-glitch-duration` | `0.2s` | master |
| `@internal-button-text-hover-mode` | `~''` | master |
| `@internal-button-text-line-bottom` | `0` | master |
| `@internal-button-text-line-hover-left` | `0` | master |
| `@internal-button-text-line-hover-right` | `0` | master |
| `@internal-button-text-line-left` | `0` | master |
| `@internal-button-text-line-right` | `100%` | master |
| `@internal-button-text-line-transition-duration` | `0.3s` | master |
| `@internal-button-text-line-transition-timing-function` | `ease-out` | master |
| `@internal-inverse-button-default-glow-gradient` | `~''` | master |
| `@internal-inverse-button-primary-glow-gradient` | `~''` | master |
| `@internal-inverse-button-secondary-glow-gradient` | `~''` | master |
| `@internal-inverse-button-text-arrow-background` | `transparent` | master |
| `@internal-inverse-button-text-arrow-color` | `@inverse-button-text-color` | master |
| `@internal-inverse-button-text-arrow-hover-color` | `@inverse-button-text-hover-color` | master |
| `@inverse-button-text-border` | `currentColor` | master |
| `@inverse-button-text-hover-border` | `currentColor` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-border-mode` | `~''` | master |
| `@button-border-width` ⚡ | `0` | theme, master |
| `@button-danger-active-border` | `transparent` | master |
| `@button-danger-border` | `transparent` | master |
| `@button-danger-hover-border` | `transparent` | master |
| `@button-default-active-border` ⚡ | `transparent` | theme, master |
| `@button-default-border` ⚡ | `transparent` | theme, master |
| `@button-default-hover-border` ⚡ | `transparent` | theme, master |
| `@button-disabled-border` ⚡ | `transparent` | theme, master |
| `@button-large-line-height` ⚡ | `@global-control-large-height - (@button-border-width * 2)` | component, theme, master |
| `@button-line-height` ⚡ | `@global-control-height - (@button-border-width * 2)` | component, theme, master |
| `@button-primary-active-border` | `transparent` | master |
| `@button-primary-border` | `transparent` | master |
| `@button-primary-hover-border` | `transparent` | master |
| `@button-secondary-active-border` | `transparent` | master |
| `@button-secondary-border` | `transparent` | master |
| `@button-secondary-hover-border` | `transparent` | master |
| `@button-small-line-height` ⚡ | `@global-control-small-height - (@button-border-width * 2)` | component, theme, master |
| `@internal-button-border-image-repeat` | `~''` | master |
| `@internal-button-border-image-slice` | `~''` | master |
| `@internal-button-border-image-width` | `~''` | master |
| `@internal-button-danger-active-border-gradient` | `~''` | master |
| `@internal-button-danger-border-gradient` | `~''` | master |
| `@internal-button-danger-border-image` | `~''` | master |
| `@internal-button-danger-hover-border-gradient` | `~''` | master |
| `@internal-button-default-active-border-gradient` | `~''` | master |
| `@internal-button-default-border-gradient` | `~''` | master |
| `@internal-button-default-border-image` | `~''` | master |
| `@internal-button-default-hover-border-gradient` | `~''` | master |
| `@internal-button-primary-active-border-gradient` | `~''` | master |
| `@internal-button-primary-border-gradient` | `~''` | master |
| `@internal-button-primary-border-image` | `~''` | master |
| `@internal-button-primary-hover-border-gradient` | `~''` | master |
| `@internal-button-secondary-active-border-gradient` | `~''` | master |
| `@internal-button-secondary-border-gradient` | `~''` | master |
| `@internal-button-secondary-border-image` | `~''` | master |
| `@internal-button-secondary-hover-border-gradient` | `~''` | master |
| `@inverse-button-default-active-border` | `transparent` | master |
| `@inverse-button-default-border` | `transparent` | master |
| `@inverse-button-default-hover-border` | `transparent` | master |
| `@inverse-button-primary-active-border` | `transparent` | master |
| `@inverse-button-primary-border` | `transparent` | master |
| `@inverse-button-primary-hover-border` | `transparent` | master |
| `@inverse-button-secondary-active-border` | `transparent` | master |
| `@inverse-button-secondary-border` | `transparent` | master |
| `@inverse-button-secondary-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-border-radius` | `0` | master |
| `@button-large-border-radius` | `0` | master |
| `@button-small-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-danger-active-box-shadow` | `none` | master |
| `@button-danger-box-shadow` | `none` | master |
| `@button-danger-hover-box-shadow` | `none` | master |
| `@button-default-active-box-shadow` | `none` | master |
| `@button-default-box-shadow` | `none` | master |
| `@button-default-hover-box-shadow` | `none` | master |
| `@button-primary-active-box-shadow` | `none` | master |
| `@button-primary-box-shadow` | `none` | master |
| `@button-primary-hover-box-shadow` | `none` | master |
| `@button-secondary-active-box-shadow` | `none` | master |
| `@button-secondary-box-shadow` | `none` | master |
| `@button-secondary-hover-box-shadow` | `none` | master |
| `@inverse-button-default-active-box-shadow` | `none` | master |
| `@inverse-button-default-box-shadow` | `none` | master |
| `@inverse-button-default-hover-box-shadow` | `none` | master |
| `@inverse-button-primary-active-box-shadow` | `none` | master |
| `@inverse-button-primary-box-shadow` | `none` | master |
| `@inverse-button-primary-hover-box-shadow` | `none` | master |
| `@inverse-button-secondary-active-box-shadow` | `none` | master |
| `@inverse-button-secondary-box-shadow` | `none` | master |
| `@inverse-button-secondary-hover-box-shadow` | `none` | master |

### Danger Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-danger-active-background` | `darken(@button-danger-background, 10%)` | component |
| `@button-danger-active-color` | `@global-inverse-color` | component |
| `@button-danger-background` | `@global-danger-background` | component |
| `@button-danger-color` | `@global-inverse-color` | component |
| `@button-danger-hover-background` | `darken(@button-danger-background, 5%)` | component |
| `@button-danger-hover-color` | `@global-inverse-color` | component |

### Default Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-default-active-background` ⚡ | `transparent` | component, theme |
| `@button-default-active-color` | `@global-emphasis-color` | component |
| `@button-default-background` ⚡ | `transparent` | component, theme |
| `@button-default-color` | `@global-emphasis-color` | component |
| `@button-default-hover-background` ⚡ | `transparent` | component, theme |
| `@button-default-hover-color` | `@global-emphasis-color` | component |

### Disabled

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-disabled-background` ⚡ | `transparent` | component, theme |
| `@button-disabled-color` | `@global-muted-color` | component |

### Inverse - Default

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-button-default-active-background` ⚡ | `transparent` | component, theme |
| `@inverse-button-default-active-color` ⚡ | `@inverse-global-emphasis-color` | component, theme |
| `@inverse-button-default-background` ⚡ | `transparent` | component, theme |
| `@inverse-button-default-color` ⚡ | `@inverse-global-emphasis-color` | component, theme |
| `@inverse-button-default-hover-background` ⚡ | `transparent` | component, theme |
| `@inverse-button-default-hover-color` ⚡ | `@inverse-global-emphasis-color` | component, theme |

### Inverse - Primary

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-button-primary-active-background` | `darken(@inverse-button-primary-background, 10%)` | component |
| `@inverse-button-primary-active-color` | `@inverse-global-inverse-color` | component |
| `@inverse-button-primary-background` | `@inverse-global-primary-background` | component |
| `@inverse-button-primary-color` | `@inverse-global-inverse-color` | component |
| `@inverse-button-primary-hover-background` | `darken(@inverse-button-primary-background, 5%)` | component |
| `@inverse-button-primary-hover-color` | `@inverse-global-inverse-color` | component |

### Inverse - Secondary

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-button-secondary-active-background` | `darken(@inverse-button-secondary-background, 10%)` | component |
| `@inverse-button-secondary-active-color` | `@inverse-global-inverse-color` | component |
| `@inverse-button-secondary-background` | `@inverse-global-primary-background` | component |
| `@inverse-button-secondary-color` | `@inverse-global-inverse-color` | component |
| `@inverse-button-secondary-hover-background` | `darken(@inverse-button-secondary-background, 5%)` | component |
| `@inverse-button-secondary-hover-color` | `@inverse-global-inverse-color` | component |

### Inverse - Text & Link

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-button-link-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-button-link-hover-color` | `@inverse-global-muted-color` | component |
| `@inverse-button-text-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-button-text-disabled-color` | `@inverse-global-muted-color` | component |
| `@inverse-button-text-hover-color` ⚡ | `@inverse-global-emphasis-color` | component, theme, master |

### Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-large-font-size` ⚡ | `@global-small-font-size` | component, theme |
| `@button-large-padding-horizontal` | `@global-medium-gutter` | component |

### Link Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-link-color` | `@global-emphasis-color` | component |
| `@button-link-disabled-color` | `@global-muted-color` | component |
| `@button-link-hover-color` | `@global-muted-color` | component |
| `@button-link-hover-text-decoration` | `none` | component |
| `@button-link-line-height` | `@global-line-height` | component |

### Primary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-primary-active-background` | `darken(@button-primary-background, 10%)` | component |
| `@button-primary-active-color` | `@global-inverse-color` | component |
| `@button-primary-background` | `@global-primary-background` | component |
| `@button-primary-color` | `@global-inverse-color` | component |
| `@button-primary-hover-background` | `darken(@button-primary-background, 5%)` | component |
| `@button-primary-hover-color` | `@global-inverse-color` | component |

### Secondary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-secondary-active-background` | `darken(@button-secondary-background, 10%)` | component |
| `@button-secondary-active-color` | `@global-inverse-color` | component |
| `@button-secondary-background` | `@global-secondary-background` | component |
| `@button-secondary-color` | `@global-inverse-color` | component |
| `@button-secondary-hover-background` | `darken(@button-secondary-background, 5%)` | component |
| `@button-secondary-hover-color` | `@global-inverse-color` | component |

### Sizing

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-font-size` ⚡ | `@global-small-font-size` | component, theme |
| `@button-padding-horizontal` | `@global-gutter` | component |

### Small

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-small-font-size` | `@global-small-font-size` | component |
| `@button-small-padding-horizontal` | `@global-small-gutter` | component |

### Text Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-text-color` | `@global-emphasis-color` | component |
| `@button-text-disabled-color` | `@global-muted-color` | component |
| `@button-text-hover-color` ⚡ | `@global-emphasis-color` | component, theme, master |
| `@button-text-line-height` | `@global-line-height` | component |

### Transform

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-default-hover-translate-vertical` | `0` | master |
| `@button-primary-hover-translate-vertical` | `0` | master |
| `@button-secondary-hover-translate-vertical` | `0` | master |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@button-font-family` | `@global-secondary-font-family` | master |
| `@button-font-style` | `@global-secondary-font-style` | master |
| `@button-font-weight` | `@global-secondary-font-weight` | master |
| `@button-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@button-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |

---

## Card

**152 variables** (20 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-card-badge-background-image` | `~''` | master |
| `@internal-card-badge-gradient` | `~''` | master |
| `@internal-card-default-gradient` | `~''` | master |
| `@internal-card-default-hover-gradient` | `~''` | master |
| `@internal-card-overlay-gradient` | `~''` | master |
| `@internal-card-overlay-hover-gradient` | `~''` | master |
| `@internal-card-primary-gradient` | `~''` | master |
| `@internal-card-primary-hover-gradient` | `~''` | master |
| `@internal-card-secondary-gradient` | `~''` | master |
| `@internal-card-secondary-hover-gradient` | `~''` | master |

### Badge

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-badge-background` | `@global-primary-background` | component |
| `@card-badge-color` | `@global-inverse-color` | component |
| `@card-badge-font-size` | `@global-small-font-size` | component |
| `@card-badge-height` | `22px` | component |
| `@card-badge-padding-horizontal` | `10px` | component |
| `@card-badge-right` | `15px` | component |
| `@card-badge-top` | `15px` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-default-backdrop-filter` | `~''` | master |
| `@card-default-footer-border` ⚡ | `@global-border` | theme, master |
| `@card-default-footer-border-width` ⚡ | `@global-border-width` | theme, master |
| `@card-default-header-border` ⚡ | `@global-border` | theme, master |
| `@card-default-header-border-width` ⚡ | `@global-border-width` | theme, master |
| `@card-overlay-backdrop-filter` | `~''` | master |
| `@card-overlay-hover-inverse-background` | `@card-overlay-hover-background` | master |
| `@card-overlay-inverse-background` | `@card-overlay-background` | master |
| `@card-primary-backdrop-filter` | `~''` | master |
| `@card-secondary-backdrop-filter` | `~''` | master |
| `@card-transition-duration` | `0.1s` | master |
| `@internal-card-default-glow-filter` | `~''` | master |
| `@internal-card-default-glow-gradient` | `~''` | master |
| `@internal-card-default-hover-glow-filter` | `~''` | master |
| `@internal-card-default-mode` | `~''` | master |
| `@internal-card-hover-mode` | `~''` | master |
| `@internal-card-overlay-backdrop-filter` | `~''` | master |
| `@internal-card-overlay-glow-filter` | `~''` | master |
| `@internal-card-overlay-glow-gradient` | `~''` | master |
| `@internal-card-overlay-hover-glow-filter` | `~''` | master |
| `@internal-card-overlay-mode` | `~''` | master |
| `@internal-card-primary-glow-filter` | `~''` | master |
| `@internal-card-primary-glow-gradient` | `~''` | master |
| `@internal-card-primary-hover-glow-filter` | `~''` | master |
| `@internal-card-primary-mode` | `~''` | master |
| `@internal-card-secondary-glow-filter` | `~''` | master |
| `@internal-card-secondary-glow-gradient` | `~''` | master |
| `@internal-card-secondary-hover-glow-filter` | `~''` | master |
| `@internal-card-secondary-mode` | `~''` | master |

### Body

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-body-padding-horizontal` | `@global-gutter` | component |
| `@card-body-padding-horizontal-l` | `@global-medium-gutter` | component |
| `@card-body-padding-vertical` | `@global-gutter` | component |
| `@card-body-padding-vertical-l` | `@global-medium-gutter` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-badge-border` | `transparent` | master |
| `@card-badge-border-mode` | `~''` | master |
| `@card-badge-border-width` | `0` | master |
| `@card-default-border` | `transparent` | master |
| `@card-default-border-mode` | `~''` | master |
| `@card-default-border-width` | `0` | master |
| `@card-default-hover-border` | `transparent` | master |
| `@card-hover-border` | `transparent` | master |
| `@card-hover-border-mode` | `~''` | master |
| `@card-hover-border-width` | `0` | master |
| `@card-overlay-border` | `transparent` | master |
| `@card-overlay-border-mode` | `~''` | master |
| `@card-overlay-border-width` | `0` | master |
| `@card-overlay-hover-border` | `transparent` | master |
| `@card-primary-border` | `transparent` | master |
| `@card-primary-border-mode` | `~''` | master |
| `@card-primary-border-width` | `0` | master |
| `@card-primary-hover-border` | `transparent` | master |
| `@card-secondary-border` | `transparent` | master |
| `@card-secondary-border-mode` | `~''` | master |
| `@card-secondary-border-width` | `0` | master |
| `@card-secondary-hover-border` | `transparent` | master |
| `@internal-card-border-image-repeat` | `~''` | master |
| `@internal-card-border-image-slice` | `~''` | master |
| `@internal-card-border-image-width` | `~''` | master |
| `@internal-card-default-border-image` | `~''` | master |
| `@internal-card-hover-border-image` | `~''` | master |
| `@internal-card-overlay-border-image` | `~''` | master |
| `@internal-card-primary-border-image` | `~''` | master |
| `@internal-card-secondary-border-image` | `~''` | master |
| `@inverse-card-badge-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-badge-border-radius` ⚡ | `0` | theme, master |
| `@card-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-default-box-shadow` ⚡ | `none` | theme, master |
| `@card-default-hover-box-shadow` ⚡ | `none` | theme, master |
| `@card-hover-box-shadow` ⚡ | `none` | theme, master |
| `@card-overlay-box-shadow` ⚡ | `none` | theme, master |
| `@card-overlay-hover-box-shadow` ⚡ | `none` | theme, master |
| `@card-primary-box-shadow` ⚡ | `none` | theme, master |
| `@card-primary-hover-box-shadow` ⚡ | `none` | theme, master |
| `@card-secondary-box-shadow` ⚡ | `none` | theme, master |
| `@card-secondary-hover-box-shadow` ⚡ | `none` | theme, master |
| `@internal-card-hover-transition-box-shadow` | `0 0 0 rgba(0, 0, 0, 0), 0 0 0 rgba(0, 0, 0, 0)` | master |

### Default Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-default-background` ⚡ | `@global-background` | component, theme |
| `@card-default-color` | `@global-color` | component |
| `@card-default-color-mode` | `dark` | component |
| `@card-default-hover-background` ⚡ | `@card-default-background` | component, theme |
| `@card-default-title-color` | `@global-emphasis-color` | component |

### Footer

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-footer-padding-horizontal` | `@global-gutter` | component |
| `@card-footer-padding-horizontal-l` | `@global-medium-gutter` | component |
| `@card-footer-padding-vertical` | `(@global-gutter / 2)` | component |
| `@card-footer-padding-vertical-l` | `round((@global-medium-gutter / 2))` | component |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-header-padding-horizontal` | `@global-gutter` | component |
| `@card-header-padding-horizontal-l` | `@global-medium-gutter` | component |
| `@card-header-padding-vertical` | `round((@global-gutter / 2))` | component |
| `@card-header-padding-vertical-l` | `round((@global-medium-gutter / 2))` | component |

### Hover

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-hover-background` ⚡ | `@global-background` | component, theme |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-card-badge-background` | `@inverse-global-primary-background` | component |
| `@inverse-card-badge-color` | `@inverse-global-inverse-color` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-large-body-padding-horizontal-l` | `@global-large-gutter` | component |
| `@card-large-body-padding-vertical-l` | `@global-large-gutter` | component |
| `@card-large-footer-padding-horizontal-l` | `@global-large-gutter` | component |
| `@card-large-footer-padding-vertical-l` | `round((@global-large-gutter / 2))` | component |
| `@card-large-header-padding-horizontal-l` | `@global-large-gutter` | component |
| `@card-large-header-padding-vertical-l` | `round((@global-large-gutter / 2))` | component |

### Overlay Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-overlay-background` | `fade(@global-background, 90%)` | component |
| `@card-overlay-color` | `@global-color` | component |
| `@card-overlay-color-mode` | `dark` | component |
| `@card-overlay-hover-background` | `fadein(@card-overlay-background, 10%)` | component |
| `@card-overlay-title-color` | `@global-emphasis-color` | component |

### Primary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-primary-background` | `@global-primary-background` | component |
| `@card-primary-color` | `@global-inverse-color` | component |
| `@card-primary-color-mode` | `light` | component |
| `@card-primary-hover-background` ⚡ | `@card-primary-background` | component, theme |
| `@card-primary-title-color` | `@card-primary-color` | component |

### Secondary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-secondary-background` | `@global-secondary-background` | component |
| `@card-secondary-color` | `@global-inverse-color` | component |
| `@card-secondary-color-mode` | `light` | component |
| `@card-secondary-hover-background` ⚡ | `@card-secondary-background` | component, theme |
| `@card-secondary-title-color` | `@card-secondary-color` | component |

### Small Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-small-body-padding-horizontal` | `@global-margin` | component |
| `@card-small-body-padding-vertical` | `@global-margin` | component |
| `@card-small-footer-padding-horizontal` | `@global-margin` | component |
| `@card-small-footer-padding-vertical` | `round((@global-margin / 1.5))` | component |
| `@card-small-header-padding-horizontal` | `@global-margin` | component |
| `@card-small-header-padding-vertical` | `round((@global-margin / 1.5))` | component |

### Title

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-title-font-size` | `@global-large-font-size` | component |
| `@card-title-line-height` | `1.4` | component |

### Transform

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-default-hover-translate-vertical` | `0` | master |
| `@card-hover-translate-vertical` | `0` | master |
| `@card-overlay-hover-translate-vertical` | `0` | master |
| `@card-primary-hover-translate-vertical` | `0` | master |
| `@card-secondary-hover-translate-vertical` | `0` | master |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@card-badge-font-family` | `@global-secondary-font-family` | master |
| `@card-badge-font-weight` | `@global-secondary-font-weight` | master |
| `@card-badge-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@card-badge-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |
| `@card-title-font-family` | `@global-primary-font-family` | master |
| `@card-title-font-style` | `@global-primary-font-style` | master |
| `@card-title-font-weight` | `@global-primary-font-weight` | master |
| `@card-title-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@card-title-text-transform` | `@global-primary-text-transform` | master |

---

## Close

**4 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@close-color` | `@global-muted-color` | component |
| `@close-hover-color` | `@global-color` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-close-color` | `@inverse-global-muted-color` | component |
| `@inverse-close-hover-color` | `@inverse-global-color` | component |

---

## Column

**5 variables** (0 with overrides)

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@column-divider-rule-color` | `@global-border` | component |
| `@column-divider-rule-width` | `1px` | component |

### Gutter

| Variable | Value | Sources |
|----------|-------|---------|
| `@column-gutter` | `@global-gutter` | component |
| `@column-gutter-l` | `@global-medium-gutter` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-column-divider-rule-color` | `@inverse-global-border` | component |

---

## Comment

**18 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-primary-background` ⚡ | `@global-muted-background` | theme, master |
| `@comment-primary-padding` ⚡ | `@global-gutter` | theme, master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-primary-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-primary-box-shadow` | `none` | master |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-header-margin-bottom` | `@global-margin` | component |

### List

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-list-margin-top` | `@global-large-margin` | component |
| `@comment-list-padding-left` | `30px` | component |
| `@comment-list-padding-left-m` | `100px` | component |

### Meta

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-meta-color` | `@global-muted-color` | component |
| `@comment-meta-font-size` | `@global-small-font-size` | component |
| `@comment-meta-line-height` | `1.4` | component |

### Title

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-title-font-size` | `@global-medium-font-size` | component |
| `@comment-title-line-height` | `1.4` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@comment-meta-font-family` | `@global-secondary-font-family` | master |
| `@comment-meta-font-style` | `@global-secondary-font-style` | master |
| `@comment-meta-font-weight` | `@global-secondary-font-weight` | master |
| `@comment-meta-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@comment-meta-text-transform` | `@global-secondary-text-transform` | master |

---

## Container

**8 variables** (0 with overrides)

### Max Width

| Variable | Value | Sources |
|----------|-------|---------|
| `@container-large-max-width` | `1400px` | component |
| `@container-max-width` | `1200px` | component |
| `@container-small-max-width` | `900px` | component |
| `@container-xlarge-max-width` | `1600px` | component |
| `@container-xsmall-max-width` | `750px` | component |

### Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@container-padding-horizontal` | `15px` | component |
| `@container-padding-horizontal-m` | `@global-medium-gutter` | component |
| `@container-padding-horizontal-s` | `@global-gutter` | component |

---

## Countdown

**2 variables** (0 with overrides)

### Separator

| Variable | Value | Sources |
|----------|-------|---------|
| `@countdown-separator-font-size` | `0.5em` | component |
| `@countdown-separator-line-height` | `2` | component |

---

## Description-list

**18 variables** (3 with overrides)

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@description-list-divider-term-box-shadow` | `none` | master |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@description-list-divider-term-border` | `@global-border` | component |
| `@description-list-divider-term-border-width` | `@global-border-width` | component |
| `@description-list-divider-term-margin-top` | `@global-margin` | component |

### Term

| Variable | Value | Sources |
|----------|-------|---------|
| `@description-list-term-color` | `@global-emphasis-color` | component |
| `@description-list-term-margin-top` | `@global-margin` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@description-list-description-font-family` | `inherit` | master |
| `@description-list-description-font-size` | `@global-font-size` | master |
| `@description-list-description-font-style` | `inherit` | master |
| `@description-list-description-font-weight` | `inherit` | master |
| `@description-list-description-letter-spacing` | `inherit` | master |
| `@description-list-description-text-transform` | `inherit` | master |
| `@description-list-term-font-family` | `@global-secondary-font-family` | master |
| `@description-list-term-font-size` ⚡ | `@global-font-size` | theme, master |
| `@description-list-term-font-style` | `@global-secondary-font-style` | master |
| `@description-list-term-font-weight` ⚡ | `@global-secondary-font-weight` | theme, master |
| `@description-list-term-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@description-list-term-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |

---

## Divider

**30 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@divider-margin-vertical` | `@global-margin` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-divider-icon-line-left-border-gradient` | `~''` | master |
| `@internal-divider-icon-line-right-border-gradient` | `~''` | master |
| `@internal-divider-small-border-gradient` | `~''` | master |
| `@internal-divider-small-image` | `~''` | master |
| `@internal-divider-vertical-border-gradient` | `~''` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@divider-icon-line-box-shadow` | `none` | master |
| `@divider-small-box-shadow` | `none` | master |
| `@divider-vertical-box-shadow` | `none` | master |
| `@inverse-divider-icon-line-box-shadow` | `none` | master |
| `@inverse-divider-small-box-shadow` | `none` | master |
| `@inverse-divider-vertical-box-shadow` | `none` | master |

### Icon Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@divider-icon-color` | `@global-border` | component |
| `@divider-icon-height` | `20px` | component |
| `@divider-icon-line-border` | `@global-border` | component |
| `@divider-icon-line-border-width` | `@global-border-width` | component |
| `@divider-icon-line-top` | `50%` | component |
| `@divider-icon-line-width` | `100%` | component |
| `@divider-icon-width` | `50px` | component |

### Internal

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-divider-icon-image` | `"../../images/backgrounds/divider-icon.svg"` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-divider-icon-color` | `@inverse-global-border` | component |
| `@inverse-divider-icon-line-border` | `@inverse-global-border` | component |
| `@inverse-divider-small-border` | `@inverse-global-border` | component |
| `@inverse-divider-vertical-border` | `@inverse-global-border` | component |

### Small Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@divider-small-border` | `@global-border` | component |
| `@divider-small-border-width` | `@global-border-width` | component |
| `@divider-small-width` | `100px` | component |

### Vertical Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@divider-vertical-border` | `@global-border` | component |
| `@divider-vertical-border-width` | `@global-border-width` | component |
| `@divider-vertical-height` | `100px` | component |

---

## Dotnav

**33 variables** (7 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@dotnav-margin-horizontal` | `12px` | component |
| `@dotnav-margin-vertical` | `@dotnav-margin-horizontal` | component |
| `@internal-dotnav-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-dotnav-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-dotnav-item-hover-mode` | `~''` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@dotnav-item-active-border` ⚡ | `transparent` | theme, master |
| `@dotnav-item-border` ⚡ | `transparent` | theme, master |
| `@dotnav-item-border-width` ⚡ | `0` | theme, master |
| `@dotnav-item-hover-border` ⚡ | `transparent` | theme, master |
| `@dotnav-item-onclick-border` ⚡ | `transparent` | theme, master |
| `@inverse-dotnav-item-active-border` | `transparent` | master |
| `@inverse-dotnav-item-border` | `transparent` | master |
| `@inverse-dotnav-item-hover-border` | `transparent` | master |
| `@inverse-dotnav-item-onclick-border` | `transparent` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@dotnav-item-active-box-shadow` | `none` | master |
| `@dotnav-item-box-shadow` | `none` | master |
| `@dotnav-item-hover-box-shadow` | `none` | master |
| `@dotnav-item-onclick-box-shadow` | `none` | master |
| `@inverse-dotnav-item-active-box-shadow` | `none` | master |
| `@inverse-dotnav-item-box-shadow` | `none` | master |
| `@inverse-dotnav-item-hover-box-shadow` | `none` | master |
| `@inverse-dotnav-item-onclick-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-dotnav-item-active-background` | `fade(@inverse-global-color, 90%)` | component |
| `@inverse-dotnav-item-background` ⚡ | `transparent` | component, theme |
| `@inverse-dotnav-item-hover-background` | `fade(@inverse-global-color, 90%)` | component |
| `@inverse-dotnav-item-onclick-background` | `fade(@inverse-global-color, 50%)` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@dotnav-item-active-background` | `fade(@global-color, 60%)` | component |
| `@dotnav-item-background` ⚡ | `transparent` | component, theme |
| `@dotnav-item-border-radius` | `50%` | component |
| `@dotnav-item-height` | `@dotnav-item-width` | component |
| `@dotnav-item-hover-background` | `fade(@global-color, 60%)` | component |
| `@dotnav-item-onclick-background` | `fade(@global-color, 20%)` | component |
| `@dotnav-item-width` | `10px` | component |

---

## Drop

**5 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@drop-margin` | `@global-margin` | component |
| `@drop-viewport-margin` | `15px` | component |
| `@drop-width` | `300px` | component |
| `@drop-z-index` | `@global-z-index + 20` | component |

### Parent Icon

| Variable | Value | Sources |
|----------|-------|---------|
| `@drop-parent-icon-margin-left` | `0.25em` | component |

---

## Dropbar

**17 variables** (6 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropbar-backdrop-filter` | `~''` | master |
| `@dropbar-background` ⚡ | `@global-background` | component, theme |
| `@dropbar-color` | `@global-color` | component |
| `@dropbar-color-mode` | `dark` | component |
| `@dropbar-focus-outline` | `@base-focus-outline` | component |
| `@dropbar-margin` | `0` | component |
| `@dropbar-padding-bottom` | `@dropbar-padding-top` | component |
| `@dropbar-padding-horizontal` | `15px` | component |
| `@dropbar-padding-horizontal-m` | `@global-medium-gutter` | component |
| `@dropbar-padding-horizontal-s` | `@global-gutter` | component |
| `@dropbar-padding-top` ⚡ | `25px` | component, theme |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropbar-bottom-box-shadow` ⚡ | `none` | theme, master |
| `@dropbar-left-box-shadow` ⚡ | `none` | theme, master |
| `@dropbar-right-box-shadow` ⚡ | `none` | theme, master |
| `@dropbar-top-box-shadow` ⚡ | `none` | theme, master |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropbar-large-padding-bottom` | `@dropbar-large-padding-top` | component |
| `@dropbar-large-padding-top` | `40px` | component |

---

## Dropdown

**50 variables** (6 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-backdrop-filter` | `~''` | master |
| `@dropdown-background` ⚡ | `@global-background` | component, theme |
| `@dropdown-color` | `@global-color` | component |
| `@dropdown-color-mode` | `dark` | component |
| `@dropdown-focus-outline` | `@base-focus-outline` | component |
| `@dropdown-margin` | `@global-small-margin` | component |
| `@dropdown-min-width` | `200px` | component |
| `@dropdown-nav-divider-margin-horizontal` | `0` | master |
| `@dropdown-nav-item-hover-background` | `transparent` | master |
| `@dropdown-nav-item-padding-horizontal` | `@nav-item-padding-horizontal` | master |
| `@dropdown-nav-item-padding-vertical` | `@nav-item-padding-vertical` | master |
| `@dropdown-nav-margin-horizontal` | `0` | master |
| `@dropdown-nav-sublist-padding-left` | `(@dropdown-nav-item-padding-horizontal + @nav-sublist-dee...` | master |
| `@dropdown-padding` ⚡ | `25px` | component, theme |
| `@dropdown-viewport-margin` | `15px` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-border` | `transparent` | master |
| `@dropdown-border-width` | `0` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-box-shadow` ⚡ | `none` | theme, master |
| `@dropdown-nav-divider-box-shadow` | `none` | master |

### Dropbar

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-dropbar-margin` | `@dropdown-margin` | component |
| `@dropdown-dropbar-padding-bottom` | `@dropdown-padding` | component |
| `@dropdown-dropbar-padding-top` ⚡ | `5px` | component, theme |
| `@dropdown-dropbar-viewport-margin` | `15px` | component |
| `@dropdown-dropbar-viewport-margin-m` | `@global-medium-gutter` | component |
| `@dropdown-dropbar-viewport-margin-s` | `@global-gutter` | component |

### Dropbar Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-dropbar-large-padding-bottom` | `@dropdown-large-padding` | component |
| `@dropdown-dropbar-large-padding-top` | `@dropdown-large-padding` | component |

### Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-large-padding` | `40px` | component |

### Nav

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-nav-divider-border` | `@global-border` | component |
| `@dropdown-nav-divider-border-width` | `@global-border-width` | component |
| `@dropdown-nav-header-color` | `@global-emphasis-color` | component |
| `@dropdown-nav-item-color` | `@global-muted-color` | component |
| `@dropdown-nav-item-hover-color` | `@global-color` | component |
| `@dropdown-nav-sublist-item-color` | `@global-muted-color` | component |
| `@dropdown-nav-sublist-item-hover-color` | `@global-color` | component |
| `@dropdown-nav-subtitle-font-size` ⚡ | `12px` | component, theme |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropdown-nav-font-family` | `@global-secondary-font-family` | master |
| `@dropdown-nav-font-size` ⚡ | `@global-font-size` | theme, master |
| `@dropdown-nav-font-style` | `@global-secondary-font-style` | master |
| `@dropdown-nav-font-weight` | `@global-secondary-font-weight` | master |
| `@dropdown-nav-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@dropdown-nav-subtitle-color` | `@dropdown-nav-item-color` | master |
| `@dropdown-nav-subtitle-font-family` | `inherit` | master |
| `@dropdown-nav-subtitle-font-style` | `inherit` | master |
| `@dropdown-nav-subtitle-font-weight` | `inherit` | master |
| `@dropdown-nav-subtitle-letter-spacing` | `inherit` | master |
| `@dropdown-nav-subtitle-line-height` | `inherit` | master |
| `@dropdown-nav-subtitle-text-transform` | `inherit` | master |
| `@dropdown-nav-text-transform` | `@global-secondary-text-transform` | master |

---

## Dropnav

**1 variables** (0 with overrides)

### Dropbar

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropnav-dropbar-z-index` | `@global-z-index - 20` | component |

---

## Form

**124 variables** (23 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-backdrop-filter` | `~''` | master |
| `@form-danger-focus-background` | `inherit` | master |
| `@form-label-font-size` ⚡ | `@global-font-size` | theme, master |
| `@form-success-focus-background` | `inherit` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-blank-focus-border` ⚡ | `transparent` | theme, master |
| `@form-blank-focus-border-style` ⚡ | `solid` | theme, master |
| `@form-border` ⚡ | `transparent` | theme, master |
| `@form-border-mode` | `~''` | master |
| `@form-border-width` ⚡ | `0` | theme, master |
| `@form-danger-border` ⚡ | `transparent` | theme, master |
| `@form-disabled-border` ⚡ | `transparent` | theme, master |
| `@form-focus-border` ⚡ | `transparent` | theme, master |
| `@form-large-line-height` ⚡ | `@form-large-height - (@form-border-width * 2)` | component, theme, master |
| `@form-line-height` ⚡ | `@form-height - (@form-border-width * 2)` | component, theme, master |
| `@form-multi-line-border-mode` | `~''` | master |
| `@form-radio-border` ⚡ | `transparent` | theme, master |
| `@form-radio-border-width` ⚡ | `0` | theme, master |
| `@form-radio-checked-border` ⚡ | `transparent` | theme, master |
| `@form-radio-disabled-border` ⚡ | `transparent` | theme, master |
| `@form-radio-focus-border` ⚡ | `transparent` | theme, master |
| `@form-small-line-height` ⚡ | `@form-small-height - (@form-border-width * 2)` | component, theme, master |
| `@form-success-border` ⚡ | `transparent` | theme, master |
| `@inverse-form-border` | `transparent` | master |
| `@inverse-form-focus-border` | `transparent` | master |
| `@inverse-form-radio-border` | `transparent` | master |
| `@inverse-form-radio-checked-border` | `transparent` | master |
| `@inverse-form-radio-focus-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-border-radius` | `0` | master |
| `@form-multi-line-border-radius` | `~''` | master |
| `@form-radio-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-blank-focus-box-shadow` | `none` | master |
| `@form-box-shadow` | `none` | master |
| `@form-danger-box-shadow` | `none` | master |
| `@form-disabled-box-shadow` | `none` | master |
| `@form-focus-box-shadow` | `none` | master |
| `@form-radio-box-shadow` | `none` | master |
| `@form-radio-checked-box-shadow` | `none` | master |
| `@form-radio-focus-box-shadow` | `none` | master |
| `@form-success-box-shadow` | `none` | master |
| `@inverse-form-box-shadow` | `none` | master |
| `@inverse-form-focus-box-shadow` | `none` | master |
| `@inverse-form-radio-box-shadow` | `none` | master |
| `@inverse-form-radio-checked-box-shadow` | `none` | master |
| `@inverse-form-radio-focus-box-shadow` | `none` | master |

### Datalist

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-datalist-icon-color` | `@global-color` | component |
| `@form-datalist-padding-right` | `20px` | component |

### Disabled

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-disabled-background` | `@global-muted-background` | component |
| `@form-disabled-color` | `@global-muted-color` | component |

### Focus

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-focus-background` ⚡ | `@global-background` | component, theme |
| `@form-focus-color` | `@global-color` | component |

### Icon

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-icon-color` | `@global-muted-color` | component |
| `@form-icon-hover-color` | `@global-color` | component |
| `@form-icon-width` | `@form-height` | component |

### Input Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-background` ⚡ | `@global-background` | component, theme |
| `@form-color` | `@global-color` | component |
| `@form-height` | `@global-control-height` | component |
| `@form-padding-horizontal` | `10px` | component |

### Internal

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-form-checkbox-image` | `"../../images/backgrounds/form-checkbox.svg"` | component |
| `@internal-form-checkbox-indeterminate-image` | `"../../images/backgrounds/form-checkbox-indeterminate.svg"` | component |
| `@internal-form-datalist-image` | `"../../images/backgrounds/form-datalist.svg"` | component |
| `@internal-form-radio-image` | `"../../images/backgrounds/form-radio.svg"` | component |
| `@internal-form-select-image` | `"../../images/backgrounds/form-select.svg"` | component |

### Inverse - Icons

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-form-icon-color` | `@inverse-global-muted-color` | component |
| `@inverse-form-icon-hover-color` | `@inverse-global-color` | component |

### Inverse - Input

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-form-background` | `@inverse-global-muted-background` | component |
| `@inverse-form-color` | `@inverse-global-color` | component |
| `@inverse-form-focus-background` | `fadein(@inverse-form-background, 5%)` | component |
| `@inverse-form-focus-color` | `@inverse-global-color` | component |
| `@inverse-form-placeholder-color` | `@inverse-global-muted-color` | component |

### Inverse - Radio & Checkbox

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-form-radio-background` | `@inverse-global-muted-background` | component |
| `@inverse-form-radio-checked-background` | `@inverse-global-primary-background` | component |
| `@inverse-form-radio-checked-focus-background` | `fadein(@inverse-global-primary-background, 10%)` | component |
| `@inverse-form-radio-checked-icon-color` | `@inverse-global-inverse-color` | component |
| `@inverse-form-radio-focus-background` | `fadein(@inverse-form-radio-background, 5%)` | component |

### Inverse - Select & Datalist

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-form-datalist-icon-color` | `@inverse-global-color` | component |
| `@inverse-form-select-icon-color` | `@inverse-global-color` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-large-font-size` | `@global-medium-font-size` | component |
| `@form-large-height` | `@global-control-large-height` | component |
| `@form-large-multi-line-padding-horizontal` | `@form-large-padding-horizontal` | component |
| `@form-large-multi-line-padding-vertical` | `round(@form-large-multi-line-padding-horizontal * 0.6)` | component |
| `@form-large-padding-horizontal` | `12px` | component |
| `@form-large-radio-size` | `22px` | component |

### Layout

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-horizontal-controls-margin-left` | `215px` | component |
| `@form-horizontal-controls-text-padding-top` | `7px` | component |
| `@form-horizontal-label-margin-top` | `7px` | component |
| `@form-horizontal-label-width` | `200px` | component |
| `@form-stacked-margin-bottom` ⚡ | `5px` | component, theme |

### Legend

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-legend-font-size` | `@global-large-font-size` | component |
| `@form-legend-line-height` | `1.4` | component |

### Multi-line

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-multi-line-padding-horizontal` | `@form-padding-horizontal` | component |
| `@form-multi-line-padding-vertical` | `round(@form-multi-line-padding-horizontal * 0.6)` | component |

### Placeholder

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-placeholder-color` | `@global-muted-color` | component |

### Radio & Checkbox

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-radio-background` ⚡ | `transparent` | component, theme |
| `@form-radio-checked-background` | `@global-primary-background` | component |
| `@form-radio-checked-focus-background` | `darken(@global-primary-background, 10%)` | component |
| `@form-radio-checked-icon-color` | `@global-inverse-color` | component |
| `@form-radio-disabled-background` | `@global-muted-background` | component |
| `@form-radio-disabled-icon-color` | `@global-muted-color` | component |
| `@form-radio-focus-background` | `darken(@form-radio-background, 5%)` | component |
| `@form-radio-margin-top` | `-4px` | component |
| `@form-radio-size` | `16px` | component |

### Select

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-select-disabled-icon-color` | `@global-muted-color` | component |
| `@form-select-icon-color` | `@global-color` | component |
| `@form-select-option-color` | `@global-color` | component |
| `@form-select-padding-right` | `20px` | component |

### Small Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-small-font-size` | `@global-small-font-size` | component |
| `@form-small-height` | `@global-control-small-height` | component |
| `@form-small-multi-line-padding-horizontal` | `@form-small-padding-horizontal` | component |
| `@form-small-multi-line-padding-vertical` | `round(@form-small-multi-line-padding-horizontal * 0.6)` | component |
| `@form-small-padding-horizontal` | `8px` | component |
| `@form-small-radio-size` | `14px` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-label-color` ⚡ | `@global-emphasis-color` | theme, master |
| `@form-label-font-family` | `@global-secondary-font-family` | master |
| `@form-label-font-style` | `@global-secondary-font-style` | master |
| `@form-label-font-weight` | `@global-secondary-font-weight` | master |
| `@form-label-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@form-label-text-transform` | `@global-secondary-text-transform` | master |
| `@inverse-form-label-color` ⚡ | `@inverse-global-emphasis-color` | theme, master |

### Validation

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-danger-color` | `@global-danger-background` | component |
| `@form-success-color` | `@global-success-background` | component |

### Widths

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-width-large` | `500px` | component |
| `@form-width-medium` | `200px` | component |
| `@form-width-small` | `130px` | component |
| `@form-width-xsmall` | `50px` | component |

---

## Form-range

**21 variables** (6 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-form-range-thumb-background-image` | `~''` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-range-thumb-border` ⚡ | `transparent` | theme, master |
| `@form-range-thumb-border-width` ⚡ | `0` | theme, master |
| `@inverse-form-range-thumb-border` ⚡ | `darken(fadein(@inverse-global-border, 100%), 10%)` | theme, master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-range-track-border-radius` ⚡ | `500px` | theme, master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-range-thumb-box-shadow` | `none` | master |
| `@form-range-track-box-shadow` | `none` | master |
| `@form-range-track-focus-box-shadow` | `none` | master |
| `@inverse-form-range-thumb-box-shadow` | `none` | master |
| `@inverse-form-range-track-box-shadow` | `none` | master |
| `@inverse-form-range-track-focus-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-form-range-thumb-background` ⚡ | `darken(fadein(@inverse-global-color, 100%), 50%)` | component, theme |
| `@inverse-form-range-track-background` | `darken(@inverse-global-muted-background, 5%)` | component |
| `@inverse-form-range-track-focus-background` | `fadein(@inverse-form-range-track-background, 5%)` | component |

### Thumb

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-range-thumb-background` ⚡ | `@global-background` | component, theme |
| `@form-range-thumb-border-radius` | `500px` | component |
| `@form-range-thumb-height` | `15px` | component |
| `@form-range-thumb-width` | `@form-range-thumb-height` | component |

### Track

| Variable | Value | Sources |
|----------|-------|---------|
| `@form-range-track-background` | `darken(@global-muted-background, 5%)` | component |
| `@form-range-track-focus-background` | `darken(@form-range-track-background, 5%)` | component |
| `@form-range-track-height` | `3px` | component |

---

## Grid

**21 variables** (0 with overrides)

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-grid-divider-horizontal-border-gradient` | `~''` | master |
| `@internal-grid-divider-vertical-border-gradient` | `~''` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-divider-horizontal-box-shadow` | `none` | master |
| `@grid-divider-vertical-box-shadow` | `none` | master |
| `@inverse-grid-divider-horizontal-box-shadow` | `none` | master |
| `@inverse-grid-divider-vertical-box-shadow` | `none` | master |

### Default Gutter

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-gutter-horizontal` | `@global-gutter` | component |
| `@grid-gutter-horizontal-l` | `@global-medium-gutter` | component |
| `@grid-gutter-vertical` | `@grid-gutter-horizontal` | component |
| `@grid-gutter-vertical-l` | `@grid-gutter-horizontal-l` | component |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-divider-border` | `@global-border` | component |
| `@grid-divider-border-width` | `@global-border-width` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-grid-divider-border` | `@inverse-global-border` | component |

### Large Gutter

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-large-gutter-horizontal` | `@global-medium-gutter` | component |
| `@grid-large-gutter-horizontal-l` | `@global-large-gutter` | component |
| `@grid-large-gutter-vertical` | `@grid-large-gutter-horizontal` | component |
| `@grid-large-gutter-vertical-l` | `@grid-large-gutter-horizontal-l` | component |

### Medium Gutter

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-medium-gutter-horizontal` | `@global-gutter` | component |
| `@grid-medium-gutter-vertical` | `@grid-medium-gutter-horizontal` | component |

### Small Gutter

| Variable | Value | Sources |
|----------|-------|---------|
| `@grid-small-gutter-horizontal` | `@global-small-gutter` | component |
| `@grid-small-gutter-vertical` | `@grid-small-gutter-horizontal` | component |

---

## Heading

**104 variables** (0 with overrides)

### 2X-Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-2xlarge-font-size` | `@heading-xlarge-font-size-m` | component |
| `@heading-2xlarge-font-size-l` | `11rem` | component |
| `@heading-2xlarge-font-size-m` | `@heading-xlarge-font-size-l` | component |
| `@heading-2xlarge-line-height` | `1` | component |

### 3X-Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-3xlarge-font-size` | `@heading-2xlarge-font-size-m` | component |
| `@heading-3xlarge-font-size-l` | `15rem` | component |
| `@heading-3xlarge-font-size-m` | `@heading-2xlarge-font-size-l` | component |
| `@heading-3xlarge-line-height` | `1` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-heading-2xlarge-mode` | `none` | master |
| `@internal-heading-3xlarge-mode` | `none` | master |
| `@internal-heading-glitch-animation` | `uk-glitch-text-shadow` | master |
| `@internal-heading-glitch-duration` | `0.65s` | master |
| `@internal-heading-large-mode` | `none` | master |
| `@internal-heading-medium-mode` | `none` | master |
| `@internal-heading-small-mode` | `none` | master |
| `@internal-heading-xlarge-mode` | `none` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-heading-bullet-border-image` | `~''` | master |
| `@internal-heading-bullet-border-image-repeat` | `~''` | master |
| `@internal-heading-bullet-border-image-slice` | `~''` | master |
| `@internal-heading-bullet-border-image-width` | `~''` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-divider-box-shadow` | `none` | master |
| `@heading-line-box-shadow` | `none` | master |
| `@inverse-heading-divider-box-shadow` | `none` | master |
| `@inverse-heading-line-box-shadow` | `none` | master |

### Bullet Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-bullet-border` | `@global-border` | component |
| `@heading-bullet-border-width` | `~'calc(5px + 0.1em)'` | component |
| `@heading-bullet-height` | `~'calc(4px + 0.7em)'` | component |
| `@heading-bullet-margin-right` | `~'calc(5px + 0.2em)'` | component |
| `@heading-bullet-top` | `~'calc(-0.1 * 1em)'` | component |

### Divider Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-divider-border` | `@global-border` | component |
| `@heading-divider-border-width` | `~'calc(0.2px + 0.05em)'` | component |
| `@heading-divider-padding-bottom` | `~'calc(5px + 0.1em)'` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-heading-bullet-border` | `@inverse-global-border` | component |
| `@inverse-heading-divider-border` | `@inverse-global-border` | component |
| `@inverse-heading-line-border` | `@inverse-global-border` | component |

### Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-large-font-size` | `@heading-large-font-size-m * 0.85` | component |
| `@heading-large-font-size-l` | `6rem` | component |
| `@heading-large-font-size-m` | `@heading-medium-font-size-l` | component |
| `@heading-large-line-height` | `1.1` | component |

### Line Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-line-border` | `@global-border` | component |
| `@heading-line-border-width` | `~'calc(0.2px + 0.05em)'` | component |
| `@heading-line-height` | `@heading-line-border-width` | component |
| `@heading-line-margin-horizontal` | `~'calc(5px + 0.3em)'` | component |
| `@heading-line-top` | `50%` | component |
| `@heading-line-width` | `2000px` | component |

### Medium

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-medium-font-size` | `@heading-medium-font-size-m * 0.825` | component |
| `@heading-medium-font-size-l` | `4rem` | component |
| `@heading-medium-font-size-m` | `@heading-medium-font-size-l * 0.875` | component |
| `@heading-medium-line-height` | `1.1` | component |

### Small

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-small-font-size` | `@heading-small-font-size-m * 0.8` | component |
| `@heading-small-font-size-m` | `@heading-medium-font-size-l * 0.8125` | component |
| `@heading-small-line-height` | `1.2` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-2xlarge-color` | `@global-emphasis-color` | master |
| `@heading-2xlarge-font-family` | `@global-primary-font-family` | master |
| `@heading-2xlarge-font-style` | `@global-primary-font-style` | master |
| `@heading-2xlarge-font-weight` | `@global-primary-font-weight` | master |
| `@heading-2xlarge-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-2xlarge-text-shadow` | `none` | master |
| `@heading-2xlarge-text-transform` | `@global-primary-text-transform` | master |
| `@heading-3xlarge-color` | `@global-emphasis-color` | master |
| `@heading-3xlarge-font-family` | `@global-primary-font-family` | master |
| `@heading-3xlarge-font-style` | `@global-primary-font-style` | master |
| `@heading-3xlarge-font-weight` | `@global-primary-font-weight` | master |
| `@heading-3xlarge-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-3xlarge-text-shadow` | `none` | master |
| `@heading-3xlarge-text-transform` | `@global-primary-text-transform` | master |
| `@heading-large-color` | `@global-emphasis-color` | master |
| `@heading-large-font-family` | `@global-primary-font-family` | master |
| `@heading-large-font-style` | `@global-primary-font-style` | master |
| `@heading-large-font-weight` | `@global-primary-font-weight` | master |
| `@heading-large-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-large-text-shadow` | `none` | master |
| `@heading-large-text-transform` | `@global-primary-text-transform` | master |
| `@heading-medium-color` | `@global-emphasis-color` | master |
| `@heading-medium-font-family` | `@global-primary-font-family` | master |
| `@heading-medium-font-style` | `@global-primary-font-style` | master |
| `@heading-medium-font-weight` | `@global-primary-font-weight` | master |
| `@heading-medium-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-medium-text-shadow` | `none` | master |
| `@heading-medium-text-transform` | `@global-primary-text-transform` | master |
| `@heading-small-color` | `@global-emphasis-color` | master |
| `@heading-small-font-family` | `@global-primary-font-family` | master |
| `@heading-small-font-style` | `@global-primary-font-style` | master |
| `@heading-small-font-weight` | `@global-primary-font-weight` | master |
| `@heading-small-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-small-text-shadow` | `none` | master |
| `@heading-small-text-transform` | `@global-primary-text-transform` | master |
| `@heading-xlarge-color` | `@global-emphasis-color` | master |
| `@heading-xlarge-font-family` | `@global-primary-font-family` | master |
| `@heading-xlarge-font-style` | `@global-primary-font-style` | master |
| `@heading-xlarge-font-weight` | `@global-primary-font-weight` | master |
| `@heading-xlarge-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@heading-xlarge-text-shadow` | `none` | master |
| `@heading-xlarge-text-transform` | `@global-primary-text-transform` | master |
| `@inverse-heading-2xlarge-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-heading-3xlarge-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-heading-large-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-heading-medium-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-heading-small-color` | `@inverse-global-emphasis-color` | master |
| `@inverse-heading-xlarge-color` | `@inverse-global-emphasis-color` | master |

### X-Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@heading-xlarge-font-size` | `@heading-large-font-size-m` | component |
| `@heading-xlarge-font-size-l` | `8rem` | component |
| `@heading-xlarge-font-size-m` | `@heading-large-font-size-l` | component |
| `@heading-xlarge-line-height` | `1` | component |

---

## Height

**3 variables** (0 with overrides)

### Size Modifiers

| Variable | Value | Sources |
|----------|-------|---------|
| `@height-large-height` | `450px` | component |
| `@height-medium-height` | `300px` | component |
| `@height-small-height` | `150px` | component |

---

## Icon

**55 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-icon-button-active-gradient` | `~''` | master |
| `@internal-icon-button-gradient` | `~''` | master |
| `@internal-icon-button-hover-gradient` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-button-backdrop-filter` | `~''` | master |
| `@icon-button-transition-duration` | `0.1s` | master |
| `@internal-icon-button-glow-filter` | `~''` | master |
| `@internal-icon-button-glow-gradient` | `~''` | master |
| `@internal-icon-button-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-icon-button-hover-glitch-duration` | `0.2s` | master |
| `@internal-icon-button-hover-glow-filter` | `~''` | master |
| `@internal-icon-button-hover-mode` | `~''` | master |
| `@internal-icon-button-mode` | `~''` | master |
| `@internal-inverse-icon-button-glow-gradient` | `~''` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-button-active-border` | `transparent` | master |
| `@icon-button-border` | `transparent` | master |
| `@icon-button-border-width` | `0` | master |
| `@icon-button-hover-border` | `transparent` | master |
| `@internal-icon-button-border-image` | `~''` | master |
| `@internal-icon-button-border-image-repeat` | `~''` | master |
| `@internal-icon-button-border-image-slice` | `~''` | master |
| `@internal-icon-button-border-image-width` | `~''` | master |
| `@inverse-icon-button-active-border` | `transparent` | master |
| `@inverse-icon-button-border` | `transparent` | master |
| `@inverse-icon-button-hover-border` | `transparent` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-button-active-box-shadow` | `none` | master |
| `@icon-button-box-shadow` | `none` | master |
| `@icon-button-hover-box-shadow` | `none` | master |
| `@inverse-icon-button-active-box-shadow` | `none` | master |
| `@inverse-icon-button-box-shadow` | `none` | master |
| `@inverse-icon-button-hover-box-shadow` | `none` | master |

### Button Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-button-active-background` | `darken(@icon-button-background, 10%)` | component |
| `@icon-button-active-color` | `@global-color` | component |
| `@icon-button-background` | `@global-muted-background` | component |
| `@icon-button-border-radius` | `500px` | component |
| `@icon-button-color` | `@global-muted-color` | component |
| `@icon-button-hover-background` | `darken(@icon-button-background, 5%)` | component |
| `@icon-button-hover-color` | `@global-color` | component |
| `@icon-button-size` | `36px` | component |

### Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-image-size` | `20px` | component |

### Inverse - Button

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-icon-button-active-background` | `fadein(@inverse-icon-button-background, 10%)` | component |
| `@inverse-icon-button-active-color` | `@inverse-global-color` | component |
| `@inverse-icon-button-background` | `@inverse-global-muted-background` | component |
| `@inverse-icon-button-color` | `@inverse-global-muted-color` | component |
| `@inverse-icon-button-hover-background` | `fadein(@inverse-icon-button-background, 5%)` | component |
| `@inverse-icon-button-hover-color` | `@inverse-global-color` | component |

### Inverse - Link

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-icon-link-active-color` | `@inverse-global-color` | component |
| `@inverse-icon-link-color` | `@inverse-global-muted-color` | component |
| `@inverse-icon-link-hover-color` | `@inverse-global-color` | component |

### Inverse - Overlay

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-icon-overlay-color` | `fade(@inverse-global-emphasis-color, 60%)` | component |
| `@inverse-icon-overlay-hover-color` | `@inverse-global-emphasis-color` | component |

### Link Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-link-active-color` | `darken(@global-color, 5%)` | component |
| `@icon-link-color` | `@global-muted-color` | component |
| `@icon-link-hover-color` | `@global-color` | component |

### Overlay Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@icon-overlay-color` | `fade(@global-emphasis-color, 60%)` | component |
| `@icon-overlay-hover-color` | `@global-emphasis-color` | component |

---

## Iconnav

**15 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@iconnav-margin-horizontal` | `@global-small-margin` | component |
| `@iconnav-margin-vertical` | `@iconnav-margin-horizontal` | component |
| `@iconnav-siblings-filter` | `~''` | master |
| `@iconnav-siblings-opacity` | `1` | master |
| `@subnav-item-font-size` | `@global-small-font-size` | theme |
| `@internal-iconnav-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-iconnav-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-iconnav-item-hover-mode` | `~''` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-iconnav-item-active-color` | `@inverse-global-color` | component |
| `@inverse-iconnav-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-iconnav-item-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@iconnav-item-active-color` | `@global-color` | component |
| `@iconnav-item-color` | `@global-muted-color` | component |
| `@iconnav-item-hover-color` | `@global-color` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@iconnav-item-font-size` | `@global-small-font-size` | master |

---

## Inverse

**8 variables** (0 with overrides)

### Backgrounds

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-global-muted-background` | `fade(@global-inverse-color, 10%)` | component |
| `@inverse-global-primary-background` | `@global-inverse-color` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-global-border` | `fade(@global-inverse-color, 20%)` | component |

### Color Mode

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-global-color-mode` | `light` | component |

### Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-global-color` | `fade(@global-inverse-color, 70%)` | component |
| `@inverse-global-emphasis-color` | `@global-inverse-color` | component |
| `@inverse-global-inverse-color` | `@global-color` | component |
| `@inverse-global-muted-color` | `fade(@global-inverse-color, 50%)` | component |

---

## Label

**31 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-background` | `@global-primary-background` | component |
| `@label-color` | `@global-inverse-color` | component |
| `@label-font-size` | `@global-small-font-size` | component |
| `@label-line-height` | `@global-line-height` | component |
| `@label-padding-horizontal` | `@global-small-margin` | component |
| `@label-padding-vertical` | `0` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-border` | `transparent` | master |
| `@label-border-width` | `0` | master |
| `@label-danger-border` | `transparent` | master |
| `@label-success-border` | `transparent` | master |
| `@label-warning-border` | `transparent` | master |
| `@inverse-label-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-border-radius` ⚡ | `0` | theme, master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-box-shadow` | `none` | master |
| `@label-danger-box-shadow` | `none` | master |
| `@label-success-box-shadow` | `none` | master |
| `@label-warning-box-shadow` | `none` | master |
| `@inverse-label-box-shadow` | `none` | master |

### Danger

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-danger-background` | `@global-danger-background` | component |
| `@label-danger-color` | `@global-inverse-color` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-label-background` | `@inverse-global-primary-background` | component |
| `@inverse-label-color` | `@inverse-global-inverse-color` | component |

### Success

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-success-background` | `@global-success-background` | component |
| `@label-success-color` | `@global-inverse-color` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-font-family` | `@global-secondary-font-family` | master |
| `@label-font-style` | `@global-secondary-font-style` | master |
| `@label-font-weight` | `@global-secondary-font-weight` | master |
| `@label-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@label-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |

### Warning

| Variable | Value | Sources |
|----------|-------|---------|
| `@label-warning-background` | `@global-warning-background` | component |
| `@label-warning-color` | `@global-inverse-color` | component |

---

## Leader

**8 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@leader-color` | `@global-color` | master |
| `@inverse-leader-color` | `@inverse-global-color` | master |

### Fill

| Variable | Value | Sources |
|----------|-------|---------|
| `@leader-fill-content` | `~'.'` | component |
| `@leader-fill-margin-left` | `@global-small-gutter` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@leader-font-family` | `inherit` | master |
| `@leader-font-size` | `inherit` | master |
| `@leader-font-weight` | `inherit` | master |
| `@leader-letter-spacing` | `inherit` | master |

---

## Lightbox

**13 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@lightbox-backdrop-filter` | `~''` | master |
| `@lightbox-background` | `#000` | component |
| `@lightbox-color-mode` | `light` | component |
| `@lightbox-focus-outline` | `rgba(255,255,255,0.7)` | component |
| `@lightbox-z-index` | `@global-z-index + 10` | component |

### Caption

| Variable | Value | Sources |
|----------|-------|---------|
| `@lightbox-caption-background` | `rgba(0,0,0,0.3)` | component |
| `@lightbox-caption-color` | `rgba(255,255,255,0.7)` | component |
| `@lightbox-caption-padding-horizontal` | `10px` | component |
| `@lightbox-caption-padding-vertical` | `10px` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@lightbox-item-max-height` | `100vh` | component |
| `@lightbox-item-max-width` | `100vw` | component |

### Thumbnav

| Variable | Value | Sources |
|----------|-------|---------|
| `@lightbox-thumbnav-height` | `100px` | component |
| `@lightbox-thumbnav-vertical-width` | `100px` | component |

---

## Link

**19 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@link-heading-text-decoration` | `inherit` | master |
| `@internal-link-heading-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-link-heading-hover-glitch-duration` | `0.2s` | master |
| `@internal-link-heading-hover-mode` | `~''` | master |
| `@internal-link-muted-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-link-muted-hover-glitch-duration` | `0.2s` | master |
| `@internal-link-muted-hover-mode` | `~''` | master |
| `@internal-link-text-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-link-text-hover-glitch-duration` | `0.2s` | master |
| `@internal-link-text-hover-mode` | `~''` | master |

### Heading Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@link-heading-hover-color` | `@global-primary-background` | component |
| `@link-heading-hover-text-decoration` | `none` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-link-heading-hover-color` | `@inverse-global-primary-background` | component |
| `@inverse-link-muted-color` | `@inverse-global-muted-color` | component |
| `@inverse-link-muted-hover-color` | `@inverse-global-color` | component |
| `@inverse-link-text-hover-color` | `@inverse-global-muted-color` | component |

### Muted Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@link-muted-color` | `@global-muted-color` | component |
| `@link-muted-hover-color` | `@global-color` | component |

### Text Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@link-text-hover-color` | `@global-muted-color` | component |

---

## List

**31 variables** (2 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-margin-top` | `@global-small-margin` | component |
| `@list-marker-height` | `(@global-line-height * 1em)` | component |
| `@list-padding-left` | `30px` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-striped-border` ⚡ | `transparent` | theme, master |
| `@list-striped-border-width` ⚡ | `0` | theme, master |
| `@inverse-list-striped-border` | `transparent` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-divider-box-shadow` | `none` | master |
| `@inverse-list-divider-box-shadow` | `none` | master |

### Bullet

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-bullet-icon-color` | `@global-color` | component |

### Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-emphasis-color` | `@global-emphasis-color` | component |
| `@list-muted-color` | `@global-muted-color` | component |
| `@list-primary-color` | `@global-primary-background` | component |
| `@list-secondary-color` | `@global-secondary-background` | component |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-divider-border` | `@global-border` | component |
| `@list-divider-border-width` | `@global-border-width` | component |
| `@list-divider-margin-top` | `@global-small-margin` | component |

### Internal

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-list-bullet-image` | `"../../images/backgrounds/list-bullet.svg"` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-list-bullet-icon-color` | `@inverse-global-color` | component |
| `@inverse-list-divider-border` | `@inverse-global-border` | component |
| `@inverse-list-emphasis-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-list-muted-color` | `@inverse-global-muted-color` | component |
| `@inverse-list-primary-color` | `@inverse-global-primary-background` | component |
| `@inverse-list-secondary-color` | `@inverse-global-primary-background` | component |
| `@inverse-list-striped-background` | `@inverse-global-muted-background` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-large-divider-margin-top` | `@global-margin` | component |
| `@list-large-margin-top` | `@global-margin` | component |
| `@list-large-striped-padding-horizontal` | `@global-small-margin` | component |
| `@list-large-striped-padding-vertical` | `@global-margin` | component |

### Striped

| Variable | Value | Sources |
|----------|-------|---------|
| `@list-striped-background` | `@global-muted-background` | component |
| `@list-striped-padding-horizontal` | `@global-small-margin` | component |
| `@list-striped-padding-vertical` | `@global-small-margin` | component |

---

## Margin

**8 variables** (0 with overrides)

### Default

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-margin` | `@global-margin` | component |

### Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-large-margin` | `@global-medium-margin` | component |
| `@margin-large-margin-l` | `@global-large-margin` | component |

### Medium

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-medium-margin` | `@global-medium-margin` | component |

### Small

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-small-margin` | `@global-small-margin` | component |

### X-Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-xlarge-margin` | `@global-large-margin` | component |
| `@margin-xlarge-margin-l` | `@global-xlarge-margin` | component |

### X-Small

| Variable | Value | Sources |
|----------|-------|---------|
| `@margin-xsmall-margin` | `5px` | component |

---

## Marker

**18 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@marker-background` | `@global-secondary-background` | component |
| `@marker-color` | `@global-inverse-color` | component |
| `@marker-hover-background` | `@marker-background` | master |
| `@marker-hover-color` | `@global-inverse-color` | component |
| `@marker-padding` | `5px` | component |
| `@internal-marker-hover-glitch-animation` | `uk-glitch-opacity` | master |
| `@internal-marker-hover-glitch-duration` | `0.2s` | master |
| `@internal-marker-hover-mode` | `~''` | master |
| `@inverse-marker-hover-background` | `@inverse-marker-background` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@marker-border` | `transparent` | master |
| `@marker-border-width` | `0` | master |
| `@marker-hover-border` | `transparent` | master |
| `@inverse-marker-border` | `transparent` | master |
| `@inverse-marker-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@marker-border-radius` | `500px` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-marker-background` | `@global-muted-background` | component |
| `@inverse-marker-color` | `@global-color` | component |
| `@inverse-marker-hover-color` | `@global-color` | component |

---

## Mixin

**4 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@data-uri` | `data-uri('image/svg+xml` | component |
| `@escape-color-default` | `escape(@color-default)` | component |
| `@escape-color-new` | `escape("@{color-new}")` | component |
| `@replace-src` | `replace("@{data-uri}", "@{escape-color-default}", "@{esca...` | component |

---

## Modal

**47 variables** (9 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-backdrop-filter` | `~''` | master |
| `@modal-close-full-background` ⚡ | `@modal-dialog-background` | theme, master |
| `@modal-close-full-padding` ⚡ | `10px` | theme, master |
| `@modal-close-full-padding-m` ⚡ | `@global-margin` | theme, master |
| `@modal-footer-border` ⚡ | `@global-border` | theme, master |
| `@modal-footer-border-width` ⚡ | `@global-border-width` | theme, master |
| `@modal-header-border` ⚡ | `@global-border` | theme, master |
| `@modal-header-border-width` ⚡ | `@global-border-width` | theme, master |

### Body

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-body-padding-horizontal` | `20px` | component |
| `@modal-body-padding-horizontal-s` | `@global-gutter` | component |
| `@modal-body-padding-vertical` | `20px` | component |
| `@modal-body-padding-vertical-s` | `@global-gutter` | component |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-dialog-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-dialog-box-shadow` | `none` | master |

### Close Button

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-close-outside-color` | `lighten(@global-inverse-color, 20%)` | component |
| `@modal-close-outside-hover-color` | `@global-inverse-color` | component |
| `@modal-close-outside-position` | `0` | component |
| `@modal-close-outside-translate` | `100%` | component |
| `@modal-close-padding` | `5px` | component |
| `@modal-close-position` | `@global-small-margin` | component |

### Container

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-container-width` | `1200px` | component |

### Dialog

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-dialog-background` | `@global-background` | component |
| `@modal-dialog-width` | `600px` | component |

### Footer

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-footer-background` ⚡ | `@modal-dialog-background` | component, theme, master |
| `@modal-footer-padding-horizontal` | `20px` | component |
| `@modal-footer-padding-horizontal-s` | `@global-gutter` | component |
| `@modal-footer-padding-vertical` | `(@modal-footer-padding-horizontal / 2)` | component |
| `@modal-footer-padding-vertical-s` | `(@modal-footer-padding-horizontal-s / 2)` | component |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-header-background` ⚡ | `@modal-dialog-background` | component, theme, master |
| `@modal-header-padding-horizontal` | `20px` | component |
| `@modal-header-padding-horizontal-s` | `@global-gutter` | component |
| `@modal-header-padding-vertical` | `(@modal-header-padding-horizontal / 2)` | component |
| `@modal-header-padding-vertical-s` | `(@modal-header-padding-horizontal-s / 2)` | component |

### Overlay

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-background` | `rgba(0,0,0,0.6)` | component |
| `@modal-z-index` | `@global-z-index + 10` | component |

### Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-padding-horizontal` | `15px` | component |
| `@modal-padding-horizontal-m` | `@global-medium-gutter` | component |
| `@modal-padding-horizontal-s` | `@global-gutter` | component |
| `@modal-padding-vertical` | `@modal-padding-horizontal` | component |
| `@modal-padding-vertical-s` | `50px` | component |

### Title

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-title-font-size` | `@global-xlarge-font-size` | component |
| `@modal-title-line-height` | `1.3` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@modal-title-font-family` | `@global-primary-font-family` | master |
| `@modal-title-font-style` | `@global-primary-font-style` | master |
| `@modal-title-font-weight` | `@global-primary-font-weight` | master |
| `@modal-title-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@modal-title-text-transform` | `@global-primary-text-transform` | master |

---

## Nav

**218 variables** (7 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-default-item-active-background` | `transparent` | master |
| `@nav-default-item-hover-background` | `transparent` | master |
| `@nav-default-item-line-background` | `currentColor` | master |
| `@nav-default-item-line-bottom` | `0` | master |
| `@nav-default-item-line-height` | `@global-border-width` | master |
| `@nav-default-item-line-hover-left` | `0` | master |
| `@nav-default-item-line-hover-right` | `0` | master |
| `@nav-default-item-line-left` | `0` | master |
| `@nav-default-item-line-right` | `100%` | master |
| `@nav-default-item-line-transition-duration` | `0.3s` | master |
| `@nav-default-item-line-transition-timing-function` | `ease-out` | master |
| `@nav-default-item-mode` | `~''` | master |
| `@nav-default-siblings-filter` | `~''` | master |
| `@nav-default-siblings-opacity` | `1` | master |
| `@nav-primary-header-padding-horizontal` | `@nav-header-padding-horizontal` | master |
| `@nav-primary-header-padding-vertical` | `@nav-header-padding-vertical` | master |
| `@nav-primary-item-line-background` | `currentColor` | master |
| `@nav-primary-item-line-bottom` | `0` | master |
| `@nav-primary-item-line-height` | `@global-border-width` | master |
| `@nav-primary-item-line-hover-left` | `0` | master |
| `@nav-primary-item-line-hover-right` | `0` | master |
| `@nav-primary-item-line-left` | `0` | master |
| `@nav-primary-item-line-right` | `100%` | master |
| `@nav-primary-item-line-transition-duration` | `0.3s` | master |
| `@nav-primary-item-line-transition-timing-function` | `ease-out` | master |
| `@nav-primary-item-mode` | `~''` | master |
| `@nav-primary-item-padding-horizontal` | `@nav-item-padding-horizontal` | master |
| `@nav-primary-item-padding-vertical` | `@nav-item-padding-vertical` | master |
| `@nav-primary-siblings-filter` | `~''` | master |
| `@nav-primary-siblings-opacity` | `1` | master |
| `@nav-secondary-item-active-background` ⚡ | `transparent` | theme, master |
| `@nav-secondary-item-hover-background` ⚡ | `transparent` | theme, master |
| `@nav-secondary-item-padding-horizontal` ⚡ | `@nav-item-padding-horizontal` | theme, master |
| `@nav-secondary-item-padding-vertical` ⚡ | `@nav-item-padding-vertical` | theme, master |
| `@nav-secondary-margin-top` ⚡ | `0` | theme, master |
| `@internal-nav-default-bullet-background` | `@global-primary-background` | master |
| `@internal-nav-default-bullet-border-radius` | `50%` | master |
| `@internal-nav-default-bullet-height` | `6px` | master |
| `@internal-nav-default-bullet-margin` | `5px` | master |
| `@internal-nav-default-bullet-transition-duration` | `0.2s` | master |
| `@internal-nav-default-bullet-transition-timing-function` | `ease-out` | master |
| `@internal-nav-default-bullet-width` | `6px` | master |
| `@internal-nav-default-icon-mode` | `~''` | master |
| `@internal-nav-default-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-nav-default-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-nav-default-item-hover-mode` | `~''` | master |
| `@internal-nav-primary-bullet-background` | `@global-primary-background` | master |
| `@internal-nav-primary-bullet-border-radius` | `50%` | master |
| `@internal-nav-primary-bullet-height` | `10px` | master |
| `@internal-nav-primary-bullet-margin` | `5px` | master |
| `@internal-nav-primary-bullet-transition-duration` | `0.2s` | master |
| `@internal-nav-primary-bullet-transition-timing-function` | `ease-out` | master |
| `@internal-nav-primary-bullet-width` | `10px` | master |
| `@internal-nav-primary-icon-mode` | `~''` | master |
| `@internal-nav-primary-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-nav-primary-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-nav-primary-item-hover-mode` | `~''` | master |
| `@inverse-nav-background-item-active-background` | `@inverse-global-muted-background` | theme |
| `@inverse-nav-background-item-hover-background` | `@inverse-global-muted-background` | theme |
| `@inverse-nav-default-item-active-background` | `transparent` | master |
| `@inverse-nav-default-item-hover-background` | `transparent` | master |
| `@inverse-nav-default-item-line-background` | `currentColor` | master |
| `@inverse-nav-primary-item-line-background` | `currentColor` | master |
| `@inverse-nav-secondary-item-active-background` | `transparent` | master |
| `@inverse-nav-secondary-item-hover-background` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-default-item-border-radius` | `0` | master |
| `@nav-secondary-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-default-divider-box-shadow` | `none` | master |
| `@nav-default-item-hover-box-shadow` | `none` | master |
| `@nav-dividers-box-shadow` | `none` | master |
| `@nav-primary-divider-box-shadow` | `none` | master |
| `@nav-secondary-divider-box-shadow` | `none` | master |
| `@inverse-nav-default-divider-box-shadow` | `none` | master |
| `@inverse-nav-default-item-hover-box-shadow` | `none` | master |
| `@inverse-nav-dividers-box-shadow` | `none` | master |
| `@inverse-nav-primary-divider-box-shadow` | `none` | master |
| `@inverse-nav-secondary-divider-box-shadow` | `none` | master |

### Default Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-default-divider-border` | `@global-border` | component |
| `@nav-default-divider-border-width` | `@global-border-width` | component |
| `@nav-default-font-size` ⚡ | `@global-small-font-size` | component, theme |
| `@nav-default-header-color` | `@global-emphasis-color` | component |
| `@nav-default-item-active-color` | `@global-emphasis-color` | component |
| `@nav-default-item-color` | `@global-muted-color` | component |
| `@nav-default-item-hover-color` | `@global-color` | component |
| `@nav-default-line-height` | `@global-line-height` | component |
| `@nav-default-sublist-font-size` | `@nav-default-font-size` | component |
| `@nav-default-sublist-item-active-color` | `@global-emphasis-color` | component |
| `@nav-default-sublist-item-color` | `@global-muted-color` | component |
| `@nav-default-sublist-item-hover-color` | `@global-color` | component |
| `@nav-default-sublist-line-height` | `@nav-default-line-height` | component |
| `@nav-default-subtitle-font-size` ⚡ | `12px` | component, theme |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-divider-margin-horizontal` | `0` | component |
| `@nav-divider-margin-vertical` | `5px` | component |

### Dividers Modifier

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-dividers-border` | `@global-border` | component |
| `@nav-dividers-border-width` | `@global-border-width` | component |
| `@nav-dividers-margin-top` | `5px` | component |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-header-font-size` | `@global-small-font-size` | component |
| `@nav-header-margin-top` | `@global-margin` | component |
| `@nav-header-padding-horizontal` | `@nav-item-padding-horizontal` | component |
| `@nav-header-padding-vertical` | `@nav-item-padding-vertical` | component |
| `@nav-header-text-transform` | `uppercase` | component |

### Inverse - Default

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-nav-default-divider-border` | `@inverse-global-border` | component |
| `@inverse-nav-default-header-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-default-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-default-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-default-item-hover-color` | `@inverse-global-color` | component |
| `@inverse-nav-default-sublist-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-default-sublist-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-default-sublist-item-hover-color` | `@inverse-global-color` | component |

### Inverse - Dividers

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-nav-dividers-border` | `@inverse-global-border` | component |

### Inverse - Primary

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-nav-primary-divider-border` | `@inverse-global-border` | component |
| `@inverse-nav-primary-header-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-primary-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-primary-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-primary-item-hover-color` | `@inverse-global-color` | component |
| `@inverse-nav-primary-sublist-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-primary-sublist-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-primary-sublist-item-hover-color` | `@inverse-global-color` | component |

### Inverse - Secondary

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-nav-secondary-divider-border` | `@inverse-global-border` | component |
| `@inverse-nav-secondary-header-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-item-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-item-hover-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-sublist-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-sublist-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-secondary-sublist-item-hover-color` | `@inverse-global-color` | component |
| `@inverse-nav-secondary-subtitle-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-nav-secondary-subtitle-color` | `@inverse-global-muted-color` | component |
| `@inverse-nav-secondary-subtitle-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-item-padding-horizontal` | `0` | component |
| `@nav-item-padding-vertical` | `5px` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-large-font-size` | `@nav-large-font-size-m * 0.85` | component |
| `@nav-large-font-size-l` | `6rem` | component |
| `@nav-large-font-size-m` | `4rem` | component |
| `@nav-large-line-height` | `1` | component |

### Medium Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-medium-font-size` | `@nav-medium-font-size-m * 0.825` | component |
| `@nav-medium-font-size-l` | `4rem` | component |
| `@nav-medium-font-size-m` | `@nav-medium-font-size-l * 0.875` | component |
| `@nav-medium-line-height` | `1` | component |

### Parent Icon

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-parent-icon-margin-left` | `0.25em` | component |

### Primary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-primary-divider-border` | `@global-border` | component |
| `@nav-primary-divider-border-width` | `@global-border-width` | component |
| `@nav-primary-font-size` | `@global-large-font-size` | component |
| `@nav-primary-header-color` | `@global-emphasis-color` | component |
| `@nav-primary-item-active-color` | `@global-emphasis-color` | component |
| `@nav-primary-item-color` | `@global-muted-color` | component |
| `@nav-primary-item-hover-color` | `@global-color` | component |
| `@nav-primary-line-height` | `@global-line-height` | component |
| `@nav-primary-sublist-font-size` | `@global-medium-font-size` | component |
| `@nav-primary-sublist-item-active-color` | `@global-emphasis-color` | component |
| `@nav-primary-sublist-item-color` | `@global-muted-color` | component |
| `@nav-primary-sublist-item-hover-color` | `@global-color` | component |
| `@nav-primary-sublist-line-height` | `@global-line-height` | component |
| `@nav-primary-subtitle-font-size` | `@global-medium-font-size` | component |

### Secondary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-secondary-divider-border` | `@global-border` | component |
| `@nav-secondary-divider-border-width` | `@global-border-width` | component |
| `@nav-secondary-font-size` | `@global-font-size` | component |
| `@nav-secondary-header-color` | `@global-emphasis-color` | component |
| `@nav-secondary-item-active-color` | `@global-emphasis-color` | component |
| `@nav-secondary-item-color` | `@global-emphasis-color` | component |
| `@nav-secondary-item-hover-color` | `@global-emphasis-color` | component |
| `@nav-secondary-line-height` | `@global-line-height` | component |
| `@nav-secondary-sublist-font-size` | `@global-small-font-size` | component |
| `@nav-secondary-sublist-item-active-color` | `@global-emphasis-color` | component |
| `@nav-secondary-sublist-item-color` | `@global-muted-color` | component |
| `@nav-secondary-sublist-item-hover-color` | `@global-color` | component |
| `@nav-secondary-sublist-line-height` | `@global-line-height` | component |
| `@nav-secondary-subtitle-active-color` | `@global-emphasis-color` | component |
| `@nav-secondary-subtitle-color` | `@global-muted-color` | component |
| `@nav-secondary-subtitle-font-size` | `@global-small-font-size` | component |
| `@nav-secondary-subtitle-hover-color` | `@global-color` | component |

### Sublist

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-sublist-deeper-padding-left` | `15px` | component |
| `@nav-sublist-item-padding-vertical` | `2px` | component |
| `@nav-sublist-padding-left` | `15px` | component |
| `@nav-sublist-padding-vertical` | `5px` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-default-font-family` | `@global-secondary-font-family` | master |
| `@nav-default-font-style` | `@global-secondary-font-style` | master |
| `@nav-default-font-weight` | `@global-secondary-font-weight` | master |
| `@nav-default-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@nav-default-subtitle-color` | `@nav-default-item-color` | master |
| `@nav-default-subtitle-font-family` | `inherit` | master |
| `@nav-default-subtitle-font-style` | `inherit` | master |
| `@nav-default-subtitle-font-weight` | `inherit` | master |
| `@nav-default-subtitle-letter-spacing` | `inherit` | master |
| `@nav-default-subtitle-line-height` | `inherit` | master |
| `@nav-default-subtitle-text-transform` | `inherit` | master |
| `@nav-default-text-transform` | `@global-secondary-text-transform` | master |
| `@nav-header-font-weight` | `inherit` | master |
| `@nav-header-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@nav-primary-font-family` | `@global-primary-font-family` | master |
| `@nav-primary-font-style` | `@global-primary-font-style` | master |
| `@nav-primary-font-weight` | `@global-primary-font-weight` | master |
| `@nav-primary-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@nav-primary-subtitle-color` | `@nav-primary-item-color` | master |
| `@nav-primary-subtitle-font-family` | `inherit` | master |
| `@nav-primary-subtitle-font-style` | `inherit` | master |
| `@nav-primary-subtitle-font-weight` | `inherit` | master |
| `@nav-primary-subtitle-letter-spacing` | `inherit` | master |
| `@nav-primary-subtitle-line-height` | `inherit` | master |
| `@nav-primary-subtitle-text-transform` | `inherit` | master |
| `@nav-primary-text-transform` | `@global-primary-text-transform` | master |
| `@nav-secondary-font-family` | `@global-secondary-font-family` | master |
| `@nav-secondary-font-style` | `@global-secondary-font-style` | master |
| `@nav-secondary-font-weight` | `@global-secondary-font-weight` | master |
| `@nav-secondary-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@nav-secondary-subtitle-font-family` | `inherit` | master |
| `@nav-secondary-subtitle-font-style` | `inherit` | master |
| `@nav-secondary-subtitle-font-weight` | `inherit` | master |
| `@nav-secondary-subtitle-letter-spacing` | `inherit` | master |
| `@nav-secondary-subtitle-line-height` | `inherit` | master |
| `@nav-secondary-subtitle-text-transform` | `inherit` | master |
| `@nav-secondary-text-transform` | `@global-secondary-text-transform` | master |
| `@inverse-nav-default-subtitle-color` | `@inverse-nav-default-item-color` | master |
| `@inverse-nav-primary-subtitle-color` | `@inverse-nav-primary-item-color` | master |

### X-Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@nav-xlarge-font-size` | `4rem` | component |
| `@nav-xlarge-font-size-l` | `8rem` | component |
| `@nav-xlarge-font-size-m` | `6rem` | component |
| `@nav-xlarge-line-height` | `1` | component |

---

## Navbar

**186 variables** (15 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-navbar-gradient` | `~''` | master |
| `@internal-navbar-nav-item-active-gradient` | `~''` | master |
| `@internal-navbar-nav-item-background-image` | `~''` | master |
| `@internal-navbar-nav-item-background-size` | `cover` | master |
| `@internal-navbar-nav-item-gradient` | `~''` | master |
| `@internal-navbar-nav-item-hover-gradient` | `~''` | master |
| `@internal-navbar-nav-item-line-gradient` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-backdrop-filter` | `~''` | master |
| `@navbar-container-padding` | `true` | master |
| `@navbar-dropdown-backdrop-filter` | `~''` | master |
| `@navbar-dropdown-dropbar-large-shift-margin-m` | `@navbar-dropdown-dropbar-large-shift-margin` | master |
| `@navbar-dropdown-dropbar-shift-margin-m` | `@navbar-dropdown-dropbar-shift-margin` | master |
| `@navbar-dropdown-large-shift-margin-m` | `@navbar-dropdown-large-shift-margin` | master |
| `@navbar-dropdown-nav-divider-margin-vertical` | `@nav-divider-margin-vertical` | master |
| `@navbar-dropdown-nav-item-hover-background` | `transparent` | master |
| `@navbar-dropdown-nav-item-padding-horizontal` | `@nav-item-padding-horizontal` | master |
| `@navbar-dropdown-nav-item-padding-vertical` | `@nav-item-padding-vertical` | master |
| `@navbar-dropdown-nav-margin-horizontal` | `0` | master |
| `@navbar-dropdown-nav-sublist-padding-left` | `(@navbar-dropdown-nav-item-padding-horizontal + @nav-subl...` | master |
| `@navbar-dropdown-shift-margin-m` | `@navbar-dropdown-shift-margin` | master |
| `@navbar-gap-m` ⚡ | `30px` | theme, master |
| `@navbar-item-padding-horizontal-m` | `@navbar-item-padding-horizontal` | master |
| `@navbar-nav-gap-m` ⚡ | `30px` | theme, master |
| `@navbar-nav-item-active-background` | `transparent` | master |
| `@navbar-nav-item-background` | `transparent` | master |
| `@navbar-nav-item-hover-background` | `transparent` | master |
| `@navbar-nav-item-line-active-background` | `@global-primary-background` | master |
| `@navbar-nav-item-line-active-height` | `1px` | master |
| `@navbar-nav-item-line-active-mode` | `true` | master |
| `@navbar-nav-item-line-active-opacity` | `1` | master |
| `@navbar-nav-item-line-background` | `transparent` | master |
| `@navbar-nav-item-line-border-radius` | `0` | master |
| `@navbar-nav-item-line-height` | `1px` | master |
| `@navbar-nav-item-line-hover-background` | `@global-primary-background` | master |
| `@navbar-nav-item-line-hover-height` | `1px` | master |
| `@navbar-nav-item-line-hover-opacity` | `1` | master |
| `@navbar-nav-item-line-margin-horizontal` | `0` | master |
| `@navbar-nav-item-line-margin-horizontal-m` | `@navbar-nav-item-line-margin-horizontal` | master |
| `@navbar-nav-item-line-margin-vertical` | `0` | master |
| `@navbar-nav-item-line-mode` | `false` | master |
| `@navbar-nav-item-line-onclick-background` | `@global-primary-background` | master |
| `@navbar-nav-item-line-onclick-height` | `1px` | master |
| `@navbar-nav-item-line-opacity` | `1` | master |
| `@navbar-nav-item-line-position-mode` | `bottom` | master |
| `@navbar-nav-item-line-slide-mode` | `~''` | master |
| `@navbar-nav-item-line-transition-duration` | `0.1s` | master |
| `@navbar-nav-item-padding-horizontal-m` | `@navbar-nav-item-padding-horizontal` | master |
| `@navbar-nav-item-transition-duration` | `0.1s` | master |
| `@navbar-padding-bottom` | `0` | master |
| `@navbar-padding-bottom-m` | `0` | master |
| `@navbar-padding-top` | `0` | master |
| `@navbar-padding-top-m` | `0` | master |
| `@navbar-primary-gap` | `@navbar-gap` | master |
| `@navbar-primary-gap-m` | `@navbar-gap-m` | master |
| `@navbar-primary-item-padding-horizontal` | `@navbar-item-padding-horizontal` | master |
| `@navbar-primary-item-padding-horizontal-m` | `@navbar-item-padding-horizontal-m` | master |
| `@navbar-primary-nav-gap` | `@navbar-nav-gap` | master |
| `@navbar-primary-nav-gap-m` | `@navbar-nav-gap-m` | master |
| `@navbar-primary-nav-item-padding-horizontal` | `@navbar-nav-item-padding-horizontal` | master |
| `@navbar-primary-nav-item-padding-horizontal-m` | `@navbar-nav-item-padding-horizontal-m` | master |
| `@navbar-toggle-background` | `transparent` | master |
| `@navbar-toggle-hover-background` | `transparent` | master |
| `@internal-navbar-nav-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-navbar-nav-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-navbar-nav-item-hover-mode` | `~''` | master |
| `@inverse-navbar-nav-item-line-active-background` | `@inverse-global-primary-background` | master |
| `@inverse-navbar-nav-item-line-background` | `transparent` | master |
| `@inverse-navbar-nav-item-line-hover-background` | `@inverse-global-primary-background` | master |
| `@inverse-navbar-nav-item-line-onclick-background` | `@inverse-global-primary-background` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-border` | `transparent` | master |
| `@navbar-border-mode` | `bottom-transparent` | master |
| `@navbar-border-vertical-mode` | `~''` | master |
| `@navbar-border-width` | `0` | master |
| `@navbar-dropdown-border` | `transparent` | master |
| `@navbar-dropdown-border-width` | `0` | master |
| `@internal-navbar-border-border-gradient` | `~''` | master |
| `@internal-navbar-border-mode` | `~''` | master |
| `@inverse-navbar-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-border-radius` | `0` | master |
| `@navbar-dropdown-nav-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-box-shadow` | `none` | master |
| `@navbar-dropdown-box-shadow` ⚡ | `none` | theme, master |
| `@navbar-group-box-shadow` | `none` | master |
| `@navbar-nav-item-active-box-shadow` | `none` | master |
| `@navbar-nav-item-box-shadow` | `none` | master |
| `@navbar-nav-item-hover-box-shadow` | `none` | master |
| `@navbar-sticky-box-shadow` | `none` | master |
| `@inverse-navbar-group-box-shadow` | `none` | master |
| `@inverse-navbar-nav-item-active-box-shadow` | `none` | master |
| `@inverse-navbar-nav-item-box-shadow` | `none` | master |
| `@inverse-navbar-nav-item-hover-box-shadow` | `none` | master |

### Container

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-background` | `@global-muted-background` | component |
| `@navbar-color-mode` | `dark` | component |
| `@navbar-gap` ⚡ | `15px` | component, theme, master |

### Dropdown

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-background` ⚡ | `@global-background` | component, theme |
| `@navbar-dropdown-color` | `@global-color` | component |
| `@navbar-dropdown-color-mode` | `dark` | component |
| `@navbar-dropdown-focus-outline` | `@base-focus-outline` | component |
| `@navbar-dropdown-grid-gutter-horizontal` | `@global-gutter` | component |
| `@navbar-dropdown-grid-gutter-vertical` | `@navbar-dropdown-grid-gutter-horizontal` | component |
| `@navbar-dropdown-margin` ⚡ | `15px` | component, theme |
| `@navbar-dropdown-padding` ⚡ | `25px` | component, theme |
| `@navbar-dropdown-shift-margin` | `0` | component |
| `@navbar-dropdown-viewport-margin` | `15px` | component |
| `@navbar-dropdown-width` | `200px` | component |

### Dropdown Dropbar

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-dropbar-large-padding-bottom` | `@navbar-dropdown-dropbar-large-padding-top` | component |
| `@navbar-dropdown-dropbar-large-padding-top` | `@navbar-dropdown-large-padding` | component |
| `@navbar-dropdown-dropbar-large-shift-margin` | `0` | component |
| `@navbar-dropdown-dropbar-margin` | `0` | component |
| `@navbar-dropdown-dropbar-padding-bottom` | `@navbar-dropdown-dropbar-padding-top` | component |
| `@navbar-dropdown-dropbar-padding-top` | `@navbar-dropdown-padding` | component |
| `@navbar-dropdown-dropbar-shift-margin` | `0` | component |
| `@navbar-dropdown-dropbar-viewport-margin` | `15px` | component |
| `@navbar-dropdown-dropbar-viewport-margin-m` | `@global-medium-gutter` | component |
| `@navbar-dropdown-dropbar-viewport-margin-s` | `@global-gutter` | component |

### Dropdown Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-large-padding` | `40px` | component |
| `@navbar-dropdown-large-shift-margin` | `0` | component |

### Dropdown Nav

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-nav-divider-border` | `@global-border` | component |
| `@navbar-dropdown-nav-divider-border-width` | `@global-border-width` | component |
| `@navbar-dropdown-nav-header-color` | `@global-emphasis-color` | component |
| `@navbar-dropdown-nav-item-active-color` | `@global-emphasis-color` | component |
| `@navbar-dropdown-nav-item-color` | `@global-muted-color` | component |
| `@navbar-dropdown-nav-item-hover-color` | `@global-color` | component |
| `@navbar-dropdown-nav-sublist-item-active-color` | `@global-emphasis-color` | component |
| `@navbar-dropdown-nav-sublist-item-color` | `@global-muted-color` | component |
| `@navbar-dropdown-nav-sublist-item-hover-color` | `@global-color` | component |
| `@navbar-dropdown-nav-subtitle-font-size` ⚡ | `12px` | component, theme |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-navbar-item-color` | `@inverse-global-color` | component |
| `@inverse-navbar-nav-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-navbar-nav-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-navbar-nav-item-hover-color` | `@inverse-global-color` | component |
| `@inverse-navbar-nav-item-onclick-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-navbar-toggle-color` | `@inverse-global-muted-color` | component |
| `@inverse-navbar-toggle-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-item-color` | `@global-color` | component |
| `@navbar-item-padding-horizontal` ⚡ | `0` | component, theme, master |

### Nav Item Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-nav-item-active-color` | `@global-emphasis-color` | component |
| `@navbar-nav-item-color` | `@global-muted-color` | component |
| `@navbar-nav-item-hover-color` | `@global-color` | component |
| `@navbar-nav-item-onclick-color` | `@global-emphasis-color` | component |

### Nav Items

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-nav-gap` ⚡ | `15px` | component, theme, master |
| `@navbar-nav-item-font-size` ⚡ | `@global-small-font-size` | component, theme |
| `@navbar-nav-item-height` | `80px` | component |
| `@navbar-nav-item-padding-horizontal` ⚡ | `0` | component, theme, master |

### Parent Icon

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-parent-icon-margin-left` | `4px` | component |

### Subtitle

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-subtitle-font-size` | `@global-small-font-size` | component |

### Toggle

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-toggle-color` | `@global-muted-color` | component |
| `@navbar-toggle-hover-color` | `@global-color` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@navbar-dropdown-nav-font-family` | `@global-secondary-font-family` | master |
| `@navbar-dropdown-nav-font-size` ⚡ | `@global-font-size` | theme, master |
| `@navbar-dropdown-nav-font-style` | `@global-secondary-font-style` | master |
| `@navbar-dropdown-nav-font-weight` | `@global-secondary-font-weight` | master |
| `@navbar-dropdown-nav-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@navbar-dropdown-nav-subtitle-color` | `@navbar-dropdown-nav-item-color` | master |
| `@navbar-dropdown-nav-subtitle-font-family` | `inherit` | master |
| `@navbar-dropdown-nav-subtitle-font-style` | `inherit` | master |
| `@navbar-dropdown-nav-subtitle-font-weight` | `inherit` | master |
| `@navbar-dropdown-nav-subtitle-letter-spacing` | `inherit` | master |
| `@navbar-dropdown-nav-subtitle-line-height` | `inherit` | master |
| `@navbar-dropdown-nav-subtitle-text-transform` | `inherit` | master |
| `@navbar-dropdown-nav-text-transform` | `@global-secondary-text-transform` | master |
| `@navbar-item-font-family` | `@navbar-nav-item-font-family` | master |
| `@navbar-item-font-size` | `@navbar-nav-item-font-size` | master |
| `@navbar-nav-item-active-text-shadow` | `none` | master |
| `@navbar-nav-item-font-family` ⚡ | `@global-secondary-font-family` | component, master |
| `@navbar-nav-item-font-style` | `@global-secondary-font-style` | master |
| `@navbar-nav-item-font-weight` | `@global-secondary-font-weight` | master |
| `@navbar-nav-item-hover-text-shadow` | `none` | master |
| `@navbar-nav-item-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@navbar-nav-item-text-shadow` | `none` | master |
| `@navbar-nav-item-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |
| `@navbar-primary-nav-item-active-color` | `transparent` | master |
| `@navbar-primary-nav-item-color` | `transparent` | master |
| `@navbar-primary-nav-item-font-size` | `@global-large-font-size` | master |
| `@navbar-primary-nav-item-font-weight` | `400` | master |
| `@navbar-primary-nav-item-hover-color` | `transparent` | master |
| `@navbar-primary-nav-item-onclick-color` | `transparent` | master |
| `@navbar-primary-toggle-icon-width` | `26px` | master |
| `@navbar-subtitle-color` | `@navbar-nav-item-color` | master |
| `@navbar-subtitle-font-family` | `inherit` | master |
| `@navbar-subtitle-font-style` | `inherit` | master |
| `@navbar-subtitle-font-weight` | `inherit` | master |
| `@navbar-subtitle-letter-spacing` | `inherit` | master |
| `@navbar-subtitle-line-height` | `inherit` | master |
| `@navbar-subtitle-text-transform` | `inherit` | master |
| `@inverse-navbar-subtitle-color` | `@inverse-navbar-nav-item-color` | master |

---

## Notification

**33 variables** (11 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-backdrop-filter` | `~''` | master |
| `@notification-message-danger-background` | `@global-danger-background` | master |
| `@notification-message-danger-color-mode` | `light` | master |
| `@notification-message-primary-background` | `@global-primary-background` | master |
| `@notification-message-primary-color-mode` | `light` | master |
| `@notification-message-success-background` | `@global-success-background` | master |
| `@notification-message-success-color-mode` | `light` | master |
| `@notification-message-warning-background` | `@global-warning-background` | master |
| `@notification-message-warning-color-mode` | `light` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-border` | `transparent` | master |
| `@notification-message-border-mode` | `~''` | master |
| `@notification-message-border-width` | `0` | master |
| `@notification-message-danger-border` | `transparent` | master |
| `@notification-message-primary-border` | `transparent` | master |
| `@notification-message-success-border` | `transparent` | master |
| `@notification-message-warning-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-box-shadow` | `none` | master |

### Close

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-close-right` ⚡ | `(@notification-message-padding / 2)` | component, master |
| `@notification-close-top` ⚡ | `(@notification-message-padding / 2)` | component, master |

### Danger

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-danger-color` ⚡ | `@global-inverse-color` | component, master |

### Message

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-background` | `@global-muted-background` | component |
| `@notification-message-color` | `@global-color` | component |
| `@notification-message-font-size` ⚡ | `@global-font-size` | component, master |
| `@notification-message-line-height` ⚡ | `1.5` | component, master |
| `@notification-message-margin-top` | `10px` | component |
| `@notification-message-padding` ⚡ | `@global-gutter` | component, master |

### Position

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-position` ⚡ | `15px` | component, master |
| `@notification-width` ⚡ | `420px` | component, master |
| `@notification-z-index` | `@global-z-index + 40` | component |

### Primary

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-primary-color` ⚡ | `@global-inverse-color` | component, master |

### Success

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-success-color` ⚡ | `@global-inverse-color` | component, master |

### Warning

| Variable | Value | Sources |
|----------|-------|---------|
| `@notification-message-warning-color` ⚡ | `@global-inverse-color` | component, master |

---

## Offcanvas

**15 variables** (0 with overrides)

### Bar

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-bar-background` | `@global-secondary-background` | component |
| `@offcanvas-bar-color-mode` | `light` | component |
| `@offcanvas-bar-padding-horizontal` | `20px` | component |
| `@offcanvas-bar-padding-vertical` | `20px` | component |
| `@offcanvas-bar-width` | `270px` | component |

### Bar Responsive

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-bar-padding-horizontal-s` | `@global-gutter` | component |
| `@offcanvas-bar-padding-vertical-s` | `@global-gutter` | component |
| `@offcanvas-bar-width-s` | `350px` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-overlay-backdrop-filter` | `~''` | master |
| `@offcanvas-z-index` | `@global-z-index` | component |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-bar-box-shadow` | `none` | master |

### Close

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-close-padding` | `5px` | component |
| `@offcanvas-close-position` | `5px` | component |
| `@offcanvas-close-position-s` | `10px` | component |

### Overlay

| Variable | Value | Sources |
|----------|-------|---------|
| `@offcanvas-overlay-background` | `rgba(0,0,0,0.1)` | component |

---

## Overlay

**14 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-overlay-default-gradient` | `~''` | master |
| `@internal-overlay-primary-gradient` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@overlay-default-backdrop-filter` | `~''` | master |
| `@overlay-default-inverse-background` | `@overlay-default-background` | master |
| `@overlay-padding-horizontal` | `@global-gutter` | component |
| `@overlay-padding-vertical` | `@global-gutter` | component |
| `@overlay-primary-backdrop-filter` | `~''` | master |
| `@overlay-primary-inverse-background` | `@overlay-primary-background` | master |
| `@internal-overlay-default-backdrop-filter` | `~''` | master |
| `@internal-overlay-primary-backdrop-filter` | `~''` | master |

### Default Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@overlay-default-background` | `fade(@global-background, 90%)` | component |
| `@overlay-default-color-mode` | `dark` | component |

### Primary Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@overlay-primary-background` | `fade(@global-secondary-background, 90%)` | component |
| `@overlay-primary-color-mode` | `light` | component |

---

## Padding

**5 variables** (0 with overrides)

### Default

| Variable | Value | Sources |
|----------|-------|---------|
| `@padding-padding` | `@global-gutter` | component |
| `@padding-padding-l` | `@global-medium-gutter` | component |

### Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@padding-large-padding` | `@global-medium-gutter` | component |
| `@padding-large-padding-l` | `@global-large-gutter` | component |

### Small

| Variable | Value | Sources |
|----------|-------|---------|
| `@padding-small-padding` | `@global-small-gutter` | component |

---

## Pagination

**67 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-pagination-item-background-image` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-active-background` | `transparent` | master |
| `@pagination-item-background` | `transparent` | master |
| `@pagination-item-disabled-background` | `transparent` | master |
| `@pagination-item-height` | `0` | master |
| `@pagination-item-hover-background` | `transparent` | master |
| `@pagination-item-min-width` | `0` | master |
| `@pagination-item-next-previous-background` | `inherit` | master |
| `@pagination-item-next-previous-color` | `inherit` | master |
| `@pagination-item-next-previous-hover-background` | `inherit` | master |
| `@pagination-item-next-previous-hover-color` | `inherit` | master |
| `@pagination-item-transition-duration` | `0.1s` | master |
| `@pagination-margin-horizontal` | `0` | component |
| `@internal-inverse-pagination-item-glow-gradient` | `~''` | master |
| `@internal-pagination-item-active-glow-opacity` | `1` | master |
| `@internal-pagination-item-glow-filter` | `~''` | master |
| `@internal-pagination-item-glow-gradient` | `~''` | master |
| `@internal-pagination-item-glow-opacity` | `1` | master |
| `@internal-pagination-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-pagination-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-pagination-item-hover-glow-filter` | `~''` | master |
| `@internal-pagination-item-hover-glow-opacity` | `1` | master |
| `@internal-pagination-item-hover-mode` | `~''` | master |
| `@internal-pagination-item-mode` | `~''` | master |
| `@internal-pagination-item-next-previous-mode` | `~''` | master |
| `@inverse-pagination-item-active-background` | `transparent` | master |
| `@inverse-pagination-item-background` | `transparent` | master |
| `@inverse-pagination-item-disabled-background` | `transparent` | master |
| `@inverse-pagination-item-hover-background` | `transparent` | master |
| `@inverse-pagination-item-next-previous-background` | `inherit` | master |
| `@inverse-pagination-item-next-previous-color` | `inherit` | master |
| `@inverse-pagination-item-next-previous-hover-background` | `inherit` | master |
| `@inverse-pagination-item-next-previous-hover-color` | `inherit` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-active-border` | `transparent` | master |
| `@pagination-item-border` | `transparent` | master |
| `@pagination-item-border-mode` | `~''` | master |
| `@pagination-item-border-width` | `0` | master |
| `@pagination-item-disabled-border` | `transparent` | master |
| `@pagination-item-hover-border` | `transparent` | master |
| `@inverse-pagination-item-active-border` | `transparent` | master |
| `@inverse-pagination-item-border` | `transparent` | master |
| `@inverse-pagination-item-disabled-border` | `transparent` | master |
| `@inverse-pagination-item-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-active-box-shadow` | `none` | master |
| `@pagination-item-box-shadow` | `none` | master |
| `@pagination-item-hover-box-shadow` | `none` | master |
| `@inverse-pagination-item-active-box-shadow` | `none` | master |
| `@inverse-pagination-item-box-shadow` | `none` | master |
| `@inverse-pagination-item-hover-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-pagination-item-active-color` | `@inverse-global-color` | component |
| `@inverse-pagination-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-pagination-item-disabled-color` | `@inverse-global-muted-color` | component |
| `@inverse-pagination-item-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-active-color` | `@global-color` | component |
| `@pagination-item-color` | `@global-muted-color` | component |
| `@pagination-item-disabled-color` | `@global-muted-color` | component |
| `@pagination-item-hover-color` | `@global-color` | component |
| `@pagination-item-hover-text-decoration` | `none` | component |
| `@pagination-item-padding-horizontal` | `10px` | component |
| `@pagination-item-padding-vertical` | `5px` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@pagination-item-font-family` | `@global-secondary-font-family` | master |
| `@pagination-item-font-size` | `@global-font-size` | master |
| `@pagination-item-font-style` | `@global-secondary-font-style` | master |
| `@pagination-item-font-weight` | `@global-secondary-font-weight` | master |
| `@pagination-item-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@pagination-item-text-transform` | `@global-secondary-text-transform` | master |

---

## Placeholder

**9 variables** (3 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@placeholder-background` ⚡ | `transparent` | component, theme, master |
| `@placeholder-border` ⚡ | `@global-border` | theme, master |
| `@placeholder-border-style` | `dashed` | master |
| `@placeholder-border-width` ⚡ | `@global-border-width` | theme, master |
| `@placeholder-margin-vertical` | `@global-margin` | component |
| `@placeholder-padding-horizontal` | `@global-gutter` | component |
| `@placeholder-padding-vertical` | `@global-gutter` | component |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@placeholder-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@placeholder-box-shadow` | `none` | master |

---

## Position

**4 variables** (0 with overrides)

### Margin Modifiers

| Variable | Value | Sources |
|----------|-------|---------|
| `@position-large-margin` | `@global-gutter` | component |
| `@position-large-margin-l` | `50px` | component |
| `@position-medium-margin` | `@global-gutter` | component |
| `@position-small-margin` | `@global-small-gutter` | component |

---

## Progress

**7 variables** (1 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-progress-bar-gradient` | `~''` | master |

### Bar

| Variable | Value | Sources |
|----------|-------|---------|
| `@progress-bar-background` | `@global-primary-background` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@progress-background` | `@global-muted-background` | component |
| `@progress-height` | `15px` | component |
| `@progress-margin-vertical` | `@global-margin` | component |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@progress-border-radius` ⚡ | `500px` | theme, master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@progress-box-shadow` | `none` | master |

---

## Search

**136 variables** (20 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-color` | `@global-color` | component |
| `@search-default-backdrop-filter` | `~''` | master |
| `@search-icon-color` | `@global-muted-color` | component |
| `@search-large-backdrop-filter` | `~''` | master |
| `@search-large-color` | `~''` | master |
| `@search-large-icon-color` | `~''` | master |
| `@search-large-placeholder-color` | `~''` | master |
| `@search-medium-backdrop-filter` | `~''` | master |
| `@search-medium-color` | `~''` | master |
| `@search-medium-icon-color` | `~''` | master |
| `@search-medium-placeholder-color` | `~''` | master |
| `@search-navbar-backdrop-filter` | `~''` | master |
| `@search-navbar-color` | `~''` | master |
| `@search-navbar-icon-color` | `~''` | master |
| `@search-navbar-placeholder-color` | `~''` | master |
| `@search-placeholder-color` | `@global-muted-color` | component |
| `@inverse-search-large-color` | `~''` | master |
| `@inverse-search-large-icon-color` | `~''` | master |
| `@inverse-search-large-placeholder-color` | `~''` | master |
| `@inverse-search-medium-color` | `~''` | master |
| `@inverse-search-medium-icon-color` | `~''` | master |
| `@inverse-search-medium-placeholder-color` | `~''` | master |
| `@inverse-search-navbar-color` | `~''` | master |
| `@inverse-search-navbar-icon-color` | `~''` | master |
| `@inverse-search-navbar-placeholder-color` | `~''` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-default-border` ⚡ | `transparent` | theme, master |
| `@search-default-border-mode` | `~''` | master |
| `@search-default-border-width` ⚡ | `0` | theme, master |
| `@search-default-focus-border` ⚡ | `transparent` | theme, master |
| `@search-large-border` ⚡ | `transparent` | theme, master |
| `@search-large-border-mode` | `~''` | master |
| `@search-large-border-width` ⚡ | `0` | theme, master |
| `@search-large-focus-border` ⚡ | `transparent` | theme, master |
| `@search-medium-border` ⚡ | `transparent` | theme, master |
| `@search-medium-border-mode` | `~''` | master |
| `@search-medium-border-width` ⚡ | `0` | theme, master |
| `@search-medium-focus-border` ⚡ | `transparent` | theme, master |
| `@search-navbar-border` ⚡ | `transparent` | theme, master |
| `@search-navbar-border-mode` | `~''` | master |
| `@search-navbar-border-width` ⚡ | `0` | theme, master |
| `@search-navbar-focus-border` ⚡ | `transparent` | theme, master |
| `@inverse-search-default-border` | `transparent` | master |
| `@inverse-search-default-focus-border` | `transparent` | master |
| `@inverse-search-large-border` | `transparent` | master |
| `@inverse-search-large-focus-border` | `transparent` | master |
| `@inverse-search-medium-border` | `transparent` | master |
| `@inverse-search-medium-focus-border` | `transparent` | master |
| `@inverse-search-navbar-border` | `transparent` | master |
| `@inverse-search-navbar-focus-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-default-border-radius` | `0` | master |
| `@search-large-border-radius` | `0` | master |
| `@search-medium-border-radius` | `0` | master |
| `@search-navbar-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-default-input-box-shadow` | `none` | master |
| `@search-default-input-focus-box-shadow` | `none` | master |
| `@search-large-input-box-shadow` | `none` | master |
| `@search-large-input-focus-box-shadow` | `none` | master |
| `@search-medium-input-box-shadow` | `none` | master |
| `@search-medium-input-focus-box-shadow` | `none` | master |
| `@search-navbar-input-box-shadow` | `none` | master |
| `@search-navbar-input-focus-box-shadow` | `none` | master |
| `@inverse-search-default-input-box-shadow` | `none` | master |
| `@inverse-search-default-input-focus-box-shadow` | `none` | master |
| `@inverse-search-large-input-box-shadow` | `none` | master |
| `@inverse-search-large-input-focus-box-shadow` | `none` | master |
| `@inverse-search-medium-input-box-shadow` | `none` | master |
| `@inverse-search-medium-input-focus-box-shadow` | `none` | master |
| `@inverse-search-navbar-input-box-shadow` | `none` | master |
| `@inverse-search-navbar-input-focus-box-shadow` | `none` | master |

### Default Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-default-background` ⚡ | `transparent` | component, theme |
| `@search-default-focus-background` | `darken(@search-default-background, 2%)` | component |
| `@search-default-height` | `@global-control-height` | component |
| `@search-default-icon-padding` | `10px` | component |
| `@search-default-icon-width` | `20px` | component |
| `@search-default-padding-horizontal` | `10px` | component |
| `@search-default-width` | `240px` | component |

### Inverse - Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-color` | `@inverse-global-color` | component |
| `@inverse-search-icon-color` | `@inverse-global-muted-color` | component |
| `@inverse-search-placeholder-color` | `@inverse-global-muted-color` | component |

### Inverse - Default

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-default-background` ⚡ | `transparent` | component, theme |
| `@inverse-search-default-focus-background` | `fadein(@inverse-search-default-background, 5%)` | component |

### Inverse - Large

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-large-background` ⚡ | `transparent` | component, theme |
| `@inverse-search-large-focus-background` | `fadein(@inverse-search-large-background, 5%)` | component |

### Inverse - Medium

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-medium-background` ⚡ | `transparent` | component, theme |
| `@inverse-search-medium-focus-background` | `fadein(@inverse-search-medium-background, 5%)` | component |

### Inverse - Navbar

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-navbar-background` ⚡ | `transparent` | component, theme |
| `@inverse-search-navbar-focus-background` | `fadein(@inverse-search-navbar-background, 5%)` | component |

### Inverse - Toggle

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-search-toggle-color` | `@inverse-global-muted-color` | component |
| `@inverse-search-toggle-hover-color` | `@inverse-global-color` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-large-background` ⚡ | `transparent` | component, theme |
| `@search-large-focus-background` | `darken(@search-large-background, 2%)` | component |
| `@search-large-font-size` | `@global-2xlarge-font-size` | component |
| `@search-large-height` | `90px` | component |
| `@search-large-icon-padding` | `20px` | component |
| `@search-large-icon-width` | `40px` | component |
| `@search-large-padding-horizontal` | `20px` | component |
| `@search-large-width` | `500px` | component |

### Medium Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-medium-background` ⚡ | `transparent` | component, theme |
| `@search-medium-focus-background` | `darken(@search-medium-background, 2%)` | component |
| `@search-medium-font-size` | `@global-large-font-size` | component |
| `@search-medium-height` | `@global-control-large-height` | component |
| `@search-medium-icon-padding` | `12px` | component |
| `@search-medium-icon-width` | `24px` | component |
| `@search-medium-padding-horizontal` | `12px` | component |
| `@search-medium-width` | `400px` | component |

### Navbar Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-navbar-background` | `@global-background` | component |
| `@search-navbar-focus-background` ⚡ | `@search-navbar-background` | component, theme |
| `@search-navbar-height` | `@global-control-height` | component |
| `@search-navbar-icon-padding` | `10px` | component |
| `@search-navbar-icon-width` | `20px` | component |
| `@search-navbar-padding-horizontal` | `10px` | component |
| `@search-navbar-width` | `240px` | component |

### Toggle

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-toggle-color` | `@global-muted-color` | component |
| `@search-toggle-hover-color` | `@global-color` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@search-default-font-family` | `inherit` | master |
| `@search-default-font-size` | `inherit` | master |
| `@search-default-font-style` | `inherit` | master |
| `@search-default-font-weight` | `inherit` | master |
| `@search-default-letter-spacing` | `inherit` | master |
| `@search-default-text-transform` | `inherit` | master |
| `@search-large-font-family` | `inherit` | master |
| `@search-large-font-style` | `inherit` | master |
| `@search-large-font-weight` | `inherit` | master |
| `@search-large-letter-spacing` | `inherit` | master |
| `@search-large-text-transform` | `inherit` | master |
| `@search-medium-font-family` | `inherit` | master |
| `@search-medium-font-style` | `inherit` | master |
| `@search-medium-font-weight` | `inherit` | master |
| `@search-medium-letter-spacing` | `inherit` | master |
| `@search-medium-text-transform` | `inherit` | master |
| `@search-navbar-font-family` | `inherit` | master |
| `@search-navbar-font-size` | `inherit` | master |
| `@search-navbar-font-style` | `inherit` | master |
| `@search-navbar-font-weight` | `inherit` | master |
| `@search-navbar-letter-spacing` | `inherit` | master |
| `@search-navbar-text-transform` | `inherit` | master |

---

## Section

**39 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-section-default-background-repeat` | `repeat` | master |
| `@internal-section-default-gradient` | `~''` | master |
| `@internal-section-default-image` | `~''` | master |
| `@internal-section-default-mode` | `none` | master |
| `@internal-section-default-overlap-image` | `~''` | master |
| `@internal-section-muted-background-repeat` | `repeat` | master |
| `@internal-section-muted-gradient` | `~''` | master |
| `@internal-section-muted-image` | `~''` | master |
| `@internal-section-muted-mode` | `none` | master |
| `@internal-section-muted-overlap-image` | `~''` | master |
| `@internal-section-overlap-background-size` | `~''` | master |
| `@internal-section-overlap-height` | `0` | master |
| `@internal-section-primary-background-repeat` | `repeat` | master |
| `@internal-section-primary-gradient` | `~''` | master |
| `@internal-section-primary-image` | `~''` | master |
| `@internal-section-primary-mode` | `none` | master |
| `@internal-section-primary-overlap-image` | `~''` | master |
| `@internal-section-secondary-background-repeat` | `repeat` | master |
| `@internal-section-secondary-gradient` | `~''` | master |
| `@internal-section-secondary-image` | `~''` | master |
| `@internal-section-secondary-mode` | `none` | master |
| `@internal-section-secondary-overlap-image` | `~''` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-border-radius` | `clamp(30px, 7.1429px + 3.5714vw, 50px)` | master |

### Default Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-default-background` | `@global-background` | component |
| `@section-default-color-mode` | `dark` | component |

### Default Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-padding-vertical` | `@global-medium-margin` | component |
| `@section-padding-vertical-m` | `@global-large-margin` | component |

### Large Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-large-padding-vertical` | `@global-large-margin` | component |
| `@section-large-padding-vertical-m` | `@global-xlarge-margin` | component |

### Muted Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-muted-background` | `@global-muted-background` | component |
| `@section-muted-color-mode` | `dark` | component |

### Primary Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-primary-background` | `@global-primary-background` | component |
| `@section-primary-color-mode` | `light` | component |

### Secondary Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-secondary-background` | `@global-secondary-background` | component |
| `@section-secondary-color-mode` | `light` | component |

### Small Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-small-padding-vertical` | `@global-medium-margin` | component |

### X-Large Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-xlarge-padding-vertical` | `@global-xlarge-margin` | component |
| `@section-xlarge-padding-vertical-m` | `(@global-large-margin + @global-xlarge-margin)` | component |

### X-Small Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-xsmall-padding-vertical` | `@global-margin` | component |

---

## Slidenav

**30 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@slidenav-active-background` | `transparent` | master |
| `@slidenav-active-color` | `fade(@global-color, 50%)` | component |
| `@slidenav-backdrop-filter` | `~''` | master |
| `@slidenav-background` | `transparent` | master |
| `@slidenav-color` | `fade(@global-color, 50%)` | component |
| `@slidenav-hover-background` | `transparent` | master |
| `@slidenav-hover-color` | `fade(@global-color, 90%)` | component |
| `@slidenav-margin` | `0` | master |
| `@slidenav-padding-horizontal` | `10px` | component |
| `@slidenav-padding-vertical` | `5px` | component |
| `@internal-slidenav-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-slidenav-hover-glitch-duration` | `0.2s` | master |
| `@internal-slidenav-hover-mode` | `~''` | master |
| `@internal-slidenav-next-previous-mode` | `~''` | master |
| `@inverse-slidenav-active-background` | `transparent` | master |
| `@inverse-slidenav-background` | `transparent` | master |
| `@inverse-slidenav-hover-background` | `transparent` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@slidenav-active-border` | `transparent` | master |
| `@slidenav-border` | `transparent` | master |
| `@slidenav-border-width` | `0` | master |
| `@slidenav-hover-border` | `transparent` | master |
| `@inverse-slidenav-active-border` | `transparent` | master |
| `@inverse-slidenav-border` | `transparent` | master |
| `@inverse-slidenav-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@slidenav-border-radius` | `0` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-slidenav-active-color` | `fade(@inverse-global-color, 70%)` | component |
| `@inverse-slidenav-color` | `fade(@inverse-global-color, 70%)` | component |
| `@inverse-slidenav-hover-color` | `fade(@inverse-global-color, 95%)` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@slidenav-large-padding-horizontal` | `@slidenav-large-padding-vertical` | component |
| `@slidenav-large-padding-vertical` | `10px` | component |

---

## Slider

**4 variables** (0 with overrides)

### Container

| Variable | Value | Sources |
|----------|-------|---------|
| `@slider-container-margin-bottom` | `-39px` | component |
| `@slider-container-margin-left` | `-25px` | component |
| `@slider-container-margin-right` | `-25px` | component |
| `@slider-container-margin-top` | `-11px` | component |

---

## Sortable

**3 variables** (0 with overrides)

### Drag

| Variable | Value | Sources |
|----------|-------|---------|
| `@sortable-dragged-z-index` | `@global-z-index + 50` | component |

### Empty

| Variable | Value | Sources |
|----------|-------|---------|
| `@sortable-empty-height` | `50px` | component |

### Placeholder

| Variable | Value | Sources |
|----------|-------|---------|
| `@sortable-placeholder-opacity` | `0` | component |

---

## Spinner

**5 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@spinner-circumference` | `round(2 * 3.141 * @spinner-radius)` | component |
| `@spinner-duration` | `1.4s` | component |
| `@spinner-radius` | `floor(((@spinner-size - @spinner-stroke-width) / 2))` | component |
| `@spinner-size` | `30px` | component |
| `@spinner-stroke-width` | `1` | component |

---

## Sticky

**3 variables** (0 with overrides)

### Animation

| Variable | Value | Sources |
|----------|-------|---------|
| `@sticky-animation-duration` | `0.2s` | component |
| `@sticky-reverse-animation-duration` | `0.2s` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@sticky-z-index` | `@global-z-index - 20` | component |

---

## Subnav

**88 variables** (2 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-subnav-pill-item-active-gradient` | `~''` | master |
| `@internal-subnav-pill-item-background-image` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-item-active-text-decoration` | `none` | master |
| `@subnav-item-text-decoration` | `inherit` | master |
| `@subnav-item-transition-duration` | `0.1s` | master |
| `@subnav-margin-horizontal` | `20px` | component |
| `@subnav-pill-item-active-backdrop-filter` | `~''` | master |
| `@subnav-pill-item-hover-backdrop-filter` | `~''` | master |
| `@subnav-siblings-filter` | `~''` | master |
| `@subnav-siblings-opacity` | `1` | master |
| `@internal-inverse-subnav-pill-item-glow-gradient` | `~''` | master |
| `@internal-subnav-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-subnav-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-subnav-item-hover-mode` | `~''` | master |
| `@internal-subnav-pill-item-active-glow-opacity` | `1` | master |
| `@internal-subnav-pill-item-glow-filter` | `~''` | master |
| `@internal-subnav-pill-item-glow-gradient` | `~''` | master |
| `@internal-subnav-pill-item-glow-opacity` | `1` | master |
| `@internal-subnav-pill-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-subnav-pill-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-subnav-pill-item-hover-glow-filter` | `~''` | master |
| `@internal-subnav-pill-item-hover-glow-opacity` | `1` | master |
| `@internal-subnav-pill-item-hover-mode` | `~''` | master |
| `@internal-subnav-pill-item-mode` | `~''` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-pill-item-active-border` | `transparent` | master |
| `@subnav-pill-item-border` | `transparent` | master |
| `@subnav-pill-item-border-width` | `0` | master |
| `@subnav-pill-item-disabled-border` | `transparent` | master |
| `@subnav-pill-item-hover-border` | `transparent` | master |
| `@subnav-pill-item-onclick-border` | `transparent` | master |
| `@internal-subnav-divider-border-gradient` | `~''` | master |
| `@internal-subnav-pill-item-border-image` | `~''` | master |
| `@internal-subnav-pill-item-border-image-repeat` | `~''` | master |
| `@internal-subnav-pill-item-border-image-slice` | `~''` | master |
| `@internal-subnav-pill-item-border-image-width` | `~''` | master |
| `@inverse-subnav-pill-item-active-border` | `transparent` | master |
| `@inverse-subnav-pill-item-border` | `transparent` | master |
| `@inverse-subnav-pill-item-disabled-border` | `transparent` | master |
| `@inverse-subnav-pill-item-hover-border` | `transparent` | master |
| `@inverse-subnav-pill-item-onclick-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-pill-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-pill-item-active-box-shadow` | `none` | master |
| `@subnav-pill-item-box-shadow` | `none` | master |
| `@subnav-pill-item-hover-box-shadow` | `none` | master |
| `@subnav-pill-item-onclick-box-shadow` | `none` | master |
| `@inverse-subnav-pill-item-active-box-shadow` | `none` | master |
| `@inverse-subnav-pill-item-box-shadow` | `none` | master |
| `@inverse-subnav-pill-item-hover-box-shadow` | `none` | master |
| `@inverse-subnav-pill-item-onclick-box-shadow` | `none` | master |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-divider-border` | `@global-border` | component |
| `@subnav-divider-border-height` | `1.5em` | component |
| `@subnav-divider-border-width` | `@global-border-width` | component |
| `@subnav-divider-margin-horizontal` | `@subnav-margin-horizontal` | component |

### Inverse - Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-subnav-divider-border` | `@inverse-global-border` | component |
| `@inverse-subnav-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-subnav-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-subnav-item-disabled-color` | `@inverse-global-muted-color` | component |
| `@inverse-subnav-item-hover-color` | `@inverse-global-color` | component |

### Inverse - Pill

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-subnav-pill-item-active-background` | `@inverse-global-primary-background` | component |
| `@inverse-subnav-pill-item-active-color` | `@inverse-global-inverse-color` | component |
| `@inverse-subnav-pill-item-background` | `transparent` | component |
| `@inverse-subnav-pill-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-subnav-pill-item-hover-background` | `@inverse-global-muted-background` | component |
| `@inverse-subnav-pill-item-hover-color` | `@inverse-global-color` | component |
| `@inverse-subnav-pill-item-onclick-background` | `@inverse-subnav-pill-item-hover-background` | component |
| `@inverse-subnav-pill-item-onclick-color` | `@inverse-subnav-pill-item-hover-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-item-active-color` | `@global-emphasis-color` | component |
| `@subnav-item-color` | `@global-muted-color` | component |
| `@subnav-item-disabled-color` | `@global-muted-color` | component |
| `@subnav-item-hover-color` | `@global-color` | component |
| `@subnav-item-hover-text-decoration` | `none` | component |

### Pill Style

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-pill-item-active-background` | `@global-primary-background` | component |
| `@subnav-pill-item-active-color` | `@global-inverse-color` | component |
| `@subnav-pill-item-background` | `transparent` | component |
| `@subnav-pill-item-color` | `@subnav-item-color` | component |
| `@subnav-pill-item-hover-background` | `@global-muted-background` | component |
| `@subnav-pill-item-hover-color` | `@global-color` | component |
| `@subnav-pill-item-onclick-background` | `@subnav-pill-item-hover-background` | component |
| `@subnav-pill-item-onclick-color` | `@subnav-pill-item-hover-color` | component |
| `@subnav-pill-item-padding-horizontal` | `10px` | component |
| `@subnav-pill-item-padding-vertical` | `5px` | component |
| `@subnav-pill-margin-horizontal` | `@subnav-margin-horizontal` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@subnav-item-font-family` | `@global-secondary-font-family` | master |
| `@subnav-item-font-size` ⚡ | `@global-font-size` | theme, master |
| `@subnav-item-font-style` | `@global-secondary-font-style` | master |
| `@subnav-item-font-weight` | `@global-secondary-font-weight` | master |
| `@subnav-item-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@subnav-item-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |

---

## Svg

**6 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-inverse-svg-default-background` | `transparent` | master |
| `@internal-inverse-svg-muted-background` | `@inverse-global-muted-background` | master |
| `@internal-inverse-svg-muted-color` | `@inverse-global-muted-color` | master |
| `@internal-svg-default-background` | `@global-background` | master |
| `@internal-svg-muted-background` | `darken(@global-muted-background, 2%)` | master |
| `@internal-svg-muted-color` | `lighten(@global-muted-color, 15%)` | master |

---

## Tab

**57 variables** (7 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-tab-item-background-image` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-item-active-background` | `@tab-item-background` | master |
| `@tab-item-background` | `transparent` | master |
| `@tab-item-hover-background` | `@tab-item-background` | master |
| `@tab-item-mode` | `border` | master |
| `@tab-margin-horizontal` | `20px` | component |
| `@tab-vertical-item-margin-vertical` | `0` | master |
| `@tab-vertical-item-padding-horizontal` | `@tab-item-padding-horizontal` | master |
| `@tab-vertical-item-padding-vertical` | `@tab-item-padding-vertical` | master |
| `@internal-tab-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-tab-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-tab-item-hover-mode` | `~''` | master |
| `@inverse-tab-item-active-background` | `@inverse-tab-item-background` | master |
| `@inverse-tab-item-background` | `transparent` | master |
| `@inverse-tab-item-hover-background` | `@inverse-tab-item-background` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-border` ⚡ | `@global-border` | theme, master |
| `@tab-border-width` ⚡ | `@global-border-width` | theme, master |
| `@tab-item-active-border` ⚡ | `@global-primary-background` | theme, master |
| `@tab-item-border` | `@global-border` | master |
| `@tab-item-border-width` ⚡ | `@global-border-width` | theme, master |
| `@tab-item-hover-border` | `currentColor` | master |
| `@tab-item-line-hover-left` | `0` | master |
| `@tab-item-line-hover-right` | `0` | master |
| `@tab-item-line-left` | `0` | master |
| `@tab-item-line-right` | `100%` | master |
| `@tab-item-line-transition-duration` | `0.3s` | master |
| `@tab-item-line-transition-timing-function` | `ease-out` | master |
| `@internal-tab-item-active-border-gradient` | `~''` | master |
| `@internal-tab-item-active-border-image` | `~''` | master |
| `@internal-tab-item-active-border-image-slice` | `~''` | master |
| `@internal-tab-item-hover-border-gradient` | `~''` | master |
| `@internal-tab-vertical-item-active-border-image` | `~''` | master |
| `@inverse-tab-border` ⚡ | `@inverse-global-border` | theme, master |
| `@inverse-tab-item-active-border` | `@inverse-global-primary-background` | master |
| `@inverse-tab-item-border` | `@inverse-global-border` | master |
| `@inverse-tab-item-hover-border` | `currentColor` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-item-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-box-shadow` | `none` | master |
| `@inverse-tab-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-tab-item-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-tab-item-color` | `@inverse-global-muted-color` | component |
| `@inverse-tab-item-disabled-color` | `@inverse-global-muted-color` | component |
| `@inverse-tab-item-hover-color` | `@inverse-global-color` | component |

### Item

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-item-active-color` | `@global-emphasis-color` | component |
| `@tab-item-color` | `@global-muted-color` | component |
| `@tab-item-disabled-color` | `@global-muted-color` | component |
| `@tab-item-hover-color` | `@global-color` | component |
| `@tab-item-hover-text-decoration` | `none` | component |
| `@tab-item-padding-horizontal` | `10px` | component |
| `@tab-item-padding-vertical` | `5px` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@tab-item-font-family` | `@global-secondary-font-family` | master |
| `@tab-item-font-size` ⚡ | `@global-font-size` | theme, master |
| `@tab-item-font-style` | `@global-secondary-font-style` | master |
| `@tab-item-font-weight` | `@global-secondary-font-weight` | master |
| `@tab-item-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@tab-item-line-height` | `@global-line-height` | master |
| `@tab-item-text-transform` ⚡ | `@global-secondary-text-transform` | theme, master |

---

## Table

**37 variables** (5 with overrides)

### Active Row

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-row-active-background` | `#ffd` | component |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-divider-header-border` | `transparent` | master |
| `@table-divider-header-border-width` | `0` | master |
| `@table-striped-border` ⚡ | `transparent` | theme, master |
| `@table-striped-border-width` ⚡ | `0` | theme, master |
| `@inverse-table-divider-header-border` | `@inverse-global-border` | master |
| `@inverse-table-striped-border` | `@inverse-global-border` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-divider-box-shadow` | `none` | master |
| `@inverse-table-divider-box-shadow` | `none` | master |

### Caption

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-caption-color` | `@global-muted-color` | component |
| `@table-caption-font-size` | `@global-small-font-size` | component |

### Divider

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-divider-border` | `@global-border` | component |
| `@table-divider-border-width` | `@global-border-width` | component |

### Expand

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-expand-min-width` | `150px` | component |

### Footer

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-footer-font-size` | `@global-small-font-size` | component |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-header-cell-color` ⚡ | `@global-muted-color` | component, theme, master |
| `@table-header-cell-font-size` ⚡ | `@global-small-font-size` | component, theme, master |
| `@table-header-cell-font-weight` ⚡ | `normal` | component, theme, master |

### Hover

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-hover-row-background` | `@table-row-active-background` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-table-caption-color` | `@inverse-global-muted-color` | component |
| `@inverse-table-divider-border` | `@inverse-global-border` | component |
| `@inverse-table-header-cell-color` | `@inverse-global-color` | component |
| `@inverse-table-hover-row-background` | `@inverse-table-row-active-background` | component |
| `@inverse-table-row-active-background` | `fadeout(@inverse-global-muted-background, 2%)` | component |
| `@inverse-table-striped-row-background` | `@inverse-global-muted-background` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-large-cell-padding-horizontal` | `12px` | component |
| `@table-large-cell-padding-vertical` | `22px` | component |

### Small Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-small-cell-padding-horizontal` | `12px` | component |
| `@table-small-cell-padding-vertical` | `10px` | component |

### Spacing

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-cell-padding-horizontal` | `12px` | component |
| `@table-cell-padding-vertical` | `16px` | component |
| `@table-margin-vertical` | `@global-margin` | component |

### Striped

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-striped-row-background` | `@global-muted-background` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@table-header-cell-font-family` | `inherit` | master |
| `@table-header-cell-font-style` | `inherit` | master |
| `@table-header-cell-letter-spacing` | `inherit` | master |
| `@table-header-cell-text-transform` | `uppercase` | master |

---

## Text

**39 variables** (3 with overrides)

### Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-background-color` | `@global-primary-background` | component |

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-text-background-color-gradient` ⚡ | `linear-gradient(90deg, @text-background-color 0%, spin(@t...` | theme, master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-background-padding-right` | `0` | master |
| `@text-meta-link-color` ⚡ | `@text-meta-color` | theme, master |
| `@text-meta-link-hover-color` ⚡ | `@global-color` | theme, master |

### Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-danger-color` | `@global-danger-background` | component |
| `@text-emphasis-color` | `@global-emphasis-color` | component |
| `@text-muted-color` | `@global-muted-color` | component |
| `@text-primary-color` | `@global-primary-background` | component |
| `@text-secondary-color` | `@global-secondary-background` | component |
| `@text-success-color` | `@global-success-background` | component |
| `@text-warning-color` | `@global-warning-background` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-text-emphasis-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-text-lead-color` | `@inverse-global-color` | component |
| `@inverse-text-meta-color` | `@inverse-global-muted-color` | component |
| `@inverse-text-muted-color` | `@inverse-global-muted-color` | component |
| `@inverse-text-primary-color` | `@inverse-global-primary-background` | component |
| `@inverse-text-secondary-color` | `@inverse-global-primary-background` | component |

### Large Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-large-font-size` | `@global-large-font-size` | component |
| `@text-large-line-height` | `1.5` | component |

### Lead

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-lead-color` | `@global-emphasis-color` | component |
| `@text-lead-font-size` | `@global-large-font-size` | component |
| `@text-lead-line-height` | `1.5` | component |

### Meta

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-meta-color` | `@global-muted-color` | component |
| `@text-meta-font-size` | `@global-small-font-size` | component |
| `@text-meta-line-height` | `1.4` | component |

### Small Size

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-small-font-size` | `@global-small-font-size` | component |
| `@text-small-line-height` | `1.5` | component |

### Stroke

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-stroke-text-stroke` | `~'calc(1.4px + 0.002em)'` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@text-lead-font-family` | `@global-primary-font-family` | master |
| `@text-lead-font-style` | `@global-primary-font-style` | master |
| `@text-lead-font-weight` | `@global-primary-font-weight` | master |
| `@text-lead-letter-spacing` | `@global-primary-letter-spacing` | master |
| `@text-lead-text-transform` | `@global-primary-text-transform` | master |
| `@text-meta-font-family` | `@global-secondary-font-family` | master |
| `@text-meta-font-style` | `@global-secondary-font-style` | master |
| `@text-meta-font-weight` | `@global-secondary-font-weight` | master |
| `@text-meta-letter-spacing` | `@global-secondary-letter-spacing` | master |
| `@text-meta-text-transform` | `@global-secondary-text-transform` | master |

---

## Thumbnav

**22 variables** (4 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@thumbnav-item-gradient` ⚡ | `~''` | theme, master |
| `@inverse-thumbnav-item-gradient` ⚡ | `~''` | theme, master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@thumbnav-item-active-opacity` ⚡ | `0` | theme, master |
| `@thumbnav-item-background` | `rgba(255,255,255,0.4)` | master |
| `@thumbnav-item-hover-opacity` ⚡ | `0` | theme, master |
| `@thumbnav-item-opacity` | `1` | master |
| `@thumbnav-margin-horizontal` | `15px` | component |
| `@thumbnav-margin-vertical` | `@thumbnav-margin-horizontal` | component |
| `@thumbnav-siblings-filter` | `~''` | master |
| `@thumbnav-siblings-opacity` | `1` | master |
| `@internal-thumbnav-item-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-thumbnav-item-hover-glitch-duration` | `0.2s` | master |
| `@internal-thumbnav-item-hover-mode` | `~''` | master |
| `@inverse-thumbnav-item-background` | `rgba(0,0,0,0.4)` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@thumbnav-item-active-border` | `transparent` | master |
| `@thumbnav-item-border` | `transparent` | master |
| `@thumbnav-item-border-width` | `0` | master |
| `@thumbnav-item-hover-border` | `transparent` | master |
| `@inverse-thumbnav-item-active-border` | `transparent` | master |
| `@inverse-thumbnav-item-border` | `transparent` | master |
| `@inverse-thumbnav-item-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@thumbnav-item-border-radius` | `0` | master |

---

## Tile

**32 variables** (0 with overrides)

### Background Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-tile-default-gradient` | `~''` | master |
| `@internal-tile-default-image` | `~''` | master |
| `@internal-tile-muted-gradient` | `~''` | master |
| `@internal-tile-muted-image` | `~''` | master |
| `@internal-tile-primary-gradient` | `~''` | master |
| `@internal-tile-primary-image` | `~''` | master |
| `@internal-tile-secondary-gradient` | `~''` | master |
| `@internal-tile-secondary-image` | `~''` | master |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-default-hover-background` | `darken(@tile-muted-background, 2%)` | master |
| `@tile-muted-hover-background` | `darken(@tile-muted-background, 2%)` | master |
| `@tile-primary-hover-background` | `darken(@tile-primary-background, 4%)` | master |
| `@tile-secondary-hover-background` | `darken(@tile-secondary-background, 4%)` | master |
| `@internal-tile-hover-mode` | `~''` | master |

### Default Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-default-background` | `@global-background` | component |
| `@tile-default-color-mode` | `dark` | component |

### Default Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-padding-horizontal` | `15px` | component |
| `@tile-padding-horizontal-m` | `@global-medium-gutter` | component |
| `@tile-padding-horizontal-s` | `@global-gutter` | component |
| `@tile-padding-vertical` | `@global-medium-margin` | component |
| `@tile-padding-vertical-m` | `@global-large-margin` | component |

### Large Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-large-padding-vertical` | `@global-large-margin` | component |
| `@tile-large-padding-vertical-m` | `@global-xlarge-margin` | component |

### Muted Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-muted-background` | `@global-muted-background` | component |
| `@tile-muted-color-mode` | `dark` | component |

### Primary Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-primary-background` | `@global-primary-background` | component |
| `@tile-primary-color-mode` | `light` | component |

### Secondary Background

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-secondary-background` | `@global-secondary-background` | component |
| `@tile-secondary-color-mode` | `light` | component |

### Small Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-small-padding-vertical` | `@global-medium-margin` | component |

### X-Large Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-xlarge-padding-vertical` | `@global-xlarge-margin` | component |
| `@tile-xlarge-padding-vertical-m` | `(@global-large-margin + @global-xlarge-margin)` | component |

### X-Small Padding

| Variable | Value | Sources |
|----------|-------|---------|
| `@tile-xsmall-padding-vertical` | `@global-margin` | component |

---

## Tooltip

**10 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@tooltip-backdrop-filter` | `~''` | master |
| `@tooltip-background` | `#666` | component |
| `@tooltip-border-radius` | `2px` | component |
| `@tooltip-color` | `@global-inverse-color` | component |
| `@tooltip-font-size` | `12px` | component |
| `@tooltip-margin` | `10px` | component |
| `@tooltip-max-width` | `200px` | component |
| `@tooltip-padding-horizontal` | `6px` | component |
| `@tooltip-padding-vertical` | `3px` | component |
| `@tooltip-z-index` | `@global-z-index + 30` | component |

---

## Totop

**32 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@totop-active-background` | `transparent` | master |
| `@totop-active-color` | `@global-emphasis-color` | component |
| `@totop-backdrop-filter` | `~''` | master |
| `@totop-background` | `transparent` | master |
| `@totop-color` | `@global-muted-color` | component |
| `@totop-hover-background` | `transparent` | master |
| `@totop-hover-color` | `@global-color` | component |
| `@totop-padding` | `5px` | component |
| `@internal-totop-hover-glitch-animation` | `uk-glitch-skew, uk-glitch-opacity` | master |
| `@internal-totop-hover-glitch-duration` | `0.2s` | master |
| `@internal-totop-hover-mode` | `~''` | master |
| `@internal-totop-mode` | `~''` | master |
| `@inverse-totop-active-background` | `transparent` | master |
| `@inverse-totop-background` | `transparent` | master |
| `@inverse-totop-hover-background` | `transparent` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@totop-active-border` | `transparent` | master |
| `@totop-border` | `transparent` | master |
| `@totop-border-width` | `0` | master |
| `@totop-hover-border` | `transparent` | master |
| `@inverse-totop-active-border` | `transparent` | master |
| `@inverse-totop-border` | `transparent` | master |
| `@inverse-totop-hover-border` | `transparent` | master |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@totop-border-radius` | `0` | master |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@totop-active-box-shadow` | `none` | master |
| `@totop-box-shadow` | `none` | master |
| `@totop-hover-box-shadow` | `none` | master |
| `@inverse-totop-active-box-shadow` | `none` | master |
| `@inverse-totop-box-shadow` | `none` | master |
| `@inverse-totop-hover-box-shadow` | `none` | master |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-totop-active-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-totop-color` | `@inverse-global-muted-color` | component |
| `@inverse-totop-hover-color` | `@inverse-global-color` | component |

---

## Transition

**5 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@transition-duration` | `0.3s` | component |

### Scale

| Variable | Value | Sources |
|----------|-------|---------|
| `@transition-scale` | `1.03` | component |

### Slide

| Variable | Value | Sources |
|----------|-------|---------|
| `@transition-slide-medium-translate` | `50px` | component |
| `@transition-slide-small-translate` | `10px` | component |

### Slow

| Variable | Value | Sources |
|----------|-------|---------|
| `@transition-slow-duration` | `0.7s` | component |

---

## Utility

**32 variables** (0 with overrides)

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropcap-color` | `inherit` | master |
| `@inverse-dropcap-color` | `inherit` | master |

### Border

| Variable | Value | Sources |
|----------|-------|---------|
| `@border-rounded-border-radius` | `5px` | component |

### Box Shadow

| Variable | Value | Sources |
|----------|-------|---------|
| `@box-shadow-bottom-background` | `#444` | component |
| `@box-shadow-bottom-blur` | `20px` | component |
| `@box-shadow-bottom-border-radius` | `100%` | component |
| `@box-shadow-bottom-bottom` | `-@box-shadow-bottom-height` | component |
| `@box-shadow-bottom-height` | `30px` | component |
| `@box-shadow-duration` | `0.1s` | component |

### Dragover

| Variable | Value | Sources |
|----------|-------|---------|
| `@dragover-box-shadow` | `0 0 20px rgba(100,100,100,0.3)` | component |

### Dropcap

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropcap-font-size` | `((@global-line-height * 3) * 1em)` | component |
| `@dropcap-line-height` | `1` | component |
| `@dropcap-margin-right` | `10px` | component |

### Inverse

| Variable | Value | Sources |
|----------|-------|---------|
| `@inverse-logo-color` | `@inverse-global-emphasis-color` | component |
| `@inverse-logo-hover-color` | `@inverse-global-emphasis-color` | component |

### Logo

| Variable | Value | Sources |
|----------|-------|---------|
| `@logo-color` | `@global-emphasis-color` | component |
| `@logo-font-family` | `@global-font-family` | component |
| `@logo-font-size` | `@global-large-font-size` | component |
| `@logo-hover-color` | `@global-emphasis-color` | component |

### Overflow

| Variable | Value | Sources |
|----------|-------|---------|
| `@overflow-fade-size` | `100px` | component |

### Panel

| Variable | Value | Sources |
|----------|-------|---------|
| `@panel-scrollable-border` | `@global-border` | component |
| `@panel-scrollable-border-width` | `@global-border-width` | component |
| `@panel-scrollable-height` | `170px` | component |
| `@panel-scrollable-padding` | `10px` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@dropcap-font-family` | `inherit` | master |
| `@dropcap-font-style` | `inherit` | master |
| `@dropcap-font-weight` | `inherit` | master |
| `@dropcap-letter-spacing` | `inherit` | master |
| `@dropcap-text-transform` | `inherit` | master |
| `@logo-font-weight` | `inherit` | master |
| `@logo-letter-spacing` | `inherit` | master |
| `@logo-text-transform` | `inherit` | master |

---

## Variables

**62 variables** (0 with overrides)

### Backgrounds

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-background` | `#fff` | component |
| `@global-muted-background` | `#f8f8f8` | component |
| `@global-primary-background` | `#1e87f0` | component |
| `@global-secondary-background` | `#222` | component |

### Base

| Variable | Value | Sources |
|----------|-------|---------|
| `@deprecated` | `false` | component |

### Border Radius

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-border-radius` | `0` | master |

### Borders

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-border` | `#e5e5e5` | component |
| `@global-border-width` | `1px` | component |

### Box Shadows

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-large-box-shadow` | `0 14px 25px rgba(0,0,0,0.16)` | component |
| `@global-medium-box-shadow` | `0 5px 15px rgba(0,0,0,0.08)` | component |
| `@global-small-box-shadow` | `0 2px 8px rgba(0,0,0,0.08)` | component |
| `@global-xlarge-box-shadow` | `0 28px 50px rgba(0,0,0,0.16)` | component |

### Breakpoints

| Variable | Value | Sources |
|----------|-------|---------|
| `@breakpoint-large` | `1200px` | component |
| `@breakpoint-large-max` | `(@breakpoint-xlarge - 1)` | component |
| `@breakpoint-medium` | `960px` | component |
| `@breakpoint-medium-max` | `(@breakpoint-large - 1)` | component |
| `@breakpoint-small` | `640px` | component |
| `@breakpoint-small-max` | `(@breakpoint-medium - 1)` | component |
| `@breakpoint-xlarge` | `1600px` | component |
| `@breakpoint-xsmall-max` | `(@breakpoint-small - 1)` | component |

### Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-color` | `#666` | component |
| `@global-emphasis-color` | `#333` | component |
| `@global-muted-color` | `#999` | component |

### Controls

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-control-height` | `40px` | component |
| `@global-control-large-height` | `55px` | component |
| `@global-control-small-height` | `30px` | component |

### Font Sizes

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-2xlarge-font-size` | `2.625rem` | component |
| `@global-large-font-size` | `1.5rem` | component |
| `@global-medium-font-size` | `1.25rem` | component |
| `@global-small-font-size` | `0.875rem` | component |
| `@global-xlarge-font-size` | `2rem` | component |

### Gutters

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-gutter` | `30px` | component |
| `@global-large-gutter` | `70px` | component |
| `@global-medium-gutter` | `40px` | component |
| `@global-small-gutter` | `15px` | component |

### Link Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-inverse-color` | `#fff` | component |
| `@global-link-color` | `#1e87f0` | component |
| `@global-link-hover-color` | `#0f6ecd` | component |

### Margins

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-large-margin` | `70px` | component |
| `@global-margin` | `20px` | component |
| `@global-medium-margin` | `40px` | component |
| `@global-small-margin` | `10px` | component |
| `@global-xlarge-margin` | `140px` | component |

### Status Colors

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-danger-background` | `#f0506e` | component |
| `@global-success-background` | `#32d296` | component |
| `@global-warning-background` | `#faa05a` | component |

### Typo

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-primary-font-family` | `inherit` | master |
| `@global-primary-font-style` | `inherit` | master |
| `@global-primary-font-weight` | `inherit` | master |
| `@global-primary-letter-spacing` | `inherit` | master |
| `@global-primary-text-transform` | `inherit` | master |
| `@global-secondary-font-family` | `inherit` | master |
| `@global-secondary-font-style` | `inherit` | master |
| `@global-secondary-font-weight` | `inherit` | master |
| `@global-secondary-letter-spacing` | `inherit` | master |
| `@global-secondary-text-transform` | `inherit` | master |
| `@global-tertiary-font-family` | `inherit` | master |
| `@global-tertiary-font-weight` | `inherit` | master |

### Typography

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-font-family` | `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "H...` | component |
| `@global-font-size` | `16px` | component |
| `@global-line-height` | `1.5` | component |

### Z-Index

| Variable | Value | Sources |
|----------|-------|---------|
| `@global-z-index` | `1000` | component |

---

## Width

**5 variables** (0 with overrides)

### Size Modifiers

| Variable | Value | Sources |
|----------|-------|---------|
| `@width-2xlarge-width` | `750px` | component |
| `@width-large-width` | `450px` | component |
| `@width-medium-width` | `300px` | component |
| `@width-small-width` | `150px` | component |
| `@width-xlarge-width` | `600px` | component |

---

## Yootheme-theme

**96 variables** (0 with overrides)

### Firefox Fallback

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-box-decoration-bottom` | `0` | unknown |
| `@theme-box-decoration-default-backdrop-filter` | `~''` | unknown |
| `@theme-box-decoration-default-background` | `darken(@global-muted-background, 3%)` | unknown |
| `@theme-box-decoration-default-blend-mode` | `~''` | unknown |
| `@theme-box-decoration-default-border` | `transparent` | unknown |
| `@theme-box-decoration-default-border-width` | `0` | unknown |
| `@theme-box-decoration-default-transform-horizontal` | `-20px` | unknown |
| `@theme-box-decoration-default-transform-vertical` | `20px` | unknown |
| `@theme-box-decoration-left` | `0` | unknown |
| `@theme-box-decoration-primary-backdrop-filter` | `~''` | unknown |
| `@theme-box-decoration-primary-background` | `darken(@global-muted-background, 3%)` | unknown |
| `@theme-box-decoration-primary-blend-mode` | `~''` | unknown |
| `@theme-box-decoration-primary-border` | `transparent` | unknown |
| `@theme-box-decoration-primary-border-width` | `0` | unknown |
| `@theme-box-decoration-primary-transform-horizontal` | `20px` | unknown |
| `@theme-box-decoration-primary-transform-vertical` | `20px` | unknown |
| `@theme-box-decoration-right` | `0` | unknown |
| `@theme-box-decoration-secondary-backdrop-filter` | `~''` | unknown |
| `@theme-box-decoration-secondary-background` | `darken(@global-muted-background, 3%)` | unknown |
| `@theme-box-decoration-secondary-blend-mode` | `~''` | unknown |
| `@theme-box-decoration-secondary-border` | `transparent` | unknown |
| `@theme-box-decoration-secondary-border-width` | `0` | unknown |
| `@theme-box-decoration-secondary-transform-horizontal` | `20px` | unknown |
| `@theme-box-decoration-secondary-transform-vertical` | `-20px` | unknown |
| `@theme-box-decoration-top` | `0` | unknown |
| `@theme-box-decoration-z-index` | `-1` | unknown |
| `@theme-transition-border-blend-mode` | `~''` | unknown |
| `@theme-transition-border-border` | `@global-primary-background` | unknown |
| `@theme-transition-border-border-width` | `0` | unknown |
| `@theme-transition-border-direction-mode` | `inside` | unknown |
| `@theme-transition-border-hover-border` | `@global-primary-background` | unknown |
| `@theme-transition-border-hover-border-width` | `10px` | unknown |
| `@theme-transition-border-transition-duration` | `0.1s` | unknown |
| `@internal-theme-transition-border-border-gradient` | `~''` | unknown |
| `@internal-theme-transition-border-hover-border-gradient` | `~''` | unknown |
| `@inverse-theme-box-decoration-default-background` | `@inverse-global-muted-background` | unknown |
| `@inverse-theme-box-decoration-default-border` | `transparent` | unknown |
| `@inverse-theme-box-decoration-primary-background` | `@inverse-global-muted-background` | unknown |
| `@inverse-theme-box-decoration-primary-border` | `transparent` | unknown |
| `@inverse-theme-box-decoration-secondary-background` | `@inverse-global-muted-background` | unknown |
| `@inverse-theme-box-decoration-secondary-border` | `transparent` | unknown |

### Header

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-headerbar-bottom-background` | `@navbar-background` | unknown |
| `@theme-headerbar-bottom-border` | `transparent` | unknown |
| `@theme-headerbar-bottom-border-width` | `0` | unknown |
| `@theme-headerbar-bottom-padding-bottom` | `20px` | unknown |
| `@theme-headerbar-bottom-padding-top` | `20px` | unknown |
| `@theme-headerbar-color-mode` | `@navbar-color-mode` | unknown |
| `@theme-headerbar-font-size` | `inherit` | unknown |
| `@theme-headerbar-stacked-margin-top` | `20px` | unknown |
| `@theme-headerbar-top-background` | `@navbar-background` | unknown |
| `@theme-headerbar-top-border` | `transparent` | unknown |
| `@theme-headerbar-top-border-width` | `0` | unknown |
| `@theme-headerbar-top-padding-bottom` | `20px` | unknown |
| `@theme-headerbar-top-padding-top` | `20px` | unknown |

### Image

| Variable | Value | Sources |
|----------|-------|---------|
| `@internal-inverse-section-title-dash-color` | `@inverse-global-color` | unknown |
| `@internal-theme-mask-default-border-image` | `~''` | unknown |
| `@internal-theme-mask-default-border-image-repeat` | `round` | unknown |
| `@internal-theme-mask-default-border-image-slice` | `30` | unknown |
| `@internal-theme-mask-default-border-image-width` | `~''` | unknown |
| `@internal-theme-mask-default-image` | `"../vendor/assets/uikit-themes/master/images/mask-default...` | unknown |
| `@internal-theme-mask-default-image-repeat` | `round` | unknown |
| `@internal-theme-mask-default-image-size` | `100%` | unknown |
| `@inverse-section-title-color` | `@inverse-global-color` | unknown |

### List

| Variable | Value | Sources |
|----------|-------|---------|
| `@section-title-color` | `@global-muted-color` | unknown |
| `@section-title-font-family` | `@global-secondary-font-family` | unknown |
| `@section-title-font-size` | `@global-small-font-size` | unknown |
| `@section-title-font-style` | `@global-secondary-font-style` | unknown |
| `@section-title-font-weight` | `@global-secondary-font-weight` | unknown |
| `@section-title-letter-spacing` | `@global-secondary-letter-spacing` | unknown |
| `@section-title-line-height` | `@global-line-height` | unknown |
| `@section-title-text-transform` | `@global-secondary-text-transform` | unknown |
| `@internal-section-title-dash-background-image` | `~''` | unknown |
| `@internal-section-title-dash-border-height` | `15px` | unknown |
| `@internal-section-title-dash-border-margin` | `15px` | unknown |
| `@internal-section-title-dash-border-width` | `@global-border-width` | unknown |
| `@internal-section-title-dash-color` | `currentColor` | unknown |
| `@internal-section-title-mode` | `dash` | unknown |

### Page

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-page-border` | `transparent` | unknown |
| `@theme-page-border-mode` | `~''` | unknown |
| `@theme-page-border-width` | `0` | unknown |
| `@theme-page-border-width-l` | `@theme-page-border-width` | unknown |
| `@internal-theme-page-border-gradient` | `~''` | unknown |

### Page Container

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-page-container-background` | `darken(@global-muted-background, 3%)` | unknown |
| `@theme-page-container-color-mode` | `dark` | unknown |
| `@theme-page-container-margin-bottom` | `@theme-page-container-margin-top` | unknown |
| `@theme-page-container-margin-top` | `@global-large-margin` | unknown |
| `@theme-page-container-width` | `1500px` | unknown |

### Sidebar

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-sidebar-min-width` | `200px` | unknown |

### Toolbar

| Variable | Value | Sources |
|----------|-------|---------|
| `@theme-toolbar-background` | `@global-secondary-background` | unknown |
| `@theme-toolbar-border` | `transparent` | unknown |
| `@theme-toolbar-border-width` | `0` | unknown |
| `@theme-toolbar-color-mode` | `light` | unknown |
| `@theme-toolbar-font-family` | `inherit` | unknown |
| `@theme-toolbar-font-size` | `@global-small-font-size` | unknown |
| `@theme-toolbar-padding-bottom` | `10px` | unknown |
| `@theme-toolbar-padding-top` | `10px` | unknown |

---

## Appendix: All Overridden Variables

Variables marked with ⚡ are defined in multiple layers. The table below shows all values:

### Accordion Overrides

**`@accordion-default-icon-color`**

- `theme`: `@global-color`
- `master/base`: `@global-color`
- **Final**: `@global-color`

**`@inverse-accordion-default-icon-color`**

- `theme`: `@inverse-global-color`
- `master/base`: `@inverse-global-color`
- **Final**: `@inverse-global-color`

### Alert Overrides

**`@alert-close-opacity`**

- `theme`: `0.4`
- `master/base`: `0.4`
- **Final**: `0.4`

**`@alert-close-hover-opacity`**

- `theme`: `0.8`
- `master/base`: `0.8`
- **Final**: `0.8`

### Article Overrides

**`@article-meta-link-color`**

- `theme`: `@article-meta-color`
- `master/base`: `@article-meta-color`
- **Final**: `@article-meta-color`

**`@article-meta-link-hover-color`**

- `theme`: `@global-color`
- `master/base`: `@global-color`
- **Final**: `@global-color`

### Base Overrides

**`@base-code-padding-horizontal`**

- `theme`: `6px`
- `master/base`: `0`
- **Final**: `0`

**`@base-code-padding-vertical`**

- `theme`: `2px`
- `master/base`: `0`
- **Final**: `0`

**`@base-code-background`**

- `theme`: `@global-muted-background`
- `master/base`: `transparent`
- **Final**: `transparent`

**`@base-blockquote-color`**

- `theme`: `@global-emphasis-color`
- `master/typo`: `@global-emphasis-color`
- **Final**: `@global-emphasis-color`

**`@base-blockquote-footer-color`**

- `theme`: `@global-color`
- `master/typo`: `@global-color`
- **Final**: `@global-color`

**`@base-pre-padding`**

- `theme`: `10px`
- `master/base`: `0`
- **Final**: `0`

**`@base-pre-background`**

- `theme`: `@global-background`
- `master/base`: `transparent`
- **Final**: `transparent`

**`@base-pre-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@base-pre-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@base-pre-border-radius`**

- `theme`: `3px`
- `master/border-radius`: `0`
- **Final**: `0`

**`@inverse-base-blockquote-color`**

- `theme`: `@inverse-global-emphasis-color`
- `master/typo`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

**`@inverse-base-blockquote-footer-color`**

- `theme`: `@inverse-global-color`
- `master/typo`: `@inverse-global-color`
- **Final**: `@inverse-global-color`

### Button Overrides

**`@button-line-height`**

- `component`: `@global-control-height`
- `theme`: `@global-control-height - (@button-border-width * 2)`
- `master/border`: `@global-control-height - (@button-border-width * 2)`
- **Final**: `@global-control-height - (@button-border-width * 2)`

**`@button-small-line-height`**

- `component`: `@global-control-small-height`
- `theme`: `@global-control-small-height - (@button-border-width * 2)`
- `master/border`: `@global-control-small-height - (@button-border-width * 2)`
- **Final**: `@global-control-small-height - (@button-border-width * 2)`

**`@button-large-line-height`**

- `component`: `@global-control-large-height`
- `theme`: `@global-control-large-height - (@button-border-width * 2)`
- `master/border`: `@global-control-large-height - (@button-border-width * 2)`
- **Final**: `@global-control-large-height - (@button-border-width * 2)`

**`@button-font-size`**

- `component`: `@global-font-size`
- `theme`: `@global-small-font-size`
- **Final**: `@global-small-font-size`

**`@button-large-font-size`**

- `component`: `@global-medium-font-size`
- `theme`: `@global-small-font-size`
- **Final**: `@global-small-font-size`

**`@button-default-background`**

- `component`: `@global-muted-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@button-default-hover-background`**

- `component`: `darken(@button-default-background, 5%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@button-default-active-background`**

- `component`: `darken(@button-default-background, 10%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@button-disabled-background`**

- `component`: `@global-muted-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@button-text-hover-color`**

- `component`: `@global-muted-color`
- `theme`: `@global-emphasis-color`
- `master/base`: `@global-emphasis-color`
- **Final**: `@global-emphasis-color`

**`@inverse-button-default-background`**

- `component`: `@inverse-global-primary-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-button-default-color`**

- `component`: `@inverse-global-inverse-color`
- `theme`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

**`@inverse-button-default-hover-background`**

- `component`: `darken(@inverse-button-default-background, 5%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-button-default-hover-color`**

- `component`: `@inverse-global-inverse-color`
- `theme`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

**`@inverse-button-default-active-background`**

- `component`: `darken(@inverse-button-default-background, 10%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-button-default-active-color`**

- `component`: `@inverse-global-inverse-color`
- `theme`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

**`@inverse-button-text-hover-color`**

- `component`: `@inverse-global-muted-color`
- `theme`: `@inverse-global-emphasis-color`
- `master/base`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

**`@button-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

**`@button-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@button-default-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@button-default-hover-border`**

- `theme`: `darken(@global-border, 20%)`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@button-default-active-border`**

- `theme`: `darken(@global-border, 30%)`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@button-disabled-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@button-text-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@button-text-border`**

- `theme`: `currentColor`
- `master/base`: `currentColor`
- **Final**: `currentColor`

### Card Overrides

**`@card-hover-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@card-default-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@card-default-hover-background`**

- `component`: `darken(@card-default-background, 5%)`
- `theme`: `@card-default-background`
- **Final**: `@card-default-background`

**`@card-primary-hover-background`**

- `component`: `darken(@card-primary-background, 5%)`
- `theme`: `@card-primary-background`
- **Final**: `@card-primary-background`

**`@card-secondary-hover-background`**

- `component`: `darken(@card-secondary-background, 5%)`
- `theme`: `@card-secondary-background`
- **Final**: `@card-secondary-background`

**`@card-badge-border-radius`**

- `theme`: `2px`
- `master/border-radius`: `0`
- **Final**: `0`

**`@card-badge-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

**`@card-hover-box-shadow`**

- `theme`: `@global-large-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-default-box-shadow`**

- `theme`: `@global-medium-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-default-hover-box-shadow`**

- `theme`: `@global-large-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-default-header-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@card-default-header-border`**

- `theme`: `@global-border`
- `master/base`: `@global-border`
- **Final**: `@global-border`

**`@card-default-footer-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@card-default-footer-border`**

- `theme`: `@global-border`
- `master/base`: `@global-border`
- **Final**: `@global-border`

**`@card-primary-box-shadow`**

- `theme`: `@global-medium-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-primary-hover-box-shadow`**

- `theme`: `@global-large-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-secondary-box-shadow`**

- `theme`: `@global-medium-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-secondary-hover-box-shadow`**

- `theme`: `@global-large-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-overlay-box-shadow`**

- `theme`: `@global-medium-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@card-overlay-hover-box-shadow`**

- `theme`: `@global-large-box-shadow`
- `master/box-shadow`: `none`
- **Final**: `none`

### Comment Overrides

**`@comment-primary-padding`**

- `theme`: `@global-gutter`
- `master/base`: `@global-gutter`
- **Final**: `@global-gutter`

**`@comment-primary-background`**

- `theme`: `@global-muted-background`
- `master/base`: `@global-muted-background`
- **Final**: `@global-muted-background`

### Description-list Overrides

**`@description-list-term-font-size`**

- `theme`: `@global-small-font-size`
- `master/typo`: `@global-font-size`
- **Final**: `@global-font-size`

**`@description-list-term-font-weight`**

- `theme`: `normal`
- `master/typo`: `@global-secondary-font-weight`
- **Final**: `@global-secondary-font-weight`

**`@description-list-term-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

### Dotnav Overrides

**`@dotnav-item-background`**

- `component`: `fade(@global-color, 20%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-dotnav-item-background`**

- `component`: `fade(@inverse-global-color, 50%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@dotnav-item-border-width`**

- `theme`: `1px`
- `master/border`: `0`
- **Final**: `0`

**`@dotnav-item-border`**

- `theme`: `fade(@global-color, 40%)`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@dotnav-item-hover-border`**

- `theme`: `transparent`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@dotnav-item-onclick-border`**

- `theme`: `transparent`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@dotnav-item-active-border`**

- `theme`: `transparent`
- `master/border`: `transparent`
- **Final**: `transparent`

### Dropbar Overrides

**`@dropbar-padding-top`**

- `component`: `15px`
- `theme`: `25px`
- **Final**: `25px`

**`@dropbar-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@dropbar-top-box-shadow`**

- `theme`: `0 12px 7px -6px rgba(0, 0, 0, 0.05)`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@dropbar-bottom-box-shadow`**

- `theme`: `0 -12px 7px -6px rgba(0, 0, 0, 0.05)`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@dropbar-left-box-shadow`**

- `theme`: `12px 0 7px -6px rgba(0, 0, 0, 0.05)`
- `master/box-shadow`: `none`
- **Final**: `none`

**`@dropbar-right-box-shadow`**

- `theme`: `-12px 0 7px -6px rgba(0, 0, 0, 0.05)`
- `master/box-shadow`: `none`
- **Final**: `none`

### Dropdown Overrides

**`@dropdown-padding`**

- `component`: `15px`
- `theme`: `25px`
- **Final**: `25px`

**`@dropdown-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@dropdown-dropbar-padding-top`**

- `component`: `@dropdown-padding`
- `theme`: `5px`
- **Final**: `5px`

**`@dropdown-nav-subtitle-font-size`**

- `component`: `@global-small-font-size`
- `theme`: `12px`
- **Final**: `12px`

**`@dropdown-nav-font-size`**

- `theme`: `@global-small-font-size`
- `master/typo`: `@global-font-size`
- **Final**: `@global-font-size`

**`@dropdown-box-shadow`**

- `theme`: `0 5px 12px rgba(0,0,0,0.15)`
- `master/box-shadow`: `none`
- **Final**: `none`

### Form Overrides

**`@form-line-height`**

- `component`: `@form-height`
- `theme`: `@form-height - (2* @form-border-width)`
- `master/border`: `@form-height - (@form-border-width * 2)`
- **Final**: `@form-height - (@form-border-width * 2)`

**`@form-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@form-focus-background`**

- `component`: `darken(@form-background, 5%)`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@form-radio-background`**

- `component`: `darken(@global-muted-background, 5%)`
- `theme`: `transparent`
- **Final**: `transparent`

**`@form-small-line-height`**

- `component`: `@form-small-height`
- `theme`: `@form-small-height - (2* @form-border-width)`
- `master/border`: `@form-small-height - (@form-border-width * 2)`
- **Final**: `@form-small-height - (@form-border-width * 2)`

**`@form-large-line-height`**

- `component`: `@form-large-height`
- `theme`: `@form-large-height - (2* @form-border-width)`
- `master/border`: `@form-large-height - (@form-border-width * 2)`
- **Final**: `@form-large-height - (@form-border-width * 2)`

**`@form-stacked-margin-bottom`**

- `component`: `@global-small-margin`
- `theme`: `5px`
- **Final**: `5px`

**`@form-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@form-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-disabled-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-danger-border`**

- `theme`: `@global-danger-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-success-border`**

- `theme`: `@global-success-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-blank-focus-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-blank-focus-border-style`**

- `theme`: `solid`
- `master/border`: `solid`
- **Final**: `solid`

**`@form-radio-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@form-radio-border`**

- `theme`: `darken(@global-border, 10%)`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-radio-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-radio-checked-border`**

- `theme`: `transparent`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-radio-disabled-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@form-label-color`**

- `theme`: `@global-emphasis-color`
- `master/typo`: `@global-emphasis-color`
- **Final**: `@global-emphasis-color`

**`@form-label-font-size`**

- `theme`: `@global-small-font-size`
- `master/base`: `@global-font-size`
- **Final**: `@global-font-size`

**`@inverse-form-label-color`**

- `theme`: `@inverse-global-emphasis-color`
- `master/typo`: `@inverse-global-emphasis-color`
- **Final**: `@inverse-global-emphasis-color`

### Form-range Overrides

**`@form-range-thumb-background`**

- `component`: `@global-color`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@inverse-form-range-thumb-background`**

- `component`: `fadein(@inverse-global-color, 100%)`
- `theme`: `darken(fadein(@inverse-global-color, 100%), 50%)`
- **Final**: `darken(fadein(@inverse-global-color, 100%), 50%)`

**`@form-range-track-border-radius`**

- `theme`: `500px`
- `master/border-radius`: `500px`
- **Final**: `500px`

**`@form-range-thumb-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@form-range-thumb-border`**

- `theme`: `darken(@global-border, 10%)`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@inverse-form-range-thumb-border`**

- `theme`: `darken(fadein(@inverse-global-border, 100%), 10%)`
- `master/border`: `darken(fadein(@inverse-global-border, 100%), 10%)`
- **Final**: `darken(fadein(@inverse-global-border, 100%), 10%)`

### Label Overrides

**`@label-border-radius`**

- `theme`: `2px`
- `master/border-radius`: `0`
- **Final**: `0`

**`@label-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

### List Overrides

**`@list-striped-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@list-striped-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

### Modal Overrides

**`@modal-header-background`**

- `component`: `@global-muted-background`
- `theme`: `@modal-dialog-background`
- `master/base`: `@modal-dialog-background`
- **Final**: `@modal-dialog-background`

**`@modal-footer-background`**

- `component`: `@global-muted-background`
- `theme`: `@modal-dialog-background`
- `master/base`: `@modal-dialog-background`
- **Final**: `@modal-dialog-background`

**`@modal-header-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@modal-header-border`**

- `theme`: `@global-border`
- `master/base`: `@global-border`
- **Final**: `@global-border`

**`@modal-footer-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@modal-footer-border`**

- `theme`: `@global-border`
- `master/base`: `@global-border`
- **Final**: `@global-border`

**`@modal-close-full-padding`**

- `theme`: `10px`
- `master/base`: `10px`
- **Final**: `10px`

**`@modal-close-full-background`**

- `theme`: `@modal-dialog-background`
- `master/base`: `@modal-dialog-background`
- **Final**: `@modal-dialog-background`

**`@modal-close-full-padding-m`**

- `theme`: `@global-margin`
- `master/base`: `@global-margin`
- **Final**: `@global-margin`

### Nav Overrides

**`@nav-default-font-size`**

- `component`: `@global-font-size`
- `theme`: `@global-small-font-size`
- **Final**: `@global-small-font-size`

**`@nav-default-subtitle-font-size`**

- `component`: `@global-small-font-size`
- `theme`: `12px`
- **Final**: `12px`

**`@nav-secondary-margin-top`**

- `theme`: `0`
- `master/base`: `0`
- **Final**: `0`

**`@nav-secondary-item-padding-horizontal`**

- `theme`: `10px`
- `master/base`: `@nav-item-padding-horizontal`
- **Final**: `@nav-item-padding-horizontal`

**`@nav-secondary-item-padding-vertical`**

- `theme`: `10px`
- `master/base`: `@nav-item-padding-vertical`
- **Final**: `@nav-item-padding-vertical`

**`@nav-secondary-item-hover-background`**

- `theme`: `@global-muted-background`
- `master/base`: `transparent`
- **Final**: `transparent`

**`@nav-secondary-item-active-background`**

- `theme`: `@global-muted-background`
- `master/base`: `transparent`
- **Final**: `transparent`

### Navbar Overrides

**`@navbar-gap`**

- `component`: `0px`
- `theme`: `15px`
- `master/base`: `15px`
- **Final**: `15px`

**`@navbar-nav-gap`**

- `component`: `0px`
- `theme`: `15px`
- `master/base`: `15px`
- **Final**: `15px`

**`@navbar-nav-item-padding-horizontal`**

- `component`: `15px`
- `theme`: `0`
- `master/base`: `0`
- **Final**: `0`

**`@navbar-nav-item-font-size`**

- `component`: `@global-font-size`
- `theme`: `@global-small-font-size`
- **Final**: `@global-small-font-size`

**`@navbar-nav-item-font-family`**

- `component`: `@global-font-family`
- `master/typo`: `@global-secondary-font-family`
- **Final**: `@global-secondary-font-family`

**`@navbar-item-padding-horizontal`**

- `component`: `15px`
- `theme`: `0`
- `master/base`: `0`
- **Final**: `0`

**`@navbar-dropdown-margin`**

- `component`: `0`
- `theme`: `15px`
- **Final**: `15px`

**`@navbar-dropdown-padding`**

- `component`: `15px`
- `theme`: `25px`
- **Final**: `25px`

**`@navbar-dropdown-background`**

- `component`: `@global-muted-background`
- `theme`: `@global-background`
- **Final**: `@global-background`

**`@navbar-dropdown-nav-subtitle-font-size`**

- `component`: `@global-small-font-size`
- `theme`: `12px`
- **Final**: `12px`

**`@navbar-gap-m`**

- `theme`: `30px`
- `master/base`: `30px`
- **Final**: `30px`

**`@navbar-nav-gap-m`**

- `theme`: `30px`
- `master/base`: `30px`
- **Final**: `30px`

**`@navbar-nav-item-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

**`@navbar-dropdown-nav-font-size`**

- `theme`: `@global-small-font-size`
- `master/typo`: `@global-font-size`
- **Final**: `@global-font-size`

**`@navbar-dropdown-box-shadow`**

- `theme`: `0 5px 12px rgba(0,0,0,0.15)`
- `master/box-shadow`: `none`
- **Final**: `none`

### Notification Overrides

**`@notification-position`**

- `component`: `10px`
- `master/base`: `15px`
- **Final**: `15px`

**`@notification-width`**

- `component`: `350px`
- `master/base`: `420px`
- **Final**: `420px`

**`@notification-message-padding`**

- `component`: `@global-small-gutter`
- `master/base`: `@global-gutter`
- **Final**: `@global-gutter`

**`@notification-message-font-size`**

- `component`: `@global-medium-font-size`
- `master/base`: `@global-font-size`
- **Final**: `@global-font-size`

**`@notification-message-line-height`**

- `component`: `1.4`
- `master/base`: `1.5`
- **Final**: `1.5`

**`@notification-close-top`**

- `component`: `@notification-message-padding + 5px`
- `master/base`: `(@notification-message-padding / 2)`
- **Final**: `(@notification-message-padding / 2)`

**`@notification-close-right`**

- `component`: `@notification-message-padding`
- `master/base`: `(@notification-message-padding / 2)`
- **Final**: `(@notification-message-padding / 2)`

**`@notification-message-primary-color`**

- `component`: `@global-primary-background`
- `master/base`: `@global-inverse-color`
- **Final**: `@global-inverse-color`

**`@notification-message-success-color`**

- `component`: `@global-success-background`
- `master/base`: `@global-inverse-color`
- **Final**: `@global-inverse-color`

**`@notification-message-warning-color`**

- `component`: `@global-warning-background`
- `master/base`: `@global-inverse-color`
- **Final**: `@global-inverse-color`

**`@notification-message-danger-color`**

- `component`: `@global-danger-background`
- `master/base`: `@global-inverse-color`
- **Final**: `@global-inverse-color`

### Placeholder Overrides

**`@placeholder-background`**

- `component`: `@global-muted-background`
- `theme`: `transparent`
- `master/base`: `transparent`
- **Final**: `transparent`

**`@placeholder-border-width`**

- `theme`: `@global-border-width`
- `master/base`: `@global-border-width`
- **Final**: `@global-border-width`

**`@placeholder-border`**

- `theme`: `@global-border`
- `master/base`: `@global-border`
- **Final**: `@global-border`

### Progress Overrides

**`@progress-border-radius`**

- `theme`: `500px`
- `master/border-radius`: `500px`
- **Final**: `500px`

### Search Overrides

**`@search-default-background`**

- `component`: `@global-muted-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@search-navbar-focus-background`**

- `component`: `darken(@search-navbar-background, 1%)`
- `theme`: `@search-navbar-background`
- **Final**: `@search-navbar-background`

**`@search-medium-background`**

- `component`: `@search-default-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@search-large-background`**

- `component`: `@search-default-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-search-default-background`**

- `component`: `@inverse-global-muted-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-search-navbar-background`**

- `component`: `@inverse-global-muted-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-search-medium-background`**

- `component`: `@inverse-search-default-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@inverse-search-large-background`**

- `component`: `@inverse-search-default-background`
- `theme`: `transparent`
- **Final**: `transparent`

**`@search-default-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@search-default-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-default-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-navbar-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@search-navbar-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-navbar-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-medium-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@search-medium-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-medium-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-large-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@search-large-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

**`@search-large-focus-border`**

- `theme`: `@global-primary-background`
- `master/border`: `transparent`
- **Final**: `transparent`

### Subnav Overrides

**`@subnav-item-font-size`**

- `theme`: `@global-small-font-size`
- `master/typo`: `@global-font-size`
- **Final**: `@global-font-size`

**`@subnav-item-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

### Tab Overrides

**`@tab-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `@global-border-width`
- **Final**: `@global-border-width`

**`@tab-border`**

- `theme`: `@global-border`
- `master/border`: `@global-border`
- **Final**: `@global-border`

**`@tab-item-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `@global-border-width`
- **Final**: `@global-border-width`

**`@tab-item-font-size`**

- `theme`: `@global-small-font-size`
- `master/typo`: `@global-font-size`
- **Final**: `@global-font-size`

**`@tab-item-text-transform`**

- `theme`: `uppercase`
- `master/typo`: `@global-secondary-text-transform`
- **Final**: `@global-secondary-text-transform`

**`@tab-item-active-border`**

- `theme`: `@global-primary-background`
- `master/border`: `@global-primary-background`
- **Final**: `@global-primary-background`

**`@inverse-tab-border`**

- `theme`: `@inverse-global-border`
- `master/border`: `@inverse-global-border`
- **Final**: `@inverse-global-border`

### Table Overrides

**`@table-header-cell-font-size`**

- `component`: `@global-font-size`
- `theme`: `@global-small-font-size`
- `master/base`: `@global-small-font-size`
- **Final**: `@global-small-font-size`

**`@table-header-cell-font-weight`**

- `component`: `bold`
- `theme`: `normal`
- `master/base`: `normal`
- **Final**: `normal`

**`@table-header-cell-color`**

- `component`: `@global-color`
- `theme`: `@global-muted-color`
- `master/base`: `@global-muted-color`
- **Final**: `@global-muted-color`

**`@table-striped-border-width`**

- `theme`: `@global-border-width`
- `master/border`: `0`
- **Final**: `0`

**`@table-striped-border`**

- `theme`: `@global-border`
- `master/border`: `transparent`
- **Final**: `transparent`

### Text Overrides

**`@text-meta-link-color`**

- `theme`: `@text-meta-color`
- `master/base`: `@text-meta-color`
- **Final**: `@text-meta-color`

**`@text-meta-link-hover-color`**

- `theme`: `@global-color`
- `master/base`: `@global-color`
- **Final**: `@global-color`

**`@internal-text-background-color-gradient`**

- `theme`: `linear-gradient(90deg, @text-background-color 0%, spin(@text-background-color...`
- `master/background-image`: `linear-gradient(90deg, @text-background-color 0%, spin(@text-background-color...`
- **Final**: `linear-gradient(90deg, @text-background-color 0%, spin(@text-background-color...`

### Thumbnav Overrides

**`@thumbnav-item-gradient`**

- `theme`: `linear-gradient(180deg, rgba(255,255,255,0), rgba(255,255,255,0.4))`
- `master/background-image`: `~''`
- **Final**: `~''`

**`@thumbnav-item-hover-opacity`**

- `theme`: `0`
- `master/base`: `0`
- **Final**: `0`

**`@thumbnav-item-active-opacity`**

- `theme`: `0`
- `master/base`: `0`
- **Final**: `0`

**`@inverse-thumbnav-item-gradient`**

- `theme`: `linear-gradient(180deg, rgba(0,0,0,0), rgba(0,0,0,0.4))`
- `master/background-image`: `~''`
- **Final**: `~''`
