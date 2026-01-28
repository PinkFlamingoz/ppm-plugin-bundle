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
        // Clear any cached data to ensure fresh state.
        delete_transient('epb_plugin_cache');

        // Log upgrade if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Running upgrade routines for version 3.5');
        }
    }

    /**
     * Upgrade routines for version 4.0 (modular architecture).
     *
     * @return void
     */
    private static function upgrade_to_4_0(): void
    {
        // Clear any cached data to ensure fresh state.
        delete_transient('epb_plugin_cache');

        // Log upgrade if debugging is enabled.
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[EPB] Running upgrade routines for version 4.0 (modular architecture)');
        }
    }
}
