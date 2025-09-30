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
    public const ERROR_EMPTY_PLUGIN_URL       = 'Please enter a plugin URL.';
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
    public const CHILD_THEME_INSTRUCTIONS = 'Customize the CSS options for your child theme below. Use the color pickers for color options and enter numeric values (in pixels) for font sizes. When you’re ready, click the button to save your options and create/activate the child theme.';
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
    public const JS_WARNING_PLUGIN_UI_MISSING = 'Plugin selection interface not available.';
    public const JS_ERROR_SELECT_PLUGIN       = 'Please select at least one plugin.';
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
    // Internal translation data
    // -------------------------------------------------------------------------

    private const TRANSLATIONS = [
        'de' => [
            'Plugin Bundle Manager' => 'Plugin Bundle Manager',
            'Plugin Bundle' => 'Plugin-Bundle',
            'Install' => 'Installieren',
            'Activate' => 'Aktivieren',
            'Deactivate' => 'Deaktivieren',
            'Delete' => 'Löschen',
            'Delete from List' => 'Aus Liste entfernen',
            'Apply to Selected' => 'Auf Auswahl anwenden',
            'Installed & Active' => 'Installiert & aktiv',
            'Installed & Deactivated' => 'Installiert & deaktiviert',
            'Not Installed' => 'Nicht installiert',
            'Installed' => 'Installiert',
            'Inactive' => 'Inaktiv',
            'Active' => 'Aktiv',
            'Plugin "%s" is not installed.' => 'Plugin "%s" ist nicht installiert.',
            'Failed to fetch plugin information for "%s".' => 'Plugin-Informationen für "%s" konnten nicht abgerufen werden.',
            'YOOtheme Pro is not installed. Please install YOOtheme Pro to create a child theme.' => 'YOOtheme Pro ist nicht installiert. Bitte installiere YOOtheme Pro, um ein Child-Theme zu erstellen.',
            'Failed to create or update the child theme CSS file.' => 'Die CSS-Datei des Child-Themes konnte nicht erstellt oder aktualisiert werden.',
            'Failed to create the child theme directory.' => 'Das Verzeichnis des Child-Themes konnte nicht erstellt werden.',
            'Failed to create the child theme style.css file.' => 'Die style.css des Child-Themes konnte nicht erstellt werden.',
            'Failed to create the child theme functions.php file.' => 'Die functions.php des Child-Themes konnte nicht erstellt werden.',
            'Plugin "%s" is not managed by this bundle.' => 'Plugin "%s" wird nicht von diesem Bundle verwaltet.',
            'Failed to install plugin "%s".' => 'Plugin "%s" konnte nicht installiert werden.',
            'Please provide a valid WordPress.org plugin URL.' => 'Bitte gib eine gültige WordPress.org Plugin-URL an.',
            'Please enter a plugin URL.' => 'Bitte gib eine Plugin-URL ein.',
            'The theme "%s" is already uploaded.' => 'Das Theme "%s" wurde bereits hochgeladen.',
            'Failed to create themes directory.' => 'Das Themes-Verzeichnis konnte nicht erstellt werden.',
            'Failed to install the theme: %s' => 'Theme konnte nicht installiert werden: %s',
            'Failed to move the uploaded file. Please check file permissions.' => 'Die hochgeladene Datei konnte nicht verschoben werden. Bitte überprüfe die Dateiberechtigungen.',
            'File upload failed with error code: %s' => 'Datei-Upload fehlgeschlagen mit Fehlercode: %s',
            'Failed to %s "%s": %s' => 'Fehler beim %1$s von "%2$s": %3$s',
            'Child theme CSS file updated successfully.' => 'CSS-Datei des Child-Themes wurde erfolgreich aktualisiert.',
            'Child theme activated successfully.' => 'Child-Theme wurde erfolgreich aktiviert.',
            'Theme "%s" uploaded and installed successfully.' => 'Theme "%s" wurde erfolgreich hochgeladen und installiert.',
            '"%s" %s successfully.' => '"%s" wurde erfolgreich %s.',
            'Plugin "%s" is already installed.' => 'Plugin "%s" ist bereits installiert.',
            'Plugin "%s" was already removed.' => 'Plugin "%s" wurde bereits entfernt.',
            'installed' => 'installiert',
            'activated' => 'aktiviert',
            'deactivated' => 'deaktiviert',
            'deleted' => 'gelöscht',
            'uploaded' => 'hochgeladen',
            'Select All' => 'Alle auswählen',
            'Plugin' => 'Plugin',
            'Init Path' => 'Init-Pfad',
            'Status' => 'Status',
            'Add New Plugin' => 'Neues Plugin hinzufügen',
            'Slug' => 'Slug',
            'Name' => 'Name',
            'Init Path (optional)' => 'Init-Pfad (optional)',
            'Save Changes' => 'Änderungen speichern',
            'Create Child Theme' => 'Child-Theme erstellen',
            'Upload Parent Theme' => 'Eltern-Theme hochladen',
            'Upload your parent theme ZIP file below to install it:' => 'Lade unten die ZIP-Datei deines Eltern-Themes hoch, um sie zu installieren:',
            'Upload and Install Parent Theme' => 'Eltern-Theme hochladen und installieren',
            'Customize the CSS options for your child theme below. Use the color pickers for color options and enter numeric values (in pixels) for font sizes. When you’re ready, click the button to save your options and create/activate the child theme.' => 'Passe die CSS-Optionen für dein Child-Theme unten an. Verwende die Farbwähler für Farben und gib numerische Werte (in Pixel) für Schriftgrößen ein. Wenn du bereit bist, klicke auf die Schaltfläche, um deine Optionen zu speichern und das Child-Theme zu erstellen bzw. zu aktivieren.',
            'Regenerate child theme functions.php' => 'functions.php des Child-Themes neu erstellen',
            'Leave unchecked to preserve your existing child theme functions.php file. Check to overwrite it with the default template.' => 'Lass das Kontrollkästchen deaktiviert, um deine bestehende functions.php des Child-Themes zu behalten. Aktiviere es, um sie durch die Standardvorlage zu ersetzen.',
            'Color Options' => 'Farben',
            'Text Colors' => 'Textfarben',
            'Colors' => 'Farben',
            'Background Colors' => 'Hintergrundfarben',
            'Button Colors' => 'Button-Farben',
            'Default Button' => 'Standard-Button',
            'Primary Button' => 'Primärer Button',
            'Secondary Button' => 'Sekundärer Button',
            'Danger Button' => 'Warn-Button',
            'Text Button' => 'Text-Button',
            'Link Button' => 'Link-Button',
            'Element Options' => 'Elementoptionen',
            'Margins' => 'Abstände',
            'Default' => 'Standard',
            'XSmall' => 'Sehr klein',
            'Small' => 'Klein',
            'Medium' => 'Mittel',
            'Large' => 'Groß',
            'XLarge' => 'Sehr groß',
            'Widths' => 'Breiten',
            'Container Options' => 'Container-Optionen',
            'Padding Vertical' => 'Vertikale Innenabstände',
            'Padding Horizontal' => 'Horizontale Innenabstände',
            'Column Gutter' => 'Spaltenabstand',
            'Max Width' => 'Maximale Breite',
            'Text Options' => 'Textoptionen',
            'Text Default Options (Body)' => 'Text-Standardoptionen (Body)',
            'Text Small Options' => 'Optionen für kleinen Text',
            'Text Large Options' => 'Optionen für großen Text',
            'Base Options' => 'Basisoptionen',
            'Breakpoints' => 'Breakpoints',
            'Navbar Link Options' => 'Navigationslink-Optionen',
            'Base Font (HTML)' => 'Basis-Schriftgröße (HTML)',
            'Headline Font Sizes & Weights' => 'Überschriftengrößen & -gewichte',
            'Heading 3XL' => 'Überschrift 3XL',
            'Heading 2XL' => 'Überschrift 2XL',
            'Heading XL' => 'Überschrift XL',
            'Heading Large' => 'Überschrift Groß',
            'Heading Medium' => 'Überschrift Mittel',
            'Heading Small' => 'Überschrift Klein',
            'Button Font Sizes & Weights' => 'Button-Schriftgrößen & -gewichte',
            'Button Default' => 'Button Standard',
            'Button Primary' => 'Button Primär',
            'Button Secondary' => 'Button Sekundär',
            'Button Danger' => 'Button Warnung',
            'Button Text' => 'Button Text',
            'Button Link' => 'Button Link',
            'Muted Color' => 'Gedämpfte Farbe',
            'Emphasis Color' => 'Akzentfarbe',
            'Primary Color' => 'Primärfarbe',
            'Secondary Color' => 'Sekundärfarbe',
            'Success Color' => 'Erfolgsfarbe',
            'Warning Color' => 'Warnfarbe',
            'Danger Color' => 'Fehlerfarbe',
            'Text Background Color' => 'Text-Hintergrundfarbe',
            'Body Color' => 'Body-Farbe',
            'Background Default' => 'Standardhintergrund',
            'Background Muted' => 'Gedämpfter Hintergrund',
            'Background Primary' => 'Primärer Hintergrund',
            'Background Secondary' => 'Sekundärer Hintergrund',
            'Button Default Color' => 'Standard-Button-Farbe',
            'Button Default Hover Color' => 'Standard-Button-Farbe (Hover)',
            'Button Default Text Color' => 'Standard-Button-Textfarbe',
            'Button Default Hover Text Color' => 'Standard-Button-Textfarbe (Hover)',
            'Button Primary Color' => 'Primär-Button-Farbe',
            'Button Primary Hover Color' => 'Primär-Button-Farbe (Hover)',
            'Button Primary Text Color' => 'Primär-Button-Textfarbe',
            'Button Primary Hover Text Color' => 'Primär-Button-Textfarbe (Hover)',
            'Button Secondary Color' => 'Sekundär-Button-Farbe',
            'Button Secondary Hover Color' => 'Sekundär-Button-Farbe (Hover)',
            'Button Secondary Text Color' => 'Sekundär-Button-Textfarbe',
            'Button Secondary Hover Text Color' => 'Sekundär-Button-Textfarbe (Hover)',
            'Button Danger Color' => 'Warn-Button-Farbe',
            'Button Danger Hover Color' => 'Warn-Button-Farbe (Hover)',
            'Button Danger Text Color' => 'Warn-Button-Textfarbe',
            'Button Danger Hover Text Color' => 'Warn-Button-Textfarbe (Hover)',
            'Button Text Color' => 'Button-Textfarbe',
            'Button Text Hover Color' => 'Button-Textfarbe (Hover)',
            'Button Link Color' => 'Button-Link-Farbe',
            'Button Link Hover Color' => 'Button-Link-Farbe (Hover)',
            'Default Mobile (px)' => 'Standard Mobil (px)',
            'Default L (px)' => 'Standard L (px)',
            'XSmall Mobile (px)' => 'Sehr klein Mobil (px)',
            'XSmall L (px)' => 'Sehr klein L (px)',
            'Small Mobile (px)' => 'Klein Mobil (px)',
            'Small L (px)' => 'Klein L (px)',
            'Medium Mobile (px)' => 'Mittel Mobil (px)',
            'Medium L (px)' => 'Mittel L (px)',
            'Large Mobile (px)' => 'Groß Mobil (px)',
            'Large L (px)' => 'Groß L (px)',
            'XLarge Mobile (px)' => 'Sehr groß Mobil (px)',
            'XLarge L (px)' => 'Sehr groß L (px)',
            'Small (px)' => 'Klein (px)',
            'Medium (px)' => 'Mittel (px)',
            'Large (px)' => 'Groß (px)',
            'XLarge (px)' => 'Sehr groß (px)',
            '2XLarge (px)' => '2XL (px)',
            'Default M (px)' => 'Standard M (px)',
            'XSmall M (px)' => 'Sehr klein M (px)',
            'Small M (px)' => 'Klein M (px)',
            'Large M (px)' => 'Groß M (px)',
            'XLarge M (px)' => 'Sehr groß M (px)',
            'Default (px)' => 'Standard (px)',
            'XSmall (px)' => 'Sehr klein (px)',
            'Mobile (px)' => 'Mobil (px)',
            'S (px)' => 'S (px)',
            'M (px)' => 'M (px)',
            'L (px)' => 'L (px)',
            'Desktop (px)' => 'Desktop (px)',
            'Font Weight' => 'Schriftstärke',
            'Breakpoint S (px)' => 'Breakpoint S (px)',
            'Breakpoint M (px)' => 'Breakpoint M (px)',
            'Breakpoint L (px)' => 'Breakpoint L (px)',
            'Breakpoint XL (px)' => 'Breakpoint XL (px)',
            'Base Font Size (px)' => 'Basis-Schriftgröße (px)',
            'Save Options & Create Child Theme' => 'Optionen speichern & Child-Theme erstellen',
            'Enter plugin URL (e.g., https://wordpress.org/plugins/wordpress-seo/)' => 'Plugin-URL eingeben (z. B. https://wordpress.org/plugins/wordpress-seo/)',
            'Plugin settings updated successfully.' => 'Plugin-Einstellungen wurden erfolgreich aktualisiert.',
            'Selected plugin(s) removed from configuration.' => 'Ausgewählte Plugins wurden aus der Konfiguration entfernt.',
            'New plugin added successfully.' => 'Neues Plugin wurde erfolgreich hinzugefügt.',
            'Plugin with that slug already exists.' => 'Ein Plugin mit diesem Slug existiert bereits.',
            'Please provide both slug and name for the new plugin.' => 'Bitte gib sowohl Slug als auch Namen für das neue Plugin an.',
            'Could not retrieve plugin information from WordPress.org.' => 'Plugin-Informationen konnten nicht von WordPress.org abgerufen werden.',
            'Plugin selection interface not available.' => 'Plugin-Auswahlschnittstelle ist nicht verfügbar.',
            'Please select at least one plugin.' => 'Bitte wähle mindestens ein Plugin aus.',
        ],
    ];

    // -------------------------------------------------------------------------
    // Methods
    // -------------------------------------------------------------------------

    /**
     * Retrieves a translatable text string.
     *
     * @param string $text The text string to be translated.
     * @return string The translated text.
     */
    public static function get(string $text): string
    {
        $default = function_exists('__') ? (string) call_user_func('__', $text, self::TEXT_DOMAIN) : $text;
        $language = self::get_language_code();
        $translated = self::translate($default, $language, $text);

        /**
         * Filter the resolved plugin text before it is returned.
         *
         * @param string $translated The resolved translation.
         * @param string $original   The original English text.
         * @param string $language   The resolved language code (e.g., "en", "de").
         */
        if (function_exists('apply_filters')) {
            return (string) call_user_func('apply_filters', 'epb_translated_text', $translated, $text, $language);
        }

        return $translated;
    }

    private static function get_language_code(): string
    {
        $locale = 'en';

        if (function_exists('determine_locale')) {
            $locale = (string) call_user_func('determine_locale');
        } elseif (function_exists('get_user_locale')) {
            $locale = (string) call_user_func('get_user_locale');
        } elseif (function_exists('get_locale')) {
            $locale = (string) call_user_func('get_locale');
        }

        return 0 === strpos($locale, 'de') ? 'de' : 'en';
    }

    private static function translate(string $fallback, string $language, string $original): string
    {
        if (isset(self::TRANSLATIONS[$language][$original])) {
            return self::TRANSLATIONS[$language][$original];
        }

        return $fallback;
    }
}
