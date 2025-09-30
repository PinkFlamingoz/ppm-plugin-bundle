<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access for security reasons.
}

/**
 * Class Plugin_Bundle_Plugins
 *
 * Manages the plugin bundles in the admin area by handling:
 * - Retrieval and grouping of dynamic plugins.
 * - Determination of plugin status (installed, active, etc.).
 * - Installation, activation, deactivation, deletion of plugins.
 * - Rendering of the associated UI elements.
 */
class Plugin_Bundle_Plugins
{
    /**
     * Retrieves dynamic plugins stored in WordPress options.
     *
     * These dynamic plugins are managed by Plugin_Bundle_Plugins_Options and include
     * details such as slug, name, initialization file path, and group.
     *
     * @return array<int, array{slug: string, name: string, init_path: string}>
     */
    private static function get_dynamic_plugins(): array
    {
        return Plugin_Bundle_Plugins_Options::get_dynamic_plugins();
    }

    /**
     * Returns a map of plugin slugs to their display names.
     *
     * @return array<string, string>
     */
    public static function get_plugin_list(): array
    {
        $dynamic = self::get_dynamic_plugins();
        $plugins = [];
        foreach ($dynamic as $plugin) {
            $plugins[$plugin['slug']] = $plugin['name'];
        }

        return $plugins;
    }

    /**
     * Maps plugin slugs to their main initialization file paths.
     *
     * For each dynamic plugin, uses the 'init_path' if set; otherwise, guesses a default path.
     *
     * @return array<string, string> Array mapping plugin slug to its file path.
     */
    public static function get_plugin_files(): array
    {
        $dynamic = self::get_dynamic_plugins();
        $files   = [];
        foreach ($dynamic as $plugin) {
            $files[$plugin['slug']] = !empty($plugin['init_path'])
                ? $plugin['init_path']
                : "{$plugin['slug']}/{$plugin['slug']}.php";
        }
        return $files;
    }

