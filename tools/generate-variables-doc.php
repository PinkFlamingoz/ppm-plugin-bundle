<?php

/**
 * Generate Markdown Documentation for UIkit Less Variables
 * 
 * Creates a comprehensive MD document summarizing all consolidated variables
 * across all components, including override information.
 * 
 * Source paths (YOOtheme vendor):
 *   - Components: themes/yootheme/vendor/assets/uikit/src/less/components
 *   - Theme:      themes/yootheme/vendor/assets/uikit/src/less/theme
 *   - Master:     themes/yootheme/vendor/assets/uikit-themes/master
 */

$pluginPath = __DIR__ . '/..';
$wpContentPath = realpath($pluginPath . '/../..');
$yoothemePath = $wpContentPath . '/themes/yootheme/vendor/assets';

// Source directories (YOOtheme)
$sourceDirs = [
    'component' => $yoothemePath . '/uikit/src/less/components',
    'theme' => $yoothemePath . '/uikit/src/less/theme',
    'master/base' => $yoothemePath . '/uikit-themes/master/base',
    'master/typo' => $yoothemePath . '/uikit-themes/master/typo',
    'master/border' => $yoothemePath . '/uikit-themes/master/border',
    'master/border-radius' => $yoothemePath . '/uikit-themes/master/border-radius',
    'master/box-shadow' => $yoothemePath . '/uikit-themes/master/box-shadow',
    'master/background-image' => $yoothemePath . '/uikit-themes/master/background-image',
    'master/transform' => $yoothemePath . '/uikit-themes/master/transform',
];

// Output paths (our plugin docs)
$docsPath = $pluginPath . '/docs';
$consolidatedDir = $docsPath . '/uikit-less-consolidated';
$outputFile = $docsPath . '/UIKIT-VARIABLES.md';

/**
 * Extract variables from a Less file with group info.
 */
function extractVariablesWithGroups(string $filePath): array
{
    if (!file_exists($filePath)) {
        return [];
    }

    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);
    $variables = [];
    $currentGroup = 'General';

    foreach ($lines as $line) {
        // Check for group comment
        if (preg_match('/\/\/\s*@group:\s*(.+)/', $line, $groupMatch)) {
            $currentGroup = trim($groupMatch[1]);
            continue;
        }

        // Check for variable
        if (preg_match('/^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:\s*(.+?)\s*;/', $line, $varMatch)) {
            $varName = $varMatch[1];
            $varValue = trim($varMatch[2]);

            // Extract source layers from comment
            $sources = [];
            if (preg_match('/\/\/\s*\[([^\]]+)\]/', $line, $sourceMatch)) {
                $sources = array_map('trim', explode(',', $sourceMatch[1]));
            }

            $variables[$varName] = [
                'value' => $varValue,
                'group' => $currentGroup,
                'sources' => $sources,
            ];
        }
    }

    return $variables;
}

/**
 * Extract variables from source file (simple).
 */
function extractVariables(string $filePath): array
{
    if (!file_exists($filePath)) {
        return [];
    }

    $content = file_get_contents($filePath);
    $variables = [];

    preg_match_all('/^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:\s*(.+?)\s*;/m', $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $variables[$match[1]] = trim($match[2]);
    }

    return $variables;
}

/**
 * Get list of all consolidated component files.
 */
function getConsolidatedComponents(string $dir): array
{
    $files = glob($dir . '/*.less');
    $components = [];

    foreach ($files as $file) {
        $name = pathinfo($file, PATHINFO_FILENAME);
        if ($name !== '_all-variables') {
            $components[] = $name;
        }
    }

    sort($components);
    return $components;
}

// Start generating markdown
$md = [];
$md[] = "# UIkit Less Variables Reference";
$md[] = "";
$md[] = "> Auto-generated documentation of all UIkit/YOOtheme Less variables.";
$md[] = "> Generated on: " . date('Y-m-d H:i:s');
$md[] = "";

// Get all components
$components = getConsolidatedComponents($consolidatedDir);
$totalVars = 0;
$totalOverrides = 0;
$componentStats = [];

echo "Analyzing components...\n";

foreach ($components as $component) {
    $filename = $component . '.less';
    $consolidatedPath = $consolidatedDir . '/' . $filename;
    $consolidatedVars = extractVariablesWithGroups($consolidatedPath);

    // Collect source variables for override detection
    $sourceVars = [];
    foreach ($sourceDirs as $layer => $dir) {
        $filePath = $dir . '/' . $filename;
        $vars = extractVariables($filePath);
        foreach ($vars as $name => $value) {
            if (!isset($sourceVars[$name])) {
                $sourceVars[$name] = [];
            }
            $sourceVars[$name][$layer] = $value;
        }
    }

    // Count overrides
    $overrides = 0;
    foreach ($sourceVars as $layers) {
        if (count($layers) > 1) {
            $overrides++;
        }
    }

    $componentStats[$component] = [
        'variables' => count($consolidatedVars),
        'overrides' => $overrides,
        'data' => $consolidatedVars,
        'sourceVars' => $sourceVars,
    ];

    $totalVars += count($consolidatedVars);
    $totalOverrides += $overrides;

    echo sprintf("  %-30s : %d variables, %d overrides\n", $component, count($consolidatedVars), $overrides);
}

