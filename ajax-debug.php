<?php

/**
 * Simple AJAX Debug - outputs JSON for console
 */

require_once dirname(__FILE__, 4) . '/wp-load.php';

header('Content-Type: application/json');

if (!current_user_can('manage_options')) {
    die(json_encode(['error' => 'Not logged in as admin']));
}

$component = sanitize_key($_GET['component'] ?? 'button');
$steps = [];

try {
    // Step 1: Check Less_Compiler
    $steps[] = ['step' => 1, 'name' => 'Less_Compiler class', 'ok' => class_exists('EPB\\CSS\\Less_Compiler')];

    if (class_exists('EPB\\CSS\\Less_Compiler')) {
        $steps[] = ['step' => 1.1, 'name' => 'Less_Compiler::is_available()', 'ok' => \EPB\CSS\Less_Compiler::is_available()];
    }

    // Step 2: Check Component_Less_Builder
    $steps[] = ['step' => 2, 'name' => 'Component_Less_Builder class', 'ok' => class_exists('EPB\\CSS\\Component_Less_Builder')];

    if (!class_exists('EPB\\CSS\\Component_Less_Builder')) {
        die(json_encode(['steps' => $steps, 'error' => 'Component_Less_Builder not found']));
    }

    // Step 3: Create builder and check requirements
    $builder = new \EPB\CSS\Component_Less_Builder();
    $req = $builder->check_requirements();
    $steps[] = ['step' => 3, 'name' => 'check_requirements()', 'ok' => ($req === true), 'detail' => ($req === true ? 'passed' : $req)];

    if ($req !== true) {
        die(json_encode(['steps' => $steps, 'error' => $req]));
    }

    // Step 4: Get saved values
    $option_key = \EPB\Core\Constants::OPTION_PREFIX . $component;
    $saved = get_option($option_key, []);
    $steps[] = ['step' => 4, 'name' => 'get_option(' . $option_key . ')', 'ok' => true, 'count' => count($saved)];

    // Step 5: Build Less source
    $less = $builder->build_for_preview($component, $saved);
    $steps[] = ['step' => 5, 'name' => 'build_for_preview()', 'ok' => ($less !== false), 'bytes' => ($less ? strlen($less) : 0)];

    if ($less === false) {
        die(json_encode(['steps' => $steps, 'error' => 'build_for_preview returned false']));
    }

    // Step 6: Compile to CSS
    $compiler = new \EPB\CSS\Less_Compiler(['compress' => false]);
    $css = $compiler->compile($less);

    if ($css === false) {
        $err = method_exists($compiler, 'get_error') ? $compiler->get_error() : 'unknown';
        $steps[] = ['step' => 6, 'name' => 'compile()', 'ok' => false, 'error' => $err];
        die(json_encode(['steps' => $steps, 'error' => 'Compile failed: ' . $err]));
    }

    $steps[] = ['step' => 6, 'name' => 'compile()', 'ok' => true, 'bytes' => strlen($css)];

    echo json_encode(['steps' => $steps, 'success' => true, 'css_length' => strlen($css)]);
} catch (Throwable $e) {
    $steps[] = ['step' => 'exception', 'name' => 'Exception', 'ok' => false, 'error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()];
    echo json_encode(['steps' => $steps, 'error' => $e->getMessage()]);
}
