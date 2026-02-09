<?php

/**
 * Dynamic Renderer for Enhanced Plugin Bundle.
 *
 * Dynamically generates form fields based on parsed Less variables.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Themes\Renderer
 * @since 4.1.0
 */

namespace EPB\Themes\Renderer;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

use EPB\CSS\Less_Parser;
use EPB\Core\Utils;

/**
 * Class Dynamic_Renderer
 *
 * Auto-generates form fields from UIkit Less variables.
 */
class Dynamic_Renderer
{
    /**
     * Render form fields for a component's variables.
     *
     * @param string               $component    Component name.
     * @param array<string, mixed> $saved_values Current saved values.
     * @return void
     */
    public static function render_component_fields(string $component, array $saved_values): void
    {
        // Use the new grouped parser that reads @group annotations from Less files.
        $grouped = Less_Parser::get_grouped_variables($component);

        if (empty($grouped)) {
            echo '<p class="no-variables">';
            esc_html_e('No customizable variables found for this component.', 'enhanced-plugin-bundle');
            echo '</p>';
            return;
        }

        foreach ($grouped as $group_key => $vars) {
            $group_label = Less_Parser::group_key_to_label($group_key);

            // Collect modified variables in this group with their labels.
            $modified_vars = [];
            $modified_labels = [];
            foreach ($vars as $name => $meta) {
                $saved_value = $saved_values[$name] ?? null;
                if ($saved_value !== null && Utils::is_value_modified($saved_value, $meta)) {
                    $modified_vars[]   = '@' . $name;
                    $modified_labels[] = $meta['label'];
                }
            }
            $modified_count = count($modified_vars);
            $modified_tooltip = implode(', ', $modified_vars);
            $modified_display = implode(', ', $modified_labels);
?>
            <div class="variable-group variable-group-<?php echo esc_attr($group_key); ?> collapsed">
                <h4 class="variable-group__heading">
                    <span class="group-toggle dashicons dashicons-arrow-down-alt2"></span>
                    <?php echo esc_html($group_label); ?>
                    <span class="group-count"><?php echo count($vars); ?></span>
                    <?php if ($modified_count > 0) : ?>
                        <span class="group-modified" title="<?php echo esc_attr($modified_tooltip); ?>">
                            <?php echo $modified_count; ?><span class="modified-separator">|</span><span class="modified-label"><?php echo esc_html($modified_display); ?></span>
                        </span>
                    <?php endif; ?>
                </h4>
                <div class="variable-group-fields">
                    <?php
                    foreach ($vars as $name => $meta) {
                        // Use saved value if available, otherwise use original value (preserves references).
                        $value = $saved_values[$name] ?? $meta['value'];
                        // Normalize Less escape syntax for consistent comparison and display.
                        $value = Utils::normalize_less_escape($value);
                        self::render_field($name, $meta, $value);
                    }
                    ?>
                </div>
            </div>
        <?php
        }
    }

    /**
     * Render a single variable field based on its type.
     *
     * @param string $var_name   Variable name.
     * @param array  $var_meta   Variable metadata from parser.
     * @param mixed  $saved_value Current saved value.
     * @return void
     */
    public static function render_field(string $var_name, array $var_meta, $saved_value): void
    {
        $type  = $var_meta['type'];
        $label = $var_meta['label'];
        $value = $saved_value;

        switch ($type) {
            case 'color':
                self::render_color_field($var_name, $value, $label, $var_meta);
                break;

            case 'size':
                self::render_size_field($var_name, $value, $label, $var_meta);
                break;

            case 'number':
                self::render_number_field($var_name, $value, $label, $var_meta);
                break;

            case 'font-weight':
                self::render_font_weight_field($var_name, $value, $label, $var_meta);
                break;

            case 'font':
                self::render_font_field($var_name, $value, $label, $var_meta);
                break;

            case 'reference':
                self::render_reference_field($var_name, $value, $label, $var_meta);
                break;

            case 'keyword':
                self::render_keyword_field($var_name, $value, $label, $var_meta);
                break;

            case 'duration':
                self::render_duration_field($var_name, $value, $label, $var_meta);
                break;

            case 'border':
            case 'shadow':
            case 'easing':
            case 'mixed':
            default:
                self::render_text_field($var_name, $value, $label, $var_meta);
                break;
        }
    }

