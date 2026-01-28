<?php

/**
 * Options interface for Enhanced Plugin Bundle.
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
 * Interface Options_Interface
 *
 * Defines the contract for options storage classes.
 * Any class that manages options should implement this interface.
 */
interface Options_Interface
{
    /**
     * Retrieves options, merged with defaults.
     *
     * @return array<string, mixed> The options array.
     */
    public static function get(): array;

    /**
     * Saves options to the database.
     *
     * @param array<string, mixed> $options The options to save.
     * @return void
     */
    public static function save(array $options): void;

    /**
     * Gets the default options.
     *
     * @return array<string, mixed> The default options array.
     */
    public static function get_defaults(): array;
}
