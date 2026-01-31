<?php

/**
 * Merge generated UIkit previews into the Preview_Renderer class.
 *
 * This script replaces the preview methods in class-preview-renderer.php
 * with the auto-generated ones from the official UIkit documentation.
 */

$generatedFile = __DIR__ . '/../docs/uikit-examples/_generated-previews.php';
$targetFile = __DIR__ . '/../includes/Themes/Renderer/class-preview-renderer.php';

if (!file_exists($generatedFile)) {
    echo "Error: Generated previews file not found.\n";
    exit(1);
}

if (!file_exists($targetFile)) {
    echo "Error: Target preview renderer file not found.\n";
    exit(1);
}

// Read generated file
$generatedContent = file_get_contents($generatedFile);

// Extract all preview methods using a simpler approach - find method boundaries
preg_match_all('/\/\*\*[\s\S]*?\*\/\s*private\s+static\s+function\s+(preview_\w+)\(\):\s*string\s*\{[\s\S]*?^    \}/m', $generatedContent, $matches, PREG_SET_ORDER);

echo "Found " . count($matches) . " preview methods in generated file.\n";

// Build array of generated methods
$generatedMethods = [];
foreach ($matches as $match) {
    $fullMethod = $match[0];
    $methodName = $match[1];

    // Extract component name from docblock
    if (preg_match('/\*\s*(\w+(?:\s+\w+)?)\s+component\s+preview/i', $fullMethod, $componentMatch)) {
        $componentName = $componentMatch[1];
    } else {
        $componentName = ucfirst(str_replace('preview_', '', $methodName));
    }

    $generatedMethods[$methodName] = [
        'component' => $componentName,
        'fullMethod' => $fullMethod,
    ];
    echo "  - {$methodName} ({$componentName})\n";
}

// Read target file
$targetContent = file_get_contents($targetFile);

// Extract the list of available previews to update
$componentsList = array_map(function ($m) {
    return str_replace('_', '-', str_replace('preview_', '', $m));
}, array_keys($generatedMethods));

// Update the get_available_previews array
$componentsArrayString = implode(",\n            ", array_map(fn($c) => "'{$c}'", $componentsList));
$newArrayContent = "return [\n            {$componentsArrayString},\n        ];";

// Find and replace the get_available_previews method body
$targetContent = preg_replace(
    '/public\s+static\s+function\s+get_available_previews\(\):\s*array\s*\{\s*return\s*\[[\s\S]*?\];\s*\}/s',
    "public static function get_available_previews(): array\n    {\n        {$newArrayContent}\n    }",
    $targetContent
);

// Find where preview methods start (after preview_default method)
$insertPoint = strpos($targetContent, 'private static function preview_default(');

if ($insertPoint === false) {
    echo "Error: Could not find preview_default method.\n";
    exit(1);
}

// Find end of preview_default method
$braceCount = 0;
$inMethod = false;
$endOfDefaultMethod = $insertPoint;
for ($i = $insertPoint; $i < strlen($targetContent); $i++) {
    if ($targetContent[$i] === '{') {
        $braceCount++;
        $inMethod = true;
    } elseif ($targetContent[$i] === '}') {
        $braceCount--;
        if ($inMethod && $braceCount === 0) {
            $endOfDefaultMethod = $i + 1;
            break;
        }
    }
}

// Get header part (everything before preview methods, including preview_default)
$headerPart = substr($targetContent, 0, $endOfDefaultMethod);

// Build new preview methods from generated content
$newMethods = "\n";
foreach ($generatedMethods as $methodName => $data) {
    $newMethods .= "\n" . $data['fullMethod'] . "\n";
}

// Close the class
$newContent = $headerPart . $newMethods . "}\n";

// Write to new file first for safety
$outputFile = __DIR__ . '/../includes/Themes/Renderer/class-preview-renderer-new.php';
file_put_contents($outputFile, $newContent);

echo "\nMerge complete! Output written to: class-preview-renderer-new.php\n";
echo "Total methods: " . count($generatedMethods) . "\n";
echo "\nReview the file and rename it to class-preview-renderer.php when ready.\n";
