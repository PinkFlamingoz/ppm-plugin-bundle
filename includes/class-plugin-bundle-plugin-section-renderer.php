<?php
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Class Plugin_Bundle_Plugins_Renderer
 *
 * Responsible for rendering the plugin management UI components in the admin interface.
 * This includes bulk controls, the main plugin table, and individual plugin groups.
 */
class Plugin_Bundle_Plugins_Renderer
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
                <option value="install"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::INSTALL)); ?></option>
                <option value="activate"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ACTIVATE)); ?></option>
                <option value="deactivate"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::DEACTIVATE)); ?></option>
                <option value="delete"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::DELETE)); ?></option>
                <option value="delete_from_list"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::DELETE_FROM_LIST)); ?></option>
            </select>
            <input type="submit" name="bulk_action_submit" class="ppm-button ppm-button-primary" value="<?php echo esc_attr(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::APPLY_TO_SELECTED)); ?>">
        </div>
    <?php
    }

    /**
     * Renders the complete table of plugins along with their statuses.
     *
     * The table includes headers for selection, plugin name, initialization file path, and status.
     * All configured plugin groups are displayed sequentially, followed by the add-new row.
     *
     * @param array $plugins Array of plugins grouped by type.
     * @return void
     */
    public static function render_plugin_table(array $plugins): void
    {
        // Retrieve mapping of plugin slugs to their initialization file paths.
        $files = Plugin_Bundle_Plugins::get_plugin_files();
    ?>
        <table class="plugin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">
                        <input type="checkbox" id="select-all" title="<?php echo esc_attr(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::TABLE_HEADER_SELECT_ALL)); ?>">
                    </th>
                    <th><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::TABLE_HEADER_PLUGIN)); ?></th>
                    <th><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::TABLE_HEADER_INIT_PATH)); ?></th>
                    <th><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::TABLE_HEADER_STATUS)); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($plugins as $group_slug => $group_plugins) {
                    if (empty($group_plugins)) {
                        continue;
                    }

                    $group_label = Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::GROUP_STANDARD);
                    if ('standard' !== $group_slug) {
                        $group_label = ucwords(str_replace(['-', '_'], ' ', $group_slug));
                    }

                    self::render_plugin_group(
                        $group_label . ' ' . Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::PLUGIN_BUNDLE),
                        $group_plugins,
                        $group_slug,
                        $files
                    );
                }
                ?>
                <tr>
                    <td colspan="4">
                        <h2 class="ppm-heading"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ADD_NEW_PLUGIN)); ?></h2>
                        <div class="new-plugin-container">
                            <input type="text" name="new_plugin_url" placeholder="Enter plugin URL (e.g., https://wordpress.org/plugins/wordpress-seo/)">
                            <button type="submit" class="ppm-button ppm-button-primary" name="add_plugin">
                                <?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ADD_NEW_PLUGIN)); ?>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php
    }

    /**
     * Renders a group of plugins.
     *
     * Outputs a header row for the plugin group with a checkbox for selecting all plugins in the group,
     * then iterates through each plugin to display its name, initialization file path, and status.
     *
     * @param string $group_name  Display name for the group.
     * @param array  $plugin_list Associative array mapping plugin slug to plugin name.
     * @param string $group_slug  Identifier for the group.
     * @param array  $files       Mapping of plugin slug to its initialization file path.
     * @return void
     */
    public static function render_plugin_group(string $group_name, array $plugin_list, string $group_slug, array $files): void
    {
    ?>
        <tr>
            <td colspan="4" class="group-header">
                <input type="checkbox" id="select-<?php echo esc_attr($group_slug); ?>" class="group-select-checkbox" title="<?php echo esc_attr(sprintf(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::SELECT_GROUP), $group_name)); ?>">
                <strong><?php echo esc_html($group_name); ?></strong>
            </td>
        </tr>
        <?php
        foreach ($plugin_list as $slug => $name) {
            $status = Plugin_Bundle_Plugins::get_plugin_status($slug);
            $status_class = (Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_ACTIVE) === $status['label'])
                ? 'status-active'
                : ((Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_DEACTIVATED) === $status['label']) ? 'status-inactive' : 'status-not-installed');
        ?>
            <tr>
                <td>
                    <input type="checkbox" name="selected_plugins[]" value="<?php echo esc_attr($slug); ?>" data-group="<?php echo esc_attr($group_slug); ?>">
                </td>
                <td><?php echo esc_html($name); ?></td>
                <td><?php echo esc_html($files[$slug]); ?></td>
                <td class="<?php echo esc_attr($status_class); ?>"><?php echo esc_html($status['label']); ?></td>
            </tr>
<?php
        }
    }
}
