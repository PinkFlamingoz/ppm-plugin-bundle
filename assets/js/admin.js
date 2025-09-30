(function () {
  "use strict";

  /**
   * EPBAdmin
   *
   * Enhanced admin interface with modern UX features:
   * - File input drag & drop for theme ZIP uploads
   * - "Select All" checkbox functionality for plugin selection
   * - Progress indicators for bulk operations
   */
  const EPBAdmin = {
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
      this.initFileInput();
      this.initSelectAll();
      this.initBulkActions();
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
        const message = (window.EPBAdminL10n && window.EPBAdminL10n.pluginSelectionUnavailable) || "Plugin selection interface not available.";
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
          const message = (window.EPBAdminL10n && window.EPBAdminL10n.selectAtLeastOne) || "Please select at least one plugin.";
          this.showNotice(message, "error");
        }
      });
    },

    /**
     * Shows admin notice.
     */
    showNotice(message, type = "info") {
      const notice = document.createElement("div");
      notice.className = `notice notice-${type} is-dismissible`;
      notice.style.cssText = "margin: 5px 0 15px; padding: 1px 12px;";
      notice.innerHTML = `<p>${message}</p>`;

      const adminNotices = document.querySelector(".wrap") || document.body;
      adminNotices.insertBefore(notice, adminNotices.firstChild);

      // Auto-remove after 5 seconds
      setTimeout(() => {
        if (notice.parentNode) {
          notice.remove();
        }
      }, 5000);
    },
  };

  // Initialize the EPBAdmin module.
  EPBAdmin.init();
})();
