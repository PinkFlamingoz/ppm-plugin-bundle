<?php

/**
 * Admin Header Partial
 *
 * Header template for the Plugin Bundle Manager admin page.
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 */

if (! defined('ABSPATH')) {
    exit;
}

use EPB\Core\Notices;
?>
<!-- Notices container - displays queued EPB notices above the header -->
<!-- Using inline style and custom wrapper to prevent WordPress from relocating notices -->
<div class="epb-notices-container" id="epb-notices">
    <?php Notices::display_queued_notices(); ?>
</div>

<div class="ppm-header">
    <div class="ppm-header-left">
        <img src="<?php echo esc_url(EPB_PLUGIN_URL . 'assets/images/plappermaullogo_header_horizontal.png'); ?>"
            alt="<?php esc_attr_e('Company Logo', 'enhanced-plugin-bundle'); ?>"
            class="ppm-logo" />
        <h1 class="ppm-h1"><?php esc_html_e('Plugin Bundle Manager', 'enhanced-plugin-bundle'); ?></h1>
    </div>
</div>