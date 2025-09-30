<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access for security reasons.
}

class Plugin_Bundle_Themes
{
    /**
     * Processes form submissions from the theme manager admin page.
     *
     * Handles parent theme uploads and child theme creation.
     * For parent themes, it processes file uploads.
     * For child themes, it saves CSS options and then creates and activates a child theme.
     * @return void
     */
    public static function handle_form_actions()
    {
        // Process parent theme upload if a file is provided.
        if (isset($_POST['upload_theme']) && isset($_FILES['theme_zip'])) {
            self::upload_parent_theme($_FILES['theme_zip']);
        }
        // Process child theme creation.
        if (isset($_POST['create_child_theme'])) {
            $regenerate_functions = ! empty($_POST['regenerate_child_functions']);
            if (isset($_POST['css_options']) && is_array($_POST['css_options'])) {
                // Sanitize and save CSS options using the CSS options manager.
                Plugin_Bundle_Css_Options::save_theme_options($_POST['css_options']);
            }
            self::create_and_activate_child_theme($regenerate_functions);
        }
    }

    /**
     * Uploads and installs the parent theme.
     *
     * Checks for upload errors, prevents duplicate installations,
     * processes the file upload, and then displays the outcome.
     *
     * @param array $file Uploaded file details from $_FILES.
     * @return void
     */
    public static function upload_parent_theme($file)
    {
        // Check for file upload errors.
        if ($file['error'] !== UPLOAD_ERR_OK) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_UPLOAD_FAILED),
                    esc_html($file['error'])
                )
            );
            return;
        }

        $theme_slug = basename($file['name'], '.zip');

        // If the parent theme is already installed, display a warning.
        if (self::is_yootheme_installed()) {
            @unlink($file['tmp_name']);
            Plugin_Bundle_Plugins_Notices::print_notice(
                'warning',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::THEME_ALREADY_UPLOADED),
                    esc_html($theme_slug)
                )
            );
            return;
        }

        // Process the theme file upload and installation.
        $result = self::process_theme_upload($file);

        // Display the outcome of the upload/installation process.
        Plugin_Bundle_Plugins_Notices::display_action_result($theme_slug, $result, 'upload');
    }

    /**
     * Processes the uploaded theme file.
     *
     * Moves the uploaded ZIP file to the themes directory,
     * unzips it, and cleans up the temporary file.
     *
     * @param array $file Uploaded file details from $_FILES.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    private static function process_theme_upload($file)
    {
        $temp_file   = $file['tmp_name'];
        $destination = WP_CONTENT_DIR . '/themes/' . basename($file['name']);

        // Load the WordPress Filesystem API.
        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }
        global $wp_filesystem;
        WP_Filesystem();

        // Ensure the themes directory exists.
        $theme_dir = WP_CONTENT_DIR . '/themes/';
        if (!wp_mkdir_p($theme_dir)) {
            @unlink($temp_file);
            return new WP_Error('create_dir_failed', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_CREATE_THEMES_DIR));
        }

        // Upload the file to the destination.
        $uploaded = $wp_filesystem->put_contents($destination, file_get_contents($temp_file));
        if (!$uploaded) {
            return new WP_Error('move_file_failed', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_MOVE_UPLOADED_FILE));
        }

        // Unzip the file to the themes directory.
        $unzip_result = unzip_file($destination, $theme_dir);
        $wp_filesystem->delete($destination);

        if (is_wp_error($unzip_result)) {
            return new WP_Error(
                'install_theme_failed',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_INSTALL_THEME),
                    esc_html($unzip_result->get_error_message())
                )
            );
        }

        return true;
    }

    /**
     * Creates and activates the child theme.
     *
     * Checks if the parent theme (YOOtheme) is installed. If it is,
     * updates an existing child theme or creates a new one, then activates it.
     *
     * @param bool $regenerate_functions Whether to overwrite the child theme functions.php file.
     * @return void
     */
    public static function create_and_activate_child_theme(bool $regenerate_functions = false)
    {
        if (!self::is_yootheme_installed()) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_YOO_THEME_NOT_INSTALLED)
            );
            return;
        }

        $child_dir = WP_CONTENT_DIR . '/themes/ppmchildtheme';

        if (file_exists($child_dir)) {
            // Update an existing child theme.
            self::update_existing_child_theme($child_dir, $regenerate_functions);
        } else {
            // Create a new child theme.
            self::create_new_child_theme($child_dir);
        }
    }

    /**
     * Updates an existing child theme by rewriting custom.css
     *
     * @param string $child_dir             Path to the child theme directory.
     * @param bool   $regenerate_functions Whether to overwrite the child theme functions.php file.
     */
    private static function update_existing_child_theme($child_dir, bool $regenerate_functions)
    {
        $style_written     = self::write_child_root_style($child_dir);
        $functions_written = self::write_child_functions_php($child_dir, $regenerate_functions);
        $css_written       = self::write_child_custom_css($child_dir);

        if ($style_written && $functions_written && $css_written) {
            // Activate theme if not already active
            if (! self::is_child_theme_active()) {
                switch_theme('ppmchildtheme');
                Plugin_Bundle_Plugins_Notices::print_notice(
                    'success',
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SUCCESS_THEME_ACTIVATED)
                );
            }
        }
    }
    /**
     * Updates or creates the child theme's custom.css file in /css/custom.css
     *
     * @param string $child_dir Absolute path to the child theme directory.
     */
    private static function write_child_custom_css($child_dir)
    {
        // Path to the css directory inside the child theme
        $css_dir = $child_dir . '/css';

        // Ensure the 'css' folder exists, recursively creating it if needed
        if (! wp_mkdir_p($css_dir)) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_CREATE_CHILD_DIR)
            );
            return false;
        }

        // Generate the CSS content
        $css_content = self::generate_child_theme_style_css();

        // Write to custom.css inside the css directory
        $file = $css_dir . '/custom.css';
        if (file_put_contents($file, $css_content) === false) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_CREATE_CSS)
            );
            return false;
        }

        Plugin_Bundle_Plugins_Notices::print_notice(
            'success',
            Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SUCCESS_CSS_UPDATED)
        );
        return true;
    }
    /**
     * Creates a new child theme directory and writes custom.css
     *
     * @param string $child_dir Path to the new child theme directory.
     */
    private static function create_new_child_theme($child_dir)
    {
        if (! wp_mkdir_p($child_dir)) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_CREATE_CHILD_DIR)
            );
            return;
        }

        $style_written     = self::write_child_root_style($child_dir);
        $functions_written = self::write_child_functions_php($child_dir, true);
        $css_written       = self::write_child_custom_css($child_dir);

        if ($style_written && $functions_written && $css_written) {
            switch_theme('ppmchildtheme');
            Plugin_Bundle_Plugins_Notices::print_notice(
                'success',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SUCCESS_THEME_ACTIVATED)
            );
        }
    }

    /**
     * Writes the child theme's root style.css with the required header and custom CSS import.
     *
     * @param string $child_dir Path to the child theme directory.
     * @return bool True on success, false on failure.
     */
    private static function write_child_root_style(string $child_dir): bool
    {
        $style_path = $child_dir . '/style.css';
        $style_contents = <<<CSS
/*
Theme Name: PPM Child
Theme URI: https://www.plappermaul.at
Description: Child theme generated by Enhanced Plugin Bundle and Theme Manager.
Author: Plappermaul OG
Author URI: https://www.plappermaul.at
Template: yootheme
Version: 1.0.0
*/

@import url("css/custom.css");

CSS;

        if (file_put_contents($style_path, $style_contents) === false) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_CREATE_STYLE_HEADER)
            );
            return false;
        }

        return true;
    }

    /**
     * Writes (or updates) the child theme's functions.php file with enqueue and custom logic.
     *
     * @param string $child_dir Path to the child theme directory.
     * @return bool True on success, false on failure.
     */
    private static function write_child_functions_php(string $child_dir, bool $force = false): bool
    {
        $functions_path = $child_dir . '/functions.php';
        if (! $force && file_exists($functions_path)) {
            return true;
        }

        $functions_contents = <<<'PHP'
<?php

/**
 * PPM Child functions and definitions
 *
 * @package PPM Child
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles.
 */
function PPM_child_scripts()
{
    // Enqueue Parent Stylesheet
    wp_enqueue_style('PPM-parent-stylesheet', get_template_directory_uri() . '/style.css');
    //wp_enqueue_style('adobe-font', 'https://use.typekit.net/pro1iqi.css', time()); // Activate this to get the adobe theme font, NOTE: You must first get the CSS link of the adobe project
    wp_enqueue_style('PPM-child-theme', get_stylesheet_directory_uri() . '/style.css', array('PPM-parent-stylesheet'));
}
add_action('wp_enqueue_scripts', 'PPM_child_scripts');

/* You can add your own php functions and code snippets below */
add_action('login_head', 'namespace_login_style');
function namespace_login_style()
{
    echo '<style>.login h1 a { background-image: url( ';
    echo 'https://www.plappermaul.at/external/img/plappermaul_logp_green-light-1.svg';
    echo ' ); 
  -webkit-background-size: contain;
  -moz-background-size: contain;
  -o-background-size: contain;
  background-size: contain;
      background-repeat: no-repeat;
    width: 160px;
    height: 110px;}</style>';
}
add_filter('login_headerurl', 'namespace_login_headerurl');
function namespace_login_headerurl($url)
{
    $url = "https://www.plappermaul.at";
    return $url;
}
add_filter('login_headertitle', 'namespace_login_headertitle');
function namespace_login_headertitle($title)
{
    $title = "Plappermaul OG";
    return $title;
}
/*Wordpress Sitemap deaktvieren BEGIN */
add_filter('wp_sitemaps_enabled', '__return_false');
/*Wordpress Sitemap deaktvieren END */
/*Wordpress Autoupdates deaktvieren BEGIN */
define('AUTOMATIC_UPDATER_DISABLED', true);
/*Wordpress Autoupdates deaktvieren END*/

