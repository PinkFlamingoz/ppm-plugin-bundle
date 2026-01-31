<?php

/**
 * Component Preview Page.
 *
 * This page loads UIkit and displays a preview of a component.
 * It's meant to be loaded in an iframe within the component picker.
 * Uses less.js for live CSS compilation when variables change.
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.2.0
 */

use EPB\Themes\Renderer\Preview_Renderer;
use EPB\CSS\Less_Parser;
use EPB\CSS\Component_Registry;

// This file should only be included from an AJAX handler that has already loaded WordPress.
if (!defined('ABSPATH')) {
    exit('Direct access not allowed.');
}

// Get component from the passed variable or GET parameter.
$component = $component ?? (isset($_GET['component']) ? sanitize_key($_GET['component']) : '');

// Get the preview HTML.
$preview_html = Preview_Renderer::get_preview($component);

// Get component label.
$component_label = ucwords(str_replace('-', ' ', $component));

// Get the Less file content for this component (for live compilation).
$less_file = EPB_PLUGIN_DIR . 'docs/uikit-less/' . $component . '.less';
$less_content = '';
$component_variables = [];

if (file_exists($less_file)) {
    $less_content = file_get_contents($less_file);
    $component_variables = Less_Parser::parse_component($component);
}

// Also get the global variables.less content.
$variables_file = EPB_PLUGIN_DIR . 'docs/uikit-less/variables.less';
$variables_content = file_exists($variables_file) ? file_get_contents($variables_file) : '';

// Get the mixin.less content.
$mixin_file = EPB_PLUGIN_DIR . 'docs/uikit-less/mixin.less';
$mixin_content = file_exists($mixin_file) ? file_get_contents($mixin_file) : '';

// Get the inverse.less content (needed for @inverse-* variables used by many components).
$inverse_file = EPB_PLUGIN_DIR . 'docs/uikit-less/inverse.less';
$inverse_content = file_exists($inverse_file) ? file_get_contents($inverse_file) : '';

// Extract hook names from the component Less file and generate empty hooks.
// Also extract hooks from inverse.less since we include it.
$hook_stubs = '';
$all_less_for_hooks = $less_content . "\n" . $inverse_content;
if ($all_less_for_hooks) {
    // Match .hook-name() calls
    preg_match_all('/\.(hook-[a-z0-9-]+)\(\)/', $all_less_for_hooks, $hook_matches);
    if (!empty($hook_matches[1])) {
        $hooks = array_unique($hook_matches[1]);
        foreach ($hooks as $hook_name) {
            $hook_stubs .= ".{$hook_name}() {}\n";
        }
    }
}

// Get ALL saved component values to apply as initial overrides.
// This ensures the preview shows changes from other components (e.g., global variables).
$initial_overrides = [];
$all_components = Component_Registry::get_all();
foreach (array_keys($all_components) as $comp_name) {
    $saved = get_option('epb_component_' . $comp_name, []);
    if (!empty($saved)) {
        foreach ($saved as $var_name => $var_value) {
            $initial_overrides[$var_name] = $var_value;
        }
    }
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html($component_label); ?> Preview</title>

    <!-- UIkit CSS (base styles) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.5/dist/css/uikit.min.css" />

    <!-- Less.js for client-side compilation -->
    <script src="https://cdn.jsdelivr.net/npm/less@4.2.0/dist/less.min.js"></script>

    <style id="custom-preview-styles">
        /* Compiled CSS will be injected here */
    </style>

    <style>
        /* Preview page base styles */
        body {
            margin: 0;
            padding: 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #fff;
            min-height: 100vh;
        }

        .preview-wrapper {
            max-width: 100%;
        }

        .preview-component-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e5e5e5;
            color: #333;
        }

        .preview-placeholder-component {
            text-align: center;
            padding: 3rem;
            background: #f8f8f8;
            border-radius: 4px;
        }

        .preview-compiling {
            position: fixed;
            top: 10px;
            right: 10px;
            background: #1e87f0;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            display: none;
        }

        .preview-compiling.active {
            display: block;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body.auto-dark {
                background: #1a1a1a;
                color: #e0e0e0;
            }
        }
    </style>
</head>

