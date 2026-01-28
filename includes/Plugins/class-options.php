<?php

/**
 * Plugin options storage for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Plugins
 */

namespace EPB\Plugins;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Options
 *
 * Manages the storage, retrieval, and updating of dynamic plugin options.
 * Initializes the plugin options with a default list if none exists
 * and provides methods to update these options in the WordPress database.
 */
class Options
{
    /**
     * Option name for storing the dynamic plugins list in the WordPress options table.
     *
     * @var string
     */
    public const OPTION_NAME = 'epb_dynamic_plugins';

    /**
     * Sanitizes and normalizes an array of plugin data.
     *
     * @param array $plugins Raw plugins array.
     * @return array Sanitized and normalized plugins array.
     */
    private static function sanitize_plugins(array $plugins): array
    {
        $sanitized = array_map(
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

        return array_values(array_filter(
            $sanitized,
            static function ($plugin) {
                return is_array($plugin)
                    && '' !== $plugin['slug']
                    && '' !== $plugin['name'];
            }
        ));
    }

    /**
     * Retrieves the dynamic plugins from the WordPress options.
     *
     * If no plugins are stored, this method loads the default plugins list and saves it.
     *
     * @return array<int, array{slug: string, name: string, init_path: string}>
     */
    public static function get(): array
    {
        // Retrieve the dynamic plugins option, defaulting to an empty array if not set.
        $plugins = get_option(self::OPTION_NAME, []);

        // If no plugins exist, initialize with the default plugins list and save it.
        if (empty($plugins)) {
            $plugins = self::get_defaults();
            update_option(self::OPTION_NAME, $plugins);
        }

        $normalized_plugins = self::sanitize_plugins($plugins);

        if (empty($normalized_plugins)) {
            $normalized_plugins = self::get_defaults();
        }

        // Update if sanitization changed the data.
        if ($normalized_plugins !== $plugins) {
            update_option(self::OPTION_NAME, $normalized_plugins);
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
    public static function update(array $plugins): void
    {
        $normalized_plugins = self::sanitize_plugins($plugins);
        update_option(self::OPTION_NAME, $normalized_plugins);
    }

    /**
     * Returns the default list of plugins.
     *
     * This default array includes standard plugins with their slugs, names,
     * and initialization file paths.
     *
     * @return array<int, array{slug: string, name: string, init_path: string}>
     */
    public static function get_defaults(): array
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
                'slug'      => 'webp-converter-for-media',
                'name'      => 'WebP Converter for Media',
                'init_path' => '',
            ],
            [
                'slug'      => 'safe-svg',
                'name'      => 'Safe SVG',
                'init_path' => '',
            ],
        ];
    }
}
