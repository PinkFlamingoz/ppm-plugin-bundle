<?php

/**
 * Form Builder for Theme Renderer
 *
 * @package Enhanced_Plugin_Bundle
 * @since   4.0.0
 */

namespace EPB\Themes\Renderer;

if (! defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Form_Builder
 *
 * Handles rendering of form input fields for theme customization.
 * Provides reusable methods for color pickers, number inputs, and field groups.
 */
class Form_Builder
{

    /**
     * Renders a list of input fields based on a provided configuration.
     *
     * Each field definition supports the following keys:
     * - name  (string, required): option key stored under css_options.
     * - label (string, required): label text displayed in the form.
     * - type  (string, optional): input type, defaults to "number".
     * - step  (scalar, optional): step attribute for number inputs.
     * - class (string, optional): custom CSS class appended to the input element.
     * - id    (string, optional): custom ID for the input element.
     *
     * @param array<int, array<string, mixed>> $fields  List of field definitions.
     * @param array<string, mixed>             $options Current option values.
     * @return void
     */
    public static function render_input_fields(array $fields, array $options): void
    {
        foreach ($fields as $field) {
            if (empty($field['name']) || empty($field['label'])) {
                continue;
            }

            $name  = (string) $field['name'];
            $label = (string) $field['label'];
            $type  = isset($field['type']) ? (string) $field['type'] : 'number';
            $class = 'input__field';

            if ('color' === $type) {
                $class .= ' color';
            }
            if (! empty($field['class'])) {
                $class .= ' ' . trim((string) $field['class']);
            }

            $value     = esc_attr($options[$name] ?? '');
            $step      = isset($field['step']) ? sprintf(' step="%s"', esc_attr((string) $field['step'])) : '';
            $type      = esc_attr($type);
            $class     = esc_attr($class);
            $name_attr = esc_attr($name);
            $label_esc = esc_html($label);

            printf(
                '<div class="form-group"><label class="input"><input class="%1$s" type="%2$s" name="css_options[%3$s]" id="%3$s" placeholder=" " value="%4$s"%5$s><span class="input__label">%6$s</span></label></div>',
                $class,
                $type,
                $name_attr,
                $value,
                $step,
                $label_esc
            );
        }
    }

    /**
     * Renders a color input field.
     *
     * @param string $name  Field name.
     * @param string $label Field label.
     * @param string $value Current value.
     * @return void
     */
    public static function render_color_input(string $name, string $label, string $value): void
    {
        self::render_input_fields(
            [['name' => $name, 'label' => $label, 'type' => 'color']],
            [$name => $value]
        );
    }

    /**
     * Renders a number input field.
     *
     * @param string     $name  Field name.
     * @param string     $label Field label.
     * @param int|string $value Current value.
     * @param int        $step  Step increment.
     * @return void
     */
    public static function render_number_input(string $name, string $label, $value, int $step = 1): void
    {
        self::render_input_fields(
            [['name' => $name, 'label' => $label, 'step' => $step]],
            [$name => $value]
        );
    }

    /**
     * Renders a fieldset wrapper with legend.
     *
     * @param string   $id       Fieldset ID.
     * @param string   $legend   Legend text.
     * @param callable $callback Content callback.
     * @param string   $class    Additional CSS classes.
     * @return void
     */
    public static function render_fieldset(string $id, string $legend, callable $callback, string $class = 'fieldset-group group-options'): void
    {
        printf('<fieldset id="%s" class="%s">', esc_attr($id), esc_attr($class));
        printf('<legend>%s</legend>', esc_html($legend));
        $callback();
        echo '</fieldset>';
    }

    /**
     * Renders an inner fieldset group.
     *
     * @param string   $legend   Legend text.
     * @param callable $callback Content callback.
     * @param string   $class    Additional CSS classes.
     * @return void
     */
    public static function render_inner_fieldset(string $legend, callable $callback, string $class = 'fieldset-group-inner group-styles'): void
    {
        printf('<fieldset class="%s">', esc_attr($class));
        printf('<legend>%s</legend>', esc_html($legend));
        $callback();
        echo '</fieldset>';
    }

    /**
     * Renders an accordion fieldset with details/summary.
     *
     * @param string   $legend   Legend text (fieldset).
     * @param string   $summary  Summary text (details).
     * @param callable $callback Content callback.
     * @return void
     */
    public static function render_accordion_fieldset(string $legend, string $summary, callable $callback): void
    {
        echo '<fieldset class="fieldset-group-inner group-styles button-accordion">';
        printf('<legend>%s</legend>', esc_html($legend));
        echo '<details>';
        printf('<summary>%s</summary>', esc_html($summary));
        echo '<div class="picker-group">';
        $callback();
        echo '</div></details></fieldset>';
    }

    /**
     * Renders a checkbox input with label and description.
     *
     * @param string $id          Checkbox ID.
     * @param string $label       Checkbox label.
     * @param string $description Help text.
     * @param bool   $checked     Whether checked.
     * @return void
     */
    public static function render_checkbox(string $id, string $label, string $description, bool $checked = false): void
    {
?>
        <div class="form-group form-group--checkbox">
            <label class="checkbox" for="<?php echo esc_attr($id); ?>">
                <input type="checkbox"
                    name="<?php echo esc_attr($id); ?>"
                    id="<?php echo esc_attr($id); ?>"
                    value="1"
                    <?php checked($checked); ?>>
                <span><?php echo esc_html($label); ?></span>
            </label>
            <p class="description"><?php echo esc_html($description); ?></p>
        </div>
<?php
    }
}
