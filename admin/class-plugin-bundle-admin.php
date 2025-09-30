<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access for security reasons.
}

/**
 * Class Plugin_Bundle_Admin
 *
 * Handles all administrative functions for the Enhanced Plugin Bundle Manager.
 * This includes creating the admin menu, loading necessary CSS/JS assets,
 * processing form submissions, and rendering the admin interface.
 */
class Plugin_Bundle_Admin
{
    /**
     * Sets up the admin hooks for the Plugin Bundle Manager.
     *
     * This method hooks into several WordPress admin actions to:
     * - Create the plugin's admin menu entry.
     * - Enqueue CSS and JavaScript files specific to the admin interface.
     * - Process any form submissions made on the plugin's admin page.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('admin_menu', [self::class, 'register_admin_menu']);
        add_action('admin_enqueue_scripts', [self::class, 'enqueue_assets']);
        add_action('admin_init', [self::class, 'handle_form_submissions']);
    }

    /**
     * Registers the plugin's admin menu page.
     *
     * Adds a new top-level menu item to the WordPress admin sidebar. When selected,
     * it loads the settings page where users can manage plugin bundles.
     *
     * @return void
     */
    public static function register_admin_menu(): void
    {
        add_menu_page(
            // Page title that appears in the browser's title tag.
            Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_BUNDLE_MANAGER),
            // Menu title displayed in the admin sidebar.
            Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_BUNDLE),
            // Capability required to access this menu.
            'manage_options',
            // Unique slug for the admin page.
            'plugin-bundle-settings',
            // Callback function that renders the content of the admin page.
            [self::class, 'render_admin_page']
        );
    }

    /**
     * Enqueues CSS and JavaScript assets for the admin page.
     *
     * This function checks if the current admin page matches the plugin settings page
     * before loading assets. This conditional loading ensures that the files are only
     * added where needed.
     *
     * @param string $hook The current admin page hook.
     * @return void
     */
    public static function enqueue_assets(string $hook): void
    {
        // Only load assets for the Plugin Bundle settings page.
        if ('toplevel_page_plugin-bundle-settings' !== $hook) {
            return;
        }

        // Enqueue external font stylesheet.
        wp_enqueue_style('epb-adobe-fonts', 'https://use.typekit.net/ome1ekv.css', [], null);

        // Enqueue custom admin CSS.
        wp_enqueue_style(
            'epb-admin-style', // Unique handle for the stylesheet.
            EPB_PLUGIN_URL . 'assets/css/admin.css', // Path to the CSS file.
            [], // No dependencies.
            '1.0.0' // Version number.
        );
        // Enqueue custom admin JavaScript.
        wp_enqueue_script(
            'epb-admin-script', // Unique handle for the JS file.
            EPB_PLUGIN_URL . 'assets/js/admin.js', // Path to the JS file.
            ['jquery'], // Dependency on jQuery.
            '1.0.0', // Version number.
            true // Load script in the footer.
        );

        if (function_exists('wp_localize_script')) {
            call_user_func(
                'wp_localize_script',
                'epb-admin-script',
                'EPBAdminL10n',
                [
                    'pluginSelectionUnavailable' => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::JS_WARNING_PLUGIN_UI_MISSING),
                    'selectAtLeastOne'          => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::JS_ERROR_SELECT_PLUGIN),
                ]
            );
        }
    }

    /**
     * Processes form submissions on the admin page.
     *
     * This method first verifies that the current page is the plugin settings page.
     * If a POST request is detected, it delegates further processing to the theme
     * and plugin form handlers.
     *
     * @return void
     */
    public static function handle_form_submissions(): void
    {
        // Ensure we are on the Plugin Bundle settings page.
        if (!isset($_GET['page']) || 'plugin-bundle-settings' !== $_GET['page']) {
            return;
        }

        // Only process if the request method is POST.
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            // Delegate form action processing for themes and plugins.
            Plugin_Bundle_Themes::handle_form_actions();
            Plugin_Bundle_Plugins::handle_form_actions();
        }
    }

    /**
     * Renders the Plugin Bundle Manager admin page.
     *
     * This method retrieves the list of plugins and then displays the admin page which includes:
     * - A form for bulk actions on plugins.
     * - A section for uploading a parent theme.
     * - A section for creating a child theme.
     *
     * @return void
     */
    public static function render_admin_page(): void
    {
        // Get grouped list of available plugins.
        $plugins = Plugin_Bundle_Plugins::get_plugin_list();
?>
        <div class="wrap">
            <div class="ppm-header">
                <div class="ppm-header-left">
                    <img src="<?php echo esc_url(EPB_PLUGIN_URL . 'assets/images/Plappermaul_Logo_NEW_mitClaim-white.svg'); ?>" alt="Company Logo" class="ppm-logo" />
                    <h1 class="ppm-h1"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_BUNDLE_MANAGER)); ?></h1>
                </div>
            </div>
            <!-- Form for handling bulk actions on plugins -->
            <form method="post">
                <div class="ppm-section">
                    <?php Plugin_Bundle_Plugins::render_bulk_controls(); ?>
                    <?php Plugin_Bundle_Plugins::render_plugin_table($plugins); ?>
                </div>
            </form>
            <!-- Form for uploading a parent theme -->
            <form method="post" enctype="multipart/form-data">
                <?php Plugin_Bundle_Themes::render_upload_parent_theme_section(); ?>
            </form>
            <!-- Form for creating a child theme -->
            <form method="post" enctype="multipart/form-data">
                <?php Plugin_Bundle_Themes::render_create_child_theme_section(); ?>
            </form>
        </div>
<?php
    }
}
