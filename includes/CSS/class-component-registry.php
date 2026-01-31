<?php

/**
 * Component Registry for Enhanced Plugin Bundle.
 *
 * Maps UIkit components to their Less files and organizes them into categories.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage CSS
 * @since 4.1.0
 */

namespace EPB\CSS;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Component_Registry
 *
 * Provides metadata and organization for UIkit components.
 */
class Component_Registry
{
    /**
     * Component metadata for UI organization.
     *
     * @var array<string, array>
     */
    private const COMPONENTS = [
        // Foundation
        'variables' => [
            'label'       => 'Global',
            'icon'        => 'admin-site',
            'description' => 'Global colors, fonts, spacing, and base settings',
            'category'    => 'foundation',
        ],
        'base' => [
            'label'       => 'Base',
            'icon'        => 'editor-code',
            'description' => 'Base HTML element styles (body, links, headings)',
            'category'    => 'foundation',
        ],
        'inverse' => [
            'label'       => 'Inverse',
            'icon'        => 'image-flip-horizontal',
            'description' => 'Light-on-dark inverse color styles',
            'category'    => 'foundation',
        ],

        // Layout
        'container' => [
            'label'       => 'Container',
            'icon'        => 'align-full-width',
            'description' => 'Container widths and padding',
            'category'    => 'layout',
        ],
        'section' => [
            'label'       => 'Section',
            'icon'        => 'align-wide',
            'description' => 'Section padding and backgrounds',
            'category'    => 'layout',
        ],
        'grid' => [
            'label'       => 'Grid',
            'icon'        => 'grid-view',
            'description' => 'Grid system and gutters',
            'category'    => 'layout',
        ],
        'flex' => [
            'label'       => 'Flex',
            'icon'        => 'columns',
            'description' => 'Flexbox utility classes',
            'category'    => 'layout',
        ],
        'tile' => [
            'label'       => 'Tile',
            'icon'        => 'screenoptions',
            'description' => 'Tile padding and backgrounds',
            'category'    => 'layout',
        ],
        'card' => [
            'label'       => 'Card',
            'icon'        => 'id-alt',
            'description' => 'Card styles and variants',
            'category'    => 'layout',
        ],
        'width' => [
            'label'       => 'Width',
            'icon'        => 'leftright',
            'description' => 'Width utility classes',
            'category'    => 'layout',
        ],
        'height' => [
            'label'       => 'Height',
            'icon'        => 'sort',
            'description' => 'Height utility classes',
            'category'    => 'layout',
        ],
        'margin' => [
            'label'       => 'Margin',
            'icon'        => 'align-none',
            'description' => 'Margin spacing utilities',
            'category'    => 'layout',
        ],
        'padding' => [
            'label'       => 'Padding',
            'icon'        => 'align-center',
            'description' => 'Padding spacing utilities',
            'category'    => 'layout',
        ],
        'position' => [
            'label'       => 'Position',
            'icon'        => 'move',
            'description' => 'Position utility classes',
            'category'    => 'layout',
        ],
        'column' => [
            'label'       => 'Column',
            'icon'        => 'columns',
            'description' => 'Multi-column layout',
            'category'    => 'layout',
        ],

        // Navigation
        'nav' => [
            'label'       => 'Nav',
            'icon'        => 'menu',
            'description' => 'Navigation styles',
            'category'    => 'navigation',
        ],
        'navbar' => [
            'label'       => 'Navbar',
            'icon'        => 'menu-alt',
            'description' => 'Navbar component styles',
            'category'    => 'navigation',
        ],
        'subnav' => [
            'label'       => 'Subnav',
            'icon'        => 'ellipsis',
            'description' => 'Sub-navigation styles',
            'category'    => 'navigation',
        ],
        'breadcrumb' => [
            'label'       => 'Breadcrumb',
            'icon'        => 'arrow-right-alt',
            'description' => 'Breadcrumb navigation',
            'category'    => 'navigation',
        ],
        'pagination' => [
            'label'       => 'Pagination',
            'icon'        => 'controls-forward',
            'description' => 'Pagination component',
            'category'    => 'navigation',
        ],
        'tab' => [
            'label'       => 'Tab',
            'icon'        => 'table-row-before',
            'description' => 'Tab navigation',
            'category'    => 'navigation',
        ],
        'dropdown' => [
            'label'       => 'Dropdown',
            'icon'        => 'arrow-down-alt2',
            'description' => 'Dropdown menus',
            'category'    => 'navigation',
        ],
        'drop' => [
            'label'       => 'Drop',
            'icon'        => 'arrow-down',
            'description' => 'Drop positioning',
            'category'    => 'navigation',
        ],
        'dropbar' => [
            'label'       => 'Dropbar',
            'icon'        => 'arrow-down-alt',
            'description' => 'Dropbar component',
            'category'    => 'navigation',
        ],
        'dropnav' => [
            'label'       => 'Dropnav',
            'icon'        => 'admin-links',
            'description' => 'Dropdown navigation',
            'category'    => 'navigation',
        ],
        'offcanvas' => [
            'label'       => 'Offcanvas',
            'icon'        => 'welcome-widgets-menus',
            'description' => 'Off-canvas panels',
            'category'    => 'navigation',
        ],

        // Elements
        'button' => [
            'label'       => 'Button',
            'icon'        => 'button',
            'description' => 'Button styles and variants',
            'category'    => 'elements',
        ],
        'icon' => [
            'label'       => 'Icon',
            'icon'        => 'star-filled',
            'description' => 'Icon component',
            'category'    => 'elements',
        ],
        'badge' => [
            'label'       => 'Badge',
            'icon'        => 'awards',
            'description' => 'Badge component',
            'category'    => 'elements',
        ],
        'label' => [
            'label'       => 'Label',
            'icon'        => 'tag',
            'description' => 'Label component',
            'category'    => 'elements',
        ],
        'alert' => [
            'label'       => 'Alert',
            'icon'        => 'warning',
            'description' => 'Alert messages',
            'category'    => 'elements',
        ],
        'close' => [
            'label'       => 'Close',
            'icon'        => 'no-alt',
            'description' => 'Close button',
            'category'    => 'elements',
        ],
        'divider' => [
            'label'       => 'Divider',
            'icon'        => 'minus',
            'description' => 'Horizontal dividers',
            'category'    => 'elements',
        ],
        'heading' => [
            'label'       => 'Heading',
            'icon'        => 'heading',
            'description' => 'Heading styles',
            'category'    => 'elements',
        ],
        'link' => [
            'label'       => 'Link',
            'icon'        => 'admin-links',
            'description' => 'Link styles',
            'category'    => 'elements',
        ],
        'marker' => [
            'label'       => 'Marker',
            'icon'        => 'location',
            'description' => 'Marker component',
            'category'    => 'elements',
        ],
        'overlay' => [
            'label'       => 'Overlay',
            'icon'        => 'cover-image',
            'description' => 'Overlay component',
            'category'    => 'elements',
        ],
        'placeholder' => [
            'label'       => 'Placeholder',
            'icon'        => 'format-image',
            'description' => 'Placeholder element',
            'category'    => 'elements',
        ],
        'spinner' => [
            'label'       => 'Spinner',
            'icon'        => 'update',
            'description' => 'Loading spinner',
            'category'    => 'elements',
        ],
        'totop' => [
            'label'       => 'Totop',
            'icon'        => 'arrow-up-alt2',
            'description' => 'Scroll to top button',
            'category'    => 'elements',
        ],
        'progress' => [
            'label'       => 'Progress',
            'icon'        => 'chart-bar',
            'description' => 'Progress bar',
            'category'    => 'elements',
        ],

        // Forms
        'form' => [
            'label'       => 'Form',
            'icon'        => 'feedback',
            'description' => 'Form elements and inputs',
            'category'    => 'forms',
        ],
        'form-range' => [
            'label'       => 'Form Range',
            'icon'        => 'image-crop',
            'description' => 'Range slider input',
            'category'    => 'forms',
        ],
        'search' => [
            'label'       => 'Search',
            'icon'        => 'search',
            'description' => 'Search input component',
            'category'    => 'forms',
        ],

        // Content
        'article' => [
            'label'       => 'Article',
            'icon'        => 'media-text',
            'description' => 'Article component',
            'category'    => 'content',
        ],
        'comment' => [
            'label'       => 'Comment',
            'icon'        => 'admin-comments',
            'description' => 'Comment component',
            'category'    => 'content',
        ],
        'description-list' => [
            'label'       => 'Description List',
            'icon'        => 'editor-ul',
            'description' => 'Description list styles',
            'category'    => 'content',
        ],
        'list' => [
            'label'       => 'List',
            'icon'        => 'list-view',
            'description' => 'List styles',
            'category'    => 'content',
        ],
        'table' => [
            'label'       => 'Table',
            'icon'        => 'editor-table',
            'description' => 'Table styles',
            'category'    => 'content',
        ],
        'text' => [
            'label'       => 'Text',
            'icon'        => 'editor-textcolor',
            'description' => 'Text utility styles',
            'category'    => 'content',
        ],

        // Media
        'cover' => [
            'label'       => 'Cover',
            'icon'        => 'cover-image',
            'description' => 'Cover images',
            'category'    => 'media',
        ],
        'lightbox' => [
            'label'       => 'Lightbox',
            'icon'        => 'format-gallery',
            'description' => 'Lightbox gallery',
            'category'    => 'media',
        ],
        'slider' => [
            'label'       => 'Slider',
            'icon'        => 'slides',
            'description' => 'Slider component',
            'category'    => 'media',
        ],
        'slideshow' => [
            'label'       => 'Slideshow',
            'icon'        => 'images-alt2',
            'description' => 'Slideshow component',
            'category'    => 'media',
        ],
        'svg' => [
            'label'       => 'SVG',
            'icon'        => 'admin-appearance',
            'description' => 'SVG utilities',
            'category'    => 'media',
        ],

        // Interactive
        'accordion' => [
            'label'       => 'Accordion',
            'icon'        => 'editor-insertmore',
            'description' => 'Accordion component',
            'category'    => 'interactive',
        ],
        'modal' => [
            'label'       => 'Modal',
            'icon'        => 'welcome-view-site',
            'description' => 'Modal dialogs',
            'category'    => 'interactive',
        ],
        'notification' => [
            'label'       => 'Notification',
            'icon'        => 'bell',
            'description' => 'Notification popups',
            'category'    => 'interactive',
        ],
        'tooltip' => [
            'label'       => 'Tooltip',
            'icon'        => 'info-outline',
            'description' => 'Tooltip component',
            'category'    => 'interactive',
        ],
        'sortable' => [
            'label'       => 'Sortable',
            'icon'        => 'move',
            'description' => 'Sortable list',
            'category'    => 'interactive',
        ],
        'sticky' => [
            'label'       => 'Sticky',
            'icon'        => 'sticky',
            'description' => 'Sticky elements',
            'category'    => 'interactive',
        ],
        'switcher' => [
            'label'       => 'Switcher',
            'icon'        => 'randomize',
            'description' => 'Content switcher',
            'category'    => 'interactive',
        ],

        // Indicators
        'dotnav' => [
            'label'       => 'Dotnav',
            'icon'        => 'ellipsis',
            'description' => 'Dot navigation',
            'category'    => 'indicators',
        ],
        'slidenav' => [
            'label'       => 'Slidenav',
            'icon'        => 'controls-back',
            'description' => 'Slide navigation arrows',
            'category'    => 'indicators',
        ],
        'iconnav' => [
            'label'       => 'Iconnav',
            'icon'        => 'screenoptions',
            'description' => 'Icon navigation',
            'category'    => 'indicators',
        ],
        'thumbnav' => [
            'label'       => 'Thumbnav',
            'icon'        => 'format-gallery',
            'description' => 'Thumbnail navigation',
            'category'    => 'indicators',
        ],

        // Animation
        'animation' => [
            'label'       => 'Animation',
            'icon'        => 'controls-play',
            'description' => 'Animation classes',
            'category'    => 'animation',
        ],
        'transition' => [
            'label'       => 'Transition',
            'icon'        => 'image-rotate',
            'description' => 'CSS transitions',
            'category'    => 'animation',
        ],

        // Utilities
        'align' => [
            'label'       => 'Align',
            'icon'        => 'align-center',
            'description' => 'Float and alignment',
            'category'    => 'utilities',
        ],
        'background' => [
            'label'       => 'Background',
            'icon'        => 'art',
            'description' => 'Background utilities',
            'category'    => 'utilities',
        ],
        'utility' => [
            'label'       => 'Utility',
            'icon'        => 'admin-tools',
            'description' => 'Misc utility classes',
            'category'    => 'utilities',
        ],
        'visibility' => [
            'label'       => 'Visibility',
            'icon'        => 'visibility',
            'description' => 'Show/hide utilities',
            'category'    => 'utilities',
        ],
        'leader' => [
            'label'       => 'Leader',
            'icon'        => 'editor-ul',
            'description' => 'Leader lines',
            'category'    => 'utilities',
        ],
        'countdown' => [
            'label'       => 'Countdown',
            'icon'        => 'clock',
            'description' => 'Countdown timer',
            'category'    => 'utilities',
        ],
    ];

