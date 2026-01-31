<?php

/**
 * PSR-4 Autoloader for Enhanced Plugin Bundle.
 *
 * Maps EPB\ namespaced class names to file paths and automatically loads them.
 *
 * @package Enhanced_Plugin_Bundle
 */

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Class EPB_Autoloader
 *
 * Implements a PSR-4 compatible autoloader for the Enhanced Plugin Bundle.
 */
class EPB_Autoloader
{
    /**
     * Namespace prefix for EPB classes.
     *
     * @var string
     */
    private static string $namespace_prefix = 'EPB\\';

    /**
     * Registers the autoloader with SPL.
     *
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register([self::class, 'autoload']);
    }

    /**
     * Autoloads namespaced EPB classes following PSR-4 conventions.
     *
     * @param string $class_name The fully qualified class name.
     * @return void
     */
    public static function autoload(string $class_name): void
    {
        // Only handle classes in the EPB namespace.
        $prefix_length = strlen(self::$namespace_prefix);

        if (strncmp(self::$namespace_prefix, $class_name, $prefix_length) !== 0) {
            return;
        }

        // Get the relative class name.
        $relative_class = substr($class_name, $prefix_length);

        // Build the file path.
        $file_path = self::get_file_path_for_class($relative_class);

        if (null !== $file_path && is_readable($file_path)) {
            require_once $file_path;
        }
    }

    /**
     * Converts a relative class name to a file path.
     *
     * @param string $relative_class The relative class name (without EPB\ prefix).
     * @return string|null The file path or null if not found.
     */
    private static function get_file_path_for_class(string $relative_class): ?string
    {
        // Split the class name into namespace parts.
        $class_parts = explode('\\', $relative_class);
        $class_name  = array_pop($class_parts);

        // Build the directory path from namespace parts.
        $dir_path = '';
        if (!empty($class_parts)) {
            $dir_path = implode('/', $class_parts) . '/';
        }

        // Convert class name to file name.
        // Examples: "Handler" -> "class-handler.php", "Plugin_Actions" -> "class-plugin-actions.php"
        $file_name = 'class-' . strtolower(str_replace('_', '-', preg_replace(
            '/([a-z])([A-Z])/',
            '$1-$2',
            $class_name
        ))) . '.php';

        // Build the full file path.
        $file_path = EPB_PLUGIN_DIR . 'includes/' . $dir_path . $file_name;

        return is_readable($file_path) ? $file_path : null;
    }
}
