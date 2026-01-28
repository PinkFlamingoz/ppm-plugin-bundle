<?php

/**
 * Plugin UI renderer for Enhanced Plugin Bundle.
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
 * Class Renderer
 *
 * Responsible for rendering the plugin management UI components in the admin interface.
 * This includes bulk controls, the main plugin table, and individual plugin groups.
 */
class Renderer
{
    /**
     * Renders the bulk action controls for plugin management.
     *
     * Outputs a dropdown to select a bulk action (install, activate, deactivate, delete, delete from list)
     * and a submit button to apply the action to selected plugins.
     *
     * @return void
     */
    public static function render_bulk_controls(): void
    {
?>
        <div class="bulk-controls">
            <select name="bulk_action" class="ppm-select">
                <option value="install"><?php esc_html_e('Install', 'enhanced-plugin-bundle'); ?></option>
                <option value="activate"><?php esc_html_e('Activate', 'enhanced-plugin-bundle'); ?></option>
                <option value="deactivate"><?php esc_html_e('Deactivate', 'enhanced-plugin-bundle'); ?></option>
                <option value="delete"><?php esc_html_e('Delete', 'enhanced-plugin-bundle'); ?></option>
                <option value="delete_from_list"><?php esc_html_e('Delete from List', 'enhanced-plugin-bundle'); ?></option>
            </select>
            <input type="submit" name="bulk_action_submit" class="ppm-button ppm-button-primary" value="<?php echo esc_attr__('Apply to Selected', 'enhanced-plugin-bundle'); ?>">
        </div>
    <?php
    }

    /**
     * Renders the complete table of plugins along with their statuses.
     *
     * The table includes headers for selection, plugin name, initialization file path, and status.
     * All configured plugins are displayed sequentially, followed by the add-new row to append more plugins.
     *
     * @param array<string, string> $plugins Associative array mapping plugin slug to display name.
     * @return void
     */
    public static function render_plugin_table(array $plugins): void
    {
        // Retrieve mapping of plugin slugs to their initialization file paths.
        $files = Manager::get_plugin_files();
    ?>
        <table class="plugin-table">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all" title="<?php esc_attr_e('Select All', 'enhanced-plugin-bundle'); ?>">
                    </th>
                    <th><?php esc_html_e('Plugin', 'enhanced-plugin-bundle'); ?></th>
                    <th><?php esc_html_e('Init Path', 'enhanced-plugin-bundle'); ?></th>
                    <th><?php esc_html_e('Status', 'enhanced-plugin-bundle'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($plugins as $slug => $name) {
                    $status       = Manager::get_plugin_status($slug);
                    $status_label = $status['label'];
                    // Use the CSS class from status array for reliable styling
                    $css_class    = $status['css_class'];
                    $status_class = match ($css_class) {
                        'ppm-status-success' => 'status-active',
                        'ppm-status-warning' => 'status-inactive',
                        default              => 'status-not-installed',
                    };
                ?>
                    <tr data-plugin-slug="<?php echo esc_attr($slug); ?>">
                        <td>
                            <input type="checkbox" name="selected_plugins[]" value="<?php echo esc_attr($slug); ?>">
                        </td>
                        <td><?php echo esc_html($name); ?></td>
                        <td><?php echo esc_html($files[$slug] ?? ''); ?></td>
                        <td class="plugin-status <?php echo esc_attr($status_class); ?>"><?php echo esc_html($status_label); ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4">
                        <h2 class="ppm-heading"><?php esc_html_e('Add New Plugin', 'enhanced-plugin-bundle'); ?></h2>
                        <div class="new-plugin-container">
                            <input type="text" name="new_plugin_url" placeholder="<?php esc_attr_e('Enter plugin URL (e.g., https://wordpress.org/plugins/wordpress-seo/)', 'enhanced-plugin-bundle'); ?>">
                            <button type="submit" class="ppm-button ppm-button-primary" name="add_plugin">
                                <?php esc_html_e('Add New Plugin', 'enhanced-plugin-bundle'); ?>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
<?php
    }
}
