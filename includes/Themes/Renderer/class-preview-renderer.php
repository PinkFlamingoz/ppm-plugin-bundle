<?php

/**
 * Preview Renderer for Component Picker.
 *
 * Generates HTML previews for UIkit components to show live styling.
 *
 * @package Enhanced_Plugin_Bundle
 * @subpackage Themes\Renderer
 * @since 4.2.0
 */

namespace EPB\Themes\Renderer;

// Prevent direct access.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class Preview_Renderer
 *
 * Generates preview HTML for UIkit components.
 */
class Preview_Renderer
{
    /**
     * Get the preview HTML for a component.
     *
     * @param string $component Component name (e.g., 'button', 'card', 'alert').
     * @return string HTML preview content.
     */
    public static function get_preview(string $component): string
    {
        $method = 'preview_' . str_replace('-', '_', $component);

        if (method_exists(self::class, $method)) {
            return self::$method();
        }

        // Default fallback for components without custom preview.
        return self::preview_default($component);
    }

    /**
     * Get all available preview components.
     *
     * @return array List of components with previews.
     */
    public static function get_available_previews(): array
    {
        return [
            'accordion',
            'alert',
            'article',
            'badge',
            'base',
            'breadcrumb',
            'button',
            'card',
            'close',
            'column',
            'comment',
            'countdown',
            'cover',
            'description-list',
            'divider',
            'dotnav',
            'drop',
            'dropbar',
            'dropdown',
            'dropnav',
            'flex',
            'form',
            'grid',
            'heading',
            'height',
            'icon',
            'iconnav',
            'image',
            'inverse',
            'label',
            'leader',
            'lightbox',
            'link',
            'list',
            'margin',
            'marker',
            'modal',
            'nav',
            'navbar',
            'notification',
            'offcanvas',
            'overlay',
            'padding',
            'pagination',
            'parallax',
            'placeholder',
            'position',
            'progress',
            'scroll',
            'scrollspy',
            'search',
            'section',
            'slidenav',
            'slider',
            'slideshow',
            'sortable',
            'spinner',
            'sticky',
            'subnav',
            'svg',
            'switcher',
            'tab',
            'table',
            'text',
            'thumbnav',
            'tile',
            'toggle',
            'tooltip',
            'totop',
            'upload',
            'utility',
            'video',
            'visibility',
            'width',
        ];
    }

    /**
     * Default preview for components without specific preview.
     *
     * @param string $component Component name.
     * @return string HTML content.
     */
    private static function preview_default(string $component): string
    {
        $label = ucwords(str_replace('-', ' ', $component));
        return sprintf(
            '<div class="preview-placeholder-component">
                <span class="uk-text-muted">%s</span>
                <p class="uk-text-small uk-text-muted">%s</p>
            </div>',
            esc_html($label),
            esc_html__('Preview not available for this component.', 'enhanced-plugin-bundle')
        );
    }

