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
     * @return array<int, array{slug: string, name: string, init_path: string}>
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

        $sanitized_plugins = array_map(
            static function ($plugin) {
                if (!is_array($plugin)) {
                    return null;
                }

                return [
                    'slug'      => (string) ($plugin['slug'] ?? ''),
                    'name'      => (string) ($plugin['name'] ?? ''),
                    'init_path' => $plugin['init_path'] ?? '',
                ];
            },
            $plugins
        );

        $normalized_plugins = array_values(array_filter(
            $sanitized_plugins,
            static function ($plugin) {
                return is_array($plugin)
                    && '' !== $plugin['slug']
                    && '' !== $plugin['name'];
            }
        ));

        if (empty($normalized_plugins)) {
            $normalized_plugins = self::get_default_plugins();
        }

        if ($normalized_plugins !== $plugins && function_exists('update_option')) {
            call_user_func('update_option', self::OPTION_NAME, $normalized_plugins);
        }

        return $normalized_plugins;
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
        $sanitized_plugins = array_map(
            static function ($plugin) {
                if (!is_array($plugin)) {
                    return null;
                }

                return [
                    'slug'      => (string) ($plugin['slug'] ?? ''),
                    'name'      => (string) ($plugin['name'] ?? ''),
                    'init_path' => $plugin['init_path'] ?? '',
                ];
            },
            $plugins
        );

        $normalized_plugins = array_values(array_filter(
            $sanitized_plugins,
            static function ($plugin) {
                return is_array($plugin)
                    && '' !== $plugin['slug']
                    && '' !== $plugin['name'];
            }
        ));

        if (!function_exists('update_option')) {
            return;
        }

        call_user_func('update_option', self::OPTION_NAME, $normalized_plugins);
    }

    /**
     * Returns the default list of plugins.
     *
     * This default array includes standard plugins with their slugs, names,
     * and initialization file paths.
     *
     * @return array<int, array{slug: string, name: string, init_path: string}>
     */
    public static function get_default_plugins(): array
    {
        return [
            // Standard plugins.
            [
                'slug'      => 'wordpress-seo',
                'name'      => 'Yoast SEO',
                'init_path' => 'wordpress-seo/wp-seo.php',
            ],
            [
                'slug'      => 'wp-mail-logging',
                'name'      => 'WP Mail Logging',
                'init_path' => '',
            ],
            [
                'slug'      => 'better-search-replace',
                'name'      => 'Better Search Replace',
                'init_path' => '',
            ],
            [
                'slug'      => 'ninja-forms',
                'name'      => 'Ninja Forms',
                'init_path' => '',
            ],
            [
                'slug'      => 'wp-mail-smtp',
                'name'      => 'WP Mail SMTP',
                'init_path' => 'wp-mail-smtp/wp_mail_smtp.php',
            ],
            [
                'slug'      => 'insert-headers-and-footers',
                'name'      => 'Insert Headers and Footers',
                'init_path' => 'insert-headers-and-footers/ihaf.php',
            ],
            [
                'slug'      => 'wps-hide-login',
                'name'      => 'WPS Hide Login',
                'init_path' => '',
            ],
            [
                'slug'      => 'wps-limit-login',
                'name'      => 'WPS Limit Login',
                'init_path' => '',
            ],
            [
                'slug'      => 'all-404-redirect-to-homepage',
                'name'      => 'All 404 Redirect to Homepage',
                'init_path' => '',
            ],
            [
                'slug'      => 'updraftplus',
                'name'      => 'UpdraftPlus WordPress Backup Plugin',
                'init_path' => '',
            ],
            [
                'slug'      => 'yith-maintenance-mode',
                'name'      => 'YITH Maintenance Mode',
                'init_path' => 'yith-maintenance-mode/init.php',
            ],
        ];
    }
}