// Summary section
$md[] = "## Summary";
$md[] = "";
$md[] = "| Metric | Value |";
$md[] = "|--------|-------|";
$md[] = "| Total Components | " . count($components) . " |";
$md[] = "| Total Variables | " . $totalVars . " |";
$md[] = "| Variables with Overrides | " . $totalOverrides . " |";
$md[] = "";

// Layer explanation
$md[] = "## Layer Structure";
$md[] = "";
$md[] = "Variables are consolidated from three layers (in order of precedence):";
$md[] = "";
$md[] = "1. **Component** (`uikit/src/less/components/`) - Base UIkit variables";
$md[] = "2. **Theme** (`uikit/src/less/theme/`) - Theme-level overrides";
$md[] = "3. **Master** (`uikit-themes/master/`) - YOOtheme Pro customizations";
$md[] = "   - `base/` - Core variable overrides";
$md[] = "   - `typo/` - Typography settings";
$md[] = "   - `border/` - Border styles";
$md[] = "   - `border-radius/` - Border radius values";
$md[] = "   - `box-shadow/` - Shadow effects";
$md[] = "   - `background-image/` - Background patterns";
$md[] = "   - `transform/` - CSS transforms";
$md[] = "";

// Table of contents
$md[] = "## Components";
$md[] = "";
$md[] = "| Component | Variables | Overrides |";
$md[] = "|-----------|-----------|-----------|";

foreach ($componentStats as $name => $stats) {
    $md[] = sprintf("| [%s](#%s) | %d | %d |", $name, strtolower($name), $stats['variables'], $stats['overrides']);
}
$md[] = "";

// Detailed component sections
foreach ($componentStats as $component => $stats) {
    $md[] = "---";
    $md[] = "";
    $md[] = "## " . ucfirst($component);
    $md[] = "";
    $md[] = sprintf("**%d variables** (%d with overrides)", $stats['variables'], $stats['overrides']);
    $md[] = "";

    // Group variables by their group
    $byGroup = [];
    foreach ($stats['data'] as $name => $info) {
        $group = $info['group'];
        if (!isset($byGroup[$group])) {
            $byGroup[$group] = [];
        }
        $byGroup[$group][$name] = $info;
    }

    // Sort groups
    ksort($byGroup);

    foreach ($byGroup as $group => $vars) {
        $md[] = "### " . $group;
        $md[] = "";
        $md[] = "| Variable | Value | Sources |";
        $md[] = "|----------|-------|---------|";

        foreach ($vars as $name => $info) {
            // Escape pipes in values
            $value = str_replace('|', '\\|', $info['value']);
            // Truncate long values
            if (strlen($value) > 60) {
                $value = substr($value, 0, 57) . '...';
            }
            // Format value as code
            $value = '`' . $value . '`';

            // Format sources
            $sources = !empty($info['sources']) ? implode(', ', $info['sources']) : 'unknown';

            // Mark overridden variables
            $isOverridden = isset($stats['sourceVars'][$name]) && count($stats['sourceVars'][$name]) > 1;
            $marker = $isOverridden ? ' ⚡' : '';

            $md[] = sprintf("| `%s`%s | %s | %s |", $name, $marker, $value, $sources);
        }
        $md[] = "";
    }
}

// Overrides appendix
$md[] = "---";
$md[] = "";
$md[] = "## Appendix: All Overridden Variables";
$md[] = "";
$md[] = "Variables marked with ⚡ are defined in multiple layers. The table below shows all values:";
$md[] = "";

foreach ($componentStats as $component => $stats) {
    $hasOverrides = false;

    foreach ($stats['sourceVars'] as $name => $layers) {
        if (count($layers) > 1) {
            if (!$hasOverrides) {
                $md[] = "### " . ucfirst($component) . " Overrides";
                $md[] = "";
                $hasOverrides = true;
            }

            $md[] = "**`$name`**";
            $md[] = "";

            foreach ($layers as $layer => $value) {
                // Truncate long values
                if (strlen($value) > 80) {
                    $value = substr($value, 0, 77) . '...';
                }
                $md[] = "- `$layer`: `$value`";
            }

            // Show final consolidated value
            if (isset($stats['data'][$name])) {
                $finalValue = $stats['data'][$name]['value'];
                if (strlen($finalValue) > 80) {
                    $finalValue = substr($finalValue, 0, 77) . '...';
                }
                $md[] = "- **Final**: `$finalValue`";
            }
            $md[] = "";
        }
    }
}

// Write file
$content = implode("\n", $md);
file_put_contents($outputFile, $content);

echo "\n";
echo "=============================================================\n";
echo "  Documentation Generated\n";
echo "=============================================================\n\n";
echo "  Output file: $outputFile\n";
echo "  Components:  " . count($components) . "\n";
echo "  Variables:   $totalVars\n";
echo "  Overrides:   $totalOverrides\n";
echo "\n";