<body>
    <div class="preview-compiling" id="compiling-indicator">Updating...</div>
    <div class="preview-wrapper">
        <div class="preview-component-title"><?php echo esc_html($component_label); ?> Component</div>
        <div id="preview-content">
            <?php echo $preview_html; // Already escaped in Preview_Renderer. 
            ?>
        </div>
    </div>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.5/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.5/dist/js/uikit-icons.min.js"></script>

    <script>
        (function() {
            // Store the base Less content.
            var componentLess = <?php echo json_encode($less_content); ?>;
            var variablesLess = <?php echo json_encode($variables_content); ?>;
            var mixinLess = <?php echo json_encode($mixin_content); ?>;
            var inverseLess = <?php echo json_encode($inverse_content); ?>;
            var hookStubs = <?php echo json_encode($hook_stubs); ?>;
            var componentName = <?php echo json_encode($component); ?>;

            // Current variable overrides - start with all saved values from all components.
            // This ensures cross-component changes (like global colors) are reflected.
            var currentOverrides = <?php echo json_encode($initial_overrides); ?>;

            // Debounce timer.
            var compileTimer = null;

            /**
             * Generate Less variable overrides string.
             */
            function generateOverrides(overrides) {
                var lines = [];
                for (var name in overrides) {
                    if (overrides.hasOwnProperty(name) && overrides[name]) {
                        lines.push('@' + name + ': ' + overrides[name] + ';');
                    }
                }
                return lines.join('\n');
            }

            /**
             * Compile Less with current overrides and inject CSS.
             */
            function compileLess() {
                if (!componentLess && !variablesLess) {
                    return;
                }

                var indicator = document.getElementById('compiling-indicator');
                indicator.classList.add('active');

                // Build the Less source with overrides applied AFTER the variable definitions.
                // This ensures our overrides take precedence.
                var overridesLess = generateOverrides(currentOverrides);

                // Combine: mixins + variables + inverse + hooks + component + overrides
                // IMPORTANT: User overrides must come LAST because component files
                // redefine variables at the top. In Less, the last variable definition wins.
                var fullLess = mixinLess + '\n\n' +
                    variablesLess + '\n\n' +
                    '// Inverse Variables\n' + inverseLess + '\n\n' +
                    '// Empty Hooks\n' + hookStubs + '\n\n' +
                    '// Component Styles\n' + componentLess + '\n\n' +
                    '// User Overrides (must be last to win)\n' + overridesLess;

                less.render(fullLess, {
                    compress: false,
                    math: 'always'
                }).then(function(output) {
                    var styleEl = document.getElementById('custom-preview-styles');
                    if (styleEl) {
                        styleEl.textContent = output.css;
                    }
                    indicator.classList.remove('active');
                }).catch(function(error) {
                    console.error('Less compilation error:', error.message, error);
                    indicator.classList.remove('active');
                });
            }

            /**
             * Update a single variable and recompile.
             */
            function updateVariable(name, value) {
                if (value && value.trim()) {
                    currentOverrides[name] = value.trim();
                } else {
                    delete currentOverrides[name];
                }

                // Debounce compilation.
                clearTimeout(compileTimer);
                compileTimer = setTimeout(compileLess, 150);
            }

            /**
             * Update all variables at once (merges with initial saved values).
             */
            function updateAllVariables(variables) {
                // Merge new variables into current overrides (don't replace).
                // This preserves saved values from other components while
                // updating the current component's values.
                for (var name in variables) {
                    if (variables.hasOwnProperty(name) && variables[name]) {
                        currentOverrides[name] = variables[name];
                    }
                }

                // Debounce compilation.
                clearTimeout(compileTimer);
                compileTimer = setTimeout(compileLess, 150);
            }

            // Listen for messages from parent window.
            window.addEventListener('message', function(event) {
                // Verify origin for security.
                if (event.origin !== window.location.origin) {
                    console.warn('Origin mismatch:', event.origin, 'vs', window.location.origin);
                    return;
                }

                if (event.data && event.data.type === 'updateVariable') {
                    // Update a single variable and recompile Less.
                    updateVariable(event.data.name, event.data.value);
                }

                if (event.data && event.data.type === 'updateVariables') {
                    // Update all variables and recompile Less.
                    updateAllVariables(event.data.variables || {});
                }

                if (event.data && event.data.type === 'updatePreviewContent') {
                    var contentEl = document.getElementById('preview-content');
                    if (contentEl) {
                        contentEl.innerHTML = event.data.html || '';
                        // Re-initialize UIkit components.
                        UIkit.update();
                    }
                }
            });

            // Notify parent that preview is ready.
            if (window.parent && window.parent !== window) {
                window.parent.postMessage({
                    type: 'previewReady',
                    component: componentName
                }, '*');
            }

            // Initial compile with saved overrides.
            // This ensures the preview shows all saved changes immediately.
            if (Object.keys(currentOverrides).length > 0 || componentLess) {
                compileLess();
            }
        })();
    </script>
</body>

</html>