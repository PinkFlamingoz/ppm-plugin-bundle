<?php

/**
 * Child theme generator for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Themes
 */

namespace EPB\Themes;

use EPB\Core\Notices;
use EPB\CSS\Generator as CSSGenerator;
use EPB\CSS\Component_Registry;
use EPB\CSS\Less_Parser;
use EPB\Ajax\Component_Handler;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Child_Theme
 *
 * Handles child theme creation, updates, and file generation.
 */
class Child_Theme
{
    /**
     * Initialize hooks.
     *
     * @return void
     */
    public static function init(): void
    {
        // Automatically regenerate CSS when component settings are updated.
        add_action('epb_component_settings_updated', [self::class, 'regenerate_custom_css']);
    }

    /**
     * Regenerate the custom.css and style.less files if child theme exists.
     *
     * Called automatically when component settings are changed or tokens imported.
     *
     * @return void
     */
    public static function regenerate_custom_css(): void
    {
        $child_dir = self::get_child_theme_dir();

        // Only regenerate if child theme exists.
        if (!file_exists($child_dir)) {
            return;
        }

        global $wp_filesystem;
        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        // Initialize filesystem.
        if (!WP_Filesystem()) {
            return;
        }

        // Regenerate CSS file.
        $css_dir = $child_dir . '/css';
        if (file_exists($css_dir)) {
            $css_content = self::generate_css();
            $wp_filesystem->put_contents($css_dir . '/custom.css', $css_content, FS_CHMOD_FILE);
        }

        // Regenerate Less file for YOOtheme compilation.
        $less_content = self::generate_less();
        $wp_filesystem->put_contents($child_dir . '/style.less', $less_content, FS_CHMOD_FILE);
    }

    /**
     * Child theme directory name.
     *
     * @var string
     */
    public const THEME_SLUG = 'ppmchildtheme';

    /**
     * Creates and activates the child theme.
     *
     * Checks if the parent theme (YOOtheme) is installed. If it is,
     * updates an existing child theme or creates a new one, then activates it.
     *
     * @param bool $regenerate_functions Whether to overwrite the child theme functions.php file.
     * @return void
     */
    public static function create_and_activate(bool $regenerate_functions = false): void
    {
        if (!Manager::is_yootheme_installed()) {
            Notices::error(
                __('YOOtheme Pro is not installed. Please install YOOtheme Pro to create a child theme.', 'enhanced-plugin-bundle')
            );
            return;
        }

        $child_dir = self::get_child_theme_dir();

        if (file_exists($child_dir)) {
            // Update an existing child theme.
            self::update_existing($child_dir, $regenerate_functions);
        } else {
            // Create a new child theme.
            self::create_new($child_dir);
        }
    }

    /**
     * Returns the child theme directory path.
     *
     * @return string
     */
    public static function get_child_theme_dir(): string
    {
        return WP_CONTENT_DIR . '/themes/' . self::THEME_SLUG;
    }

    /**
     * Updates an existing child theme by rewriting custom.css.
     *
     * @param string $child_dir             Path to the child theme directory.
     * @param bool   $regenerate_functions Whether to overwrite the child theme functions.php file.
     * @return void
     */
    private static function update_existing(string $child_dir, bool $regenerate_functions): void
    {
        $style_written     = self::write_root_style($child_dir);
        $functions_written = self::write_functions_php($child_dir, $regenerate_functions);
        $css_written       = self::write_custom_css($child_dir);
        $less_written      = self::write_style_less($child_dir);

        if ($style_written && $functions_written && $css_written && $less_written) {
            // Activate theme if not already active.
            if (!Manager::is_child_theme_active()) {
                switch_theme(self::THEME_SLUG);
                Notices::success(
                    __('Child theme activated successfully.', 'enhanced-plugin-bundle')
                );
            }
        }
    }

    /**
     * Creates a new child theme directory and writes required files.
     *
     * @param string $child_dir Path to the new child theme directory.
     * @return void
     */
    private static function create_new(string $child_dir): void
    {
        if (!wp_mkdir_p($child_dir)) {
            Notices::error(
                __('Failed to create the child theme directory.', 'enhanced-plugin-bundle')
            );
            return;
        }

        $style_written     = self::write_root_style($child_dir);
        $functions_written = self::write_functions_php($child_dir, true);
        $css_written       = self::write_custom_css($child_dir);
        $less_written      = self::write_style_less($child_dir);

        if ($style_written && $functions_written && $css_written && $less_written) {
            switch_theme(self::THEME_SLUG);
            Notices::success(
                __('Child theme activated successfully.', 'enhanced-plugin-bundle')
            );
        }
    }