    /**
     * Category definitions with labels and order.
     *
     * @var array<string, array>
     */
    private const CATEGORIES = [
        'foundation' => [
            'label' => 'Foundation',
            'icon'  => 'admin-site',
            'order' => 1,
        ],
        'layout' => [
            'label' => 'Layout',
            'icon'  => 'layout',
            'order' => 2,
        ],
        'navigation' => [
            'label' => 'Navigation',
            'icon'  => 'menu',
            'order' => 3,
        ],
        'elements' => [
            'label' => 'Elements',
            'icon'  => 'admin-appearance',
            'order' => 4,
        ],
        'forms' => [
            'label' => 'Forms',
            'icon'  => 'feedback',
            'order' => 5,
        ],
        'content' => [
            'label' => 'Content',
            'icon'  => 'media-text',
            'order' => 6,
        ],
        'media' => [
            'label' => 'Media',
            'icon'  => 'format-image',
            'order' => 7,
        ],
        'interactive' => [
            'label' => 'Interactive',
            'icon'  => 'admin-generic',
            'order' => 8,
        ],
        'indicators' => [
            'label' => 'Indicators',
            'icon'  => 'ellipsis',
            'order' => 9,
        ],
        'animation' => [
            'label' => 'Animation',
            'icon'  => 'controls-play',
            'order' => 10,
        ],
        'utilities' => [
            'label' => 'Utilities',
            'icon'  => 'admin-tools',
            'order' => 11,
        ],
    ];

