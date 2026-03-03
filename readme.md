# Enhanced Plugin Bundle and Theme Manager

**Version:** 4.0  
**Author:** Stavrov  
**Author URI:** [https://github.com/PinkFlamingoz](https://github.com/PinkFlamingoz)  
**Requires PHP:** 7.4+  
**Text Domain:** `enhanced-plugin-bundle`

A WordPress plugin that centralizes plugin management and provides a powerful component-based UIkit theming system for YOOtheme child themes. Design your theme visually with 68 UIkit components, 1100+ Less variables, live preview, and seamless Figma/Tokens Studio integration.

---

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Plugin Bundle Management](#plugin-bundle-management)
  - [Theme Management](#theme-management)
  - [Component-Based Theming](#component-based-theming)
  - [Tokens Studio Integration](#tokens-studio-integration)
- [Architecture](#architecture)
- [Component Reference](#component-reference)
- [Developer Notes](#developer-notes)
- [CLI Tools](#cli-tools)
- [License](#license)

---

## Features

### Plugin Management

- **Curated bundle management** – Maintain a list of recommended plugins with real-time status badges
- **Bulk plugin actions** – Install, activate, deactivate, delete, or unregister multiple plugins at once
- **WordPress.org discovery** – Add plugins by pasting a WordPress.org URL
- **Automatic detection** – Plugin main files are auto-detected after installation
- **AJAX-powered** – Real-time feedback for all operations

### Theme Management

- **YOOtheme Pro upload** – Upload and install YOOtheme Pro via the WordPress Filesystem API
- **Child theme generator** – Generate a YOOtheme-compatible child theme (`ppmchildtheme`)
- **Automatic CSS generation** – Child theme CSS is regenerated when settings change

### Component-Based Theming

- **68 UIkit components** – Full coverage of UIkit's component library
- **1100+ Less variables** – Every UIkit variable is customizable
- **Semantic grouping** – Variables organized by function (Colors, Sizing, Typography, etc.)
- **Live preview** – See changes instantly with browser-based Less.js compilation
- **Multiple field types** – Color pickers, text inputs, dropdowns, number fields
- **Reference resolution** – See resolved values for Less variable references
- **Reset to defaults** – Reset individual fields or entire components
- **Persistent state** – Settings saved per-component in WordPress options

### Design Token Integration

- **Tokens Studio for Figma** – Import/export design tokens directly from Figma
- **Bidirectional sync** – Export WordPress settings to Figma, import Figma tokens to WordPress
- **Automatic mapping** – Token names map to UIkit Less variables automatically
- **Component-aware import** – Tokens are distributed to the correct UIkit components
- **JSON import/export** – Full component settings backup and restore

---

## Installation

1. **Copy the plugin**  
   Extract or clone the repository into `/wp-content/plugins/epb-plugin-bundle/`

2. **Install TGM Plugin Activation**  
   Download `class-tgm-plugin-activation.php` from [TGM Plugin Activation](https://github.com/TGMPA/TGM-Plugin-Activation) and place it in the `vendor/` directory

3. **Activate the plugin**  
   Navigate to **Plugins → Installed Plugins** and activate **Enhanced Plugin Bundle and Theme Manager**

4. **Prepare YOOtheme Pro** (optional)  
   Have the latest YOOtheme Pro ZIP ready for upload

5. **Verify permissions**  
   Confirm WordPress can write to `/wp-content/themes/` for child theme creation

---

## Usage

After activation, a **Plugin Bundle** menu appears in the WordPress admin sidebar.

### Plugin Bundle Management

| Action | Description |
|--------|-------------|
| **Install** | Downloads from WordPress.org if not installed |
| **Activate** | Activates the plugin (installs first if needed) |
| **Deactivate** | Deactivates without removing files |
| **Delete** | Removes plugin files from filesystem |
| **Delete from List** | Removes from bundle without touching installed files |

**Add new plugins:** Paste a WordPress.org plugin URL (e.g., `https://wordpress.org/plugins/wordpress-seo/`)

### Theme Management

1. **Upload YOOtheme Pro** – Use the upload panel to install YOOtheme Pro
2. **Status indicator** – Shows whether YOOtheme is installed and active

### Component-Based Theming

The Component Picker provides a visual interface for customizing UIkit variables:

#### Navigation

- **Category sidebar** – Components organized into 8 categories
- **Search** – Filter components by name
- **Modified indicators** – Dots show which components have customizations

#### Editing

1. **Select a component** – Click to load its variables
2. **Expand groups** – Variables are organized into semantic groups
3. **Edit values** – Use color pickers, dropdowns, or text inputs
4. **View resolved values** – See the computed value for Less references
5. **Reset** – Click the reset button to restore defaults

#### Preview

- **Live Preview tab** – See component changes in real-time
- **CSS Output tab** – View the generated CSS

#### Saving

- **Save Changes** – Save the current component
- **Save All** – Save all modified components at once
- **Reset All** – Reset all components to UIkit defaults

### Tokens Studio Integration

#### Export to Figma

1. Click the **Export for Figma** button (arrow-up icon)
2. A JSON file downloads with all component variables
3. Import into Tokens Studio in Figma

#### Import from Figma

1. Click the **Import from Figma** button (arrow-down icon)
2. Paste your Tokens Studio JSON export
3. Click **Import** to apply tokens to components

#### JSON Backup

- **Export All (JSON)** – Download complete component settings
- **Import (JSON)** – Restore from a previous export

#### Create Child Theme

1. Click the **Create Child Theme** button (folder icon)
2. The child theme is created/updated with your CSS
3. The child theme is automatically activated

---

## Architecture

```
enhanced-plugin-bundle.php          # Bootstrap file
includes/
├── class-autoloader.php            # PSR-4 autoloader
├── Admin/
│   └── class-controller.php        # Admin page routing
├── Ajax/
│   ├── class-handler.php           # Core AJAX handler
│   ├── class-plugin-actions.php    # Plugin management
│   ├── class-token-actions.php     # Token import/export
│   ├── class-component-handler.php # Component AJAX router
│   ├── class-component-loader.php  # Load component fields
│   ├── class-component-saver.php   # Save component settings
│   ├── class-component-importer.php # Import JSON settings
│   ├── class-component-exporter.php # Export JSON settings
│   └── class-child-theme-actions.php # Child theme AJAX
├── Core/
│   ├── class-plugin.php            # Main orchestrator
│   ├── class-activator.php         # Activation hooks
│   ├── class-deactivator.php       # Deactivation hooks
│   ├── class-notices.php           # Admin notices
│   ├── class-capabilities.php      # User capabilities
│   └── class-upgrader.php          # Version upgrades
├── CSS/
│   ├── class-less-parser.php       # Parse UIkit Less files
│   ├── class-component-registry.php # Component metadata
│   └── class-generator.php         # Generate CSS output
├── Plugins/
│   ├── class-manager.php           # Plugin bundle logic
│   ├── class-installer.php         # Install/activate/delete
│   ├── class-options.php           # Plugin list storage
│   └── class-renderer.php          # Plugin table UI
├── Themes/
│   ├── class-manager.php           # Theme operations
│   ├── class-uploader.php          # Theme ZIP handling
│   ├── class-child-theme.php       # Child theme generation
│   └── Renderer/
│       ├── class-main-renderer.php     # Component picker UI
│       ├── class-dynamic-renderer.php  # Field rendering
│       └── class-preview-renderer.php  # Component previews
├── Tokens/
│   ├── class-tokens-studio-importer.php # Import from Figma
│   └── class-tokens-studio-exporter.php # Export to Figma
└── Contracts/
    ├── interface-installer.php
    ├── interface-manager.php
    ├── interface-options.php
    └── interface-renderer.php

admin/views/
├── admin-page.php              # Main admin template
└── partials/
    ├── header.php              # Page header
    ├── footer.php              # Page footer
    ├── component-picker.php    # Component picker UI
    └── component-preview.php   # Preview iframe template

assets/
├── css/
│   ├── admin.css               # Admin styles
│   └── component-picker.css    # Component picker styles
└── js/
    ├── admin.js                # Plugin table JS
    └── component-picker.js     # Component picker JS

docs/uikit-less-consolidated/   # Consolidated UIkit Less variables (from all layers)
    ├── variables.less          # Global variables
    ├── base.less               # Base styles
    ├── button.less             # Button component
    └── ... (68 component files)

tools/                          # CLI maintenance tools
    ├── add-less-groups.php     # Validate @group annotations
    ├── compile-mo.php          # Compile translation files
    ├── download-uikit-examples.php # Fetch component previews
    └── merge-previews.php      # Merge preview methods
```

---

## Component Reference

### Categories

| Category | Components |
|----------|------------|
| **Foundation** | Global, Base, Inverse |
| **Layout** | Container, Section, Grid, Flex, Tile, Column, Width, Height, Padding, Margin, Position |
| **Navigation** | Nav, Navbar, Subnav, Tab, Breadcrumb, Pagination, Dotnav, Slidenav, Thumbnav, Iconnav |
| **Content** | Card, Article, Comment, List, Description List, Table, Heading, Text, Link, Label, Badge, Icon |
| **Forms** | Form, Form Range, Button, Search |
| **Overlays** | Modal, Dropdown, Offcanvas, Tooltip, Notification, Alert |
| **Media** | Lightbox, Slideshow, Slider, Cover, Overlay, Transition, Animation |
| **Utilities** | Utility, Close, Marker, Totop, Spinner, Placeholder, Divider, Progress, Countdown, Leader, Print, Visibility, SVG, Sticky, Sortable, Drop, Dropbar, Dropnav, Switcher |

### Variable Groups

Variables within each component are organized into semantic groups:

| Group | Description |
|-------|-------------|
| **Colors** | Background, text, and border colors |
| **Sizing** | Width, height, padding, margin |
| **Typography** | Font family, size, weight, line height |
| **Border** | Border width, radius, style |
| **Spacing** | Internal padding and margins |
| **Animation** | Transitions, durations, timing |

### Field Types

| Type | Used For |
|------|----------|
| **Color** | Hex color values (`#ffffff`) |
| **Text** | Strings, CSS values |
| **Number** | Numeric values with units |
| **Select** | Predefined options (fonts, weights) |
| **Dimension** | Sizes with `px`, `rem`, `%` units |

---

## Developer Notes

### Security

- All endpoints validate nonces and user capabilities
- Input sanitized with `sanitize_text_field`, `sanitize_hex_color`
- File operations use WordPress Filesystem API
- ABSPATH check on all PHP files

### Coding Standards

- PHP 7.4+ with typed properties and return types
- PSR-4 autoloading with `EPB\` namespace
- Interface contracts for extensibility
- Translation-ready with `enhanced-plugin-bundle` text domain

### Hooks

```php
// Fired when component settings are saved
do_action('epb_component_settings_updated', $component, $settings);

// AJAX actions
add_action('wp_ajax_epb_plugin_action', ...);
add_action('wp_ajax_epb_load_component', ...);
add_action('wp_ajax_epb_save_component', ...);
add_action('wp_ajax_epb_export_figma', ...);
add_action('wp_ajax_epb_import_figma', ...);
add_action('wp_ajax_epb_create_child_theme', ...);
```

### Less Variable Annotations

UIkit Less files use `@group` annotations for variable organization:

```less
// @group: Colors
@button-primary-background: #1e87f0;
@button-primary-color: #fff;

// @group: Sizing
@button-padding-horizontal: 20px;
@button-line-height: 38px;
```

### Debugging

Enable `WP_DEBUG` and `WP_DEBUG_LOG` to troubleshoot:
- File operations
- Plugin installations
- Theme generation
- Token imports

---

## CLI Tools

Located in `tools/` directory:

| Tool | Description |
|------|-------------|
| `add-less-groups.php` | Validate @group annotations in Less files |
| `compile-mo.php` | Compile .po translation files to .mo |
| `download-uikit-examples.php` | Fetch UIkit component examples |
| `merge-previews.php` | Merge preview methods into renderer |

Run from command line:
```bash
php tools/add-less-groups.php
php tools/compile-mo.php
```

---

## Translation

The plugin is fully translatable:

- **Text domain:** `enhanced-plugin-bundle`
- **POT file:** `languages/enhanced-plugin-bundle.pot`
- **Translations:** `languages/enhanced-plugin-bundle-{locale}.po`
- **144 translatable strings**

Compile translations:
```bash
php tools/compile-mo.php
```

---

## License

Copyright © Hristijan Stavrov. All rights reserved. See [LICENCE.md](LICENCE.md) for details.

---

Happy theming! 🎨
