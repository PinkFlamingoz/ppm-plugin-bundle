# Tokens Studio Integration Guide

This guide explains how to set up **Tokens Studio for Figma** to export design tokens compatible with the Enhanced Plugin Bundle and Theme Manager.

---

## Table of Contents

1. [Overview](#overview)
2. [Installing Tokens Studio](#installing-tokens-studio)
3. [Token Structure](#token-structure)
4. [Creating Token Sets](#creating-token-sets)
5. [Exporting Tokens](#exporting-tokens)
6. [Importing to WordPress](#importing-to-wordpress)
7. [Complete Token Reference](#complete-token-reference)
8. [Template Files](#template-files)

---

## Overview

The Enhanced Plugin Bundle uses CSS custom properties (variables) to style YOOtheme child themes. By structuring your Tokens Studio tokens to match the plugin's expected format, you can:

- Design in Figma with real token values
- Export tokens as JSON
- Import them directly into WordPress
- Keep design and development synchronized

### Workflow

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│  Tokens Studio  │────▶│   JSON Export   │────▶│  WordPress      │
│  (Figma)        │     │                 │     │  Plugin Import  │
└─────────────────┘     └─────────────────┘     └─────────────────┘
```

---

## Installing Tokens Studio

1. Open Figma and go to **Community** → **Plugins**
2. Search for "**Tokens Studio for Figma**"
3. Click **Install**
4. Open any Figma file and run: **Plugins** → **Tokens Studio for Figma**

---

## Token Structure

The plugin expects tokens organized into five token sets:

| Token Set | Description |
|-----------|-------------|
| `colors` | Text colors, background colors, button colors |
| `breakpoints` | Responsive breakpoint values |
| `spacing` | Container padding, margins, column gutters |
| `sizing` | Container max-widths, element widths |
| `typography` | Font sizes, weights for headings, buttons, text |

---

## Creating Token Sets

### 1. Colors Token Set

Create a token set named `colors` with the following structure:

#### Text Colors

```json
{
  "text": {
    "muted": { "value": "#B4B5BA", "type": "color" },
    "emphasis": { "value": "#2D2E33", "type": "color" },
    "primary": { "value": "#303033", "type": "color" },
    "secondary": { "value": "#242427", "type": "color" },
    "success": { "value": "#3DC372", "type": "color" },
    "warning": { "value": "#FF9E45", "type": "color" },
    "danger": { "value": "#E44E56", "type": "color" },
    "background": { "value": "#303033", "type": "color" },
    "body": { "value": "#000000", "type": "color" }
  }
}
```

#### Background Colors

```json
{
  "background": {
    "default": { "value": "#FFFFFF", "type": "color" },
    "muted": { "value": "#F7F7F7", "type": "color" },
    "primary": { "value": "#303033", "type": "color" },
    "secondary": { "value": "#242427", "type": "color" }
  }
}
```

#### Button Colors

Each button type requires background, hover, text, and hover text colors:

```json
{
  "button": {
    "default": {
      "background": { "value": "#F7F7F7", "type": "color" },
      "backgroundHover": { "value": "#E8E8E8", "type": "color" },
      "text": { "value": "#000000", "type": "color" },
      "textHover": { "value": "#000000", "type": "color" }
    },
    "primary": {
      "background": { "value": "#303033", "type": "color" },
      "backgroundHover": { "value": "#242427", "type": "color" },
      "text": { "value": "#FFFFFF", "type": "color" },
      "textHover": { "value": "#FFFFFF", "type": "color" }
    },
    "secondary": {
      "background": { "value": "#242427", "type": "color" },
      "backgroundHover": { "value": "#1a1a1c", "type": "color" },
      "text": { "value": "#FFFFFF", "type": "color" },
      "textHover": { "value": "#FFFFFF", "type": "color" }
    },
    "danger": {
      "background": { "value": "#E44E56", "type": "color" },
      "backgroundHover": { "value": "#d43d45", "type": "color" },
      "text": { "value": "#FFFFFF", "type": "color" },
      "textHover": { "value": "#FFFFFF", "type": "color" }
    },
    "textStyle": {
      "color": { "value": "#2D2E33", "type": "color" },
      "hoverColor": { "value": "#1a1a1c", "type": "color" }
    },
    "link": {
      "color": { "value": "#6C6D74", "type": "color" },
      "hoverColor": { "value": "#303033", "type": "color" }
    }
  }
}
```

### 2. Breakpoints Token Set

Create a token set named `breakpoints`:

```json
{
  "s": { "value": "600", "type": "dimension" },
  "m": { "value": "900", "type": "dimension" },
  "l": { "value": "1200", "type": "dimension" },
  "xl": { "value": "1600", "type": "dimension" }
}
```

### 3. Spacing Token Set

Create a token set named `spacing`:

#### Container Padding

```json
{
  "container": {
    "padding": {
      "horizontal": {
        "mobile": { "value": "15", "type": "spacing" },
        "s": { "value": "20", "type": "spacing" },
        "m": { "value": "40", "type": "spacing" }
      },
      "vertical": {
        "default": {
          "mobile": { "value": "40", "type": "spacing" },
          "m": { "value": "70", "type": "spacing" }
        },
        "xsmall": {
          "mobile": { "value": "20", "type": "spacing" },
          "m": { "value": "25", "type": "spacing" }
        },
        "small": {
          "mobile": { "value": "40", "type": "spacing" },
          "m": { "value": "45", "type": "spacing" }
        },
        "large": {
          "mobile": { "value": "70", "type": "spacing" },
          "m": { "value": "140", "type": "spacing" }
        },
        "xlarge": {
          "mobile": { "value": "140", "type": "spacing" },
          "m": { "value": "210", "type": "spacing" }
        }
      }
    }
  }
}
```

#### Column Gutter

```json
{
  "column": {
    "gutter": {
      "mobile": { "value": "20", "type": "spacing" },
      "l": { "value": "40", "type": "spacing" }
    }
  }
}
```

#### Element Margins

```json
{
  "element": {
    "margin": {
      "default": {
        "mobile": { "value": "15", "type": "spacing" },
        "l": { "value": "20", "type": "spacing" }
      },
      "xsmall": {
        "mobile": { "value": "3", "type": "spacing" },
        "l": { "value": "5", "type": "spacing" }
      },
      "small": {
        "mobile": { "value": "5", "type": "spacing" },
        "l": { "value": "10", "type": "spacing" }
      },
      "medium": {
        "mobile": { "value": "20", "type": "spacing" },
        "l": { "value": "40", "type": "spacing" }
      },
      "large": {
        "mobile": { "value": "40", "type": "spacing" },
        "l": { "value": "70", "type": "spacing" }
      },
      "xlarge": {
        "mobile": { "value": "70", "type": "spacing" },
        "l": { "value": "140", "type": "spacing" }
      }
    }
  }
}
```

### 4. Sizing Token Set

Create a token set named `sizing`:

#### Container Max Width

```json
{
  "container": {
    "maxWidth": {
      "default": { "value": "1920", "type": "sizing" },
      "xsmall": { "value": "750", "type": "sizing" },
      "small": { "value": "900", "type": "sizing" },
      "large": { "value": "1400", "type": "sizing" },
      "xlarge": { "value": "1600", "type": "sizing" }
    }
  }
}
```

#### Element Width

```json
{
  "element": {
    "width": {
      "small": { "value": "150", "type": "sizing" },
      "medium": { "value": "300", "type": "sizing" },
      "large": { "value": "450", "type": "sizing" },
      "xlarge": { "value": "600", "type": "sizing" },
      "2xlarge": { "value": "750", "type": "sizing" }
    }
  }
}
```

### 5. Typography Token Set

Create a token set named `typography`:

#### Base Font Size

```json
{
  "fontSize": {
    "base": { "value": "16", "type": "fontSizes" }
  }
}
```

#### Headings

```json
{
  "heading": {
    "3xlarge": {
      "mobile": { "value": "32", "type": "fontSizes" },
      "desktop": { "value": "48", "type": "fontSizes" },
      "fontWeight": { "value": "700", "type": "fontWeights" }
    },
    "2xlarge": {
      "mobile": { "value": "24", "type": "fontSizes" },
      "desktop": { "value": "36", "type": "fontSizes" },
      "fontWeight": { "value": "700", "type": "fontWeights" }
    },
    "xlarge": {
      "mobile": { "value": "20", "type": "fontSizes" },
      "desktop": { "value": "28", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "large": {
      "mobile": { "value": "18", "type": "fontSizes" },
      "desktop": { "value": "24", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "medium": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "20", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    },
    "small": {
      "mobile": { "value": "14", "type": "fontSizes" },
      "desktop": { "value": "18", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    }
  }
}
```

#### Button Typography

```json
{
  "button": {
    "default": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "18", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "primary": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "18", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "secondary": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "18", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "danger": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "18", "type": "fontSizes" },
      "fontWeight": { "value": "600", "type": "fontWeights" }
    },
    "text": {
      "mobile": { "value": "14", "type": "fontSizes" },
      "desktop": { "value": "16", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    },
    "link": {
      "mobile": { "value": "14", "type": "fontSizes" },
      "desktop": { "value": "16", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    }
  }
}
```

#### Navbar Links

```json
{
  "navbar": {
    "link": {
      "mobile": { "value": "14", "type": "fontSizes" },
      "desktop": { "value": "16", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    }
  }
}
```

#### Text Styles

```json
{
  "text": {
    "default": {
      "mobile": { "value": "14", "type": "fontSizes" },
      "desktop": { "value": "16", "type": "fontSizes" },
      "fontWeight": { "value": "400", "type": "fontWeights" }
    },
    "small": {
      "mobile": { "value": "12", "type": "fontSizes" },
      "desktop": { "value": "14", "type": "fontSizes" },
      "fontWeight": { "value": "400", "type": "fontWeights" }
    },
    "large": {
      "mobile": { "value": "16", "type": "fontSizes" },
      "desktop": { "value": "20", "type": "fontSizes" },
      "fontWeight": { "value": "500", "type": "fontWeights" }
    }
  }
}
```

---

## Exporting Tokens

### From Tokens Studio

1. In Tokens Studio, click the **Tools** icon (gear)
2. Select **Export to file** → **Single file**
3. Choose JSON format
4. Save the file

### File Structure

The exported file should have this structure:

```json
{
  "colors": { ... },
  "breakpoints": { ... },
  "spacing": { ... },
  "sizing": { ... },
  "typography": { ... }
}
```

---

## Importing to WordPress

### Option 1: Upload JSON File

1. In WordPress admin, go to **Plugin Bundle** → **Child Theme**
2. Scroll to the **Import Design Tokens** section
3. Click **Choose File** and select your exported JSON
4. Click **Import Tokens**
5. Review the imported values
6. Click **Save Options & Create Child Theme**

### Option 2: Paste JSON

1. Navigate to **Plugin Bundle** → **Child Theme**
2. In the **Import Design Tokens** section, paste your JSON into the text area
3. Click **Import Tokens**
4. Review and save

### Export Current Settings

To export your current WordPress settings as Tokens Studio compatible JSON:

1. Go to **Plugin Bundle** → **Child Theme**
2. Click **Export Settings as Tokens**
3. The JSON file will download automatically

---

## Complete Token Reference

### Color Token Paths

| Plugin Option | Token Path |
|--------------|------------|
| `muted_color` | `colors.text.muted.value` |
| `emphasis_color` | `colors.text.emphasis.value` |
| `primary_color` | `colors.text.primary.value` |
| `secondary_color` | `colors.text.secondary.value` |
| `success_color` | `colors.text.success.value` |
| `warning_color` | `colors.text.warning.value` |
| `danger_color` | `colors.text.danger.value` |
| `text_background_color` | `colors.text.background.value` |
| `body_color` | `colors.text.body.value` |
| `background_default_color` | `colors.background.default.value` |
| `background_muted_color` | `colors.background.muted.value` |
| `background_primary_color` | `colors.background.primary.value` |
| `background_secondary_color` | `colors.background.secondary.value` |
| `button_default_color` | `colors.button.default.background.value` |
| `button_default_hover_color` | `colors.button.default.backgroundHover.value` |
| `button_default_text_color` | `colors.button.default.text.value` |
| `button_default_hover_text_color` | `colors.button.default.textHover.value` |
| `button_primary_color` | `colors.button.primary.background.value` |
| `button_primary_hover_color` | `colors.button.primary.backgroundHover.value` |
| `button_primary_text_color` | `colors.button.primary.text.value` |
| `button_primary_hover_text_color` | `colors.button.primary.textHover.value` |
| `button_secondary_color` | `colors.button.secondary.background.value` |
| `button_secondary_hover_color` | `colors.button.secondary.backgroundHover.value` |
| `button_secondary_text_color` | `colors.button.secondary.text.value` |
| `button_secondary_hover_text_color` | `colors.button.secondary.textHover.value` |
| `button_danger_color` | `colors.button.danger.background.value` |
| `button_danger_hover_color` | `colors.button.danger.backgroundHover.value` |
| `button_danger_text_color` | `colors.button.danger.text.value` |
| `button_danger_hover_text_color` | `colors.button.danger.textHover.value` |
| `button_text_color` | `colors.button.textStyle.color.value` |
| `button_text_hover_color` | `colors.button.textStyle.hoverColor.value` |
| `button_link_color` | `colors.button.link.color.value` |
| `button_link_hover_color` | `colors.button.link.hoverColor.value` |

### Breakpoint Token Paths

| Plugin Option | Token Path |
|--------------|------------|
| `ppm_breakpoint_s` | `breakpoints.s.value` |
| `ppm_breakpoint_m` | `breakpoints.m.value` |
| `ppm_breakpoint_l` | `breakpoints.l.value` |
| `ppm_breakpoint_xl` | `breakpoints.xl.value` |

### Spacing Token Paths

| Plugin Option | Token Path |
|--------------|------------|
| `container_padding_horizontal_mobile` | `spacing.container.padding.horizontal.mobile.value` |
| `container_padding_horizontal_s` | `spacing.container.padding.horizontal.s.value` |
| `container_padding_horizontal_m` | `spacing.container.padding.horizontal.m.value` |
| `container_padding_vertical_default_mobile` | `spacing.container.padding.vertical.default.mobile.value` |
| `container_padding_vertical_default_m` | `spacing.container.padding.vertical.default.m.value` |
| `container_padding_vertical_xsmall_mobile` | `spacing.container.padding.vertical.xsmall.mobile.value` |
| `container_padding_vertical_xsmall_m` | `spacing.container.padding.vertical.xsmall.m.value` |
| `container_padding_vertical_small_mobile` | `spacing.container.padding.vertical.small.mobile.value` |
| `container_padding_vertical_small_m` | `spacing.container.padding.vertical.small.m.value` |
| `container_padding_vertical_large_mobile` | `spacing.container.padding.vertical.large.mobile.value` |
| `container_padding_vertical_large_m` | `spacing.container.padding.vertical.large.m.value` |
| `container_padding_vertical_xlarge_mobile` | `spacing.container.padding.vertical.xlarge.mobile.value` |
| `container_padding_vertical_xlarge_m` | `spacing.container.padding.vertical.xlarge.m.value` |
| `column_gutter_mobile` | `spacing.column.gutter.mobile.value` |
| `column_gutter_l` | `spacing.column.gutter.l.value` |
| `element_margin_default_mobile` | `spacing.element.margin.default.mobile.value` |
| `element_margin_default_l` | `spacing.element.margin.default.l.value` |
| `element_margin_xsmall_mobile` | `spacing.element.margin.xsmall.mobile.value` |
| `element_margin_xsmall_l` | `spacing.element.margin.xsmall.l.value` |
| `element_margin_small_mobile` | `spacing.element.margin.small.mobile.value` |
| `element_margin_small_l` | `spacing.element.margin.small.l.value` |
| `element_margin_medium_mobile` | `spacing.element.margin.medium.mobile.value` |
| `element_margin_medium_l` | `spacing.element.margin.medium.l.value` |
| `element_margin_large_mobile` | `spacing.element.margin.large.mobile.value` |
| `element_margin_large_l` | `spacing.element.margin.large.l.value` |
| `element_margin_xlarge_mobile` | `spacing.element.margin.xlarge.mobile.value` |
| `element_margin_xlarge_l` | `spacing.element.margin.xlarge.l.value` |

### Sizing Token Paths

| Plugin Option | Token Path |
|--------------|------------|
| `container_max_width_default` | `sizing.container.maxWidth.default.value` |
| `container_max_width_xsmall` | `sizing.container.maxWidth.xsmall.value` |
| `container_max_width_small` | `sizing.container.maxWidth.small.value` |
| `container_max_width_large` | `sizing.container.maxWidth.large.value` |
| `container_max_width_xlarge` | `sizing.container.maxWidth.xlarge.value` |
| `element_width_small` | `sizing.element.width.small.value` |
| `element_width_medium` | `sizing.element.width.medium.value` |
| `element_width_large` | `sizing.element.width.large.value` |
| `element_width_xlarge` | `sizing.element.width.xlarge.value` |
| `element_width_2xlarge` | `sizing.element.width.2xlarge.value` |

### Typography Token Paths

| Plugin Option | Token Path |
|--------------|------------|
| `base_font_size` | `typography.fontSize.base.value` |
| `heading_3xlarge_mobile` | `typography.heading.3xlarge.mobile.value` |
| `heading_3xlarge_desktop` | `typography.heading.3xlarge.desktop.value` |
| `heading_3xlarge_font_weight` | `typography.heading.3xlarge.fontWeight.value` |
| `heading_2xlarge_mobile` | `typography.heading.2xlarge.mobile.value` |
| `heading_2xlarge_desktop` | `typography.heading.2xlarge.desktop.value` |
| `heading_2xlarge_font_weight` | `typography.heading.2xlarge.fontWeight.value` |
| `heading_xlarge_mobile` | `typography.heading.xlarge.mobile.value` |
| `heading_xlarge_desktop` | `typography.heading.xlarge.desktop.value` |
| `heading_xlarge_font_weight` | `typography.heading.xlarge.fontWeight.value` |
| `heading_large_mobile` | `typography.heading.large.mobile.value` |
| `heading_large_desktop` | `typography.heading.large.desktop.value` |
| `heading_large_font_weight` | `typography.heading.large.fontWeight.value` |
| `heading_medium_mobile` | `typography.heading.medium.mobile.value` |
| `heading_medium_desktop` | `typography.heading.medium.desktop.value` |
| `heading_medium_font_weight` | `typography.heading.medium.fontWeight.value` |
| `heading_small_mobile` | `typography.heading.small.mobile.value` |
| `heading_small_desktop` | `typography.heading.small.desktop.value` |
| `heading_small_font_weight` | `typography.heading.small.fontWeight.value` |
| `button_default_mobile` | `typography.button.default.mobile.value` |
| `button_default_desktop` | `typography.button.default.desktop.value` |
| `button_default_font_weight` | `typography.button.default.fontWeight.value` |
| `button_primary_mobile` | `typography.button.primary.mobile.value` |
| `button_primary_desktop` | `typography.button.primary.desktop.value` |
| `button_primary_font_weight` | `typography.button.primary.fontWeight.value` |
| `button_secondary_mobile` | `typography.button.secondary.mobile.value` |
| `button_secondary_desktop` | `typography.button.secondary.desktop.value` |
| `button_secondary_font_weight` | `typography.button.secondary.fontWeight.value` |
| `button_danger_mobile` | `typography.button.danger.mobile.value` |
| `button_danger_desktop` | `typography.button.danger.desktop.value` |
| `button_danger_font_weight` | `typography.button.danger.fontWeight.value` |
| `button_text_mobile` | `typography.button.text.mobile.value` |
| `button_text_desktop` | `typography.button.text.desktop.value` |
| `button_text_font_weight` | `typography.button.text.fontWeight.value` |
| `button_link_mobile` | `typography.button.link.mobile.value` |
| `button_link_desktop` | `typography.button.link.desktop.value` |
| `button_link_font_weight` | `typography.button.link.fontWeight.value` |
| `navbar_link_mobile` | `typography.navbar.link.mobile.value` |
| `navbar_link_desktop` | `typography.navbar.link.desktop.value` |
| `navbar_link_font_weight` | `typography.navbar.link.fontWeight.value` |
| `text_default_mobile` | `typography.text.default.mobile.value` |
| `text_default_desktop` | `typography.text.default.desktop.value` |
| `text_default_font_weight` | `typography.text.default.fontWeight.value` |
| `text_small_mobile` | `typography.text.small.mobile.value` |
| `text_small_desktop` | `typography.text.small.desktop.value` |
| `text_small_font_weight` | `typography.text.small.fontWeight.value` |
| `text_large_mobile` | `typography.text.large.mobile.value` |
| `text_large_desktop` | `typography.text.large.desktop.value` |
| `text_large_font_weight` | `typography.text.large.fontWeight.value` |

---

## Template Files

### Complete tokens.json Template

You can import this template directly into Tokens Studio:

```json
{
  "colors": {
    "text": {
      "muted": { "value": "#B4B5BA", "type": "color" },
      "emphasis": { "value": "#2D2E33", "type": "color" },
      "primary": { "value": "#303033", "type": "color" },
      "secondary": { "value": "#242427", "type": "color" },
      "success": { "value": "#3DC372", "type": "color" },
      "warning": { "value": "#FF9E45", "type": "color" },
      "danger": { "value": "#E44E56", "type": "color" },
      "background": { "value": "#303033", "type": "color" },
      "body": { "value": "#000000", "type": "color" }
    },
    "background": {
      "default": { "value": "#FFFFFF", "type": "color" },
      "muted": { "value": "#F7F7F7", "type": "color" },
      "primary": { "value": "#303033", "type": "color" },
      "secondary": { "value": "#242427", "type": "color" }
    },
    "button": {
      "default": {
        "background": { "value": "#F7F7F7", "type": "color" },
        "backgroundHover": { "value": "#E8E8E8", "type": "color" },
        "text": { "value": "#000000", "type": "color" },
        "textHover": { "value": "#000000", "type": "color" }
      },
      "primary": {
        "background": { "value": "#303033", "type": "color" },
        "backgroundHover": { "value": "#242427", "type": "color" },
        "text": { "value": "#FFFFFF", "type": "color" },
        "textHover": { "value": "#FFFFFF", "type": "color" }
      },
      "secondary": {
        "background": { "value": "#242427", "type": "color" },
        "backgroundHover": { "value": "#1a1a1c", "type": "color" },
        "text": { "value": "#FFFFFF", "type": "color" },
        "textHover": { "value": "#FFFFFF", "type": "color" }
      },
      "danger": {
        "background": { "value": "#E44E56", "type": "color" },
        "backgroundHover": { "value": "#d43d45", "type": "color" },
        "text": { "value": "#FFFFFF", "type": "color" },
        "textHover": { "value": "#FFFFFF", "type": "color" }
      },
      "textStyle": {
        "color": { "value": "#2D2E33", "type": "color" },
        "hoverColor": { "value": "#1a1a1c", "type": "color" }
      },
      "link": {
        "color": { "value": "#6C6D74", "type": "color" },
        "hoverColor": { "value": "#303033", "type": "color" }
      }
    }
  },
  "breakpoints": {
    "s": { "value": "600", "type": "dimension" },
    "m": { "value": "900", "type": "dimension" },
    "l": { "value": "1200", "type": "dimension" },
    "xl": { "value": "1600", "type": "dimension" }
  },
  "spacing": {
    "container": {
      "padding": {
        "horizontal": {
          "mobile": { "value": "15", "type": "spacing" },
          "s": { "value": "20", "type": "spacing" },
          "m": { "value": "40", "type": "spacing" }
        },
        "vertical": {
          "default": {
            "mobile": { "value": "40", "type": "spacing" },
            "m": { "value": "70", "type": "spacing" }
          },
          "xsmall": {
            "mobile": { "value": "20", "type": "spacing" },
            "m": { "value": "25", "type": "spacing" }
          },
          "small": {
            "mobile": { "value": "40", "type": "spacing" },
            "m": { "value": "45", "type": "spacing" }
          },
          "large": {
            "mobile": { "value": "70", "type": "spacing" },
            "m": { "value": "140", "type": "spacing" }
          },
          "xlarge": {
            "mobile": { "value": "140", "type": "spacing" },
            "m": { "value": "210", "type": "spacing" }
          }
        }
      }
    },
    "column": {
      "gutter": {
        "mobile": { "value": "20", "type": "spacing" },
        "l": { "value": "40", "type": "spacing" }
      }
    },
    "element": {
      "margin": {
        "default": {
          "mobile": { "value": "15", "type": "spacing" },
          "l": { "value": "20", "type": "spacing" }
        },
        "xsmall": {
          "mobile": { "value": "3", "type": "spacing" },
          "l": { "value": "5", "type": "spacing" }
        },
        "small": {
          "mobile": { "value": "5", "type": "spacing" },
          "l": { "value": "10", "type": "spacing" }
        },
        "medium": {
          "mobile": { "value": "20", "type": "spacing" },
          "l": { "value": "40", "type": "spacing" }
        },
        "large": {
          "mobile": { "value": "40", "type": "spacing" },
          "l": { "value": "70", "type": "spacing" }
        },
        "xlarge": {
          "mobile": { "value": "70", "type": "spacing" },
          "l": { "value": "140", "type": "spacing" }
        }
      }
    }
  },
  "sizing": {
    "container": {
      "maxWidth": {
        "default": { "value": "1920", "type": "sizing" },
        "xsmall": { "value": "750", "type": "sizing" },
        "small": { "value": "900", "type": "sizing" },
        "large": { "value": "1400", "type": "sizing" },
        "xlarge": { "value": "1600", "type": "sizing" }
      }
    },
    "element": {
      "width": {
        "small": { "value": "150", "type": "sizing" },
        "medium": { "value": "300", "type": "sizing" },
        "large": { "value": "450", "type": "sizing" },
        "xlarge": { "value": "600", "type": "sizing" },
        "2xlarge": { "value": "750", "type": "sizing" }
      }
    }
  },
  "typography": {
    "fontSize": {
      "base": { "value": "16", "type": "fontSizes" }
    },
    "heading": {
      "3xlarge": {
        "mobile": { "value": "32", "type": "fontSizes" },
        "desktop": { "value": "48", "type": "fontSizes" },
        "fontWeight": { "value": "700", "type": "fontWeights" }
      },
      "2xlarge": {
        "mobile": { "value": "24", "type": "fontSizes" },
        "desktop": { "value": "36", "type": "fontSizes" },
        "fontWeight": { "value": "700", "type": "fontWeights" }
      },
      "xlarge": {
        "mobile": { "value": "20", "type": "fontSizes" },
        "desktop": { "value": "28", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "large": {
        "mobile": { "value": "18", "type": "fontSizes" },
        "desktop": { "value": "24", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "medium": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "20", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      },
      "small": {
        "mobile": { "value": "14", "type": "fontSizes" },
        "desktop": { "value": "18", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      }
    },
    "button": {
      "default": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "18", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "primary": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "18", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "secondary": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "18", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "danger": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "18", "type": "fontSizes" },
        "fontWeight": { "value": "600", "type": "fontWeights" }
      },
      "text": {
        "mobile": { "value": "14", "type": "fontSizes" },
        "desktop": { "value": "16", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      },
      "link": {
        "mobile": { "value": "14", "type": "fontSizes" },
        "desktop": { "value": "16", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      }
    },
    "navbar": {
      "link": {
        "mobile": { "value": "14", "type": "fontSizes" },
        "desktop": { "value": "16", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      }
    },
    "text": {
      "default": {
        "mobile": { "value": "14", "type": "fontSizes" },
        "desktop": { "value": "16", "type": "fontSizes" },
        "fontWeight": { "value": "400", "type": "fontWeights" }
      },
      "small": {
        "mobile": { "value": "12", "type": "fontSizes" },
        "desktop": { "value": "14", "type": "fontSizes" },
        "fontWeight": { "value": "400", "type": "fontWeights" }
      },
      "large": {
        "mobile": { "value": "16", "type": "fontSizes" },
        "desktop": { "value": "20", "type": "fontSizes" },
        "fontWeight": { "value": "500", "type": "fontWeights" }
      }
    }
  }
}
```

### Importing the Template into Tokens Studio

1. Copy the JSON above and save it as `tokens.json`
2. In Tokens Studio, click **Tools** (gear icon) → **Load from file**
3. Select your `tokens.json` file
4. Your tokens are now ready to customize and use in Figma

---

## Tips for Designers

1. **Use Tokens in Figma** – Apply tokens directly to your design elements so values update automatically when tokens change.

2. **Maintain naming conventions** – Keep the exact token paths as shown in this guide. The WordPress plugin expects these specific paths.

3. **Numbers are strings** – Dimension values (breakpoints, sizes) should be stored as strings (e.g., `"600"` not `600`).

4. **Color format** – Use hex colors (e.g., `#303033`). The plugin will sanitize other formats.

5. **Export regularly** – After design changes, export and re-import to WordPress to keep everything synchronized.

---

For more information about Tokens Studio, visit the [official documentation](https://docs.tokens.studio/).
