# Enhanced Plugin Bundle and Theme Manager

**Version:** 3.3  
**Author:** Stavrov  
**Author URI:** [https://github.com/PinkFlamingoz](https://github.com/PinkFlamingoz)  

Enhanced Plugin Bundle and Theme Manager is a WordPress plugin that centralizes the setup of a curated plugin bundle and a YOOtheme-based child theme. It provides an intuitive admin interface for bulk plugin operations, parent-theme handling, and a rich CSS customization layer that generates the child theme’s stylesheet on demand.

---

## Table of Contents

- [Enhanced Plugin Bundle and Theme Manager](#enhanced-plugin-bundle-and-theme-manager)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Features](#features)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Admin Interface](#admin-interface)
      - [Managing the Plugin Bundle](#managing-the-plugin-bundle)
      - [Adding Plugins from WordPress.org](#adding-plugins-from-wordpressorg)
      - [Removing Plugins from the Bundle](#removing-plugins-from-the-bundle)
      - [Theme Management](#theme-management)
      - [Child Theme Generator](#child-theme-generator)
  - [Configuration](#configuration)
    - [Default Plugin Bundle](#default-plugin-bundle)
    - [Option Storage](#option-storage)
  - [CSS Options Reference](#css-options-reference)
    - [Color Options](#color-options)
    - [Breakpoints and Container Options](#breakpoints-and-container-options)
    - [Element Options](#element-options)
    - [Typography Options](#typography-options)
    - [Button Typography Options](#button-typography-options)
    - [How to Customize](#how-to-customize)
  - [Code Structure](#code-structure)
  - [Developer Notes](#developer-notes)

---

## Introduction

The **Enhanced Plugin Bundle and Theme Manager** streamlines recurring launch tasks for Plappermaul OG projects. From one WordPress admin screen you can:

- Install, activate, deactivate, delete, or unregister a curated set of WordPress.org plugins.
- Upload the YOOtheme Pro parent theme ZIP once per environment.
- Generate and activate a `ppmchildtheme` child theme whose CSS is derived from configurable design tokens.

The plugin follows WordPress best practices, defers to the Filesystem API for file writes, and keeps all dynamic data in WordPress options for easy export or migration.

---

## Features

- **Dedicated admin dashboard** – A top-level “Plugin Bundle” menu combines plugin, theme, and child-theme management in a single screen.
- **Curated bundle management** – A default list of 11 recommended plugins is stored in the `epb_dynamic_plugins` option and exposed in the UI. Status badges reflect whether each plugin is installed or active.
- **Bulk plugin actions** – Apply `install`, `activate`, `deactivate`, or `delete` to multiple plugins at once. Installations pull ZIPs directly from WordPress.org and automatically capture the correct main file path.
- **WordPress.org discovery** – Append new plugins by pasting a WordPress.org plugin URL. Slugs are validated, duplicates are rejected, and the bundle is persisted back to the options table.
- **Bundle hygiene** – Use the `Delete from List` bulk action to keep the configuration tidy without touching the filesystem.
- **YOOtheme parent management** – Upload a YOOtheme Pro ZIP file once; the plugin extracts it through the Filesystem API and guards against accidental reinstallation.
- **Child theme generator** – With one click the plugin writes a YOOtheme-compatible child theme (`ppmchildtheme`) containing `style.css`, `css/custom.css`, and an optional regenerated `functions.php`.
- **Design token CSS generator** – Over 90 CSS variables drive the generated stylesheet so UIkit components inherit consistent colors, spacing, typography, and button states.
- **Admin UX niceties** – Drag-and-drop support for the theme ZIP input and a “Select All” control for plugin checkboxes improve speed when onboarding a site.
- **Security-first operations** – Every public entry point guards against direct access, sanitizes user input, and leverages WordPress core utilities for plugin/theme operations.

---

## Installation

1. **Copy the plugin into WordPress**  
   Extract or clone the repository into `/wp-content/plugins/ppm-plugin-bundle` on your WordPress installation.

2. **Activate it**  
   In the WordPress dashboard navigate to **Plugins → Installed Plugins** and activate **Enhanced Plugin Bundle and Theme Manager**.

3. **Prepare YOOtheme Pro (optional but recommended)**  
   Place the latest YOOtheme Pro ZIP on your machine so you can upload it through the admin screen. The plugin checks whether YOOtheme already exists before attempting installation.

4. **Ensure write permissions**  
   Confirm that WordPress can write to `/wp-content/themes/` so the parent theme ZIP and generated child theme files can be placed correctly.

---

## Usage

After activation a new **Plugin Bundle** top-level menu item appears in the WordPress sidebar.

### Admin Interface

The admin page is split into three forms: bulk plugin management, parent theme upload, and child theme generation.

#### Managing the Plugin Bundle

1. Tick one or more plugins in the table.
2. Choose an action from the dropdown:
   - **Install** – downloads from WordPress.org if the plugin folder is missing.
   - **Activate** – activates the plugin, installing it first when necessary.
   - **Deactivate** – deactivates active plugins without deleting files.
   - **Delete** – deactivates (if needed) and removes the plugin files.
   - **Delete from List** – removes the plugin from the managed bundle but leaves any installed files untouched.
3. Click **Apply to Selected** to run the chosen action. Success and error notices describe the outcome of every plugin processed.

Status badges in the rightmost column display whether each plugin is installed/active, installed/inactive, or missing completely.

#### Adding Plugins from WordPress.org

- Scroll to the “Add New Plugin” section beneath the table.
- Paste the URL to a plugin on `wordpress.org/plugins/` (for example `https://wordpress.org/plugins/wordpress-seo/`).
- Submit the form to append the plugin to the bundle. The plugin name is fetched from the WordPress.org API and stored alongside the slug.

If the plugin already exists in the bundle or the URL is invalid you will receive a descriptive error notice.

#### Removing Plugins from the Bundle

To stop tracking a plugin without touching the filesystem, select it in the table, choose **Delete from List**, and apply the action. The entry is removed from `epb_dynamic_plugins` but any installed plugin remains on disk.

#### Theme Management

- Use the **Upload Parent Theme** panel to upload your YOOtheme Pro ZIP. The plugin extracts the archive into `/wp-content/themes/yootheme`. If that directory already exists, the upload is skipped and a notice explains why.
- Drag-and-drop is supported on the file input. Only one upload is necessary per environment.

#### Child Theme Generator

- Configure the design tokens in the “Create Child Theme” panel. Inputs are grouped into colors, breakpoints, container settings, typography, and button styles.
- Optional checkbox: **Regenerate child theme functions.php**. When enabled the plugin rewrites the child theme’s `functions.php` with the shipped template (which enqueues parent styles, brands the login screen, disables the WordPress sitemap, and restricts YOOtheme access for shop managers). Leave it unchecked to preserve manual edits.
- Click **Save Options & Create Child Theme** to write the options to the database, regenerate `css/custom.css`, refresh the root `style.css`, and activate the `ppmchildtheme` theme if YOOtheme Pro is present.

Generated assets live under `wp-content/themes/ppmchildtheme/`:

- `style.css` – child theme header importing the generated CSS.
- `css/custom.css` – the CSS output from the generator.
- `functions.php` – optional template controlled by the regenerate checkbox.

---

## Configuration

Two key option sets power the plugin:

- **Plugin bundle (`epb_dynamic_plugins`)** – stores an array of plugin definitions (`slug`, `name`, `init_path`). If the option is missing the defaults below are seeded automatically.
- **Child theme CSS (`ppm_child_theme_css_options`)** – stores the latest design token values used by the CSS generator. Non-color values are stored as floats, and colors are sanitized to valid hex codes.

### Default Plugin Bundle

| Plugin | Slug | Default init path | Notes |
| --- | --- | --- | --- |
| Yoast SEO | `wordpress-seo` | `wordpress-seo/wp-seo.php` | Included by default |
| WP Mail Logging | `wp-mail-logging` | _(auto-detected)_ | Main file resolved after installation |
| Better Search Replace | `better-search-replace` | _(auto-detected)_ | Uses WordPress.org naming convention |
| Ninja Forms | `ninja-forms` | _(auto-detected)_ | Install to populate the init path |
| WP Mail SMTP | `wp-mail-smtp` | `wp-mail-smtp/wp_mail_smtp.php` | Preconfigured init path |
| Insert Headers and Footers | `insert-headers-and-footers` | `insert-headers-and-footers/ihaf.php` | Preconfigured init path |
| WPS Hide Login | `wps-hide-login` | _(auto-detected)_ | Path detected post-install |
| WPS Limit Login | `wps-limit-login` | _(auto-detected)_ | Path detected post-install |
| All 404 Redirect to Homepage | `all-404-redirect-to-homepage` | _(auto-detected)_ | Path detected post-install |
| UpdraftPlus WordPress Backup Plugin | `updraftplus` | _(auto-detected)_ | Path detected post-install |
| YITH Maintenance Mode | `yith-maintenance-mode` | `yith-maintenance-mode/init.php` | Preconfigured init path |

When an entry’s `init_path` is empty the plugin auto-detects it after the first successful installation and persists the updated path back to the option.

### Option Storage

- Options are written with `update_option`, so they support standard WordPress migration tools and search-replace workflows.
- The CSS generator strictly casts numeric values and sanitizes hex colors before persisting.
- The child theme directory is created with `wp_mkdir_p`, ensuring compatibility with varied hosting environments.

---

## CSS Options Reference

The child theme’s stylesheet derives from a comprehensive set of tokens. Each field in the admin UI maps to one of the options below. Many values are used to override UIkit defaults; consult the [UIkit documentation](https://getuikit.com/docs) for component-level details.

### Color Options

**Text & Body Colors**

- `muted_color` – Muted text.
- `emphasis_color` – Emphasized text.
- `primary_color` – Primary accent color.
- `secondary_color` – Secondary accent color.
- `success_color`, `warning_color`, `danger_color` – Status colors.
- `text_background_color` – Background used for highlighted text blocks.
- `body_color` – Default body text color.

**Background Colors**

- `background_default_color`, `background_muted_color`, `background_primary_color`, `background_secondary_color` – Surface backgrounds for the main UIkit section classes.

**Button Colors & States**

- Default button: `button_default_color`, `button_default_hover_color`, `button_default_text_color`, `button_default_hover_text_color`.
- Primary button: `button_primary_color`, `button_primary_hover_color`, `button_primary_text_color`, `button_primary_hover_text_color`.
- Secondary button: `button_secondary_color`, `button_secondary_hover_color`, `button_secondary_text_color`, `button_secondary_hover_text_color`.
- Danger button: `button_danger_color`, `button_danger_hover_color`, `button_danger_text_color`, `button_danger_hover_text_color`.
- Text button: `button_text_color`, `button_text_hover_color`.
- Link button: `button_link_color`, `button_link_hover_color`.

### Breakpoints and Container Options

- Breakpoints: `ppm_breakpoint_s`, `ppm_breakpoint_m`, `ppm_breakpoint_l`, `ppm_breakpoint_xl` (also mirrored to `--uk-breakpoint-*`).
- Horizontal padding: `container_padding_horizontal_mobile`, `container_padding_horizontal_s`, `container_padding_horizontal_m`.
- Vertical padding: `container_padding_vertical_*` (default, xsmall, small, large, xlarge for mobile and medium breakpoints).
- Container widths: `container_max_width_default`, `container_max_width_xsmall`, `container_max_width_small`, `container_max_width_large`, `container_max_width_xlarge`.
- Column gutters: `column_gutter_mobile`, `column_gutter_l`.

### Element Options

- Width tokens: `element_width_small`, `element_width_medium`, `element_width_large`, `element_width_xlarge`, `element_width_2xlarge`.
- Margin tokens (mobile and large variants): `element_margin_default_*`, `element_margin_xsmall_*`, `element_margin_small_*`, `element_margin_medium_*`, `element_margin_large_*`, `element_margin_xlarge_*`.

### Typography Options

- Base HTML font size: `base_font_size`.
- Body text sizes: `text_default_*`, `text_small_*`, `text_large_*` (each with mobile, desktop, and weight settings).
- Headings: `heading_3xlarge_*`, `heading_2xlarge_*`, `heading_xlarge_*`, `heading_large_*`, `heading_medium_*`, `heading_small_*` (mobile size, desktop size, weight).
- Navbar links: `navbar_link_mobile`, `navbar_link_desktop`, `navbar_link_font_weight`.

### Button Typography Options

- Button size & weight tokens: `button_default_*`, `button_primary_*`, `button_secondary_*`, `button_danger_*`, `button_text_*`, `button_link_*` (mobile size, desktop size, font weight for each button style).

### How to Customize

Adjust the fields in the admin UI and click **Save Options & Create Child Theme**. The plugin regenerates `css/custom.css`, updates the root `style.css` import, and (re)activates the child theme. Because options are stored server-side you can revisit the page to tweak values at any time.

---

## Code Structure

- `enhanced-plugin-bundle.php` – Bootstrap file defining constants and wiring up autoloaded classes.
- `admin/class-plugin-bundle-admin.php` – Registers the admin menu, enqueues assets, and routes form submissions.
- `includes/class-plugin-bundle-plugins.php` – Business logic for the plugin bundle (actions, validation, list maintenance).
- `includes/class-plugin-bundle-plugins-options.php` – Persists the bundle configuration and seeds defaults.
- `includes/class-plugin-bundle-plugin-section-renderer.php` – Renders the table, bulk controls, and add-plugin form.
- `includes/class-plugin-bundle-themes.php` & `includes/class-plugin-bundle-theme-section-renderer.php` – Handle YOOtheme uploads and child theme creation UI.
- `includes/class-plugin-bundle-css-options.php` & `includes/class-plugin-bundle-css-generator.php` – Manage design token defaults and generate the CSS file.
- `includes/plugin-bundle-functions.php` – Shared helpers such as the admin notice utility.
- `includes/class-plugin-bundle-texts.php` – Centralized translatable strings.
- `assets/css/admin.css` & `assets/js/admin.js` – Styling and UX helpers for the admin screen.

---

## Developer Notes

- **Security** – Every PHP entry point checks `ABSPATH`. File writes use the Filesystem API; plugin/theme actions funnel through the standard core helpers (`Plugin_Upgrader`, `activate_plugin`, `switch_theme`, etc.).
- **Sanitization** – All form submissions use `sanitize_text_field`, `sanitize_hex_color`, and strict casting before persistence.
- **Child theme template** – The shipped `functions.php` adds branding to the login screen, disables the core sitemap, disables auto-updates, and removes YOOtheme from `shop_manager` menus. Reuse or adapt as needed.
- **Extensibility** – Text strings are centralized for translation. The modular class layout makes it easy to extend renderers or replace data sources.
- **Debugging** – Enable `WP_DEBUG` and inspect the standard WordPress debug log if uploads, installs, or filesystem actions fail.

---

Happy coding, and thanks for using the Enhanced Plugin Bundle and Theme Manager!
