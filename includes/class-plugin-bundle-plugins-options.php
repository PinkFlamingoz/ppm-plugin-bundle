<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access.
}

/**
 * Class Plugin_Bundle_Plugins_Options
 *
 * Manages the storage, retrieval, and updating of dynamic plugin options.
 * This class initializes the plugin options with a default list if none exists
 * and provides methods to update these options in the WordPress database.
 */
class Plugin_Bundle_Plugins_Options
{
    /**
     * Option name for storing the dynamic plugins list in the WordPress options table.
     *
     * @var string
     */
    const OPTION_NAME = 'epb_dynamic_plugins';

    /**
     * Retrieves the dynamic plugins from the WordPress options.
     *
     * If no plugins are stored, this method loads the default plugins list and saves it.
     *
     * @return array<int, array{slug: string, name: string, init_path: string, group: string}>
     */
    public static function get_dynamic_plugins(): array
    {
        // Retrieve the dynamic plugins option, defaulting to an empty array if not set.
        $plugins = get_option(self::OPTION_NAME, []);

        // If no plugins exist, initialize with the default plugins list and save it.
        if (empty($plugins)) {
            $plugins = self::get_default_plugins();
            update_option(self::OPTION_NAME, $plugins);
        }

        // Remove deprecated webshop entries to keep the bundle focused on standard plugins only.
        $filtered_plugins = array_values(array_filter(
            $plugins,
            static function ($plugin) {
                if (!isset($plugin['slug'])) {
                    return false;
                }

                if ('woocommerce' === $plugin['slug']) {
                    return false;
                }

                $group = $plugin['group'] ?? '';
                return empty($group) || 'webshop' !== $group;
            }
        ));

        if ($filtered_plugins !== $plugins) {
            update_option(self::OPTION_NAME, $filtered_plugins);
        }

        return $filtered_plugins;
    }

    /**
     * Updates the dynamic plugins list in the WordPress options.
     *
     * Saves the modified plugins array to the database using the defined option name.
     *
     * @param array $plugins The updated plugins array.
     * @return void
     */
    public static function update_dynamic_plugins(array $plugins): void
    {
        update_option(self::OPTION_NAME, $plugins);
    }

    /**
     * Returns the default list of plugins.
     *
     * This default array includes standard plugins with their slugs, names,
     * initialization file paths, and group classifications.
     *
     * @return array<int, array{slug: string, name: string, init_path: string, group: string}>
     */
    public static function get_default_plugins(): array
    {
        return [
            // Standard plugins.
            [
                'slug'      => 'wordpress-seo',
                'name'      => 'Yoast SEO',
                'init_path' => 'wordpress-seo/wp-seo.php',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'wp-mail-logging',
                'name'      => 'WP Mail Logging',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'better-search-replace',
                'name'      => 'Better Search Replace',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'ninja-forms',
                'name'      => 'Ninja Forms',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'wp-mail-smtp',
                'name'      => 'WP Mail SMTP',
                'init_path' => 'wp-mail-smtp/wp_mail_smtp.php',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'insert-headers-and-footers',
                'name'      => 'Insert Headers and Footers',
                'init_path' => 'insert-headers-and-footers/ihaf.php',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'wps-hide-login',
                'name'      => 'WPS Hide Login',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'wps-limit-login',
                'name'      => 'WPS Limit Login',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'all-404-redirect-to-homepage',
                'name'      => 'All 404 Redirect to Homepage',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'updraftplus',
                'name'      => 'UpdraftPlus WordPress Backup Plugin',
                'init_path' => '',
                'group'     => 'standard',
            ],
            [
                'slug'      => 'yith-maintenance-mode',
                'name'      => 'YITH Maintenance Mode',
                'init_path' => 'yith-maintenance-mode/init.php',
                'group'     => 'standard',
            ],
        ];
    }
}