    /**
     * Get all registered components with their metadata.
     *
     * @return array<string, array> All components.
     */
    public static function get_all(): array
    {
        return self::COMPONENTS;
    }

    /**
     * Get a single component's metadata.
     *
     * @param string $name Component name.
     * @return array|null Component data or null if not found.
     */
    public static function get_component(string $name): ?array
    {
        if (!isset(self::COMPONENTS[$name])) {
            return null;
        }

        $component = self::COMPONENTS[$name];
        $component['name'] = $name;
        $component['variables'] = Less_Parser::parse_component($name);
        $component['variable_count'] = count($component['variables']);

        return $component;
    }

    /**
     * Get all category definitions.
     *
     * @return array<string, array> Categories.
     */
    public static function get_categories(): array
    {
        return self::CATEGORIES;
    }

    /**
     * Get components grouped by category.
     *
     * @return array<string, array> Components organized by category.
     */
    public static function get_components_by_category(): array
    {
        $grouped = [];

        // Initialize categories in order.
        foreach (self::CATEGORIES as $cat_key => $cat_data) {
            $grouped[$cat_key] = [
                'label'      => $cat_data['label'],
                'icon'       => $cat_data['icon'],
                'order'      => $cat_data['order'],
                'components' => [],
            ];
        }

        // Group components.
        foreach (self::COMPONENTS as $comp_key => $comp_data) {
            $category = $comp_data['category'] ?? 'utilities';
            if (isset($grouped[$category])) {
                $grouped[$category]['components'][$comp_key] = $comp_data;
            }
        }

        // Sort by order.
        uasort($grouped, static fn($a, $b) => $a['order'] <=> $b['order']);

        return $grouped;
    }

