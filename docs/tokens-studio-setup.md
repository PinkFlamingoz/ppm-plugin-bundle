# Tokens Studio Integration Guide

This guide explains how to integrate **Tokens Studio for Figma** with the Enhanced Plugin Bundle for seamless design token synchronization between Figma and your WordPress/YOOtheme child theme.

---

## Table of Contents

1. [Overview](#overview)
2. [Quick Start](#quick-start)
3. [Installing Tokens Studio](#installing-tokens-studio)
4. [Exporting from WordPress](#exporting-from-wordpress)
5. [Importing to WordPress](#importing-to-wordpress)
6. [Token Format Reference](#token-format-reference)
7. [Variable Mapping](#variable-mapping)
8. [Best Practices](#best-practices)

---

## Overview

The Enhanced Plugin Bundle provides bidirectional token synchronization with Tokens Studio for Figma:

```
┌─────────────────┐                    ┌─────────────────┐
│  Tokens Studio  │◀──── Export ─────▶│    WordPress    │
│    (Figma)      │                    │  Plugin Bundle  │
└─────────────────┘                    └─────────────────┘
        │                                      │
        ▼                                      ▼
   Design Tokens                        UIkit Variables
   (JSON Format)                        (68 Components)
```

### What You Can Do

| Direction | Action |
|-----------|--------|
| **WordPress → Figma** | Export all UIkit variables as Tokens Studio JSON |
| **Figma → WordPress** | Import Tokens Studio JSON to update UIkit variables |

### Supported Token Types

- **Colors** – All color values (backgrounds, text, borders)
- **Dimensions** – Sizes, spacing, padding, margins
- **Typography** – Font sizes, weights, line heights
- **Numbers** – Border radius, z-index, opacity

---

## Quick Start

### Export Current Theme to Figma

1. Open **Plugin Bundle** in WordPress admin
2. Click the **Export for Figma** button (↑ arrow icon)
3. A `tokens-studio-export.json` file downloads
4. In Figma, open **Tokens Studio** plugin
5. Go to **Tools** → **Load from file** and select the JSON

### Import from Figma to WordPress

1. In Tokens Studio, click **Tools** → **Export to file** → **Single file**
2. Save the JSON file
3. In WordPress, click the **Import from Figma** button (↓ arrow icon)
4. Paste the JSON content or upload the file
5. Click **Import** to apply tokens

---

## Installing Tokens Studio

1. Open Figma and go to **Community** → **Plugins**
2. Search for "**Tokens Studio for Figma**"
3. Click **Install**
4. Open any Figma file and run: **Plugins** → **Tokens Studio for Figma**

---

## Exporting from WordPress

The plugin exports all UIkit component variables organized by component:

### Export Format

```json
{
  "global": {
    "global-color": { "value": "#666", "type": "color" },
    "global-background": { "value": "#fff", "type": "color" },
    "global-font-family": { "value": "-apple-system, BlinkMacSystemFont, ...", "type": "other" }
  },
  "button": {
    "button-primary-background": { "value": "#1e87f0", "type": "color" },
    "button-primary-color": { "value": "#fff", "type": "color" },
    "button-padding-horizontal": { "value": "20px", "type": "dimension" }
  },
  "card": {
    "card-default-background": { "value": "#fff", "type": "color" },
    "card-body-padding-horizontal": { "value": "30px", "type": "dimension" }
  }
}
```

### Token Types

The exporter automatically detects token types:

| Token Type | Detection |
|------------|-----------|
| `color` | Hex colors, rgb(), rgba(), hsl() |
| `dimension` | Values with px, rem, em, %, vh, vw |
| `fontWeight` | 100-900, bold, normal, lighter |
| `fontFamily` | Font family strings |
| `number` | Pure numbers, z-index, opacity |
| `other` | Everything else |

### What Gets Exported

- All 68 UIkit components
- Variables with saved customizations
- Default values from UIkit Less files
- Organized by component name

---

## Importing to WordPress

### Supported Formats

The importer accepts standard Tokens Studio JSON format:

```json
{
  "tokenSetName": {
    "token-name": {
      "value": "#1e87f0",
      "type": "color"
    },
    "nested": {
      "token": {
        "value": "16px",
        "type": "dimension"
      }
    }
  }
}
```

### Import Process

1. **Parse** – JSON is validated and parsed
2. **Match** – Token names are matched to UIkit variables
3. **Distribute** – Values are assigned to the correct component
4. **Save** – Component settings are saved to WordPress options
5. **Regenerate** – Child theme CSS is regenerated

### Token Name Matching

The importer uses flexible matching to find UIkit variables:

| Token Format | Matches Variable |
|--------------|------------------|
| `button-primary-background` | `@button-primary-background` |
| `button.primary.background` | `@button-primary-background` |
| `buttonPrimaryBackground` | `@button-primary-background` |
| `global-color` | `@global-color` |

### Skipped Tokens

The following tokens are skipped during import:

- **References** – Values like `{colors.primary}` or `$primary-color`
- **Calculations** – Values with `calc()`, `*`, `/`, `+`
- **Functions** – Values with `rgba()`, `lighten()`, `darken()`
- **Empty values** – Blank or null values

### Import Statistics

After import, you'll see:

```
✓ 127 tokens imported to 23 components.
```

---

## Token Format Reference

### Basic Token

```json
{
  "token-name": {
    "value": "#1e87f0",
    "type": "color"
  }
}
```

### Nested Tokens

```json
{
  "button": {
    "primary": {
      "background": {
        "value": "#1e87f0",
        "type": "color"
      }
    }
  }
}
```

Nested tokens are flattened to: `button-primary-background`

### Token Groups

Tokens can be organized into groups (token sets):

```json
{
  "colors": {
    "primary": { "value": "#1e87f0", "type": "color" },
    "secondary": { "value": "#222", "type": "color" }
  },
  "typography": {
    "base-font-size": { "value": "16px", "type": "dimension" }
  }
}
```

---

## Variable Mapping

### How Tokens Map to Components

The importer identifies which UIkit component a token belongs to:

| Token Name Prefix | Component |
|-------------------|-----------|
| `global-*` | variables (Global) |
| `button-*` | button |
| `card-*` | card |
| `navbar-*` | navbar |
| `modal-*` | modal |
| `form-*` | form |
| `alert-*` | alert |
| ... | ... |

### Core Variable Mappings

#### Global Variables (variables.less)

| Token Name | UIkit Variable |
|------------|----------------|
| `global-color` | `@global-color` |
| `global-background` | `@global-background` |
| `global-muted-color` | `@global-muted-color` |
| `global-link-color` | `@global-link-color` |
| `global-font-family` | `@global-font-family` |
| `global-font-size` | `@global-font-size` |
| `global-primary-background` | `@global-primary-background` |
| `global-secondary-background` | `@global-secondary-background` |

#### Button Variables (button.less)

| Token Name | UIkit Variable |
|------------|----------------|
| `button-default-background` | `@button-default-background` |
| `button-default-color` | `@button-default-color` |
| `button-primary-background` | `@button-primary-background` |
| `button-primary-color` | `@button-primary-color` |
| `button-padding-horizontal` | `@button-padding-horizontal` |
| `button-line-height` | `@button-line-height` |

#### Card Variables (card.less)

| Token Name | UIkit Variable |
|------------|----------------|
| `card-default-background` | `@card-default-background` |
| `card-default-color` | `@card-default-color` |
| `card-body-padding-horizontal` | `@card-body-padding-horizontal` |
| `card-body-padding-vertical` | `@card-body-padding-vertical` |
| `card-title-font-size` | `@card-title-font-size` |

#### Typography Variables (base.less, heading.less)

| Token Name | UIkit Variable |
|------------|----------------|
| `base-body-font-family` | `@base-body-font-family` |
| `base-body-font-size` | `@base-body-font-size` |
| `base-body-color` | `@base-body-color` |
| `base-link-color` | `@base-link-color` |
| `heading-medium-font-size` | `@heading-medium-font-size` |
| `heading-large-font-size` | `@heading-large-font-size` |

---

## Best Practices

### Organizing Tokens in Figma

Create token sets that mirror UIkit components:

```
📁 global
   ├─ global-color
   ├─ global-background
   └─ global-font-family
📁 button
   ├─ button-primary-background
   ├─ button-primary-color
   └─ button-padding-horizontal
📁 card
   ├─ card-default-background
   └─ card-body-padding-horizontal
```

### Naming Conventions

For best compatibility, use UIkit variable names directly:

✅ **Good:**
- `button-primary-background`
- `card-default-color`
- `navbar-nav-item-color`

⚠️ **Works (will be converted):**
- `button.primary.background`
- `buttonPrimaryBackground`

❌ **Won't match:**
- `primaryButtonBg`
- `my-custom-button-color`

### Workflow Tips

1. **Start with export** – Export from WordPress first to get the correct structure
2. **Use that as a template** – Modify the exported JSON in Figma
3. **Import changes** – Import back to WordPress to apply
4. **Regenerate CSS** – Create/update child theme to apply changes

### Avoiding Issues

| Issue | Solution |
|-------|----------|
| Tokens not importing | Check token names match UIkit variables |
| References skipped | Replace with actual values before export |
| Colors not applying | Ensure hex format (`#ffffff` not `rgb()`) |
| Dimensions missing | Include units (`16px` not just `16`) |

### Syncing Teams

For team workflows:

1. Export tokens to a shared repository
2. Designers edit in Figma with Tokens Studio
3. Export updated tokens to the repo
4. Developers import tokens to WordPress
5. Changes flow to the child theme CSS

---

## Troubleshooting

### Import Shows 0 Tokens

- Check JSON is valid (use a JSON validator)
- Ensure tokens have `value` and `type` properties
- Check for reference values that get skipped

### Tokens Not Matching

- Export from WordPress to see expected token names
- Compare your token names to the export
- Use kebab-case: `button-primary-color`

### CSS Not Updating

- Click **Create Child Theme** after importing
- Check child theme is activated
- Clear any caching plugins

### Preview Not Showing Changes

- Reload the page after import
- Select a different component, then return
- Check browser console for JavaScript errors

---

## Support

For more information:

- [UIkit Documentation](https://getuikit.com/docs/introduction)
- [Tokens Studio Documentation](https://docs.tokens.studio/)
- [Plugin Issues](https://github.com/PinkFlamingoz/ppm-plugin-bundle/issues)

---

Happy designing! 🎨
