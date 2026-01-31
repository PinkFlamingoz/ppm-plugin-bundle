/**
 * Component Picker JavaScript
 *
 * Handles AJAX loading, saving, and interactions for the component picker.
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.1.0
 */

(function($) {
    'use strict';

    /**
     * Component Picker Module
     */
    const ComponentPicker = {
        /**
         * Debug mode flag - set to true to enable console logging.
         * @type {boolean}
         */
        debug: false,

        /**
         * Currently selected component.
         * @type {string|null}
         */
        currentComponent: null,

        /**
         * Pending changes per component (unsaved modifications).
         * @type {Object}
         */
        pendingChanges: {},

        /**
         * Configuration from PHP.
         * @type {Object}
         */
        config: window.epbComponentPicker || {},

        /**
         * Initialize the component picker.
         */
        init() {
            this.cacheElements();
            this.bindEvents();

            // Load default component (Global/variables).
            const firstComponent = $('.component-link').first().data('component');
            if (firstComponent) {
                this.loadComponent(firstComponent);
            }
        },

        /**
         * Log a message to the console (only in debug mode).
         *
         * @param {string} type - Log type: 'log', 'warn', 'error', 'group', 'groupEnd'.
         * @param {...*} args - Arguments to pass to console.
         */
        log(type, ...args) {
            if (!this.debug) {
                return;
            }
            if (type === 'group') {
                console.group(...args);
            } else if (type === 'groupEnd') {
                console.groupEnd();
            } else if (console[type]) {
                console[type](...args);
            }
        },

        /**
         * Cache DOM elements.
         */
        cacheElements() {
            this.$menu = $('.ppm-component-menu');
            this.$editor = $('.ppm-component-editor');
            this.$preview = $('.ppm-preview-panel');
            this.$search = $('#component-search');
            this.$form = $('#component-form');
            this.$fields = $('#component-fields');
            this.$loading = $('#component-loading');
            this.$actions = $('#component-actions');
            this.$toast = $('#component-toast');
            this.$title = $('#component-title');
            this.$description = $('#component-description');
            this.$icon = $('#component-icon');
            this.$varCount = $('#variable-count');
            this.$currentInput = $('#current-component');
            this.$generatedCss = $('#generated-css code');
            this.$previewFrame = $('#component-preview-frame');
            this.$previewTabs = $('.preview-tab');
            this.$previewTabContents = $('.preview-tab-content');
        },

        /**
         * Bind event handlers.
         */
        bindEvents() {
            const self = this;

            // Category toggle (expand/collapse).
            $(document).on('click', '.category-label', function(e) {
                e.preventDefault();
                const $category = $(this).closest('.menu-category');
                $category.toggleClass('collapsed');
            });

            // Preview panel collapse toggle.
            $(document).on('click', '.preview-collapse-toggle', function(e) {
                e.preventDefault();
                self.$preview.toggleClass('collapsed');
                $(this).find('.dashicons').toggleClass('dashicons-arrow-right-alt2 dashicons-arrow-left-alt2');
            });

            // Component selection.
            $(document).on('click', '.component-link', function(e) {
                e.preventDefault();
                const component = $(this).data('component');
                
                // Expand parent category if collapsed.
                const $category = $(this).closest('.menu-category');
                if ($category.hasClass('collapsed')) {
                    $category.removeClass('collapsed');
                }
                
                self.loadComponent(component);
            });

            // Search filter.
            this.$search.on('input', function() {
                self.filterComponents(this.value);
            });

            // Form submission.
            this.$form.on('submit', function(e) {
                e.preventDefault();
                self.saveComponent();
            });

            // Reset button.
            $(document).on('click', '#reset-component', function() {
                self.resetComponent();
            });

            // Individual field reset.
            $(document).on('click', '.reset-field', function() {
                self.resetField($(this));
            });

            // Color picker sync.
            $(document).on('input', '.color-picker', function() {
                const targetId = $(this).data('target');
                $('#' + targetId).val(this.value).trigger('change');
            });

            // Color input sync.
            $(document).on('input', '.color-input', function() {
                const $picker = $(this).siblings('.color-picker');
                const hex = this.value;
                if (/^#[0-9A-Fa-f]{6}$/i.test(hex)) {
                    $picker.val(hex);
                }
                self.updatePreview();
            });

            // Field change - update preview and modified state.
            $(document).on('change input', '.ppm-field input, .ppm-field select', function() {
                self.updatePreview();
                self.updateFieldModifiedState($(this).closest('.ppm-field'));
                self.markComponentDirty();
            });

            // Export all.
            $(document).on('click', '#export-all-components', function() {
                self.exportAll();
            });

            // Export for Figma (Tokens Studio format).
            $(document).on('click', '#export-figma', function() {
                self.exportFigma();
            });

            // Export as YOOtheme style.less.
            $(document).on('click', '#export-yootheme-less', function() {
                self.exportYoothemeLess();
            });

            // Import button.
            $(document).on('click', '#import-components', function() {
                self.showImportModal();
            });

            // Import Figma button.
            $(document).on('click', '#import-figma', function() {
                self.showImportFigmaModal();
            });

            // Import modal.
            $(document).on('click', '#confirm-import', function() {
                self.importComponents();
            });

            // Import Figma modal confirm.
            $(document).on('click', '#confirm-import-figma', function() {
                self.importFigma();
            });

            // Modal close.
            $(document).on('click', '.modal-close, .modal-cancel, .modal-backdrop', function() {
                self.hideModal();
            });

            // Variable group collapse toggle (within editor).
            $(document).on('click', '.variable-group__heading', function() {
                $(this).closest('.variable-group').toggleClass('collapsed');
            });

            // Toggle all groups collapse/expand.
            $(document).on('click', '#toggle-all-groups', function() {
                self.toggleAllGroups();
            });

            // Copy CSS to clipboard.
            $(document).on('click', '#copy-css', function() {
                self.copyCss();
            });

            // Global reset all components.
            $(document).on('click', '#reset-all-components', function() {
                self.resetAllComponents();
            });

            // Global save all components.
            $(document).on('click', '#save-all-components', function() {
                self.saveAllComponents();
            });

            // Child theme: create or update.
            $(document).on('click', '#create-child-theme', function() {
                self.createChildTheme();
            });

            // Preview tab switching.
            $(document).on('click', '.preview-tab', function() {
                self.switchPreviewTab($(this).data('tab'));
            });

            // Listen for messages from preview iframe.
            window.addEventListener('message', function(event) {
                if (event.data && event.data.type === 'previewReady') {
                    self.onPreviewReady();
                }
            });
        },

        /**
         * Switch between preview tabs.
         *
         * @param {string} tabName - Tab name ('preview' or 'css').
         */
        switchPreviewTab(tabName) {
            this.$previewTabs.removeClass('active');
            $(`.preview-tab[data-tab="${tabName}"]`).addClass('active');

            this.$previewTabContents.removeClass('active');
            $(`#preview-tab-${tabName}`).addClass('active');
        },

        /**
         * Called when the preview iframe signals it's ready.
         */
        onPreviewReady() {
            // Send the current CSS to the preview iframe.
            this.sendVariablesToPreview();
        },

        /**
         * Send variable updates to the preview iframe for Less compilation.
         */
        sendVariablesToPreview() {
            const iframe = this.$previewFrame[0];
            if (iframe && iframe.contentWindow) {
                const variables = this.collectCurrentVariables();
                iframe.contentWindow.postMessage({
                    type: 'updateVariables',
                    variables: variables
                }, '*');
            }
        },

        /**
         * Collect all current variable values from the form.
         * 
         * @returns {Object} Variable name-value pairs.
         */
        collectCurrentVariables() {
            const variables = {};
            
            this.$fields.find('.ppm-field').each(function() {
                const $field = $(this);
                const varName = $field.data('variable');
                if (!varName) return;

                const $input = $field.find('input[type="text"], input[type="number"]').first();
                if ($input.length) {
                    const value = $input.val();
                    // Use attr() instead of data() to get the raw string value,
                    // avoiding jQuery's automatic type conversion.
                    const defaultValue = $field.attr('data-default');
                    
                    // Only include if different from default.
                    if (value && value !== defaultValue) {
                        variables[varName] = value;
                    }
                }
            });
            
            return variables;
        },

        /**
         * Load a component's fields.
         *
         * @param {string} component - Component name.
         */
        loadComponent(component) {
            const self = this;

            if (this.currentComponent === component) {
                return;
            }

            // Store pending changes for the current component before switching.
            if (this.currentComponent) {
                this.storePendingChanges();
            }

            this.currentComponent = component;
            this.$currentInput.val(component);

            // Update active state in menu.
            $('.component-link').removeClass('active');
            $(`.component-link[data-component="${component}"]`).addClass('active');

            // Show loading.
            this.$fields.html('');
            this.$loading.show();
            this.$actions.hide();

            // AJAX request.
            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_load_component',
                    component: component,
                    nonce: this.config.nonce
                },
                success(response) {
                    self.$loading.hide();

                    if (response.success) {
                        self.renderComponent(response.data);
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.$loading.hide();
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Render component data.
         *
         * @param {Object} data - Component data from server.
         */
        renderComponent(data) {
            // Update header.
            this.$title.text(data.label);
            this.$description.text(data.description);
            this.$icon.attr('class', 'component-icon dashicons dashicons-' + data.icon);
            this.$varCount.text(data.variable_count + ' ' + this.config.strings.variables);

            // Insert fields.
            this.$fields.html(data.fields);

            // Show actions.
            this.$actions.show();

            // Update CSS preview.
            this.updatePreview();

            // Load component preview in iframe.
            this.loadComponentPreview(this.currentComponent);
        },

        /**
         * Save current component settings.
         */
        saveComponent() {
            const self = this;

            if (!this.currentComponent) {
                return;
            }

            const $btn = $('#save-component');
            const originalText = $btn.html();

            $btn.prop('disabled', true).html('<span class="spinner is-active"></span> ' + this.config.strings.saving);

            // Collect form values.
            const values = {};
            this.$fields.find('input, select').each(function() {
                const name = $(this).attr('name');
                if (name && name.startsWith('component_vars[')) {
                    const key = name.match(/\[([^\]]+)\]/)[1];
                    values[key] = $(this).val();
                }
            });

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_save_component',
                    component: this.currentComponent,
                    values: values,
                    nonce: this.config.nonce
                },
                success(response) {
                    $btn.prop('disabled', false).html(originalText);

                    if (response.success) {
                        self.showToast(response.data.message, 'success');
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    $btn.prop('disabled', false).html(originalText);
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Reset current component to defaults.
         */
        resetComponent() {
            const self = this;

            if (!this.currentComponent) {
                return;
            }

            if (!confirm(this.config.strings.confirmReset)) {
                return;
            }

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_reset_component',
                    component: this.currentComponent,
                    nonce: this.config.nonce
                },
                success(response) {
                    if (response.success) {
                        self.showToast(response.data.message, 'success');
                        // Reload component to show defaults.
                        self.currentComponent = null;
                        self.loadComponent($('#current-component').val());
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Reset a single field to its default value.
         *
         * @param {jQuery} $button - Reset button element.
         */
        resetField($button) {
            // Use attr() instead of data() to get the raw string value,
            // avoiding jQuery's automatic type conversion.
            const defaultValue = $button.attr('data-default');
            const $field = $button.closest('.ppm-field');
            const $input = $field.find('input[type="text"], input[type="number"], select').first();

            if ($input.length) {
                const $picker = $field.find('.color-picker');
                // Use attr() for data-resolved too.
                const resolved = $field.attr('data-resolved');

                // Set the text input to the original default (could be @reference or #hex).
                $input.val(defaultValue);

                // For color fields, update the picker with the resolved hex.
                if ($picker.length && resolved) {
                    $picker.val(resolved);
                } else if ($picker.length && /^#[0-9A-Fa-f]{6}$/i.test(defaultValue)) {
                    $picker.val(defaultValue);
                }

                // Remove modified state since we're back to default.
                $field.removeClass('field-modified').removeClass('inheritance-broken');

                $input.trigger('change');
            }
        },

        /**
         * Compare two values for equality, handling type differences and Less syntax.
         *
         * @param {string} value1 - First value (typically current input value).
         * @param {string} value2 - Second value (typically default value).
         * @returns {boolean} True if values are equal.
         */
        valuesAreEqual(value1, value2) {
            // Handle null/undefined cases.
            if (value1 === value2) return true;
            if (value1 == null || value2 == null) return false;

            // Convert both to strings for comparison.
            let str1 = String(value1).trim();
            let str2 = String(value2).trim();

            // Direct string match.
            if (str1 === str2) return true;

            // Normalize Less escaped strings: ~'...' and ~\'...\' should be equal.
            const normalizeLessEscape = (s) => {
                // Handle different quote escaping: ~'...' or ~\'...\' (literal backslashes)
                // First, replace escaped quotes with normal quotes in Less escape syntax
                return s.replace(/~\\?['"]/g, "~'").replace(/\\?['"]$/g, "'");
            };

            // Also try a simpler approach: extract just the content inside quotes
            const extractLessContent = (s) => {
                const match = s.match(/^~\\?['"](.+?)\\?['"]$/);
                return match ? match[1] : s;
            };

            // Compare both the normalized strings and extracted content
            if (normalizeLessEscape(str1) === normalizeLessEscape(str2)) return true;
            if (extractLessContent(str1) === extractLessContent(str2)) return true;

            // Compare as numbers if both are numeric.
            const num1 = parseFloat(str1);
            const num2 = parseFloat(str2);
            if (!isNaN(num1) && !isNaN(num2) && str1 === String(num1) && str2 === String(num2)) {
                return num1 === num2;
            }

            return false;
        },

        /**
         * Update the modified state of a field.
         *
         * @param {jQuery} $field - Field element.
         */
        updateFieldModifiedState($field) {
            // Use attr() instead of data() to avoid jQuery's auto type conversion.
            const defaultValue = $field.attr('data-default');
            const resolved = $field.attr('data-resolved');
            const $input = $field.find('input[type="text"], input[type="number"], select').first();
            const isColorField = $field.hasClass('ppm-field-color');

            // Check if value contains Less functions like darken(), lighten(), etc.
            const hasLessFunction = (val) => /(?:darken|lighten|fade|saturate|spin)\s*\(/.test(val);

            if ($input.length && defaultValue !== undefined) {
                const currentValue = $input.val();
                const defaultStr = String(defaultValue);
                const isDefaultInherited = defaultStr.startsWith('@') || hasLessFunction(defaultStr);

                // Normalize values for comparison to handle type differences.
                const isModified = !this.valuesAreEqual(currentValue, defaultValue);
                $field.toggleClass('field-modified', isModified);

                // Mark inheritance as broken if default was inherited but user entered a different value.
                const currentIsInherited = currentValue.startsWith('@') || hasLessFunction(currentValue);
                const inheritanceBroken = isDefaultInherited && isModified && !currentIsInherited;
                $field.toggleClass('inheritance-broken', inheritanceBroken);

                // Handle resolved value indicator.
                const $resolvedSpan = $field.find('.resolved-value');
                if ($resolvedSpan.length) {
                    // Show when current value is inherited (reference or Less function).
                    if (currentIsInherited && resolved && currentValue !== resolved) {
                        $resolvedSpan.removeClass('hidden');
                    } else {
                        $resolvedSpan.addClass('hidden');
                    }
                }

                // For color fields, keep the picker in sync.
                if (isColorField) {
                    const $picker = $field.find('.color-picker');
                    // If user typed a valid hex, update picker.
                    if (/^#[0-9A-Fa-f]{6}$/i.test(currentValue)) {
                        $picker.val(currentValue);
                    } else if (currentIsInherited && resolved) {
                        // Keep picker at resolved value for inherited values.
                        $picker.val(resolved);
                    }
                }
            }
        },

        /**
         * Mark the current component as having unsaved changes.
         */
        markComponentDirty() {
            if (!this.currentComponent) return;
            
            // Store the current form values as pending changes.
            this.storePendingChanges();
        },

        /**
         * Store current form values as pending changes for the current component.
         */
        storePendingChanges() {
            if (!this.currentComponent) return;

            const values = {};
            let hasModifications = false;
            const self = this;

            this.$fields.find('.ppm-field').each(function() {
                const $field = $(this);
                const $input = $field.find('input[type="text"], input[type="number"], select').first();
                
                if ($input.length) {
                    const name = $input.attr('name');
                    if (name && name.startsWith('component_vars[')) {
                        const key = name.match(/\[([^\]]+)\]/)[1];
                        const currentValue = $input.val();
                        // Use attr() instead of data() and get from parent field, not input.
                        const defaultValue = $field.attr('data-default');
                        
                        values[key] = currentValue;
                        
                        // Check if this field is actually modified from default.
                        if (!self.valuesAreEqual(currentValue, defaultValue)) {
                            hasModifications = true;
                        }
                    }
                }
            });

            if (hasModifications) {
                this.pendingChanges[this.currentComponent] = values;
            } else {
                // Remove from pending if nothing is modified.
                delete this.pendingChanges[this.currentComponent];
            }
        },

        /**
         * Get the count of components with pending changes.
         * 
         * @returns {number}
         */
        getPendingCount() {
            return Object.keys(this.pendingChanges).length;
        },

        /**
         * Filter components by search query.
         *
         * @param {string} query - Search query.
         */
        filterComponents(query) {
            query = query.toLowerCase().trim();

            if (!query) {
                // Reset to collapsed state when search is cleared.
                $('.component-list li').show();
                $('.menu-category').show().addClass('collapsed');
                return;
            }

            // Expand all categories and filter.
            $('.menu-category').removeClass('collapsed');

            $('.component-list li').each(function() {
                const text = $(this).find('.component-name').text().toLowerCase();
                const matches = text.includes(query);
                $(this).toggle(matches);
            });

            // Hide empty categories.
            $('.menu-category').each(function() {
                const hasVisible = $(this).find('.component-list li:visible').length > 0;
                $(this).toggle(hasVisible);
            });
        },

        /**
         * Toggle all variable groups collapsed/expanded.
         */
        toggleAllGroups() {
            const $groups = this.$fields.find('.variable-group');
            const $btn = $('#toggle-all-groups');
            const allCollapsed = $groups.filter('.collapsed').length === $groups.length;

            if (allCollapsed) {
                // Expand all.
                $groups.removeClass('collapsed');
                $btn.find('.dashicons').removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                $btn.contents().filter(function() { return this.nodeType === 3; }).last()[0].textContent = ' ' + this.config.strings.collapseAll;
            } else {
                // Collapse all.
                $groups.addClass('collapsed');
                $btn.find('.dashicons').removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
                $btn.contents().filter(function() { return this.nodeType === 3; }).last()[0].textContent = ' ' + this.config.strings.expandAll;
            }
        },

        /**
         * Copy generated CSS to clipboard.
         */
        copyCss() {
            const css = this.$generatedCss.text();
            const $btn = $('#copy-css');

            if (!css.trim()) {
                this.showToast(this.config.strings.error || 'No CSS to copy', 'error');
                return;
            }

            navigator.clipboard.writeText(css).then(() => {
                // Show success feedback.
                const originalHtml = $btn.html();
                $btn.html('<span class="dashicons dashicons-yes"></span> ' + (this.config.strings.copied || 'Copied!'));
                setTimeout(() => {
                    $btn.html(originalHtml);
                }, 2000);
            }).catch(() => {
                this.showToast(this.config.strings.error || 'Failed to copy', 'error');
            });
        },

        /**
         * Update the preview panel (CSS tab and iframe).
         */
        updatePreview() {
            // Update the CSS tab display with modified Less variables.
            const variables = this.collectCurrentVariables();
            const lessVars = this.generateLessVariablesDisplay(variables);
            this.$generatedCss.text(lessVars);

            // Send variables to the preview iframe for Less compilation.
            this.sendVariablesToPreview();
        },

        /**
         * Generate a display of modified Less variables for the CSS tab.
         *
         * @param {Object} variables - Modified variable name-value pairs.
         * @returns {string} Formatted Less variables display.
         */
        generateLessVariablesDisplay(variables) {
            const entries = Object.entries(variables);
            
            if (entries.length === 0) {
                return '// No modifications - using default values';
            }

            const lines = [
                `// Modified ${this.currentComponent || 'component'} variables`,
                `// ${entries.length} variable(s) changed from defaults`,
                ''
            ];

            entries.forEach(([name, value]) => {
                lines.push(`@${name}: ${value};`);
            });

            return lines.join('\n');
        },

        /**
         * Load the component preview into the iframe.
         *
         * @param {string} component - Component name.
         */
        loadComponentPreview(component) {
            if (!this.$previewFrame.length) {
                return;
            }

            // Hide placeholder and show iframe.
            $('#preview-placeholder').hide();
            this.$previewFrame.show();

            // Build the preview URL.
            const previewUrl = this.config.previewUrl + '&component=' + encodeURIComponent(component);
            this.$previewFrame.attr('src', previewUrl);
        },

        /**
         * Reset all components to defaults.
         */
        resetAllComponents() {
            const self = this;

            if (!confirm(this.config.strings.confirmResetAll || 'Are you sure you want to reset ALL components to their default values? This cannot be undone.')) {
                return;
            }

            const $btn = $('#reset-all-components');
            const originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner is-active"></span>');

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_reset_all_components',
                    nonce: this.config.nonce
                },
                success(response) {
                    $btn.prop('disabled', false).html(originalHtml);

                    if (response.success) {
                        self.showToast(response.data.message, 'success');
                        // Remove all modified indicators from menu.
                        $('.component-link').removeClass('has-modified');
                        $('.modified-dot').remove();
                        // Reload current component to show defaults.
                        if (self.currentComponent) {
                            self.currentComponent = null;
                            self.loadComponent($('#current-component').val());
                        }
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    $btn.prop('disabled', false).html(originalHtml);
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Save all modified components.
         */
        saveAllComponents() {
            const self = this;
            const $btn = $('#save-all-components');
            const originalHtml = $btn.html();

            // First, store any pending changes for the current component.
            if (this.currentComponent) {
                this.storePendingChanges();
            }

            const componentKeys = Object.keys(this.pendingChanges);
            
            if (componentKeys.length === 0) {
                this.showToast(this.config.strings.noChanges || 'No unsaved changes to save.', 'info');
                return;
            }

            $btn.prop('disabled', true).html('<span class="spinner is-active"></span> ' + (this.config.strings.saving || 'Saving...'));

            let savedCount = 0;
            let errorCount = 0;
            let remaining = componentKeys.length;

            // Save each component with pending changes.
            componentKeys.forEach(function(componentId) {
                const values = self.pendingChanges[componentId];

                $.ajax({
                    url: self.config.ajaxUrl,
                    method: 'POST',
                    data: {
                        action: 'epb_save_component',
                        component: componentId,
                        values: values,
                        nonce: self.config.nonce
                    },
                    success(response) {
                        if (response.success) {
                            savedCount++;
                            // Remove from pending changes.
                            delete self.pendingChanges[componentId];
                        } else {
                            errorCount++;
                        }
                    },
                    error() {
                        errorCount++;
                    },
                    complete() {
                        remaining--;
                        
                        if (remaining === 0) {
                            $btn.prop('disabled', false).html(originalHtml);
                            
                            if (errorCount === 0) {
                                self.showToast(
                                    (self.config.strings.savedAllCount || 'Saved %d component(s) successfully.').replace('%d', savedCount),
                                    'success'
                                );
                            } else {
                                self.showToast(
                                    (self.config.strings.savedWithErrors || 'Saved %d component(s), %e failed.').replace('%d', savedCount).replace('%e', errorCount),
                                    'warning'
                                );
                            }
                        }
                    }
                });
            });
        },

        /**
         * Create or update the child theme.
         */
        createChildTheme() {
            const self = this;
            const $btn = $('#create-child-theme');
            const originalHtml = $btn.html();

            $btn.prop('disabled', true).html('<span class="spinner is-active"></span>');

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_create_child_theme',
                    nonce: this.config.nonce
                },
                success(response) {
                    if (response.success) {
                        self.showToast(response.data.message, 'success');
                        self.updateChildThemeStatus(response.data.child_exists, response.data.child_active);
                    } else {
                        self.showToast(response.data.message || 'Failed to create child theme.', 'error');
                    }
                },
                error() {
                    self.showToast('An error occurred while creating child theme.', 'error');
                },
                complete() {
                    $btn.prop('disabled', false).html(originalHtml);
                }
            });
        },

        /**
         * Update the child theme status UI elements.
         *
         * @param {boolean} exists - Whether child theme exists.
         * @param {boolean} active - Whether child theme is active.
         */
        updateChildThemeStatus(exists, active) {
            const $btn = $('#create-child-theme');

            // Update or add status dot inside button.
            let $dot = $btn.find('.child-theme-status-dot');
            if (exists) {
                if ($dot.length === 0) {
                    $dot = $('<span class="child-theme-status-dot"></span>');
                    $btn.append($dot);
                }
                $dot.removeClass('exists active').addClass(active ? 'active' : 'exists');
            } else {
                $dot.remove();
            }
        },

        /**
         * Export all component settings.
         */
        exportAll() {
            const self = this;

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_export_all_components',
                    nonce: this.config.nonce
                },
                success(response) {
                    if (response.success) {
                        const json = JSON.stringify(response.data.export, null, 2);

                        // Create download - only show success after download completes.
                        try {
                            const blob = new Blob([json], { type: 'application/json' });
                            const url = URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'epb-theme-settings.json';
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                            
                            // Small delay to allow download to initiate.
                            setTimeout(() => {
                                URL.revokeObjectURL(url);
                                self.showToast(self.config.strings.exportSuccess, 'success');
                            }, 100);
                        } catch (e) {
                            self.showToast(self.config.strings.error, 'error');
                        }
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Export all UIkit variables for Figma (Tokens Studio format).
         */
        exportFigma() {
            const self = this;

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_export_figma',
                    nonce: this.config.nonce
                },
                success(response) {
                    if (response.success) {
                        const json = JSON.stringify(response.data.tokens, null, 2);
                        const filename = response.data.filename || 'tokens-studio.json';

                        // Create download.
                        try {
                            const blob = new Blob([json], { type: 'application/json' });
                            const url = URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                            
                            // Small delay to allow download to initiate.
                            setTimeout(() => {
                                URL.revokeObjectURL(url);
                                self.showToast('Tokens exported for Figma!', 'success');
                            }, 100);
                        } catch (e) {
                            self.showToast(self.config.strings.error, 'error');
                        }
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Export as YOOtheme style.less format.
         */
        exportYoothemeLess() {
            const self = this;

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_export_yootheme_less',
                    nonce: this.config.nonce
                },
                success(response) {
                    if (response.success) {
                        const less = response.data.less;
                        const filename = response.data.filename || 'style.less';

                        // Create download.
                        try {
                            const blob = new Blob([less], { type: 'text/plain' });
                            const url = URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                            
                            setTimeout(() => {
                                URL.revokeObjectURL(url);
                                self.showToast('Exported as YOOtheme style.less!', 'success');
                            }, 100);
                        } catch (e) {
                            self.showToast(self.config.strings.error, 'error');
                        }
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Show import modal.
         */
        showImportModal() {
            $('#import-modal').show();
            $('#import-data').val('').focus();
        },

        /**
         * Show import Figma modal.
         */
        showImportFigmaModal() {
            $('#import-figma-modal').show();
            $('#import-figma-data').val('').focus();
        },

        /**
         * Hide modal.
         */
        hideModal() {
            $('.ppm-modal').hide();
        },

        /**
         * Import Figma Tokens Studio format.
         */
        importFigma() {
            const self = this;
            const jsonStr = $('#import-figma-data').val().trim();

            this.log('log', '[EPB Import] Starting Figma token import...');

            if (!jsonStr) {
                this.showToast('Please paste Tokens Studio JSON data.', 'error');
                return;
            }

            let data;
            try {
                data = JSON.parse(jsonStr);
                this.log('log', '[EPB Import] Parsed JSON with', Object.keys(data).length, 'top-level keys:', Object.keys(data));
            } catch (e) {
                this.log('error', '[EPB Import] JSON parse error:', e);
                this.showToast(this.config.strings.invalidJson || 'Invalid JSON format.', 'error');
                return;
            }

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_import_figma',
                    tokens: JSON.stringify(data),
                    nonce: this.config.nonce
                },
                success(response) {
                    self.log('log', '[EPB Import] AJAX response:', response);
                    
                    // Log debug messages from server.
                    if (response.data?.debug_logs) {
                        self.log('group', '[EPB Import] Server Debug Logs');
                        response.data.debug_logs.forEach(log => self.log('log', log));
                        self.log('groupEnd');
                    }
                    
                    self.hideModal();

                    if (response.success) {
                        self.log('log', '[EPB Import] Success! Imported:', response.data.imported, 'Skipped:', response.data.skipped);
                        self.showToast(response.data.message, 'success');
                        // Reload current component to show updated values.
                        if (self.currentComponent) {
                            const current = self.currentComponent;
                            self.currentComponent = null;
                            self.loadComponent(current);
                        }
                    } else {
                        self.log('error', '[EPB Import] Server error:', response.data?.message);
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error(xhr, status, error) {
                    self.log('error', '[EPB Import] AJAX error:', status, error, xhr.responseText);
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Import component settings.
         */
        importComponents() {
            const self = this;
            const jsonStr = $('#import-data').val().trim();

            if (!jsonStr) {
                return;
            }

            let data;
            try {
                data = JSON.parse(jsonStr);
            } catch (e) {
                this.showToast(this.config.strings.invalidJson, 'error');
                return;
            }

            $.ajax({
                url: this.config.ajaxUrl,
                method: 'POST',
                data: {
                    action: 'epb_import_components',
                    import: data,
                    nonce: this.config.nonce
                },
                success(response) {
                    self.hideModal();

                    if (response.success) {
                        self.showToast(response.data.message, 'success');
                        // Reload current component.
                        if (self.currentComponent) {
                            self.currentComponent = null;
                            self.loadComponent($('#current-component').val());
                        }
                    } else {
                        self.showToast(response.data?.message || self.config.strings.error, 'error');
                    }
                },
                error() {
                    self.showToast(self.config.strings.error, 'error');
                }
            });
        },

        /**
         * Show toast notification.
         *
         * @param {string} message - Message to display.
         * @param {string} type    - Type: 'success' or 'error'.
         */
        showToast(message, type = 'success') {
            const $toast = this.$toast;
            const iconClass = type === 'success' ? 'dashicons-yes-alt' : 'dashicons-warning';

            $toast
                .removeClass('success error')
                .addClass(type)
                .find('.toast-icon')
                .attr('class', 'toast-icon dashicons ' + iconClass);

            $toast.find('.toast-message').text(message);
            $toast.fadeIn(200);

            setTimeout(() => {
                $toast.fadeOut(200);
            }, 4000);
        }
    };

    // Initialize on DOM ready.
    $(document).ready(() => {
        if ($('#epb-component-picker').length) {
            ComponentPicker.init();
        }
    });

})(jQuery);
