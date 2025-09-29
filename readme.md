# Enhanced Plugin Bundle and Theme Manager

**Version:** 3.3  
**Author:** Stavrov  
**Author URI:** [https://github.com/PinkFlamingoz](https://github.com/PinkFlamingoz)
**Plugin Location:** "00_Projekte\0001_Organisation\0002_Checklisten\Website Wartung\Unterlagen\ppm-plugin-bundle.zip"

Enhanced Plugin Bundle and Theme Manager is a WordPress plugin designed to simplify and centralize the management of plugins and themes. This tool provides an intuitive admin interface for bulk managing plugins, handling theme uploads, and generating child themes with customizable CSS settings.

---

## Table of Contents

- [Enhanced Plugin Bundle and Theme Manager](#enhanced-plugin-bundle-and-theme-manager)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Features](#features)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Admin Interface](#admin-interface)
  - [Configuration](#configuration)
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

The **Enhanced Plugin Bundle and Theme Manager** offers a unified solution to manage your WordPress plugins and themes with ease. It streamlines operations such as:

- Bulk management of plugins (activation, deactivation, and updates).
- Uploading and installing a parent theme.
- Creating and activating a child theme with custom CSS options.

Designed with both end-users and developers in mind, the plugin adheres to WordPress coding standards and incorporates a modular architecture for easier extension and maintenance.

---

## Features

- **Unified Management Interface:**  
  Easily manage a bundled list of plugins and themes from a single admin dashboard.

- **Bulk Actions for Plugins:**  
  Execute bulk operations (activation, deactivation, updates) on a dynamically managed list of plugins.

- **Theme Management:**

  - **Parent Theme Upload:** Securely upload and install parent themes.
  - **Child Theme Creation:** Generate a child theme with customizable CSS options and auto-activation.

- **Dynamic Plugin Options:**

  - Stores a curated list of standard plugins.
  - Automatically updates options in the WordPress database.

- **Security:**

  - Prevents direct file access.
  - Uses the WordPress Filesystem API for secure file operations.


---

## Installation

1. **Download and Install:**

   - Download the plugin files and extract them into your WordPress plugins directory (`/wp-content/plugins/`).
   - In your WordPress admin dashboard, navigate to **Plugins > Installed Plugins** and activate the **Enhanced Plugin Bundle and Theme Manager**.

2. **Setup Dependencies:**

  - Ensure that the TGM Plugin Activation library and any required dependencies are correctly placed in the `vendor` folder.

3. **File Permissions:**
   - Confirm that your themes directory (`/wp-content/themes/`) has the necessary write permissions to allow file uploads and extraction.

---

## Usage

After activation, a new admin menu item will be available:

### Admin Interface

- **Accessing the Plugin Manager:**

  - Go to **Dashboard > Plugin Bundle**.
  - Use the bulk controls provided to manage the bundled plugins.

- **Plugin Management:**

  - The interface displays a dynamically updated list of plugins.
  - Perform actions such as activation, deactivation, and updates from one central page.

- **Theme Management:**

  - **Parent Theme Upload:**  
    Use the dedicated section to upload a parent theme. The plugin will validate and install the theme securely.
  - **Child Theme Creation:**  
    Customize CSS options and create a child theme. The plugin generates the necessary `style.css` and activates the child theme automatically.

---

## Configuration

- **Dynamic Plugin Options:**  
  The default list of standard plugins is stored as an option in the WordPress database. If no list exists, it is automatically initialized with default values.

- **CSS Customization:**  
  Leverage the built-in CSS generator to create custom styles for your child theme. Update CSS options via the admin interface to regenerate the `style.css` file dynamically.

---

## CSS Options Reference

This section details the available CSS options that are used to generate the child theme’s stylesheet. These options primarily override UIkit defaults—refer to the [UIkit Documentation](https://getuikit.com/docs) for more details on how these values affect UI components.

### Color Options

**Text Colors:**

- **`muted_color`**:  
  Sets the color for less prominent or disabled text elements.
- **`emphasis_color`**:  
  Used to highlight or emphasize text.
- **`primary_color`**:  
  The main color for primary UI elements (e.g., buttons, links).
- **`secondary_color`**:  
  A complementary color for secondary UI elements.
- **`success_color`**:  
  Indicates success messages or positive actions.
- **`warning_color`**:  
  Signals warnings or cautionary messages.
- **`danger_color`**:  
  Used for error messages or destructive actions.

**Button Colors:**

- **`button_default_color`**:  
  Background color for standard buttons.
- **`button_primary_color`**:  
  Background color for primary action buttons.
- **`button_secondary_color`**:  
  Background color for secondary action buttons.
- **`button_danger_color`**:  
  Background color for buttons that perform dangerous actions.
- **`button_text_color`**:  
  Sets the text color on buttons.
- **`button_link_color`**:  
  Color used for links within button components.

**Background Colors:**

- **`background_default_color`**:  
  Default background color for the site.
- **`background_muted_color`**:  
  A softer background color used in less prominent areas.
- **`background_primary_color`**:  
  Background color for primary containers.
- **`background_secondary_color`**:  
  Background color for secondary containers or sections.

### Breakpoints and Container Options

**Breakpoints:**

- **`ppm_breakpoint_s`**, **`ppm_breakpoint_m`**, **`ppm_breakpoint_l`**, **`ppm_breakpoint_xl`**:  
  Define responsive breakpoints (in pixels) for adjusting layout according to screen size, following UIkit’s grid system.

**Container Padding:**

- **`container_padding_horizontal_mobile`**, **`container_padding_horizontal_s`**, **`container_padding_horizontal_m`**:  
  Horizontal padding values for container elements across mobile, small, and medium screen sizes.

**Container Maximum Width:**

- **`container_max_width_default`**:  
  Maximum width for the default container layout.
- **`container_max_width_xsmall`**, **`container_max_width_small`**, **`container_max_width_large`**, **`container_max_width_xlarge`**:  
  Specific maximum widths for containers at various size categories, allowing precise layout control.

**Column Gutter:**

- **`column_gutter_mobile`**, **`column_gutter_l`**:  
  Spacing between columns for mobile and larger screen layouts.

**Container Padding Vertical:**

- Options such as **`container_padding_vertical_default_mobile`**, **`container_padding_vertical_default_m`**, **`container_padding_vertical_xsmall_mobile`**, etc.:  
  Define the vertical spacing (padding) within containers at different breakpoints.

### Element Options

**Widths:**

- **`element_width_small`**, **`element_width_medium`**, **`element_width_large`**, **`element_width_xlarge`**, **`element_width_2xlarge`**:  
  Set fixed widths for UI elements. Adjust these values to control the size of components as per your design requirements.

**Margins:**
Margin options control spacing around elements:

- **Default Margins:**
  - `element_margin_default_mobile` and `element_margin_default_l`
- **Extra Small (XSmall) Margins:**
  - `element_margin_xsmall_mobile` and `element_margin_xsmall_l`
- **Small Margins:**
  - `element_margin_small_mobile` and `element_margin_small_l`
- **Medium Margins:**
  - `element_margin_medium_mobile` and `element_margin_medium_l`
- **Large Margins:**
  - `element_margin_large_mobile` and `element_margin_large_l`
- **Extra Large (XLarge) Margins:**
  - `element_margin_xlarge_mobile` and `element_margin_xlarge_l`

These settings allow you to finely tune the spacing between UI elements to better align with your design aesthetics.

### Typography Options

**Base Font:**

- **`base_font_size`**:  
  Establishes the default font size for the entire HTML document.

**Text Options:**

- **Default Text:**
  - `text_default_mobile`, `text_default_desktop`, and `text_default_font_weight` set the font size and weight for body text.
- **Small Text:**
  - `text_small_mobile`, `text_small_desktop`, and `text_small_font_weight` define a smaller variant of text for secondary content.
- **Large Text:**
  - `text_large_mobile`, `text_large_desktop`, and `text_large_font_weight` are used for emphasized or larger body text.

**Headline Options:**  
For headings, you have separate settings for different sizes:

- **Heading 3XL:**
  - `heading_3xlarge_mobile`, `heading_3xlarge_desktop`, `heading_3xlarge_font_weight`
- **Heading 2XL:**
  - `heading_2xlarge_mobile`, `heading_2xlarge_desktop`, `heading_2xlarge_font_weight`
- **Heading XL:**
  - `heading_xlarge_mobile`, `heading_xlarge_desktop`, `heading_xlarge_font_weight`
- **Heading Large:**
  - `heading_large_mobile`, `heading_large_desktop`, `heading_large_font_weight`
- **Heading Medium:**
  - `heading_medium_mobile`, `heading_medium_desktop`, `heading_medium_font_weight`
- **Heading Small:**
  - `heading_small_mobile`, `heading_small_desktop`, `heading_small_font_weight`

**Navbar Options:**

- **`navbar_link_mobile`**, **`navbar_link_desktop`**, **`navbar_link_font_weight`**:  
  Customize the font size and weight for navigation links.

### Button Typography Options

Each button type has its own typography settings:

- **Button Default:**
  - `button_default_mobile`, `button_default_desktop`, `button_default_font_weight`
- **Button Primary:**
  - `button_primary_mobile`, `button_primary_desktop`, `button_primary_font_weight`
- **Button Secondary:**
  - `button_secondary_mobile`, `button_secondary_desktop`, `button_secondary_font_weight`
- **Button Danger:**
  - `button_danger_mobile`, `button_danger_desktop`, `button_danger_font_weight`
- **Button Text:**
  - `button_text_mobile`, `button_text_desktop`, `button_text_font_weight`
- **Button Link:**
  - `button_link_mobile`, `button_link_desktop`, `button_link_font_weight`

### How to Customize

All these options are editable via the admin interface under the child theme creation section. When you adjust a value, the plugin regenerates the _style.css_ file with your new settings. Since the plugin leverages the UIkit framework, these settings serve as overrides for the default UIkit styles. For more insight into how these options may interact with UIkit components, refer to the [UIkit Documentation](https://getuikit.com/docs).

---

## Code Structure

The plugin is built using a modular approach with clearly defined responsibilities:

- **Plugin_Bundle_Admin:**  
  Handles admin menu creation, asset loading, and form submissions.
- **Plugin_Bundle_Plugins & Plugin_Bundle_Plugins_Options:**  
  Manage plugin listings, bulk operations, and dynamic plugin options storage.
- **Plugin_Bundle_Themes:**  
  Facilitates theme management including parent theme uploads and child theme generation/activation.
- **Plugin_Bundle_Css_Generator & Plugin_Bundle_Css_Options:**  
  Generate and manage CSS for child themes based on customizable options.
- **Plugin_Bundle_Texts:**  
  Stores localization strings and plugin messages, ensuring easy translation and text management.

Each component is thoroughly documented in the code, making it easier for developers to maintain and extend the functionality.

---

## Developer Notes

- **Security Practices:**
  - The plugin restricts direct access by checking for the `ABSPATH` constant.
  - File operations (uploading, extraction) are securely managed using the WordPress Filesystem API.
- **Extensibility:**
  - The codebase is modular, allowing developers to easily extend functionalities or integrate additional features.
  - Hooks and filters are provided throughout the code to support custom modifications.
- **Debugging:**
  - Enable WordPress debugging (`WP_DEBUG`) to log errors and messages for troubleshooting purposes.

---

Happy coding and thank you for using the Enhanced Plugin Bundle and Theme Manager!
