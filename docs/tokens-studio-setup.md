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
   (JSON Format)                        (74 Components)
```

### What You Can Do

| Direction             | Action                                              |
| --------------------- | --------------------------------------------------- |
| **WordPress → Figma** | Export all UIkit variables as Tokens Studio JSON    |
| **Figma → WordPress** | Import Tokens Studio JSON to update UIkit variables |

### Supported Token Types

| Token Type       | Description                                               |
| ---------------- | --------------------------------------------------------- |
| `color`          | Hex colors, rgb(), rgba() — backgrounds, text, borders    |
| `fontSizes`      | Font size values                                          |
| `fontFamilies`   | Font family stacks                                        |
| `fontWeights`    | Font weights (mapped to Figma names: Regular, Bold, etc.) |
| `lineHeights`    | Line heights (unitless scalars converted to px)           |
| `letterSpacing`  | Letter spacing values                                     |
| `textCase`       | Text transform (uppercase, lowercase, capitalize)         |
| `textDecoration` | Text decoration (underline, none)                         |
| `borderRadius`   | Border radius values                                      |
| `borderWidth`    | Border width values                                       |
| `spacing`        | Margins, padding, gutters, gaps                           |
| `sizing`         | Heights, widths, breakpoints                              |
| `dimension`      | Generic px/rem/em/% values                                |
| `opacity`        | Opacity values (0–1)                                      |
| `boxShadow`      | Box shadow shorthand values                               |

---

## Quick Start

### Export Current Theme to Figma

1. Open **Plugin Bundle** in WordPress admin
2. Click the **Export for Figma** button (↑ arrow icon)
3. A `tokens-studio-YYYY-MM-DD.json` file downloads
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

The plugin exports all UIkit component variables organized by component, with full Tokens Studio compatibility including `$themes`, `$metadata`, color modifiers, and CSS keyword round-trip metadata.

### Export Format

```json
{
  "global": {
    "global-color": { "value": "#666", "type": "color" },
    "global-background": { "value": "#fff", "type": "color" },
    "global-font-family": {
      "value": "-apple-system, BlinkMacSystemFont, ...",
      "type": "fontFamilies"
    },
    "global-font-size": { "value": "16px", "type": "fontSizes" },
    "global-font-weight": {
      "value": "Regular",
      "type": "fontWeights",
      "$extensions": {
        "epb.less": { "original": "normal", "figmaValue": "Regular" }
      }
    }
  },
  "button": {
    "button-primary-background": { "value": "#1e87f0", "type": "color" },
    "button-primary-color": { "value": "#fff", "type": "color" },
    "button-padding-horizontal": { "value": "20px", "type": "spacing" },
    "button-line-height": { "value": "38px", "type": "lineHeights" }
  },
  "card": {
    "card-default-background": {
      "value": "{global-background}",
      "type": "color",
      "description": "Less: @global-background"
    },
    "card-body-padding-horizontal": { "value": "30px", "type": "spacing" }
  },
  "$themes": [
    {
      "id": "default",
      "name": "Default",
      "selectedTokenSets": {
        "global": "enabled",
        "button": "enabled",
        "card": "enabled"
      }
    }
  ],
  "$metadata": {
    "tokenSetOrder": ["global", "button", "card"]
  }
}
```

### Token Type Detection

The exporter automatically detects token types from variable names and values:

| Detection Rule                                                            | Token Type                    |
| ------------------------------------------------------------------------- | ----------------------------- |
| Variable name contains `color`, `background`, `border` (not width/radius) | `color`                       |
| Variable name contains `font-size`                                        | `fontSizes`                   |
| Variable name contains `font-family`                                      | `fontFamilies`                |
| Variable name contains `font-weight`, `weight`, `font-style`              | `fontWeights`                 |
| Variable name contains `line-height`                                      | `lineHeights`                 |
| Variable name contains `letter-spacing`                                   | `letterSpacing`               |
| Variable name contains `text-transform`                                   | `textCase`                    |
| Variable name contains `text-decoration`                                  | `textDecoration`              |
| Variable name contains `border-radius`, `radius`                          | `borderRadius`                |
| Variable name contains `border-width`                                     | `borderWidth`                 |
| Variable name contains `margin`, `padding`, `gutter`, `gap`               | `spacing`                     |
| Variable name contains `height`, `width`, `breakpoint`                    | `sizing`                      |
| Variable name contains `opacity`                                          | `opacity`                     |
| Variable name contains `shadow` (with shorthand value)                    | `boxShadow`                   |
| Value matches `-?\d+(\.\d+)?(px\|rem\|em\|%)`                             | `dimension`                   |
| None of the above                                                         | `other` (skipped from export) |

### Special Export Handling

#### CSS Keywords (transparent, inherit, currentColor, etc.)

CSS cascade keywords have no Figma equivalent. The exporter converts them to usable fallback values and stores the original keyword in `$extensions.epb.less` for round-trip fidelity:

```json
{
  "navbar-dropdown-background": {
    "value": "rgba(0,0,0,0)",
    "type": "color",
    "description": "CSS: transparent",
    "$extensions": {
      "epb.less": {
        "original": "transparent",
        "fallback": "rgba(0,0,0,0)"
      }
    }
  }
}
```

On re-import, if the value is unchanged from the fallback, the original CSS keyword is restored.

#### Font Weight Mapping

CSS font weights are converted to Figma-compatible strings:

| CSS Value            | Figma Value   |
| -------------------- | ------------- |
| `normal` / `400`     | `Regular`     |
| `bold` / `700`       | `Bold`        |
| `100`                | `Thin`        |
| `200`                | `Extra Light` |
| `300`                | `Light`       |
| `500`                | `Medium`      |
| `600`                | `Semi Bold`   |
| `800`                | `Extra Bold`  |
| `900`                | `Black`       |
| `italic` / `oblique` | `Italic`      |

#### Color Function Conversion

Less color functions are converted to Tokens Studio `modify` format:

```json
{
  "button-default-hover-background": {
    "value": "{global-muted-background}",
    "type": "color",
    "$extensions": {
      "studio.tokens": {
        "modify": { "type": "darken", "value": 0.05, "space": "hsl" }
      }
    }
  }
}
```

Supported functions: `lighten`, `darken`, `tint`, `shade`, `fade`, `fadein`, `fadeout`. Nested functions (e.g., `lighten(tint(@color, 40%), 20%)`) are approximated with combined modifiers, and the original Less expression is preserved in the `description` field.

#### Line Height Conversion

Unitless scalar line heights (e.g., `1.5`) are converted to pixel values for designer-friendly editing in Figma.

#### Less Variable References

Less `@variable` references are converted to Tokens Studio `{variable}` format:

| Less                       | Tokens Studio             |
| -------------------------- | ------------------------- |
| `@global-background`       | `{global-background}`     |
| `(@breakpoint-xlarge - 1)` | `{breakpoint-xlarge} - 1` |

### What Gets Exported

- All 74 UIkit components with their variables
- User-saved customizations overlaid on UIkit defaults
- Token sets per component with `$themes` and `$metadata`
- Tokens of type `other` (z-index, animation names, border-style keywords) are excluded

---

## Importing to WordPress

### Supported Formats

The importer accepts standard Tokens Studio JSON format:

```json
{
  "$themes": [...],
  "$metadata": { "tokenSetOrder": [...] },
  "tokenSetName": {
    "token-name": {
      "value": "#1e87f0",
      "type": "color"
    }
  }
}
```

The `$themes` and `$metadata` sections are automatically skipped during import.

### Import Process

1. **Parse** – JSON is validated and parsed
2. **Validate** – Structure checked for Tokens Studio format (groups with `value`/`type`)
3. **Match** – Token names are matched to UIkit variables
4. **Distribute** – Values are assigned to the correct component
5. **Filter** – Values matching UIkit defaults are filtered out (only modifications saved)
6. **Save** – Component settings are saved to WordPress options
7. **Regenerate** – CSS cache is cleared and child theme CSS is regenerated

### Round-Trip Fidelity

The importer supports full round-trip with the exporter:

- **CSS keywords** – If a token has `$extensions.epb.less.original` and the value hasn't changed from the exported fallback, the original CSS keyword (transparent, inherit, etc.) is restored
- **Font weights** – Figma font strings are reverse-mapped back to CSS values (Regular → normal, Bold → bold, etc.)
- **Color modifiers** – Tokens Studio `modify` format is converted back to Less functions (`lighten()`, `darken()`, etc.)
- **Nested functions** – If the original Less expression is stored in the `description` field, it's restored exactly
- **References** – Tokens Studio `{variable-name}` references are converted back to Less `@variable-name` format
- **Border width normalization** – `0px` (exported for Figma) is converted back to `0`
- **Box shadow normalization** – `0 0 0 0 rgba(0,0,0,0)` is converted back to `none`

### Token Name Matching

Token names must use the full UIkit variable name in kebab-case:

| Token Name                     | Matches Variable                |
| ------------------------------ | ------------------------------- |
| `button-primary-background`    | `@button-primary-background`    |
| `global-color`                 | `@global-color`                 |
| `card-body-padding-horizontal` | `@card-body-padding-horizontal` |

If the token name already starts with the group name, it won't be duplicated (e.g., token `button-primary-background` in group `button` → `@button-primary-background`, not `@button-button-primary-background`).

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

### Token with Description

Less variable references are stored in a `description` field:

```json
{
  "card-default-background": {
    "value": "{global-background}",
    "type": "color",
    "description": "Less: @global-background"
  }
}
```

### Token with Color Modifier

Color functions are represented using the Tokens Studio `modify` extension:

```json
{
  "button-default-hover-background": {
    "value": "{global-muted-background}",
    "type": "color",
    "$extensions": {
      "studio.tokens": {
        "modify": { "type": "darken", "value": 0.05, "space": "hsl" }
      }
    }
  }
}
```

### Token with CSS Keyword Metadata

CSS keywords include round-trip metadata in `$extensions.epb.less`:

```json
{
  "navbar-dropdown-background": {
    "value": "rgba(0,0,0,0)",
    "type": "color",
    "description": "CSS: transparent",
    "$extensions": {
      "epb.less": {
        "original": "transparent",
        "fallback": "rgba(0,0,0,0)"
      }
    }
  }
}
```

### Token Groups

Tokens are organized into groups (token sets) matching UIkit components, with metadata:

```json
{
  "global": { ... },
  "button": { ... },
  "card": { ... },
  "$themes": [
    {
      "id": "default",
      "name": "Default",
      "selectedTokenSets": { "global": "enabled", "button": "enabled", "card": "enabled" }
    }
  ],
  "$metadata": {
    "tokenSetOrder": ["global", "button", "card"]
  }
}
```

The `$themes` section defines which token sets are enabled together (ensures cross-set references resolve). The `$metadata.tokenSetOrder` controls display order in Tokens Studio.

---

## Variable Mapping

### How Tokens Map to Components

The importer identifies which UIkit component a token belongs to:

| Token Name Prefix | Component          |
| ----------------- | ------------------ |
| `global-*`        | variables (Global) |
| `button-*`        | button             |
| `card-*`          | card               |
| `navbar-*`        | navbar             |
| `modal-*`         | modal              |
| `form-*`          | form               |
| `alert-*`         | alert              |
| ...               | ...                |

### Core Variable Mappings

#### Global Variables (variables.less)

| Token Name                    | UIkit Variable                 |
| ----------------------------- | ------------------------------ |
| `global-color`                | `@global-color`                |
| `global-background`           | `@global-background`           |
| `global-muted-color`          | `@global-muted-color`          |
| `global-link-color`           | `@global-link-color`           |
| `global-font-family`          | `@global-font-family`          |
| `global-font-size`            | `@global-font-size`            |
| `global-primary-background`   | `@global-primary-background`   |
| `global-secondary-background` | `@global-secondary-background` |

#### Button Variables (button.less)

| Token Name                  | UIkit Variable               |
| --------------------------- | ---------------------------- |
| `button-default-background` | `@button-default-background` |
| `button-default-color`      | `@button-default-color`      |
| `button-primary-background` | `@button-primary-background` |
| `button-primary-color`      | `@button-primary-color`      |
| `button-padding-horizontal` | `@button-padding-horizontal` |
| `button-line-height`        | `@button-line-height`        |

#### Card Variables (card.less)

| Token Name                     | UIkit Variable                  |
| ------------------------------ | ------------------------------- |
| `card-default-background`      | `@card-default-background`      |
| `card-default-color`           | `@card-default-color`           |
| `card-body-padding-horizontal` | `@card-body-padding-horizontal` |
| `card-body-padding-vertical`   | `@card-body-padding-vertical`   |
| `card-title-font-size`         | `@card-title-font-size`         |

#### Typography Variables (base.less, heading.less)

| Token Name                 | UIkit Variable              |
| -------------------------- | --------------------------- |
| `base-body-font-family`    | `@base-body-font-family`    |
| `base-body-font-size`      | `@base-body-font-size`      |
| `base-body-color`          | `@base-body-color`          |
| `base-link-color`          | `@base-link-color`          |
| `heading-medium-font-size` | `@heading-medium-font-size` |
| `heading-large-font-size`  | `@heading-large-font-size`  |

---

## Best Practices

### Organizing Tokens in Figma

Token sets in the export mirror UIkit components. Keep this structure in Figma:

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

Use the full UIkit variable name in kebab-case for guaranteed matching:

✅ **Correct:**

- `button-primary-background`
- `card-default-color`
- `navbar-nav-item-color`
- `global-font-size`

❌ **Won't match:**

- `primaryButtonBg` (camelCase not supported)
- `button.primary.background` (dot notation not supported for top-level keys)
- `my-custom-button-color` (non-UIkit variable names)

### Workflow Tips

1. **Start with export** – Export from WordPress first to get the correct structure with all metadata
2. **Keep `$extensions` intact** – Don't strip `$extensions.epb.less` data; it ensures CSS keywords survive round-trips
3. **Use token references** – Change `{global-background}` in one place and all referencing tokens update
4. **Enable all token sets** – Keep all sets enabled in `$themes` so cross-set references resolve
5. **Import changes** – Import back to WordPress to apply
6. **Regenerate CSS** – Create/update child theme to compile changes

### Avoiding Issues

| Issue                | Solution                                                                      |
| -------------------- | ----------------------------------------------------------------------------- |
| Tokens not importing | Check token names use full UIkit variable names in kebab-case                 |
| CSS keywords lost    | Keep `$extensions.epb.less` metadata intact in Figma                          |
| Colors not applying  | Hex format preferred (`#ffffff`); rgb() also works                            |
| Dimensions missing   | Include units (`16px` not just `16`)                                          |
| Font weights wrong   | Use Figma strings (Regular, Bold) — they're reverse-mapped on import          |
| Color functions lost | Keep `$extensions.studio.tokens.modify` or `description` with Less expression |

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
- Check the import response `debug_logs` for details on what was processed

### Tokens Not Matching

- Export from WordPress to see expected token names
- Use the full UIkit variable name as the token key (e.g., `button-primary-background`, not just `primary-background`)
- Token names must be in kebab-case

### CSS Keywords Lost After Round-Trip

- Ensure `$extensions.epb.less` metadata is preserved in Figma
- If the metadata is stripped, the importer cannot restore keywords like `transparent` or `inherit`

### Font Weights Changed

- The exporter maps CSS weights to Figma strings (normal → Regular, bold → Bold)
- On import, these are reverse-mapped back (Regular → normal, Bold → bold)
- If you change a weight in Figma, the new Figma string is reverse-mapped

### Color Functions Not Preserved

- Simple functions (lighten, darken) are converted to Tokens Studio `modify` format
- Nested functions are approximated, but the original Less expression is stored in `description`
- On import, the `description` Less expression is preferred over the modifier approximation

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
- [Plugin Issues](https://github.com/PinkFlamingoz/epb-plugin-bundle/issues)

---

Happy designing! 🎨
