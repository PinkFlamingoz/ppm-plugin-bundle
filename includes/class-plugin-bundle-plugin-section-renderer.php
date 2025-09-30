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
     * All configured plugins are displayed sequentially, followed by the add-new row to append more plugins.
     *
     * @param array<string, string> $plugins Associative array mapping plugin slug to display name.
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
                foreach ($plugins as $slug => $name) {
                    $status       = Plugin_Bundle_Plugins::get_plugin_status($slug);
                    $status_label = $status['label'];
                    $status_class = (Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_ACTIVE) === $status_label)
                        ? 'status-active'
                        : ((Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::STATUS_INSTALLED_DEACTIVATED) === $status_label) ? 'status-inactive' : 'status-not-installed');
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_plugins[]" value="<?php echo esc_attr($slug); ?>">
                        </td>
                        <td><?php echo esc_html($name); ?></td>
                        <td><?php echo esc_html($files[$slug] ?? ''); ?></td>
                        <td class="<?php echo esc_attr($status_class); ?>"><?php echo esc_html($status_label); ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4">
                        <h2 class="ppm-heading"><?php echo esc_html(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::ADD_NEW_PLUGIN)); ?></h2>
                        <div class="new-plugin-container">
                            <input type="text" name="new_plugin_url" placeholder="<?php echo esc_attr(Plugin_Bundle_Texts::get(Plugin_Bundle_Texts::NEW_PLUGIN_URL_PLACEHOLDER)); ?>">
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
}
