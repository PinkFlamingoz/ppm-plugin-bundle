<?php

/**
 * Custom capabilities handler for Enhanced Plugin Bundle.
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
 * Class Capabilities
 *
 * Manages custom capabilities for the plugin.
 * Provides fine-grained access control for plugin and theme management.
 */
class Capabilities
{
    /**
     * List of custom capabilities used by the plugin.
     *
     * @var array<string>
     */
    private const CAPABILITIES = [
        'epb_manage_plugins',
        'epb_manage_themes',
        'epb_access_settings',
    ];

    /**
     * Registers custom capabilities for the plugin.
     *
     * Adds custom capabilities to the administrator role for fine-grained access control.
     * This allows site owners to grant specific EPB permissions to other roles if needed.
     *
     * @return void
     */
    public static function register(): void
    {
        $admin_role = get_role('administrator');

        if (null === $admin_role) {
            return;
        }

        foreach (self::CAPABILITIES as $cap) {
            $admin_role->add_cap($cap);
        }
    }

    /**
     * Removes custom capabilities on plugin deactivation.
     *
     * Cleans up the custom capabilities from all roles.
     *
     * @return void
     */
    public static function unregister(): void
    {
        $admin_role = get_role('administrator');

        if (null === $admin_role) {
            return;
        }

        foreach (self::CAPABILITIES as $cap) {
            $admin_role->remove_cap($cap);
        }
    }

    /**
     * Checks if the current user has a specific EPB capability.
     *
     * Falls back to 'manage_options' for backwards compatibility.
     *
     * @param string $capability The capability to check.
     * @return bool Whether the user has the capability.
     */
    public static function current_user_can(string $capability): bool
    {
        // First check the EPB-specific capability.
        if (current_user_can($capability)) {
            return true;
        }

        // Fall back to manage_options for backwards compatibility.
        return current_user_can('manage_options');
    }

    /**
     * Returns the list of all custom capabilities.
     *
     * @return array<string> List of capability names.
     */
    public static function get_all(): array
    {
        return self::CAPABILITIES;
    }
}