    /**
     * Render a color picker field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_color_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved_value = $meta['resolved'] ?? $original_value;

        // Check if original is a reference or contains Less functions.
        $original_is_reference = (strpos($original_value, '@') === 0);
        $original_has_function = preg_match('/(darken|lighten|fade|saturate|spin)\s*\(/', $original_value);
        $original_is_inherited = $original_is_reference || $original_has_function;

        // Check if current value is a reference or contains Less functions.
        $value_is_reference = (strpos($value, '@') === 0);
        $value_has_function = preg_match('/(darken|lighten|fade|saturate|spin)\s*\(/', $value);
        $value_is_inherited = $value_is_reference || $value_has_function;

        // Determine what to display: use resolved color for the picker.
        $resolved_hex = self::to_hex_color($resolved_value);

        // For the color picker, always use the resolved hex.
        // For the text input, show the reference if it's a reference, or the hex if it's a direct value.
        $picker_hex = $value_is_inherited ? $resolved_hex : self::to_hex_color($value);
        $display_value = $value; // Show the reference (@global-color) or hex (#fff) as-is.

        // Show resolved indicator when current value is a reference or Less function.
        $show_resolved = $value_is_inherited && ($resolved_hex !== $value);

        // For color fields, compare to determine if modified.
        // If the value is still the original reference or original hex, it's not modified.
        $is_modified = ($value !== $original_value);

        // Is inheritance broken? (original was inherited but user saved a direct hex value).
        $inheritance_broken = $original_is_inherited && !$value_is_inherited;
        ?>
        <div class="ppm-field ppm-field-color<?php echo $is_modified ? ' field-modified' : ''; ?><?php echo $inheritance_broken ? ' inheritance-broken' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved_hex); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="color"
                    id="var-<?php echo esc_attr($name); ?>-picker"
                    class="color-picker"
                    value="<?php echo esc_attr($picker_hex); ?>"
                    data-target="var-<?php echo esc_attr($name); ?>">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="color-input"
                    value="<?php echo esc_attr($display_value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <span class="resolved-color-swatch" style="background-color: <?php echo esc_attr($resolved_hex); ?>;"></span><?php echo esc_html($resolved_hex); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a size field with unit.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_size_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $is_reference = (strpos($original_value, '@') === 0);
        $value_is_reference = (strpos($value, '@') === 0);

        // Show resolved when the current value is the original reference.
        $show_resolved = $is_reference && $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);
    ?>
        <div class="ppm-field ppm-field-size<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="size-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a number input field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_number_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);
    ?>
        <div class="ppm-field ppm-field-number<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="number-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a font-weight field with text input and datalist suggestions.
     *
     * Supports both numeric (100-900) and keyword (normal, bold, etc.) values.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_font_weight_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);

        // Font-weight options for datalist suggestions.
        $weights = [
            '100'     => '100 - Thin',
            '200'     => '200 - Extra Light',
            '300'     => '300 - Light',
            '400'     => '400 - Normal',
            '500'     => '500 - Medium',
            '600'     => '600 - Semi Bold',
            '700'     => '700 - Bold',
            '800'     => '800 - Extra Bold',
            '900'     => '900 - Black',
            'normal'  => 'Normal',
            'bold'    => 'Bold',
            'bolder'  => 'Bolder (relative)',
            'lighter' => 'Lighter (relative)',
            'inherit' => 'Inherit',
        ];
    ?>
        <div class="ppm-field ppm-field-weight<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="weight-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>"
                    list="weight-list-<?php echo esc_attr($name); ?>">
                <datalist id="weight-list-<?php echo esc_attr($name); ?>">
                    <?php foreach ($weights as $weight_value => $weight_label) : ?>
                        <option value="<?php echo esc_attr($weight_value); ?>">
                            <?php echo esc_html($weight_label); ?>
                        </option>
                    <?php endforeach; ?>
                </datalist>
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a font family field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_font_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);

        // Common font stacks.
        $fonts = [
            ''                           => __('-- Select --', 'enhanced-plugin-bundle'),
            'system-ui, sans-serif'      => 'System UI',
            '"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica',
            'Georgia, serif'             => 'Georgia',
            '"Times New Roman", serif'   => 'Times New Roman',
            'Consolas, monospace'        => 'Consolas',
            'inherit'                    => 'Inherit',
        ];
    ?>
        <div class="ppm-field ppm-field-font<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="font-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>"
                    list="font-list-<?php echo esc_attr($name); ?>">
                <datalist id="font-list-<?php echo esc_attr($name); ?>">
                    <?php foreach ($fonts as $font_value => $font_label) : ?>
                        <option value="<?php echo esc_attr($font_value); ?>">
                            <?php echo esc_html($font_label); ?>
                        </option>
                    <?php endforeach; ?>
                </datalist>
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a reference field (variable linking to another).
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_reference_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);
    ?>
        <div class="ppm-field ppm-field-reference<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="reference-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a keyword select field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_keyword_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);

        // Context-specific keywords based on variable name.
        if (str_ends_with($name, '-font-style')) {
            $keywords = ['normal', 'italic', 'oblique', 'inherit'];
        } elseif (str_ends_with($name, '-text-transform')) {
            $keywords = ['none', 'uppercase', 'lowercase', 'capitalize', 'inherit'];
        } else {
            // Generic keywords.
            $keywords = ['none', 'auto', 'inherit', 'initial', 'unset', 'hidden', 'visible', 'solid', 'dashed', 'dotted'];
        }
    ?>
        <div class="ppm-field ppm-field-keyword<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="keyword-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>"
                    list="keyword-list-<?php echo esc_attr($name); ?>">
                <datalist id="keyword-list-<?php echo esc_attr($name); ?>">
                    <?php foreach ($keywords as $kw) : ?>
                        <option value="<?php echo esc_attr($kw); ?>">
                            <?php echo esc_html($kw); ?>
                        </option>
                    <?php endforeach; ?>
                </datalist>
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a duration field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_duration_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);
    ?>
        <div class="ppm-field ppm-field-duration<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="duration-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
    <?php
    }

    /**
     * Render a generic text field.
     *
     * @param string $name  Field name.
     * @param string $value Current value.
     * @param string $label Field label.
     * @param array  $meta  Variable metadata.
     * @return void
     */
    private static function render_text_field(string $name, string $value, string $label, array $meta): void
    {
        $original_value = $meta['value'];
        $resolved = $meta['resolved'] ?? $value;
        $value_is_reference = (strpos($value, '@') === 0);
        $show_resolved = $value_is_reference && ($resolved !== $value);
        $is_modified = ($value !== $original_value);
    ?>
        <div class="ppm-field ppm-field-text<?php echo $is_modified ? ' field-modified' : ''; ?>"
            data-variable="<?php echo esc_attr($name); ?>"
            data-default="<?php echo esc_attr($original_value); ?>"
            data-resolved="<?php echo esc_attr($resolved); ?>">
            <label for="var-<?php echo esc_attr($name); ?>">
                <?php echo esc_html($label); ?>
                <span class="variable-name">@<?php echo esc_html($name); ?></span>
            </label>
            <div class="field-inputs">
                <input type="text"
                    id="var-<?php echo esc_attr($name); ?>"
                    name="component_vars[<?php echo esc_attr($name); ?>]"
                    class="text-input"
                    value="<?php echo esc_attr($value); ?>"
                    placeholder="<?php echo esc_attr($original_value); ?>">
                <span class="resolved-value<?php echo $show_resolved ? '' : ' hidden'; ?>" title="<?php esc_attr_e('Resolved value', 'enhanced-plugin-bundle'); ?>">
                    → <?php echo esc_html($resolved); ?>
                </span>
                <button type="button" class="reset-field" data-default="<?php echo esc_attr($original_value); ?>" title="<?php esc_attr_e('Reset to default', 'enhanced-plugin-bundle'); ?>">
                    <span class="dashicons dashicons-image-rotate"></span>
                </button>
            </div>
        </div>
<?php
    }

    /**
     * Convert a color value to hex format for color picker.
     *
     * Delegates to the shared Utils::to_hex_color() method.
     *
     * @param string $value Color value.
     * @return string Hex color or #000000 as fallback.
     */
    private static function to_hex_color(string $value): string
    {
        return Utils::to_hex_color($value);
    }
}
