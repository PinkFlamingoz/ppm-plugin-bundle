<?php

/**
 * Script to verify @group annotations in UIkit Less files.
 * 
 * The Less files should already contain `// @group: Group Name` annotations.
 * This script validates the structure and reports any variables without groups.
 * 
 * Usage: php add-less-groups.php
 * 
 * @package Enhanced_Plugin_Bundle
 * @since 4.1.0
 */

// Configuration
$less_dir = __DIR__ . '/../docs/uikit-less/';

/**
 * Analyze a Less file for group annotations.
 * 
 * @param string $file_path Path to the Less file.
 * @return array Analysis results.
 */
function analyze_less_file(string $file_path): array
{
    $content = file_get_contents($file_path);
    $lines = explode("\n", $content);

    $groups = [];
    $variables = [];
    $ungrouped = [];
    $current_group = null;
    $in_variables_section = false;
    $found_variables_header = false;

    foreach ($lines as $line_num => $line) {
        // Detect start of Variables section (the header line)
        if (preg_match('/^\/\/\s*Variables\s*$/', $line)) {
            $found_variables_header = true;
            continue;
        }

        // Skip the separator line after Variables header
        if ($found_variables_header && preg_match('/^\/\/\s*={4,}/', $line)) {
            $in_variables_section = true;
            $found_variables_header = false;
            continue;
        }

        // Detect end of Variables section (CSS rules or other comment blocks)
        if ($in_variables_section && preg_match('/^\/\*|^\.uk-|^\s*$/', $line) && preg_match('/^\.uk-/', $line)) {
            $in_variables_section = false;
            continue;
        }

        // Detect group annotation (works both in and out of variables section)
        if (preg_match('/^\/\/\s*@group:\s*(.+)$/i', trim($line), $match)) {
            $current_group = trim($match[1]);
            if (!isset($groups[$current_group])) {
                $groups[$current_group] = 0;
            }
            continue;
        }

        // Detect variable definition (@ at start of line)
        if (preg_match('/^@([a-z0-9-]+)\s*:/', $line, $match)) {
            $var_name = $match[1];

            // Skip internal variables
            if (strpos($var_name, 'internal-') === 0 || strpos($var_name, 'hook-') === 0) {
                continue;
            }

            $variables[] = $var_name;

            if ($current_group) {
                $groups[$current_group]++;
            } else {
                $ungrouped[] = $var_name;
            }
        }
    }

    return [
        'groups' => $groups,
        'variables' => $variables,
        'ungrouped' => $ungrouped,
        'total_vars' => count($variables),
        'grouped_vars' => count($variables) - count($ungrouped),
    ];
}

// Main execution
echo "UIkit Less Group Analyzer\n";
echo "=========================\n\n";

// Get all Less files
$files = glob($less_dir . '*.less');
$total_files = 0;
$total_vars = 0;
$total_grouped = 0;
$files_with_issues = [];

foreach ($files as $file) {
    $component = basename($file, '.less');

    // Skip import file and mixin
    if (strpos($component, '_') === 0 || $component === 'mixin') {
        continue;
    }

    $analysis = analyze_less_file($file);

    if ($analysis['total_vars'] === 0) {
        continue;
    }

    $total_files++;
    $total_vars += $analysis['total_vars'];
    $total_grouped += $analysis['grouped_vars'];

    $groups_count = count($analysis['groups']);
    $ungrouped_count = count($analysis['ungrouped']);

    // Status indicator
    if ($ungrouped_count === 0 && $groups_count > 0) {
        $status = "✓";
    } elseif ($ungrouped_count > 0) {
        $status = "⚠";
        $files_with_issues[$component] = $analysis['ungrouped'];
    } else {
        $status = "○";
    }

    printf("%s %-20s %3d vars, %2d groups", $status, $component . '.less', $analysis['total_vars'], $groups_count);

    if ($ungrouped_count > 0) {
        echo " ($ungrouped_count ungrouped)";
    }

    echo "\n";
}

echo "\n";
echo "Summary\n";
echo "-------\n";
echo "Files analyzed: $total_files\n";
echo "Total variables: $total_vars\n";
if ($total_vars > 0) {
    echo "Grouped variables: $total_grouped (" . round($total_grouped / $total_vars * 100, 1) . "%)\n";
} else {
    echo "Grouped variables: 0 (no variables found)\n";
}

if (!empty($files_with_issues)) {
    echo "\nFiles with ungrouped variables:\n";
    foreach ($files_with_issues as $component => $vars) {
        echo "  - $component.less:\n";
        foreach (array_slice($vars, 0, 5) as $var) {
            echo "      @$var\n";
        }
        if (count($vars) > 5) {
            echo "      ... and " . (count($vars) - 5) . " more\n";
        }
    }
}

echo "\nDone!\n";
