<?php

/**
 * Download UIkit component examples from official documentation.
 * 
 * This script fetches the markdown documentation files from the UIkit GitHub
 * repository and extracts the ```example code blocks to use as component previews.
 * 
 * Usage: php tools/download-uikit-examples.php
 */

// Configuration
$baseUrl = 'https://raw.githubusercontent.com/uikit/uikit-site/develop/docs/pages/';
$outputDir = __DIR__ . '/../docs/uikit-examples/';

// Components to download
$components = [
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
    'container',
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
    'transition',
    'upload',
    'utility',
    'video',
    'visibility',
    'width',
];

// Create output directory
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
    echo "Created output directory: $outputDir\n";
}

/**
 * Extract example blocks from markdown content.
 */
function extractExamples(string $content, string $component): array
{
    $examples = [];

    // Pattern to match ```example blocks
    $pattern = '/```example\s*\n(.*?)```/s';

    if (preg_match_all($pattern, $content, $matches)) {
        foreach ($matches[1] as $index => $example) {
            $examples[] = [
                'index' => $index + 1,
                'html' => trim($example),
            ];
        }
    }

    return $examples;
}

/**
 * Extract section headings before each example.
 */
function extractExamplesWithContext(string $content, string $component): array
{
    $examples = [];

    // Split by example blocks and capture context
    $parts = preg_split('/```example\s*\n/', $content);

    foreach ($parts as $index => $part) {
        if ($index === 0) continue; // Skip content before first example

        // Get the example HTML (up to closing ```)
        if (preg_match('/^(.*?)```/s', $part, $match)) {
            $html = trim($match[1]);

            // Look for the heading before this example in the previous part
            $prevPart = $parts[$index - 1];
            $heading = '';

            // Find the last ## or ### heading
            if (preg_match_all('/^##+ (.+)$/m', $prevPart, $headings)) {
                $heading = end($headings[1]);
            }

            $examples[] = [
                'index' => $index,
                'heading' => trim($heading),
                'html' => $html,
            ];
        }
    }

    return $examples;
}

/**
 * Download a file from URL using cURL.
 */
function downloadFile(string $url): ?string
{
    // Try cURL first
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => 'PHP UIkit Example Downloader',
            CURLOPT_SSL_VERIFYPEER => false, // For Windows compatibility
        ]);

        $content = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($httpCode === 200 && $content !== false) {
            return $content;
        }

        // Debug: show error
        if ($error) {
            echo "(cURL error: $error) ";
        }

        return null;
    }

    // Fallback to file_get_contents
    $context = stream_context_create([
        'http' => [
            'timeout' => 30,
            'user_agent' => 'PHP UIkit Example Downloader',
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);

    $content = @file_get_contents($url, false, $context);

    if ($content === false) {
        return null;
    }

    return $content;
}

/**
 * Generate PHP preview method from examples.
 */
function generatePreviewMethod(string $component, array $examples): string
{
    $methodName = 'preview_' . str_replace('-', '_', $component);
    $label = ucwords(str_replace('-', ' ', $component));

    // Combine examples, limiting to reasonable amount
    $combinedHtml = '';
    $maxExamples = 5; // Limit number of examples per component

    foreach (array_slice($examples, 0, $maxExamples) as $example) {
        $heading = $example['heading'] ?: "Example {$example['index']}";
        $html = $example['html'];

        // Skip very large examples (over 2KB)
        if (strlen($html) > 2048) {
            continue;
        }

        $combinedHtml .= "\n        <div class=\"uk-margin-medium-bottom\">\n";
        $combinedHtml .= "            <h4 class=\"uk-heading-bullet\">" . htmlspecialchars($heading) . "</h4>\n";
        $combinedHtml .= "            " . str_replace("\n", "\n            ", $html) . "\n";
        $combinedHtml .= "        </div>\n";
    }

    if (empty($combinedHtml)) {
        return '';
    }

    // Use heredoc syntax to avoid quote escaping issues
    $php = <<<PHP

    /**
     * {$label} component preview.
     * Auto-generated from UIkit documentation.
     */
    private static function {$methodName}(): string
    {
        return <<<'HTML'
{$combinedHtml}
HTML;
    }
PHP;

    return $php;
}

// Main execution
echo "UIkit Example Downloader\n";
echo "========================\n\n";

$allExamples = [];
$successCount = 0;
$failCount = 0;

foreach ($components as $component) {
    $url = $baseUrl . $component . '.md';
    echo "Downloading: $component.md ... ";

    $content = downloadFile($url);

    if ($content === null) {
        echo "FAILED\n";
        $failCount++;
        continue;
    }

    $examples = extractExamplesWithContext($content, $component);

    if (empty($examples)) {
        echo "No examples found\n";
        continue;
    }

    echo count($examples) . " examples found\n";

    // Save raw markdown
    file_put_contents($outputDir . $component . '.md', $content);

    // Save extracted examples as JSON
    $jsonFile = $outputDir . $component . '-examples.json';
    file_put_contents($jsonFile, json_encode($examples, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    $allExamples[$component] = $examples;
    $successCount++;
}

echo "\n";
echo "Download complete!\n";
echo "- Success: $successCount\n";
echo "- Failed: $failCount\n";
echo "- Output directory: $outputDir\n";

// Generate a summary file
$summaryFile = $outputDir . '_summary.json';
$summary = [];
foreach ($allExamples as $component => $examples) {
    $summary[$component] = [
        'count' => count($examples),
        'headings' => array_column($examples, 'heading'),
    ];
}
file_put_contents($summaryFile, json_encode($summary, JSON_PRETTY_PRINT));

echo "\nSummary saved to: $summaryFile\n";

// Option to generate PHP code
echo "\n";
echo "Generate PHP preview methods? (y/n): ";

// For non-interactive mode, check for --generate flag
if (in_array('--generate', $argv ?? [])) {
    $generatePhp = true;
} else {
    $generatePhp = false;
    // Try to read from stdin if available
    if (defined('STDIN')) {
        $input = trim(fgets(STDIN));
        $generatePhp = strtolower($input) === 'y';
    }
}

if ($generatePhp) {
    $phpOutput = "<?php\n";
    $phpOutput .= "/**\n";
    $phpOutput .= " * Auto-generated UIkit preview methods.\n";
    $phpOutput .= " * Generated from UIkit documentation examples.\n";
    $phpOutput .= " * \n";
    $phpOutput .= " * Copy these methods into class-preview-renderer.php\n";
    $phpOutput .= " */\n\n";
    $phpOutput .= "// Preview methods:\n";

    foreach ($allExamples as $component => $examples) {
        $method = generatePreviewMethod($component, $examples);
        if (!empty($method)) {
            $phpOutput .= $method . "\n";
        }
    }

    $phpFile = $outputDir . '_generated-previews.php';
    file_put_contents($phpFile, $phpOutput);
    echo "PHP methods saved to: $phpFile\n";
}

echo "\nDone!\n";
