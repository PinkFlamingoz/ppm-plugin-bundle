<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access.
}


/**
 * Class Plugin_Bundle_Texts
 *
 * Centralizes all text strings used throughout the plugin.
 * Defining all text constants in one place makes it easier to manage translations
 * and maintain consistency in the plugin's user interface.
 */
class Plugin_Bundle_Texts
{
    /**
     * The text domain used for translation functions.
     *
     * @var string
     */
    public const TEXT_DOMAIN = 'text-domain';

    // -------------------------------------------------------------------------
    // Admin Menu Texts
    // -------------------------------------------------------------------------
    public const PLUGIN_BUNDLE_MANAGER = 'Plugin Bundle Manager';
    public const PLUGIN_BUNDLE         = 'Plugin Bundle';

    // -------------------------------------------------------------------------
    // Button & Action Labels
    // -------------------------------------------------------------------------
    public const INSTALL           = 'Install';
    public const ACTIVATE          = 'Activate';
    public const DEACTIVATE        = 'Deactivate';
    public const DELETE            = 'Delete';
    public const DELETE_FROM_LIST  = 'Delete from List';
    public const APPLY_TO_SELECTED = 'Apply to Selected';

    // -------------------------------------------------------------------------
    // Plugin Status Labels
    // -------------------------------------------------------------------------
    public const STATUS_INSTALLED_ACTIVE    = 'Installed & Active';
    public const STATUS_INSTALLED_DEACTIVATED = 'Installed & Deactivated';
    public const STATUS_NOT_INSTALLED         = 'Not Installed';

    // -------------------------------------------------------------------------
    // Theme Status Labels
    // -------------------------------------------------------------------------
    public const THEME_STATUS_INSTALLED    = 'Installed';
    public const THEME_STATUS_INACTIVE = 'Inactive';
    public const THEME_STATUS_ACTIVE         = 'Active';


    // -------------------------------------------------------------------------
    // Error Messages
    // -------------------------------------------------------------------------
    public const ERROR_PLUGIN_NOT_INSTALLED     = 'Plugin "%s" is not installed.';
    public const ERROR_FAILED_TO_FETCH_PLUGIN   = 'Failed to fetch plugin information for "%s".';
    public const ERROR_YOO_THEME_NOT_INSTALLED    = 'YOOtheme Pro is not installed. Please install YOOtheme Pro to create a child theme.';
    public const ERROR_FAILED_TO_CREATE_CSS       = 'Failed to create or update the child theme CSS file.';
    public const ERROR_FAILED_TO_CREATE_CHILD_DIR = 'Failed to create the child theme directory.';
    public const ERROR_FAILED_TO_CREATE_STYLE_HEADER = 'Failed to create the child theme style.css file.';
    public const ERROR_FAILED_TO_CREATE_FUNCTIONS_FILE = 'Failed to create the child theme functions.php file.';
    public const ERROR_PLUGIN_NOT_IN_LIST     = 'Plugin "%s" is not managed by this bundle.';
    public const ERROR_INVALID_PLUGIN_URL     = 'Please provide a valid WordPress.org plugin URL.';
    public const THEME_ALREADY_UPLOADED         = 'The theme "%s" is already uploaded.';
    public const ERROR_FAILED_CREATE_THEMES_DIR   = 'Failed to create themes directory.';
    public const ERROR_FAILED_INSTALL_THEME       = 'Failed to install the theme: %s';
    public const ERROR_FAILED_MOVE_UPLOADED_FILE  = 'Failed to move the uploaded file. Please check file permissions.';
    public const ERROR_UPLOAD_FAILED              = 'File upload failed with error code: %s';
    public const ERROR_FAILED_TO_ACTION_PLUGIN    = 'Failed to %s of "%s": %s';

    // -------------------------------------------------------------------------
    // Success Messages
    // -------------------------------------------------------------------------
    public const SUCCESS_CSS_UPDATED     = 'Child theme CSS file updated successfully.';
    public const SUCCESS_THEME_ACTIVATED = 'Child theme activated successfully.';
    public const SUCCESS_THEME_UPLOADED  = 'Theme "%s" uploaded and installed successfully.';
    public const SUCCESS_ACTION_PLUGIN   = '"%s" %s successfully.';

    // -------------------------------------------------------------------------
    // Table Headers & Other UI Texts
    // -------------------------------------------------------------------------
    public const TABLE_HEADER_SELECT_ALL = 'Select All';
    public const TABLE_HEADER_PLUGIN     = 'Plugin';
    public const TABLE_HEADER_INIT_PATH  = 'Init Path';
    public const TABLE_HEADER_STATUS     = 'Status';
    public const ADD_NEW_PLUGIN          = 'Add New Plugin';
    public const FIELD_SLUG              = 'Slug';
    public const FIELD_NAME              = 'Name';
    public const FIELD_INIT_PATH_OPTIONAL = 'Init Path (optional)';
    public const GROUP_STANDARD          = 'Standard';
    public const SELECT_GROUP            = 'Select %s';
    public const SAVE_CHANGES            = 'Save Changes';
    public const CREATE_CHILD_THEME      = 'Create Child Theme';
    public const UPLOAD_PARENT_THEME     = 'Upload Parent Theme';
    public const UPLOAD_INSTRUCTIONS = 'Upload your parent theme ZIP file below to install it:';
    public const UPLOAD_BUTTON = 'Upload and Install Parent Theme';
    public const CHILD_THEME_INSTRUCTIONS = 'Customize the CSS options for your child theme below. Use the color pickers for color options
                                           and enter numeric values (in pixels) for font sizes. When you’re ready, click the button to save
                                           your options and create/activate the child theme.';
    // -------------------------------------------------------------------------
    // Form Action Success & Error Messages
    // -------------------------------------------------------------------------
    public const SETTINGS_UPDATED_SUCCESS = 'Plugin settings updated successfully.';
    public const PLUGIN_REMOVED_SUCCESS   = 'Selected plugin(s) removed from configuration.';
    public const NEW_PLUGIN_ADDED_SUCCESS = 'New plugin added successfully.';
    public const PLUGIN_SLUG_EXISTS_ERROR = 'Plugin with that slug already exists.';
    public const PLUGIN_SLUG_NAME_REQUIRED = 'Please provide both slug and name for the new plugin.';

    // -------------------------------------------------------------------------
    // Methods
    // -------------------------------------------------------------------------

    /**
     * Retrieves a translatable text string.
     *
     * Wraps the __() translation function with the plugin's text domain so that
     * all text strings defined in this class can be easily translated.
     *
     * @param string $text The text string to be translated.
     * @return string The translated text.
     */
    public static function get(string $text): string
    {
        return __($text, self::TEXT_DOMAIN);
    }
}
