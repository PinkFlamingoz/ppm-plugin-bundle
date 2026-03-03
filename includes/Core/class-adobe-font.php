<?php

/**
 * Adobe Font loader for Enhanced Plugin Bundle.
 *
 * Enqueues the Adobe Fonts (Typekit) CSS on the frontend
 * when enabled via the plugin's admin panel.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Core
 * @since 4.3.0
 */

namespace EPB\Core;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Adobe_Font
 *
 * Manages the optional Adobe Fonts (Typekit) stylesheet enqueue.
 */
class Adobe_Font
{
    /**
     * Initialize frontend hook.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'maybe_enqueue_font']);
    }

    /**
     * Enqueue the Adobe Font CSS if enabled and URL is set.
     *
     * @return void
     */
    public static function maybe_enqueue_font(): void
    {
        $enabled = get_option(Constants::OPTION_ADOBE_FONT_ENABLED, '0');

        if ($enabled !== '1') {
            return;
        }

        $url = get_option(Constants::OPTION_ADOBE_FONT_URL, '');

        if (empty($url)) {
            return;
        }

        wp_enqueue_style('epb-adobe-font-frontend', esc_url($url), [], null);
    }
}