    /**
     * Get components in a specific category.
     *
     * @param string $category Category name.
     * @return array<string, array> Components in the category.
     */
    public static function get_category_components(string $category): array
    {
        $components = [];

        foreach (self::COMPONENTS as $key => $data) {
            if (($data['category'] ?? '') === $category) {
                $components[$key] = $data;
            }
        }

        return $components;
    }

    /**
     * Check if a component exists.
     *
     * @param string $name Component name.
     * @return bool True if component exists.
     */
    public static function has_component(string $name): bool
    {
        return isset(self::COMPONENTS[$name]);
    }

    /**
     * Get total variable count across all components.
     *
     * @return int Total number of variables.
     */
    public static function get_total_variable_count(): int
    {
        $total = 0;

        foreach (array_keys(self::COMPONENTS) as $component) {
            $total += Less_Parser::get_variable_count($component);
        }

        return $total;
    }

    /**
     * Search components by name or description.
     *
     * @param string $query Search query.
     * @return array<string, array> Matching components.
     */
    public static function search(string $query): array
    {
        $query   = strtolower($query);
        $results = [];

        foreach (self::COMPONENTS as $key => $data) {
            $label = strtolower($data['label']);
            $desc  = strtolower($data['description']);

            if (str_contains($label, $query) || str_contains($desc, $query) || str_contains($key, $query)) {
                $results[$key] = $data;
            }
        }

        return $results;
    }
}
