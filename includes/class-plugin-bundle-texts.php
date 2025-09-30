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
    public const ERROR_FAILED_INSTALL_PLUGIN = 'Failed to install plugin "%s".';
    public const ERROR_INVALID_PLUGIN_URL     = 'Please provide a valid WordPress.org plugin URL.';
    public const THEME_ALREADY_UPLOADED         = 'The theme "%s" is already uploaded.';
    public const ERROR_FAILED_CREATE_THEMES_DIR   = 'Failed to create themes directory.';
    public const ERROR_FAILED_INSTALL_THEME       = 'Failed to install the theme: %s';
    public const ERROR_FAILED_MOVE_UPLOADED_FILE  = 'Failed to move the uploaded file. Please check file permissions.';
    public const ERROR_UPLOAD_FAILED              = 'File upload failed with error code: %s';
    public const ERROR_FAILED_TO_ACTION_PLUGIN    = 'Failed to %s "%s": %s';

    // -------------------------------------------------------------------------
    // Success Messages
    // -------------------------------------------------------------------------
    public const SUCCESS_CSS_UPDATED     = 'Child theme CSS file updated successfully.';
    public const SUCCESS_THEME_ACTIVATED = 'Child theme activated successfully.';
    public const SUCCESS_THEME_UPLOADED  = 'Theme "%s" uploaded and installed successfully.';
    public const SUCCESS_ACTION_PLUGIN   = '"%s" %s successfully.';
    public const SUCCESS_PLUGIN_ALREADY_INSTALLED = 'Plugin "%s" is already installed.';
    public const SUCCESS_PLUGIN_ALREADY_REMOVED   = 'Plugin "%s" was already removed.';

    // -------------------------------------------------------------------------
    // Action Words for Notices
    // -------------------------------------------------------------------------
    public const ACTION_PAST_INSTALLED   = 'installed';
    public const ACTION_PAST_ACTIVATED   = 'activated';
    public const ACTION_PAST_DEACTIVATED = 'deactivated';
    public const ACTION_PAST_DELETED     = 'deleted';
    public const ACTION_PAST_UPLOADED    = 'uploaded';

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
    public const SAVE_CHANGES            = 'Save Changes';
    public const CREATE_CHILD_THEME      = 'Create Child Theme';
    public const UPLOAD_PARENT_THEME     = 'Upload Parent Theme';
    public const UPLOAD_INSTRUCTIONS = 'Upload your parent theme ZIP file below to install it:';
    public const UPLOAD_BUTTON = 'Upload and Install Parent Theme';
    public const CHILD_THEME_INSTRUCTIONS = 'Customize the CSS options for your child theme below. Use the color pickers for color options
                                           and enter numeric values (in pixels) for font sizes. When you’re ready, click the button to save
                                           your options and create/activate the child theme.';
    public const CHILD_THEME_REGENERATE_FUNCTIONS_LABEL = 'Regenerate child theme functions.php';
    public const CHILD_THEME_REGENERATE_FUNCTIONS_HELP  = 'Leave unchecked to preserve your existing child theme functions.php file. Check to overwrite it with the default template.';

    // -------------------------------------------------------------------------
    // Child Theme Form Legends & Summaries
    // -------------------------------------------------------------------------
    public const CHILD_LEGEND_COLOR_OPTIONS            = 'Color Options';
    public const CHILD_LEGEND_TEXT_COLORS              = 'Text Colors';
    public const CHILD_SUMMARY_COLORS                  = 'Colors';
    public const CHILD_LEGEND_BACKGROUND_COLORS        = 'Background Colors';
    public const CHILD_LEGEND_BUTTON_COLORS            = 'Button Colors';
    public const CHILD_SUMMARY_DEFAULT_BUTTON          = 'Default Button';
    public const CHILD_SUMMARY_PRIMARY_BUTTON          = 'Primary Button';
    public const CHILD_SUMMARY_SECONDARY_BUTTON        = 'Secondary Button';
    public const CHILD_SUMMARY_DANGER_BUTTON           = 'Danger Button';
    public const CHILD_SUMMARY_TEXT_BUTTON             = 'Text Button';
    public const CHILD_SUMMARY_LINK_BUTTON             = 'Link Button';
    public const CHILD_LEGEND_ELEMENT_OPTIONS          = 'Element Options';
    public const CHILD_LEGEND_MARGINS                  = 'Margins';
    public const CHILD_LEGEND_DEFAULT                  = 'Default';
    public const CHILD_LEGEND_XSMALL                   = 'XSmall';
    public const CHILD_LEGEND_SMALL                    = 'Small';
    public const CHILD_LEGEND_MEDIUM                   = 'Medium';
    public const CHILD_LEGEND_LARGE                    = 'Large';
    public const CHILD_LEGEND_XLARGE                   = 'XLarge';
    public const CHILD_LEGEND_WIDTHS                   = 'Widths';
    public const CHILD_LEGEND_CONTAINER_OPTIONS        = 'Container Options';
    public const CHILD_LEGEND_PADDING_VERTICAL         = 'Padding Vertical';
    public const CHILD_LEGEND_PADDING_HORIZONTAL       = 'Padding Horizontal';
    public const CHILD_LEGEND_COLUMN_GUTTER            = 'Column Gutter';
    public const CHILD_LEGEND_MAX_WIDTH                = 'Max Width';
    public const CHILD_LEGEND_TEXT_OPTIONS             = 'Text Options';
    public const CHILD_LEGEND_TEXT_DEFAULT_OPTIONS     = 'Text Default Options (Body)';
    public const CHILD_LEGEND_TEXT_SMALL_OPTIONS       = 'Text Small Options';
    public const CHILD_LEGEND_TEXT_LARGE_OPTIONS       = 'Text Large Options';
    public const CHILD_LEGEND_BASE_OPTIONS             = 'Base Options';
    public const CHILD_LEGEND_BREAKPOINTS              = 'Breakpoints';
    public const CHILD_LEGEND_NAVBAR_LINK_OPTIONS      = 'Navbar Link Options';
    public const CHILD_LEGEND_BASE_FONT                = 'Base Font (HTML)';
    public const CHILD_LEGEND_HEADLINE_OPTIONS         = 'Headline Font Sizes & Weights';
    public const CHILD_LEGEND_HEADING_3XL              = 'Heading 3XL';
    public const CHILD_LEGEND_HEADING_2XL              = 'Heading 2XL';
    public const CHILD_LEGEND_HEADING_XL               = 'Heading XL';
    public const CHILD_LEGEND_HEADING_LARGE            = 'Heading Large';
    public const CHILD_LEGEND_HEADING_MEDIUM           = 'Heading Medium';
    public const CHILD_LEGEND_HEADING_SMALL            = 'Heading Small';
    public const CHILD_LEGEND_BUTTON_OPTIONS           = 'Button Font Sizes & Weights';
    public const CHILD_LEGEND_BUTTON_DEFAULT           = 'Button Default';
    public const CHILD_LEGEND_BUTTON_PRIMARY           = 'Button Primary';
    public const CHILD_LEGEND_BUTTON_SECONDARY         = 'Button Secondary';
    public const CHILD_LEGEND_BUTTON_DANGER            = 'Button Danger';
    public const CHILD_LEGEND_BUTTON_TEXT              = 'Button Text';
    public const CHILD_LEGEND_BUTTON_LINK              = 'Button Link';

    // -------------------------------------------------------------------------
    // Child Theme Form Field Labels
    // -------------------------------------------------------------------------
    public const CHILD_LABEL_MUTED_COLOR                     = 'Muted Color';
    public const CHILD_LABEL_EMPHASIS_COLOR                  = 'Emphasis Color';
    public const CHILD_LABEL_PRIMARY_COLOR                   = 'Primary Color';
    public const CHILD_LABEL_SECONDARY_COLOR                 = 'Secondary Color';
    public const CHILD_LABEL_SUCCESS_COLOR                   = 'Success Color';
    public const CHILD_LABEL_WARNING_COLOR                   = 'Warning Color';
    public const CHILD_LABEL_DANGER_COLOR                    = 'Danger Color';
    public const CHILD_LABEL_TEXT_BACKGROUND_COLOR           = 'Text Background Color';
    public const CHILD_LABEL_BODY_COLOR                      = 'Body Color';
    public const CHILD_LABEL_BACKGROUND_DEFAULT              = 'Background Default';
    public const CHILD_LABEL_BACKGROUND_MUTED                = 'Background Muted';
    public const CHILD_LABEL_BACKGROUND_PRIMARY              = 'Background Primary';
    public const CHILD_LABEL_BACKGROUND_SECONDARY            = 'Background Secondary';
    public const CHILD_LABEL_BUTTON_DEFAULT_COLOR            = 'Button Default Color';
    public const CHILD_LABEL_BUTTON_DEFAULT_HOVER_COLOR      = 'Button Default Hover Color';
    public const CHILD_LABEL_BUTTON_DEFAULT_TEXT_COLOR       = 'Button Default Text Color';
    public const CHILD_LABEL_BUTTON_DEFAULT_HOVER_TEXT_COLOR = 'Button Default Hover Text Color';
    public const CHILD_LABEL_BUTTON_PRIMARY_COLOR            = 'Button Primary Color';
    public const CHILD_LABEL_BUTTON_PRIMARY_HOVER_COLOR      = 'Button Primary Hover Color';
    public const CHILD_LABEL_BUTTON_PRIMARY_TEXT_COLOR       = 'Button Primary Text Color';
    public const CHILD_LABEL_BUTTON_PRIMARY_HOVER_TEXT_COLOR = 'Button Primary Hover Text Color';
    public const CHILD_LABEL_BUTTON_SECONDARY_COLOR          = 'Button Secondary Color';
    public const CHILD_LABEL_BUTTON_SECONDARY_HOVER_COLOR    = 'Button Secondary Hover Color';
    public const CHILD_LABEL_BUTTON_SECONDARY_TEXT_COLOR     = 'Button Secondary Text Color';
    public const CHILD_LABEL_BUTTON_SECONDARY_HOVER_TEXT_COLOR = 'Button Secondary Hover Text Color';
    public const CHILD_LABEL_BUTTON_DANGER_COLOR             = 'Button Danger Color';
    public const CHILD_LABEL_BUTTON_DANGER_HOVER_COLOR       = 'Button Danger Hover Color';
    public const CHILD_LABEL_BUTTON_DANGER_TEXT_COLOR        = 'Button Danger Text Color';
    public const CHILD_LABEL_BUTTON_DANGER_HOVER_TEXT_COLOR  = 'Button Danger Hover Text Color';
    public const CHILD_LABEL_BUTTON_TEXT_COLOR               = 'Button Text Color';
    public const CHILD_LABEL_BUTTON_TEXT_HOVER_COLOR         = 'Button Text Hover Color';
    public const CHILD_LABEL_BUTTON_LINK_COLOR               = 'Button Link Color';
    public const CHILD_LABEL_BUTTON_LINK_HOVER_COLOR         = 'Button Link Hover Color';
    public const CHILD_LABEL_DEFAULT_MOBILE_PX               = 'Default Mobile (px)';
    public const CHILD_LABEL_DEFAULT_L_PX                    = 'Default L (px)';
    public const CHILD_LABEL_XSMALL_MOBILE_PX                = 'XSmall Mobile (px)';
    public const CHILD_LABEL_XSMALL_L_PX                     = 'XSmall L (px)';
    public const CHILD_LABEL_SMALL_MOBILE_PX                 = 'Small Mobile (px)';
    public const CHILD_LABEL_SMALL_L_PX                      = 'Small L (px)';
    public const CHILD_LABEL_MEDIUM_MOBILE_PX                = 'Medium Mobile (px)';
    public const CHILD_LABEL_MEDIUM_L_PX                     = 'Medium L (px)';
    public const CHILD_LABEL_LARGE_MOBILE_PX                 = 'Large Mobile (px)';
    public const CHILD_LABEL_LARGE_L_PX                      = 'Large L (px)';
    public const CHILD_LABEL_XLARGE_MOBILE_PX                = 'XLarge Mobile (px)';
    public const CHILD_LABEL_XLARGE_L_PX                     = 'XLarge L (px)';
    public const CHILD_LABEL_WIDTH_SMALL_PX                  = 'Small (px)';
    public const CHILD_LABEL_WIDTH_MEDIUM_PX                 = 'Medium (px)';
    public const CHILD_LABEL_WIDTH_LARGE_PX                  = 'Large (px)';
    public const CHILD_LABEL_WIDTH_XLARGE_PX                 = 'XLarge (px)';
    public const CHILD_LABEL_WIDTH_2XLARGE_PX                = '2XLarge (px)';
    public const CHILD_LABEL_DEFAULT_M_PX                    = 'Default M (px)';
    public const CHILD_LABEL_XSMALL_M_PX                     = 'XSmall M (px)';
    public const CHILD_LABEL_SMALL_M_PX                      = 'Small M (px)';
    public const CHILD_LABEL_LARGE_M_PX                      = 'Large M (px)';
    public const CHILD_LABEL_XLARGE_M_PX                     = 'XLarge M (px)';
    public const CHILD_LABEL_DEFAULT_PX                      = 'Default (px)';
    public const CHILD_LABEL_XSMALL_PX                       = 'XSmall (px)';
    public const CHILD_LABEL_MOBILE_PX                       = 'Mobile (px)';
    public const CHILD_LABEL_SIZE_S_PX                       = 'S (px)';
    public const CHILD_LABEL_SIZE_M_PX                       = 'M (px)';
    public const CHILD_LABEL_SIZE_L_PX                       = 'L (px)';
    public const CHILD_LABEL_DESKTOP_PX                      = 'Desktop (px)';
    public const CHILD_LABEL_FONT_WEIGHT                     = 'Font Weight';
    public const CHILD_LABEL_BREAKPOINT_S_PX                 = 'Breakpoint S (px)';
    public const CHILD_LABEL_BREAKPOINT_M_PX                 = 'Breakpoint M (px)';
    public const CHILD_LABEL_BREAKPOINT_L_PX                 = 'Breakpoint L (px)';
    public const CHILD_LABEL_BREAKPOINT_XL_PX                = 'Breakpoint XL (px)';
    public const CHILD_LABEL_BASE_FONT_SIZE_PX               = 'Base Font Size (px)';
    public const CHILD_SUBMIT_SAVE_OPTIONS                   = 'Save Options & Create Child Theme';

    // -------------------------------------------------------------------------
    // Miscellaneous UI Texts
    // -------------------------------------------------------------------------
    public const NEW_PLUGIN_URL_PLACEHOLDER = 'Enter plugin URL (e.g., https://wordpress.org/plugins/wordpress-seo/)';
    // -------------------------------------------------------------------------
    // Form Action Success & Error Messages
    // -------------------------------------------------------------------------
    public const SETTINGS_UPDATED_SUCCESS = 'Plugin settings updated successfully.';
    public const PLUGIN_REMOVED_SUCCESS   = 'Selected plugin(s) removed from configuration.';
    public const NEW_PLUGIN_ADDED_SUCCESS = 'New plugin added successfully.';
    public const PLUGIN_SLUG_EXISTS_ERROR = 'Plugin with that slug already exists.';
    public const PLUGIN_SLUG_NAME_REQUIRED = 'Please provide both slug and name for the new plugin.';
    public const PLUGIN_SLUG_COULD_NOT_RETRIEVE_ERROR = 'Could not retrieve plugin information from WordPress.org.';

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
