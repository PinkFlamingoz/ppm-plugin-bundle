<?php

/**
 * Upgrade handler for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Upgrader
 *
 * Handles plugin upgrade routines when the version changes.
 * Runs migration or update routines as needed.
 */
class Upgrader
{
    /**
     * Runs upgrade routines when the plugin version changes.
     *
     * Compares the stored version with the current version and runs
     * any necessary migration or update routines.
     *
     * @return void
     */
    public static function maybe_upgrade(): void
    {
        $stored_version = get_option('epb_version', '0');

        // Safety net: attempt to recover component settings from the child theme
        // if none exist in the database. This covers cases where the activation
        // hook didn't fire (e.g. manual file replacement) or recovery failed.
        Activator::maybe_recover_settings();

        // Ensure the settings backup file exists in the child theme.
        // This seeds the backup for installs that predate the backup feature.
        self::maybe_seed_settings_backup();

        // Skip if already up to date.
        if (version_compare($stored_version, EPB_VERSION, '>=')) {
            return;
        }

        // Upgrade from version < 3.5 (sanitization and security improvements).
        if (version_compare($stored_version, '3.5', '<')) {
            self::upgrade_to_3_5();
        }

        // Upgrade from version < 4.0 (modular architecture).
        if (version_compare($stored_version, '4.0', '<')) {
            self::upgrade_to_4_0();
        }

        // Future upgrades can be added here:
        // if (version_compare($stored_version, '5.0', '<')) {
        //     self::upgrade_to_5_0();
        // }

        // Update the stored version.
        update_option('epb_version', EPB_VERSION);
    }

    /**
     * Upgrade routines for version 3.5.
     *
     * @return void
     */
    private static function upgrade_to_3_5(): void
    {
        self::clear_cache_and_log('3.5');
    }

    /**
     * Upgrade routines for version 4.0 (modular architecture).
     *
     * @return void
     */
    private static function upgrade_to_4_0(): void
    {
        self::clear_cache_and_log('4.0 (modular architecture)');
    }

    /**
     * Common upgrade routine: clear cache and log.
     *
     * @param string $version Version identifier for logging.
     * @return void
     */
    private static function clear_cache_and_log(string $version): void
    {
        // Clear any cached data to ensure fresh state.
        delete_transient('epb_plugin_cache');

        // Log upgrade if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Running upgrade routines for version ' . $version);
        }
    }

    /**
     * Write the settings backup JSON if it doesn't exist yet.
     *
     * Seeds the backup for existing installs that predate the backup feature,
     * so that a future delete + reinstall can recover all settings.
     * Only runs once — skips if the file already exists.
     *
     * @return void
     */
    private static function maybe_seed_settings_backup(): void
    {
        if (!class_exists(\EPB\Themes\Child_Theme::class)) {
            return;
        }

        $child_dir = \EPB\Themes\Child_Theme::get_child_theme_dir();

        if (!file_exists($child_dir)) {
            return;
        }

        $backup_file = $child_dir . '/' . Constants::SETTINGS_BACKUP_FILE;

        // Only seed if the backup doesn't exist yet.
        if (file_exists($backup_file)) {
            return;
        }

        \EPB\Themes\Child_Theme::write_settings_backup();
    }
}
