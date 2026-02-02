<?php

/**
 * Less Compiler Service.
 *
 * Wraps the wikimedia/less.php library for server-side Less compilation.
 * Handles import paths and provides error handling.
 *
 * @package Enhanced_Plugin_Bundle
 * @since 4.2.0
 */

namespace EPB\CSS;

use Exception;

/**
 * Less Compiler class.
 */
class Less_Compiler
{

    /**
     * The Less parser instance.
     *
     * @var \Less_Parser|null
     */
    private $parser = null;

    /**
     * Import paths for Less files.
     *
     * @var array
     */
    private array $import_paths = [];

    /**
     * Compilation options.
     *
     * @var array
     */
    private array $options = [];

    /**
     * Last error message.
     *
     * @var string
     */
    private string $last_error = '';

    /**
     * Constructor.
     *
     * @param array $options Optional. Less compiler options.
     */
    public function __construct(array $options = [])
    {
        $default_options = [
            'compress'        => false,
            'sourceMap'       => false,
            'cache_dir'       => WP_CONTENT_DIR . '/cache/less/',
            'cache_method'    => 'serialize',
            'math'            => 'always',
            'import_callback' => null,
        ];

        $this->options = array_merge($default_options, $options);
        $this->setup_import_paths();
    }

    /**
     * Set up default import paths.
     */
    private function setup_import_paths(): void
    {
        // YOOtheme UIkit source path.
        $uikit_path = WP_CONTENT_DIR . '/themes/yootheme/vendor/assets/uikit/src/less/';
        if (is_dir($uikit_path)) {
            $this->add_import_path($uikit_path);
            $this->add_import_path($uikit_path . 'components/');
        }

        // YOOtheme theme Less path.
        $yootheme_less = WP_CONTENT_DIR . '/themes/yootheme/less/';
        if (is_dir($yootheme_less)) {
            $this->add_import_path($yootheme_less);
        }

        // Our plugin's consolidated Less files.
        $plugin_less = EPB_PLUGIN_DIR . 'docs/uikit-less-consolidated/';
        if (is_dir($plugin_less)) {
            $this->add_import_path($plugin_less);
        }
    }

    /**
     * Add an import path.
     *
     * @param string $path The path to add.
     * @return self
     */
    public function add_import_path(string $path): self
    {
        $path = rtrim($path, '/\\') . '/';
        if (is_dir($path) && !in_array($path, $this->import_paths, true)) {
            $this->import_paths[] = $path;
        }
        return $this;
    }

    /**
     * Get the parser instance, creating it if needed.
     *
     * @return \Less_Parser
     * @throws Exception If Less_Parser class is not available.
     */
    private function get_parser(): \Less_Parser
    {
        if ($this->parser !== null) {
            return $this->parser;
        }

        // Check if the Less_Parser class exists.
        if (!class_exists('Less_Parser')) {
            // Try to load from composer autoload first.
            $autoload = EPB_PLUGIN_DIR . 'vendor/autoload.php';
            if (file_exists($autoload)) {
                require_once $autoload;
            }

            // If still not loaded, try the manual installation.
            if (!class_exists('Less_Parser')) {
                $lessc_file = EPB_PLUGIN_DIR . 'vendor/wikimedia/less.php/lessc.inc.php';
                if (file_exists($lessc_file)) {
                    require_once $lessc_file;
                }
            }

            if (!class_exists('Less_Parser')) {
                throw new Exception('Less_Parser class not found. Please run: composer install');
            }
        }

        // Create cache directory if it doesn't exist.
        if (!empty($this->options['cache_dir']) && !is_dir($this->options['cache_dir'])) {
            wp_mkdir_p($this->options['cache_dir']);
        }

        $this->parser = new \Less_Parser($this->options);

        // Set import directories.
        $import_dirs = [];
        foreach ($this->import_paths as $path) {
            $import_dirs[$path] = '';
        }
        $this->parser->SetImportDirs($import_dirs);

        return $this->parser;
    }

    /**
     * Reset the parser for a fresh compilation.
     *
     * @return self
     */
    public function reset(): self
    {
        $this->parser = null;
        $this->last_error = '';
        return $this;
    }

