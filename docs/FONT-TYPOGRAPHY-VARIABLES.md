# UIkit Font & Typography Variables Reference

> All Less variables controlling typography (font-family, font-size, font-weight, font-style, line-height, letter-spacing, text-transform) extracted from `_all-variables.less`.  
> Grouped by component with descriptions and links to UIkit documentation.

---

## Table of Contents

1. [Global Font Scale](#1-global-font-scale)
2. [Global Font Families & Styles](#2-global-font-families--styles)
3. [Base (Body & Typography)](#3-base-body--typography)
4. [Headings (h1–h6)](#4-headings-h1h6)
5. [Heading Component (Display Sizes)](#5-heading-component-display-sizes)
6. [Article](#6-article)
7. [Card](#7-card)
8. [Text Utility](#8-text-utility)
9. [Button](#9-button)
10. [Navbar](#10-navbar)
11. [Nav](#11-nav)
12. [Dropdown Nav](#12-dropdown-nav)
13. [Subnav](#13-subnav)
14. [Tab](#14-tab)
15. [Breadcrumb](#15-breadcrumb)
16. [Pagination](#16-pagination)
17. [Badge](#17-badge)
18. [Label](#18-label)
19. [Comment](#19-comment)
20. [Description List](#20-description-list)
21. [Form](#21-form)
22. [Modal](#22-modal)
23. [Table](#23-table)
24. [Notification](#24-notification)
25. [Countdown](#25-countdown)
26. [Accordion](#26-accordion)
27. [Search](#27-search)
28. [Tooltip](#28-tooltip)
29. [Logo](#29-logo)
30. [Iconnav](#30-iconnav)
31. [Leader](#31-leader)
32. [Dropcap](#32-dropcap)
33. [List](#33-list)

---

## 1. Global Font Scale

The foundation for all font sizes across UIkit. Component font-size variables reference these, so changes cascade throughout the theme.

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-font-size` | `16px` | Base font size for the document. |
| `@global-small-font-size` | `0.875rem` | Small text (≈14px). Used by meta, labels, buttons, form-small, etc. |
| `@global-medium-font-size` | `1.25rem` | Medium text (≈20px). Used by h4, accordion titles, card badge, etc. |
| `@global-large-font-size` | `1.5rem` | Large text (≈24px). Used by h3, card titles, nav-primary, text-lead, etc. |
| `@global-xlarge-font-size` | `2rem` | Extra-large text (≈32px). Used by h2, modal titles. |
| `@global-2xlarge-font-size` | `2.625rem` | Double extra-large text (≈42px). Used by h1, article titles, search-large. |
| `@global-line-height` | `1.5` | Base line-height for body text. |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 2. Global Font Families & Styles

UIkit uses three font-family "slots" — **primary** (headings, lead text), **secondary** (UI elements, meta, labels, nav), and **tertiary** (special). By default all inherit from the base font, but YOOtheme Pro allows setting each independently.

### Primary Font (Headings & Display)

Used by h1–h3, article titles, card titles, modal titles, heading component, text-lead, accordion, blockquote.

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-primary-font-family` | `inherit` | Font family for primary/heading text. |
| `@global-primary-font-weight` | `inherit` | Font weight for primary text. |
| `@global-primary-font-style` | `inherit` | Font style (normal/italic) for primary text. |
| `@global-primary-letter-spacing` | `inherit` | Letter spacing for primary text. |
| `@global-primary-text-transform` | `inherit` | Text transform (uppercase/lowercase/none) for primary text. |

### Secondary Font (UI & Navigation)

Used by h4–h6, navbar, nav, buttons, labels, badges, breadcrumbs, tabs, subnav, pagination, form labels, meta text.

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-secondary-font-family` | `inherit` | Font family for secondary/UI text. |
| `@global-secondary-font-weight` | `inherit` | Font weight for secondary text. |
| `@global-secondary-font-style` | `inherit` | Font style for secondary text. |
| `@global-secondary-letter-spacing` | `inherit` | Letter spacing for secondary text. |
| `@global-secondary-text-transform` | `inherit` | Text transform for secondary text. |

### Tertiary Font

Available for special use cases (e.g., custom theme elements).

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-tertiary-font-family` | `inherit` | Font family for tertiary text. |
| `@global-tertiary-font-weight` | `inherit` | Font weight for tertiary text. |

📖 [YOOtheme Pro Fonts](https://yootheme.com/support/yootheme-pro/wordpress/fonts)

---

## 3. Base (Body & Typography)

Default typography for the `<body>`, inline elements, code blocks, and quotes.

### Body

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-body-font-family` | `@global-font-family` | Body font family. |
| `@base-body-font-size` | `@global-font-size` (16px) | Body font size. |
| `@base-body-font-weight` | `normal` | Body font weight. |
| `@base-body-line-height` | `@global-line-height` (1.5) | Body line height. |

### Generic Headings (shared base for all h1–h6)

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-heading-font-family` | `@global-font-family` | Shared base heading font family. |
| `@base-heading-font-style` | `@global-primary-font-style` | Shared heading font style. |
| `@base-heading-font-weight` | `normal` | Shared heading font weight. |
| `@base-heading-letter-spacing` | `@global-primary-letter-spacing` | Shared heading letter spacing. |
| `@base-heading-text-transform` | `none` | Shared heading text transform. |

### Inline Code & Pre

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-code-font-family` | `Consolas, monaco, monospace` | Inline `<code>` font family. |
| `@base-code-font-size` | `@global-small-font-size` | Inline `<code>` font size. |
| `@base-pre-font-family` | `@base-code-font-family` | `<pre>` block font family. |
| `@base-pre-font-size` | `@global-small-font-size` | `<pre>` block font size. |
| `@base-pre-line-height` | `1.5` | `<pre>` block line height. |

### Blockquote

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-blockquote-font-family` | `@global-primary-font-family` | Blockquote font family. |
| `@base-blockquote-font-size` | `@global-medium-font-size` | Blockquote font size (≈20px). |
| `@base-blockquote-font-style` | `italic` | Blockquote font style. |
| `@base-blockquote-font-weight` | `@global-primary-font-weight` | Blockquote font weight. |
| `@base-blockquote-letter-spacing` | `@global-primary-letter-spacing` | Blockquote letter spacing. |
| `@base-blockquote-line-height` | `1.5` | Blockquote line height. |
| `@base-blockquote-text-transform` | `@global-primary-text-transform` | Blockquote text transform. |

### Blockquote Footer

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-blockquote-footer-font-family` | `@global-secondary-font-family` | Citation/footer font family. |
| `@base-blockquote-footer-font-size` | `@global-small-font-size` | Citation font size. |
| `@base-blockquote-footer-font-style` | `inherit` | Citation font style. |
| `@base-blockquote-footer-font-weight` | `@global-secondary-font-weight` | Citation font weight. |
| `@base-blockquote-footer-letter-spacing` | `inherit` | Citation letter spacing. |
| `@base-blockquote-footer-line-height` | `1.5` | Citation line height. |
| `@base-blockquote-footer-text-transform` | `@global-secondary-text-transform` | Citation text transform. |

### Misc Base

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-quote-font-style` | `italic` | `<q>` element font style. |
| `@base-small-font-size` | `80%` | `<small>` element font size. |
| `@base-strong-font-weight` | `bolder` | `<strong>` / `<b>` font weight. |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 4. Headings (h1–h6)

Each HTML heading level has its own complete set of typography variables. h1–h3 use the **primary** font; h4–h6 use the **secondary** font.

### h1

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h1-font-family` | `@global-primary-font-family` | h1 font family. |
| `@base-h1-font-size` | `@base-h1-font-size-m * 0.85` | h1 font size (small screens). |
| `@base-h1-font-size-m` | `@global-2xlarge-font-size` (2.625rem) | h1 font size on ≥960px. |
| `@base-h1-font-style` | `@global-primary-font-style` | h1 font style. |
| `@base-h1-font-weight` | `@global-primary-font-weight` | h1 font weight. |
| `@base-h1-letter-spacing` | `@global-primary-letter-spacing` | h1 letter spacing. |
| `@base-h1-line-height` | `1.2` | h1 line height. |
| `@base-h1-text-transform` | `@global-primary-text-transform` | h1 text transform. |

### h2

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h2-font-family` | `@global-primary-font-family` | h2 font family. |
| `@base-h2-font-size` | `@base-h2-font-size-m * 0.85` | h2 font size (small screens). |
| `@base-h2-font-size-m` | `@global-xlarge-font-size` (2rem) | h2 font size on ≥960px. |
| `@base-h2-font-style` | `@global-primary-font-style` | h2 font style. |
| `@base-h2-font-weight` | `@global-primary-font-weight` | h2 font weight. |
| `@base-h2-letter-spacing` | `@global-primary-letter-spacing` | h2 letter spacing. |
| `@base-h2-line-height` | `1.3` | h2 line height. |
| `@base-h2-text-transform` | `@global-primary-text-transform` | h2 text transform. |

### h3

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h3-font-family` | `@global-primary-font-family` | h3 font family. |
| `@base-h3-font-size` | `@global-large-font-size` (1.5rem) | h3 font size. |
| `@base-h3-font-style` | `@global-primary-font-style` | h3 font style. |
| `@base-h3-font-weight` | `@global-primary-font-weight` | h3 font weight. |
| `@base-h3-letter-spacing` | `@global-primary-letter-spacing` | h3 letter spacing. |
| `@base-h3-line-height` | `1.4` | h3 line height. |
| `@base-h3-text-transform` | `@global-primary-text-transform` | h3 text transform. |

### h4

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h4-font-family` | `@global-secondary-font-family` | h4 font family (secondary). |
| `@base-h4-font-size` | `@global-medium-font-size` (1.25rem) | h4 font size. |
| `@base-h4-font-style` | `@global-secondary-font-style` | h4 font style. |
| `@base-h4-font-weight` | `@global-secondary-font-weight` | h4 font weight. |
| `@base-h4-letter-spacing` | `@global-secondary-letter-spacing` | h4 letter spacing. |
| `@base-h4-line-height` | `1.4` | h4 line height. |
| `@base-h4-text-transform` | `@global-secondary-text-transform` | h4 text transform. |

### h5

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h5-font-family` | `@global-secondary-font-family` | h5 font family (secondary). |
| `@base-h5-font-size` | `@global-font-size` (16px) | h5 font size. |
| `@base-h5-font-style` | `@global-secondary-font-style` | h5 font style. |
| `@base-h5-font-weight` | `@global-secondary-font-weight` | h5 font weight. |
| `@base-h5-letter-spacing` | `@global-secondary-letter-spacing` | h5 letter spacing. |
| `@base-h5-line-height` | `1.4` | h5 line height. |
| `@base-h5-text-transform` | `@global-secondary-text-transform` | h5 text transform. |

### h6

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-h6-font-family` | `@global-secondary-font-family` | h6 font family (secondary). |
| `@base-h6-font-size` | `@global-small-font-size` (0.875rem) | h6 font size. |
| `@base-h6-font-style` | `@global-secondary-font-style` | h6 font style. |
| `@base-h6-font-weight` | `@global-secondary-font-weight` | h6 font weight. |
| `@base-h6-letter-spacing` | `@global-secondary-letter-spacing` | h6 letter spacing. |
| `@base-h6-line-height` | `1.4` | h6 line height. |
| `@base-h6-text-transform` | `@global-secondary-text-transform` | h6 text transform. |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 5. Heading Component (Display Sizes)

The Heading component provides extra-large display-style headings for hero sections. Sizes scale up with responsive breakpoints (`-m` = ≥960px, `-l` = ≥1200px). All use the **primary** font.

### Small

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-small-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-small-font-size` | `@heading-small-font-size-m * 0.8` | Size (base). |
| `@heading-small-font-size-m` | `@heading-medium-font-size-l * 0.8125` | Size on ≥960px. |
| `@heading-small-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-small-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-small-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-small-line-height` | `1.2` | Line height. |
| `@heading-small-text-transform` | `@global-primary-text-transform` | Text transform. |

### Medium

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-medium-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-medium-font-size` | `@heading-medium-font-size-m * 0.825` | Size (base). |
| `@heading-medium-font-size-m` | `@heading-medium-font-size-l * 0.875` | Size on ≥960px. |
| `@heading-medium-font-size-l` | `4rem` (64px) | Size on ≥1200px. |
| `@heading-medium-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-medium-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-medium-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-medium-line-height` | `1.1` | Line height. |
| `@heading-medium-text-transform` | `@global-primary-text-transform` | Text transform. |

### Large

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-large-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-large-font-size` | `@heading-large-font-size-m * 0.85` | Size (base). |
| `@heading-large-font-size-m` | `@heading-medium-font-size-l` (4rem) | Size on ≥960px. |
| `@heading-large-font-size-l` | `6rem` (96px) | Size on ≥1200px. |
| `@heading-large-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-large-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-large-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-large-line-height` | `1.1` | Line height. |
| `@heading-large-text-transform` | `@global-primary-text-transform` | Text transform. |

### X-Large

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-xlarge-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-xlarge-font-size` | `@heading-large-font-size-m` (4rem) | Size (base). |
| `@heading-xlarge-font-size-m` | `@heading-large-font-size-l` (6rem) | Size on ≥960px. |
| `@heading-xlarge-font-size-l` | `8rem` (128px) | Size on ≥1200px. |
| `@heading-xlarge-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-xlarge-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-xlarge-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-xlarge-line-height` | `1` | Line height. |
| `@heading-xlarge-text-transform` | `@global-primary-text-transform` | Text transform. |

### 2X-Large

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-2xlarge-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-2xlarge-font-size` | `@heading-xlarge-font-size-m` (6rem) | Size (base). |
| `@heading-2xlarge-font-size-m` | `@heading-xlarge-font-size-l` (8rem) | Size on ≥960px. |
| `@heading-2xlarge-font-size-l` | `11rem` (176px) | Size on ≥1200px. |
| `@heading-2xlarge-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-2xlarge-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-2xlarge-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-2xlarge-line-height` | `1` | Line height. |
| `@heading-2xlarge-text-transform` | `@global-primary-text-transform` | Text transform. |

### 3X-Large

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-3xlarge-font-family` | `@global-primary-font-family` | Font family. |
| `@heading-3xlarge-font-size` | `@heading-2xlarge-font-size-m` (8rem) | Size (base). |
| `@heading-3xlarge-font-size-m` | `@heading-2xlarge-font-size-l` (11rem) | Size on ≥960px. |
| `@heading-3xlarge-font-size-l` | `15rem` (240px) | Size on ≥1200px. |
| `@heading-3xlarge-font-style` | `@global-primary-font-style` | Font style. |
| `@heading-3xlarge-font-weight` | `@global-primary-font-weight` | Font weight. |
| `@heading-3xlarge-letter-spacing` | `@global-primary-letter-spacing` | Letter spacing. |
| `@heading-3xlarge-line-height` | `1` | Line height. |
| `@heading-3xlarge-text-transform` | `@global-primary-text-transform` | Text transform. |

### Heading Decorative Line

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-line-height` | `@heading-line-border-width` | Height of the decorative line in `.uk-heading-line` (not a font line-height). |

📖 [UIkit Heading docs](https://getuikit.com/docs/heading)

---

## 6. Article

Blog post / article typography.

### Article Title

| Variable | Default | Description |
|----------|---------|-------------|
| `@article-title-font-family` | `@global-primary-font-family` | Title font family. |
| `@article-title-font-size` | `@article-title-font-size-m * 0.85` | Title font size (small screens). |
| `@article-title-font-size-m` | `@global-2xlarge-font-size` (2.625rem) | Title on ≥960px. |
| `@article-title-font-style` | `@global-primary-font-style` | Title font style. |
| `@article-title-font-weight` | `@global-primary-font-weight` | Title font weight. |
| `@article-title-letter-spacing` | `@global-primary-letter-spacing` | Title letter spacing. |
| `@article-title-line-height` | `1.2` | Title line height. |
| `@article-title-text-transform` | `@global-primary-text-transform` | Title text transform. |

### Article Meta

| Variable | Default | Description |
|----------|---------|-------------|
| `@article-meta-font-family` | `@global-secondary-font-family` | Meta font family. |
| `@article-meta-font-size` | `@global-small-font-size` | Meta font size. |
| `@article-meta-font-style` | `@global-secondary-font-style` | Meta font style. |
| `@article-meta-font-weight` | `@global-secondary-font-weight` | Meta font weight. |
| `@article-meta-letter-spacing` | `@global-secondary-letter-spacing` | Meta letter spacing. |
| `@article-meta-line-height` | `1.4` | Meta line height. |
| `@article-meta-text-transform` | `@global-secondary-text-transform` | Meta text transform. |

📖 [UIkit Article docs](https://getuikit.com/docs/article)

---

## 7. Card

### Card Title

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-title-font-family` | `@global-primary-font-family` | Card title font family. |
| `@card-title-font-size` | `@global-large-font-size` (1.5rem) | Card title font size. |
| `@card-title-font-style` | `@global-primary-font-style` | Card title font style. |
| `@card-title-font-weight` | `@global-primary-font-weight` | Card title font weight. |
| `@card-title-letter-spacing` | `@global-primary-letter-spacing` | Card title letter spacing. |
| `@card-title-line-height` | `1.4` | Card title line height. |
| `@card-title-text-transform` | `@global-primary-text-transform` | Card title text transform. |

### Card Badge

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-badge-font-family` | `@global-secondary-font-family` | Badge font family. |
| `@card-badge-font-size` | `@global-small-font-size` | Badge font size. |
| `@card-badge-font-weight` | `@global-secondary-font-weight` | Badge font weight. |
| `@card-badge-letter-spacing` | `@global-secondary-letter-spacing` | Badge letter spacing. |
| `@card-badge-text-transform` | `@global-secondary-text-transform` | Badge text transform. |

📖 [UIkit Card docs](https://getuikit.com/docs/card)

---

## 8. Text Utility

Utility classes for text styles (`.uk-text-lead`, `.uk-text-meta`, `.uk-text-large`, `.uk-text-small`).

### Lead Text

| Variable | Default | Description |
|----------|---------|-------------|
| `@text-lead-font-family` | `@global-primary-font-family` | Lead text font family. |
| `@text-lead-font-size` | `@global-large-font-size` (1.5rem) | Lead text font size. |
| `@text-lead-font-style` | `@global-primary-font-style` | Lead text font style. |
| `@text-lead-font-weight` | `@global-primary-font-weight` | Lead text font weight. |
| `@text-lead-letter-spacing` | `@global-primary-letter-spacing` | Lead text letter spacing. |
| `@text-lead-line-height` | `1.5` | Lead text line height. |
| `@text-lead-text-transform` | `@global-primary-text-transform` | Lead text transform. |

### Meta Text

| Variable | Default | Description |
|----------|---------|-------------|
| `@text-meta-font-family` | `@global-secondary-font-family` | Meta text font family. |
| `@text-meta-font-size` | `@global-small-font-size` | Meta text font size. |
| `@text-meta-font-style` | `@global-secondary-font-style` | Meta text font style. |
| `@text-meta-font-weight` | `@global-secondary-font-weight` | Meta text font weight. |
| `@text-meta-letter-spacing` | `@global-secondary-letter-spacing` | Meta text letter spacing. |
| `@text-meta-line-height` | `1.4` | Meta text line height. |
| `@text-meta-text-transform` | `@global-secondary-text-transform` | Meta text transform. |

### Size Utilities

| Variable | Default | Description |
|----------|---------|-------------|
| `@text-small-font-size` | `@global-small-font-size` | `.uk-text-small` font size. |
| `@text-small-line-height` | `1.5` | `.uk-text-small` line height. |
| `@text-large-font-size` | `@global-large-font-size` | `.uk-text-large` font size. |
| `@text-large-line-height` | `1.5` | `.uk-text-large` line height. |

📖 [UIkit Text docs](https://getuikit.com/docs/text)

---

## 9. Button

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-font-family` | `@global-secondary-font-family` | Button font family. |
| `@button-font-size` | `@global-small-font-size` | Default button font size. |
| `@button-font-style` | `@global-secondary-font-style` | Button font style. |
| `@button-font-weight` | `@global-secondary-font-weight` | Button font weight. |
| `@button-letter-spacing` | `@global-secondary-letter-spacing` | Button letter spacing. |
| `@button-text-transform` | `@global-secondary-text-transform` | Button text transform. |
| `@button-line-height` | `@global-control-height - (@button-border-width * 2)` | Default button line height. |
| `@button-small-font-size` | `@global-small-font-size` | Small button font size. |
| `@button-small-line-height` | `@global-control-small-height - (@button-border-width * 2)` | Small button line height. |
| `@button-large-font-size` | `@global-small-font-size` | Large button font size. |
| `@button-large-line-height` | `@global-control-large-height - (@button-border-width * 2)` | Large button line height. |
| `@button-link-line-height` | `@global-line-height` | Link-style button line height. |
| `@button-text-line-height` | `@global-line-height` | Text-style button line height. |

📖 [UIkit Button docs](https://getuikit.com/docs/button)

---

## 10. Navbar

### Navbar Nav Items

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-nav-item-font-family` | `@global-secondary-font-family` | Nav link font family. |
| `@navbar-nav-item-font-size` | `@global-small-font-size` | Nav link font size. |
| `@navbar-nav-item-font-style` | `@global-secondary-font-style` | Nav link font style. |
| `@navbar-nav-item-font-weight` | `@global-secondary-font-weight` | Nav link font weight. |
| `@navbar-nav-item-letter-spacing` | `@global-secondary-letter-spacing` | Nav link letter spacing. |
| `@navbar-nav-item-line-height` | `1px` | Nav link line-height (used for underline positioning). |
| `@navbar-nav-item-text-transform` | `@global-secondary-text-transform` | Nav link text transform. |

### Navbar Content Item

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-item-font-family` | `@navbar-nav-item-font-family` | Content item font family. |
| `@navbar-item-font-size` | `@navbar-nav-item-font-size` | Content item font size. |

### Navbar Primary Variant

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-primary-nav-item-font-size` | `@global-large-font-size` | Primary navbar nav link size (larger). |
| `@navbar-primary-nav-item-font-weight` | `400` | Primary navbar nav link weight. |

### Navbar Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@navbar-subtitle-font-size` | `@global-small-font-size` | Subtitle font size. |
| `@navbar-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@navbar-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@navbar-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@navbar-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@navbar-subtitle-text-transform` | `inherit` | Subtitle text transform. |

### Navbar Dropdown Nav

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-nav-font-family` | `@global-secondary-font-family` | Dropdown nav font family. |
| `@navbar-dropdown-nav-font-size` | `@global-font-size` | Dropdown nav font size. |
| `@navbar-dropdown-nav-font-style` | `@global-secondary-font-style` | Dropdown nav font style. |
| `@navbar-dropdown-nav-font-weight` | `@global-secondary-font-weight` | Dropdown nav font weight. |
| `@navbar-dropdown-nav-letter-spacing` | `@global-secondary-letter-spacing` | Dropdown nav letter spacing. |
| `@navbar-dropdown-nav-text-transform` | `@global-secondary-text-transform` | Dropdown nav text transform. |

### Navbar Dropdown Nav Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-nav-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@navbar-dropdown-nav-subtitle-font-size` | `12px` | Subtitle font size. |
| `@navbar-dropdown-nav-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@navbar-dropdown-nav-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@navbar-dropdown-nav-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@navbar-dropdown-nav-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@navbar-dropdown-nav-subtitle-text-transform` | `inherit` | Subtitle text transform. |

📖 [UIkit Navbar docs](https://getuikit.com/docs/navbar)

---

## 11. Nav

### Nav Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-default-font-family` | `@global-secondary-font-family` | Default nav font family. |
| `@nav-default-font-size` | `@global-small-font-size` | Default nav font size. |
| `@nav-default-font-style` | `@global-secondary-font-style` | Default nav font style. |
| `@nav-default-font-weight` | `@global-secondary-font-weight` | Default nav font weight. |
| `@nav-default-letter-spacing` | `@global-secondary-letter-spacing` | Default nav letter spacing. |
| `@nav-default-line-height` | `@global-line-height` | Default nav line height. |
| `@nav-default-text-transform` | `@global-secondary-text-transform` | Default nav text transform. |
| `@nav-default-item-line-height` | `@global-border-width` | Item active line decoration height. |
| `@nav-default-sublist-font-size` | `@nav-default-font-size` | Sublist font size. |
| `@nav-default-sublist-line-height` | `@nav-default-line-height` | Sublist line height. |

### Nav Default Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-default-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@nav-default-subtitle-font-size` | `12px` | Subtitle font size. |
| `@nav-default-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@nav-default-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@nav-default-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@nav-default-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@nav-default-subtitle-text-transform` | `inherit` | Subtitle text transform. |

### Nav Primary

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-primary-font-family` | `@global-primary-font-family` | Primary nav font family. |
| `@nav-primary-font-size` | `@global-large-font-size` (1.5rem) | Primary nav font size. |
| `@nav-primary-font-style` | `@global-primary-font-style` | Primary nav font style. |
| `@nav-primary-font-weight` | `@global-primary-font-weight` | Primary nav font weight. |
| `@nav-primary-letter-spacing` | `@global-primary-letter-spacing` | Primary nav letter spacing. |
| `@nav-primary-line-height` | `@global-line-height` | Primary nav line height. |
| `@nav-primary-text-transform` | `@global-primary-text-transform` | Primary nav text transform. |
| `@nav-primary-item-line-height` | `@global-border-width` | Item active line decoration height. |
| `@nav-primary-sublist-font-size` | `@global-medium-font-size` | Sublist font size. |
| `@nav-primary-sublist-line-height` | `@global-line-height` | Sublist line height. |

### Nav Primary Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-primary-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@nav-primary-subtitle-font-size` | `@global-medium-font-size` | Subtitle font size. |
| `@nav-primary-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@nav-primary-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@nav-primary-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@nav-primary-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@nav-primary-subtitle-text-transform` | `inherit` | Subtitle text transform. |

### Nav Secondary

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-secondary-font-family` | `@global-secondary-font-family` | Secondary nav font family. |
| `@nav-secondary-font-size` | `@global-font-size` | Secondary nav font size. |
| `@nav-secondary-font-style` | `@global-secondary-font-style` | Secondary nav font style. |
| `@nav-secondary-font-weight` | `@global-secondary-font-weight` | Secondary nav font weight. |
| `@nav-secondary-letter-spacing` | `@global-secondary-letter-spacing` | Secondary nav letter spacing. |
| `@nav-secondary-line-height` | `@global-line-height` | Secondary nav line height. |
| `@nav-secondary-text-transform` | `@global-secondary-text-transform` | Secondary nav text transform. |
| `@nav-secondary-sublist-font-size` | `@global-small-font-size` | Sublist font size. |
| `@nav-secondary-sublist-line-height` | `@global-line-height` | Sublist line height. |

### Nav Secondary Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-secondary-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@nav-secondary-subtitle-font-size` | `@global-small-font-size` | Subtitle font size. |
| `@nav-secondary-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@nav-secondary-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@nav-secondary-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@nav-secondary-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@nav-secondary-subtitle-text-transform` | `inherit` | Subtitle text transform. |

### Nav Header

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-header-font-size` | `@global-small-font-size` | Nav header font size. |
| `@nav-header-font-weight` | `inherit` | Nav header font weight. |
| `@nav-header-letter-spacing` | `@global-secondary-letter-spacing` | Nav header letter spacing. |
| `@nav-header-text-transform` | `uppercase` | Nav header text transform. |

### Nav Display Sizes (used in offcanvas/fullscreen menus)

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-medium-font-size` | `@nav-medium-font-size-m * 0.825` | Medium nav size (base). |
| `@nav-medium-font-size-m` | `@nav-medium-font-size-l * 0.875` | Medium on ≥960px. |
| `@nav-medium-font-size-l` | `4rem` | Medium on ≥1200px. |
| `@nav-medium-line-height` | `1` | Medium line height. |
| `@nav-large-font-size` | `@nav-large-font-size-m * 0.85` | Large nav size (base). |
| `@nav-large-font-size-m` | `4rem` | Large on ≥960px. |
| `@nav-large-font-size-l` | `6rem` | Large on ≥1200px. |
| `@nav-large-line-height` | `1` | Large line height. |
| `@nav-xlarge-font-size` | `4rem` | X-Large nav size (base). |
| `@nav-xlarge-font-size-m` | `6rem` | X-Large on ≥960px. |
| `@nav-xlarge-font-size-l` | `8rem` | X-Large on ≥1200px. |
| `@nav-xlarge-line-height` | `1` | X-Large line height. |

📖 [UIkit Nav docs](https://getuikit.com/docs/nav)

---

## 12. Dropdown Nav

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropdown-nav-font-family` | `@global-secondary-font-family` | Dropdown nav font family. |
| `@dropdown-nav-font-size` | `@global-font-size` | Dropdown nav font size. |
| `@dropdown-nav-font-style` | `@global-secondary-font-style` | Dropdown nav font style. |
| `@dropdown-nav-font-weight` | `@global-secondary-font-weight` | Dropdown nav font weight. |
| `@dropdown-nav-letter-spacing` | `@global-secondary-letter-spacing` | Dropdown nav letter spacing. |
| `@dropdown-nav-text-transform` | `@global-secondary-text-transform` | Dropdown nav text transform. |

### Dropdown Nav Subtitle

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropdown-nav-subtitle-font-family` | `inherit` | Subtitle font family. |
| `@dropdown-nav-subtitle-font-size` | `12px` | Subtitle font size. |
| `@dropdown-nav-subtitle-font-style` | `inherit` | Subtitle font style. |
| `@dropdown-nav-subtitle-font-weight` | `inherit` | Subtitle font weight. |
| `@dropdown-nav-subtitle-letter-spacing` | `inherit` | Subtitle letter spacing. |
| `@dropdown-nav-subtitle-line-height` | `inherit` | Subtitle line height. |
| `@dropdown-nav-subtitle-text-transform` | `inherit` | Subtitle text transform. |

📖 [UIkit Dropdown docs](https://getuikit.com/docs/dropdown)

---

## 13. Subnav

| Variable | Default | Description |
|----------|---------|-------------|
| `@subnav-item-font-family` | `@global-secondary-font-family` | Subnav item font family. |
| `@subnav-item-font-size` | `@global-small-font-size` | Subnav item font size. |
| `@subnav-item-font-style` | `@global-secondary-font-style` | Subnav item font style. |
| `@subnav-item-font-weight` | `@global-secondary-font-weight` | Subnav item font weight. |
| `@subnav-item-letter-spacing` | `@global-secondary-letter-spacing` | Subnav item letter spacing. |
| `@subnav-item-text-transform` | `@global-secondary-text-transform` | Subnav item text transform. |

📖 [UIkit Subnav docs](https://getuikit.com/docs/subnav)

---

## 14. Tab

| Variable | Default | Description |
|----------|---------|-------------|
| `@tab-item-font-family` | `@global-secondary-font-family` | Tab item font family. |
| `@tab-item-font-size` | `@global-font-size` | Tab item font size. |
| `@tab-item-font-style` | `@global-secondary-font-style` | Tab item font style. |
| `@tab-item-font-weight` | `@global-secondary-font-weight` | Tab item font weight. |
| `@tab-item-letter-spacing` | `@global-secondary-letter-spacing` | Tab item letter spacing. |
| `@tab-item-line-height` | `@global-line-height` | Tab item line height. |
| `@tab-item-text-transform` | `@global-secondary-text-transform` | Tab item text transform. |

📖 [UIkit Tab docs](https://getuikit.com/docs/tab)

---

## 15. Breadcrumb

| Variable | Default | Description |
|----------|---------|-------------|
| `@breadcrumb-item-font-family` | `@global-secondary-font-family` | Breadcrumb font family. |
| `@breadcrumb-item-font-size` | `@global-small-font-size` | Breadcrumb font size. |
| `@breadcrumb-item-font-style` | `@global-secondary-font-style` | Breadcrumb font style. |
| `@breadcrumb-item-font-weight` | `@global-secondary-font-weight` | Breadcrumb font weight. |
| `@breadcrumb-item-letter-spacing` | `@global-secondary-letter-spacing` | Breadcrumb letter spacing. |
| `@breadcrumb-item-text-transform` | `@global-secondary-text-transform` | Breadcrumb text transform. |
| `@breadcrumb-divider-font-size` | `@breadcrumb-item-font-size` | Divider font size. |

📖 [UIkit Breadcrumb docs](https://getuikit.com/docs/breadcrumb)

---

## 16. Pagination

| Variable | Default | Description |
|----------|---------|-------------|
| `@pagination-item-font-family` | `@global-secondary-font-family` | Pagination font family. |
| `@pagination-item-font-size` | `@global-font-size` | Pagination font size. |
| `@pagination-item-font-style` | `@global-secondary-font-style` | Pagination font style. |
| `@pagination-item-font-weight` | `@global-secondary-font-weight` | Pagination font weight. |
| `@pagination-item-letter-spacing` | `@global-secondary-letter-spacing` | Pagination letter spacing. |
| `@pagination-item-text-transform` | `@global-secondary-text-transform` | Pagination text transform. |

📖 [UIkit Pagination docs](https://getuikit.com/docs/pagination)

---

## 17. Badge

| Variable | Default | Description |
|----------|---------|-------------|
| `@badge-font-family` | `@global-secondary-font-family` | Badge font family. |
| `@badge-font-size` | `11px` | Badge font size. |
| `@badge-font-style` | `@global-secondary-font-style` | Badge font style. |
| `@badge-font-weight` | `normal` | Badge font weight. |

📖 [UIkit Badge docs](https://getuikit.com/docs/badge)

---

## 18. Label

| Variable | Default | Description |
|----------|---------|-------------|
| `@label-font-family` | `@global-secondary-font-family` | Label font family. |
| `@label-font-size` | `@global-small-font-size` | Label font size. |
| `@label-font-style` | `@global-secondary-font-style` | Label font style. |
| `@label-font-weight` | `@global-secondary-font-weight` | Label font weight. |
| `@label-letter-spacing` | `@global-secondary-letter-spacing` | Label letter spacing. |
| `@label-line-height` | `@global-line-height` | Label line height. |
| `@label-text-transform` | `@global-secondary-text-transform` | Label text transform. |

📖 [UIkit Label docs](https://getuikit.com/docs/label)

---

## 19. Comment

### Comment Title

| Variable | Default | Description |
|----------|---------|-------------|
| `@comment-title-font-size` | `@global-medium-font-size` | Comment title font size. |
| `@comment-title-line-height` | `1.4` | Comment title line height. |

### Comment Meta

| Variable | Default | Description |
|----------|---------|-------------|
| `@comment-meta-font-family` | `@global-secondary-font-family` | Meta font family. |
| `@comment-meta-font-size` | `@global-small-font-size` | Meta font size. |
| `@comment-meta-font-style` | `@global-secondary-font-style` | Meta font style. |
| `@comment-meta-font-weight` | `@global-secondary-font-weight` | Meta font weight. |
| `@comment-meta-letter-spacing` | `@global-secondary-letter-spacing` | Meta letter spacing. |
| `@comment-meta-line-height` | `1.4` | Meta line height. |
| `@comment-meta-text-transform` | `@global-secondary-text-transform` | Meta text transform. |

📖 [UIkit Comment docs](https://getuikit.com/docs/comment)

---

## 20. Description List

### Term (dt)

| Variable | Default | Description |
|----------|---------|-------------|
| `@description-list-term-font-family` | `@global-secondary-font-family` | Term font family. |
| `@description-list-term-font-size` | `@global-font-size` | Term font size. |
| `@description-list-term-font-style` | `@global-secondary-font-style` | Term font style. |
| `@description-list-term-font-weight` | `@global-secondary-font-weight` | Term font weight. |
| `@description-list-term-letter-spacing` | `@global-secondary-letter-spacing` | Term letter spacing. |
| `@description-list-term-text-transform` | `@global-secondary-text-transform` | Term text transform. |

### Description (dd)

| Variable | Default | Description |
|----------|---------|-------------|
| `@description-list-description-font-family` | `inherit` | Description font family. |
| `@description-list-description-font-size` | `@global-font-size` | Description font size. |
| `@description-list-description-font-style` | `inherit` | Description font style. |
| `@description-list-description-font-weight` | `inherit` | Description font weight. |
| `@description-list-description-letter-spacing` | `inherit` | Description letter spacing. |
| `@description-list-description-text-transform` | `inherit` | Description text transform. |

📖 [UIkit Description List docs](https://getuikit.com/docs/description-list)

---

## 21. Form

### Input Fields

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-line-height` | `@form-height - (@form-border-width * 2)` | Default input line height. |
| `@form-small-font-size` | `@global-small-font-size` | Small input font size. |
| `@form-small-line-height` | `@form-small-height - (@form-border-width * 2)` | Small input line height. |
| `@form-large-font-size` | `@global-medium-font-size` | Large input font size. |
| `@form-large-line-height` | `@form-large-height - (@form-border-width * 2)` | Large input line height. |

### Form Labels

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-label-font-family` | `@global-secondary-font-family` | Label font family. |
| `@form-label-font-size` | `@global-font-size` | Label font size. |
| `@form-label-font-style` | `@global-secondary-font-style` | Label font style. |
| `@form-label-font-weight` | `@global-secondary-font-weight` | Label font weight. |
| `@form-label-letter-spacing` | `@global-secondary-letter-spacing` | Label letter spacing. |
| `@form-label-text-transform` | `@global-secondary-text-transform` | Label text transform. |

### Form Legend

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-legend-font-size` | `@global-large-font-size` | Legend font size. |
| `@form-legend-line-height` | `1.4` | Legend line height. |

📖 [UIkit Form docs](https://getuikit.com/docs/form)

---

## 22. Modal

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-title-font-family` | `@global-primary-font-family` | Modal title font family. |
| `@modal-title-font-size` | `@global-xlarge-font-size` (2rem) | Modal title font size. |
| `@modal-title-font-style` | `@global-primary-font-style` | Modal title font style. |
| `@modal-title-font-weight` | `@global-primary-font-weight` | Modal title font weight. |
| `@modal-title-letter-spacing` | `@global-primary-letter-spacing` | Modal title letter spacing. |
| `@modal-title-line-height` | `1.3` | Modal title line height. |
| `@modal-title-text-transform` | `@global-primary-text-transform` | Modal title text transform. |

📖 [UIkit Modal docs](https://getuikit.com/docs/modal)

---

## 23. Table

| Variable | Default | Description |
|----------|---------|-------------|
| `@table-header-cell-font-family` | `inherit` | Header cell font family. |
| `@table-header-cell-font-size` | `@global-small-font-size` | Header cell font size. |
| `@table-header-cell-font-style` | `inherit` | Header cell font style. |
| `@table-header-cell-font-weight` | `normal` | Header cell font weight. |
| `@table-header-cell-letter-spacing` | `inherit` | Header cell letter spacing. |
| `@table-header-cell-text-transform` | `uppercase` | Header cell text transform. |
| `@table-caption-font-size` | `@global-small-font-size` | Caption font size. |
| `@table-footer-font-size` | `@global-small-font-size` | Footer font size. |

📖 [UIkit Table docs](https://getuikit.com/docs/table)

---

## 24. Notification

| Variable | Default | Description |
|----------|---------|-------------|
| `@notification-message-font-size` | `@global-font-size` | Notification message font size. |
| `@notification-message-line-height` | `1.5` | Notification message line height. |

📖 [UIkit Notification docs](https://getuikit.com/docs/notification)

---

## 25. Countdown

| Variable | Default | Description |
|----------|---------|-------------|
| `@countdown-separator-font-size` | `0.5em` | Separator (:) font size between digits. |
| `@countdown-separator-line-height` | `2` | Separator line height. |

📖 [UIkit Countdown docs](https://getuikit.com/docs/countdown)

---

## 26. Accordion

| Variable | Default | Description |
|----------|---------|-------------|
| `@accordion-default-title-font-family` | `@global-primary-font-family` | Title font family. |
| `@accordion-default-title-font-size` | `@global-medium-font-size` (1.25rem) | Title font size. |
| `@accordion-default-title-font-style` | `@global-primary-font-style` | Title font style. |
| `@accordion-default-title-font-weight` | `@global-primary-font-weight` | Title font weight. |
| `@accordion-default-title-letter-spacing` | `@global-primary-letter-spacing` | Title letter spacing. |
| `@accordion-default-title-line-height` | `1.4` | Title line height. |
| `@accordion-default-title-text-transform` | `@global-primary-text-transform` | Title text transform. |

📖 [UIkit Accordion docs](https://getuikit.com/docs/accordion)

---

## 27. Search

Each search variant (default, medium, large, navbar) has a full set of typography variables.

### Default

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-default-font-family` | `inherit` | Default search font family. |
| `@search-default-font-size` | `inherit` | Default search font size. |
| `@search-default-font-style` | `inherit` | Default search font style. |
| `@search-default-font-weight` | `inherit` | Default search font weight. |
| `@search-default-letter-spacing` | `inherit` | Default search letter spacing. |
| `@search-default-text-transform` | `inherit` | Default search text transform. |

### Medium

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-medium-font-family` | `inherit` | Medium search font family. |
| `@search-medium-font-size` | `@global-large-font-size` (1.5rem) | Medium search font size. |
| `@search-medium-font-style` | `inherit` | Medium search font style. |
| `@search-medium-font-weight` | `inherit` | Medium search font weight. |
| `@search-medium-letter-spacing` | `inherit` | Medium search letter spacing. |
| `@search-medium-text-transform` | `inherit` | Medium search text transform. |

### Large

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-large-font-family` | `inherit` | Large search font family. |
| `@search-large-font-size` | `@global-2xlarge-font-size` (2.625rem) | Large search font size. |
| `@search-large-font-style` | `inherit` | Large search font style. |
| `@search-large-font-weight` | `inherit` | Large search font weight. |
| `@search-large-letter-spacing` | `inherit` | Large search letter spacing. |
| `@search-large-text-transform` | `inherit` | Large search text transform. |

### Navbar

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-navbar-font-family` | `inherit` | Navbar search font family. |
| `@search-navbar-font-size` | `inherit` | Navbar search font size. |
| `@search-navbar-font-style` | `inherit` | Navbar search font style. |
| `@search-navbar-font-weight` | `inherit` | Navbar search font weight. |
| `@search-navbar-letter-spacing` | `inherit` | Navbar search letter spacing. |
| `@search-navbar-text-transform` | `inherit` | Navbar search text transform. |

📖 [UIkit Search docs](https://getuikit.com/docs/search)

---

## 28. Tooltip

| Variable | Default | Description |
|----------|---------|-------------|
| `@tooltip-font-size` | `12px` | Tooltip font size. |

📖 [UIkit Tooltip docs](https://getuikit.com/docs/tooltip)

---

## 29. Logo

| Variable | Default | Description |
|----------|---------|-------------|
| `@logo-font-family` | `@global-font-family` | Logo text font family. |
| `@logo-font-size` | `@global-large-font-size` (1.5rem) | Logo text font size. |
| `@logo-font-weight` | `inherit` | Logo text font weight. |
| `@logo-letter-spacing` | `inherit` | Logo text letter spacing. |
| `@logo-text-transform` | `inherit` | Logo text transform. |

📖 [UIkit Utility docs (Logo)](https://getuikit.com/docs/utility#logo)

---

## 30. Iconnav

| Variable | Default | Description |
|----------|---------|-------------|
| `@iconnav-item-font-size` | `@global-small-font-size` | Icon nav item font size (icon sizing). |

📖 [UIkit Iconnav docs](https://getuikit.com/docs/iconnav)

---

## 31. Leader

| Variable | Default | Description |
|----------|---------|-------------|
| `@leader-font-family` | `inherit` | Leader dots font family. |
| `@leader-font-size` | `inherit` | Leader dots font size. |
| `@leader-font-weight` | `inherit` | Leader dots font weight. |
| `@leader-letter-spacing` | `inherit` | Leader dots letter spacing. |

📖 [UIkit Leader docs](https://getuikit.com/docs/leader)

---

## 32. Dropcap

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropcap-font-family` | `inherit` | Drop capital font family. |
| `@dropcap-font-size` | `(@global-line-height * 3) * 1em` | Drop capital size (≈4.5em). |
| `@dropcap-font-style` | `inherit` | Drop capital font style. |
| `@dropcap-font-weight` | `inherit` | Drop capital font weight. |
| `@dropcap-letter-spacing` | `inherit` | Drop capital letter spacing. |
| `@dropcap-line-height` | `1` | Drop capital line height. |
| `@dropcap-text-transform` | `inherit` | Drop capital text transform. |

📖 [UIkit Utility docs (Dropcap)](https://getuikit.com/docs/utility#dropcap)

---

## 33. List

| Variable | Default | Description |
|----------|---------|-------------|
| `@list-marker-height` | `@global-line-height * 1em` (1.5em) | Height of list markers (bullets). Not a font property but affects text alignment. |

📖 [UIkit List docs](https://getuikit.com/docs/list)

---

## Font Family Cascade

```
@global-font-family (system stack)
├── @base-body-font-family
├── @base-heading-font-family
├── @logo-font-family
│
@global-primary-font-family (inherit)
├── @base-h1-font-family ... @base-h3-font-family
├── @heading-small ... @heading-3xlarge-font-family
├── @article-title-font-family
├── @card-title-font-family
├── @modal-title-font-family
├── @accordion-default-title-font-family
├── @base-blockquote-font-family
├── @text-lead-font-family
├── @nav-primary-font-family
│
@global-secondary-font-family (inherit)
├── @base-h4-font-family ... @base-h6-font-family
├── @navbar-nav-item-font-family
├── @nav-default-font-family
├── @nav-secondary-font-family
├── @button-font-family
├── @tab-item-font-family
├── @subnav-item-font-family
├── @breadcrumb-item-font-family
├── @pagination-item-font-family
├── @badge-font-family
├── @label-font-family
├── @form-label-font-family
├── @card-badge-font-family
├── @dropdown-nav-font-family
├── @navbar-dropdown-nav-font-family
├── @article-meta-font-family
├── @comment-meta-font-family
├── @text-meta-font-family
├── @description-list-term-font-family
├── @base-blockquote-footer-font-family
│
@global-tertiary-font-family (inherit)
└── (available for custom use)
```

---

## Font Size Cascade

```
@global-2xlarge-font-size (2.625rem / ≈42px)
├── @base-h1-font-size-m
├── @article-title-font-size-m
├── @search-large-font-size
│
@global-xlarge-font-size (2rem / ≈32px)
├── @base-h2-font-size-m
├── @modal-title-font-size
│
@global-large-font-size (1.5rem / ≈24px)
├── @base-h3-font-size
├── @card-title-font-size
├── @text-lead-font-size
├── @text-large-font-size
├── @nav-primary-font-size
├── @navbar-primary-nav-item-font-size
├── @logo-font-size
├── @form-legend-font-size
├── @search-medium-font-size
│
@global-medium-font-size (1.25rem / ≈20px)
├── @base-h4-font-size
├── @accordion-default-title-font-size
├── @base-blockquote-font-size
├── @comment-title-font-size
├── @nav-primary-sublist-font-size
│
@global-font-size (16px)
├── @base-body-font-size / @base-h5-font-size
├── @nav-secondary-font-size
├── @tab-item-font-size
├── @pagination-item-font-size
├── @dropdown-nav-font-size
├── @navbar-dropdown-nav-font-size
├── @form-label-font-size
├── @description-list-term/description-font-size
├── @notification-message-font-size
│
@global-small-font-size (0.875rem / ≈14px)
├── @base-h6-font-size / @base-code-font-size
├── @article-meta-font-size
├── @button-font-size (all sizes)
├── @navbar-nav-item-font-size
├── @nav-default-font-size
├── @subnav-item-font-size
├── @breadcrumb-item-font-size
├── @card-badge-font-size
├── @label-font-size
├── @text-small-font-size / @text-meta-font-size
├── @comment-meta-font-size
├── @form-small-font-size
├── @nav-header-font-size
├── @table-header-cell/caption/footer-font-size
├── @navbar-subtitle-font-size
├── @iconnav-item-font-size
```

---

## Responsive Suffix Reference

| Suffix | Breakpoint | Min Width |
|--------|------------|-----------|
| `-m` | Medium | `960px` |
| `-l` | Large | `1200px` |

Font sizes with `-m` or `-l` suffixes provide responsive scaling. For example, `@base-h1-font-size` applies on small screens while `@base-h1-font-size-m` takes effect on ≥960px.

---

> **Tip:** To change all heading typography at once, modify the `@global-primary-*` variables. To customize only UI/navigation text, modify the `@global-secondary-*` variables. For single-component changes, override that component's specific variable.

---

*Generated from `docs/uikit-less-consolidated/_all-variables.less` with reference to [UIkit](https://getuikit.com/docs/) and [YOOtheme Pro](https://yootheme.com/support/yootheme-pro/wordpress/introduction) documentation.*
