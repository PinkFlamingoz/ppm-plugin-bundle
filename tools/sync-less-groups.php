<?php

/**
 * Sync @group annotations from consolidated files to YOOtheme source files.
 * 
 * When UIkit updates, run this script to:
 * 1. Extract your existing @group annotations from consolidated files
 * 2. Apply them to YOOtheme's source files
 * 
 * Usage: 
 *   php sync-less-groups.php                    # Dry run - shows what would change
 *   php sync-less-groups.php --apply            # Apply changes to source files
 *   php sync-less-groups.php --component=button # Process single component
 * 
 * Workflow after UIkit/YOOtheme update:
 *   1. Update YOOtheme (UIkit files will be fresh)
 *   2. Run: php sync-less-groups.php --apply
 *   3. Run: powershell consolidate-less-variables.ps1
 *   4. Run: php generate-variables-doc.php
 * 
 * @package Enhanced_Plugin_Bundle
 * @since 4.1.0
 */

$pluginPath = __DIR__ . '/..';
$wpContentPath = realpath($pluginPath . '/../..');
$yoothemePath = $wpContentPath . '/themes/yootheme/vendor/assets';
$docsPath = $pluginPath . '/docs';

// Source of truth for groups (your existing consolidated files with group annotations)
$consolidatedPath = $docsPath . '/uikit-less-consolidated';

// Target directories to update (YOOtheme source files)
$targetDirs = [
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

// Parse arguments
$applyChanges = in_array('--apply', $argv);
$singleComponent = null;
foreach ($argv as $arg) {
    if (strpos($arg, '--component=') === 0) {
        $singleComponent = substr($arg, strlen('--component='));
    }
}

/**
 * Extract variable-to-group mapping from a consolidated file.
 */
function extractGroupMapping(string $filePath): array
{
    if (!file_exists($filePath)) {
        return [];
    }

    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);
    $mapping = [];
    $currentGroup = 'Base';

    foreach ($lines as $line) {
        // Check for group comment
        if (preg_match('/\/\/\s*@group:\s*(.+)/', $line, $match)) {
            $currentGroup = trim($match[1]);
            continue;
        }

        // Check for variable
        if (preg_match('/^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:/', $line, $match)) {
            $varName = $match[1];
            $mapping[$varName] = $currentGroup;
        }
    }

    return $mapping;
}

/**
 * Add @group annotations to a Less file based on mapping.
 */
function addGroupsToFile(string $filePath, array $groupMapping, bool $apply): array
{
    if (!file_exists($filePath)) {
        return ['status' => 'skip', 'reason' => 'File not found'];
    }

    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);
    $newLines = [];
    $changes = [];
    $currentGroup = null;
    $lastGroup = null;
    $inVariablesSection = false;

    foreach ($lines as $i => $line) {
        // Detect Variables section
        if (preg_match('/^\/\/\s*Variables\s*$/', $line)) {
            $newLines[] = $line;
            $inVariablesSection = true;
            continue;
        }

        // Skip existing group comments (we'll add new ones)
        if (preg_match('/^\/\/\s*@group:\s*/', $line)) {
            continue;
        }

        // Check for variable definition
        if (preg_match('/^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:/', $line, $match)) {
            $varName = $match[1];

            // Get group for this variable
            $group = $groupMapping[$varName] ?? null;

            if ($group && $group !== $lastGroup) {
                // Add group comment before this variable
                if ($lastGroup !== null) {
                    $newLines[] = ''; // Blank line between groups
                }
                $newLines[] = "// @group: {$group}";
                $changes[] = "Added group '{$group}' before {$varName}";
                $lastGroup = $group;
            }
        }

        $newLines[] = $line;
    }

    if (empty($changes)) {
        return ['status' => 'unchanged', 'changes' => []];
    }

    if ($apply) {
        file_put_contents($filePath, implode("\n", $newLines));
        return ['status' => 'updated', 'changes' => $changes];
    }

    return ['status' => 'pending', 'changes' => $changes];
}

// Main execution
echo "=============================================================\n";
echo "  UIkit Less Group Sync Tool\n";
echo "=============================================================\n\n";

if (!$applyChanges) {
    echo "  Mode: DRY RUN (use --apply to make changes)\n\n";
} else {
    echo "  Mode: APPLYING CHANGES\n\n";
}

// Get list of consolidated files
$consolidatedFiles = glob($consolidatedPath . '/*.less');
$totalFiles = 0;
$totalChanges = 0;

foreach ($consolidatedFiles as $consolidatedFile) {
    $componentName = pathinfo($consolidatedFile, PATHINFO_FILENAME);

    // Skip _all-variables.less
    if ($componentName === '_all-variables') {
        continue;
    }

    // Filter by component if specified
    if ($singleComponent && $componentName !== $singleComponent) {
        continue;
    }

    $filename = $componentName . '.less';

    // Extract group mapping from consolidated file
    $groupMapping = extractGroupMapping($consolidatedFile);

    if (empty($groupMapping)) {
        continue;
    }

    $hasChanges = false;

    // Process each target directory
    foreach ($targetDirs as $layer => $dir) {
        $targetFile = $dir . '/' . $filename;

        if (!file_exists($targetFile)) {
            continue;
        }

        $result = addGroupsToFile($targetFile, $groupMapping, $applyChanges);

        if ($result['status'] !== 'unchanged' && !empty($result['changes'])) {
            if (!$hasChanges) {
                echo "  {$componentName}.less:\n";
                $hasChanges = true;
                $totalFiles++;
            }

            echo "    [{$layer}] " . count($result['changes']) . " groups\n";
            $totalChanges += count($result['changes']);
        }
    }
}

echo "\n";
echo "=============================================================\n";
echo "  Summary\n";
echo "=============================================================\n\n";
echo "  Files processed:  {$totalFiles}\n";
echo "  Groups added:     {$totalChanges}\n";

if (!$applyChanges && $totalChanges > 0) {
    echo "\n  Run with --apply to make changes.\n";
}

echo "\n";
