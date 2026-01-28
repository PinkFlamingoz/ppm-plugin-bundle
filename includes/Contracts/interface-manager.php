<?php

/**
 * Manager interface for Enhanced Plugin Bundle.
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
 * Interface Manager_Interface
 *
 * Defines the contract for manager classes.
 * Any class that orchestrates module operations should implement this interface.
 */
interface Manager_Interface
{
    /**
     * Processes form submissions.
     *
     * @return void
     */
    public static function handle_form_actions(): void;
}
