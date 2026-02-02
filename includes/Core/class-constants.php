<?php

/**
 * Plugin Constants for Enhanced Plugin Bundle.
 *
 * Centralized location for all plugin constants to avoid duplication.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 * @since 4.2.0
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Constants
 *
 * Defines all plugin-wide constants in a single location.
 */
class Constants
{
    /**
     * Option prefix for component storage in wp_options.
     *
     * @var string
     */
    public const OPTION_PREFIX = 'epb_component_';

    /**
     * Nonce action for component AJAX operations.
     *
     * @var string
     */
    public const NONCE_ACTION = 'epb_component_nonce';

    /**
     * Transient key for cached component CSS.
     *
     * @var string
     */
    public const TRANSIENT_CSS = 'epb_component_css';

    /**
     * Cache duration for component CSS transient (1 hour).
     *
     * @var int
     */
    public const CACHE_DURATION = HOUR_IN_SECONDS;
}
