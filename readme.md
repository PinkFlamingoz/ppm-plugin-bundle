# Enhanced Plugin Bundle and Theme Manager

**Version:** 4.0  
**Author:** Stavrov  
**Author URI:** [https://github.com/PinkFlamingoz](https://github.com/PinkFlamingoz)  
**Requires PHP:** 7.4+  
**Text Domain:** `enhanced-plugin-bundle`

Enhanced Plugin Bundle and Theme Manager is a WordPress plugin that centralizes the setup of a curated plugin bundle and a YOOtheme-based child theme. It provides an intuitive admin interface for bulk plugin operations, parent-theme handling, design token imports from Figma, and a rich CSS customization layer that generates the child theme's stylesheet on demand.

---

## Table of Contents

- [Enhanced Plugin Bundle and Theme Manager](#enhanced-plugin-bundle-and-theme-manager)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
    - [Plugin Management](#plugin-management)
    - [Theme Management](#theme-management)
    - [Design Token Integration](#design-token-integration)
    - [Admin Experience](#admin-experience)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Plugin Bundle Management](#plugin-bundle-management)
    - [Theme Management](#theme-management-1)
    - [Child Theme Generator](#child-theme-generator)
    - [Design Token Import](#design-token-import)
  - [Architecture](#architecture)
  - [CSS Options Reference](#css-options-reference)
    - [Color Options](#color-options)
    - [Layout Options](#layout-options)
    - [Element Options](#element-options)
    - [Typography Options](#typography-options)
  - [Tokens Studio Integration](#tokens-studio-integration)
  - [Developer Notes](#developer-notes)
    - [Security](#security)
    - [Coding Standards](#coding-standards)
    - [Hooks \& Filters](#hooks--filters)
    - [Debugging](#debugging)
    - [Translation](#translation)
  - [License](#license)

---

## Features

### Plugin Management

- **Curated bundle management** – A default list of recommended plugins is stored in the database and exposed in the UI with real-time status badges.
- **Bulk plugin actions** – Apply `install`, `activate`, `deactivate`, `delete`, or `unregister` to multiple plugins at once.
- **WordPress.org discovery** – Append new plugins by pasting a WordPress.org plugin URL. Slugs are validated, duplicates are rejected.
- **Automatic init path detection** – Plugin main files are auto-detected after installation.
- **Silent bulk operations** – Bulk activations run silently to prevent plugin initialization errors during batch processing.

### Theme Management

- **YOOtheme parent upload** – Upload a YOOtheme Pro ZIP file once; the plugin extracts it through the WordPress Filesystem API.
- **Child theme generator** – Generate a YOOtheme-compatible child theme (`ppmchildtheme`) containing `style.css`, `css/custom.css`, and `functions.php`.
- **90+ CSS variables** – Design tokens drive the generated stylesheet so UIkit components inherit consistent styling.

### Design Token Integration

- **Tokens Studio support** – Import design tokens directly from Figma using the Tokens Studio plugin.
- **JSON import** – Upload token JSON files or paste raw JSON directly.
- **Bidirectional mapping** – Token paths map automatically to plugin CSS options.
- **Token export** – Export current plugin settings as Tokens Studio compatible JSON.
- **Preview before import** – See how many CSS variables will be imported before committing changes.

### Admin Experience

- **Dedicated dashboard** – A top-level "Plugin Bundle" menu combines plugin, theme, and child-theme management.
- **AJAX-powered operations** – Real-time feedback for long-running operations.
- **Drag-and-drop support** – File inputs accept drag-and-drop for theme ZIPs and token files.
- **Security-first** – Every endpoint validates nonces, sanitizes input, and checks capabilities.

---

## Installation

1. **Copy the plugin into WordPress**  
   Extract or clone the repository into `/wp-content/plugins/ppm-plugin-bundle/`.

2. **Download the TGM Plugin Activation library**  
   Download `class-tgm-plugin-activation.php` from the [TGM Plugin Activation repository](https://github.com/TGMPA/TGM-Plugin-Activation) and place it in the `vendor/` directory.

3. **Activate the plugin**  
   In WordPress, navigate to **Plugins → Installed Plugins** and activate **Enhanced Plugin Bundle and Theme Manager**.

4. **Prepare YOOtheme Pro (optional)**  
   Have the latest YOOtheme Pro ZIP ready to upload through the admin screen.

5. **Verify permissions**  
   Confirm WordPress can write to `/wp-content/themes/` for theme creation.

---

## Usage

After activation, a new **Plugin Bundle** top-level menu item appears in the WordPress sidebar.

### Plugin Bundle Management

1. **View the bundle** – The table displays all registered plugins with status badges (Installed & Active, Installed & Inactive, Not Installed).

2. **Bulk actions**:
   - **Install** – Downloads from WordPress.org if the plugin is missing.
   - **Activate** – Activates the plugin (installing first if needed).
   - **Deactivate** – Deactivates without removing files.
   - **Delete** – Removes plugin files from the filesystem.
   - **Unregister** – Removes from the managed bundle without touching installed files.

3. **Add new plugins** – Paste a WordPress.org plugin URL (e.g., `https://wordpress.org/plugins/wordpress-seo/`) to add it to your bundle.

### Theme Management

1. **Upload YOOtheme** – Use the upload panel to install YOOtheme Pro. The plugin extracts it to `/wp-content/themes/yootheme/`.

2. **Status indicator** – Shows whether YOOtheme is already installed.

### Child Theme Generator

1. **Configure design tokens** – Adjust colors, breakpoints, container settings, typography, and button styles in the admin UI.

2. **Regenerate functions.php** – Optionally regenerate the child theme's `functions.php` with the bundled template.

3. **Generate** – Click **Save Options & Create Child Theme** to:
   - Write options to the database
   - Generate `css/custom.css` with your design tokens
   - Update the root `style.css`
   - Activate the `ppmchildtheme` child theme

### Design Token Import

1. **Navigate to Child Theme** – Open the "Create Child Theme" panel.

2. **Import tokens**:
   - **Upload JSON** – Select a Tokens Studio JSON export file.
   - **Paste JSON** – Paste raw JSON into the text area.
   - **Preview** – See how many CSS variables will be imported.
   - **Import** – Apply tokens to your theme settings.

3. **Export tokens** – Click "Export Settings as Tokens" to download current settings as Tokens Studio compatible JSON.

---

## Architecture

The plugin follows a modular, namespaced architecture (PHP 7.4+):

```
enhanced-plugin-bundle.php      # Bootstrap file
includes/
├── class-autoloader.php        # PSR-4 style autoloader
├── Admin/
│   └── class-controller.php    # Admin page routing & form handling
├── Ajax/
│   └── class-handler.php       # AJAX endpoint handlers
├── Contracts/
│   ├── interface-options.php   # Options contract
│   └── interface-renderer.php  # Renderer contract
├── Core/
│   ├── class-activator.php     # Plugin activation hooks
│   └── class-plugin.php        # Main plugin orchestrator
├── CSS/
│   ├── class-generator.php     # Generates CSS output
│   ├── class-options.php       # CSS option defaults & storage
│   └── class-variables.php     # CSS variable definitions
├── Plugins/
│   ├── class-installer.php     # Plugin install/activate/delete
│   ├── class-manager.php       # Plugin bundle operations
│   ├── class-options.php       # Plugin list storage
│   └── class-renderer.php      # Plugin table UI
├── Themes/
│   ├── class-child-theme.php   # Child theme file generation
│   ├── class-manager.php       # Theme operations coordinator
│   ├── class-uploader.php      # Theme ZIP handling
│   └── Renderer/
│       ├── class-color-fields.php
│       ├── class-container-fields.php
│       ├── class-main-renderer.php
│       ├── class-spacing-fields.php
│       └── class-typography-fields.php
└── Tokens/
    ├── class-exporter.php      # Export settings as tokens
    ├── class-importer.php      # Import token JSON files
    └── class-mapper.php        # Token path ↔ option key mapping
```

---

## CSS Options Reference

The child theme's stylesheet is generated from 90+ design tokens organized into categories:

### Color Options

| Category | Options |
|----------|---------|
| **Text Colors** | `muted_color`, `emphasis_color`, `primary_color`, `secondary_color`, `success_color`, `warning_color`, `danger_color`, `text_background_color`, `body_color` |
| **Background Colors** | `background_default_color`, `background_muted_color`, `background_primary_color`, `background_secondary_color` |
| **Button Default** | `button_default_color`, `button_default_hover_color`, `button_default_text_color`, `button_default_hover_text_color` |
| **Button Primary** | `button_primary_color`, `button_primary_hover_color`, `button_primary_text_color`, `button_primary_hover_text_color` |
| **Button Secondary** | `button_secondary_color`, `button_secondary_hover_color`, `button_secondary_text_color`, `button_secondary_hover_text_color` |
| **Button Danger** | `button_danger_color`, `button_danger_hover_color`, `button_danger_text_color`, `button_danger_hover_text_color` |
| **Button Text/Link** | `button_text_color`, `button_text_hover_color`, `button_link_color`, `button_link_hover_color` |

### Layout Options

| Category | Options |
|----------|---------|
| **Breakpoints** | `ppm_breakpoint_s`, `ppm_breakpoint_m`, `ppm_breakpoint_l`, `ppm_breakpoint_xl` |
| **Container Padding (H)** | `container_padding_horizontal_mobile`, `container_padding_horizontal_s`, `container_padding_horizontal_m` |
| **Container Padding (V)** | `container_padding_vertical_[size]_mobile`, `container_padding_vertical_[size]_m` (sizes: default, xsmall, small, large, xlarge) |
| **Container Max Width** | `container_max_width_default`, `container_max_width_xsmall`, `container_max_width_small`, `container_max_width_large`, `container_max_width_xlarge` |
| **Column Gutter** | `column_gutter_mobile`, `column_gutter_l` |

### Element Options

| Category | Options |
|----------|---------|
| **Element Width** | `element_width_small`, `element_width_medium`, `element_width_large`, `element_width_xlarge`, `element_width_2xlarge` |
| **Element Margin** | `element_margin_[size]_mobile`, `element_margin_[size]_l` (sizes: default, xsmall, small, medium, large, xlarge) |

### Typography Options

| Category | Options |
|----------|---------|
| **Base** | `base_font_size` |
| **Headings** | `heading_[size]_mobile`, `heading_[size]_desktop`, `heading_[size]_font_weight` (sizes: 3xlarge, 2xlarge, xlarge, large, medium, small) |
| **Body Text** | `text_[size]_mobile`, `text_[size]_desktop`, `text_[size]_font_weight` (sizes: default, small, large) |
| **Navbar** | `navbar_link_mobile`, `navbar_link_desktop`, `navbar_link_font_weight` |
| **Button Typography** | `button_[type]_mobile`, `button_[type]_desktop`, `button_[type]_font_weight` (types: default, primary, secondary, danger, text, link) |

---

## Tokens Studio Integration

The plugin natively supports importing design tokens from [Tokens Studio for Figma](https://tokens.studio/). See the [Tokens Studio Setup Guide](docs/tokens-studio-setup.md) for detailed instructions on:

- Setting up Tokens Studio in Figma
- Structuring tokens for plugin compatibility
- Exporting and importing tokens
- Complete token path reference

---

## Developer Notes

### Security

- Every PHP entry point verifies `ABSPATH` is defined.
- All form submissions validate nonces and user capabilities.
- File operations use the WordPress Filesystem API.
- Input is sanitized with `sanitize_text_field`, `sanitize_hex_color`, and strict type casting.

### Coding Standards

- PHP 7.4+ with typed properties and return types.
- PSR-4 style autoloading with `EPB\` namespace.
- Interface contracts for extensibility.
- Centralized text strings for translation.

### Hooks & Filters

The plugin uses standard WordPress action/filter hooks. Key entry points:

- `admin_menu` – Registers the admin page.
- `wp_ajax_epb_*` – AJAX handlers for async operations.
- `admin_enqueue_scripts` – Loads admin CSS/JS on plugin pages.

### Debugging

Enable `WP_DEBUG` and `WP_DEBUG_LOG` to troubleshoot file operations, plugin installations, or theme generation issues.

### Translation

The plugin is translation-ready with the `enhanced-plugin-bundle` text domain. Translation files are stored in the `languages/` directory.

---

## License

Copyright © Hristijan Stavrov. All rights reserved. See [LICENCE.md](LICENCE.md) for details.

---

Happy coding, and thanks for using the Enhanced Plugin Bundle and Theme Manager!