    /**
     * Writes the child theme's root style.css with the required header.
     *
     * @param string $child_dir Path to the child theme directory.
     * @return bool True on success, false on failure.
     */
    private static function write_root_style(string $child_dir): bool
    {
        $style_path = $child_dir . '/style.css';

        // Allow theme header to be filtered for customization.
        $theme_header = apply_filters('epb_child_theme_header', [
            'name'        => 'PPM Child',
            'uri'         => 'https://www.plappermaul.at',
            'description' => 'Child theme generated by Enhanced Plugin Bundle and Theme Manager.',
            'author'      => 'Plappermaul OG',
            'author_uri'  => 'https://www.plappermaul.at',
            'template'    => 'yootheme',
            'version'     => '1.0.0',
        ]);

        $style_contents = sprintf(
            "/*\nTheme Name: %s\nTheme URI: %s\nDescription: %s\nAuthor: %s\nAuthor URI: %s\nTemplate: %s\nVersion: %s\n*/\n\n@import url(\"css/custom.css\");\n",
            esc_attr($theme_header['name']),
            esc_url($theme_header['uri']),
            esc_attr($theme_header['description']),
            esc_attr($theme_header['author']),
            esc_url($theme_header['author_uri']),
            esc_attr($theme_header['template']),
            esc_attr($theme_header['version'])
        );

        return self::write_file($style_path, $style_contents, 'style.css');
    }

    /**
     * Writes (or updates) the child theme's functions.php file.
     *
     * @param string $child_dir Path to the child theme directory.
     * @param bool   $force     Whether to overwrite existing file.
     * @return bool True on success, false on failure.
     */
    private static function write_functions_php(string $child_dir, bool $force = false): bool
    {
        $functions_path = $child_dir . '/functions.php';
        if (!$force && file_exists($functions_path)) {
            return true;
        }

        // Allow branding to be filtered for customization.
        $branding = apply_filters('epb_child_theme_branding', [
            'company_name' => 'Plappermaul OG',
            'company_url'  => 'https://www.plappermaul.at',
            'logo_url'     => 'https://www.plappermaul.at/external/img/plappermaul_logp_green-light-1.svg',
        ]);

        $company_name = esc_attr($branding['company_name']);
        $company_url  = esc_url($branding['company_url']);
        $logo_url     = esc_url($branding['logo_url']);

        $functions_contents = <<<PHP
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
    //wp_enqueue_style('adobe-font', 'https://use.typekit.net/pro1iqi.css', time()); // Activate this to get the adobe theme font
    wp_enqueue_style('PPM-child-theme', get_stylesheet_directory_uri() . '/style.css', array('PPM-parent-stylesheet'));
}
add_action('wp_enqueue_scripts', 'PPM_child_scripts');

/* Custom login branding */
add_action('login_head', 'namespace_login_style');
function namespace_login_style()
{
    echo '<style>.login h1 a { background-image: url( {$logo_url} ); 
  -webkit-background-size: contain;
  -moz-background-size: contain;
  -o-background-size: contain;
  background-size: contain;
      background-repeat: no-repeat;
    width: 160px;
    height: 110px;}</style>';
}

add_filter('login_headerurl', 'namespace_login_headerurl');
function namespace_login_headerurl(\$url)
{
    \$url = '{$company_url}';
    return \$url;
}

add_filter('login_headertext', 'namespace_login_headertext');
function namespace_login_headertext(\$title)
{
    \$title = '{$company_name}';
    return \$title;
}

/* Disable WordPress Sitemap */
add_filter('wp_sitemaps_enabled', '__return_false');

/* Disable WordPress Auto-updates */
define('AUTOMATIC_UPDATER_DISABLED', true);

/* Editor/Shop Manager menu restrictions */
function hide_menu()
{
    \$user = wp_get_current_user();

    if (in_array('shop_manager', (array) \$user->roles)) {
        if (!current_user_can('edit_theme_options')) {
            \$role_object = get_role('shop_manager');
            \$role_object->add_cap('edit_theme_options');
        }

        remove_submenu_page('themes.php', 'themes.php');
        remove_submenu_page('themes.php', 'widgets.php');

        global \$submenu;
        unset(\$submenu['themes.php'][6]);
        remove_menu_page('admin-ajax.php?action=kernel&p=customizer');
    }
}
add_action('admin_menu', 'hide_menu', 10);
add_action('admin_init', 'hide_menu', 999);

