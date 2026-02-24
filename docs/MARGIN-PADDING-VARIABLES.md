# UIkit Margin & Padding Variables Reference

> All Less variables controlling spacing (margin and padding) extracted from `_all-variables.less`.  
> Grouped by component with descriptions of what each variable controls and links to the relevant UIkit documentation.

---

## Table of Contents

- [UIkit Margin \& Padding Variables Reference](#uikit-margin--padding-variables-reference)
  - [Table of Contents](#table-of-contents)
  - [1. Global Spacing Scale](#1-global-spacing-scale)
    - [Global Margins](#global-margins)
    - [Global Gutters](#global-gutters)
  - [2. Margin Utility](#2-margin-utility)
  - [3. Padding Utility](#3-padding-utility)
  - [4. Position Utility](#4-position-utility)
  - [5. Section](#5-section)
  - [6. Tile](#6-tile)
  - [7. Container](#7-container)
  - [8. Card](#8-card)
    - [Card Body](#card-body)
    - [Card Header](#card-header)
    - [Card Footer](#card-footer)
    - [Card Badge](#card-badge)
  - [9. Navbar](#9-navbar)
    - [Navbar Bar](#navbar-bar)
    - [Navbar Nav Items](#navbar-nav-items)
    - [Navbar Primary Variant](#navbar-primary-variant)
    - [Navbar Dropdown](#navbar-dropdown)
    - [Navbar Dropdown Nav](#navbar-dropdown-nav)
    - [Navbar Dropdown Dropbar](#navbar-dropdown-dropbar)
  - [10. Nav](#10-nav)
    - [Nav Primary Variant](#nav-primary-variant)
    - [Nav Secondary Variant](#nav-secondary-variant)
    - [Internal Nav Variables](#internal-nav-variables)
  - [11. Dropdown](#11-dropdown)
    - [Dropdown Dropbar Mode](#dropdown-dropbar-mode)
  - [12. Drop](#12-drop)
  - [13. Dropbar](#13-dropbar)
  - [14. Modal](#14-modal)
    - [Modal Dialog Wrapper](#modal-dialog-wrapper)
    - [Modal Body](#modal-body)
    - [Modal Header](#modal-header)
    - [Modal Footer](#modal-footer)
    - [Modal Close Button](#modal-close-button)
  - [15. Offcanvas](#15-offcanvas)
  - [16. Alert](#16-alert)
  - [17. Accordion](#17-accordion)
  - [18. Article](#18-article)
  - [19. Badge](#19-badge)
  - [20. Base (Typography)](#20-base-typography)
  - [21. Breadcrumb](#21-breadcrumb)
  - [22. Button](#22-button)
    - [Internal Button Variables](#internal-button-variables)
  - [23. Comment](#23-comment)
  - [24. Description List](#24-description-list)
  - [25. Divider](#25-divider)
  - [26. Dotnav](#26-dotnav)
  - [27. Form](#27-form)
    - [Input Padding](#input-padding)
    - [Multi-line (Textarea)](#multi-line-textarea)
    - [Form Layout](#form-layout)
    - [Form Misc](#form-misc)
  - [28. Heading](#28-heading)
  - [29. Iconnav](#29-iconnav)
  - [30. Label](#30-label)
  - [31. Leader](#31-leader)
  - [32. Lightbox](#32-lightbox)
  - [33. List](#33-list)
    - [Large List](#large-list)
  - [34. Marker](#34-marker)
  - [35. Notification](#35-notification)
  - [36. Overlay](#36-overlay)
  - [37. Pagination](#37-pagination)
  - [38. Panel](#38-panel)
  - [39. Placeholder](#39-placeholder)
  - [40. Progress](#40-progress)
  - [41. Search](#41-search)
  - [42. Slider](#42-slider)
  - [43. Slidenav](#43-slidenav)
  - [44. Subnav](#44-subnav)
  - [45. Tab](#45-tab)
  - [46. Table](#46-table)
  - [47. Text](#47-text)
  - [48. Thumbnav](#48-thumbnav)
  - [49. Tooltip](#49-tooltip)
  - [50. Totop](#50-totop)
  - [Responsive Suffix Reference](#responsive-suffix-reference)
  - [How Variables Cascade](#how-variables-cascade)
  - [Align Utility (Bonus)](#align-utility-bonus)
  - [Dropcap (Bonus)](#dropcap-bonus)

---

## 1. Global Spacing Scale

The foundation of all UIkit spacing. Most component margin/padding variables reference these globals, so changing them cascades across the entire theme.

### Global Margins

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-margin` | `20px` | Base margin unit. Used by most components for default spacing. |
| `@global-small-margin` | `10px` | Small margin. Half of the base margin. |
| `@global-medium-margin` | `40px` | Medium margin. Double the base margin. |
| `@global-large-margin` | `70px` | Large margin. Used for prominent vertical spacing. |
| `@global-xlarge-margin` | `140px` | Extra-large margin. Double the large margin, for hero/section spacing. |

### Global Gutters

Gutters control horizontal spacing (and some vertical padding). They are referenced by card, container, tile, padding utility, button, modal, offcanvas, dropdown, dropbar, navbar, and position variables.

| Variable | Default | Description |
|----------|---------|-------------|
| `@global-small-gutter` | `15px` | Small gutter. Used by `.uk-padding-small`, button-small, position-small. |
| `@global-gutter` | `30px` | Base gutter. Used by card body/header/footer, container, `.uk-padding`, modal body, button, offcanvas, align floats. |
| `@global-medium-gutter` | `40px` | Medium gutter. Used by card body @1200px, container @960px, tile @960px, `.uk-padding` @1200px, button-large. |
| `@global-large-gutter` | `70px` | Large gutter. Used by `.uk-padding-large` @1200px, card-large body/header/footer @1200px. |

📖 [UIkit Margin docs](https://getuikit.com/docs/margin) · [UIkit Padding docs](https://getuikit.com/docs/padding)

---

## 2. Margin Utility

These variables control the `.uk-margin-*` utility classes that add spacing between block elements.

| Variable | Default | CSS Class | Description |
|----------|---------|-----------|-------------|
| `@margin-xsmall-margin` | `5px` | `.uk-margin-xsmall` | Very small margin (5px). Good for tight layouts. |
| `@margin-small-margin` | `@global-small-margin` | `.uk-margin-small` | Small margin (10px). |
| `@margin-margin` | `@global-margin` | `.uk-margin` | Default margin (20px). Standard block spacing. |
| `@margin-medium-margin` | `@global-medium-margin` | `.uk-margin-medium` | Medium margin (40px). |
| `@margin-large-margin` | `@global-medium-margin` | `.uk-margin-large` | Large margin on small screens (40px). |
| `@margin-large-margin-l` | `@global-large-margin` | `.uk-margin-large` | Large margin on ≥1200px screens (70px). |
| `@margin-xlarge-margin` | `@global-large-margin` | `.uk-margin-xlarge` | Extra-large margin on small screens (70px). |
| `@margin-xlarge-margin-l` | `@global-xlarge-margin` | `.uk-margin-xlarge` | Extra-large margin on ≥1200px screens (140px). |

📖 [UIkit Margin docs](https://getuikit.com/docs/margin)

---

## 3. Padding Utility

These variables control the `.uk-padding-*` utility classes that add internal spacing to elements.

| Variable | Default | CSS Class | Description |
|----------|---------|-----------|-------------|
| `@padding-small-padding` | `@global-small-gutter` | `.uk-padding-small` | Small padding. |
| `@padding-padding` | `@global-gutter` | `.uk-padding` | Default padding. |
| `@padding-padding-l` | `@global-medium-gutter` | `.uk-padding` | Default padding on ≥1200px screens. |
| `@padding-large-padding` | `@global-medium-gutter` | `.uk-padding-large` | Large padding. |
| `@padding-large-padding-l` | `@global-large-gutter` | `.uk-padding-large` | Large padding on ≥1200px screens. |

📖 [UIkit Padding docs](https://getuikit.com/docs/padding)

---

## 4. Position Utility

Margin applied to positioned elements (`.uk-position-small`, `.uk-position-medium`, `.uk-position-large`). Controls the inset gap between positioned content and its container edges.

| Variable | Default | Description |
|----------|---------|-------------|
| `@position-small-margin` | `@global-small-gutter` | Gap for `.uk-position-small`. |
| `@position-medium-margin` | `@global-gutter` | Gap for `.uk-position-medium`. |
| `@position-large-margin` | `@global-gutter` | Gap for `.uk-position-large`. |
| `@position-large-margin-l` | `50px` | Gap for `.uk-position-large` on ≥1200px screens. |

📖 [UIkit Position docs](https://getuikit.com/docs/position)

---

## 5. Section

Sections separate page content into full-width styled blocks. These variables control the **vertical padding** of each section size variant.

| Variable | Default | CSS Class | Description |
|----------|---------|-----------|-------------|
| `@section-xsmall-padding-vertical` | `@global-margin` (20px) | `.uk-section-xsmall` | Minimum vertical padding. |
| `@section-small-padding-vertical` | `@global-medium-margin` (40px) | `.uk-section-small` | Small vertical padding. |
| `@section-padding-vertical` | `@global-medium-margin` (40px) | `.uk-section` | Default section padding (small screens). |
| `@section-padding-vertical-m` | `@global-large-margin` (70px) | `.uk-section` | Default section padding on ≥960px. |
| `@section-large-padding-vertical` | `@global-large-margin` (70px) | `.uk-section-large` | Large padding (small screens). |
| `@section-large-padding-vertical-m` | `@global-xlarge-margin` (140px) | `.uk-section-large` | Large padding on ≥960px. |
| `@section-xlarge-padding-vertical` | `@global-xlarge-margin` (140px) | `.uk-section-xlarge` | Extra-large padding (small screens). |
| `@section-xlarge-padding-vertical-m` | `@global-large-margin + @global-xlarge-margin` (210px) | `.uk-section-xlarge` | Extra-large padding on ≥960px. |

📖 [UIkit Section docs](https://getuikit.com/docs/section)

---

## 6. Tile

Tiles are layout boxes with background colors. These variables control the default / responsive padding applied to `.uk-tile`.

| Variable | Default | Description |
|----------|---------|-------------|
| `@tile-padding-horizontal` | `15px` | Horizontal padding (base). |
| `@tile-padding-horizontal-s` | `@global-gutter` | Horizontal padding on ≥640px. |
| `@tile-padding-horizontal-m` | `@global-medium-gutter` | Horizontal padding on ≥960px. |
| `@tile-padding-vertical` | `@global-medium-margin` (40px) | Vertical padding (base). |
| `@tile-padding-vertical-m` | `@global-large-margin` (70px) | Vertical padding on ≥960px. |
| `@tile-xsmall-padding-vertical` | `@global-margin` (20px) | `.uk-tile` with xsmall sizing. |
| `@tile-small-padding-vertical` | `@global-medium-margin` (40px) | `.uk-tile` with small sizing. |
| `@tile-large-padding-vertical` | `@global-large-margin` (70px) | Large tile vertical padding. |
| `@tile-large-padding-vertical-m` | `@global-xlarge-margin` (140px) | Large tile on ≥960px. |
| `@tile-xlarge-padding-vertical` | `@global-xlarge-margin` (140px) | Extra-large tile vertical padding. |
| `@tile-xlarge-padding-vertical-m` | `@global-large-margin + @global-xlarge-margin` (210px) | Extra-large tile on ≥960px. |

📖 [UIkit Tile docs](https://getuikit.com/docs/tile)

---

## 7. Container

The container centers page content and adds responsive horizontal padding.

| Variable | Default | Description |
|----------|---------|-------------|
| `@container-padding-horizontal` | `15px` | Horizontal padding (base). |
| `@container-padding-horizontal-s` | `@global-gutter` | Horizontal padding on ≥640px. |
| `@container-padding-horizontal-m` | `@global-medium-gutter` | Horizontal padding on ≥960px. |

📖 [UIkit Container docs](https://getuikit.com/docs/container)

---

## 8. Card

Cards are styled boxes with body, header, footer, and size variants. Padding controls the inner spacing of each card section. The `-l` suffix denotes ≥1200px responsive overrides.

### Card Body

| Variable | Default | Size | Description |
|----------|---------|------|-------------|
| `@card-body-padding-horizontal` | `@global-gutter` | Default | Body left/right padding. |
| `@card-body-padding-horizontal-l` | `@global-medium-gutter` | Default @1200px | Body left/right on large screens. |
| `@card-body-padding-vertical` | `@global-gutter` | Default | Body top/bottom padding. |
| `@card-body-padding-vertical-l` | `@global-medium-gutter` | Default @1200px | Body top/bottom on large screens. |
| `@card-small-body-padding-horizontal` | `@global-margin` | `.uk-card-small` | Small card body left/right. |
| `@card-small-body-padding-vertical` | `@global-margin` | `.uk-card-small` | Small card body top/bottom. |
| `@card-large-body-padding-horizontal-l` | `@global-large-gutter` | `.uk-card-large` @1200px | Large card body left/right. |
| `@card-large-body-padding-vertical-l` | `@global-large-gutter` | `.uk-card-large` @1200px | Large card body top/bottom. |

### Card Header

| Variable | Default | Size | Description |
|----------|---------|------|-------------|
| `@card-header-padding-horizontal` | `@global-gutter` | Default | Header left/right. |
| `@card-header-padding-horizontal-l` | `@global-medium-gutter` | Default @1200px | Header left/right on large screens. |
| `@card-header-padding-vertical` | `round(@global-gutter / 2)` | Default | Header top/bottom. |
| `@card-header-padding-vertical-l` | `round(@global-medium-gutter / 2)` | Default @1200px | Header top/bottom on large screens. |
| `@card-small-header-padding-horizontal` | `@global-margin` | `.uk-card-small` | Small card header left/right. |
| `@card-small-header-padding-vertical` | `round(@global-margin / 1.5)` | `.uk-card-small` | Small card header top/bottom. |
| `@card-large-header-padding-horizontal-l` | `@global-large-gutter` | `.uk-card-large` @1200px | Large card header left/right. |
| `@card-large-header-padding-vertical-l` | `round(@global-large-gutter / 2)` | `.uk-card-large` @1200px | Large card header top/bottom. |

### Card Footer

| Variable | Default | Size | Description |
|----------|---------|------|-------------|
| `@card-footer-padding-horizontal` | `@global-gutter` | Default | Footer left/right. |
| `@card-footer-padding-horizontal-l` | `@global-medium-gutter` | Default @1200px | Footer left/right on large screens. |
| `@card-footer-padding-vertical` | `@global-gutter / 2` | Default | Footer top/bottom. |
| `@card-footer-padding-vertical-l` | `round(@global-medium-gutter / 2)` | Default @1200px | Footer top/bottom on large screens. |
| `@card-small-footer-padding-horizontal` | `@global-margin` | `.uk-card-small` | Small card footer left/right. |
| `@card-small-footer-padding-vertical` | `round(@global-margin / 1.5)` | `.uk-card-small` | Small card footer top/bottom. |
| `@card-large-footer-padding-horizontal-l` | `@global-large-gutter` | `.uk-card-large` @1200px | Large card footer left/right. |
| `@card-large-footer-padding-vertical-l` | `round(@global-large-gutter / 2)` | `.uk-card-large` @1200px | Large card footer top/bottom. |

### Card Badge

| Variable | Default | Description |
|----------|---------|-------------|
| `@card-badge-padding-horizontal` | `10px` | Badge horizontal padding inside cards. |

📖 [UIkit Card docs](https://getuikit.com/docs/card)

---

## 9. Navbar

The main site navigation bar. Variables control padding for the bar itself, nav items, content items, dropdowns within the navbar, and the dropbar.

### Navbar Bar

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-padding-top` | `0` | Top padding of the navbar bar. |
| `@navbar-padding-top-m` | `0` | Top padding on ≥960px. |
| `@navbar-padding-bottom` | `0` | Bottom padding. |
| `@navbar-padding-bottom-m` | `0` | Bottom padding on ≥960px. |
| `@navbar-container-padding` | `true` | Whether the navbar container gets padding (boolean flag). |

### Navbar Nav Items

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-nav-item-padding-horizontal` | `0` | Horizontal padding of nav links. |
| `@navbar-nav-item-padding-horizontal-m` | `@navbar-nav-item-padding-horizontal` | Horizontal padding on ≥960px. |
| `@navbar-item-padding-horizontal` | `0` | Padding for `.uk-navbar-item` content containers. |
| `@navbar-item-padding-horizontal-m` | `@navbar-item-padding-horizontal` | Content item padding on ≥960px. |
| `@navbar-parent-icon-margin-left` | `4px` | Left margin for the parent dropdown arrow icon. |
| `@navbar-nav-item-line-margin-horizontal` | `0` | Horizontal margin for the active item underline. |
| `@navbar-nav-item-line-margin-horizontal-m` | `@navbar-nav-item-line-margin-horizontal` | Underline margin on ≥960px. |
| `@navbar-nav-item-line-margin-vertical` | `0` | Vertical margin for the active item underline. |

### Navbar Primary Variant

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-primary-item-padding-horizontal` | `@navbar-item-padding-horizontal` | Primary navbar content item padding. |
| `@navbar-primary-item-padding-horizontal-m` | `@navbar-item-padding-horizontal-m` | Primary content item padding on ≥960px. |
| `@navbar-primary-nav-item-padding-horizontal` | `@navbar-nav-item-padding-horizontal` | Primary nav link padding. |
| `@navbar-primary-nav-item-padding-horizontal-m` | `@navbar-nav-item-padding-horizontal-m` | Primary nav link padding on ≥960px. |

### Navbar Dropdown

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-padding` | `25px` | Internal padding of the dropdown panel. |
| `@navbar-dropdown-large-padding` | `40px` | Larger dropdown padding variant. |
| `@navbar-dropdown-margin` | `15px` | Gap between navbar and dropdown. |
| `@navbar-dropdown-viewport-margin` | `15px` | Min distance from viewport edge. |
| `@navbar-dropdown-shift-margin` | `0` | Horizontal shift margin. |
| `@navbar-dropdown-shift-margin-m` | `@navbar-dropdown-shift-margin` | Shift margin on ≥960px. |
| `@navbar-dropdown-large-shift-margin` | `0` | Large dropdown shift margin. |
| `@navbar-dropdown-large-shift-margin-m` | `@navbar-dropdown-large-shift-margin` | Large shift on ≥960px. |

### Navbar Dropdown Nav

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-nav-item-padding-horizontal` | `@nav-item-padding-horizontal` | Nav item left/right padding inside dropdown. |
| `@navbar-dropdown-nav-item-padding-vertical` | `@nav-item-padding-vertical` | Nav item top/bottom padding inside dropdown. |
| `@navbar-dropdown-nav-margin-horizontal` | `0` | Horizontal margin for nav inside dropdown. |
| `@navbar-dropdown-nav-divider-margin-vertical` | `@nav-divider-margin-vertical` | Divider vertical margin inside dropdown nav. |
| `@navbar-dropdown-nav-sublist-padding-left` | `@navbar-dropdown-nav-item-padding-horizontal + @nav-sublist-deeper-padding-left` | Sublist left indentation. |

### Navbar Dropdown Dropbar

| Variable | Default | Description |
|----------|---------|-------------|
| `@navbar-dropdown-dropbar-padding-top` | `@navbar-dropdown-padding` | Top padding when dropdown is inside dropbar. |
| `@navbar-dropdown-dropbar-padding-bottom` | `@navbar-dropdown-dropbar-padding-top` | Bottom padding in dropbar. |
| `@navbar-dropdown-dropbar-large-padding-top` | `@navbar-dropdown-large-padding` | Large variant top padding. |
| `@navbar-dropdown-dropbar-large-padding-bottom` | `@navbar-dropdown-dropbar-large-padding-top` | Large variant bottom padding. |
| `@navbar-dropdown-dropbar-margin` | `0` | Margin between navbar and dropbar. |
| `@navbar-dropdown-dropbar-shift-margin` | `0` | Shift margin in dropbar mode. |
| `@navbar-dropdown-dropbar-shift-margin-m` | `@navbar-dropdown-dropbar-shift-margin` | Shift on ≥960px. |
| `@navbar-dropdown-dropbar-large-shift-margin` | `0` | Large shift in dropbar. |
| `@navbar-dropdown-dropbar-large-shift-margin-m` | `@navbar-dropdown-dropbar-large-shift-margin` | Large shift on ≥960px. |
| `@navbar-dropdown-dropbar-viewport-margin` | `15px` | Min distance from viewport in dropbar. |
| `@navbar-dropdown-dropbar-viewport-margin-s` | `@global-gutter` | Viewport margin on ≥640px. |
| `@navbar-dropdown-dropbar-viewport-margin-m` | `@global-medium-gutter` | Viewport margin on ≥960px. |

📖 [UIkit Navbar docs](https://getuikit.com/docs/navbar)

---

## 10. Nav

Side/stacked navigation component used inside offcanvas, dropdowns, and standalone.

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-item-padding-horizontal` | `0` | Nav item left/right padding. |
| `@nav-item-padding-vertical` | `5px` | Nav item top/bottom padding. |
| `@nav-header-padding-horizontal` | `@nav-item-padding-horizontal` | Header item left/right. |
| `@nav-header-padding-vertical` | `@nav-item-padding-vertical` | Header item top/bottom. |
| `@nav-header-margin-top` | `@global-margin` | Top margin before a nav header. |
| `@nav-divider-margin-horizontal` | `0` | Horizontal margin of `.uk-nav-divider`. |
| `@nav-divider-margin-vertical` | `5px` | Vertical margin of `.uk-nav-divider`. |
| `@nav-dividers-margin-top` | `5px` | Top margin in divider style nav. |
| `@nav-sublist-padding-left` | `15px` | Left indentation of sublists. |
| `@nav-sublist-padding-vertical` | `5px` | Vertical padding before/after sublists. |
| `@nav-sublist-item-padding-vertical` | `2px` | Vertical padding of sublist items. |
| `@nav-sublist-deeper-padding-left` | `15px` | Additional indentation for deeper nesting. |
| `@nav-parent-icon-margin-left` | `0.25em` | Left margin of parent arrow icon. |
| `@nav-secondary-margin-top` | `0` | Top margin of secondary nav subtitle text. |

### Nav Primary Variant

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-primary-item-padding-horizontal` | `@nav-item-padding-horizontal` | Primary nav item left/right. |
| `@nav-primary-item-padding-vertical` | `@nav-item-padding-vertical` | Primary nav item top/bottom. |
| `@nav-primary-header-padding-horizontal` | `@nav-header-padding-horizontal` | Primary nav header left/right. |
| `@nav-primary-header-padding-vertical` | `@nav-header-padding-vertical` | Primary nav header top/bottom. |

### Nav Secondary Variant

| Variable | Default | Description |
|----------|---------|-------------|
| `@nav-secondary-item-padding-horizontal` | `@nav-item-padding-horizontal` | Secondary nav item left/right. |
| `@nav-secondary-item-padding-vertical` | `@nav-item-padding-vertical` | Secondary nav item top/bottom. |

### Internal Nav Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `@internal-nav-default-bullet-margin` | `5px` | Bullet marker margin in default nav. |
| `@internal-nav-primary-bullet-margin` | `5px` | Bullet marker margin in primary nav. |

📖 [UIkit Nav docs](https://getuikit.com/docs/nav)

---

## 11. Dropdown

Standalone dropdown panels triggered by toggles.

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropdown-padding` | `25px` | Internal padding of the dropdown. |
| `@dropdown-large-padding` | `40px` | Large dropdown padding. |
| `@dropdown-margin` | `@global-small-margin` | Gap from toggle to dropdown. |
| `@dropdown-viewport-margin` | `15px` | Min distance from viewport edge. |
| `@dropdown-nav-item-padding-horizontal` | `@nav-item-padding-horizontal` | Nav item left/right inside dropdown. |
| `@dropdown-nav-item-padding-vertical` | `@nav-item-padding-vertical` | Nav item top/bottom inside dropdown. |
| `@dropdown-nav-margin-horizontal` | `0` | Nav horizontal margin inside dropdown. |
| `@dropdown-nav-divider-margin-horizontal` | `0` | Divider horizontal margin inside dropdown. |
| `@dropdown-nav-sublist-padding-left` | `@dropdown-nav-item-padding-horizontal + @nav-sublist-deeper-padding-left` | Sublist indentation. |

### Dropdown Dropbar Mode

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropdown-dropbar-padding-top` | `5px` | Top padding in dropbar mode. |
| `@dropdown-dropbar-padding-bottom` | `@dropdown-padding` | Bottom padding in dropbar mode. |
| `@dropdown-dropbar-large-padding-top` | `@dropdown-large-padding` | Large top padding in dropbar. |
| `@dropdown-dropbar-large-padding-bottom` | `@dropdown-large-padding` | Large bottom padding in dropbar. |
| `@dropdown-dropbar-margin` | `@dropdown-margin` | Margin in dropbar mode. |
| `@dropdown-dropbar-viewport-margin` | `15px` | Viewport margin in dropbar. |
| `@dropdown-dropbar-viewport-margin-s` | `@global-gutter` | Viewport margin on ≥640px. |
| `@dropdown-dropbar-viewport-margin-m` | `@global-medium-gutter` | Viewport margin on ≥960px. |

📖 [UIkit Dropdown docs](https://getuikit.com/docs/dropdown)

---

## 12. Drop

The lower-level positioning utility used by dropdowns and tooltips.

| Variable | Default | Description |
|----------|---------|-------------|
| `@drop-margin` | `@global-margin` | Distance between toggle and drop. |
| `@drop-viewport-margin` | `15px` | Min distance from viewport edge. |
| `@drop-parent-icon-margin-left` | `0.25em` | Left margin for parent icon. |

📖 [UIkit Drop docs](https://getuikit.com/docs/drop)

---

## 13. Dropbar

Full-width bar that appears below the navbar.

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropbar-padding-top` | `25px` | Top padding. |
| `@dropbar-padding-bottom` | `@dropbar-padding-top` | Bottom padding. |
| `@dropbar-padding-horizontal` | `15px` | Horizontal padding (base). |
| `@dropbar-padding-horizontal-s` | `@global-gutter` | Horizontal padding on ≥640px. |
| `@dropbar-padding-horizontal-m` | `@global-medium-gutter` | Horizontal padding on ≥960px. |
| `@dropbar-large-padding-top` | `40px` | Large variant top padding. |
| `@dropbar-large-padding-bottom` | `@dropbar-large-padding-top` | Large variant bottom padding. |
| `@dropbar-margin` | `0` | Margin between navbar and dropbar. |

📖 [UIkit Dropbar docs](https://getuikit.com/docs/dropbar)

---

## 14. Modal

Dialog overlays for user interactions.

### Modal Dialog Wrapper

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-padding-horizontal` | `15px` | Horizontal padding around dialog (base). |
| `@modal-padding-horizontal-s` | `@global-gutter` | Dialog horizontal padding on ≥640px. |
| `@modal-padding-horizontal-m` | `@global-medium-gutter` | Dialog horizontal padding on ≥960px. |
| `@modal-padding-vertical` | `@modal-padding-horizontal` | Vertical padding around dialog (base). |
| `@modal-padding-vertical-s` | `50px` | Dialog vertical padding on ≥640px. |

### Modal Body

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-body-padding-horizontal` | `20px` | Body section left/right padding. |
| `@modal-body-padding-horizontal-s` | `@global-gutter` | Body left/right on ≥640px. |
| `@modal-body-padding-vertical` | `20px` | Body section top/bottom padding. |
| `@modal-body-padding-vertical-s` | `@global-gutter` | Body top/bottom on ≥640px. |

### Modal Header

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-header-padding-horizontal` | `20px` | Header left/right. |
| `@modal-header-padding-horizontal-s` | `@global-gutter` | Header left/right on ≥640px. |
| `@modal-header-padding-vertical` | `@modal-header-padding-horizontal / 2` | Header top/bottom. |
| `@modal-header-padding-vertical-s` | `@modal-header-padding-horizontal-s / 2` | Header top/bottom on ≥640px. |

### Modal Footer

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-footer-padding-horizontal` | `20px` | Footer left/right. |
| `@modal-footer-padding-horizontal-s` | `@global-gutter` | Footer left/right on ≥640px. |
| `@modal-footer-padding-vertical` | `@modal-footer-padding-horizontal / 2` | Footer top/bottom. |
| `@modal-footer-padding-vertical-s` | `@modal-footer-padding-horizontal-s / 2` | Footer top/bottom on ≥640px. |

### Modal Close Button

| Variable | Default | Description |
|----------|---------|-------------|
| `@modal-close-padding` | `5px` | Padding of the close button. |
| `@modal-close-position` | `@global-small-margin` | Offset position of the close button from corner. |
| `@modal-close-full-padding` | `10px` | Full-screen modal close button padding. |
| `@modal-close-full-padding-m` | `@global-margin` | Full-screen close padding on ≥960px. |

📖 [UIkit Modal docs](https://getuikit.com/docs/modal)

---

## 15. Offcanvas

Slide-in sidebar panel, typically for mobile navigation.

| Variable | Default | Description |
|----------|---------|-------------|
| `@offcanvas-bar-padding-horizontal` | `20px` | Bar left/right padding (base). |
| `@offcanvas-bar-padding-horizontal-s` | `@global-gutter` | Bar left/right on ≥640px. |
| `@offcanvas-bar-padding-vertical` | `20px` | Bar top/bottom padding (base). |
| `@offcanvas-bar-padding-vertical-s` | `@global-gutter` | Bar top/bottom on ≥640px. |
| `@offcanvas-close-padding` | `5px` | Close button padding. |

📖 [UIkit Offcanvas docs](https://getuikit.com/docs/offcanvas)

---

## 16. Alert

Alert messages for success, warning, error states.

| Variable | Default | Description |
|----------|---------|-------------|
| `@alert-padding` | `15px` | Internal padding of the alert box. |
| `@alert-padding-right` | `@alert-padding + 14px` | Right padding (extra space for close button). |
| `@alert-margin-vertical` | `@global-margin` | Vertical margin between alerts and surrounding content. |
| `@alert-close-top` | `@alert-padding + 5px` | Close button offset from top. |
| `@alert-close-right` | `@alert-padding` | Close button offset from right. |

📖 [UIkit Alert docs](https://getuikit.com/docs/alert)

---

## 17. Accordion

Collapsible content panels.

| Variable | Default | Description |
|----------|---------|-------------|
| `@accordion-default-item-margin-top` | `@global-margin` | Spacing between accordion items. |
| `@accordion-default-title-padding-horizontal` | `0` | Title left/right padding. |
| `@accordion-default-title-padding-vertical` | `0` | Title top/bottom padding. |
| `@accordion-default-content-margin-top` | `@global-margin` | Space between title and content. |
| `@accordion-default-content-padding-horizontal` | `0` | Content left/right padding. |
| `@accordion-default-content-padding-bottom` | `@accordion-default-content-padding-horizontal` | Content bottom padding. |

📖 [UIkit Accordion docs](https://getuikit.com/docs/accordion)

---

## 18. Article

Blog post / article content styling.

| Variable | Default | Description |
|----------|---------|-------------|
| `@article-margin-top` | `@global-large-margin` (70px) | Space between consecutive articles. |
| `@article-margin-top-m` | `@article-margin-top` | Article spacing on ≥960px. |

📖 [UIkit Article docs](https://getuikit.com/docs/article)

---

## 19. Badge

Small notification badges (counts, labels).

| Variable | Default | Description |
|----------|---------|-------------|
| `@badge-padding-horizontal` | `5px` | Horizontal padding inside badge. |
| `@badge-padding-vertical` | `0` | Vertical padding inside badge. |

📖 [UIkit Badge docs](https://getuikit.com/docs/badge)

---

## 20. Base (Typography)

Default styling for typographic elements (headings, blockquotes, lists, code, etc.).

| Variable | Default | Description |
|----------|---------|-------------|
| `@base-margin-vertical` | `@global-margin` | Default margin between block elements (paragraphs, etc.). |
| `@base-heading-margin-top` | `@global-medium-margin` | Top margin before headings (h1–h6). |
| `@base-hr-margin-vertical` | `@global-margin` | `<hr>` vertical margin. |
| `@base-blockquote-margin-vertical` | `@global-margin` | Blockquote vertical margin. |
| `@base-blockquote-padding-left` | `0` | Blockquote left padding (indent). |
| `@base-blockquote-padding-right` | `0` | Blockquote right padding. |
| `@base-blockquote-padding-vertical` | `0` | Blockquote top/bottom padding. |
| `@base-blockquote-footer-margin-top` | `@global-small-margin` | Margin above `<footer>` inside blockquote. |
| `@base-list-padding-left` | `30px` | Left indentation of `<ul>` / `<ol>` lists. |
| `@base-code-padding-horizontal` | `0` | Inline `<code>` horizontal padding. |
| `@base-code-padding-vertical` | `0` | Inline `<code>` vertical padding. |
| `@base-pre-padding` | `0` | `<pre>` block padding. |

📖 [UIkit Base docs](https://getuikit.com/docs/base)

---

## 21. Breadcrumb

| Variable | Default | Description |
|----------|---------|-------------|
| `@breadcrumb-divider-margin-horizontal` | `20px` | Horizontal space around the `/` divider. |

📖 [UIkit Breadcrumb docs](https://getuikit.com/docs/breadcrumb)

---

## 22. Button

| Variable | Default | Description |
|----------|---------|-------------|
| `@button-padding-horizontal` | `@global-gutter` | Default button left/right padding. |
| `@button-small-padding-horizontal` | `@global-small-gutter` | Small button left/right padding. |
| `@button-large-padding-horizontal` | `@global-medium-gutter` | Large button left/right padding. |

### Internal Button Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `@internal-button-text-arrow-padding` | `5px` | Padding for text-style button arrow. |
| `@internal-button-text-dash-padding` | `8px` | Padding for text-style button dash. |

📖 [UIkit Button docs](https://getuikit.com/docs/button)

---

## 23. Comment

User comment / thread styling.

| Variable | Default | Description |
|----------|---------|-------------|
| `@comment-header-margin-bottom` | `@global-margin` | Margin below comment header. |
| `@comment-list-margin-top` | `@global-large-margin` | Top margin of the comment list. |
| `@comment-list-padding-left` | `30px` | Left indentation for nested replies. |
| `@comment-list-padding-left-m` | `100px` | Nested reply indentation on ≥960px. |
| `@comment-primary-padding` | `@global-gutter` | Padding of primary (highlighted) comments. |

📖 [UIkit Comment docs](https://getuikit.com/docs/comment)

---

## 24. Description List

`<dl>` definition lists.

| Variable | Default | Description |
|----------|---------|-------------|
| `@description-list-term-margin-top` | `@global-margin` | Space between terms. |
| `@description-list-divider-term-margin-top` | `@global-margin` | Space between terms in divider style. |

📖 [UIkit Description List docs](https://getuikit.com/docs/description-list)

---

## 25. Divider

Horizontal rules / separators.

| Variable | Default | Description |
|----------|---------|-------------|
| `@divider-margin-vertical` | `@global-margin` | Vertical margin around dividers. |

📖 [UIkit Divider docs](https://getuikit.com/docs/divider)

---

## 26. Dotnav

Dot navigation (e.g., slideshow dots).

| Variable | Default | Description |
|----------|---------|-------------|
| `@dotnav-margin-horizontal` | `12px` | Horizontal space between dots. |
| `@dotnav-margin-vertical` | `@dotnav-margin-horizontal` | Vertical space between dots (when stacked). |

📖 [UIkit Dotnav docs](https://getuikit.com/docs/dotnav)

---

## 27. Form

Form elements: inputs, selects, radio/checkbox, stacked/horizontal layouts.

### Input Padding

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-padding-horizontal` | `10px` | Default input left/right padding. |
| `@form-small-padding-horizontal` | `8px` | Small input left/right. |
| `@form-large-padding-horizontal` | `12px` | Large input left/right. |

### Multi-line (Textarea)

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-multi-line-padding-horizontal` | `@form-padding-horizontal` | Textarea left/right. |
| `@form-multi-line-padding-vertical` | `round(@form-multi-line-padding-horizontal * 0.6)` | Textarea top/bottom. |
| `@form-small-multi-line-padding-horizontal` | `@form-small-padding-horizontal` | Small textarea left/right. |
| `@form-small-multi-line-padding-vertical` | `round(... * 0.6)` | Small textarea top/bottom. |
| `@form-large-multi-line-padding-horizontal` | `@form-large-padding-horizontal` | Large textarea left/right. |
| `@form-large-multi-line-padding-vertical` | `round(... * 0.6)` | Large textarea top/bottom. |

### Form Layout

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-horizontal-controls-margin-left` | `215px` | Left margin of controls in horizontal layout. |
| `@form-horizontal-label-margin-top` | `7px` | Top margin of labels in horizontal layout. |
| `@form-horizontal-controls-text-padding-top` | `7px` | Top padding for text controls in horizontal layout. |
| `@form-stacked-margin-bottom` | `5px` | Bottom margin of labels in stacked layout. |

### Form Misc

| Variable | Default | Description |
|----------|---------|-------------|
| `@form-radio-margin-top` | `-4px` | Vertical alignment offset for radio/checkbox. |
| `@form-select-padding-right` | `20px` | Right padding for selects (arrow space). |
| `@form-datalist-padding-right` | `20px` | Right padding for datalist inputs. |

📖 [UIkit Form docs](https://getuikit.com/docs/form)

---

## 28. Heading

Special heading styles (divider, bullet, line).

| Variable | Default | Description |
|----------|---------|-------------|
| `@heading-bullet-margin-right` | `~'calc(5px + 0.2em)'` | Right margin of bullet marker in `.uk-heading-bullet`. |
| `@heading-divider-padding-bottom` | `~'calc(5px + 0.1em)'` | Bottom padding of `.uk-heading-divider` underline. |
| `@heading-line-margin-horizontal` | `~'calc(5px + 0.3em)'` | Horizontal margin of lines in `.uk-heading-line`. |

📖 [UIkit Heading docs](https://getuikit.com/docs/heading)

---

## 29. Iconnav

Icon-based navigation (icon buttons in a row/column).

| Variable | Default | Description |
|----------|---------|-------------|
| `@iconnav-margin-horizontal` | `@global-small-margin` | Horizontal space between icons. |
| `@iconnav-margin-vertical` | `@iconnav-margin-horizontal` | Vertical space between icons (when stacked). |

📖 [UIkit Iconnav docs](https://getuikit.com/docs/iconnav)

---

## 30. Label

Small inline labels / tags.

| Variable | Default | Description |
|----------|---------|-------------|
| `@label-padding-horizontal` | `@global-small-margin` | Horizontal padding inside label. |
| `@label-padding-vertical` | `0` | Vertical padding inside label. |

📖 [UIkit Label docs](https://getuikit.com/docs/label)

---

## 31. Leader

Dot leaders (the dots between a title and a page number, like in a table of contents).

| Variable | Default | Description |
|----------|---------|-------------|
| `@leader-fill-margin-left` | `@global-small-gutter` | Left margin of the leader fill dots. |

📖 [UIkit Leader docs](https://getuikit.com/docs/leader)

---

## 32. Lightbox

Image/video lightbox overlay.

| Variable | Default | Description |
|----------|---------|-------------|
| `@lightbox-caption-padding-horizontal` | `10px` | Caption left/right padding. |
| `@lightbox-caption-padding-vertical` | `10px` | Caption top/bottom padding. |

📖 [UIkit Lightbox docs](https://getuikit.com/docs/lightbox)

---

## 33. List

Styled lists (divider, striped, etc.).

| Variable | Default | Description |
|----------|---------|-------------|
| `@list-margin-top` | `@global-small-margin` | Space between list items. |
| `@list-padding-left` | `30px` | Left indentation of nested lists. |
| `@list-divider-margin-top` | `@global-small-margin` | Space between items in divider style. |
| `@list-striped-padding-horizontal` | `@global-small-margin` | Horizontal padding of striped rows. |
| `@list-striped-padding-vertical` | `@global-small-margin` | Vertical padding of striped rows. |

### Large List

| Variable | Default | Description |
|----------|---------|-------------|
| `@list-large-margin-top` | `@global-margin` | Space between items in large list. |
| `@list-large-divider-margin-top` | `@global-margin` | Divider spacing in large list. |
| `@list-large-striped-padding-horizontal` | `@global-small-margin` | Striped row horizontal padding. |
| `@list-large-striped-padding-vertical` | `@global-margin` | Striped row vertical padding. |

📖 [UIkit List docs](https://getuikit.com/docs/list)

---

## 34. Marker

Small icon markers (e.g., for image hotspots).

| Variable | Default | Description |
|----------|---------|-------------|
| `@marker-padding` | `5px` | Padding around the marker icon. |

📖 [UIkit Marker docs](https://getuikit.com/docs/marker)

---

## 35. Notification

Toast-style notification messages.

| Variable | Default | Description |
|----------|---------|-------------|
| `@notification-message-padding` | `@global-gutter` | Internal padding of notification messages. |
| `@notification-message-margin-top` | `10px` | Space between stacked notifications. |
| `@notification-close-top` | `@notification-message-padding / 2` | Close button offset from top. |
| `@notification-close-right` | `@notification-message-padding / 2` | Close button offset from right. |

📖 [UIkit Notification docs](https://getuikit.com/docs/notification)

---

## 36. Overlay

Content overlay on images/cards.

| Variable | Default | Description |
|----------|---------|-------------|
| `@overlay-padding-horizontal` | `@global-gutter` | Overlay left/right padding. |
| `@overlay-padding-vertical` | `@global-gutter` | Overlay top/bottom padding. |

📖 [UIkit Overlay docs](https://getuikit.com/docs/overlay)

---

## 37. Pagination

Page number navigation.

| Variable | Default | Description |
|----------|---------|-------------|
| `@pagination-item-padding-horizontal` | `10px` | Page number left/right padding. |
| `@pagination-item-padding-vertical` | `5px` | Page number top/bottom padding. |
| `@pagination-margin-horizontal` | `0` | Horizontal space between page items. |

📖 [UIkit Pagination docs](https://getuikit.com/docs/pagination)

---

## 38. Panel

Scrollable panel container.

| Variable | Default | Description |
|----------|---------|-------------|
| `@panel-scrollable-padding` | `10px` | Padding inside scrollable panel. |

📖 [UIkit Utility docs (panel-scrollable)](https://getuikit.com/docs/utility)

---

## 39. Placeholder

Empty content placeholder box.

| Variable | Default | Description |
|----------|---------|-------------|
| `@placeholder-padding-horizontal` | `@global-gutter` | Horizontal padding. |
| `@placeholder-padding-vertical` | `@global-gutter` | Vertical padding. |
| `@placeholder-margin-vertical` | `@global-margin` | Vertical margin around placeholder. |

📖 [UIkit Placeholder docs](https://getuikit.com/docs/placeholder)

---

## 40. Progress

Progress bar.

| Variable | Default | Description |
|----------|---------|-------------|
| `@progress-margin-vertical` | `@global-margin` | Vertical margin around progress bars. |

📖 [UIkit Progress docs](https://getuikit.com/docs/progress)

---

## 41. Search

Search input fields with different styles.

| Variable | Default | Description |
|----------|---------|-------------|
| `@search-default-padding-horizontal` | `10px` | Default search input left/right. |
| `@search-default-icon-padding` | `10px` | Offset for icon in default search. |
| `@search-medium-padding-horizontal` | `12px` | Medium search input left/right. |
| `@search-medium-icon-padding` | `12px` | Offset for icon in medium search. |
| `@search-large-padding-horizontal` | `20px` | Large search input left/right. |
| `@search-large-icon-padding` | `20px` | Offset for icon in large search. |
| `@search-navbar-padding-horizontal` | `10px` | Navbar search input left/right. |
| `@search-navbar-icon-padding` | `10px` | Offset for icon in navbar search. |

📖 [UIkit Search docs](https://getuikit.com/docs/search)

---

## 42. Slider

Content slider/carousel container margins.

| Variable | Default | Description |
|----------|---------|-------------|
| `@slider-container-margin-top` | `-11px` | Negative top margin to compensate for container overflow. |
| `@slider-container-margin-bottom` | `-39px` | Negative bottom margin. |
| `@slider-container-margin-left` | `-25px` | Negative left margin. |
| `@slider-container-margin-right` | `-25px` | Negative right margin. |

> These negative margins are used to create visual bleed for the slider container so navigation elements outside the content area remain accessible.

📖 [UIkit Slider docs](https://getuikit.com/docs/slider)

---

## 43. Slidenav

Previous/Next navigation arrows for sliders/slideshows.

| Variable | Default | Description |
|----------|---------|-------------|
| `@slidenav-padding-horizontal` | `10px` | Arrow button left/right padding. |
| `@slidenav-padding-vertical` | `5px` | Arrow button top/bottom padding. |
| `@slidenav-large-padding-horizontal` | `@slidenav-large-padding-vertical` | Large arrow left/right padding. |
| `@slidenav-large-padding-vertical` | `10px` | Large arrow top/bottom padding. |
| `@slidenav-margin` | `0` | Margin around slidenav buttons. |

📖 [UIkit Slidenav docs](https://getuikit.com/docs/slidenav)

---

## 44. Subnav

Secondary horizontal navigation (filters, tabs alternative).

| Variable | Default | Description |
|----------|---------|-------------|
| `@subnav-margin-horizontal` | `20px` | Horizontal space between subnav items. |
| `@subnav-divider-margin-horizontal` | `@subnav-margin-horizontal` | Space around divider in subnav. |
| `@subnav-pill-item-padding-horizontal` | `10px` | Pill-style item left/right padding. |
| `@subnav-pill-item-padding-vertical` | `5px` | Pill-style item top/bottom padding. |
| `@subnav-pill-margin-horizontal` | `@subnav-margin-horizontal` | Space between pill items. |

📖 [UIkit Subnav docs](https://getuikit.com/docs/subnav)

---

## 45. Tab

Tabbed navigation.

| Variable | Default | Description |
|----------|---------|-------------|
| `@tab-item-padding-horizontal` | `10px` | Tab item left/right padding. |
| `@tab-item-padding-vertical` | `5px` | Tab item top/bottom padding. |
| `@tab-margin-horizontal` | `20px` | Horizontal space between tab items. |
| `@tab-vertical-item-padding-horizontal` | `@tab-item-padding-horizontal` | Vertical tab item left/right. |
| `@tab-vertical-item-padding-vertical` | `@tab-item-padding-vertical` | Vertical tab item top/bottom. |
| `@tab-vertical-item-margin-vertical` | `0` | Vertical spacing between vertical tab items. |

📖 [UIkit Tab docs](https://getuikit.com/docs/tab)

---

## 46. Table

Data tables.

| Variable | Default | Description |
|----------|---------|-------------|
| `@table-cell-padding-horizontal` | `12px` | Cell left/right padding. |
| `@table-cell-padding-vertical` | `16px` | Cell top/bottom padding. |
| `@table-small-cell-padding-horizontal` | `12px` | Small table cell left/right. |
| `@table-small-cell-padding-vertical` | `10px` | Small table cell top/bottom. |
| `@table-large-cell-padding-horizontal` | `12px` | Large table cell left/right. |
| `@table-large-cell-padding-vertical` | `22px` | Large table cell top/bottom. |
| `@table-margin-vertical` | `@global-margin` | Vertical margin around tables. |

📖 [UIkit Table docs](https://getuikit.com/docs/table)

---

## 47. Text

Text utility styles.

| Variable | Default | Description |
|----------|---------|-------------|
| `@text-background-padding-right` | `0` | Right padding for `.uk-text-background` gradient clip. |

📖 [UIkit Text docs](https://getuikit.com/docs/text)

---

## 48. Thumbnav

Thumbnail-based navigation (e.g., slideshow thumbnails).

| Variable | Default | Description |
|----------|---------|-------------|
| `@thumbnav-margin-horizontal` | `15px` | Horizontal space between thumbnails. |
| `@thumbnav-margin-vertical` | `@thumbnav-margin-horizontal` | Vertical space between thumbnails. |

📖 [UIkit Thumbnav docs](https://getuikit.com/docs/thumbnav)

---

## 49. Tooltip

Hover tooltips.

| Variable | Default | Description |
|----------|---------|-------------|
| `@tooltip-padding-horizontal` | `6px` | Tooltip left/right padding. |
| `@tooltip-padding-vertical` | `3px` | Tooltip top/bottom padding. |
| `@tooltip-margin` | `10px` | Distance from toggle element. |

📖 [UIkit Tooltip docs](https://getuikit.com/docs/tooltip)

---

## 50. Totop

Scroll-to-top button.

| Variable | Default | Description |
|----------|---------|-------------|
| `@totop-padding` | `5px` | Padding around the totop icon. |

📖 [UIkit Totop docs](https://getuikit.com/docs/totop)

---

## Responsive Suffix Reference

Many variables include a breakpoint suffix that controls when the value changes:

| Suffix | Breakpoint | Min Width |
|--------|------------|-----------|
| `-s` | Small | `640px` |
| `-m` | Medium | `960px` |
| `-l` | Large | `1200px` |
| `-xl` | Extra Large | `1600px` |

For example, `@card-body-padding-horizontal-l` overrides `@card-body-padding-horizontal` on screens ≥1200px.

---

## How Variables Cascade

```
@global-margin (20px)
├── @margin-margin
├── @base-margin-vertical
├── @alert-margin-vertical
├── @divider-margin-vertical
├── @table-margin-vertical
├── @progress-margin-vertical
├── ...
│
@global-small-margin (10px)
├── @margin-small-margin
├── @list-margin-top
├── @dropdown-margin
├── ...
│
@global-medium-margin (40px)
├── @margin-medium-margin
├── @section-padding-vertical
├── @tile-padding-vertical
├── ...
│
@global-large-margin (70px)
├── @section-large-padding-vertical
├── @article-margin-top
├── @comment-list-margin-top
├── ...
│
@global-xlarge-margin (140px)
├── @section-xlarge-padding-vertical
├── @margin-xlarge-margin-l
├── ...
```

> **Tip:** Changing `@global-margin` will cascade to dozens of components. To customize a single component's spacing, override that component's specific variable instead.

---

## Align Utility (Bonus)

Float alignment utilities also have margin variables:

| Variable | Default | Description |
|----------|---------|-------------|
| `@align-margin-horizontal` | `@global-gutter` | Horizontal margin around floated elements. |
| `@align-margin-horizontal-l` | `@global-medium-gutter` | Horizontal margin on ≥1200px. |
| `@align-margin-vertical` | `@global-gutter` | Vertical margin around floated elements. |

📖 [UIkit Align docs](https://getuikit.com/docs/utility#align)

---

## Dropcap (Bonus)

| Variable | Default | Description |
|----------|---------|-------------|
| `@dropcap-margin-right` | `10px` | Right margin of the drop capital letter. |

📖 [UIkit Dropcap docs](https://getuikit.com/docs/utility#dropcap)

---

*Generated from `docs/uikit-less-consolidated/_all-variables.less` with reference to [UIkit](https://getuikit.com/docs/) and [YOOtheme Pro](https://yootheme.com/support/yootheme-pro/wordpress/introduction) documentation.*
