(function () {
  "use strict";

  /**
   * EPBAdminModule
   *
   * Enhanced admin interface with modern UX features:
   * - File input drag & drop for theme ZIP uploads
   * - "Select All" checkbox functionality for plugin selection
   * - Progress indicators for bulk operations
   * - AJAX-powered plugin actions for smoother UX
   */
  const EPBAdminModule = {
    /**
     * Configuration from WordPress.
     */
    config: window.EPBAdmin || {},

    /**
     * Initializes the admin module.
     *
     * Waits for the DOM to be fully loaded before executing the ready() method.
     */
    init() {
      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", this.ready.bind(this));
      } else {
        this.ready();
      }
    },

    /**
     * Called when the DOM is fully loaded.
     *
     * Initializes all individual admin-side event handlers.
     */
    ready() {
      this.preventNoticeRelocation();
      this.initFileInput();
      this.initSelectAll();
      this.initBulkActions();
      this.initQuickActions();
      this.initTokenExport();
    },

    /**
     * Prevents WordPress from relocating our notices and adds auto-dismiss.
     * 
     * WordPress common.js moves .notice elements after the first h1/h2.
     * We mark our notices as already processed to prevent this.
     * Also auto-dismisses notices after 5 seconds with fade animation.
     */
    preventNoticeRelocation() {
      const container = document.getElementById('epb-notices');
      if (!container) return;

      // Get all notices in our container
      const notices = container.querySelectorAll('.notice');
      notices.forEach(notice => {
        // Mark as inline-notice to prevent WP from moving it
        notice.classList.add('inline');

        // Auto-dismiss after 5 seconds with fade animation
        setTimeout(() => {
          notice.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
          notice.style.opacity = '0';
          notice.style.transform = 'translateX(20px)';
          setTimeout(() => {
            if (notice.parentNode) {
              notice.remove();
            }
          }, 300);
        }, 5000);
      });
    },

    /**
     * Initializes the file input for theme ZIP uploads.
     *
     * Binds drag-and-drop events to the file input element with ID "theme-zip".
     * If the element is not found, logs a message to the console.
     */
    initFileInput() {
      const fileInput = document.getElementById("theme-zip");
      if (!fileInput) {
        console.log("No file input with id 'theme-zip' found");
        return;
      }
      fileInput.addEventListener("dragover", this.handleDragOver);
      fileInput.addEventListener("dragleave", this.handleDragLeave);
      // Bind the drop event with the fileInput as its context.
      fileInput.addEventListener("drop", this.handleDrop.bind(fileInput));
    },

    /**
     * Handles the dragover event on the file input.
     *
     * Prevents default browser behavior and applies a dashed border to indicate drop area.
     *
     * @param {Event} e The dragover event.
     */
    handleDragOver(e) {
      e.preventDefault();
      e.stopPropagation();
      this.style.border = "2px dashed #0073aa";
    },

    /**
     * Handles the dragleave event on the file input.
     *
     * Resets the border style when the dragged file leaves the drop zone.
     *
     * @param {Event} e The dragleave event.
     */
    handleDragLeave(e) {
      e.preventDefault();
      e.stopPropagation();
      this.style.border = "1px solid #ccc";
    },

    /**
     * Handles the drop event on the file input.
     *
     * Prevents default behavior, retrieves dropped files, and assigns them to the input.
     *
     * @param {Event} e The drop event.
     */
    handleDrop(e) {
      e.preventDefault();
      e.stopPropagation();
      const files = e.dataTransfer.files;
      if (files && files.length > 0) {
        this.files = files;
      }
    },

    /**
     * Initializes the "Select All" functionality.
     *
     * Binds a change event to the "select-all" checkbox to toggle all individual plugin checkboxes.
     * Also handles group-specific selection if group checkboxes exist.
     */
    initSelectAll() {
      const selectAllCheckbox = document.getElementById("select-all");
      const allPlugins = document.querySelectorAll(
        "tbody input[name='selected_plugins[]']"
      );
      if (!selectAllCheckbox || allPlugins.length === 0) {
        const message = this.getI18n('pluginSelectionUnavailable', 'Plugin selection interface not available.');
        this.showNotice(message, "warning");
        return;
      }

      const updateMasterState = () => {
        const checkedCount = Array.from(allPlugins).filter(
          (cb) => cb.checked
        ).length;
        selectAllCheckbox.checked = checkedCount === allPlugins.length;
        selectAllCheckbox.indeterminate =
          checkedCount > 0 && checkedCount < allPlugins.length;
      };

      selectAllCheckbox.addEventListener("change", () => {
        const isChecked = selectAllCheckbox.checked;
        allPlugins.forEach((cb) => (cb.checked = isChecked));
        updateMasterState();
      });

      allPlugins.forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
          updateMasterState();
        });
      });

      updateMasterState();
    },

   
    /**
     * Initializes enhanced bulk actions with progress indicators.
     */
    initBulkActions() {
      const bulkForm = document.querySelector('form[method="post"]');
      if (!bulkForm) return;

      bulkForm.addEventListener("submit", (e) => {
        const submitter = e.submitter || document.activeElement;
        if (submitter?.name !== "bulk_action_submit") {
          return;
        }

        const selectedPlugins = document.querySelectorAll(
          "input[name='selected_plugins[]']:checked"
        );

        if (selectedPlugins.length === 0) {
          e.preventDefault();
          const message = this.getI18n('selectAtLeastOne', 'Please select at least one plugin.');
          this.showNotice(message, "error");
        }
      });
    },

    /**
     * Shows admin notice as a floating toast in the notices container.
     */
    showNotice(message, type = "info") {
      const notice = document.createElement("div");
      notice.className = `notice notice-${type} is-dismissible inline`;
      notice.innerHTML = `<p>${message}</p>`;

      // Use our dedicated notices container, fallback to .wrap
      const noticesContainer = document.querySelector(".epb-notices-container") || document.querySelector(".wrap");
      if (noticesContainer) {
        noticesContainer.appendChild(notice);
      }

      // Auto-remove after 5 seconds with fade animation
      setTimeout(() => {
        notice.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        notice.style.opacity = '0';
        notice.style.transform = 'translateX(20px)';
        setTimeout(() => {
          if (notice.parentNode) {
            notice.remove();
          }
        }, 300);
      }, 5000);
    },

    /**
     * Initializes quick action buttons for individual plugin rows.
     * These buttons allow AJAX-powered actions without page reload.
     */
    initQuickActions() {
      const quickActionButtons = document.querySelectorAll('.epb-quick-action');
      if (quickActionButtons.length === 0) {
        return;
      }

      quickActionButtons.forEach((button) => {
        button.addEventListener('click', this.handleQuickAction.bind(this));
      });
    },

    /**
     * Handles quick action button clicks.
     * Performs plugin actions via AJAX.
     *
     * @param {Event} e The click event.
     */
    handleQuickAction(e) {
      e.preventDefault();

      const button = e.currentTarget;
      const slug = button.dataset.slug;
      const action = button.dataset.action;

      if (!slug || !action) {
        return;
      }

      // Confirm delete action.
      if (action === 'delete') {
        const confirmMsg = this.getI18n('confirmDelete', 'Are you sure you want to delete this plugin?');
        if (!confirm(confirmMsg)) {
          return;
        }
      }

      // Disable button and show loading state.
      const originalText = button.textContent;
      button.disabled = true;
      button.textContent = this.getI18n('processing', 'Processing...');

      this.performAjaxAction(slug, action)
        .then((response) => {
          if (response.success) {
            this.showNotice(response.data.message, 'success');
            this.updatePluginStatus(slug, response.data.status);
          } else {
            this.showNotice(response.data.message || this.getI18n('error', 'An error occurred.'), 'error');
          }
        })
        .catch((error) => {
          console.error('EPB AJAX Error:', error);
          this.showNotice(this.getI18n('error', 'An error occurred.'), 'error');
        })
        .finally(() => {
          button.disabled = false;
          button.textContent = originalText;
        });
    },

    /**
     * Performs an AJAX action on a plugin.
     *
     * @param {string} slug The plugin slug.
     * @param {string} action The action to perform.
     * @returns {Promise} The fetch promise.
     */
    performAjaxAction(slug, action) {
      const formData = new FormData();
      formData.append('action', 'epb_plugin_action');
      formData.append('slug', slug);
      formData.append('plugin_action', action);
      formData.append('nonce', this.config.nonce || '');

      return fetch(this.config.ajaxUrl || ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
      }).then((response) => response.json());
    },

    /**
     * Updates the plugin status display in the table row.
     *
     * @param {string} slug The plugin slug.
     * @param {object} status The new status object with label and css_class.
     */
    updatePluginStatus(slug, status) {
      if (!status) return;

      const row = document.querySelector(`tr[data-plugin-slug="${slug}"]`);
      if (!row) return;

      const statusCell = row.querySelector('.plugin-status');
      if (statusCell) {
        statusCell.textContent = status.label;
        statusCell.className = `plugin-status ${status.css_class}`;
      }
    },

    /**
     * Initializes the token export button functionality.
     *
     * Binds a click event to the export-tokens button that triggers an AJAX
     * request to export current CSS options to Tokens Studio JSON format.
     */
    initTokenExport() {
      const exportBtn = document.getElementById('export-tokens');
      if (!exportBtn) {
        return;
      }

      exportBtn.addEventListener('click', this.handleTokenExport.bind(this));
    },

    /**
     * Handles the token export button click.
     *
     * Makes an AJAX request to export tokens and downloads the result as a JSON file.
     *
     * @param {Event} e The click event.
     */
    handleTokenExport(e) {
      e.preventDefault();

      const exportBtn = document.getElementById('export-tokens');
      if (!exportBtn) return;

      // Disable button and show loading state.
      const originalText = exportBtn.textContent;
      exportBtn.disabled = true;
      exportBtn.textContent = this.getI18n('exporting', 'Exporting...');

      const formData = new FormData();
      formData.append('action', 'epb_export_tokens');
      formData.append('nonce', this.config.nonce || '');

      fetch(this.config.ajaxUrl || window.ajaxurl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success && data.data && data.data.tokens) {
            // Create and download the JSON file.
            const jsonStr = JSON.stringify(data.data.tokens, null, 2);
            const blob = new Blob([jsonStr], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = data.data.filename || 'tokens.json';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
          } else {
            const errorMsg = data.data && data.data.message
              ? data.data.message
              : this.getI18n('export_error', 'Failed to export tokens.');
            alert(errorMsg);
          }
        })
        .catch((error) => {
          console.error('Token export error:', error);
          alert(this.getI18n('export_error', 'Failed to export tokens.'));
        })
        .finally(() => {
          // Restore button state.
          exportBtn.disabled = false;
          exportBtn.textContent = originalText;
        });
    },

    /**
     * Gets an i18n string from the config.
     *
     * @param {string} key The translation key.
     * @param {string} fallback The fallback string.
     * @returns {string} The translated or fallback string.
     */
    getI18n(key, fallback) {
      if (this.config.i18n && this.config.i18n[key]) {
        return this.config.i18n[key];
      }
      return fallback;
    },
  };

  // Initialize the EPBAdminModule.
  EPBAdminModule.init();
})();