// Allow editors to see access the Menus page under Appearance but hide other options
// Note that users who know the correct path to the hidden options can still access them
function hide_menu()
{
    $user = wp_get_current_user();

    // Check if the current user is an Editor
    if (in_array('shop_manager', (array) $user->roles)) {

        // They're an editor, so grant the edit_theme_options capability if they don't have it
        if (!current_user_can('edit_theme_options')) {
            $role_object = get_role('shop_manager');
            $role_object->add_cap('edit_theme_options');
        }

        // Hide the Themes page
        remove_submenu_page('themes.php', 'themes.php');

        // Hide the Widgets page
        remove_submenu_page('themes.php', 'widgets.php');

        // Hide the Customize page
        //remove_submenu_page( 'themes.php', 'customize.php' );

        // Remove Customize from the Appearance submenu
        global $submenu;
        unset($submenu['themes.php'][6]);

        //Remove YooTheme from main menu
        remove_menu_page('admin-ajax.php?action=kernel&p=customizer');
    }
}

add_action('admin_menu', 'hide_menu', 10);
add_action('admin_init', 'hide_menu', 999);

PHP;

        if (file_put_contents($functions_path, $functions_contents) === false) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_CREATE_FUNCTIONS_FILE)
            );
            return false;
        }

        return true;
    }


    /**
     * Generates the content for the child theme's style.css file.
     *
     * Retrieves CSS options via the CSS options manager and returns the complete CSS for the
     * child theme, including the configurable root font size and responsive typography rules.
     *
     * @return string The generated CSS content.
     */
    public static function generate_child_theme_style_css()
    {
        // Ensure the CSS generator class is loaded.
        require_once 'class-plugin-bundle-css-generator.php';
        // Retrieve current CSS options.
        $options = Plugin_Bundle_Css_Options::get_theme_options();
        // Generate and return the CSS content.
        return Plugin_Bundle_Css_Generator::generate_css($options);
    }

    /**
     * Renders the section for uploading and installing the parent theme.
     *
     * @return void
     */
    public static function render_upload_parent_theme_section()
    {
        Plugin_Bundle_Theme_Renderer::render_upload_parent_theme_section();
    }

    /**
     * Renders the section for creating and activating the child theme.
     *
     * Populates form fields with current CSS options retrieved via Plugin_Bundle_Css_Options.
     *
     * @return void
     */
    public static function render_create_child_theme_section()
    {
        Plugin_Bundle_Theme_Renderer::render_create_child_theme_section();
    }

    /**
     * Checks if the YOOtheme parent theme is installed.
     *
     * @return bool True if YOOtheme is installed, false otherwise.
     */
    public static function is_yootheme_installed()
    {
        $yootheme_dir = WP_CONTENT_DIR . '/themes/yootheme';
        return file_exists($yootheme_dir);
    }

    /**
     * Checks if the child theme is active.
     *
     * @return bool True if a child theme is active and its parent is YOOtheme.
     */
    public static function is_child_theme_active()
    {
        return is_child_theme() && get_template() === 'yootheme';
    }
}
