<?php

/**
 * Component Less Builder.
 *
 * Assembles complete Less source for a component by combining:
 * - UIkit base variables
 * - UIkit mixins
 * - YOOtheme theme variables
 * - Our consolidated variables
 * - UIkit component Less (with CSS rules)
 * - User variable overrides
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.2.0
 */

namespace EPB\CSS;

/**
 * Component Less Builder class.
 */
class Component_Less_Builder
{

    /**
     * Path to YOOtheme's UIkit source.
     *
     * @var string
     */
    private string $uikit_path;

    /**
     * Path to YOOtheme's theme Less files.
     *
     * @var string
     */
    private string $yootheme_path;

    /**
     * Path to our consolidated Less files.
     *
     * @var string
     */
    private string $consolidated_path;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->uikit_path = WP_CONTENT_DIR . '/themes/yootheme/vendor/assets/uikit/src/less/';
        $this->yootheme_path = WP_CONTENT_DIR . '/themes/yootheme/less/';
        $this->consolidated_path = EPB_PLUGIN_DIR . 'docs/uikit-less-consolidated/';
    }

    /**
     * Check if the required source files exist.
     *
     * @return bool|string True if ready, or error message.
     */
    public function check_requirements()
    {
        if (!is_dir($this->uikit_path)) {
            return 'YOOtheme UIkit source not found at: ' . $this->uikit_path;
        }

        if (!is_dir($this->uikit_path . 'components/')) {
            return 'UIkit components folder not found';
        }

        if (!is_dir($this->consolidated_path)) {
            return 'Consolidated Less files not found. Please run the consolidation script.';
        }

        return true;
    }

    /**
     * Build complete Less source for a component.
     *
     * @param string $component The component name (e.g., 'button', 'card').
     * @param array  $overrides Optional. Variable overrides from user.
     * @return string|false The complete Less source, or false on failure.
     */
    public function build(string $component, array $overrides = [])
    {
        $check = $this->check_requirements();
        if ($check !== true) {
            return false;
        }

        $component = sanitize_key($component);

        // Check if UIkit component exists.
        $uikit_component_file = $this->uikit_path . 'components/' . $component . '.less';
        if (!file_exists($uikit_component_file)) {
            return false;
        }

        $parts = [];

        // 1. UIkit base variables.
        $parts[] = $this->get_uikit_variables();

        // 2. UIkit mixins.
        $parts[] = $this->get_uikit_mixins();

        // 3. Variables from ALL UIkit components (needed for cross-references).
        $parts[] = $this->get_all_component_variables();

        // 4. YOOtheme default global variables (not in UIkit).
        $parts[] = $this->get_yootheme_global_defaults();

        // 5. YOOtheme theme variables (our consolidated version).
        $parts[] = $this->get_yootheme_theme_variables();

        // 6. Our consolidated component variables.
        $parts[] = $this->get_consolidated_variables($component);

        // 7. Generate empty hook stubs (to prevent undefined mixin errors).
        $parts[] = $this->generate_hook_stubs($component);

        // 8. UIkit component Less (contains CSS rules).
        $parts[] = $this->get_uikit_component($component);

        // 9. User variable overrides (LAST - highest priority).
        if (!empty($overrides)) {
            $parts[] = $this->generate_overrides($overrides);
        }

        return implode("\n\n", array_filter($parts));
    }

    /**
     * Build Less source for preview (simplified version with faster compilation).
     *
     * @param string $component The component name.
     * @param array  $overrides Variable overrides from user.
     * @return string|false The Less source, or false on failure.
     */
    public function build_for_preview(string $component, array $overrides = [])
    {
        // For preview, we use the same build process.
        // In the future, we could optimize by caching the base content.
        return $this->build($component, $overrides);
    }

    /**
     * Get UIkit base variables.
     *
     * @return string
     */
    private function get_uikit_variables(): string
    {
        $file = $this->uikit_path . 'components/variables.less';
        if (!file_exists($file)) {
            // Fall back to consolidated variables.
            $file = $this->consolidated_path . 'variables.less';
        }

        if (file_exists($file)) {
            return "// UIkit Base Variables\n" . file_get_contents($file);
        }

        return '';
    }

    /**
     * Get UIkit mixins.
     *
     * @return string
     */
    private function get_uikit_mixins(): string
    {
        $file = $this->uikit_path . 'components/mixin.less';
        if (file_exists($file)) {
            return "// UIkit Mixins\n" . file_get_contents($file);
        }

        return '';
    }

    /**
     * Get YOOtheme-specific global variable defaults.
     *
     * These variables are used by YOOtheme but not defined in UIkit.
     * We provide sensible defaults that can be overridden.
     *
     * @return string
     */
    private function get_yootheme_global_defaults(): string
    {
        // These are YOOtheme-specific variables that themes like master-uikit define.
        // We use inherit/defaults as sensible starting points.
        return <<<'LESS'
// YOOtheme Global Defaults (not in UIkit)

// Secondary font (used for headings, titles, etc.)
@global-secondary-font-family: inherit;
@global-secondary-font-weight: inherit;
@global-secondary-font-style: normal;
@global-secondary-letter-spacing: normal;
@global-secondary-text-transform: none;

// Tertiary font (less commonly used)
@global-tertiary-font-family: inherit;
@global-tertiary-font-weight: inherit;
@global-tertiary-font-style: normal;
@global-tertiary-letter-spacing: normal;
@global-tertiary-text-transform: none;

// Additional global sizes that YOOtheme adds
@global-3xlarge-font-size: 3.4rem;
@global-xsmall-font-size: 0.75rem;

LESS;
    }

    /**
     * Get variables from all UIkit components.
     *
     * Extracts the variable definitions (lines starting with @) from each
     * component's Less file. This ensures all cross-referenced variables
     * are available during compilation.
     *
     * @return string
     */
    private function get_all_component_variables(): string
    {
        $components_dir = $this->uikit_path . 'components/';
        if (!is_dir($components_dir)) {
            return '';
        }

        $all_vars = ["// UIkit Component Variables (extracted from all components)"];

        // List of component files to extract variables from.
        $files = glob($components_dir . '*.less');
        if (empty($files)) {
            return '';
        }

        // Files to skip (already loaded or contain only rules).
        $skip = ['variables.less', 'mixin.less'];

        foreach ($files as $file) {
            $basename = basename($file);
            if (in_array($basename, $skip, true)) {
                continue;
            }

            $content = file_get_contents($file);
            if ($content === false) {
                continue;
            }

            // Extract only the variables section (before any CSS rules).
            $vars = $this->extract_variables_from_content($content);
            if (!empty($vars)) {
                $component_name = str_replace('.less', '', $basename);
                $all_vars[] = "// Variables from: {$component_name}";
                $all_vars[] = $vars;
            }
        }

        return implode("\n", $all_vars);
    }

    /**
     * Extract variable definitions from Less content.
     *
     * @param string $content The Less file content.
     * @return string The extracted variable definitions.
     */
    private function extract_variables_from_content(string $content): string
    {
        $lines = explode("\n", $content);
        $variables = [];
        $in_variables_section = false;
        $past_variables = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            // Detect start of variables section.
            if (preg_match('/^\/\/\s*Variables\s*$/i', $trimmed)) {
                $in_variables_section = true;
                continue;
            }

            // Detect end of variables section (when we hit actual CSS rules).
            if ($in_variables_section && preg_match('/^\.[a-z]/i', $trimmed)) {
                $past_variables = true;
                break;
            }

            // Skip if we haven't reached variables section yet.
            if (!$in_variables_section) {
                // Also capture variables defined before the Variables section header.
                if (preg_match('/^@[a-z][a-z0-9-]*\s*:/i', $trimmed)) {
                    $variables[] = $line;
                }
                continue;
            }

            // In variables section, capture variable definitions.
            if (preg_match('/^@[a-z][a-z0-9-]*\s*:/i', $trimmed)) {
                $variables[] = $line;
            }
        }

        return implode("\n", $variables);
    }

    /**
     * Get YOOtheme theme variables (consolidated).
     *
     * @return string
     */
    private function get_yootheme_theme_variables(): string
    {
        $file = $this->consolidated_path . 'yootheme-theme.less';
        if (file_exists($file)) {
            return "// YOOtheme Theme Variables\n" . file_get_contents($file);
        }

        return '';
    }

    /**
     * Get our consolidated variables for a component.
     *
     * @param string $component The component name.
     * @return string
     */
    private function get_consolidated_variables(string $component): string
    {
        $file = $this->consolidated_path . $component . '.less';
        if (file_exists($file)) {
            return "// Consolidated Component Variables\n" . file_get_contents($file);
        }

        return '';
    }

    /**
     * Get UIkit component Less file (contains CSS rules).
     *
     * @param string $component The component name.
     * @return string
     */
    private function get_uikit_component(string $component): string
    {
        $file = $this->uikit_path . 'components/' . $component . '.less';
        if (file_exists($file)) {
            return "// UIkit Component: {$component}\n" . file_get_contents($file);
        }

        return '';
    }

    /**
     * Generate empty hook stubs to prevent undefined mixin errors.
     *
     * @param string $component The component name.
     * @return string
     */
    private function generate_hook_stubs(string $component): string
    {
        $hooks = [];

        // Read the component file and extract hook calls.
        $component_file = $this->uikit_path . 'components/' . $component . '.less';
        if (file_exists($component_file)) {
            $content = file_get_contents($component_file);
            preg_match_all('/\.(hook-[a-z0-9-]+)\(\)/', $content, $matches);
            if (!empty($matches[1])) {
                $hooks = array_merge($hooks, $matches[1]);
            }
        }

        // Also check inverse.less for hooks.
        $inverse_file = $this->uikit_path . 'components/inverse.less';
        if (file_exists($inverse_file)) {
            $content = file_get_contents($inverse_file);
            preg_match_all('/\.(hook-[a-z0-9-]+)\(\)/', $content, $matches);
            if (!empty($matches[1])) {
                $hooks = array_merge($hooks, $matches[1]);
            }
        }

        // Generate empty hook definitions.
        $hooks = array_unique($hooks);
        if (empty($hooks)) {
            return '';
        }

        $stubs = "// Empty Hook Stubs\n";
        foreach ($hooks as $hook) {
            $stubs .= ".{$hook}() {}\n";
        }

        return $stubs;
    }

    /**
     * Generate Less variable override string from an array.
     *
     * @param array $overrides Variable name => value pairs.
     * @return string
     */
    private function generate_overrides(array $overrides): string
    {
        $lines = ["// User Variable Overrides"];

        foreach ($overrides as $name => $value) {
            // Sanitize variable name.
            $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
            if (empty($name) || empty($value)) {
                continue;
            }

            // Don't add @ prefix if already present.
            if (strpos($name, '@') !== 0) {
                $name = '@' . $name;
            }

            $lines[] = "{$name}: {$value};";
        }

        return implode("\n", $lines);
    }

    /**
     * Get list of available components.
     *
     * @return array
     */
    public function get_available_components(): array
    {
        $components = [];

        $dir = $this->uikit_path . 'components/';
        if (is_dir($dir)) {
            foreach (glob($dir . '*.less') as $file) {
                $name = basename($file, '.less');
                // Skip special files.
                if (!in_array($name, ['_import', 'variables', 'mixin'], true)) {
                    $components[] = $name;
                }
            }
        }

        sort($components);
        return $components;
    }
}
