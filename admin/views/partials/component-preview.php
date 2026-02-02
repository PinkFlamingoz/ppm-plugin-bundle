<?php

/**
 * Component Preview Page.
 *
 * This page loads UIkit and displays a preview of a component.
 * It's meant to be loaded in an iframe within the component picker.
 * 
 * Uses server-side Less compilation via AJAX for accurate CSS output.
 * This allows full UIkit Less compilation including data-uri() and other
 * server-side functions that cannot run in the browser.
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.2.0
 */

use EPB\Themes\Renderer\Preview_Renderer;
use EPB\CSS\Less_Parser;
use EPB\CSS\Less_Compiler;
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

// Get component variables from our consolidated Less files.
$component_variables = Less_Parser::parse_component($component);

// Get ALL saved component values to apply as initial overrides.
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

// Generate AJAX nonce for server-side compilation.
$compile_nonce = wp_create_nonce('epb_ajax_nonce');

// Check if Less compiler is available.
$compiler_available = Less_Compiler::is_available();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html($component_label); ?> Preview</title>

    <!-- UIkit CSS (base styles - will be overridden by compiled CSS) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.5/dist/css/uikit.min.css" />

    <!-- Server-compiled CSS will be injected here -->
    <style id="compiled-preview-styles">
        /* Compiled CSS will be injected here by JavaScript */
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

        .preview-status {
            position: fixed;
            top: 10px;
            right: 10px;
            background: #1e87f0;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            display: none;
            z-index: 1000;
        }

        .preview-status.active {
            display: block;
        }

        .preview-status.error {
            background: #f0506e;
        }

        .preview-status.success {
            background: #32d296;
        }

        .compiler-warning {
            background: #faa05a;
            color: #333;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 13px;
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
    <div class="preview-status" id="preview-status">Compiling...</div>

    <?php if (!$compiler_available): ?>
        <div class="compiler-warning">
            <strong>Note:</strong> Server-side Less compiler not installed.
            Run <code>composer install</code> in the plugin directory to enable live preview.
        </div>
    <?php endif; ?>

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
            var componentName = <?php echo json_encode($component); ?>;
            var ajaxUrl = <?php echo json_encode(admin_url('admin-ajax.php')); ?>;
            var nonce = <?php echo json_encode($compile_nonce); ?>;
            var compilerAvailable = <?php echo $compiler_available ? 'true' : 'false'; ?>;

            // Current variable overrides - start with all saved values.
            var currentOverrides = <?php echo json_encode($initial_overrides); ?>;

            // Debounce timer and pending request.
            var compileTimer = null;
            var pendingRequest = null;

            // Status element.
            var statusEl = document.getElementById('preview-status');

            /**
             * Show status message.
             */
            function showStatus(message, type) {
                statusEl.textContent = message;
                statusEl.className = 'preview-status active';
                if (type) {
                    statusEl.classList.add(type);
                }
            }

            /**
             * Hide status message.
             */
            function hideStatus() {
                statusEl.classList.remove('active');
            }

            /**
             * Hide status after delay.
             */
            function hideStatusDelayed(delay) {
                setTimeout(hideStatus, delay || 1500);
            }

            /**
             * Request server-side Less compilation.
             */
            function requestCompilation() {
                if (!compilerAvailable) {
                    console.warn('Less compiler not available');
                    return;
                }

                // Cancel any pending request.
                if (pendingRequest) {
                    pendingRequest.abort();
                }

                showStatus('Compiling...');

                // Create form data.
                var formData = new FormData();
                formData.append('action', 'epb_compile_preview');
                formData.append('nonce', nonce);
                formData.append('component', componentName);
                formData.append('overrides', JSON.stringify(currentOverrides));

                // Make the request.
                pendingRequest = new XMLHttpRequest();
                pendingRequest.open('POST', ajaxUrl, true);

                pendingRequest.onload = function() {
                    pendingRequest = null;

                    if (this.status >= 200 && this.status < 400) {
                        try {
                            var response = JSON.parse(this.responseText);

                            if (response.success && response.data && response.data.css) {
                                // Inject the compiled CSS.
                                var styleEl = document.getElementById('compiled-preview-styles');
                                if (styleEl) {
                                    styleEl.textContent = response.data.css;
                                }

                                console.log('Compiled CSS:', response.data.css.length, 'bytes');
                                showStatus('Updated', 'success');
                                hideStatusDelayed(1000);
                            } else {
                                var errorMsg = response.data && response.data.message ?
                                    response.data.message :
                                    'Unknown error';
                                console.error('Compilation failed:', errorMsg);
                                showStatus('Error: ' + errorMsg, 'error');
                                hideStatusDelayed(3000);
                            }
                        } catch (e) {
                            console.error('Invalid response:', e);
                            showStatus('Invalid response', 'error');
                            hideStatusDelayed(2000);
                        }
                    } else {
                        console.error('Request failed:', this.status);
                        showStatus('Request failed', 'error');
                        hideStatusDelayed(2000);
                    }
                };

                pendingRequest.onerror = function() {
                    pendingRequest = null;
                    console.error('Network error');
                    showStatus('Network error', 'error');
                    hideStatusDelayed(2000);
                };

                pendingRequest.send(formData);
            }

            /**
             * Debounced compilation request.
             */
            function debouncedCompile() {
                clearTimeout(compileTimer);
                compileTimer = setTimeout(requestCompilation, 200);
            }

            /**
             * Update a single variable.
             */
            function updateVariable(name, value) {
                if (value && value.trim()) {
                    currentOverrides[name] = value.trim();
                } else {
                    delete currentOverrides[name];
                }

                debouncedCompile();
            }

            /**
             * Update all variables at once.
             */
            function updateAllVariables(variables) {
                for (var name in variables) {
                    if (variables.hasOwnProperty(name)) {
                        if (variables[name]) {
                            currentOverrides[name] = variables[name];
                        } else {
                            delete currentOverrides[name];
                        }
                    }
                }

                debouncedCompile();
            }

            // Listen for messages from parent window.
            window.addEventListener('message', function(event) {
                if (event.origin !== window.location.origin) {
                    return;
                }

                if (event.data && event.data.type === 'updateVariable') {
                    updateVariable(event.data.name, event.data.value);
                }

                if (event.data && event.data.type === 'updateVariables') {
                    updateAllVariables(event.data.variables || {});
                }

                if (event.data && event.data.type === 'updatePreviewContent') {
                    var contentEl = document.getElementById('preview-content');
                    if (contentEl) {
                        contentEl.innerHTML = event.data.html || '';
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

            // Initial compilation with saved overrides.
            if (compilerAvailable) {
                // Small delay to ensure page is ready.
                setTimeout(requestCompilation, 100);
            }
        })();
    </script>
</body>

</html>