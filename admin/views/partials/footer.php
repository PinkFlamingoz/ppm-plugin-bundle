<?php

/**
 * Admin Footer Partial
 *
 * Footer template for the Plugin Bundle Manager admin page.
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<div class="epb-footer">
    <p class="epb-version">
        <?php
        printf(
            /* translators: %s: Plugin version number */
            esc_html__('Enhanced Plugin Bundle v%s', 'enhanced-plugin-bundle'),
            esc_html(EPB_VERSION)
        );
        ?>
    </p>
</div>