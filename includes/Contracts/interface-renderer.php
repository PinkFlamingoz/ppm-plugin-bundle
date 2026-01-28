<?php

/**
 * Renderer interface for Enhanced Plugin Bundle.
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
 * Interface Renderer_Interface
 *
 * Defines the contract for UI renderer classes.
 * Any class that renders admin UI components should implement this interface.
 */
interface Renderer_Interface
{
    /**
     * Renders the main content section.
     *
     * @return void
     */
    public static function render(): void;
}
