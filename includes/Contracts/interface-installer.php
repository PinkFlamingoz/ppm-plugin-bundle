<?php

/**
 * Installer interface for Enhanced Plugin Bundle.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Contracts
 */

namespace EPB\Contracts;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Interface Installer_Interface
 *
 * Defines the contract for installer classes.
 * Any class that handles installation operations should implement this interface.
 */
interface Installer_Interface
{
    /**
     * Installs an item.
     *
     * @param string $identifier The item identifier (slug, path, etc.).
     * @return bool|\WP_Error True on success, WP_Error on failure.
     */
    public static function install(string $identifier): bool|\WP_Error;

    /**
     * Activates an item.
     *
     * @param string $identifier The item identifier.
     * @return bool|\WP_Error True on success, WP_Error on failure.
     */
    public static function activate(string $identifier): bool|\WP_Error;

    /**
     * Deactivates an item.
     *
     * @param string $identifier The item identifier.
     * @return bool|\WP_Error True on success, WP_Error on failure.
     */
    public static function deactivate(string $identifier): bool|\WP_Error;

    /**
     * Deletes an item.
     *
     * @param string $identifier The item identifier.
     * @return bool|\WP_Error True on success, WP_Error on failure.
     */
    public static function delete(string $identifier): bool|\WP_Error;
}