PHP;

        return self::write_file($functions_path, $functions_contents, 'functions.php');
    }

    /**
     * Writes the child theme's custom.css file.
     *
     * @param string $child_dir Absolute path to the child theme directory.
     * @return bool True on success, false on failure.
     */
    private static function write_custom_css(string $child_dir): bool
    {
        // Path to the css directory inside the child theme.
        $css_dir = $child_dir . '/css';

        // Ensure the 'css' folder exists.
        if (!wp_mkdir_p($css_dir)) {
            Notices::error(
                __('Failed to create the child theme CSS directory.', 'enhanced-plugin-bundle')
            );
            return false;
        }

        // Generate the CSS content.
        $css_content = self::generate_css();

        $file = $css_dir . '/custom.css';
        if (!self::write_file($file, $css_content, 'custom.css', false)) {
            return false;
        }

        Notices::success(
            __('Child theme CSS file updated successfully.', 'enhanced-plugin-bundle')
        );
        return true;
    }

    /**
     * Writes the child theme's style.less file for YOOtheme Less compilation.
     *
     * This file contains Less variable overrides that YOOtheme will compile
     * with UIkit, allowing the custom variables to take effect.
     *
     * @param string $child_dir Absolute path to the child theme directory.
     * @return bool True on success, false on failure.
     */
    private static function write_style_less(string $child_dir): bool
    {
        $less_content = self::generate_less();
        $file = $child_dir . '/style.less';

        if (!self::write_file($file, $less_content, 'style.less', false)) {
            return false;
        }

        return true;
    }

    /**
     * Generates Less variable overrides for YOOtheme compilation.
     *
     * @return string The generated Less content with variable overrides.
     */
    public static function generate_less(): string
    {
        $less = "//\n";
        $less .= "// Enhanced Plugin Bundle - UIkit Variable Overrides\n";
        $less .= "// Generated: " . current_time('c') . "\n";
        $less .= "//\n";
        $less .= "// These variables override UIkit defaults when YOOtheme compiles Less.\n";
        $less .= "//\n\n";

        $components = Component_Registry::get_all();
        $has_variables = false;

        foreach ($components as $component_key => $component_data) {
            $saved = get_option(Component_Handler::OPTION_PREFIX . $component_key, []);

            if (empty($saved)) {
                continue;
            }

            $has_variables = true;
            $component_label = $component_data['label'] ?? ucfirst(str_replace('-', ' ', $component_key));
            $less .= "//\n// {$component_label}\n//\n\n";

            // Get grouped variables to preserve order.
            $grouped = Less_Parser::get_grouped_variables($component_key);

            foreach ($grouped as $group_vars) {
                foreach ($group_vars as $var_name => $meta) {
                    if (isset($saved[$var_name])) {
                        $value = $saved[$var_name];
                        $less .= "@{$var_name}: {$value};\n";
                    }
                }
            }

            $less .= "\n";
        }

        if (!$has_variables) {
            $less .= "// No custom variables defined yet.\n";
        }

        return $less;
    }

    /**
     * Generates the content for the child theme's style.css file.
     *
     * @return string The generated CSS content.
     */
    public static function generate_css(): string
    {
        // Generate CSS from component-based variables.
        return CSSGenerator::generate();
    }

    /**
     * Writes content to a file using WordPress Filesystem.
     *
     * @param string $path        File path.
     * @param string $content     Content to write.
     * @param string $filename    Filename for error messages.
     * @param bool   $show_error  Whether to show error notice on failure.
     * @return bool True on success, false on failure.
     */
    private static function write_file(string $path, string $content, string $filename, bool $show_error = true): bool
    {
        global $wp_filesystem;
        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }
        WP_Filesystem();

        if (!$wp_filesystem->put_contents($path, $content, FS_CHMOD_FILE)) {
            if ($show_error) {
                Notices::error(
                    sprintf(
                        /* translators: %s: filename */
                        __('Failed to create the child theme %s file.', 'enhanced-plugin-bundle'),
                        $filename
                    )
                );
            }
            return false;
        }

        return true;
    }
}