    /**
     * Accordion component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_accordion(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-accordion-default" uk-accordion>
                <li class="uk-open">
                    <a class="uk-accordion-title" href>Item 1</a>
                    <div class="uk-accordion-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 2</a>
                    <div class="uk-accordion-content">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 3</a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Icon</h4>
            <ul class="uk-accordion-default" uk-accordion>
                <li class="uk-open">
                    <a class="uk-accordion-title" href>Item 1 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 2 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 3 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">No collapsing</h4>
            <ul class="uk-accordion-default" uk-accordion="collapsible: false">
                <li>
                    <a class="uk-accordion-title" href>Item 1 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 2 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 3 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple open items</h4>
            <ul class="uk-accordion-default" uk-accordion="multiple: true">
                <li class="uk-open">
                    <a class="uk-accordion-title" href>Item 1 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 2 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 3 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Set open items</h4>
            <ul class="uk-accordion-default" uk-accordion>
                <li>
                    <a class="uk-accordion-title" href>Item 1 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </li>
                <li class="uk-open">
                    <a class="uk-accordion-title" href>Item 2 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>Item 3 <span uk-accordion-icon></a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>

HTML;
    }

    /**
     * Alert component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_alert(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div uk-alert>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close button</h4>
            <div uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <h3>Notice</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style modifiers</h4>
            <div class="uk-alert-primary" uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            
            <div class="uk-alert-success" uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            
            <div class="uk-alert-warning" uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            
            <div class="uk-alert-danger" uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
        </div>

HTML;
    }

    /**
     * Article component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_article(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <article class="uk-article">
            
                <h1 class="uk-article-title"><a class="uk-link-reset" href="">Heading</a></h1>
            
                <p class="uk-article-meta">Written by <a href="#">Super User</a> on 12 April 2012. Posted in <a href="#">Blog</a></p>
            
                <p class="uk-text-lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
            
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                    <div>
                        <a class="uk-button uk-button-text" href="#">Read more</a>
                    </div>
                    <div>
                        <a class="uk-button uk-button-text" href="#">5 Comments</a>
                    </div>
                </div>
            
            </article>
        </div>

HTML;
    }

    /**
     * Badge component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_badge(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <span class="uk-badge">1</span>
            <span class="uk-badge">100</span>
        </div>

HTML;
    }

    /**
     * Base component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_base(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Embedded content</h4>
            <div class="uk-width-large">
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="Image">
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Paragraphs</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Headings</h4>
            <h1>h1 Heading 1</h1>
            <h2>h2 Heading 2</h2>
            <h3>h3 Heading 3</h3>
            <h4>h4 Heading 4</h4>
            <h5>h5 Heading 5</h5>
            <h6>h6 Heading 6</h6>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Lists</h4>
            <ul>
                <li>Item 1</li>
                <li>Item 2
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2
                            <ul>
                                <li>Item 1</li>
                                <li>Item 2</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>Item 3</li>
                <li>Item 4</li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Description list</h4>
            <dl>
                <dt>Description lists</dt>
                <dd>A description list defines terms and their corresponding descriptions.</dd>
                <dt>This is a term</dt>
                <dd>This is a description.</dd>
                <dt>This is a term</dt>
                <dd>This is a description.</dd>
            </dl>
        </div>

HTML;
    }

    /**
     * Breadcrumb component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_breadcrumb(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <nav aria-label="Breadcrumb">
                <ul class="uk-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Linked Category</a></li>
                    <li class="uk-disabled"><a>Disabled Category</a></li>
                    <li><span aria-current="page">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></li>
                </ul>
            </nav>
        </div>

HTML;
    }

    /**
     * Button component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_button(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <p uk-margin>
                <a class="uk-button uk-button-default" href="#">Link</a>
                <button class="uk-button uk-button-default">Button</button>
                <button class="uk-button uk-button-default" disabled>Disabled</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style modifiers</h4>
            <p uk-margin>
                <button class="uk-button uk-button-default">Default</button>
                <button class="uk-button uk-button-primary">Primary</button>
                <button class="uk-button uk-button-secondary">Secondary</button>
                <button class="uk-button uk-button-danger">Danger</button>
                <button class="uk-button uk-button-text">Text</button>
                <button class="uk-button uk-button-link">Link</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifiers</h4>
            <p uk-margin>
                <button class="uk-button uk-button-default uk-button-small">Small button</button>
                <button class="uk-button uk-button-primary uk-button-small">Small button</button>
                <button class="uk-button uk-button-secondary uk-button-small">Small button</button>
            </p>
            
            <p uk-margin>
                <button class="uk-button uk-button-default uk-button-large">Large button</button>
                <button class="uk-button uk-button-primary uk-button-large">Large button</button>
                <button class="uk-button uk-button-secondary uk-button-large">Large button</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example</h4>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom">Button</button>
            <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Button</button>
            <button class="uk-button uk-button-secondary uk-width-1-1">Button</button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Group</h4>
            <div>
                <div class="uk-button-group">
                    <button class="uk-button uk-button-secondary">Button</button>
                    <button class="uk-button uk-button-secondary">Button</button>
                    <button class="uk-button uk-button-secondary">Button</button>
                </div>
            </div>
            
            <div class="uk-margin-small">
                <div class="uk-button-group">
                    <button class="uk-button uk-button-primary">Button</button>
                    <button class="uk-button uk-button-primary">Button</button>
                    <button class="uk-button uk-button-primary">Button</button>
                </div>
            </div>
            
            <div>
                <div class="uk-button-group">
                    <button class="uk-button uk-button-danger">Button</button>
                    <button class="uk-button uk-button-danger">Button</button>
                    <button class="uk-button uk-button-danger">Button</button>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Card component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_card(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                <h3 class="uk-card-title">Default</h3>
                <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style modifiers</h4>
            <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Default</h3>
                        <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Primary</h3>
                        <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title">Secondary</h3>
                        <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-inline-clip">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-card uk-card-overlay uk-card-body uk-position-cover uk-position-small">
                            <h3 class="uk-card-title">Overlay</h3>
                            <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Hover modifier</h4>
            <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">Hover</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">Default</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">Primary</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-secondary uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">Secondary</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-inline-clip">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-card uk-card-overlay uk-card-hover uk-card-body uk-position-cover uk-position-small">
                            <h3 class="uk-card-title">Overlay</h3>
                            <p>Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifiers</h4>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                        <h3 class="uk-card-title">Small</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-large uk-card-body">
                        <h3 class="uk-card-title">Large</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Header and footer</h4>
            <div class="uk-card uk-card-default uk-width-1-2@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="https://i.pravatar.cc/80" alt="Avatar">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">Title</h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
                <div class="uk-card-footer">
                    <a href="#" class="uk-button uk-button-text">Read more</a>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Close component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_close(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <button type="button" aria-label="Close" uk-close></button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Large modifier</h4>
            <button class="uk-close-large" type="button" aria-label="Close" uk-close></button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close in alerts</h4>
            <div uk-alert>
                <button class="uk-alert-close" type="button" aria-label="Close" uk-close></button>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close in drops</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Click</button>
                <div uk-drop="mode: click">
                    <div class="uk-card uk-card-body uk-card-default">
                        <button class="uk-drop-close" type="button" aria-label="Close" uk-close></button>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close in modals</h4>
            <a class="uk-button uk-button-default" href="#modal" uk-toggle>Open modal</a>
            <div id="modal" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <button class="uk-modal-close-default" type="button" aria-label="Close" uk-close></button>
                    <h2 class="uk-modal-title">Headline</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p class="uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                        <button class="uk-button uk-button-primary" type="button">Save</button>
                    </p>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Column component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_column(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-column-1-2">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
            
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Responsive</h4>
            <div class="uk-column-1-2@s uk-column-1-3@m uk-column-1-4@l">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
            
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <div class="uk-column-1-2 uk-column-divider">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
            
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Span all columns</h4>
            <div class="uk-column-1-2 uk-column-divider">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
            
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                <blockquote cite="#" class="uk-column-span">
                    <p>All we have to decide is what to do with the time that is given us.</p>
                    <footer>Gandalf in in <cite><a href="">The Fellowship of the Ring</a></cite></footer>
                </blockquote>
            
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            </div>
        </div>

HTML;
    }

    /**
     * Comment component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_comment(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <article class="uk-comment" role="comment">
                <header class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar" src="https://i.pravatar.cc/80" width="80" height="80" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Author</a></h4>
                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                <li><a href="#">12 days ago</a></li>
                                <li><a href="#">Reply</a></li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
            </article>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Primary modifier</h4>
            <article class="uk-comment uk-comment-primary" role="comment">
                <header class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar" src="https://i.pravatar.cc/80" width="80" height="80" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Author</a></h4>
                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                <li><a href="#">12 days ago</a></li>
                                <li><a href="#">Reply</a></li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
            </article>
        </div>

HTML;
    }

    /**
     * Countdown component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_countdown(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-h1 uk-grid-small uk-child-width-auto uk-flex-middle uk-margin" uk-grid uk-countdown="date: {%isodate%}">
                <div>
                    <div class="uk-countdown-number uk-countdown-days"></div>
                </div>
                <div>
                    <div class="uk-countdown-number uk-countdown-hours"></div>
                </div>
                <div>
                    <div class="uk-countdown-number uk-countdown-minutes"></div>
                </div>
                <div>
                    <div class="uk-countdown-number uk-countdown-seconds"></div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Separator</h4>
            <div class="uk-h1 uk-grid-small uk-child-width-auto uk-flex-middle uk-margin" uk-grid uk-countdown="date: {%isodate%}">
                <div>
                    <div class="uk-countdown-number uk-countdown-days"></div>
                </div>
                <div class="uk-countdown-separator">:</div>
                <div>
                    <div class="uk-countdown-number uk-countdown-hours"></div>
                </div>
                <div class="uk-countdown-separator">:</div>
                <div>
                    <div class="uk-countdown-number uk-countdown-minutes"></div>
                </div>
                <div class="uk-countdown-separator">:</div>
                <div>
                    <div class="uk-countdown-number uk-countdown-seconds"></div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Label</h4>
            <div class="uk-grid-small uk-child-width-auto uk-text-center uk-margin" uk-grid uk-countdown="date: {%isodate%}">
                <div>
                    <div class="uk-h1 uk-countdown-number uk-countdown-days"></div>
                    <div class="uk-countdown-label uk-text-small uk-visible@s">Days</div>
                </div>
                <div class="uk-h1"><div class="uk-countdown-separator">:</div></div>
                <div>
                    <div class="uk-h1 uk-countdown-number uk-countdown-hours"></div>
                    <div class="uk-countdown-label uk-text-small uk-visible@s">Hours</div>
                </div>
                <div class="uk-h1"><div class="uk-countdown-separator">:</div></div>
                <div>
                    <div class="uk-h1 uk-countdown-number uk-countdown-minutes"></div>
                    <div class="uk-countdown-label uk-text-small uk-visible@s">Minutes</div>
                </div>
                <div class="uk-h1"><div class="uk-countdown-separator">:</div></div>
                <div>
                    <div class="uk-h1 uk-countdown-number uk-countdown-seconds"></div>
                    <div class="uk-countdown-label uk-text-small uk-visible@s">Seconds</div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Cover component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_cover(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-cover-container uk-height-medium">
                <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Video</h4>
            <div class="uk-cover-container uk-height-medium">
                <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" autoplay loop muted playsinline uk-cover></video>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Iframe</h4>
            <div class="uk-cover-container uk-height-medium">
                <iframe src="https://www.youtube-nocookie.com/embed/c2pz2mlSfXA?playsinline=1&amp;rel=0&amp;controls=0&amp;loop=1" width="1920" height="1080" allowfullscreen uk-cover></iframe>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Responsive height</h4>
            <div class="uk-cover-container">
                <canvas width="400" height="200"></canvas>
                <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
            </div>
        </div>

HTML;
    }

    /**
     * Description List component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_description_list(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <dl class="uk-description-list">
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
            </dl>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <dl class="uk-description-list uk-description-list-divider">
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                <dt>Description term</dt>
                <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
            </dl>
        </div>

HTML;
    }

    /**
     * Divider component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_divider(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider icon</h4>
            <hr class="uk-divider-icon">
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider small</h4>
            <hr class="uk-divider-small">
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider vertical</h4>
            <hr class="uk-divider-vertical">
        </div>

HTML;
    }

    /**
     * Dotnav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_dotnav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-dotnav">
                <li class="uk-active"><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
                <li><a href="#">Item 4</a></li>
                <li><a href="#">Item 5</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Vertical alignment</h4>
            <ul class="uk-dotnav uk-dotnav-vertical">
                <li class="uk-active"><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
                <li><a href="#">Item 4</a></li>
                <li><a href="#">Item 5</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position as overlay</h4>
            <div class="uk-position-relative uk-light" uk-slideshow>
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/600/400" alt="" uk-cover>
                    </div>
                </div>
            
                <div class="uk-position-bottom-center uk-position-small">
                    <ul class="uk-dotnav">
                        <li uk-slideshow-item="0"><a href="#">Item 1</a></li>
                        <li uk-slideshow-item="1"><a href="#">Item 2</a></li>
                        <li uk-slideshow-item="2"><a href="#">Item 3</a></li>
                    </ul>
                </div>
            
            </div>
        </div>

HTML;
    }

    /**
     * Drop component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_drop(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Hover, Click</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Mode</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Hover</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="mode: hover">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Click</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="mode: click">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Parent icon</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Parent <span uk-drop-parent-icon></span></button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="mode: click">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Width and Grid</h4>
            <button class="uk-button uk-button-default" type="button">Hover</button>
            <div class="uk-card uk-card-body uk-card-default uk-width-large" uk-drop>
                <div class="uk-drop-grid uk-child-width-1-2@m" uk-grid>
                    <div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    </div>
                    <div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Top Right</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="pos: top-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Bottom Center</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="pos: bottom-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Right Top</button>
                <div class="uk-card uk-card-body uk-card-default" uk-drop="pos: right-top">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
        </div>

HTML;
    }

    /**
     * Dropbar component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_dropbar(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-overflow-auto uk-height-medium">
                <div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button">Hover</button>
                    <div class="uk-dropbar uk-dropbar-top" uk-drop="stretch: x">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 2</h4>
            <div class="uk-overflow-auto uk-height-medium">
            
                <nav class="uk-navbar-container">
                    <div class="uk-container">
                        <div uk-navbar>
            
                            <div class="uk-navbar-left">
            
                                <ul class="uk-navbar-nav">
                                    <li>
                                        <a href>Parent</a>
                                        <div class="uk-dropbar uk-dropbar-top" uk-drop="stretch: x">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                    </li>
                                </ul>
            
                            </div>
            
                        </div>
                    </div>
                </nav>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Direction</h4>
            <div class="uk-overflow-auto uk-height-medium">
            
                <nav class="uk-navbar-container">
                    <div class="uk-container">
                        <div uk-navbar>
            
                            <div class="uk-navbar-left">
            
                                <ul class="uk-navbar-nav">
                                    <li>
                                        <a href>Top</a>
                                        <div class="uk-dropbar uk-dropbar-top" uk-drop="stretch: x; target: !.uk-navbar-container">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                    </li>
                                    <li>
                                        <a href>Left</a>
                                        <div class="uk-dropbar uk-dropbar-left" uk-drop="stretch: y; target: !.uk-navbar-container">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                                    </li>
                                    <li>
                                        <a href>Right</a>
                                        <div class="uk-dropbar uk-dropbar-right" uk-drop="pos: bottom-right; stretch: y; target: !.uk-navbar-container">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                                    </li>
                                </ul>
            
                            </div>
            
                        </div>
                    </div>
                </nav>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Nav in dropbar</h4>
            <div class="uk-overflow-auto uk-height-large">
            
                <nav class="uk-navbar-container">
                    <div class="uk-container">
                        <div uk-navbar>
            
                            <div class="uk-navbar-left">
            
                                <ul class="uk-navbar-nav">
                                    <li>
                                        <a href>Hover</a>
                                        <div class="uk-dropbar uk-dropbar-top" uk-drop="stretch: x">
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-active"><a href="#">Active</a></li>
                                                <li><a href="#">Item</a></li>
                                                <li class="uk-nav-header">Header</li>
                                                <li><a href="#">Item</a></li>
                                                <li><a href="#">Item</a></li>
                                                <li class="uk-nav-divider"></li>
                                                <li><a href="#">Item</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
            
                            </div>
            
                        </div>
                    </div>
                </nav>
            
            </div>
        </div>

HTML;
    }

    /**
     * Dropdown component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_dropdown(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Hover</button>
                <div uk-dropdown>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Click</button>
                <div uk-dropdown="mode: click">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Nav in dropdown</h4>
            <button class="uk-button uk-button-default" type="button">Hover</button>
            <div uk-dropdown>
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Width and Grid</h4>
            <button class="uk-button uk-button-default" type="button">Hover</button>
            <div class="uk-width-large" uk-dropdown>
                <div class="uk-drop-grid uk-child-width-1-2@m" uk-grid>
                    <div>
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="#">Active</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-header">Header</li>
                            <li><a href="#">Item</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="#">Item</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="#">Active</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-header">Header</li>
                            <li><a href="#">Item</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="#">Item</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Large modifier</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Large</button>
                <div class="uk-dropdown-large" uk-dropdown>
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-header">Header</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position</h4>
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Top Right</button>
                <div uk-dropdown="pos: top-right">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-header">Header</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Bottom Center</button>
                <div uk-dropdown="pos: bottom-center">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-header">Header</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="uk-inline">
                <button class="uk-button uk-button-default" type="button">Right Top</button>
                <div uk-dropdown="pos: right-top">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-header">Header</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Dropnav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_dropnav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <nav uk-dropnav>
                <ul class="uk-subnav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Item</a></li>
                </ul>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Click mode</h4>
            <nav uk-dropnav="mode: click">
                <ul class="uk-subnav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Item</a></li>
                </ul>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Alignment</h4>
            <nav uk-dropnav="align: center">
                <ul class="uk-subnav uk-flex-center">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href>Parent <span uk-drop-parent-icon></span></a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Item</a></li>
                </ul>
            </nav>
        </div>

HTML;
    }

    /**
     * Flex component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_flex(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-flex">
                <div class="uk-card uk-card-default uk-card-body">Item 1</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 2</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 3</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Horizontal alignment</h4>
            <div class="uk-flex uk-flex-center">
                <div class="uk-card uk-card-default uk-card-body">Item 1</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 2</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 3</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 3</h4>
            <div class="uk-flex uk-flex-center@m uk-flex-right@l">
                <div class="uk-card uk-card-default uk-card-body">Item 1</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 2</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 3</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Vertical alignment</h4>
            <div class="uk-flex uk-flex-middle uk-text-center">
                <div class="uk-card uk-card-default uk-card-body">Item 1</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 2<br>…</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-left">Item 3<br>…<br>…</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Direction modifiers</h4>
            <div class="uk-flex uk-flex-column uk-width-1-3">
                <div class="uk-card uk-card-default uk-card-body">Item 1</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-top">Item 2</div>
                <div class="uk-card uk-card-default uk-card-body uk-margin-top">Item 3</div>
            </div>
        </div>

HTML;
    }

    /**
     * Form component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_form(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <form>
                <fieldset class="uk-fieldset">
            
                    <legend class="uk-legend">Legend</legend>
            
                    <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="Input" aria-label="Input">
                    </div>
            
                    <div class="uk-margin">
                        <select class="uk-select" aria-label="Select">
                            <option>Option 01</option>
                            <option>Option 02</option>
                        </select>
                    </div>
            
                    <div class="uk-margin">
                        <textarea class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"></textarea>
                    </div>
            
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                        <label><input class="uk-radio" type="radio" name="radio2" checked> A</label>
                        <label><input class="uk-radio" type="radio" name="radio2"> B</label>
                    </div>
            
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                        <label><input class="uk-checkbox" type="checkbox" checked> A</label>
                        <label><input class="uk-checkbox" type="checkbox"> B</label>
                    </div>
            
                    <div class="uk-margin">
                        <input class="uk-range" type="range" value="2" min="0" max="10" step="0.1" aria-label="Range">
                    </div>
            
                </fieldset>
            </form>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">States modifiers</h4>
            <div class="uk-margin">
                <input class="uk-input uk-form-danger uk-form-width-medium" type="text" placeholder="form-danger" aria-label="form-danger" value="form-danger">
            </div>
            
            <div class="uk-margin">
                <input class="uk-input uk-form-success uk-form-width-medium" type="text" placeholder="form-success" aria-label="form-success" value="form-success">
            </div>
            
            <div class="uk-margin">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="disabled" aria-label="disabled" value="disabled" disabled>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifiers</h4>
            <form>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-medium uk-form-large" type="text" placeholder="Large" aria-label="Large">
                    <select class="uk-select uk-form-width-small uk-form-large" aria-label="Large">
                        <option>Option 01</option>
                        <option>Option 02</option>
                        <optgroup label="Optgroup">
                            <option>Option A</option>
                            <option>Option B</option>
                        </optgroup>
                    </select>
                    <input class="uk-checkbox uk-form-large" type="checkbox">
                    <input class="uk-radio uk-form-large" type="radio">
                </div>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Default" aria-label="Default">
                    <select class="uk-select uk-form-width-small" aria-label="Default">
                        <option>Option 01</option>
                        <option>Option 02</option>
                        <optgroup label="Optgroup">
                            <option>Option A</option>
                            <option>Option B</option>
                        </optgroup>
                    </select>
                    <input class="uk-checkbox" type="checkbox">
                    <input class="uk-radio" type="radio">
                </div>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-medium uk-form-small" type="text" placeholder="Small" aria-label="Small">
                    <select class="uk-select uk-form-width-small uk-form-small" aria-label="Small">
                        <option>Option 01</option>
                        <option>Option 02</option>
                        <optgroup label="Optgroup">
                            <option>Option A</option>
                            <option>Option B</option>
                        </optgroup>
                    </select>
                    <input class="uk-checkbox uk-form-small" type="checkbox">
                    <input class="uk-radio uk-form-small" type="radio">
                </div>
            
            </form>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Width modifiers</h4>
            <form>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" placeholder="Large" aria-label="Large">
                </div>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Medium" aria-label="Medium">
                </div>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-small" type="text" placeholder="Small" aria-label="Small">
                </div>
            
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-xsmall" type="text" placeholder="X-Small" aria-label="X-Small">
                </div>
            
            </form>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 5</h4>
            <form>
                <input class="uk-input uk-width-1-2" type="text" placeholder="uk-width-1-2" aria-label="uk-width-1-2">
            </form>
        </div>

HTML;
    }

    /**
     * Grid component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_grid(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Gap modifiers</h4>
            <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
            
            <div class="uk-grid-medium uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
            
            <div class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
            
            <div class="uk-grid-collapse uk-child-width-expand@s uk-text-center uk-margin-large-top" uk-grid>
                <div>
                    <div class="uk-background-muted uk-padding">Item</div>
                </div>
                <div>
                    <div class="uk-background-primary uk-padding uk-light">Item</div>
                </div>
                <div>
                    <div class="uk-background-secondary uk-padding uk-light">Item</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Column and Row</h4>
            <div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Nested grid</h4>
            <div class="uk-child-width-1-2 uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-child-width-1-2 uk-text-center" uk-grid>
                        <div>
                            <div class="uk-card uk-card-primary uk-card-body">Item</div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-primary uk-card-body">Item</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <div class="uk-grid-divider uk-child-width-expand@s" uk-grid>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                <div>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                <div>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</div>
            </div>
        </div>

HTML;
    }

    /**
     * Heading component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_heading(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifiers</h4>
            <h1 class="uk-heading-small">Small</h1>
            <h1 class="uk-heading-medium">Medium</h1>
            <h1 class="uk-heading-large">Large</h1>
            <h1 class="uk-heading-xlarge">X-Large</h1>
            <h1 class="uk-heading-2xlarge">2X-Large</h1>
            <h1 class="uk-heading-3xlarge">3X-Large</h1>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <h1 class="uk-heading-divider">Heading Divider</h1>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Bullet modifier</h4>
            <h1 class="uk-heading-bullet">Heading Bullet</h1>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Line modifier</h4>
            <h1 class="uk-heading-line"><span>Heading Line</span></h1>
            
            <h1 class="uk-heading-line uk-text-center"><span>Heading Line</span></h1>
            
            <h1 class="uk-heading-line uk-text-right"><span>Heading Line</span></h1>
        </div>

HTML;
    }

    /**
     * Height component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_height(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-1-3@s" uk-grid>
                <div>
                    <div class="uk-height-small uk-card uk-card-default uk-card-body uk-flex uk-flex-center uk-flex-middle">Small</div>
                </div>
                <div>
                    <div class="uk-height-medium uk-card uk-card-default uk-card-body uk-flex uk-flex-center uk-flex-middle">Medium</div>
                </div>
                <div>
                    <div class="uk-height-large uk-card uk-card-default uk-card-body uk-flex uk-flex-center uk-flex-middle">Large</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Match cards</h4>
            <div class="uk-child-width-1-2@s" uk-grid uk-height-match="target: > div > .uk-card">
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Lorem Ipsum</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Lorem Ipsum</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Match all</h4>
            <div class="uk-child-width-1-2@s" uk-grid uk-height-match="target: > div > .uk-card; row: false">
                <div class="uk-first-column">
                    <div class="uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Lorem Ipsum</div>
                </div>
                <div class="uk-grid-margin uk-first-column">
                    <div class="uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
                <div class="uk-grid-margin">
                    <div class="uk-card uk-card-default uk-card-body">Lorem Ipsum</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Placeholder height</h4>
            <div class="uk-position-relative">
            
                <div class="tm-header uk-position-top">
                    <nav class="uk-navbar-container uk-navbar-transparent" uk-inverse="sel-active: .uk-navbar-transparent">
                        <div class="uk-container">
                            <div uk-navbar>
                                <div class="uk-navbar-left">
                                    <a class="uk-navbar-item uk-logo" href="#">Transparent Navbar</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            
                <div class="uk-section-muted">
                    <div uk-height-placeholder="!.uk-position-relative .tm-header"></div>
                    <div class="uk-section">
                        <div class="uk-container">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>

HTML;
    }

    /**
     * Icon component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_icon(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <span class="uk-margin-small-right" uk-icon="check"></span>
            
            <a href="" uk-icon="heart"></a>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Ratio</h4>
            <span class="uk-margin-xsmall-right" uk-icon="icon: check; ratio: 2"></span>
            <span uk-icon="icon: check; ratio: 3.5"></span>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Link modifier</h4>
            <div>
                <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="copy"></a>
                <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                <a href="#" class="uk-icon-link" uk-icon="trash"></a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Button modifier</h4>
            <div>
                <a href="" class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                <a href="" class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                <a href="" class="uk-icon-button" uk-icon="youtube"></a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Overlay modifier</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
            
                    <a href class="uk-inline uk-dark">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                        <div class="uk-position-center">
                            <span class="uk-icon-overlay" href="#" uk-icon="ratio: 3; icon: play-circle"></span>
                        </div>
                    </a>
            
                </div>
                <div>
            
                    <a href class="uk-inline uk-light">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                        <div class="uk-position-center">
                            <span class="uk-icon-overlay" href="#" uk-icon="ratio: 3; icon: youtube"></span>
                        </div>
                    </a>
            
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Iconnav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_iconnav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-iconnav">
                <li><a href="#" uk-icon="icon: plus"></a></li>
                <li><a href="#" uk-icon="icon: file-edit"></a></li>
                <li><a href="#" uk-icon="icon: copy"></a></li>
                <li><a href="#"><span uk-icon="icon: bag"></span> (2)</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Vertical alignment</h4>
            <ul class="uk-iconnav uk-iconnav-vertical">
                <li><a href="#" uk-icon="icon: plus"></a></li>
                <li><a href="#" uk-icon="icon: file-edit"></a></li>
                <li><a href="#" uk-icon="icon: copy"></a></li>
                <li><a href="#"><span uk-icon="icon: bag"></span> (2)</a></li>
            </ul>
        </div>

HTML;
    }

    /**
     * Image component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_image(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="https://images.unsplash.com/photo-1490822180406-880c226c150b?fit=crop&w=650&h=433&q=80" uk-img>
              <h1>Background Image</h1>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Eager loading</h4>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="https://images.unsplash.com/photo-1495321308589-43affb814eee?fit=crop&w=650&h=433&q=80" uk-img="loading: eager">
              <h1>Background Image</h1>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Srcset</h4>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover"
                 data-src="https://images.unsplash.com/photo-1491895200222-0fc4a4c35e18?fit=crop&w=650&h=433&q=80"
                 data-srcset="https://images.unsplash.com/photo-1491895200222-0fc4a4c35e18?fit=crop&w=650&h=433&q=80 650w,
                              https://images.unsplash.com/photo-1491895200222-0fc4a4c35e18?fit=crop&w=1300&h=866&q=80 1300w"
                 sizes="(min-width: 650px) 650px, 100vw" uk-img>
                <h1>Background Image</h1>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Picture sources</h4>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
                 sources="srcset: https://images.unsplash.com/photo-1487837647815-bbc1f30cd0d2?fit=crop&w=650&h=433&q=80; media: (min-width: 1200px)"
                 data-src="https://images.unsplash.com/photo-1546349851-64285be8e9fa?fit=crop&w=650&h=433&q=80"
                 uk-img>
                <h1>Background Image</h1>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 5</h4>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
                 sources="srcset: https://images.unsplash.com/photo-1464621922360-27f3bf0eca75?fit=crop&w=650&h=433&q=80 650w,
                                  https://images.unsplash.com/photo-1464621922360-27f3bf0eca75?fit=crop&w=1300&h=866&q=80 1300w;
                          media: (min-width: 1200px)"
                 data-src="https://images.unsplash.com/photo-1472803828399-39d4ac53c6e5?fit=crop&w=650&h=433&q=80"
                 data-srcset="https://images.unsplash.com/photo-1472803828399-39d4ac53c6e5?fit=crop&w=650&h=433&q=80 650w,
                              https://images.unsplash.com/photo-1472803828399-39d4ac53c6e5?fit=crop&w=1300&h=866&q=80 1300w"
                 sizes="(min-width: 650px) 650px, 100vw" uk-img>
                <h1>Background Image</h1>
            </div>
        </div>

HTML;
    }

    /**
     * Inverse component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_inverse(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="uk-light uk-background-secondary uk-padding">
                        <h3>Light</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button class="uk-button uk-button-default">Button</button>
                    </div>
                </div>
                <div>
                    <div class="uk-dark uk-background-muted uk-padding">
                        <h3>Dark</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button class="uk-button uk-button-default">Button</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Extending components</h4>
            <div class="uk-section uk-section-primary uk-preserve-color">
                <div class="uk-container">
            
                    <div class="uk-panel uk-light uk-margin-medium">
                        <h3>Section Primary with cards</h3>
                    </div>
            
                    <div class="uk-grid-match uk-child-width-expand@m" uk-grid>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
            <div class="uk-child-width-1-2@s uk-grid-collapse uk-grid-match uk-text-center" uk-grid>
                <div>
                    <div class="uk-tile uk-tile-primary">
            
                        <div class="uk-panel uk-light uk-margin-medium">
                            <h3>Tile Primary with card</h3>
                        </div>
            
                        <div class="uk-card uk-card-default uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
            
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-secondary">
            
                        <div class="uk-panel uk-light uk-margin-medium">
                            <h3>Tile Secondary with card</h3>
                        </div>
            
                        <div class="uk-card uk-card-default uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Label component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_label(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <span class="uk-label">Default</span>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style modifiers</h4>
            <span class="uk-label">Default</span>
            
            <span class="uk-label uk-label-success">Success</span>
            
            <span class="uk-label uk-label-warning">Warning</span>
            
            <span class="uk-label uk-label-danger">Danger</span>
        </div>

HTML;
    }

    /**
     * Leader component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_leader(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-expand" uk-leader>Lorem ipsum dolor sit amet</div>
                <div>$20.90</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Fill character</h4>
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-expand" uk-leader="fill: -">Lorem ipsum dolor sit amet</div>
                <div>$20.90</div>
            </div>
        </div>

HTML;
    }

    /**
     * Lightbox component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_lightbox(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div uk-lightbox>
                <a class="uk-button uk-button-default" href="https://picsum.photos/1800/1200?grayscale">Open Lightbox</a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Alt attribute</h4>
            <div uk-lightbox>
                <a class="uk-button uk-button-default" href="https://picsum.photos/1800/1200?grayscale" data-alt="Image">Open Lightbox</a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Caption</h4>
            <div uk-lightbox>
                <a class="uk-button uk-button-default" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption">Open Lightbox</a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Animations</h4>
            <div class="uk-h3">Slide</div>
            <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: slide">
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption 1">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?blur=2" data-caption="Caption 2">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200" data-caption="Caption 3">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                    </a>
                </div>
            </div>
            
            <div class="uk-h3">Fade</div>
            <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: fade">
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption 1">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?blur=2" data-caption="Caption 2">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200" data-caption="Caption 3">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                    </a>
                </div>
            </div>
            
            <div class="uk-h3">Scale</div>
            <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: scale">
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption 1">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?blur=2" data-caption="Caption 2">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200" data-caption="Caption 3">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Navigations</h4>
            <div class="uk-h3">Thumbnav</div>
            <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="nav: thumbnav; slidenav: false">
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption 1">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?blur=2" data-caption="Caption 2">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200" data-caption="Caption 3">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                    </a>
                </div>
            </div>
            
            <div class="uk-h3">Dotnav</div>
            <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="nav: dotnav; slidenav: false">
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?grayscale" data-caption="Caption 1">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200?blur=2" data-caption="Caption 2">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                    </a>
                </div>
                <div>
                    <a class="uk-inline" href="https://picsum.photos/1800/1200" data-caption="Caption 3">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                    </a>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Link component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_link(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Muted modifier</h4>
            <a class="uk-link-muted" href="#">Link</a>
            
            <p class="uk-link-muted">Lorem ipsum <a href="#">dolor sit</a> amet, consectetur adipiscing elit, sed do <a href="#">eiusmod</a> tempor incididunt ut <a href="#">labore et</a> dolore magna aliqua.</p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Text modifier</h4>
            <ul class="uk-list uk-link-text">
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Heading modifier</h4>
            <h3><a class="uk-link-heading" href="#">Heading</a></h3>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Reset modifier</h4>
            <a class="uk-link-reset" href="#">Link</a>
            
            <h3><a class="uk-link-reset" href="#">Heading</a></h3>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Toggle</h4>
            <a href class="uk-display-block uk-card uk-card-body uk-card-default uk-link-toggle uk-width-medium">
                <h3 class="uk-card-title"><span class="uk-link-heading">Heading</span></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </a>
        </div>

HTML;
    }

    /**
     * List component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_list(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-list">
                <li>List item 1</li>
                <li>List item 2</li>
                <li>List item 3</li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style type modifiers</h4>
            <div class="uk-child-width-expand@s" uk-grid>
            
                <div>
                    <h4>Disc</h4>
                    <ul class="uk-list uk-list-disc">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Circle</h4>
                    <ul class="uk-list uk-list-circle">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Square</h4>
                    <ul class="uk-list uk-list-square">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Decimal</h4>
                    <ul class="uk-list uk-list-decimal">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Hyphen</h4>
                    <ul class="uk-list uk-list-hyphen">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Color modifiers</h4>
            <div class="uk-child-width-expand@s" uk-grid>
            
                <div>
                    <h4>Muted</h4>
                    <ul class="uk-list uk-list-disc uk-list-muted">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Emphasis</h4>
                    <ul class="uk-list uk-list-disc uk-list-emphasis">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Primary</h4>
                    <ul class="uk-list uk-list-disc uk-list-primary">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
                <div>
                    <h4>Secondary</h4>
                    <ul class="uk-list uk-list-disc uk-list-secondary">
                        <li>List item 1</li>
                        <li>List item 2</li>
                        <li>List item 3</li>
                    </ul>
                </div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Image bullet modifier</h4>
            <ul class="uk-list uk-list-bullet">
                <li>List item 1</li>
                <li>List item 2</li>
                <li>List item 3</li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <ul class="uk-list uk-list-divider">
                <li>List item 1</li>
                <li>List item 2</li>
                <li>List item 3</li>
            </ul>
        </div>

HTML;
    }

    /**
     * Margin component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_margin(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-margin uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <div class="uk-margin uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">X-Small margin</h4>
            <div class="uk-margin-xsmall uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <div class="uk-margin-xsmall uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Small margin</h4>
            <div class="uk-margin-small uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <div class="uk-margin-small uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Medium margin</h4>
            <div class="uk-margin-medium uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <div class="uk-margin-medium uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Large margin</h4>
            <div class="uk-margin-large uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <div class="uk-margin-large uk-card uk-card-default uk-card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
        </div>

HTML;
    }

    /**
     * Marker component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_marker(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-1-2" uk-grid>
                <div>
                    <div class="uk-inline uk-dark">
                        <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                        <a class="uk-position-absolute uk-transform-center" style="left: 20%; top: 30%" href="#" uk-marker></a>
                        <a class="uk-position-absolute uk-transform-center" style="left: 60%; top: 40%" href="#" uk-marker></a>
                        <a class="uk-position-absolute uk-transform-center" style="left: 80%; top: 70%" href="#" uk-marker></a>
                    </div>
                </div>
                <div>
                    <div class="uk-inline uk-light">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                        <a class="uk-position-absolute uk-transform-center" style="left: 20%; top: 30%" href="#" uk-marker></a>
                        <a class="uk-position-absolute uk-transform-center" style="left: 60%; top: 40%" href="#" uk-marker></a>
                        <a class="uk-position-absolute uk-transform-center" style="left: 80%; top: 70%" href="#" uk-marker></a>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Modal component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_modal(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <!-- This is a button toggling the modal -->
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example">Open</button>
            
            <!-- This is an anchor toggling the modal -->
            <a href="#modal-example" uk-toggle>Open</a>
            
            <!-- This is the modal -->
            <div id="modal-example" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">Headline</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p class="uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                        <button class="uk-button uk-button-primary" type="button">Save</button>
                    </p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close button</h4>
            <!-- This is a button toggling the modal with the default close button -->
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-close-default">Default</button>
            
            <!-- This is the modal with the default close button -->
            <div id="modal-close-default" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <h2 class="uk-modal-title">Default</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            
            <!-- This is a button toggling the modal with the outside close button -->
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-close-outside">Outside</button>
            
            <!-- This is the modal with the outside close button -->
            <div id="modal-close-outside" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <button class="uk-modal-close-outside" type="button" uk-close></button>
                    <h2 class="uk-modal-title">Outside</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Center modal</h4>
            <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>Open</a>
            
            <div id="modal-center" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
            
                    <button class="uk-modal-close-default" type="button" uk-close></button>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Header and footer</h4>
            <a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>Open</a>
            
            <div id="modal-sections" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <div class="uk-modal-header">
                        <h2 class="uk-modal-title">Modal Title</h2>
                    </div>
                    <div class="uk-modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                        <button class="uk-button uk-button-primary" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Container modifier</h4>
            <a class="uk-button uk-button-default" href="#modal-container" uk-toggle>Open</a>
            
            <div id="modal-container" class="uk-modal-container" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <h2 class="uk-modal-title">Headline</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Nav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_nav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-width-1-2@s uk-width-2-5@m">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Nested navs</h4>
            <div class="uk-width-1-2@s uk-width-2-5@m">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li class="uk-parent">
                        <a href="#">Parent</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li>
                                <a href="#">Sub item</a>
                                <ul>
                                    <li><a href="#">Sub item</a></li>
                                    <li><a href="#">Sub item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Accordion</h4>
            <div class="uk-width-1-2@s uk-width-2-5@m">
                <ul class="uk-nav-default" uk-nav>
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li class="uk-parent">
                        <a href="#">Parent</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li>
                                <a href="#">Sub item</a>
                                <ul>
                                    <li><a href="#">Sub item</a></li>
                                    <li><a href="#">Sub item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a href="#">Parent</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li><a href="#">Sub item</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Parent icon</h4>
            <div class="uk-width-1-2@s uk-width-2-5@m">
                <ul class="uk-nav-default" uk-nav>
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li class="uk-parent">
                        <a href="#">Parent <span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li>
                                <a href="#">Sub item</a>
                                <ul>
                                    <li><a href="#">Sub item</a></li>
                                    <li><a href="#">Sub item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a href="#">Parent <span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li><a href="#">Sub item</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple open subnavs</h4>
            <div class="uk-width-1-2@s uk-width-2-5@m">
                <ul class="uk-nav-default" uk-nav="multiple: true">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li class="uk-parent">
                        <a href="#">Parent <span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li>
                                <a href="#">Sub item</a>
                                <ul>
                                    <li><a href="#">Sub item</a></li>
                                    <li><a href="#">Sub item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a href="#">Parent <span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li><a href="#">Sub item</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

HTML;
    }

    /**
     * Navbar component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_navbar(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <nav class="uk-navbar-container" uk-navbar>
                <div class="uk-navbar-left">
            
                    <ul class="uk-navbar-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li>
                            <a href="#">Parent</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Item</a></li>
                    </ul>
            
                </div>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 2</h4>
            <nav class="uk-navbar-container">
                <div class="uk-container">
                    <div uk-navbar>
            
                        <div class="uk-navbar-left">
            
                            <ul class="uk-navbar-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li>
                                    <a href="#">Parent</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-active"><a href="#">Active</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li><a href="#">Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Item</a></li>
                            </ul>
            
                        </div>
            
                    </div>
                </div>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple navigations</h4>
            <nav class="uk-navbar-container">
                <div class="uk-container">
                    <div uk-navbar>
            
                        <div class="uk-navbar-left">
            
                            <ul class="uk-navbar-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li>
                                    <a href="#">Parent</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-active"><a href="#">Active</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li><a href="#">Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Item</a></li>
                            </ul>
            
                        </div>
            
                        <div class="uk-navbar-right">
            
                            <ul class="uk-navbar-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li>
                                    <a href="#">Parent</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-active"><a href="#">Active</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li><a href="#">Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Item</a></li>
                            </ul>
            
                        </div>
            
                    </div>
                </div>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Transparent modifier</h4>
            <div class="uk-position-relative">
                <img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt="">
                <div class="uk-position-top">
                    <nav class="uk-navbar-container uk-navbar-transparent">
                        <div class="uk-container">
                            <div uk-navbar>
            
                                <div class="uk-navbar-left">
                                    <ul class="uk-navbar-nav">
                                        <li class="uk-active"><a href="#">Active</a></li>
                                        <li><a href="#">Item</a></li>
                                        <li>
                                            <a href="#">Parent</a>
                                            <div class="uk-navbar-dropdown">
                                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                                    <li class="uk-active"><a href="#">Active</a></li>
                                                    <li><a href="#">Item</a></li>
                                                    <li class="uk-nav-header">Header</li>
                                                    <li><a href="#">Item</a></li>
                                                    <li><a href="#">Item</a></li>
                                                    <li class="uk-nav-divider"></li>
                                                    <li><a href="#">Item</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
            
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Subtitle</h4>
            <nav class="uk-navbar-container">
                <div class="uk-container">
                    <div uk-navbar>
                            
                        <div class="uk-navbar-left">
            
                            <ul class="uk-navbar-nav">
                                <li class="uk-active">
                                    <a href="#">
                                        <div>
                                            Active
                                            <div class="uk-navbar-subtitle">Subtitle</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>
                                            Parent
                                            <div class="uk-navbar-subtitle">Subtitle</div>
                                        </div>
                                    </a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-active"><a href="#">Active</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li><a href="#">Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>
                                            Item
                                            <div class="uk-navbar-subtitle">Subtitle</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
            
                        </div>
            
                    </div>
                </div>
            </nav>
        </div>

HTML;
    }

    /**
     * Notification component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_notification(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">JavaScript</h4>
            <button class="demo uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Notification message'})">Click me</button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">HTML message</h4>
            <button class="uk-button uk-button-default demo" type="button" onclick="UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message with an icon'})">With icon</button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position</h4>
            <p uk-margin>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Top Left…', pos: 'top-left'})">Top Left</button>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Top Center…', pos: 'top-center'})">Top Center</button>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Top Right…', pos: 'top-right'})">Top Right</button>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Bottom Left…', pos: 'bottom-left'})">Bottom Left</button>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Bottom Center…', pos: 'bottom-center'})">Bottom Center</button>
                <button class="uk-button uk-button-default" type="button" onclick="UIkit.notification({message: 'Bottom Right…', pos: 'bottom-right'})">Bottom Right</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Style</h4>
            <p uk-margin>
                <button class="uk-button uk-button-default demo" type="button" onclick="UIkit.notification({message: 'Primary message…', status: 'primary'})">Primary</button>
                <button class="uk-button uk-button-default demo" type="button" onclick="UIkit.notification({message: 'Success message…', status: 'success'})">Success</button>
                <button class="uk-button uk-button-default demo" type="button" onclick="UIkit.notification({message: 'Warning message…', status: 'warning'})">Warning</button>
                <button class="uk-button uk-button-default demo" type="button" onclick="UIkit.notification({message: 'Danger message…', status: 'danger'})">Danger</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Close all</h4>
            <button class="uk-button uk-button-default close" onclick="UIkit.notification.closeAll()">Close All</button>
        </div>

HTML;
    }

    /**
     * Offcanvas component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_offcanvas(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-usage">Open</button>
            
            <a href="#offcanvas-usage" uk-toggle>Open</a>
            
            <div id="offcanvas-usage" uk-offcanvas>
                <div class="uk-offcanvas-bar">
            
                    <button class="uk-offcanvas-close" type="button" uk-close></button>
            
                    <h3>Title</h3>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Overlay</h4>
            <button class="uk-button uk-button-default" type="button" uk-toggle="target: #offcanvas-overlay">Open</button>
            
            <div id="offcanvas-overlay" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
            
                    <button class="uk-offcanvas-close" type="button" uk-close></button>
            
            
                    <h3>Title</h3>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Flip modifier</h4>
            <button class="uk-button uk-button-default" type="button" uk-toggle="target: #offcanvas-flip">Open</button>
            
            <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
                <div class="uk-offcanvas-bar">
            
                    <button class="uk-offcanvas-close" type="button" uk-close></button>
            
                    <h3>Title</h3>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Overlay component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_overlay(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-inline">
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                <div class="uk-overlay uk-light uk-position-bottom">
                    <p>Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Default</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
            
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay uk-overlay-default uk-position-bottom">
                            <p>Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
            
                </div>
                <div>
            
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay-default uk-position-cover"></div>
                        <div class="uk-overlay uk-position-bottom uk-dark">
                            <p>Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Primary</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
            
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
                            <p>Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
            
                </div>
                <div>
            
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay-primary uk-position-cover"></div>
                        <div class="uk-overlay uk-position-bottom uk-light">
                            <p>Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Overlay icon</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
            
                    <div class="uk-inline uk-light">
                        <img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt="">
                        <div class="uk-position-center">
                            <span uk-overlay-icon></span>
                        </div>
                    </div>
            
                </div>
                <div>
            
                    <div class="uk-inline uk-dark">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay-default uk-position-cover">
                            <div class="uk-position-center">
                                <span uk-overlay-icon></span>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay uk-overlay-default uk-position-top">
                            <p>Top</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-inline">
                        <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                        <div class="uk-overlay uk-overlay-default uk-position-center">
                            <p>Center</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Padding component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_padding(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-padding uk-background-muted uk-width-1-2@s">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>

HTML;
    }

    /**
     * Pagination component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_pagination(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <nav aria-label="Pagination">
                <ul class="uk-pagination" uk-margin>
                    <li><a href="#"><span uk-pagination-previous></span></a></li>
                    <li><a href="#">1</a></li>
                    <li class="uk-disabled"><span>…</span></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="uk-active"><span aria-current="page">7</span></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><a href="#">10</a></li>
                    <li class="uk-disabled"><span>…</span></li>
                    <li><a href="#">20</a></li>
                    <li><a href="#"><span uk-pagination-next></span></a></li>
                </ul>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Alignment</h4>
            <nav aria-label="Pagination">
                <ul class="uk-pagination uk-flex-center" uk-margin>
                    <li><a href="#"><span uk-pagination-previous></span></a></li>
                    <li><a href="#">1</a></li>
                    <li class="uk-disabled"><span>…</span></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="uk-active"><span aria-current="page">7</span></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#"><span uk-pagination-next></span></a></li>
                </ul>
            </nav>
            
            <nav aria-label="Pagination">
                <ul class="uk-pagination uk-flex-right uk-margin-medium-top" uk-margin>
                    <li><a href="#"><span uk-pagination-previous></span></a></li>
                    <li><a href="#">1</a></li>
                    <li class="uk-disabled"><span>…</span></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="uk-active"><span aria-current="page">7</span></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#"><span uk-pagination-next></span></a></li>
                </ul>
            </nav>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Previous and next</h4>
            <nav>
                <ul class="uk-pagination">
                    <li><a href="#"><span class="uk-margin-xsmall-right" uk-pagination-previous></span> Previous</a></li>
                    <li class="uk-margin-auto-left"><a href="#">Next <span class="uk-margin-xsmall-left" uk-pagination-next></span></a></li>
                </ul>
            </nav>
        </div>

HTML;
    }

    /**
     * Parallax component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_parallax(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-height-large uk-background-cover uk-light uk-flex" uk-parallax="bgy: -200" style="background-image: url('https://picsum.photos/1800/1200?blur=2');">
            
                <h1 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">Headline</h1>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Start stop</h4>
            <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex" style="background-image: url('https://picsum.photos/1800/1200?blur=2');">
                <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
                    <h1 uk-parallax="opacity: 0,1; y: -100,0; scale: 2,1; end: 50vh + 50%;">Headline</h1>
                    <p uk-parallax="opacity: 0,1; y: 100,0; scale: 0.5,1; end: 50vh + 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple stops</h4>
            <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex" style="background-image: url('https://picsum.photos/1800/1200?blur=2');">
                <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
                    <h1 uk-parallax="opacity: 0,1,1; y: -100,0,0; x: 100,100,0; scale: 2,1,1; end: 50vh + 50%;">Headline</h1>
                    <p uk-parallax="opacity: 0,1,1; y: 100,0,0; x: -100,-100,0; scale: 0.5,1,1; end: 50vh + 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Stop positions</h4>
            <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex" style="background-image: url('https://picsum.photos/1800/1200?blur=2');">
                <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
                    <h1 uk-parallax="opacity: 0,1,1; y: -100,0,0; x: 100,100,0; scale: 2,1,1; end: 50vh + 50%;">Headline</h1>
                    <p uk-parallax="opacity: 0,1,1; y: 100,0,0; x: -100,-100,0; scale: 0.5,1,1; end: 50vh + 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Nesting</h4>
            <div class="uk-height-large uk-background-cover uk-light uk-flex" uk-parallax="bgy: -200" style="background-image: url('https://picsum.photos/1800/1200?blur=2');">
            
                <h1 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical" uk-parallax="y: 100,0">Headline</h1>
            
            </div>
        </div>

HTML;
    }

    /**
     * Placeholder component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_placeholder(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-placeholder uk-text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
        </div>

HTML;
    }

    /**
     * Position component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_position(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-inline uk-margin">
            
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
            
                <div class="uk-position-top uk-overlay uk-overlay-default uk-text-center">Top</div>
                <div class="uk-position-bottom uk-overlay uk-overlay-default uk-text-center">Bottom</div>
                <div class="uk-position-left uk-overlay uk-overlay-default uk-flex uk-flex-middle">Left</div>
                <div class="uk-position-right uk-overlay uk-overlay-default uk-flex uk-flex-middle">Right</div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">X and Y directions</h4>
            <div class="uk-inline">
            
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
            
                <div class="uk-position-top-left uk-overlay uk-overlay-default">Top Left</div>
                <div class="uk-position-top-center uk-overlay uk-overlay-default">Top Center</div>
                <div class="uk-position-top-right uk-overlay uk-overlay-default">Top Right</div>
                <div class="uk-position-center-left uk-overlay uk-overlay-default">Center Left</div>
                <div class="uk-position-center uk-overlay uk-overlay-default">Center</div>
                <div class="uk-position-center-right uk-overlay uk-overlay-default">Center Right</div>
                <div class="uk-position-bottom-left uk-overlay uk-overlay-default">Bottom Left</div>
                <div class="uk-position-bottom-center uk-overlay uk-overlay-default">Bottom Center</div>
                <div class="uk-position-bottom-right uk-overlay uk-overlay-default">Bottom Right</div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Center</h4>
            <div class="uk-inline">
            
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
            
                <div class="uk-position-center-horizontal uk-overlay uk-overlay-default">Horizontal</div>
                <div class="uk-position-center-vertical uk-overlay uk-overlay-default">Vertical</div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Cover</h4>
            <div class="uk-inline">
            
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
            
                <div class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">Cover</div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Outside</h4>
            <div class="uk-inline">
            
                <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
            
                <div class="uk-position-center-left-out uk-overlay uk-overlay-primary uk-visible@s">Out</div>
                <div class="uk-position-center-right-out uk-overlay uk-overlay-primary uk-visible@s">Out</div>
            
            </div>
        </div>

HTML;
    }

    /**
     * Progress component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_progress(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <progress id="js-progressbar" class="uk-progress" value="10" max="100"></progress>
            
            <script>
            
                UIkit.util.ready(function () {
            
                    var bar = document.getElementById('js-progressbar');
            
                    var animate = setInterval(function () {
            
                        bar.value += 10;
            
                        if (bar.value >= bar.max) {
                            clearInterval(animate);
                        }
            
                    }, 1000);
            
                });
            
            </script>
        </div>

HTML;
    }

    /**
     * Scroll component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_scroll(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <a class="uk-button uk-button-primary" href="#target" uk-scroll>Scroll down</a>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Callback after scroll</h4>
            <a id="js-scroll-trigger" class="uk-button uk-button-primary" href="#target" uk-scroll>Down with callback</a>
            
            <script>
                UIkit.util.on('#js-scroll-trigger', 'scrolled', function () {
                    alert('Done.');
                });
            </script>
        </div>

HTML;
    }

    /**
     * Scrollspy component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_scrollspy(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-1-2@m uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-left; repeat: true">
                        <h3 class="uk-card-title">Left</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-right; repeat: true">
                        <h3 class="uk-card-title">Right</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Groups</h4>
            <div class="uk-child-width-1-3@m" uk-grid uk-scrollspy="cls: uk-animation-fade; target: .uk-card; delay: 500; repeat: true">
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Fade</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Set `cls` option per target</h4>
            <div class="uk-child-width-1-3@m" uk-grid uk-scrollspy="cls: uk-animation-slide-bottom; target: .uk-card; delay: 300; repeat: true">
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Bottom</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" uk-scrollspy-class="uk-animation-slide-top">
                        <h3 class="uk-card-title">Top</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Bottom</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Search component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_search(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <form class="uk-search uk-search-default">
                <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Search icon</h4>
            <div class="uk-margin">
                <form class="uk-search uk-search-default">
                    <span uk-search-icon></span>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            
            <div class="uk-margin">
                <form class="uk-search uk-search-default">
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
                    <span class="uk-search-icon-flip" uk-search-icon></span>
                </form>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Clickable</h4>
            <div class="uk-margin">
                <form class="uk-search uk-search-default">
                    <button uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            
            <div class="uk-margin">
                <form class="uk-search uk-search-default">
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                </form>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Default modifier</h4>
            <form class="uk-search uk-search-default">
                <span uk-search-icon></span>
                <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Navbar modifier</h4>
            <nav class="uk-navbar-container" uk-navbar>
                <div class="uk-navbar-left">
            
                    <div class="uk-navbar-item">
                        <form class="uk-search uk-search-navbar">
                            <span uk-search-icon></span>
                            <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
            
                </div>
            </nav>
        </div>

HTML;
    }

    /**
     * Section component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_section(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-section uk-section-muted">
                <div class="uk-container">
            
                    <h3>Section</h3>
            
                    <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Preserve color</h4>
            <div class="uk-section uk-section-primary uk-preserve-color">
                <div class="uk-container">
            
                    <div class="uk-panel uk-light uk-margin-medium">
                        <h3>Section Primary with cards</h3>
                    </div>
            
                    <div class="uk-grid-match uk-child-width-expand@m" uk-grid>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifier</h4>
            <div class="uk-section uk-section-large uk-section-muted">
                <div class="uk-container">
            
                    <h3>Section Large</h3>
            
                    <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Slidenav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_slidenav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <a href="#" uk-slidenav-previous></a>
            <a href="#" uk-slidenav-next></a>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Large modifier</h4>
            <a href="#" class="uk-slidenav-large" uk-slidenav-previous></a>
            <a href="#" class="uk-slidenav-large" uk-slidenav-next></a>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Slidenav container</h4>
            <div class="uk-slidenav-container">
                <a href="" uk-slidenav-previous></a>
                <a href="" uk-slidenav-next></a>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position as overlay</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            
            </div>
        </div>

HTML;
    }

    /**
     * Slider component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_slider(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Center</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">
            
                <div class="uk-slider-items uk-grid">
                    <div class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="https://picsum.photos/1800/1200?grayscale" width="600" height="400" alt="">
                            <div class="uk-position-center uk-panel"><h1>1</h1></div>
                        </div>
                    </div>
                    <div class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="https://picsum.photos/1800/1200?blur=2" width="600" height="400" alt="">
                            <div class="uk-position-center uk-panel"><h1>2</h1></div>
                        </div>
                    </div>
                    <div class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="https://picsum.photos/1800/1200" width="600" height="400" alt="">
                            <div class="uk-position-center uk-panel"><h1>3</h1></div>
                        </div>
                    </div>
                    <div class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="https://picsum.photos/1800/1200" width="600" height="400" alt="">
                            <div class="uk-position-center uk-panel"><h1>4</h1></div>
                        </div>
                    </div>
                    <div class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="https://picsum.photos/1800/1200?random=3" width="600" height="400" alt="">
                            <div class="uk-position-center uk-panel"><h1>5</h1></div>
                        </div>
                    </div>
                </div>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>
            
            </div>
        </div>

HTML;
    }

    /**
     * Slideshow component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_slideshow(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Ratio</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="ratio: 7:3; animation: push">
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Min/Max height</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="min-height: 300; max-height: 600; animation: push">
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Viewport height</h4>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="ratio: false">
            
                <div class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: 30">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
            
            </div>
        </div>

HTML;
    }

    /**
     * Sortable component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_sortable(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s" uk-sortable="handle: .uk-card" uk-grid>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 1</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 2</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 3</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 4</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 5</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 6</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 7</div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-text-center">Item 8</div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Handle</h4>
            <ul class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s" uk-sortable="handle: .uk-sortable-handle" uk-grid>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 1
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 2
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 3
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 4
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 5
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 6
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 7
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default uk-card-body">
                        <span class="uk-sortable-handle uk-margin-xsmall-right uk-text-center" uk-icon="icon: table"></span>Item 8
                    </div>
                </li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Group</h4>
            <div class="uk-child-width-1-3@s" uk-grid>
                <div>
                    <h4>Group 1</h4>
                    <div uk-sortable="group: sortable-group">
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 1</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 2</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 3</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 4</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h4>Group 2</h4>
                    <div uk-sortable="group: sortable-group">
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 1</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 2</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 3</div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-card uk-card-default uk-card-body uk-card-small">Item 4</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h4>Empty Group</h4>
                    <div uk-sortable="group: sortable-group"></div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Custom class</h4>
            <ul class="uk-nav uk-nav-default uk-width-medium" uk-sortable="cls-custom: uk-box-shadow-small uk-flex uk-flex-middle uk-background">
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
        </div>

HTML;
    }

    /**
     * Spinner component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_spinner(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div uk-spinner></div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Ratio</h4>
            <span class="uk-margin-small-right" uk-spinner="ratio: 3"></span>
            <span uk-spinner="ratio: 4.5"></span>
        </div>

HTML;
    }

    /**
     * Sticky component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_sticky(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-background-muted uk-height-large">
                <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: !.uk-height-large; offset: 80">Stick to the top</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position</h4>
            <div class="uk-background-muted uk-height-large">
                <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="position: bottom; end: !.uk-height-large">Stick to the bottom</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Start</h4>
            <div class="uk-background-muted uk-height-large">
            
                <div class="uk-child-width-1-4@s" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="start: 200; end: !.uk-height-large; offset: 80">200px</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="start: 100%; end: !.uk-height-large; offset: 80">100%</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="start: 20vh; end: !.uk-height-large; offset: 80">20vh</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="start: !.uk-height-large; end: !.uk-height-large + div; offset: 80">Selector</div>
                    </div>
                </div>
            
            </div>
            <div style="height: 200px"></div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">End</h4>
            <div class="uk-background-muted uk-height-large">
            
                <div class="uk-child-width-1-4@s" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: 200; offset: 80">200px</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: 100%; offset: 80">100%</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: 20vh; offset: 80">20vh</div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: !.uk-height-large; offset: 80">Selector</div>
                    </div>
                </div>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Offset</h4>
            <div class="uk-background-muted uk-height-large">
                <div class="uk-card uk-card-default uk-card-body uk-text-center uk-position-z-index" uk-sticky="end: !.uk-height-large; offset: 200">Stick 200px below the top</div>
            </div>
        </div>

HTML;
    }

    /**
     * Subnav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_subnav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-subnav" uk-margin>
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li class="uk-disable"><span>Disabled</span></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <ul class="uk-subnav uk-subnav-divider" uk-margin>
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Pill modifier</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Subnav and Dropdown</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li>
                    <a href>More <span uk-icon="icon: triangle-down"></span></a>
                    <div uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="#">Active</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-header">Header</li>
                            <li><a href="#">Item</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="#">Item</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

HTML;
    }

    /**
     * Svg component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_svg(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <!-- Targets the SVG image -->
            <img src="../assets/uikit/src/images/icons/cloud-download.svg" width="40" height="40" uk-svg>
            
            <!-- Targets a symbol inside the SVG image -->
            <img src="../assets/uikit/tests/images/icons.svg#cloud-upload" width="40" height="40" uk-svg>
        </div>

HTML;
    }

    /**
     * Switcher component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_switcher(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
            
            <div class="uk-switcher uk-margin">
                <div>Hello!</div>
                <div>Hello again!</div>
                <div>Bazinga!</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Navigation controls</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
            <div class="uk-switcher uk-margin">
                <div>Hello! <a href="#" uk-switcher-item="2">Switch to item 3</a></div>
                <div>Hello again! <a href="#" uk-switcher-item="next">Next item</a></div>
                <div>Bazinga! <a href="#" uk-switcher-item="previous">Previous item</a></div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Connect multiple containers</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container">
                <li><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
            
            <h4>Container 1</h4>
            
            <div class="uk-switcher switcher-container uk-margin">
                <div>Hello!</div>
                <div>Hello again!</div>
                <div>Bazinga!</div>
            </div>
            
            <h4>Container 2</h4>
            
            <div class="uk-switcher switcher-container uk-margin">
                <div>Hello! The first item.</div>
                <div>Hello again! The second item.</div>
                <div>Bazinga! The third item.</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Animations</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
            
            <div class="uk-switcher uk-margin">
                <div>Hello!</div>
                <div>Hello again!</div>
                <div>Bazinga!</div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple animations</h4>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
            
            <div class="uk-switcher uk-margin">
                <div>Hello!</div>
                <div>Hello again!</div>
                <div>Bazinga!</div>
            </div>
        </div>

HTML;
    }

    /**
     * Tab component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_tab(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul uk-tab>
                <li class="uk-active"><a href="#">Left</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li class="uk-disabled"><a>Disabled</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Bottom modifier</h4>
            <ul class="uk-tab-bottom" uk-tab>
                <li class="uk-active"><a href="#">Left</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Left/Right modifiers</h4>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <ul class="uk-tab-left" uk-tab>
                        <li class="uk-active"><a href="#">Left</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            
                <div>
                    <ul class="uk-tab-right" uk-tab>
                        <li class="uk-active"><a href="#">Right</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Alignment</h4>
            <div class="uk-margin-medium-top">
                <ul class="uk-flex-center" uk-tab>
                    <li class="uk-active"><a href="#">Center</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
            
            <div>
                <ul class="uk-flex-right" uk-tab>
                    <li class="uk-active"><a href="#">Right</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
            
            <div>
                <ul class="uk-child-width-expand" uk-tab>
                    <li class="uk-active"><a href="#">Justify</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Tabs and Dropdown</h4>
            <ul uk-tab>
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li>
                    <a href>More <span uk-icon="icon: triangle-down"></span></a>
                    <div uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="#">Active</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-header">Header</li>
                            <li><a href="#">Item</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="#">Item</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

HTML;
    }

    /**
     * Table component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_table(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <table class="uk-table">
                <caption>Table Caption</caption>
                <thead>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Table Footer</td>
                        <td>Table Footer</td>
                        <td>Table Footer</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Divider modifier</h4>
            <table class="uk-table uk-table-divider">
                <thead>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Striped modifier</h4>
            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Hover modifier</h4>
            <table class="uk-table uk-table-hover uk-table-divider">
                <thead>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Size modifiers</h4>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                    <tr>
                        <td>Table Data</td>
                        <td>Table Data</td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
            </table>
        </div>

HTML;
    }

    /**
     * Text component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_text(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Text alignment</h4>
            <div class="uk-child-width-1-3@s uk-grid-small" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-left uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-left</code>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-right uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-right</code>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-center uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-center</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Responsive</h4>
            <div class="uk-child-width-1-3@s uk-grid-small" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-center@s uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-center@s</code>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-right@l uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-right@l</code>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small">
                        <div class="uk-text-center@m uk-card-body">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr. <code>.uk-text-center@m</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Vertical alignment</h4>
            <div class="uk-child-width-1-3@m uk-child-width-1-2@s" uk-grid>
                <div>
                    <img src="https://i.pravatar.cc/80" width="50" height="50">
                    <span class="uk-text-top">Lorem ipsum.</span>
                </div>
                <div>
                    <img src="https://i.pravatar.cc/80" width="50" height="50">
                    <span class="uk-text-middle">Lorem ipsum.</span>
                </div>
                <div>
                    <img src="https://i.pravatar.cc/80" width="50" height="50">
                    <span class="uk-text-bottom">Lorem ipsum.</span>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Text wrapping</h4>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="uk-panel uk-text-truncate">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
                <div>
                    <div class="uk-panel uk-text-break">Loremipsumdolorsitamet,consecteturadipiscingelit,seddoeiusmodtemporincididuntutlaboreetdoloremagnaaliqua.</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Text stroke</h4>
            <h1 class="uk-heading-small uk-text-stroke">Small</h1>
            <h1 class="uk-heading-medium uk-text-stroke">Medium</h1>
            <h1 class="uk-heading-large uk-text-stroke">Large</h1>
            <h1 class="uk-heading-xlarge uk-text-stroke">X-Large</h1>
            <h1 class="uk-heading-2xlarge uk-text-stroke">2X-Large</h1>
            <h1 class="uk-heading-3xlarge uk-text-stroke">3X-Large</h1>
        </div>

HTML;
    }

    /**
     * Thumbnav component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_thumbnav(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <ul class="uk-thumbnav" uk-margin>
                <li class="uk-active"><a href="#"><img src="https://picsum.photos/1800/1200?grayscale" width="100" height="67" alt=""></a></li>
                <li><a href="#"><img src="https://picsum.photos/1800/1200?blur=2" width="100" height="67" alt=""></a></li>
                <li><a href="#"><img src="https://picsum.photos/1800/1200" width="100" height="67" alt=""></a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Vertical alignment</h4>
            <ul class="uk-thumbnav uk-thumbnav-vertical" uk-margin>
                <li class="uk-active"><a href="#"><img src="https://picsum.photos/1800/1200?grayscale" width="100" height="67" alt=""></a></li>
                <li><a href="#"><img src="https://picsum.photos/1800/1200?blur=2" width="100" height="67" alt=""></a></li>
                <li><a href="#"><img src="https://picsum.photos/1800/1200" width="100" height="67" alt=""></a></li>
            </ul>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Position as overlay</h4>
            <div class="uk-position-relative" uk-slideshow="animation: fade">
            
                <div class="uk-slideshow-items">
                    <div>
                        <img src="https://picsum.photos/1800/1200?grayscale" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200?blur=2" alt="" uk-cover>
                    </div>
                    <div>
                        <img src="https://picsum.photos/1800/1200" alt="" uk-cover>
                    </div>
                </div>
            
                <div class="uk-position-bottom-center uk-position-small">
                    <ul class="uk-slideshow-nav uk-thumbnav">
                        <li uk-slideshow-item="0"><a href="#"><img src="https://picsum.photos/1800/1200?grayscale" width="100" height="67" alt=""></a></li>
                        <li uk-slideshow-item="1"><a href="#"><img src="https://picsum.photos/1800/1200?blur=2" width="100" height="67" alt=""></a></li>
                        <li uk-slideshow-item="2"><a href="#"><img src="https://picsum.photos/1800/1200" width="100" height="67" alt=""></a></li>
                    </ul>
                </div>
            
            </div>
        </div>

HTML;
    }

    /**
     * Tile component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_tile(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-child-width-1-2@s uk-grid-collapse uk-text-center" uk-grid>
                <div>
                    <div class="uk-tile uk-tile-default">
                        <p class="uk-h4">Default</p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-muted">
                        <p class="uk-h4">Muted</p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-primary">
                        <p class="uk-h4">Primary</p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-secondary">
                        <p class="uk-h4">Secondary</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Preserve color</h4>
            <div class="uk-child-width-1-2@s uk-grid-collapse uk-grid-match uk-text-center" uk-grid>
                <div>
                    <div class="uk-tile uk-tile-primary">
            
                        <div class="uk-panel uk-light uk-margin-medium">
                            <h3>Tile Primary with card</h3>
                        </div>
            
                        <div class="uk-card uk-card-default uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
            
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-secondary">
            
                        <div class="uk-panel uk-light uk-margin-medium">
                            <h3>Tile Secondary with card</h3>
                        </div>
            
                        <div class="uk-card uk-card-default uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Tile and padding</h4>
            <div class="uk-child-width-1-3@s uk-grid-small uk-text-center" uk-grid>
                <div>
                    <div class="uk-tile uk-tile-muted uk-padding-remove">
                        <p class="uk-h4">Remove</p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-primary uk-padding-small">
                        <p class="uk-h4">Small</p>
                    </div>
                </div>
                <div>
                    <div class="uk-tile uk-tile-secondary uk-padding-large">
                        <p class="uk-h4">Large</p>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Toggle component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_toggle(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div>
                <button class="uk-button uk-button-default" type="button" uk-toggle="target: #toggle-usage">Toggle</button>
                <p id="toggle-usage">What's up?</p>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple items</h4>
            <button class="uk-button uk-button-default" type="button" uk-toggle="target: .toggle">Toggle</button>
            <p class="toggle">Hello!</p>
            <p class="toggle" hidden>Bazinga!</p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Custom class</h4>
            <button class="uk-button uk-button-default" type="button" uk-toggle="target: #toggle-custom; cls: uk-card-primary">Toggle</button>
            <div id="toggle-custom" class="uk-card uk-card-default uk-card-body uk-margin-small">Custom class</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Animations</h4>
            <button href="#toggle-animation" class="uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation; animation: uk-animation-fade">Toggle</button>
            <div id="toggle-animation" class="uk-card uk-card-default uk-card-body uk-margin-small">Animation</div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Multiple animations</h4>
            <button class="uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple; animation:  uk-animation-slide-left, uk-animation-slide-bottom">Toggle</button>
            <div id="toggle-animation-multiple" class="uk-card uk-card-default uk-card-body uk-margin-small">Animation</div>
        </div>

HTML;
    }

    /**
     * Tooltip component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_tooltip(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <button class="uk-button uk-button-default" uk-tooltip="Hello World">Hover</button>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Alignment</h4>
            <p uk-margin>
                <button class="uk-button uk-button-default" uk-tooltip="Hello World">Top</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: top-left">Top Left</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: top-right">Top Right</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: bottom">Bottom</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: bottom-left">Bottom Left</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: bottom-right">Bottom Right</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: left">Left</button>
                <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; pos: right">Right</button>
            </p>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Delay</h4>
            <button class="uk-button uk-button-default" uk-tooltip="title: Hello World; delay: 500">Hover</button>
        </div>

HTML;
    }

    /**
     * Totop component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_totop(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <a href="#" uk-totop uk-scroll></a>
        </div>

HTML;
    }

    /**
     * Upload component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_upload(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Select</h4>
            <div class="js-upload" uk-form-custom>
                <input type="file" multiple>
                <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Drop area</h4>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Attach binaries by dropping them here or</span>
                <div uk-form-custom>
                    <input type="file" multiple>
                    <span class="uk-link">selecting one</span>
                </div>
            </div>
            
            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
            
            <script>
            
                var bar = document.getElementById('js-progressbar');
            
                UIkit.upload('.js-upload', {
            
                    url: '',
                    multiple: true,
            
                    beforeSend: function () {
                        console.log('beforeSend', arguments);
                    },
                    beforeAll: function () {
                        console.log('beforeAll', arguments);
                    },
                    load: function () {
                        console.log('load', arguments);
                    },
                    error: function () {
                        console.log('error', arguments);
                    },
                    complete: function () {
                        console.log('complete', arguments);
                    },
            
                    loadStart: function (e) {
                        console.log('loadStart', arguments);
            
                        bar.removeAttribute('hidden');
                        bar.max = e.total;
                        bar.value = e.loaded;
                    },
            
                    progress: function (e) {
                        console.log('progress', arguments);
            
                        bar.max = e.total;
                        bar.value = e.loaded;
                    },
            
                    loadEnd: function (e) {
                        console.log('loadEnd', arguments);
            
                        bar.max = e.total;
                        bar.value = e.loaded;
                    },
            
                    completeAll: function () {
                        console.log('completeAll', arguments);
            
                        setTimeout(function () {
                            bar.setAttribute('hidden', 'hidden');
                        }, 1000);
            
                        alert('Upload Completed');
                    }
            
                });
            
            </script>
        </div>

HTML;
    }

    /**
     * Utility component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_utility(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Panel</h4>
            <div class="uk-child-width-1-3@s" uk-grid>
                <div>
                    <div class="uk-panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
                <div>
                    <div class="uk-panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
                <div>
                    <div class="uk-panel">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Scrollable panel</h4>
            <div class="uk-panel uk-panel-scrollable">
                <ul class="uk-list">
                    <li><label><input class="uk-checkbox" type="checkbox"> Category 1</label></li>
                    <li>
                        <label><input class="uk-checkbox" type="checkbox"> Category 2</label>
                        <ul>
                            <li><label><input class="uk-checkbox" type="checkbox"> Category 2.1</label></li>
                            <li><label><input class="uk-checkbox" type="checkbox"> Category 2.2</label></li>
                            <li>
                                <label><input class="uk-checkbox" type="checkbox"> Category 2.3</label>
                                <ul>
                                    <li><label><input class="uk-checkbox" type="checkbox"> Category 2.3.1</label></li>
                                    <li><label><input class="uk-checkbox" type="checkbox"> Category 2.3.2</label></li>
                                </ul>
                            </li>
                            <li><label><input class="uk-checkbox" type="checkbox"> Category 2.4</label></li>
                        </ul>
                    </li>
                    <li><label><input class="uk-checkbox" type="checkbox"> Category 3</label></li>
                    <li><label><input class="uk-checkbox" type="checkbox"> Category 4</label></li>
                </ul>
            
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Clearing and floating</h4>
            <div class="uk-clearfix">
                <div class="uk-float-right">
                    <div class="uk-card uk-card-default uk-card-body">Right</div>
                </div>
                <div class="uk-float-left">
                    <div class="uk-card uk-card-default uk-card-body">Left</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Overflow</h4>
            <div class="uk-overflow-auto uk-height-small">
                <table class="uk-table uk-table-striped uk-table-condensed uk-text-nowrap">
                    <thead>
                        <tr>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                            <th>Table Heading</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                        </tr>
                        <tr>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                            <td>Table Data</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                            <td>Table Footer</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Overflow Auto</h4>
            <div class="uk-height-medium">
                <div class="js-wrapper">
            
                    <p>Some content before the overflow auto container.</p>
            
                    <div uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-2"><img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt=""></div>
                            <div class="uk-width-1-2"><img src="https://picsum.photos/1800/1200?blur=2" width="1800" height="1200" alt=""></div>
                            <div class="uk-width-1-2"><img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt=""></div>
                            <div class="uk-width-1-2"><img src="https://picsum.photos/1800/1200" width="1800" height="1200" alt=""></div>
                        </div>
                    </div>
            
                    <p>Some content after the overflow auto container.</p>
            
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Video component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_video(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <button class="uk-button uk-button-default uk-margin" type="button" uk-toggle="target: +">Toggle Video</button>
            
            <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="1920" height="1080" playsinline loop muted hidden uk-video></video>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Autoplay</h4>
            <div class="uk-child-width-1-2@m" uk-grid>
                <div>
            
                    <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="1920" height="1080" playsinline loop muted uk-video="autoplay: inview"></video>
            
                </div>
                <div>
            
                    <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="1920" height="1080" playsinline loop muted uk-video="autoplay: hover"></video>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Lazy Loading</h4>
            <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="1920" height="1080" playsinline loop muted preload="none" uk-video></video>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">On-Click Loading</h4>
            <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" poster="https://picsum.photos/1800/1200?grayscale" width="1920" height="1080" controls preload="none" uk-video="autoplay: false"></video>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 5</h4>
            <div class="uk-inline uk-light">
                <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="1920" height="1080" controls preload="none" hidden uk-video></video>
                <a href uk-toggle="target: ! > *">
                    <img src="https://picsum.photos/1800/1200?grayscale" width="1800" height="1200" alt="">
                    <span class="uk-position-center uk-icon-overlay" uk-icon="icon: youtube; ratio: 3"></span>
                </a>
            </div>
        </div>

HTML;
    }

    /**
     * Visibility component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_visibility(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Hidden</h4>
            <div class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ Small</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden@s">Small</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ Medium</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden@m">Medium</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ Large</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden@l">Large</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ X-Large</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden@xl">X-Large</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Visible</h4>
            <div class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove">Small</div>
                        <div class="uk-alert uk-alert-success uk-position-cover uk-margin-remove uk-visible@s">✔ Small</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove">Medium</div>
                        <div class="uk-alert uk-alert-success uk-position-cover uk-margin-remove uk-visible@m">✔ Medium</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove">Large</div>
                        <div class="uk-alert uk-alert-success uk-position-cover uk-margin-remove uk-visible@l">✔ Large</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove">X-Large</div>
                        <div class="uk-alert uk-alert-success uk-position-cover uk-margin-remove uk-visible@xl">✔ X-Large</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Toggle</h4>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div class="uk-visible-toggle" tabindex="-1">
            
                    <h4>Hidden when not hovered</h4>
            
                    <div uk-grid>
                        <div class="uk-width-expand">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                        <div class="uk-width-auto">
                            <ul class="uk-hidden-hover uk-iconnav">
                                <li><a href="#" uk-icon="icon: pencil"></a></li>
                                <li><a href="#" uk-icon="icon: copy"></a></li>
                                <li><a href="#" uk-icon="icon: trash"></a></li>
                            </ul>
                        </div>
                    </div>
            
                </div>
                <div class="uk-visible-toggle" tabindex="-1">
            
                    <h4>Invisible when not hovered</h4>
            
                    <div uk-grid>
                        <div class="uk-width-expand">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                        <div class="uk-width-auto">
                            <ul class="uk-invisible-hover uk-iconnav">
                                <li><a href="#" uk-icon="icon: pencil"></a></li>
                                <li><a href="#" uk-icon="icon: copy"></a></li>
                                <li><a href="#" uk-icon="icon: trash"></a></li>
                            </ul>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Touch</h4>
            <div class="uk-grid-small uk-child-width-1-2 uk-child-width-auto@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ Hidden Touch</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden-touch">Hidden Touch</div>
                    </div>
                </div>
                <div>
                    <div class="uk-panel">
                        <div class="uk-alert uk-margin-remove uk-alert-success">✔ Hidden No-Touch</div>
                        <div class="uk-alert uk-position-cover uk-margin-remove uk-hidden-notouch">Hidden No-Touch</div>
                    </div>
                </div>
            </div>
        </div>

HTML;
    }

    /**
     * Width component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function preview_width(): string
    {
        return <<<'HTML'

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Usage</h4>
            <div class="uk-text-center" uk-grid>
                <div class="uk-width-1-3">
                    <div class="uk-card uk-card-default uk-card-body">1-3</div>
                </div>
                <div class="uk-width-1-3">
                    <div class="uk-card uk-card-default uk-card-body">1-3</div>
                </div>
                <div class="uk-width-1-3">
                    <div class="uk-card uk-card-default uk-card-body">1-3</div>
                </div>
            </div>
            
            <div class="uk-text-center" uk-grid>
                <div class="uk-width-1-2">
                    <div class="uk-card uk-card-default uk-card-body">1-2</div>
                </div>
                <div class="uk-width-1-2">
                    <div class="uk-card uk-card-default uk-card-body">1-2</div>
                </div>
            </div>
            
            <div class="uk-text-center" uk-grid>
                <div class="uk-width-1-4">
                    <div class="uk-card uk-card-default uk-card-body">1-4</div>
                </div>
                <div class="uk-width-3-4">
                    <div class="uk-card uk-card-default uk-card-body">3-4</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Auto and expand</h4>
            <div class="uk-text-center" uk-grid>
                <div class="uk-width-auto">
                    <div class="uk-card uk-card-default uk-card-body">Auto</div>
                </div>
                <div class="uk-width-expand">
                    <div class="uk-card uk-card-default uk-card-body">Expand</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Equal child widths</h4>
            <div class="uk-child-width-1-4 uk-grid-small uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Example 4</h4>
            <div class="uk-child-width-expand uk-grid-small uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">Item</div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-bottom">
            <h4 class="uk-heading-bullet">Fixed width</h4>
            <div class="uk-width-small uk-margin"><div class="uk-card uk-card-small uk-card-default uk-card-body">Small</div></div>
            <div class="uk-width-medium uk-margin"><div class="uk-card uk-card-small uk-card-default uk-card-body">Medium</div></div>
            <div class="uk-width-large uk-margin"><div class="uk-card uk-card-small uk-card-default uk-card-body">Large</div></div>
            <div class="uk-width-xlarge uk-margin"><div class="uk-card uk-card-small uk-card-default uk-card-body">X-Large</div></div>
            <div class="uk-width-2xlarge uk-margin"><div class="uk-card uk-card-small uk-card-default uk-card-body">2X-Large</div></div>
        </div>

HTML;
    }
}