    /**
     * Preprocess Less content to handle compatibility issues.
     *
     * - Strips BOM (Byte Order Mark) characters
     * - Converts // single-line comments to block comments since
     *   wikimedia/less.php doesn't support // comments at the top level.
     *
     * @param string $less_content The raw Less content.
     * @return string The preprocessed Less content.
     */
    private function preprocess(string $less_content): string
    {
        // Remove BOM characters (UTF-8 BOM is 0xEF 0xBB 0xBF, or \xEF\xBB\xBF).
        $less_content = preg_replace('/\x{FEFF}/u', '', $less_content);
        // Also handle the raw bytes version.
        $less_content = str_replace("\xEF\xBB\xBF", '', $less_content);

        // Convert // comments to /* */ block comments.
        // Match // at start of line or after whitespace, but not inside strings or URLs.
        $lines = explode("\n", $less_content);
        $result = [];

        foreach ($lines as $line) {
            // Check if the line has a // comment.
            // We need to be careful not to replace // inside URLs or strings.
            $comment_pos = strpos($line, '//');

            if ($comment_pos !== false) {
                // Check if it's inside a string or url().
                $before_comment = substr($line, 0, $comment_pos);

                // Count quotes to see if we're inside a string.
                $single_quotes = substr_count($before_comment, "'") - substr_count($before_comment, "\\'");
                $double_quotes = substr_count($before_comment, '"') - substr_count($before_comment, '\\"');

                // If even number of quotes, we're not inside a string.
                $in_string = ($single_quotes % 2 !== 0) || ($double_quotes % 2 !== 0);

                // Check for url() - simplified check.
                $in_url = preg_match('/url\([^)]*$/', $before_comment);

                if (!$in_string && !$in_url) {
                    // Safe to convert this // comment.
                    $comment_text = substr($line, $comment_pos + 2);
                    $line = substr($line, 0, $comment_pos) . '/*' . $comment_text . ' */';
                }
            }

            $result[] = $line;
        }

        return implode("\n", $result);
    }

    /**
     * Compile Less content to CSS.
     *
     * @param string $less_content The Less content to compile.
     * @param array  $variables    Optional. Variable overrides.
     * @return string|false The compiled CSS, or false on failure.
     */
    public function compile(string $less_content, array $variables = [])
    {
        $this->reset();

        try {
            $parser = $this->get_parser();

            // Preprocess to handle // comments.
            $less_content = $this->preprocess($less_content);

            // Modify variables if provided.
            if (!empty($variables)) {
                $parser->ModifyVars($variables);
            }

            // Parse the Less content.
            $parser->parse($less_content);

            // Get the compiled CSS.
            return $parser->getCss();
        } catch (\Less_Exception_Parser $e) {
            $this->last_error = 'Less Parse Error: ' . $e->getMessage();
            return false;
        } catch (Exception $e) {
            $this->last_error = 'Compilation Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Compile a Less file to CSS.
     *
     * @param string $file_path  The path to the Less file.
     * @param array  $variables  Optional. Variable overrides.
     * @return string|false The compiled CSS, or false on failure.
     */
    public function compile_file(string $file_path, array $variables = [])
    {
        $this->reset();

        if (!file_exists($file_path)) {
            $this->last_error = 'File not found: ' . $file_path;
            return false;
        }

        try {
            $parser = $this->get_parser();

            // Modify variables if provided.
            if (!empty($variables)) {
                $parser->ModifyVars($variables);
            }

            // Parse the file.
            $parser->parseFile($file_path);

            // Get the compiled CSS.
            return $parser->getCss();
        } catch (\Less_Exception_Parser $e) {
            $this->last_error = 'Less Parse Error: ' . $e->getMessage();
            return false;
        } catch (Exception $e) {
            $this->last_error = 'Compilation Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Get the last error message.
     *
     * @return string
     */
    public function get_error(): string
    {
        return $this->last_error;
    }

    /**
     * Check if Less_Parser is available.
     *
     * @return bool
     */
    public static function is_available(): bool
    {
        if (class_exists('Less_Parser')) {
            return true;
        }

        // Try to load from composer autoload.
        $autoload = EPB_PLUGIN_DIR . 'vendor/autoload.php';
        if (file_exists($autoload)) {
            require_once $autoload;
            if (class_exists('Less_Parser')) {
                return true;
            }
        }

        // Try to load from manual installation.
        $lessc_file = EPB_PLUGIN_DIR . 'vendor/wikimedia/less.php/lessc.inc.php';
        if (file_exists($lessc_file)) {
            require_once $lessc_file;
            return class_exists('Less_Parser');
        }

        return false;
    }
}