    /**
     * Resolves the plugin file registered for the provided slug.
     *
     * Prints an error notice and returns null when the slug is not part of the tracked list.
     *
     * @param string $slug The plugin slug to resolve.
     * @return string|null The plugin file relative path or null when not found.
     */
    private static function resolve_plugin_file(string $slug): ?string
    {
        $files = self::get_plugin_files();

        if (empty($files[$slug])) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_PLUGIN_NOT_IN_LIST), $slug)
            );

            return null;
        }

        return $files[$slug];
    }

    /**
     * Auto-detects a plugin's initialization file path.
     *
     * Scans all plugins using WordPress's get_plugins() to locate the main file
     * for the specified plugin slug. Returns the file path if found or an empty string.
     *
     * @param string $slug The plugin slug (usually the folder name).
     * @return string The detected initialization file path, or an empty string if not found.
     */
    private static function auto_detect_plugin_init_path(string $slug): string
    {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $all_plugins = get_plugins();
        foreach ($all_plugins as $plugin_file => $plugin_data) {
            // Check if the plugin file resides in a folder that matches the slug.
            if (strpos($plugin_file, $slug . '/') === 0) {
                return $plugin_file;
            }
        }
        return '';
    }

    /**
     * Determines the current status of a plugin.
     *
     * Checks whether the plugin is installed (its folder exists) and if it's active.
     * Returns a status label and a corresponding CSS class for UI display.
     *
     * @param string $slug The plugin slug.
     * @return array{label: string, css_class: string} Status label and CSS class.
     */
    public static function get_plugin_status(string $slug): array
    {
        $files       = self::get_plugin_files();
        $plugin_file = $files[$slug];

        if (!is_dir(WP_PLUGIN_DIR . '/' . $slug)) {
            return [
                'label'     => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_NOT_INSTALLED),
                'css_class' => 'ppm-status-danger',
            ];
        }
        return is_plugin_active($plugin_file)
            ? [
                'label'     => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_ACTIVE),
                'css_class' => 'ppm-status-success',
            ]
            : [
                'label'     => Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_DEACTIVATED),
                'css_class' => 'ppm-status-warning',
            ];
    }

    /**
     * Delegates plugin actions to the corresponding helper methods.
     *
     * Based on the action parameter (install, activate, deactivate, delete), calls
     * the appropriate internal function to perform the action.
     *
     * @param string $slug   The plugin slug.
     * @param string $action The action to perform.
     */
    public static function handle_plugin_action(string $slug, string $action): void
    {
        switch ($action) {
            case 'install':
                self::do_install($slug);
                break;
            case 'activate':
                self::do_activate($slug);
                break;
            case 'deactivate':
                self::do_deactivate($slug);
                break;
            case 'delete':
                self::do_delete($slug);
                break;
        }
    }

    /**
     * Installs a plugin if not already present and updates its init path.
     *
     * Checks if the plugin folder exists; if not, installs the plugin. Then,
     * auto-detects and updates the plugin's initialization path in the dynamic list.
     *
     * @param string $slug The plugin slug.
     */
    private static function do_install(string $slug): void
    {
        if (!self::plugin_already_exists($slug)) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_PLUGIN_NOT_IN_LIST), $slug)
            );
            return;
        }

        if (!is_dir(WP_PLUGIN_DIR . '/' . $slug)) {
            $result = self::install_plugin($slug);
        }

        // Update the initialization path after installation.
        $dynamic = self::get_dynamic_plugins();
        foreach ($dynamic as &$plugin) {
            if ($plugin['slug'] === $slug) {
                $detected = self::auto_detect_plugin_init_path($slug);
                if (!empty($detected)) {
                    $plugin['init_path'] = $detected;
                }
            }
        }

        Plugin_Bundle_Plugins_Options::update_dynamic_plugins($dynamic);
        Plugin_Bundle_Plugins_Notices::display_action_result($slug, $result, 'activated');
    }

    /**
     * Downloads and installs a plugin from WordPress.org.
     *
     * Retrieves plugin information via the plugins API and uses Plugin_Upgrader to
     * download and install the plugin. After installation, the page reloads to reflect changes.
     * If an error occurs, an error notice is displayed.
     *
     * @param string $slug The plugin slug.
     */
    public static function install_plugin(string $slug): void
    {
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $api = plugins_api('plugin_information', ['slug' => $slug]);
        if (!is_wp_error($api)) {
            $upgrader = new Plugin_Upgrader();
            // Suppress output during installation.

            $upgrader->install($api->download_link);
        } else {
            Plugin_Bundle_Plugins_Notices::print_notice('error', sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_FETCH_PLUGIN), $slug));
        }
    }

    /**
     * Activates a plugin if it is installed and currently inactive.
     *
     * Verifies the existence of the plugin file before attempting activation.
     * If activation fails, an error notice is displayed.
     *
     * @param string $slug The plugin slug.
     */
    private static function do_activate(string $slug): void
    {
        $plugin_file = self::resolve_plugin_file($slug);
        if (null === $plugin_file) {
            return;
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            self::do_install($slug);

            $plugin_file = self::resolve_plugin_file($slug);
            if (null === $plugin_file) {
                return;
            }

            if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
                Plugin_Bundle_Plugins_Notices::print_notice(
                    'error',
                    sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_PLUGIN_NOT_INSTALLED), $slug)
                );
                return;
            }
        }

        if (is_plugin_inactive($plugin_file)) {

            $result = activate_plugin($plugin_file);

            Plugin_Bundle_Plugins_Notices::display_action_result($slug, $result, 'activated');
        }
    }

    /**
     * Deactivates an active plugin.
     *
     * @param string $slug The plugin slug.
     */
    private static function do_deactivate(string $slug): void
    {
        $plugin_file = self::resolve_plugin_file($slug);
        if (null === $plugin_file) {
            return;
        }
        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_PLUGIN_NOT_INSTALLED), $slug));
            return;
        }

        if (is_plugin_active($plugin_file)) {

            $result = deactivate_plugins($plugin_file);

            Plugin_Bundle_Plugins_Notices::display_action_result($slug, $result, 'deactivated');
        }
    }

    /**
     * Deletes a plugin from the system.
     *
     * First deactivates the plugin and then deletes it.
     *
     * @param string $slug The plugin slug.
     */
    private static function do_delete(string $slug): void
    {
        $plugin_file = self::resolve_plugin_file($slug);
        if (null === $plugin_file) {
            return;
        }
        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_PLUGIN_NOT_INSTALLED), $slug));
            return;
        }

        if (is_plugin_active($plugin_file)) {
            deactivate_plugins($plugin_file);
        }

        if (!function_exists('delete_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        if (!class_exists('Plugin_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $result = delete_plugins([$plugin_file]);
        if (is_wp_error($result)) {
            Plugin_Bundle_Plugins_Notices::print_notice(
                'error',
                sprintf(
                    Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_FAILED_TO_ACTION_PLUGIN),
                    'delete',
                    $slug,
                    $result->get_error_message()
                )
            );
            return;
        }

        Plugin_Bundle_Plugins_Notices::display_action_result($slug, $result, 'deleted');
    }

    // ––– Rendering Functions –––

    /**
     * Renders bulk action controls and dynamic update/save buttons.
     *
     * Outputs HTML for a dropdown of bulk actions (install, activate, deactivate, delete, delete from list)
     * along with a submit button.
     */
    public static function render_bulk_controls(): void
    {
        Plugin_Bundle_Plugins_Renderer::render_bulk_controls();
    }

    /**
     * Renders the complete plugins table with statuses and metadata.
     *
     * Displays each plugin's name, initialization path, and status, along with an option
     * to append additional plugins via URL.
     *
     * @param array<string, string> $plugins Associative array mapping plugin slug to display name.
     */
    public static function render_plugin_table(array $plugins): void
    {
        Plugin_Bundle_Plugins_Renderer::render_plugin_table($plugins);
    }

    /**
     * Processes all form actions submitted from the admin interface.
     *
     * Handles plugin addition and bulk actions (including removing plugins from the tracked list)
     * by delegating to the respective processing methods.
     */
    public static function handle_form_actions(): void
    {
        self::process_add_plugin();
        self::process_bulk_actions();
    }

    /**
     * Removes one or more plugins from the dynamic tracking list.
     *
     * Updates the stored option and displays a success notice when at least one plugin is removed.
     *
     * @param array<int, string> $slugs List of plugin slugs to remove.
     * @return void
     */
    private static function remove_plugins_from_list(array $slugs): void
    {
        $sanitized = array_unique(array_filter(array_map('sanitize_text_field', $slugs)));
        if (empty($sanitized)) {
            return;
        }

        $dynamic        = self::get_dynamic_plugins();
        $original_count = count($dynamic);

        $dynamic = array_values(array_filter(
            $dynamic,
            static function ($plugin) use ($sanitized) {
                return !in_array($plugin['slug'], $sanitized, true);
            }
        ));

        if ($original_count === count($dynamic)) {
            return;
        }

        Plugin_Bundle_Plugins_Options::update_dynamic_plugins($dynamic);
        Plugin_Bundle_Plugins_Notices::print_notice('success', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_REMOVED_SUCCESS));
    }

    /**
     * Processes the addition of a new plugin via a submitted URL.
     *
     * Validates the URL, extracts the plugin slug, checks for duplicates, fetches plugin info
     * from WordPress.org, and adds the plugin to the dynamic list if all validations pass.
     */
    private static function process_add_plugin(): void
    {
        if (!isset($_POST['add_plugin'])) {
            return;
        }

        $url   = sanitize_text_field($_POST['new_plugin_url'] ?? '');

        if (empty($url)) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', 'Please enter a valid plugin URL.');
            return;
        }

        $host = (string) parse_url($url, PHP_URL_HOST);
        $path = (string) parse_url($url, PHP_URL_PATH);
        if (!preg_match('/(^|\.)wordpress\.org$/i', $host) || strpos($path, '/plugins/') !== 0) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_INVALID_PLUGIN_URL));
            return;
        }

        $slug = self::extract_plugin_slug($url);
        if (!$slug) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ERROR_INVALID_PLUGIN_URL));
            return;
        }

        if (self::plugin_already_exists($slug)) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_SLUG_EXISTS_ERROR));
            return;
        }

        $plugin_info = self::fetch_plugin_info($slug);
        if (!$plugin_info) {
            Plugin_Bundle_Plugins_Notices::print_notice('error', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_SLUG_COULD_NOT_RETRIEVE_ERROR));
            return;
        }

        self::add_plugin_to_dynamic_list($slug, $plugin_info['name']);
        Plugin_Bundle_Plugins_Notices::print_notice('success', Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::NEW_PLUGIN_ADDED_SUCCESS));
    }

    /**
     * Extracts the plugin slug from a given WordPress.org plugin URL.
     *
     * The slug is typically the second segment of the URL path.
     *
     * @param string $url The plugin URL.
     * @return string|null The extracted plugin slug, or null if extraction fails.
     */
    private static function extract_plugin_slug(string $url): ?string
    {
        $parsed_url = parse_url($url, PHP_URL_PATH);
        $parts = explode('/', trim($parsed_url, '/'));

        return $parts[1] ?? null; // Returns the second part (e.g., 'wordpress-seo') as the slug.
    }

    /**
     * Checks if a plugin with the given slug already exists in the dynamic list.
     *
     * @param string $slug The plugin slug.
     * @return bool True if the plugin exists, false otherwise.
     */
    private static function plugin_already_exists(string $slug): bool
    {
        $dynamic = self::get_dynamic_plugins();
        foreach ($dynamic as $plugin) {
            if ($plugin['slug'] === $slug) {
                return true;
            }
        }
        return false;
    }

    /**
     * Fetches plugin information from WordPress.org using the plugins API.
     *
     * Retrieves details such as the plugin's name and attempts to auto-detect the initialization file path.
     *
     * @param string $slug The plugin slug.
     * @return array|null An associative array with 'name' and 'init_path', or null on failure.
     */
    private static function fetch_plugin_info(string $slug): ?array
    {
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        $api = plugins_api('plugin_information', ['slug' => $slug]);
        if (is_wp_error($api)) {
            return null;
        }

        return [
            'name'      => $api->name,
            'init_path' => self::auto_detect_plugin_init_path($slug),
        ];
    }

    /**
     * Adds a new plugin to the dynamic list and updates the options.
     *
     * Appends the new plugin with its slug, name, and auto-detected initialization path
     * to the dynamic plugins list.
     *
     * @param string $slug The plugin slug.
     * @param string $name The plugin display name.
     */
    private static function add_plugin_to_dynamic_list(string $slug, string $name): void
    {
        $dynamic = self::get_dynamic_plugins();
        $dynamic[] = [
            'slug'      => $slug,
            'name'      => $name,
            'init_path' => self::auto_detect_plugin_init_path($slug),
        ];

        Plugin_Bundle_Plugins_Options::update_dynamic_plugins($dynamic);
    }

    /**
     * Processes bulk actions on selected plugins from the admin form.
     *
     * Sanitizes input and applies the selected bulk action (install, activate, deactivate, or delete)
     * to each chosen plugin.
     */
    private static function process_bulk_actions(): void
    {
        if (!isset($_POST['bulk_action_submit'], $_POST['selected_plugins'])) {
            return;
        }
        $bulk_action      = sanitize_text_field((string) $_POST['bulk_action']);
        $selected_plugins = array_unique(array_filter(array_map('sanitize_text_field', (array) $_POST['selected_plugins'])));

        if ('delete_from_list' === $bulk_action) {
            self::remove_plugins_from_list($selected_plugins);
            return;
        }

        if (!in_array($bulk_action, ['install', 'activate', 'deactivate', 'delete'], true)) {
            return;
        }

        foreach ($selected_plugins as $slug) {
            self::handle_plugin_action($slug, $bulk_action);
        }
    }
}
