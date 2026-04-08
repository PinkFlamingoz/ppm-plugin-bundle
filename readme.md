# Enhanced Plugin Bundle and Theme Manager

**Version:** 4.2  
**Author:** Stavrov  
**Author URI:** [https://github.com/PinkFlamingoz](https://github.com/PinkFlamingoz)  
**Requires PHP:** 7.4+  
**Text Domain:** `enhanced-plugin-bundle`

A WordPress plugin that centralizes plugin management and provides a powerful component-based UIkit theming system for YOOtheme child themes. Design your theme visually with 74 UIkit components, 5300+ Less variables, fluid typography, font management, server-side Less compilation, live preview, and seamless Figma/Tokens Studio integration.

---

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Plugin Bundle Management](#plugin-bundle-management)
  - [Theme Management](#theme-management)
  - [Component-Based Theming](#component-based-theming)
  - [Font Management](#font-management)
  - [Fluid Typography](#fluid-typography)
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
- **Child theme generator** – Generate a YOOtheme-compatible child theme (`YOOthemechildtheme`)
- **Automatic CSS regeneration** – Child theme CSS and Less files are regenerated when component settings change
- **Child theme branding** – Configurable theme name, company name, URL, logo, description, and version
- **Login page branding** – Custom logo, URL, and site name on the WordPress login screen
- **YOOtheme Style Library** – Generated Less file appears as a style in YOOtheme's Style Library
- **Automatic recompilation** – Config module triggers YOOtheme CSS recompilation on changes

### Component-Based Theming

- **74 UIkit components** – Full coverage of UIkit's component library across 11 categories
- **5300+ Less variables** – Every UIkit variable is customizable across 72 consolidated Less files
- **Semantic grouping** – Variables organized by function (Colors, Sizing, Typography, Border, Spacing, Animation)
- **Server-side Less compilation** – Real-time preview via `wikimedia/less.php` with advanced preprocessing
- **Live preview** – See component changes in real-time with compiled CSS output
- **Multiple field types** – Color pickers, text inputs, dropdowns, number fields, dimension fields
- **Reference resolution** – See resolved values for Less variable references (up to 10 levels deep)
- **Reference re-assertions** – Overridden globals correctly cascade to all dependent variables
- **Reset to defaults** – Reset individual fields or entire components
- **Persistent state** – Settings saved per-component in WordPress options

### Font Management

- **Custom font uploads** – Upload WOFF2, WOFF, TTF, and OTF files (validated by magic bytes, max 5 MB)
- **Google Fonts** – Add Google Font families with specific weights, builds API v2 stylesheet URLs
- **Adobe Fonts (Typekit)** – Load Adobe Fonts by providing a project URL
- **Automatic `@font-face` generation** – Custom fonts produce CSS with both absolute and relative URLs
- **Font-aware CSS** – Font faces are embedded in child theme `custom.css` and `style.less`
- **AJAX management** – Upload, update, and delete fonts without page reloads

### Fluid Typography

- **CSS `clamp()` responsive sizing** – Font sizes scale smoothly between 640px and 1200px breakpoints
- **200+ typography variables** – Covers global, base, headings, text utilities, buttons, navbar, forms, and all components
- **Configurable scale ratios** – Separate ratios for standard elements (0.85), navbar (0.85), navigation (0.85), navbar gap (0.50), and accordion (0.85)
- **Accordion-aware fluid typography** – Accordion titles use a dedicated scale ratio with CSS specificity matching YOOtheme's `.uk-accordion-default .uk-accordion-title` selector
- **Math expression evaluation** – Resolves expressions like `2.625rem * 0.85` with unit preservation
- **Hyphenation support** – Optional CSS hyphenation for headings and text elements

### Settings Backup & Recovery

- **Automatic JSON backup** – All settings (components, fluid ratios, fonts, branding, hyphenation) are backed up to `epb-settings-backup.json` in the child theme directory on every save
- **Survives plugin delete/reinstall** – The backup file lives in the child theme, which is preserved when the plugin is deleted
- **Two-tier recovery** – On activation, the plugin first tries JSON backup recovery, then falls back to parsing the child theme's Less file for older installs
- **Automatic backup seeding** – Existing installs without a backup file get one auto-created on the next page load via the Upgrader
- **Safety-net recovery** – The `plugins_loaded` hook provides a second recovery attempt if the activation hook didn't fire

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

2. **Install dependencies**  
   Run `composer install` to install `wikimedia/less.php` for server-side Less compilation

3. **Install TGM Plugin Activation**  
   Download `class-tgm-plugin-activation.php` from [TGM Plugin Activation](https://github.com/TGMPA/TGM-Plugin-Activation) and place it in the `vendor/` directory

4. **Activate the plugin**  
   Navigate to **Plugins → Installed Plugins** and activate **Enhanced Plugin Bundle and Theme Manager**

5. **Prepare YOOtheme Pro** (optional)  
   Have the latest YOOtheme Pro ZIP ready for upload

6. **Verify permissions**  
   Confirm WordPress can write to `/wp-content/themes/` for child theme creation and `/wp-content/uploads/epb-fonts/` for custom font uploads

---

## Usage

After activation, a **Plugin Bundle** menu appears in the WordPress admin sidebar.

### Plugin Bundle Management

| Action               | Description                                          |
| -------------------- | ---------------------------------------------------- |
| **Install**          | Downloads from WordPress.org if not installed        |
| **Activate**         | Activates the plugin (installs first if needed)      |
| **Deactivate**       | Deactivates without removing files                   |
| **Delete**           | Removes plugin files from filesystem                 |
| **Delete from List** | Removes from bundle without touching installed files |

**Add new plugins:** Paste a WordPress.org plugin URL (e.g., `https://wordpress.org/plugins/wordpress-seo/`)

### Theme Management

1. **Upload YOOtheme Pro** – Use the upload panel to install YOOtheme Pro
2. **Status indicator** – Shows whether YOOtheme is installed and active

### Component-Based Theming

The Component Picker provides a visual interface for customizing UIkit variables:

#### Navigation

- **Category sidebar** – Components organized into 11 categories
- **Search** – Filter components by name
- **Modified indicators** – Dots show which components have customizations

#### Editing

1. **Select a component** – Click to load its variables
2. **Expand groups** – Variables are organized into semantic groups
3. **Edit values** – Use color pickers, dropdowns, or text inputs
4. **View resolved values** – See the computed value for Less references
5. **Reset** – Click the reset button to restore defaults

#### Preview

- **Live Preview tab** – See component changes in real-time via server-side Less compilation
- **CSS Output tab** – View the generated CSS
- **Debug mode** – Error context with line numbers and surrounding code for troubleshooting

#### Saving

- **Save Changes** – Save the current component
- **Save All** – Save all modified components at once
- **Reset All** – Reset all components to UIkit defaults

### Font Management

#### Custom Fonts

1. Upload font files (WOFF2, WOFF, TTF, OTF) via the font management panel
2. Set the font family name, weight, and style (normal/italic/oblique)
3. Fonts are stored in `/wp-content/uploads/epb-fonts/` with directory protection
4. `@font-face` CSS is automatically generated and enqueued on the frontend

#### Google Fonts

1. Add a Google Font family name and desired weights (100–900)
2. The Google Fonts API v2 stylesheet is automatically enqueued
3. Duplicate family names are prevented (case-insensitive matching)

#### Adobe Fonts

1. Enable Adobe Fonts and enter your Typekit project URL
2. The stylesheet is automatically enqueued on the frontend

### Fluid Typography

- Fluid scale ratios are configurable in the component picker settings
- Typography scales smoothly from mobile (640px) to desktop (1200px) using CSS `clamp()`
- Hyphenation can be toggled on/off for headings and text elements

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
2. The child theme is created/updated with your CSS and Less files
3. The child theme is automatically activated

**Generated child theme structure:**

```
wp-content/themes/YOOthemechildtheme/
├── style.css                    # Root stylesheet with branding header
├── functions.php                # Parent/child enqueue, login branding, access controls
├── config.php                   # YOOtheme module for auto recompilation
├── epb-settings-backup.json     # Settings backup (survives plugin delete/reinstall)
├── css/
│   └── custom.css               # Generated CSS (fluid typography, font faces, variables)
└── less/
    └── theme.ct-style.less      # YOOtheme Style Library Less file
```

---

## Architecture

```
enhanced-plugin-bundle.php          # Bootstrap, constants, init hooks
includes/
├── class-autoloader.php            # PSR-4 autoloader for EPB\ namespace
├── Admin/
│   └── class-controller.php        # Admin page routing and asset enqueue
├── Ajax/
│   ├── class-handler.php           # Main AJAX hub, registers all action hooks
│   ├── class-plugin-actions.php    # Plugin install/activate/deactivate/delete
│   ├── class-token-actions.php     # Tokens Studio import/export
│   ├── class-component-handler.php # Component AJAX coordinator
│   ├── class-component-loader.php  # Load component fields and previews
│   ├── class-component-saver.php   # Save/reset component variables
│   ├── class-component-importer.php # Import JSON component settings
│   ├── class-component-exporter.php # Export JSON component settings
│   ├── class-child-theme-actions.php # Child theme creation AJAX
│   ├── class-font-handler.php      # Custom/Google font AJAX operations
│   └── class-preview-compiler.php  # Server-side Less compilation for live preview
├── Core/
│   ├── class-activator.php         # Activation hooks, defaults, and settings recovery
│   ├── class-deactivator.php       # Deactivation cleanup
│   ├── class-upgrader.php          # Version migration routines and backup seeding
│   ├── class-constants.php         # Centralized option keys and defaults
│   ├── class-capabilities.php      # Custom capabilities (manage_plugins, manage_themes, access_settings)
│   ├── class-notices.php           # Admin notice system (immediate and queued)
│   ├── class-utils.php             # Shared utilities (Less normalization, color conversion)
│   ├── class-custom-font.php       # Custom font upload, validation, @font-face generation
│   ├── class-google-font.php       # Google Fonts API v2 URL builder and enqueue
│   └── class-adobe-font.php        # Adobe Fonts (Typekit) conditional enqueue
├── CSS/
│   ├── class-less-parser.php       # Parse UIkit Less files, extract variables with caching
│   ├── class-component-registry.php # 74 components in 11 categories with metadata
│   ├── class-less-compiler.php     # wikimedia/less.php wrapper with preprocessing
│   ├── class-component-less-builder.php # Assemble Less source with variable cascading
│   └── class-generator.php         # CSS custom properties, fluid typography, hyphenation
├── Plugins/
│   ├── class-manager.php           # Plugin bundle orchestrator
│   ├── class-installer.php         # Plugin install/activate/delete executor
│   ├── class-options.php           # Plugin list storage in wp_options
│   └── class-renderer.php          # Plugin table UI and bulk controls
├── Themes/
│   ├── class-manager.php           # Theme operations orchestrator
│   ├── class-uploader.php          # Theme ZIP upload and installation
│   ├── class-child-theme.php       # Child theme generation, branding, auto-regeneration, settings backup
│   └── Renderer/
│       ├── class-main-renderer.php     # Component picker UI shell
│       ├── class-dynamic-renderer.php  # Dynamic form field generator
│       └── class-preview-renderer.php  # Component HTML preview generator
└── Tokens/
    ├── class-tokens-studio-importer.php # Import Tokens Studio JSON from Figma
    └── class-tokens-studio-exporter.php # Export UIkit variables to Tokens Studio format

admin/views/
├── admin-page.php              # Main admin template
└── partials/
    ├── header.php              # Page header with notices
    ├── footer.php              # Page footer with version
    ├── component-picker.php    # Component picker interface
    └── component-preview.php   # Preview iframe template

assets/
├── css/
│   ├── admin.css               # Admin styles
│   └── component-picker.css    # Component picker styles
├── images/
│   └── plappermaullogo_header_horizontal.png
└── js/
    ├── admin.js                # Plugin table JS
    └── component-picker.js     # Component picker JS

docs/
├── COLOR-VARIABLES.md          # Color variable reference
├── FONT-TYPOGRAPHY-VARIABLES.md # Font and typography reference
├── MARGIN-PADDING-VARIABLES.md # Margin and padding reference
├── UIKIT-VARIABLES.md          # Full UIkit variable reference
├── tokens-studio-setup.md      # Tokens Studio setup guide
├── uikit-examples/             # 95+ component example files (JSON + Markdown)
└── uikit-less-consolidated/    # 72 consolidated Less files (all UIkit layers merged)

tools/                          # CLI and maintenance tools
├── add-less-groups.php         # Validate @group annotations in Less files
├── compile-mo.php              # Compile .po translation files to .mo
├── consolidate-less-variables.ps1 # Extract all UIkit variables from YOOtheme source
├── download-uikit-examples.php # Fetch UIkit component examples from docs
├── generate-variables-doc.php  # Auto-generate variable documentation
├── merge-previews.php          # Merge preview methods into renderer
└── sync-less-groups.php        # Sync @group annotations after UIkit updates

vendor/                         # Composer dependencies
├── autoload.php
├── class-tgm-plugin-activation.php
└── wikimedia/                  # wikimedia/less.php (Less compiler)
```

---

## Component Reference

### Categories (11)

| Category        | Components                                                                                                               | Count |
| --------------- | ------------------------------------------------------------------------------------------------------------------------ | ----- |
| **Foundation**  | Global, Base, Inverse                                                                                                    | 3     |
| **Layout**      | Container, Section, Grid, Flex, Tile, Card, Width, Height, Margin, Padding, Position, Column                             | 14    |
| **Navigation**  | Nav, Navbar, Subnav, Breadcrumb, Pagination, Tab, Dropdown, Drop, Dropbar, Dropnav, Offcanvas                            | 11    |
| **Elements**    | Button, Icon, Badge, Label, Alert, Close, Divider, Heading, Link, Marker, Overlay, Placeholder, Spinner, Totop, Progress | 15    |
| **Forms**       | Form, Form Range, Search                                                                                                 | 3     |
| **Content**     | Article, Comment, Description List, List, Table, Text                                                                    | 6     |
| **Media**       | Cover, Lightbox, Slider, Slideshow, SVG                                                                                  | 5     |
| **Interactive** | Accordion, Modal, Notification, Tooltip, Sortable, Sticky, Switcher                                                      | 7     |
| **Indicators**  | Dotnav, Slidenav, Iconnav, Thumbnav                                                                                      | 4     |
| **Animation**   | Animation, Transition                                                                                                    | 2     |
| **Utilities**   | Align, Background, Utility, Visibility, Leader, Countdown                                                                | 6     |

**Total: 74 components, 5300+ Less variables**

### Variable Groups

Variables within each component are organized into semantic groups:

| Group          | Description                            |
| -------------- | -------------------------------------- |
| **Colors**     | Background, text, and border colors    |
| **Sizing**     | Width, height, padding, margin         |
| **Typography** | Font family, size, weight, line height |
| **Border**     | Border width, radius, style            |
| **Spacing**    | Internal padding and margins           |
| **Animation**  | Transitions, durations, timing         |

### Field Types

| Type          | Used For                            |
| ------------- | ----------------------------------- |
| **Color**     | Hex color values (`#ffffff`)        |
| **Text**      | Strings, CSS values                 |
| **Number**    | Numeric values with units           |
| **Select**    | Predefined options (fonts, weights) |
| **Dimension** | Sizes with `px`, `rem`, `%` units   |

---

## Developer Notes

### Security

- All AJAX endpoints validate nonces and user capabilities
- Three custom capabilities: `epb_manage_plugins`, `epb_manage_themes`, `epb_access_settings`
- Input sanitized with `sanitize_text_field`, `sanitize_hex_color`
- Font uploads validated by magic bytes (not just file extension), max 5 MB
- File operations use WordPress Filesystem API
- Direct access protection on all PHP files
- Clean uninstall removes all options, transients, and capabilities (preserves child theme and settings backup)

### Coding Standards

- PHP 7.4+ with typed properties and return types
- PSR-4 autoloading with `EPB\` namespace
- Centralized constants via `EPB\Core\Constants`
- Translation-ready with `enhanced-plugin-bundle` text domain

### Less Compilation Pipeline

The server-side Less compiler (`EPB\CSS\Less_Compiler`) includes preprocessing to handle compatibility:

1. Removes BOM characters
2. Converts `//` comments to `/* */` (preserves URLs and strings)
3. Escapes modern CSS pseudo-classes (`:is()`, `:where()`, `:has()`)
4. Escapes color functions containing CSS `var()` references
5. Expands 2-arg `rgba()` shorthand to 4-arg form
6. Extracts unsupported `@property` blocks

Import paths are automatically configured for YOOtheme UIkit source, components, theme Less, and plugin consolidated files.

### Hooks

```php
// Fired when component settings are saved (triggers CSS regeneration)
do_action('epb_component_settings_updated', $component, $settings);

// Filter child theme header metadata
apply_filters('epb_child_theme_header', $header);

// Filter child theme branding (logo, company info)
apply_filters('epb_child_theme_branding', $branding);

// Filter Less style metadata (name, colors, type)
apply_filters('epb_less_style_metadata', $metadata);

// AJAX actions
add_action('wp_ajax_epb_plugin_action', ...);
add_action('wp_ajax_epb_load_component', ...);
add_action('wp_ajax_epb_save_component', ...);
add_action('wp_ajax_epb_compile_preview', ...);
add_action('wp_ajax_epb_export_figma', ...);
add_action('wp_ajax_epb_import_figma', ...);
add_action('wp_ajax_epb_create_child_theme', ...);
add_action('wp_ajax_epb_upload_custom_font', ...);
add_action('wp_ajax_epb_delete_custom_font', ...);
add_action('wp_ajax_epb_update_custom_font', ...);
add_action('wp_ajax_epb_get_custom_fonts', ...);
add_action('wp_ajax_epb_add_google_font', ...);
add_action('wp_ajax_epb_update_google_font', ...);
add_action('wp_ajax_epb_delete_google_font', ...);
```

### WordPress Options

| Option Key                         | Description                     |
| ---------------------------------- | ------------------------------- |
| `epb_component_{name}`             | Per-component variable settings |
| `epb_fluid_scale_ratio`            | Fluid typography scale ratio    |
| `epb_fluid_scale_ratio_navbar`     | Navbar-specific scale ratio     |
| `epb_fluid_scale_ratio_nav`        | Navigation-specific scale ratio |
| `epb_fluid_scale_ratio_navbar_gap` | Navbar gap scale ratio          |
| `epb_fluid_scale_ratio_accordion`  | Accordion-specific scale ratio  |
| `epb_hyphenation_enabled`          | CSS hyphenation toggle          |
| `epb_adobe_font_enabled`           | Adobe Fonts on/off              |
| `epb_adobe_font_url`               | Adobe Fonts project URL         |
| `epb_custom_fonts`                 | Custom font metadata array      |
| `epb_google_fonts`                 | Google Fonts configuration      |
| `epb_branding`                     | Child theme branding settings   |

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

- File operations and font uploads
- Plugin installations
- Theme and child theme generation
- Token imports/exports
- Less compilation errors (with line numbers and surrounding code context)

The preview compiler supports a `debug` flag that returns timestamps, override keys, requirements checks, UIkit file existence, and Less source details.

---

## CLI Tools

Located in `tools/` directory:

| Tool                             | Description                                                   |
| -------------------------------- | ------------------------------------------------------------- |
| `add-less-groups.php`            | Validate `@group` annotations in Less files                   |
| `compile-mo.php`                 | Compile `.po` translation files to `.mo`                      |
| `consolidate-less-variables.ps1` | Extract all UIkit variables from YOOtheme source (PowerShell) |
| `download-uikit-examples.php`    | Fetch UIkit component examples from documentation             |
| `generate-variables-doc.php`     | Auto-generate variable documentation from Less files          |
| `merge-previews.php`             | Merge preview methods into renderer                           |
| `sync-less-groups.php`           | Sync `@group` annotations after UIkit updates                 |

Run from command line:

```bash
php tools/add-less-groups.php
php tools/compile-mo.php
php tools/generate-variables-doc.php
php tools/sync-less-groups.php
php tools/download-uikit-examples.php
php tools/merge-previews.php
```

```powershell
# Extract variables from YOOtheme UIkit source
.\tools\consolidate-less-variables.ps1
```

---

## Documentation

Additional documentation is available in the `docs/` directory:

| Document                       | Description                                          |
| ------------------------------ | ---------------------------------------------------- |
| `COLOR-VARIABLES.md`           | Color variable reference and usage                   |
| `FONT-TYPOGRAPHY-VARIABLES.md` | Font and typography variable reference               |
| `MARGIN-PADDING-VARIABLES.md`  | Margin and padding variable reference                |
| `UIKIT-VARIABLES.md`           | Complete UIkit variable reference                    |
| `tokens-studio-setup.md`       | Tokens Studio / Figma integration guide              |
| `uikit-examples/`              | 95+ component examples (JSON + Markdown)             |
| `uikit-less-consolidated/`     | 72 consolidated Less files (all UIkit layers merged) |

---

## Translation

The plugin is fully translatable:

- **Text domain:** `enhanced-plugin-bundle`
- **POT file:** `languages/enhanced-plugin-bundle.pot`
- **Translations:** `languages/enhanced-plugin-bundle-{locale}.po`

Compile translations:

```bash
php tools/compile-mo.php
```

---

## License

Copyright © Hristijan Stavrov. All rights reserved. See [LICENCE.md](LICENCE.md) for details.

---

Happy theming! 🎨
