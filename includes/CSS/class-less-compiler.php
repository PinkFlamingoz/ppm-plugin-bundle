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
     * Preprocessed Less source (after all transformations, before parsing).
     * Stored for debugging when compilation fails.
     *
     * @var string
     */
    private string $preprocessed_source = '';

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

                // Check if // is part of a URL scheme like https:// or http://.
                // Look for : immediately before the //.
                $is_url_scheme = $comment_pos > 0 && substr($line, $comment_pos - 1, 1) === ':';

                if (!$in_string && !$in_url && !$is_url_scheme) {
                    // Safe to convert this // comment.
                    $comment_text = substr($line, $comment_pos + 2);
                    $line = substr($line, 0, $comment_pos) . '/*' . $comment_text . ' */';
                }
            }

            $result[] = $line;
        }

        $less_content = implode("\n", $result);

        // Escape modern CSS pseudo-classes that less.php doesn't support.
        // Convert :is(...) to ~":is(...)" so Less passes it through as raw CSS.
        // Also handle :where(), :has() which are also modern CSS selectors.
        // Use a function to handle nested parentheses properly.
        $less_content = $this->escape_modern_pseudo_classes($less_content);

        // Escape color function calls that contain CSS var() references.
        // Less tries to evaluate rgba(), hsla() etc. as Less functions, but
        // var(--custom-prop) is not a number — it must be passed through as raw CSS.
        $less_content = $this->escape_color_functions_with_vars($less_content);

        // Expand 2-argument rgba(color, alpha) calls to 4-argument form.
        // wikimedia/less.php only handles rgba(r, g, b, a) with numeric args,
        // but UIkit uses the CSS4 shorthand rgba(@color-var, alpha).
        $less_content = $this->expand_rgba_shorthand($less_content);

        // Extract CSS @property blocks that less.php cannot parse.
        // They will be re-injected into the compiled CSS output.
        $less_content = $this->extract_at_property_blocks($less_content);

        return $less_content;
    }

    /**
     * Stored @property blocks extracted during preprocessing.
     *
     * @var string[]
     */
    private array $extracted_at_property_blocks = [];

    /**
     * Escape modern CSS pseudo-classes that less.php doesn't support.
     *
     * Less.php has issues with :is()/:where()/:has() when they contain both
     * commas AND nested pseudo-classes like :not(). We work around this by
     * converting such selectors to use variable interpolation.
     *
     * @param string $content The Less content.
     * @return string The content with escaped pseudo-classes.
     */
    private function escape_modern_pseudo_classes(string $content): string
    {
        // Match rule sets that have problematic :is()/:where()/:has() selectors.
        // Pattern: selector with :is/where/has containing comma AND nested pseudo-class.
        $lines = explode("\n", $content);
        $result = [];
        $counter = 0;

        foreach ($lines as $line) {
            // Check if line has a problematic pattern: :is/where/has with comma AND :not/:where/:has/:is
            if (preg_match('/:(?:is|where|has)\([^)]*,.*:(?:not|is|where|has)\(/', $line)) {
                // This line has the problematic pattern.
                // Find the selector part (before the {) and escape it.
                if (preg_match('/^([^{]+)\{(.*)$/', $line, $match)) {
                    $selector = trim($match[1]);
                    $rest = $match[2];

                    // Generate a unique variable name.
                    $var_name = '__escaped_selector_' . $counter++;

                    // Create the escaped variable definition and usage.
                    $result[] = '@' . $var_name . ': ~"' . addslashes($selector) . '";';
                    $result[] = '@{' . $var_name . '} {' . $rest;
                } else {
                    // No { found, just keep the line.
                    $result[] = $line;
                }
            } else {
                $result[] = $line;
            }
        }

        return implode("\n", $result);
    }

    /**
     * Escape CSS color function calls that contain var() references.
     *
     * Less evaluates rgba(), hsla(), rgb(), hsl() as built-in functions and
     * expects numeric arguments. When these calls contain CSS custom property
     * references like var(--name), the evaluation fails. This method wraps
     * such calls in Less escape syntax ~"..." so they pass through as raw CSS.
     *
     * Handles: rgba(), hsla(), rgb(), hsl()
     *
     * @param string $content The Less content.
     * @return string The content with var()-containing color functions escaped.
     */
    private function escape_color_functions_with_vars(string $content): string
    {
        // Match color function names that Less tries to evaluate.
        $functions = ['rgba', 'hsla', 'rgb', 'hsl'];

        foreach ($functions as $func_name) {
            $search = $func_name . '(';
            $offset = 0;

            while (($pos = strpos($content, $search, $offset)) !== false) {
                $inner_start = $pos + strlen($search);

                // Find the matching closing parenthesis.
                $close_pos = $this->find_matching_paren($content, $inner_start);
                if ($close_pos === false) {
                    $offset = $inner_start;
                    continue;
                }

                // Extract the full function call contents.
                $inner = substr($content, $inner_start, $close_pos - $inner_start);

                // Check if the arguments contain var(.
                if (stripos($inner, 'var(') !== false) {
                    // Wrap the entire function call in ~"..." to escape from Less evaluation.
                    $full_call = substr($content, $pos, $close_pos + 1 - $pos);
                    $escaped = '~"' . $full_call . '"';
                    $content = substr_replace($content, $escaped, $pos, $close_pos + 1 - $pos);
                    $offset = $pos + strlen($escaped);
                } else {
                    $offset = $close_pos + 1;
                }
            }
        }

        return $content;
    }

    /**
     * Find the position of the matching closing parenthesis.
     *
     * @param string $content The source string.
     * @param int    $start   Position right after the opening '('.
     * @return int|false Position of the matching ')', or false if not found.
     */
    private function find_matching_paren(string $content, int $start): int|false
    {
        $len = strlen($content);
        $depth = 0;

        for ($i = $start; $i < $len; $i++) {
            $ch = $content[$i];
            if ($ch === '(') {
                $depth++;
            } elseif ($ch === ')') {
                if ($depth === 0) {
                    return $i;
                }
                $depth--;
            }
        }

        return false;
    }

    /**
     * Expand CSS4 2-argument rgba(color, alpha) to 4-argument form.
     *
     * wikimedia/less.php's built-in rgba() only accepts four numeric parameters
     * (r, g, b, a). CSS4 and JavaScript Less allow a shorthand with two
     * arguments: rgba(@color, alpha). This method rewrites those calls so the
     * PHP Less compiler can process them:
     *
     *   rgba(EXPR, alpha)  →  rgba(red(EXPR), green(EXPR), blue(EXPR), alpha)
     *
     * Only top-level 2-argument calls are rewritten (nested parens are tracked
     * to avoid false positives).
     *
     * @param string $content The Less content.
     * @return string The content with expanded rgba() calls.
     */
    private function expand_rgba_shorthand(string $content): string
    {
        $search = 'rgba(';
        $offset = 0;

        while (($pos = strpos($content, $search, $offset)) !== false) {
            $inner_start = $pos + strlen($search);

            // Find the matching closing parenthesis and split top-level args.
            $args = $this->split_function_args($content, $inner_start, $close_pos);
            if ($args === false || $close_pos === false) {
                // Malformed — skip past this occurrence.
                $offset = $inner_start;
                continue;
            }

            // Only rewrite when there are exactly 2 top-level arguments.
            if (count($args) === 2) {
                $color_expr = trim($args[0]);
                $alpha_expr = trim($args[1]);

                // Build the expanded call.
                $expanded = sprintf(
                    'rgba(red(%s), green(%s), blue(%s), %s)',
                    $color_expr,
                    $color_expr,
                    $color_expr,
                    $alpha_expr
                );

                // Replace the original rgba(...) substring.
                $original_len = $close_pos + 1 - $pos; // includes 'rgba(' … ')'
                $content = substr_replace($content, $expanded, $pos, $original_len);

                // Advance past the replacement to avoid re-processing.
                $offset = $pos + strlen($expanded);
            } else {
                // 1, 3, or 4+ args — leave as-is.
                $offset = $close_pos + 1;
            }
        }

        return $content;
    }

    /**
     * Split function arguments respecting nested parentheses.
     *
     * Starting right after the opening '(' of a function call, this walks the
     * source to find the matching ')' while tracking nesting depth.  It splits
     * on commas that are at nesting depth 0 (top-level arguments).
     *
     * @param string   $content   The full Less source.
     * @param int      $start     Position right after the opening '('.
     * @param int|null &$close_pos Set to the position of the matching ')'.
     * @return string[]|false      Array of argument strings, or false on error.
     */
    private function split_function_args(string $content, int $start, ?int &$close_pos): array|false
    {
        $len   = strlen($content);
        $depth = 0;
        $args  = [];
        $arg_start = $start;
        $close_pos = null;

        for ($i = $start; $i < $len; $i++) {
            $ch = $content[$i];

            if ($ch === '(') {
                $depth++;
            } elseif ($ch === ')') {
                if ($depth === 0) {
                    // Matching close paren found.
                    $args[] = substr($content, $arg_start, $i - $arg_start);
                    $close_pos = $i;
                    return $args;
                }
                $depth--;
            } elseif ($ch === ',' && $depth === 0) {
                $args[] = substr($content, $arg_start, $i - $arg_start);
                $arg_start = $i + 1;
            }
        }

        // Never found the matching ')'.
        return false;
    }

    /**
     * Extract CSS @property blocks that less.php cannot parse.
     *
     * CSS @property at-rules (e.g. @property --uk-overflow-fade-start-opacity)
     * are valid CSS but not understood by the Less parser. This method strips
     * them from the input and stores them so they can be appended to the
     * compiled CSS output.
     *
     * @param string $content The Less content.
     * @return string The content with @property blocks removed.
     */
    private function extract_at_property_blocks(string $content): string
    {
        $this->extracted_at_property_blocks = [];

        // Match @property --name { ... } blocks.
        $content = preg_replace_callback(
            '/@property\s+--[a-zA-Z0-9_-]+\s*\{[^}]*\}/s',
            function ($match) {
                $this->extracted_at_property_blocks[] = $match[0];
                return '/* @property block extracted */';
            },
            $content
        );

        return $content;
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

            // Store preprocessed source for debugging.
            $this->preprocessed_source = $less_content;

            // Modify variables if provided.
            if (!empty($variables)) {
                $parser->ModifyVars($variables);
            }

            // Parse the Less content.
            $parser->parse($less_content);

            // Get the compiled CSS.
            $css = $parser->getCss();

            // Re-inject any @property blocks that were extracted during preprocessing.
            if (!empty($this->extracted_at_property_blocks)) {
                $css .= "\n" . implode("\n", $this->extracted_at_property_blocks) . "\n";
            }

            return $css;
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
     * Get the preprocessed Less source from the last compilation attempt.
     *
     * Useful for debugging: the error index in Less parse errors refers to
     * this string (the source after all preprocessing transformations).
     *
     * @return string
     */
    public function get_preprocessed_source(): string
    {
        return $this->preprocessed_source;
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
