# UIkit Color, Background & Border Variables Reference

> All Less variables controlling colors, backgrounds, borders, gradients, box shadows, opacity, and color modes extracted from `_all-variables.less`.  
> Grouped by component with descriptions and links to UIkit documentation.

---

## Table of Contents

1. [Global Color Palette](#1-global-color-palette)
2. [Global Borders & Box Shadows](#2-global-borders--box-shadows)
3. [Inverse Mode (Global)](#3-inverse-mode-global)
4. [Base (Body & Typography Colors)](#4-base-body--typography-colors)
5. [Background Utility](#5-background-utility)
6. [Section](#6-section)
7. [Tile](#7-tile)
8. [Card](#8-card)
9. [Button](#9-button)
10. [Navbar](#10-navbar)
11. [Nav](#11-nav)
12. [Dropdown / Dropbar](#12-dropdown--dropbar)
13. [Subnav](#13-subnav)
14. [Tab](#14-tab)
15. [Breadcrumb](#15-breadcrumb)
16. [Pagination](#16-pagination)
17. [Accordion](#17-accordion)
18. [Alert](#18-alert)
19. [Badge](#19-badge)
20. [Label](#20-label)
21. [Notification](#21-notification)
22. [Modal](#22-modal)
23. [Offcanvas](#23-offcanvas)
24. [Overlay](#24-overlay)
25. [Lightbox](#25-lightbox)
26. [Form](#26-form)
27. [Search](#27-search)
28. [Table](#28-table)
29. [Article](#29-article)
30. [Comment](#30-comment)
31. [Heading](#31-heading)
32. [Text Utility](#32-text-utility)
33. [Link Utility](#33-link-utility)
34. [List](#34-list)
35. [Description List](#35-description-list)
36. [Divider](#36-divider)
37. [Icon / Iconnav](#37-icon--iconnav)
38. [Dotnav](#38-dotnav)
39. [Slidenav](#39-slidenav)
40. [Thumbnav](#40-thumbnav)
41. [Logo](#41-logo)
42. [Marker](#42-marker)
43. [Totop](#43-totop)
44. [Leader](#44-leader)
45. [Progress](#45-progress)
46. [Placeholder](#46-placeholder)
47. [Grid Divider](#47-grid-divider)
48. [Column Divider](#48-column-divider)
49. [Panel / Sortable / Box Shadow](#49-panel--sortable--box-shadow)
50. [Tooltip](#50-tooltip)
51. [Close](#51-close)
52. [Dropcap](#52-dropcap)
53. [Internal / YOOtheme Pro Enhancements](#53-internal--yootheme-pro-enhancements)
54. [Color Cascade Diagram](#54-color-cascade-diagram)
55. [Inverse Color Cascade](#55-inverse-color-cascade)

---

## How Colors Cascade in UIkit

UIkit uses **7 global color tokens** that cascade to every component. Changing a global token changes hundreds of derived variables at once:

| Token | Default | Used For |
|-------|---------|----------|
| `@global-color` | `#666` | Body text, secondary text, hover states |
| `@global-emphasis-color` | `#333` | Headings, active states, strong text |
| `@global-muted-color` | `#999` | Placeholder text, meta, disabled, icons |
| `@global-link-color` | `#1e87f0` | Links (default state) |
| `@global-link-hover-color` | `#0f6ecd` | Links (hover state) |
| `@global-inverse-color` | `#fff` | Text on colored/dark backgrounds |
| `@global-background` | `#fff` | Page background, card default, modal, form |
| `@global-muted-background` | `#f8f8f8` | Muted sections, striped rows, icon buttons |
| `@global-primary-background` | `#1e87f0` | Primary buttons, badges, labels, active states |
| `@global-secondary-background` | `#222` | Secondary buttons, section-secondary, offcanvas |
| `@global-success-background` | `#32d296` | Success alerts, labels, notifications |
| `@global-warning-background` | `#faa05a` | Warning alerts, labels, notifications |
| `@global-danger-background` | `#f0506e` | Danger buttons, alerts, labels, form error |
| `@global-border` | `#e5e5e5` | Dividers, table borders, card footers, form borders |

---

## 1. Global Color Palette

The foundation for all colors across the theme. Every component references these tokens.

### Text & Link Colors

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-color` | `#666` | Default body text color. |
| `@global-emphasis-color` | `#333` | Emphasis text — headings, active items, strong text. |
| `@global-muted-color` | `#999` | Muted/secondary text — meta, placeholders, disabled states. |
| `@global-inverse-color` | `#fff` | Text on dark/colored backgrounds (buttons, badges, primary cards). |
| `@global-link-color` | `#1e87f0` | Default link color. |
| `@global-link-hover-color` | `#0f6ecd` | Link hover color. |

### Background Colors

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-background` | `#fff` | Page background. Cascades to cards, modals, dropdowns, forms. |
| `@global-muted-background` | `#f8f8f8` | Muted background — sections, tiles, striped rows, icon buttons. |
| `@global-primary-background` | `#1e87f0` | Primary brand color — buttons, badges, labels, section-primary, tile-primary. |
| `@global-secondary-background` | `#222` | Secondary brand color — buttons, offcanvas, section-secondary. |
| `@global-success-background` | `#32d296` | Success color — alerts, labels, notifications, form success. |
| `@global-warning-background` | `#faa05a` | Warning color — alerts, labels, notifications. |
| `@global-danger-background` | `#f0506e` | Danger color — buttons, alerts, labels, form errors. |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 2. Global Borders & Box Shadows

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-border` | `#e5e5e5` | Default border color for dividers, tables, card headers/footers. |
| `@global-border-width` | `1px` | Default border width. Referenced by ~40 components. |
| `@global-border-radius` | `0` | Default border radius (not a color but shapes component corners). |
| `@global-small-box-shadow` | `0 2px 8px rgba(0,0,0,0.08)` | Small shadow — dropdowns, sticky navbar. |
| `@global-medium-box-shadow` | `0 5px 15px rgba(0,0,0,0.08)` | Medium shadow — cards, modals. |
| `@global-large-box-shadow` | `0 14px 25px rgba(0,0,0,0.16)` | Large shadow — elevated cards. |
| `@global-xlarge-box-shadow` | `0 28px 50px rgba(0,0,0,0.16)` | Extra-large shadow — lightbox. |
| `@border-rounded-border-radius` | `5px` | The `.uk-border-rounded` utility class. |
| `@box-shadow-bottom-background` | `#444` | Pseudo-element box-shadow-bottom color. |
| `@box-shadow-bottom-blur` | `20px` | Blur radius for box-shadow-bottom. |
| `@box-shadow-bottom-height` | `30px` | Height of the shadow pseudo-element. |
| `@box-shadow-duration` | `0.1s` | Transition duration for shadow effects. |

📖 [UIkit Utility docs](https://getuikit.com/docs/utility)

---

## 3. Inverse Mode (Global)

When a component is placed on a dark/colored background (e.g. `.uk-section-primary`, `.uk-section-secondary`, `.uk-tile-primary`), UIkit activates **inverse mode**. These 8 tokens replace the normal global tokens within that context:

| Variable | Default | Maps From |
|----------|---------|-----------|
| `@inverse-global-color` | `fade(@global-inverse-color, 70%)` | → `@global-color` |
| `@inverse-global-emphasis-color` | `@global-inverse-color` | → `@global-emphasis-color` |
| `@inverse-global-muted-color` | `fade(@global-inverse-color, 50%)` | → `@global-muted-color` |
| `@inverse-global-inverse-color` | `@global-color` | → `@global-inverse-color` |
| `@inverse-global-primary-background` | `@global-inverse-color` | → `@global-primary-background` |
| `@inverse-global-muted-background` | `fade(@global-inverse-color, 10%)` | → `@global-muted-background` |
| `@inverse-global-border` | `fade(@global-inverse-color, 20%)` | → `@global-border` |
| `@inverse-global-color-mode` | `light` | Controls child color mode. |

📖 [UIkit Inverse docs](https://getuikit.com/docs/inverse)

---

## 4. Base (Body & Typography Colors)

Colors for HTML base elements — body, headings, links, code, blockquotes, marks, etc.

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-body-background` | `@global-background` | `<body>` background color. |
| `@base-body-color` | `@global-color` | `<body>` text color. |
| `@base-heading-color` | `@global-emphasis-color` | Default heading color (h1–h6 inherit). |
| `@base-h1-color` | `@base-heading-color` | `<h1>` color. |
| `@base-h2-color` | `@base-heading-color` | `<h2>` color. |
| `@base-h3-color` | `@base-heading-color` | `<h3>` color. |
| `@base-h4-color` | `@base-heading-color` | `<h4>` color. |
| `@base-h5-color` | `@base-heading-color` | `<h5>` color. |
| `@base-h6-color` | `@base-heading-color` | `<h6>` color. |
| `@base-link-color` | `@global-link-color` | `<a>` link color. |
| `@base-link-hover-color` | `@global-link-hover-color` | `<a>` hover color. |
| `@base-em-color` | `@global-danger-background` | `<em>` text color. |
| `@base-code-color` | `@global-danger-background` | `<code>` text color. |
| `@base-code-background` | `transparent` | `<code>` background. |
| `@base-code-border` | `transparent` | `<code>` border color. |
| `@base-pre-color` | `@global-color` | `<pre>` text color. |
| `@base-pre-background` | `transparent` | `<pre>` background. |
| `@base-pre-border` | `transparent` | `<pre>` border color. |
| `@base-blockquote-color` | `@global-emphasis-color` | `<blockquote>` text color. |
| `@base-blockquote-background` | `transparent` | `<blockquote>` background. |
| `@base-blockquote-border` | `transparent` | `<blockquote>` border. |
| `@base-blockquote-footer-color` | `@global-color` | Blockquote footer/citation color. |
| `@base-ins-background` | `#ffd` | `<ins>` highlight background. |
| `@base-ins-color` | `@global-color` | `<ins>` text color. |
| `@base-mark-background` | `#ffd` | `<mark>` highlight background. |
| `@base-mark-color` | `@global-color` | `<mark>` text color. |
| `@base-selection-background` | `#39f` | Text selection background. |
| `@base-selection-color` | `@global-inverse-color` | Text selection text color. |
| `@base-focus-outline` | `@global-emphasis-color` | Focus ring outline color. |
| `@base-hr-border` | `@global-border` | `<hr>` border color. |
| `@base-hr-box-shadow` | `none` | `<hr>` box shadow. |

### Inverse Base Colors

| Variable | Default |
|----------|---------|
| `@inverse-base-color` | `@inverse-global-color` |
| `@inverse-base-heading-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-h1-color` … `@inverse-base-h6-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-link-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-link-hover-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-em-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-code-color` | `@inverse-global-color` |
| `@inverse-base-code-background` | `transparent` |
| `@inverse-base-code-border` | `transparent` |
| `@inverse-base-blockquote-color` | `@inverse-global-emphasis-color` |
| `@inverse-base-blockquote-background` | `transparent` |
| `@inverse-base-blockquote-border` | `transparent` |
| `@inverse-base-blockquote-footer-color` | `@inverse-global-color` |
| `@inverse-base-focus-outline` | `@inverse-global-emphasis-color` |
| `@inverse-base-hr-border` | `@inverse-global-border` |
| `@inverse-base-hr-box-shadow` | `none` |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 5. Background Utility

The `.uk-background-*` utility classes.

| Variable | Default | Description |
|----------|---------|-------------|
| `@background-default-background` | `@global-background` | `.uk-background-default` |
| `@background-muted-background` | `@global-muted-background` | `.uk-background-muted` |
| `@background-primary-background` | `@global-primary-background` | `.uk-background-primary` |
| `@background-secondary-background` | `@global-secondary-background` | `.uk-background-secondary` |

📖 [UIkit Background docs](https://getuikit.com/docs/background)

---

## 6. Section

Full-width page sections with color modes that trigger inverse child styling.

| Variable | Default | Description |
|----------|---------|-------------|
| `@section-default-background` | `@global-background` | Default section background. |
| `@section-default-color-mode` | `dark` | Child color mode (dark = normal text colors). |
| `@section-muted-background` | `@global-muted-background` | Muted section background. |
| `@section-muted-color-mode` | `dark` | Muted section child color mode. |
| `@section-primary-background` | `@global-primary-background` | Primary section (brand color). |
| `@section-primary-color-mode` | `light` | Triggers inverse mode for children. |
| `@section-secondary-background` | `@global-secondary-background` | Secondary section (dark). |
| `@section-secondary-color-mode` | `light` | Triggers inverse mode for children. |
| `@section-border-radius` | `clamp(30px, 7.1429px + 3.5714vw, 50px)` | Rounded section corners (YOOtheme Pro). |

📖 [UIkit Section docs](https://getuikit.com/docs/section)

---

## 7. Tile

Content blocks similar to sections, with background color variants and hover states.

| Variable | Default | Description |
|----------|---------|-------------|
| `@tile-default-background` | `@global-background` | Default tile background. |
| `@tile-default-color-mode` | `dark` | Default tile child color mode. |
| `@tile-default-hover-background` | `darken(@tile-muted-background, 2%)` | Default tile hover. |
| `@tile-muted-background` | `@global-muted-background` | Muted tile background. |
| `@tile-muted-color-mode` | `dark` | Muted tile child color mode. |
| `@tile-muted-hover-background` | `darken(@tile-muted-background, 2%)` | Muted tile hover. |
| `@tile-primary-background` | `@global-primary-background` | Primary tile background. |
| `@tile-primary-color-mode` | `light` | Primary tile child color mode (inverse). |
| `@tile-primary-hover-background` | `darken(@tile-primary-background, 4%)` | Primary tile hover. |
| `@tile-secondary-background` | `@global-secondary-background` | Secondary tile background. |
| `@tile-secondary-color-mode` | `light` | Secondary tile child color mode (inverse). |
| `@tile-secondary-hover-background` | `darken(@tile-secondary-background, 4%)` | Secondary tile hover. |

📖 [UIkit Tile docs](https://getuikit.com/docs/tile)

---

## 8. Card

Cards with multiple style variants. Each variant has background, color, border, box-shadow, and hover states.

### Card Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-default-background` | `@global-background` | Default card background. |
| `@card-default-color` | `@global-color` | Default card text color. |
| `@card-default-color-mode` | `dark` | Child color mode. |
| `@card-default-title-color` | `@global-emphasis-color` | Card title color. |
| `@card-default-border` | `transparent` | Card border color. |
| `@card-default-box-shadow` | `none` | Card box shadow. |
| `@card-default-hover-background` | `@card-default-background` | Hover background. |
| `@card-default-hover-border` | `transparent` | Hover border. |
| `@card-default-hover-box-shadow` | `none` | Hover shadow. |
| `@card-default-header-border` | `@global-border` | Card header divider border. |
| `@card-default-footer-border` | `@global-border` | Card footer divider border. |

### Card Primary

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-primary-background` | `@global-primary-background` | Primary card background. |
| `@card-primary-color` | `@global-inverse-color` | Primary card text color. |
| `@card-primary-color-mode` | `light` | Triggers inverse child colors. |
| `@card-primary-title-color` | `@card-primary-color` | Primary card title. |
| `@card-primary-border` | `transparent` | Primary card border. |
| `@card-primary-box-shadow` | `none` | Primary card shadow. |
| `@card-primary-hover-background` | `@card-primary-background` | Primary card hover background. |
| `@card-primary-hover-border` | `transparent` | Primary card hover border. |
| `@card-primary-hover-box-shadow` | `none` | Primary card hover shadow. |

### Card Secondary

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-secondary-background` | `@global-secondary-background` | Secondary card background. |
| `@card-secondary-color` | `@global-inverse-color` | Secondary card text. |
| `@card-secondary-color-mode` | `light` | Triggers inverse child colors. |
| `@card-secondary-title-color` | `@card-secondary-color` | Secondary card title. |
| `@card-secondary-border` | `transparent` | Secondary card border. |
| `@card-secondary-box-shadow` | `none` | Secondary card shadow. |
| `@card-secondary-hover-background` | `@card-secondary-background` | Secondary card hover background. |
| `@card-secondary-hover-border` | `transparent` | Secondary card hover border. |
| `@card-secondary-hover-box-shadow` | `none` | Secondary card hover shadow. |

### Card Overlay

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-overlay-background` | `fade(@global-background, 90%)` | Overlay card semi-transparent bg. |
| `@card-overlay-color` | `@global-color` | Overlay card text color. |
| `@card-overlay-color-mode` | `dark` | Overlay card child color mode. |
| `@card-overlay-title-color` | `@global-emphasis-color` | Overlay card title. |
| `@card-overlay-border` | `transparent` | Overlay card border. |
| `@card-overlay-box-shadow` | `none` | Overlay card shadow. |
| `@card-overlay-hover-background` | `fadein(@card-overlay-background, 10%)` | Hover background. |
| `@card-overlay-inverse-background` | `@card-overlay-background` | Inverse mode override. |
| `@card-overlay-hover-inverse-background` | `@card-overlay-hover-background` | Inverse hover override. |

### Card Hover & Other

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-hover-background` | `@global-background` | `.uk-card-hover` background. |
| `@card-hover-border` | `transparent` | Hover border. |
| `@card-hover-box-shadow` | `none` | Hover shadow. |
| `@card-border-radius` | `0` | Card border radius. |

### Card Badge

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-badge-background` | `@global-primary-background` | Badge background color. |
| `@card-badge-color` | `@global-inverse-color` | Badge text color. |
| `@card-badge-border` | `transparent` | Badge border. |

### Inverse Card Badge

| Variable | Default |
|----------|---------|
| `@inverse-card-badge-background` | `@inverse-global-primary-background` |
| `@inverse-card-badge-color` | `@inverse-global-inverse-color` |
| `@inverse-card-badge-border` | `transparent` |

📖 [UIkit Card docs](https://getuikit.com/docs/card)

---

## 9. Button

Buttons have 6 style variants with full state coverage: default, hover, active. Plus disabled and text/link styles.

### Button Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-default-background` | `transparent` | Default button background. |
| `@button-default-color` | `@global-emphasis-color` | Default button text. |
| `@button-default-border` | `transparent` | Default button border. |
| `@button-default-box-shadow` | `none` | Default button shadow. |
| `@button-default-hover-background` | `transparent` | Hover background. |
| `@button-default-hover-color` | `@global-emphasis-color` | Hover text. |
| `@button-default-hover-border` | `transparent` | Hover border. |
| `@button-default-hover-box-shadow` | `none` | Hover shadow. |
| `@button-default-active-background` | `transparent` | Active background. |
| `@button-default-active-color` | `@global-emphasis-color` | Active text. |
| `@button-default-active-border` | `transparent` | Active border. |
| `@button-default-active-box-shadow` | `none` | Active shadow. |

### Button Primary

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-primary-background` | `@global-primary-background` | Primary button bg. |
| `@button-primary-color` | `@global-inverse-color` | Primary button text. |
| `@button-primary-border` | `transparent` | Primary button border. |
| `@button-primary-box-shadow` | `none` | Primary button shadow. |
| `@button-primary-hover-background` | `darken(@button-primary-background, 5%)` | Hover bg. |
| `@button-primary-hover-color` | `@global-inverse-color` | Hover text. |
| `@button-primary-hover-border` | `transparent` | Hover border. |
| `@button-primary-active-background` | `darken(@button-primary-background, 10%)` | Active bg. |
| `@button-primary-active-color` | `@global-inverse-color` | Active text. |

### Button Secondary

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-secondary-background` | `@global-secondary-background` | Secondary button bg. |
| `@button-secondary-color` | `@global-inverse-color` | Secondary button text. |
| `@button-secondary-border` | `transparent` | Secondary button border. |
| `@button-secondary-hover-background` | `darken(@button-secondary-background, 5%)` | Hover bg. |
| `@button-secondary-hover-color` | `@global-inverse-color` | Hover text. |
| `@button-secondary-active-background` | `darken(@button-secondary-background, 10%)` | Active bg. |
| `@button-secondary-active-color` | `@global-inverse-color` | Active text. |

### Button Danger

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-danger-background` | `@global-danger-background` | Danger button bg. |
| `@button-danger-color` | `@global-inverse-color` | Danger button text. |
| `@button-danger-border` | `transparent` | Danger button border. |
| `@button-danger-hover-background` | `darken(@button-danger-background, 5%)` | Hover bg. |
| `@button-danger-hover-color` | `@global-inverse-color` | Hover text. |
| `@button-danger-active-background` | `darken(@button-danger-background, 10%)` | Active bg. |
| `@button-danger-active-color` | `@global-inverse-color` | Active text. |

### Button Text & Link

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-text-color` | `@global-emphasis-color` | Text button color. |
| `@button-text-hover-color` | `@global-emphasis-color` | Text button hover. |
| `@button-text-disabled-color` | `@global-muted-color` | Text button disabled. |
| `@button-text-border` | `currentColor` | Text button underline. |
| `@button-text-hover-border` | `currentColor` | Text button hover underline. |
| `@button-link-color` | `@global-emphasis-color` | Link button color. |
| `@button-link-hover-color` | `@global-muted-color` | Link button hover. |
| `@button-link-disabled-color` | `@global-muted-color` | Link button disabled. |

### Button Disabled

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-disabled-background` | `transparent` | Disabled button bg. |
| `@button-disabled-color` | `@global-muted-color` | Disabled button text. |
| `@button-disabled-border` | `transparent` | Disabled button border. |

### Button Shared

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-border-radius` | `0` | Button border radius. |
| `@button-border-width` | `0` | Button border width. |

### Inverse Buttons

All button variants have inverse equivalents (prefixed `@inverse-button-*`) that apply when placed inside `color-mode: light` contexts. They reference the `@inverse-global-*` tokens.

| Normal Token → | Inverse Token |
|----------------|---------------|
| `@button-default-color` | `@inverse-button-default-color` → `@inverse-global-emphasis-color` |
| `@button-primary-background` | `@inverse-button-primary-background` → `@inverse-global-primary-background` |
| `@button-primary-color` | `@inverse-button-primary-color` → `@inverse-global-inverse-color` |
| `@button-secondary-background` | `@inverse-button-secondary-background` → `@inverse-global-primary-background` |
| `@button-text-color` | `@inverse-button-text-color` → `@inverse-global-emphasis-color` |
| `@button-link-color` | `@inverse-button-link-color` → `@inverse-global-emphasis-color` |

📖 [UIkit Button docs](https://getuikit.com/docs/button)

---

## 10. Navbar

The site navigation bar with items, toggles, subtitles, and dropdown support.

### Navbar Container

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-background` | `@global-muted-background` | Navbar background. |
| `@navbar-color-mode` | `dark` | Navbar child color mode. |
| `@navbar-border` | `transparent` | Navbar border. |
| `@navbar-border-width` | `0` | Navbar border width. |
| `@navbar-border-mode` | `bottom-transparent` | Border mode (top/bottom/full). |
| `@navbar-box-shadow` | `none` | Navbar box shadow. |
| `@navbar-sticky-box-shadow` | `none` | Sticky navbar shadow. |
| `@navbar-group-box-shadow` | `none` | Navbar group shadow. |

### Navbar Items

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-nav-item-color` | `@global-muted-color` | Nav item default color. |
| `@navbar-nav-item-hover-color` | `@global-color` | Nav item hover color. |
| `@navbar-nav-item-active-color` | `@global-emphasis-color` | Nav item active color. |
| `@navbar-nav-item-onclick-color` | `@global-emphasis-color` | Nav item click color. |
| `@navbar-nav-item-background` | `transparent` | Nav item background. |
| `@navbar-nav-item-hover-background` | `transparent` | Hover background. |
| `@navbar-nav-item-active-background` | `transparent` | Active background. |
| `@navbar-nav-item-box-shadow` | `none` | Item box shadow. |
| `@navbar-nav-item-text-shadow` | `none` | Item text shadow. |
| `@navbar-item-color` | `@global-color` | Content item text color. |
| `@navbar-subtitle-color` | `@navbar-nav-item-color` | Subtitle color. |

### Navbar Item Line (Active Indicator)

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-nav-item-line-background` | `transparent` | Line background (default state). |
| `@navbar-nav-item-line-hover-background` | `@global-primary-background` | Line on hover. |
| `@navbar-nav-item-line-active-background` | `@global-primary-background` | Line when active. |
| `@navbar-nav-item-line-onclick-background` | `@global-primary-background` | Line on click. |
| `@navbar-nav-item-line-opacity` | `1` | Line opacity. |
| `@navbar-nav-item-line-border-radius` | `0` | Line border radius. |

### Navbar Toggle

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-toggle-color` | `@global-muted-color` | Toggle icon color. |
| `@navbar-toggle-hover-color` | `@global-color` | Toggle hover color. |
| `@navbar-toggle-background` | `transparent` | Toggle background. |
| `@navbar-toggle-hover-background` | `transparent` | Toggle hover background. |

### Navbar Primary Items (Transparent Overlay)

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-primary-nav-item-color` | `transparent` | Primary navbar item color. |
| `@navbar-primary-nav-item-hover-color` | `transparent` | Primary hover. |
| `@navbar-primary-nav-item-active-color` | `transparent` | Primary active. |
| `@navbar-primary-nav-item-onclick-color` | `transparent` | Primary click. |

### Navbar Dropdown

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-background` | `@global-background` | Dropdown background. |
| `@navbar-dropdown-color` | `@global-color` | Dropdown text color. |
| `@navbar-dropdown-color-mode` | `dark` | Dropdown child color mode. |
| `@navbar-dropdown-border` | `transparent` | Dropdown border. |
| `@navbar-dropdown-box-shadow` | `none` | Dropdown shadow. |
| `@navbar-dropdown-nav-item-color` | `@global-muted-color` | Dropdown nav item color. |
| `@navbar-dropdown-nav-item-hover-color` | `@global-color` | Dropdown item hover. |
| `@navbar-dropdown-nav-item-hover-background` | `transparent` | Dropdown item hover bg. |
| `@navbar-dropdown-nav-item-active-color` | `@global-emphasis-color` | Dropdown item active. |
| `@navbar-dropdown-nav-header-color` | `@global-emphasis-color` | Dropdown header color. |
| `@navbar-dropdown-nav-divider-border` | `@global-border` | Dropdown divider border. |
| `@navbar-dropdown-nav-sublist-item-color` | `@global-muted-color` | Sublist item color. |
| `@navbar-dropdown-nav-sublist-item-hover-color` | `@global-color` | Sublist hover. |
| `@navbar-dropdown-nav-sublist-item-active-color` | `@global-emphasis-color` | Sublist active. |
| `@navbar-dropdown-nav-subtitle-color` | `@navbar-dropdown-nav-item-color` | Subtitle. |

### Inverse Navbar

| Variable | Default |
|----------|---------|
| `@inverse-navbar-border` | `transparent` |
| `@inverse-navbar-nav-item-color` | `@inverse-global-muted-color` |
| `@inverse-navbar-nav-item-hover-color` | `@inverse-global-color` |
| `@inverse-navbar-nav-item-active-color` | `@inverse-global-emphasis-color` |
| `@inverse-navbar-nav-item-onclick-color` | `@inverse-global-emphasis-color` |
| `@inverse-navbar-item-color` | `@inverse-global-color` |
| `@inverse-navbar-subtitle-color` | `@inverse-navbar-nav-item-color` |
| `@inverse-navbar-toggle-color` | `@inverse-global-muted-color` |
| `@inverse-navbar-toggle-hover-color` | `@inverse-global-color` |
| `@inverse-navbar-nav-item-line-*-background` | `@inverse-global-primary-background` |

📖 [UIkit Navbar docs](https://getuikit.com/docs/navbar)

---

## 11. Nav

Side navigation component with default, primary, and secondary styles.

### Nav Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-default-item-color` | `@global-muted-color` | Default nav item text. |
| `@nav-default-item-hover-color` | `@global-color` | Hover text. |
| `@nav-default-item-hover-background` | `transparent` | Hover background. |
| `@nav-default-item-active-color` | `@global-emphasis-color` | Active item text. |
| `@nav-default-item-active-background` | `transparent` | Active background. |
| `@nav-default-header-color` | `@global-emphasis-color` | Section header color. |
| `@nav-default-divider-border` | `@global-border` | Divider border. |
| `@nav-default-sublist-item-color` | `@global-muted-color` | Sub-item color. |
| `@nav-default-sublist-item-hover-color` | `@global-color` | Sub-item hover. |
| `@nav-default-sublist-item-active-color` | `@global-emphasis-color` | Sub-item active. |
| `@nav-default-subtitle-color` | `@nav-default-item-color` | Subtitle color. |
| `@nav-default-item-line-background` | `currentColor` | Active indicator line. |

### Nav Primary

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-primary-item-color` | `@global-muted-color` | Primary nav item text. |
| `@nav-primary-item-hover-color` | `@global-color` | Hover text. |
| `@nav-primary-item-active-color` | `@global-emphasis-color` | Active text. |
| `@nav-primary-header-color` | `@global-emphasis-color` | Section header. |
| `@nav-primary-divider-border` | `@global-border` | Divider border. |
| `@nav-primary-sublist-item-color` | `@global-muted-color` | Sub-item color. |
| `@nav-primary-sublist-item-hover-color` | `@global-color` | Sub-item hover. |
| `@nav-primary-sublist-item-active-color` | `@global-emphasis-color` | Sub-item active. |
| `@nav-primary-subtitle-color` | `@nav-primary-item-color` | Subtitle color. |
| `@nav-primary-item-line-background` | `currentColor` | Active indicator line. |

### Nav Secondary

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-secondary-item-color` | `@global-emphasis-color` | Secondary nav item. |
| `@nav-secondary-item-hover-color` | `@global-emphasis-color` | Hover text. |
| `@nav-secondary-item-hover-background` | `transparent` | Hover background. |
| `@nav-secondary-item-active-color` | `@global-emphasis-color` | Active text. |
| `@nav-secondary-item-active-background` | `transparent` | Active background. |
| `@nav-secondary-subtitle-color` | `@global-muted-color` | Subtitle default. |
| `@nav-secondary-subtitle-hover-color` | `@global-color` | Subtitle hover. |
| `@nav-secondary-subtitle-active-color` | `@global-emphasis-color` | Subtitle active. |
| `@nav-secondary-header-color` | `@global-emphasis-color` | Section header. |
| `@nav-secondary-divider-border` | `@global-border` | Divider border. |
| `@nav-secondary-sublist-item-color` | `@global-muted-color` | Sub-item color. |
| `@nav-secondary-sublist-item-hover-color` | `@global-color` | Sub-item hover. |
| `@nav-secondary-sublist-item-active-color` | `@global-emphasis-color` | Sub-item active. |

### Nav Dividers & Shared

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-dividers-border` | `@global-border` | Nav dividers border. |

All three nav styles have full inverse equivalents (`@inverse-nav-default-*`, `@inverse-nav-primary-*`, `@inverse-nav-secondary-*`) that swap to `@inverse-global-*` tokens.

📖 [UIkit Nav docs](https://getuikit.com/docs/nav)

---

## 12. Dropdown / Dropbar

### Dropdown

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropdown-background` | `@global-background` | Dropdown background. |
| `@dropdown-color` | `@global-color` | Dropdown text color. |
| `@dropdown-color-mode` | `dark` | Child color mode. |
| `@dropdown-border` | `transparent` | Dropdown border. |
| `@dropdown-box-shadow` | `none` | Dropdown shadow. |
| `@dropdown-nav-item-color` | `@global-muted-color` | Nav item color. |
| `@dropdown-nav-item-hover-color` | `@global-color` | Nav item hover. |
| `@dropdown-nav-item-hover-background` | `transparent` | Nav item hover bg. |
| `@dropdown-nav-header-color` | `@global-emphasis-color` | Header color. |
| `@dropdown-nav-divider-border` | `@global-border` | Divider border. |
| `@dropdown-nav-sublist-item-color` | `@global-muted-color` | Sublist item color. |
| `@dropdown-nav-sublist-item-hover-color` | `@global-color` | Sublist hover. |
| `@dropdown-nav-subtitle-color` | `@dropdown-nav-item-color` | Subtitle. |

### Dropbar

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropbar-background` | `@global-background` | Dropbar background. |
| `@dropbar-color` | `@global-color` | Dropbar text color. |
| `@dropbar-color-mode` | `dark` | Child color mode. |
| `@dropbar-top-box-shadow` | `none` | Top shadow. |
| `@dropbar-bottom-box-shadow` | `none` | Bottom shadow. |
| `@dropbar-left-box-shadow` | `none` | Left shadow. |
| `@dropbar-right-box-shadow` | `none` | Right shadow. |

📖 [UIkit Dropdown docs](https://getuikit.com/docs/dropdown) · [Dropbar docs](https://getuikit.com/docs/dropbar)

---

## 13. Subnav

Sub-navigation with plain text and pill (button) styles.

### Subnav Items

| Variable | Default | Description |
|----------|---------|-------------|
| `@subnav-item-color` | `@global-muted-color` | Default item color. |
| `@subnav-item-hover-color` | `@global-color` | Hover color. |
| `@subnav-item-active-color` | `@global-emphasis-color` | Active color. |
| `@subnav-item-disabled-color` | `@global-muted-color` | Disabled color. |
| `@subnav-divider-border` | `@global-border` | Divider between items. |

### Subnav Pill

| Variable | Default | Description |
|----------|---------|-------------|
| `@subnav-pill-item-background` | `transparent` | Pill default bg. |
| `@subnav-pill-item-color` | `@subnav-item-color` | Pill default text. |
| `@subnav-pill-item-border` | `transparent` | Pill border. |
| `@subnav-pill-item-box-shadow` | `none` | Pill shadow. |
| `@subnav-pill-item-hover-background` | `@global-muted-background` | Pill hover bg. |
| `@subnav-pill-item-hover-color` | `@global-color` | Pill hover text. |
| `@subnav-pill-item-active-background` | `@global-primary-background` | Pill active bg. |
| `@subnav-pill-item-active-color` | `@global-inverse-color` | Pill active text. |
| `@subnav-pill-item-onclick-background` | `@subnav-pill-item-hover-background` | Click bg. |
| `@subnav-pill-item-onclick-color` | `@subnav-pill-item-hover-color` | Click text. |

Full inverse equivalents available (`@inverse-subnav-*`).

📖 [UIkit Subnav docs](https://getuikit.com/docs/subnav)

---

## 14. Tab

Tabbed navigation with border-mode active indicators.

| Variable | Default | Description |
|----------|---------|-------------|
| `@tab-border` | `@global-border` | Tab container border. |
| `@tab-box-shadow` | `none` | Tab container shadow. |
| `@tab-item-color` | `@global-muted-color` | Default tab text. |
| `@tab-item-hover-color` | `@global-color` | Hover text. |
| `@tab-item-hover-border` | `currentColor` | Hover border indicator. |
| `@tab-item-active-color` | `@global-emphasis-color` | Active text. |
| `@tab-item-active-border` | `@global-primary-background` | Active indicator color. |
| `@tab-item-disabled-color` | `@global-muted-color` | Disabled tab text. |
| `@tab-item-background` | `transparent` | Tab item background. |
| `@tab-item-hover-background` | `@tab-item-background` | Hover background. |
| `@tab-item-active-background` | `@tab-item-background` | Active background. |
| `@tab-item-border` | `@global-border` | Tab item border. |
| `@tab-item-mode` | `border` | Tab style mode. |

Full inverse equivalents available (`@inverse-tab-*`).

📖 [UIkit Tab docs](https://getuikit.com/docs/tab)

---

## 15. Breadcrumb

| Variable | Default | Description |
|----------|---------|-------------|
| `@breadcrumb-item-color` | `@global-muted-color` | Breadcrumb item color. |
| `@breadcrumb-item-hover-color` | `@global-color` | Hover color. |
| `@breadcrumb-item-active-color` | `@global-color` | Active/current item color. |
| `@breadcrumb-item-disabled-color` | `@breadcrumb-item-color` | Disabled item color. |
| `@breadcrumb-divider-color` | `@global-muted-color` | Separator color. |

Full inverse equivalents available (`@inverse-breadcrumb-*`).

📖 [UIkit Breadcrumb docs](https://getuikit.com/docs/breadcrumb)

---

## 16. Pagination

| Variable | Default | Description |
|----------|---------|-------------|
| `@pagination-item-color` | `@global-muted-color` | Default page number color. |
| `@pagination-item-hover-color` | `@global-color` | Hover color. |
| `@pagination-item-active-color` | `@global-color` | Active page color. |
| `@pagination-item-disabled-color` | `@global-muted-color` | Disabled page color. |
| `@pagination-item-background` | `transparent` | Item background. |
| `@pagination-item-hover-background` | `transparent` | Hover background. |
| `@pagination-item-active-background` | `transparent` | Active background. |
| `@pagination-item-border` | `transparent` | Item border. |
| `@pagination-item-hover-border` | `transparent` | Hover border. |
| `@pagination-item-active-border` | `transparent` | Active border. |
| `@pagination-item-box-shadow` | `none` | Item shadow. |
| `@pagination-item-border-radius` | `0` | Item border radius. |

Full inverse equivalents available (`@inverse-pagination-*`).

📖 [UIkit Pagination docs](https://getuikit.com/docs/pagination)

---

## 17. Accordion

| Variable | Default | Description |
|----------|---------|-------------|
| `@accordion-default-title-color` | `@global-emphasis-color` | Title text color. |
| `@accordion-default-title-hover-color` | `@global-color` | Title hover color. |
| `@accordion-default-icon-color` | `@global-color` | Toggle icon color. |
| `@accordion-default-item-background` | `transparent` | Item background. |
| `@accordion-default-item-border` | `transparent` | Item border. |
| `@accordion-default-item-box-shadow` | `none` | Item shadow. |
| `@accordion-default-item-active-background` | `@accordion-default-item-background` | Active bg. |
| `@accordion-default-item-active-border` | `@accordion-default-item-border` | Active border. |

Full inverse equivalents available (`@inverse-accordion-default-*`).

📖 [UIkit Accordion docs](https://getuikit.com/docs/accordion)

---

## 18. Alert

Alert boxes with 4 semantic color variants derived from the global palette.

| Variable | Default | Description |
|----------|---------|-------------|
| `@alert-background` | `@global-muted-background` | Default alert background. |
| `@alert-color` | `@global-color` | Default alert text. |
| `@alert-border` | `transparent` | Default alert border. |
| `@alert-box-shadow` | `none` | Alert shadow. |
| `@alert-border-radius` | `0` | Alert border radius. |
| `@alert-close-opacity` | `0.4` | Close button opacity. |
| `@alert-close-hover-opacity` | `0.8` | Close button hover opacity. |

### Alert Variants

| Variable | Background | Color | Border |
|----------|------------|-------|--------|
| `@alert-primary-*` | `lighten(tint(@global-primary-background, 40%), 20%)` | `@global-primary-background` | `transparent` |
| `@alert-success-*` | `lighten(tint(@global-success-background, 40%), 25%)` | `@global-success-background` | `transparent` |
| `@alert-warning-*` | `lighten(tint(@global-warning-background, 45%), 15%)` | `@global-warning-background` | `transparent` |
| `@alert-danger-*` | `lighten(tint(@global-danger-background, 40%), 20%)` | `@global-danger-background` | `transparent` |

> Alert variant backgrounds are **tinted** (mixed toward white) then **lightened** — creating a soft pastel, while text uses the full-saturation color.

📖 [UIkit Alert docs](https://getuikit.com/docs/alert)

---

## 19. Badge

Small count/label indicators, typically in navigation.

| Variable | Default | Description |
|----------|---------|-------------|
| `@badge-background` | `@global-primary-background` | Badge background. |
| `@badge-color` | `@global-inverse-color` | Badge text color. |
| `@badge-border` | `transparent` | Badge border. |
| `@badge-box-shadow` | `none` | Badge shadow. |
| `@badge-border-radius` | `500px` | Fully rounded. |

Inverse: `@inverse-badge-background` → `@inverse-global-primary-background`.

📖 [UIkit Badge docs](https://getuikit.com/docs/badge)

---

## 20. Label

Inline labels with semantic color variants matching the global palette.

| Variable | Default | Description |
|----------|---------|-------------|
| `@label-background` | `@global-primary-background` | Default label bg. |
| `@label-color` | `@global-inverse-color` | Default label text. |
| `@label-border` | `transparent` | Label border. |
| `@label-box-shadow` | `none` | Label shadow. |
| `@label-border-radius` | `0` | Label border radius. |

### Label Variants

| Variant | Background | Color |
|---------|------------|-------|
| `@label-success-*` | `@global-success-background` | `@global-inverse-color` |
| `@label-warning-*` | `@global-warning-background` | `@global-inverse-color` |
| `@label-danger-*` | `@global-danger-background` | `@global-inverse-color` |

Inverse: `@inverse-label-background` → `@inverse-global-primary-background`.

📖 [UIkit Label docs](https://getuikit.com/docs/label)

---

## 21. Notification

Toast-style messages with semantic color variants.

### Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@notification-message-background` | `@global-muted-background` | Default bg. |
| `@notification-message-color` | `@global-color` | Default text. |
| `@notification-message-border` | `transparent` | Default border. |
| `@notification-message-box-shadow` | `none` | Default shadow. |
| `@notification-message-border-radius` | `0` | Border radius. |

### Notification Variants

| Variant | Background | Color | Color Mode |
|---------|------------|-------|------------|
| `@notification-message-primary-*` | `@global-primary-background` | `@global-inverse-color` | `light` |
| `@notification-message-success-*` | `@global-success-background` | `@global-inverse-color` | `light` |
| `@notification-message-warning-*` | `@global-warning-background` | `@global-inverse-color` | `light` |
| `@notification-message-danger-*` | `@global-danger-background` | `@global-inverse-color` | `light` |

📖 [UIkit Notification docs](https://getuikit.com/docs/notification)

---

## 22. Modal

Dialog overlay with header/footer zones.

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-background` | `rgba(0,0,0,0.6)` | Overlay backdrop color. |
| `@modal-dialog-background` | `@global-background` | Dialog content background. |
| `@modal-dialog-box-shadow` | `none` | Dialog shadow. |
| `@modal-dialog-border-radius` | `0` | Dialog border radius. |
| `@modal-header-background` | `@modal-dialog-background` | Header background. |
| `@modal-header-border` | `@global-border` | Header bottom border. |
| `@modal-footer-background` | `@modal-dialog-background` | Footer background. |
| `@modal-footer-border` | `@global-border` | Footer top border. |
| `@modal-close-outside-color` | `lighten(@global-inverse-color, 20%)` | Close X on overlay. |
| `@modal-close-outside-hover-color` | `@global-inverse-color` | Close X hover. |
| `@modal-close-full-background` | `@modal-dialog-background` | Full-screen close bg. |

📖 [UIkit Modal docs](https://getuikit.com/docs/modal)

---

## 23. Offcanvas

Off-screen sliding panel.

| Variable | Default | Description |
|----------|---------|-------------|
| `@offcanvas-bar-background` | `@global-secondary-background` | Panel background. |
| `@offcanvas-bar-color-mode` | `light` | Triggers inverse mode (white text). |
| `@offcanvas-bar-box-shadow` | `none` | Panel shadow. |
| `@offcanvas-overlay-background` | `rgba(0,0,0,0.1)` | Page dim overlay. |

📖 [UIkit Offcanvas docs](https://getuikit.com/docs/offcanvas)

---

## 24. Overlay

Transparent overlays placed on images/media.

| Variable | Default | Description |
|----------|---------|-------------|
| `@overlay-default-background` | `fade(@global-background, 90%)` | Default overlay (semi-white). |
| `@overlay-default-color-mode` | `dark` | Default overlay text mode. |
| `@overlay-default-inverse-background` | `@overlay-default-background` | Inverse mode override. |
| `@overlay-primary-background` | `fade(@global-secondary-background, 90%)` | Primary overlay (semi-dark). |
| `@overlay-primary-color-mode` | `light` | Primary overlay text mode (inverse). |
| `@overlay-primary-inverse-background` | `@overlay-primary-background` | Inverse mode override. |

📖 [UIkit Overlay docs](https://getuikit.com/docs/overlay)

---

## 25. Lightbox

Full-screen image/video gallery.

| Variable | Default | Description |
|----------|---------|-------------|
| `@lightbox-background` | `#000` | Lightbox backdrop. |
| `@lightbox-color-mode` | `light` | Child color mode (inverse). |
| `@lightbox-caption-background` | `rgba(0,0,0,0.3)` | Caption background. |
| `@lightbox-caption-color` | `rgba(255,255,255,0.7)` | Caption text color. |

📖 [UIkit Lightbox docs](https://getuikit.com/docs/lightbox)

---

## 26. Form

Extensive form styling including inputs, radios/checkboxes, range sliders, labels, selects, and validation states.

### Form Input

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-background` | `@global-background` | Input background. |
| `@form-color` | `@global-color` | Input text color. |
| `@form-border` | `transparent` | Input border. |
| `@form-box-shadow` | `none` | Input shadow. |
| `@form-border-radius` | `0` | Input border radius. |
| `@form-focus-background` | `@global-background` | Focus background. |
| `@form-focus-color` | `@global-color` | Focus text color. |
| `@form-focus-border` | `transparent` | Focus border. |
| `@form-focus-box-shadow` | `none` | Focus shadow. |
| `@form-placeholder-color` | `@global-muted-color` | Placeholder color. |
| `@form-disabled-background` | `@global-muted-background` | Disabled background. |
| `@form-disabled-color` | `@global-muted-color` | Disabled text. |
| `@form-disabled-border` | `transparent` | Disabled border. |
| `@form-blank-focus-border` | `transparent` | Blank style focus border. |

### Form Label & Icons

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-label-color` | `@global-emphasis-color` | Form label text. |
| `@form-icon-color` | `@global-muted-color` | Icon inside form. |
| `@form-icon-hover-color` | `@global-color` | Icon hover color. |
| `@form-datalist-icon-color` | `@global-color` | Datalist arrow icon. |
| `@form-select-icon-color` | `@global-color` | Select arrow icon. |
| `@form-select-option-color` | `@global-color` | Select option text. |

### Form Validation States

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-danger-color` | `@global-danger-background` | Error text color. |
| `@form-danger-border` | `transparent` | Error border. |
| `@form-danger-focus-background` | `inherit` | Error focus bg. |
| `@form-success-color` | `@global-success-background` | Success text color. |
| `@form-success-border` | `transparent` | Success border. |
| `@form-success-focus-background` | `inherit` | Success focus bg. |

### Form Radio / Checkbox

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-radio-background` | `transparent` | Default radio/checkbox bg. |
| `@form-radio-border` | `transparent` | Default border. |
| `@form-radio-box-shadow` | `none` | Default shadow. |
| `@form-radio-focus-background` | `darken(@form-radio-background, 5%)` | Focus bg. |
| `@form-radio-focus-border` | `transparent` | Focus border. |
| `@form-radio-checked-background` | `@global-primary-background` | Checked bg. |
| `@form-radio-checked-border` | `transparent` | Checked border. |
| `@form-radio-checked-icon-color` | `@global-inverse-color` | Checkmark color. |
| `@form-radio-checked-focus-background` | `darken(@global-primary-background, 10%)` | Checked focus bg. |
| `@form-radio-disabled-background` | `@global-muted-background` | Disabled bg. |
| `@form-radio-disabled-border` | `transparent` | Disabled border. |
| `@form-radio-disabled-icon-color` | `@global-muted-color` | Disabled icon. |

### Form Range Slider

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-range-thumb-background` | `@global-background` | Thumb bg. |
| `@form-range-thumb-border` | `transparent` | Thumb border. |
| `@form-range-thumb-box-shadow` | `none` | Thumb shadow. |
| `@form-range-track-background` | `darken(@global-muted-background, 5%)` | Track bg. |
| `@form-range-track-box-shadow` | `none` | Track shadow. |
| `@form-range-track-focus-background` | `darken(@form-range-track-background, 5%)` | Focus track bg. |

### Form Select Disabled

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-select-disabled-icon-color` | `@global-muted-color` | Disabled select icon. |

Full inverse equivalents available (`@inverse-form-*`) mapping to `@inverse-global-*` tokens.

📖 [UIkit Form docs](https://getuikit.com/docs/form)

---

## 27. Search

Search input component with 4 size/style variants.

### Search Global

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-color` | `@global-color` | Search input text color. |
| `@search-placeholder-color` | `@global-muted-color` | Search placeholder. |
| `@search-icon-color` | `@global-muted-color` | Search icon color. |
| `@search-toggle-color` | `@global-muted-color` | Toggle button color. |
| `@search-toggle-hover-color` | `@global-color` | Toggle hover. |

### Search Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-default-background` | `transparent` | Default search bg. |
| `@search-default-focus-background` | `darken(@search-default-background, 2%)` | Focus bg. |
| `@search-default-border` | `transparent` | Border. |
| `@search-default-focus-border` | `transparent` | Focus border. |

### Search Navbar / Medium / Large

Each variant (`@search-navbar-*`, `@search-medium-*`, `@search-large-*`) follows the same pattern with background, border, color, focus-background, focus-border, icon-color, and placeholder-color. Many use `~''` (empty string) to inherit from the base search variables.

Full inverse equivalents available (`@inverse-search-*`).

📖 [UIkit Search docs](https://getuikit.com/docs/search)

---

## 28. Table

Data table styling with striped, divider, and hover variants.

| Variable | Default | Description |
|----------|---------|-------------|
| `@table-header-cell-color` | `@global-muted-color` | Table header text. |
| `@table-caption-color` | `@global-muted-color` | Table caption text. |
| `@table-row-active-background` | `#ffd` | Active/selected row bg. |
| `@table-hover-row-background` | `@table-row-active-background` | Hover row bg. |
| `@table-striped-row-background` | `@global-muted-background` | Striped row bg. |
| `@table-striped-border` | `transparent` | Striped row border. |
| `@table-divider-border` | `@global-border` | Divider row border. |
| `@table-divider-header-border` | `transparent` | Divider header border. |
| `@table-divider-box-shadow` | `none` | Divider shadow. |

Full inverse equivalents available (`@inverse-table-*`).

📖 [UIkit Table docs](https://getuikit.com/docs/table)

---

## 29. Article

Blog/article component colors.

| Variable | Default | Description |
|----------|---------|-------------|
| `@article-title-color` | `@global-emphasis-color` | Article title color. |
| `@article-meta-color` | `@global-muted-color` | Meta text (date, author). |
| `@article-meta-link-color` | `@article-meta-color` | Meta link color. |
| `@article-meta-link-hover-color` | `@global-color` | Meta link hover. |

Inverse: `@inverse-article-title-color` → `@inverse-global-emphasis-color`, `@inverse-article-meta-color` → `@inverse-global-muted-color`.

📖 [UIkit Article docs](https://getuikit.com/docs/article)

---

## 30. Comment

Comment/discussion thread styling.

| Variable | Default | Description |
|----------|---------|-------------|
| `@comment-meta-color` | `@global-muted-color` | Comment meta text color. |
| `@comment-primary-background` | `@global-muted-background` | Primary comment background. |
| `@comment-primary-box-shadow` | `none` | Primary comment shadow. |

📖 [UIkit Comment docs](https://getuikit.com/docs/comment)

---

## 31. Heading

Display heading sizes (small through 3xlarge) with colors and text effects.

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-small-color` | `@global-emphasis-color` | `.uk-heading-small` color. |
| `@heading-medium-color` | `@global-emphasis-color` | `.uk-heading-medium` color. |
| `@heading-large-color` | `@global-emphasis-color` | `.uk-heading-large` color. |
| `@heading-xlarge-color` | `@global-emphasis-color` | `.uk-heading-xlarge` color. |
| `@heading-2xlarge-color` | `@global-emphasis-color` | `.uk-heading-2xlarge` color. |
| `@heading-3xlarge-color` | `@global-emphasis-color` | `.uk-heading-3xlarge` color. |
| `@heading-small-text-shadow` … `@heading-3xlarge-text-shadow` | `none` | Text shadow per size. |

### Heading Elements

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-bullet-border` | `@global-border` | Bullet heading border. |
| `@heading-divider-border` | `@global-border` | Divider heading border. |
| `@heading-divider-box-shadow` | `none` | Divider shadow. |
| `@heading-line-border` | `@global-border` | Line heading border. |
| `@heading-line-box-shadow` | `none` | Line shadow. |

Full inverse equivalents available (`@inverse-heading-*`).

📖 [UIkit Heading docs](https://getuikit.com/docs/heading)

---

## 32. Text Utility

Text color utilities and special text background effect.

| Variable | Default | Description |
|----------|---------|-------------|
| `@text-lead-color` | `@global-emphasis-color` | `.uk-text-lead` color. |
| `@text-meta-color` | `@global-muted-color` | `.uk-text-meta` color. |
| `@text-meta-link-color` | `@text-meta-color` | Meta link color. |
| `@text-meta-link-hover-color` | `@global-color` | Meta link hover. |
| `@text-muted-color` | `@global-muted-color` | `.uk-text-muted` color. |
| `@text-emphasis-color` | `@global-emphasis-color` | `.uk-text-emphasis` color. |
| `@text-primary-color` | `@global-primary-background` | `.uk-text-primary` color. |
| `@text-secondary-color` | `@global-secondary-background` | `.uk-text-secondary` color. |
| `@text-success-color` | `@global-success-background` | `.uk-text-success` color. |
| `@text-warning-color` | `@global-warning-background` | `.uk-text-warning` color. |
| `@text-danger-color` | `@global-danger-background` | `.uk-text-danger` color. |
| `@text-background-color` | `@global-primary-background` | Gradient text background. |

Full inverse equivalents available (`@inverse-text-*`).

📖 [UIkit Text docs](https://getuikit.com/docs/text)

---

## 33. Link Utility

Styled link variants.

| Variable | Default | Description |
|----------|---------|-------------|
| `@link-muted-color` | `@global-muted-color` | `.uk-link-muted` color. |
| `@link-muted-hover-color` | `@global-color` | Muted link hover. |
| `@link-text-hover-color` | `@global-muted-color` | `.uk-link-text` hover. |
| `@link-heading-hover-color` | `@global-primary-background` | `.uk-link-heading` hover. |

Inverse: `@inverse-link-muted-color` → `@inverse-global-muted-color`, `@inverse-link-heading-hover-color` → `@inverse-global-primary-background`.

📖 [UIkit Link docs](https://getuikit.com/docs/link)

---

## 34. List

Styled lists with bullets, dividers, and semantic colors.

| Variable | Default | Description |
|----------|---------|-------------|
| `@list-bullet-icon-color` | `@global-color` | Bullet icon color. |
| `@list-divider-border` | `@global-border` | List divider border. |
| `@list-divider-box-shadow` | `none` | Divider shadow. |
| `@list-striped-background` | `@global-muted-background` | Striped row background. |
| `@list-striped-border` | `transparent` | Striped row border. |
| `@list-muted-color` | `@global-muted-color` | `.uk-list-muted` text color. |
| `@list-emphasis-color` | `@global-emphasis-color` | `.uk-list-emphasis` text. |
| `@list-primary-color` | `@global-primary-background` | `.uk-list-primary` text. |
| `@list-secondary-color` | `@global-secondary-background` | `.uk-list-secondary` text. |

Full inverse equivalents available (`@inverse-list-*`).

📖 [UIkit List docs](https://getuikit.com/docs/list)

---

## 35. Description List

| Variable | Default | Description |
|----------|---------|-------------|
| `@description-list-term-color` | `@global-emphasis-color` | Term (dt) color. |
| `@description-list-divider-term-border` | `@global-border` | Divider variant border. |
| `@description-list-divider-term-box-shadow` | `none` | Divider shadow. |

📖 [UIkit Description List docs](https://getuikit.com/docs/description-list)

---

## 36. Divider

Horizontal and vertical rule elements.

| Variable | Default | Description |
|----------|---------|-------------|
| `@divider-icon-color` | `@global-border` | Icon divider color (SVG icon). |
| `@divider-icon-line-border` | `@global-border` | Icon divider line border. |
| `@divider-icon-line-box-shadow` | `none` | Icon divider shadow. |
| `@divider-small-border` | `@global-border` | Small divider border. |
| `@divider-small-box-shadow` | `none` | Small divider shadow. |
| `@divider-vertical-border` | `@global-border` | Vertical divider border. |
| `@divider-vertical-box-shadow` | `none` | Vertical divider shadow. |

Full inverse equivalents available (`@inverse-divider-*`).

📖 [UIkit Divider docs](https://getuikit.com/docs/divider)

---

## 37. Icon / Iconnav

### Icon Button

Circular icon buttons (e.g. social media icons, action icons).

| Variable | Default | Description |
|----------|---------|-------------|
| `@icon-button-background` | `@global-muted-background` | Button background. |
| `@icon-button-color` | `@global-muted-color` | Icon color. |
| `@icon-button-border` | `transparent` | Border. |
| `@icon-button-box-shadow` | `none` | Shadow. |
| `@icon-button-border-radius` | `500px` | Fully rounded. |
| `@icon-button-hover-background` | `darken(@icon-button-background, 5%)` | Hover bg. |
| `@icon-button-hover-color` | `@global-color` | Hover icon color. |
| `@icon-button-active-background` | `darken(@icon-button-background, 10%)` | Active bg. |
| `@icon-button-active-color` | `@global-color` | Active icon color. |

### Icon Link

| Variable | Default | Description |
|----------|---------|-------------|
| `@icon-link-color` | `@global-muted-color` | Icon link color. |
| `@icon-link-hover-color` | `@global-color` | Hover. |
| `@icon-link-active-color` | `darken(@global-color, 5%)` | Active. |

### Icon Overlay

| Variable | Default | Description |
|----------|---------|-------------|
| `@icon-overlay-color` | `fade(@global-emphasis-color, 60%)` | Overlay icon color. |
| `@icon-overlay-hover-color` | `@global-emphasis-color` | Overlay icon hover. |

### Iconnav

| Variable | Default | Description |
|----------|---------|-------------|
| `@iconnav-item-color` | `@global-muted-color` | Iconnav item color. |
| `@iconnav-item-hover-color` | `@global-color` | Hover color. |
| `@iconnav-item-active-color` | `@global-color` | Active color. |

Full inverse equivalents available for all icon sub-components.

📖 [UIkit Icon docs](https://getuikit.com/docs/icon) · [Iconnav docs](https://getuikit.com/docs/iconnav)

---

## 38. Dotnav

Dot-style pagination indicators.

| Variable | Default | Description |
|----------|---------|-------------|
| `@dotnav-item-background` | `transparent` | Dot background. |
| `@dotnav-item-border` | `transparent` | Dot border. |
| `@dotnav-item-box-shadow` | `none` | Dot shadow. |
| `@dotnav-item-border-radius` | `50%` | Fully round. |
| `@dotnav-item-hover-background` | `fade(@global-color, 60%)` | Hover bg. |
| `@dotnav-item-onclick-background` | `fade(@global-color, 20%)` | Click bg. |
| `@dotnav-item-active-background` | `fade(@global-color, 60%)` | Active bg. |

Full inverse equivalents available (`@inverse-dotnav-*`).

📖 [UIkit Dotnav docs](https://getuikit.com/docs/dotnav)

---

## 39. Slidenav

Previous/next slide navigation arrows.

| Variable | Default | Description |
|----------|---------|-------------|
| `@slidenav-color` | `fade(@global-color, 50%)` | Arrow color. |
| `@slidenav-hover-color` | `fade(@global-color, 90%)` | Hover color. |
| `@slidenav-active-color` | `fade(@global-color, 50%)` | Active color. |
| `@slidenav-background` | `transparent` | Background. |
| `@slidenav-hover-background` | `transparent` | Hover bg. |
| `@slidenav-active-background` | `transparent` | Active bg. |
| `@slidenav-border` | `transparent` | Border. |
| `@slidenav-border-radius` | `0` | Border radius. |

Full inverse equivalents available (`@inverse-slidenav-*`).

📖 [UIkit Slidenav docs](https://getuikit.com/docs/slidenav)

---

## 40. Thumbnav

Thumbnail navigation for sliders/galleries.

| Variable | Default | Description |
|----------|---------|-------------|
| `@thumbnav-item-background` | `rgba(255,255,255,0.4)` | Thumb overlay bg. |
| `@thumbnav-item-border` | `transparent` | Thumb border. |
| `@thumbnav-item-gradient` | `~''` | Optional gradient. |
| `@thumbnav-item-opacity` | `1` | Default opacity. |
| `@thumbnav-item-hover-opacity` | `0` | Hover opacity (reveals image). |
| `@thumbnav-item-active-opacity` | `0` | Active opacity. |

Inverse: `@inverse-thumbnav-item-background` → `rgba(0,0,0,0.4)`.

📖 [UIkit Thumbnav docs](https://getuikit.com/docs/thumbnav)

---

## 41. Logo

Site logo text styling.

| Variable | Default | Description |
|----------|---------|-------------|
| `@logo-color` | `@global-emphasis-color` | Logo text color. |
| `@logo-hover-color` | `@global-emphasis-color` | Logo hover color. |

Inverse: `@inverse-logo-color` / `@inverse-logo-hover-color` → `@inverse-global-emphasis-color`.

📖 [UIkit Logo docs](https://getuikit.com/docs/logo)

---

## 42. Marker

Positioning markers (e.g. on images/maps for hotspots).

| Variable | Default | Description |
|----------|---------|-------------|
| `@marker-background` | `@global-secondary-background` | Marker background. |
| `@marker-color` | `@global-inverse-color` | Marker icon color. |
| `@marker-border` | `transparent` | Marker border. |
| `@marker-border-radius` | `500px` | Fully rounded. |
| `@marker-hover-background` | `@marker-background` | Hover background. |
| `@marker-hover-color` | `@global-inverse-color` | Hover icon color. |

Inverse: `@inverse-marker-background` → `@global-muted-background`, `@inverse-marker-color` → `@global-color`.

📖 [UIkit Marker docs](https://getuikit.com/docs/marker)

---

## 43. Totop

"Scroll to top" button.

| Variable | Default | Description |
|----------|---------|-------------|
| `@totop-color` | `@global-muted-color` | Default color. |
| `@totop-hover-color` | `@global-color` | Hover color. |
| `@totop-active-color` | `@global-emphasis-color` | Active color. |
| `@totop-background` | `transparent` | Background. |
| `@totop-hover-background` | `transparent` | Hover bg. |
| `@totop-active-background` | `transparent` | Active bg. |
| `@totop-border` | `transparent` | Border. |
| `@totop-box-shadow` | `none` | Shadow. |
| `@totop-border-radius` | `0` | Border radius. |

Full inverse equivalents available (`@inverse-totop-*`).

📖 [UIkit Totop docs](https://getuikit.com/docs/totop)

---

## 44. Leader

Dot leaders connecting labels to values (e.g. in a menu/price list).

| Variable | Default | Description |
|----------|---------|-------------|
| `@leader-color` | `@global-color` | Leader dot color. |

Inverse: `@inverse-leader-color` → `@inverse-global-color`.

📖 [UIkit Leader docs](https://getuikit.com/docs/leader)

---

## 45. Progress

Progress bar component.

| Variable | Default | Description |
|----------|---------|-------------|
| `@progress-background` | `@global-muted-background` | Track background. |
| `@progress-bar-background` | `@global-primary-background` | Fill bar color. |
| `@progress-border-radius` | `500px` | Fully rounded. |
| `@progress-box-shadow` | `none` | Track shadow. |

📖 [UIkit Progress docs](https://getuikit.com/docs/progress)

---

## 46. Placeholder

Dashed placeholder boxes.

| Variable | Default | Description |
|----------|---------|-------------|
| `@placeholder-background` | `transparent` | Background. |
| `@placeholder-border` | `@global-border` | Dashed border color. |
| `@placeholder-border-style` | `dashed` | Border style. |
| `@placeholder-border-radius` | `0` | Border radius. |
| `@placeholder-box-shadow` | `none` | Shadow. |

📖 [UIkit Placeholder docs](https://getuikit.com/docs/placeholder)

---

## 47. Grid Divider

Dividers between grid cells.

| Variable | Default | Description |
|----------|---------|-------------|
| `@grid-divider-border` | `@global-border` | Divider color. |
| `@grid-divider-horizontal-box-shadow` | `none` | Horizontal shadow. |
| `@grid-divider-vertical-box-shadow` | `none` | Vertical shadow. |

Inverse: `@inverse-grid-divider-border` → `@inverse-global-border`.

📖 [UIkit Grid docs](https://getuikit.com/docs/grid)

---

## 48. Column Divider

CSS columns divider rule.

| Variable | Default | Description |
|----------|---------|-------------|
| `@column-divider-rule-color` | `@global-border` | Column rule color. |

Inverse: `@inverse-column-divider-rule-color` → `@inverse-global-border`.

📖 [UIkit Column docs](https://getuikit.com/docs/column)

---

## 49. Panel / Sortable / Box Shadow

### Panel Scrollable

| Variable | Default | Description |
|----------|---------|-------------|
| `@panel-scrollable-border` | `@global-border` | Scrollable panel border. |

### Sortable

| Variable | Default | Description |
|----------|---------|-------------|
| `@sortable-placeholder-opacity` | `0` | Placeholder opacity during drag. |
| `@dragover-box-shadow` | `0 0 20px rgba(100,100,100,0.3)` | Dragover indicator shadow. |

---

## 50. Tooltip

| Variable | Default | Description |
|----------|---------|-------------|
| `@tooltip-background` | `#666` | Tooltip background. |
| `@tooltip-color` | `@global-inverse-color` | Tooltip text color. |
| `@tooltip-border-radius` | `2px` | Tooltip border radius. |

📖 [UIkit Tooltip docs](https://getuikit.com/docs/tooltip)

---

## 51. Close

Close icon button (used in alerts, modals, offcanvas, etc.).

| Variable | Default | Description |
|----------|---------|-------------|
| `@close-color` | `@global-muted-color` | Close icon color. |
| `@close-hover-color` | `@global-color` | Close hover color. |

Inverse: `@inverse-close-color` → `@inverse-global-muted-color`.

📖 [UIkit Close docs](https://getuikit.com/docs/close)

---

## 52. Dropcap

Large initial letter (drop cap).

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropcap-color` | `inherit` | Dropcap text color. |

Inverse: `@inverse-dropcap-color` → `inherit`.

---

## 53. Internal / YOOtheme Pro Enhancements

Variables prefixed `@internal-*` are **YOOtheme Pro extensions** — gradients, glow effects, border images, SVG background images, and glitch animation triggers. They are empty (`~''`) by default and activated by specific YOOtheme Pro style presets.

### Gradient Variables

Nearly every interactive component has gradient support:
- `@internal-button-{default|primary|secondary|danger}-gradient`
- `@internal-button-{default|primary|secondary|danger}-hover-gradient`
- `@internal-button-{default|primary|secondary|danger}-active-gradient`
- `@internal-card-{default|primary|secondary|overlay}-gradient`
- `@internal-navbar-gradient`, `@internal-navbar-nav-item-gradient`
- `@internal-section-{default|muted|primary|secondary}-gradient`
- `@internal-tile-{default|muted|primary|secondary}-gradient`
- `@internal-overlay-{default|primary}-gradient`
- `@internal-subnav-pill-item-active-gradient`
- `@internal-icon-button-gradient`
- `@internal-pagination-item-glow-gradient`
- `@internal-progress-bar-gradient`
- `@internal-text-background-color-gradient`

### Border Image Variables

Decorative border images for cards, buttons, and headings:
- `@internal-card-{default|primary|secondary|overlay|hover}-border-image`
- `@internal-button-{default|primary|secondary|danger}-border-image`
- `@internal-icon-button-border-image`
- `@internal-heading-bullet-border-image`
- `@internal-subnav-pill-item-border-image`
- `@internal-tab-item-active-border-image`

### Border Gradient Variables

Linear gradient borders for dividers, tabs, and navbars:
- `@internal-divider-{small|vertical|icon-line-left|icon-line-right}-border-gradient`
- `@internal-navbar-border-border-gradient`
- `@internal-grid-divider-{horizontal|vertical}-border-gradient`
- `@internal-subnav-divider-border-gradient`
- `@internal-tab-item-{active|hover}-border-gradient`
- `@internal-button-{default|primary|secondary|danger}-{active|hover}-border-gradient`

### Glow Effects

Glow gradients and opacity for buttons, pagination, and subnav pills:
- `@internal-button-{default|primary|secondary}-glow-gradient`
- `@internal-card-{default|primary|secondary|overlay}-glow-gradient`
- `@internal-icon-button-glow-gradient`
- `@internal-pagination-item-glow-gradient` / `@internal-pagination-item-glow-opacity`
- `@internal-subnav-pill-item-glow-gradient` / `@internal-subnav-pill-item-glow-opacity`

### Glitch Animation Triggers

Hover glitch effects (skew + opacity flicker):
- `@internal-button-{default|primary|secondary|text}-hover-glitch-animation`
- `@internal-navbar-nav-item-hover-glitch-animation`
- `@internal-nav-{default|primary}-item-hover-glitch-animation`
- `@internal-slidenav-hover-glitch-animation`
- `@internal-dotnav-item-hover-glitch-animation`
- `@internal-iconnav-item-hover-glitch-animation`
- `@internal-link-{heading|muted|text}-hover-glitch-animation`
- `@internal-marker-hover-glitch-animation`
- `@internal-totop-hover-glitch-animation`
- `@internal-heading-glitch-animation` → `uk-glitch-text-shadow`

### Glitch Text Shadow Colors

| Variable | Default | Description |
|----------|---------|-------------|
| `@internal-glitch-text-shadow` | `2px` | Glitch text shadow offset. |
| `@internal-glitch-text-shadow-color-1` | `@global-primary-background` | First glitch color. |
| `@internal-glitch-text-shadow-color-2` | `@global-secondary-background` | Second glitch color. |

### SVG Background Images

Form controls and icons using inline SVG:
- `@internal-form-checkbox-image`, `@internal-form-radio-image`
- `@internal-form-select-image`, `@internal-form-datalist-image`
- `@internal-form-checkbox-indeterminate-image`
- `@internal-divider-icon-image`
- `@internal-list-bullet-image`

### Internal SVG Colors

| Variable | Default | Description |
|----------|---------|-------------|
| `@internal-svg-default-background` | `@global-background` | SVG widget default bg. |
| `@internal-svg-muted-background` | `darken(@global-muted-background, 2%)` | SVG muted bg. |
| `@internal-svg-muted-color` | `lighten(@global-muted-color, 15%)` | SVG muted color. |

### Internal Nav Bullet

| Variable | Default | Description |
|----------|---------|-------------|
| `@internal-nav-default-bullet-background` | `@global-primary-background` | Default nav bullet. |
| `@internal-nav-primary-bullet-background` | `@global-primary-background` | Primary nav bullet. |

---

## 54. Color Cascade Diagram

Shows how the global color tokens flow to key components:

```
@global-color (#666)
├── @base-body-color
├── @base-blockquote-footer-color
├── @navbar-nav-item-hover-color
├── @nav-default-item-hover-color
├── @dropdown-nav-item-hover-color
├── @breadcrumb-item-active-color
├── @pagination-item-hover-color
├── @close-hover-color
├── @search-color
├── @form-color
├── @leader-color
└── @article-meta-link-hover-color

@global-emphasis-color (#333)
├── @base-heading-color → @base-h1-color … @base-h6-color
├── @heading-small-color … @heading-3xlarge-color
├── @article-title-color
├── @card-default-title-color
├── @description-list-term-color
├── @form-label-color
├── @button-default-color / @button-text-color / @button-link-color
├── @nav-default-item-active-color
├── @navbar-nav-item-active-color
├── @subnav-item-active-color
├── @tab-item-active-color
├── @text-emphasis-color / @text-lead-color
├── @logo-color
├── @totop-active-color
└── @base-focus-outline

@global-muted-color (#999)
├── @form-placeholder-color
├── @form-icon-color
├── @navbar-nav-item-color / @navbar-toggle-color
├── @nav-default-item-color
├── @breadcrumb-item-color / @breadcrumb-divider-color
├── @pagination-item-color
├── @subnav-item-color
├── @tab-item-color
├── @article-meta-color
├── @comment-meta-color
├── @text-muted-color / @text-meta-color
├── @table-header-cell-color / @table-caption-color
├── @close-color / @icon-link-color / @icon-button-color
├── @search-icon-color / @search-placeholder-color
├── @slidenav-color (via fade)
├── @iconnav-item-color
├── @totop-color
├── @button-disabled-color
└── @link-muted-color

@global-primary-background (#1e87f0)
├── @button-primary-background
├── @card-primary-background
├── @section-primary-background
├── @tile-primary-background
├── @badge-background / @label-background
├── @progress-bar-background
├── @subnav-pill-item-active-background
├── @tab-item-active-border
├── @navbar-nav-item-line-*-background
├── @notification-message-primary-background
├── @text-primary-color / @text-background-color
├── @link-heading-hover-color
├── @list-primary-color
├── @alert-primary-color (full sat used for text)
└── @form-radio-checked-background

@global-inverse-color (#fff)
├── @button-primary-color / @button-secondary-color / @button-danger-color
├── @badge-color / @label-color / @label-{success|warning|danger}-color
├── @card-primary-color / @card-secondary-color / @card-badge-color
├── @marker-color
├── @base-selection-color
├── @notification-message-{primary|success|warning|danger}-color
├── @tooltip-color
├── @form-radio-checked-icon-color
└── @modal-close-outside-hover-color

@global-background (#fff)
├── @base-body-background
├── @card-default-background / @card-hover-background
├── @modal-dialog-background
├── @dropdown-background / @dropbar-background
├── @search-navbar-background
├── @section-default-background
├── @tile-default-background
├── @form-background / @form-focus-background
├── @form-range-thumb-background
└── @overlay-default-background (via fade)

@global-muted-background (#f8f8f8)
├── @section-muted-background / @tile-muted-background
├── @navbar-background
├── @comment-primary-background
├── @alert-background / @notification-message-background
├── @icon-button-background
├── @subnav-pill-item-hover-background
├── @form-disabled-background / @form-radio-disabled-background
├── @table-striped-row-background
├── @list-striped-background
├── @progress-background
└── @background-muted-background

@global-border (#e5e5e5)
├── @base-hr-border
├── @card-default-header-border / @card-default-footer-border
├── @modal-header-border / @modal-footer-border
├── @heading-bullet-border / @heading-divider-border / @heading-line-border
├── @divider-{icon|icon-line|small|vertical}-border
├── @grid-divider-border / @column-divider-rule-color
├── @dropdown-nav-divider-border / @navbar-dropdown-nav-divider-border
├── @nav-{default|primary|secondary}-divider-border / @nav-dividers-border
├── @subnav-divider-border / @tab-border / @tab-item-border
├── @table-divider-border
├── @list-divider-border
├── @panel-scrollable-border
├── @placeholder-border
├── @description-list-divider-term-border
└── @divider-icon-color
```

---

## 55. Inverse Color Cascade

When inverse mode is active, these token substitutions apply:

```
@inverse-global-color ← fade(@global-inverse-color, 70%)   ≈ rgba(255,255,255,0.7)
@inverse-global-emphasis-color ← @global-inverse-color     = #fff
@inverse-global-muted-color ← fade(@global-inverse-color, 50%)  ≈ rgba(255,255,255,0.5)
@inverse-global-inverse-color ← @global-color              = #666
@inverse-global-primary-background ← @global-inverse-color = #fff
@inverse-global-muted-background ← fade(@global-inverse-color, 10%)  ≈ rgba(255,255,255,0.1)
@inverse-global-border ← fade(@global-inverse-color, 20%)  ≈ rgba(255,255,255,0.2)
```

Components inside inverse contexts reference these instead of the normal global tokens. The pattern is consistent: `@inverse-{component}-{property}` mirrors `@{component}-{property}` but substitutes `@inverse-global-*` for `@global-*`.

For example:
- `@button-primary-background` = `@global-primary-background` → `@inverse-button-primary-background` = `@inverse-global-primary-background`
- `@nav-default-item-color` = `@global-muted-color` → `@inverse-nav-default-item-color` = `@inverse-global-muted-color`

---

## Quick Reference: Color Mode by Component

| Component | Color Mode | Triggers Inverse? |
|-----------|------------|-------------------|
| Section Default | `dark` | No |
| Section Muted | `dark` | No |
| Section Primary | `light` | **Yes** |
| Section Secondary | `light` | **Yes** |
| Tile Default | `dark` | No |
| Tile Muted | `dark` | No |
| Tile Primary | `light` | **Yes** |
| Tile Secondary | `light` | **Yes** |
| Card Default | `dark` | No |
| Card Primary | `light` | **Yes** |
| Card Secondary | `light` | **Yes** |
| Card Overlay | `dark` | No |
| Navbar | `dark` | No |
| Navbar Dropdown | `dark` | No |
| Dropbar | `dark` | No |
| Dropdown | `dark` | No |
| Overlay Default | `dark` | No |
| Overlay Primary | `light` | **Yes** |
| Offcanvas | `light` | **Yes** |
| Lightbox | `light` | **Yes** |
| Notification Primary | `light` | **Yes** |
| Notification Success | `light` | **Yes** |
| Notification Warning | `light` | **Yes** |
| Notification Danger | `light` | **Yes** |

---

*Generated from `docs/uikit-less-consolidated/_all-variables.less` — ~1,437 color-related variables across 55 categories.*
