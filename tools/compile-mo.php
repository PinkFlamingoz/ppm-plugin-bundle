<?php

/**
 * PO to MO Compiler
 *
 * Converts .po translation files to binary .mo files.
 * Usage: php tools/compile-mo.php
 *
 * @package Enhanced_Plugin_Bundle
 */

$languages_dir = __DIR__ . '/../languages';

// Find all .po files
$po_files = glob($languages_dir . '/*.po');

if (empty($po_files)) {
    echo "No .po files found in {$languages_dir}\n";
    exit(1);
}

foreach ($po_files as $po_file) {
    $mo_file = preg_replace('/\.po$/', '.mo', $po_file);

    echo "Compiling: " . basename($po_file) . " -> " . basename($mo_file) . "\n";

    $result = compile_po_to_mo($po_file, $mo_file);

    if ($result) {
        echo "  ✓ Success\n";
    } else {
        echo "  ✗ Failed\n";
    }
}

echo "\nDone!\n";

/**
 * Compile a .po file to .mo format.
 *
 * @param string $po_file Path to .po file.
 * @param string $mo_file Path to output .mo file.
 * @return bool Success status.
 */
function compile_po_to_mo(string $po_file, string $mo_file): bool
{
    $entries = parse_po_file($po_file);

    if (empty($entries)) {
        return false;
    }

    return write_mo_file($entries, $mo_file);
}

/**
 * Parse a .po file into an array of translations.
 *
 * @param string $po_file Path to .po file.
 * @return array Array of msgid => msgstr pairs.
 */
function parse_po_file(string $po_file): array
{
    $content = file_get_contents($po_file);

    if ($content === false) {
        return [];
    }

    $entries = [];
    $current_msgid = null;
    $current_msgstr = null;
    $in_msgid = false;
    $in_msgstr = false;

    $lines = explode("\n", $content);

    foreach ($lines as $line) {
        $line = trim($line);

        // Skip comments and empty lines
        if ($line === '' || $line[0] === '#') {
            // Save previous entry if exists
            if ($current_msgid !== null && $current_msgstr !== null) {
                $entries[$current_msgid] = $current_msgstr;
            }
            $current_msgid = null;
            $current_msgstr = null;
            $in_msgid = false;
            $in_msgstr = false;
            continue;
        }

        // Parse msgid
        if (strpos($line, 'msgid ') === 0) {
            // Save previous entry if exists
            if ($current_msgid !== null && $current_msgstr !== null) {
                $entries[$current_msgid] = $current_msgstr;
            }

            $current_msgid = extract_string($line, 'msgid ');
            $current_msgstr = null;
            $in_msgid = true;
            $in_msgstr = false;
            continue;
        }

        // Parse msgstr
        if (strpos($line, 'msgstr ') === 0) {
            $current_msgstr = extract_string($line, 'msgstr ');
            $in_msgid = false;
            $in_msgstr = true;
            continue;
        }

        // Continuation line (starts with ")
        if ($line[0] === '"') {
            $continued = extract_string($line, '');

            if ($in_msgid && $current_msgid !== null) {
                $current_msgid .= $continued;
            } elseif ($in_msgstr && $current_msgstr !== null) {
                $current_msgstr .= $continued;
            }
        }
    }

    // Don't forget the last entry
    if ($current_msgid !== null && $current_msgstr !== null) {
        $entries[$current_msgid] = $current_msgstr;
    }

    return $entries;
}

/**
 * Extract a string value from a PO line.
 *
 * @param string $line The line to parse.
 * @param string $prefix The prefix to remove (e.g., 'msgid ').
 * @return string The extracted string.
 */
function extract_string(string $line, string $prefix): string
{
    $str = substr($line, strlen($prefix));
    $str = trim($str);

    // Remove surrounding quotes
    if (strlen($str) >= 2 && $str[0] === '"' && $str[strlen($str) - 1] === '"') {
        $str = substr($str, 1, -1);
    }

    // Unescape
    $str = str_replace(
        ['\\n', '\\r', '\\t', '\\"', '\\\\'],
        ["\n", "\r", "\t", '"', '\\'],
        $str
    );

    return $str;
}

/**
 * Write translations to a .mo file.
 *
 * @param array  $entries Array of msgid => msgstr pairs.
 * @param string $mo_file Path to output .mo file.
 * @return bool Success status.
 */
function write_mo_file(array $entries, string $mo_file): bool
{
    // Sort entries by msgid
    ksort($entries);

    $count = count($entries);

    // MO file header
    $magic = 0x950412de; // Little-endian magic number
    $revision = 0;

    // Calculate offsets
    $header_size = 28;
    $offset_orig = $header_size;
    $offset_trans = $offset_orig + ($count * 8);
    $offset_strings = $offset_trans + ($count * 8);

    // Build string tables
    $originals = [];
    $translations = [];
    $orig_offsets = [];
    $trans_offsets = [];

    $string_offset = $offset_strings;

    foreach ($entries as $msgid => $msgstr) {
        $orig_len = strlen($msgid);
        $trans_len = strlen($msgstr);

        $orig_offsets[] = [$orig_len, $string_offset];
        $originals[] = $msgid;
        $string_offset += $orig_len + 1; // +1 for null terminator

        $trans_offsets[] = [$trans_len, $string_offset];
        $translations[] = $msgstr;
        $string_offset += $trans_len + 1;
    }

    // Build binary data
    $data = '';

    // Header
    $data .= pack('V', $magic);           // magic number
    $data .= pack('V', $revision);        // file format revision
    $data .= pack('V', $count);           // number of strings
    $data .= pack('V', $offset_orig);     // offset of original strings table
    $data .= pack('V', $offset_trans);    // offset of translation strings table
    $data .= pack('V', 0);                // size of hashing table (unused)
    $data .= pack('V', 0);                // offset of hashing table (unused)

    // Original strings table
    foreach ($orig_offsets as $offset) {
        $data .= pack('V', $offset[0]);   // string length
        $data .= pack('V', $offset[1]);   // string offset
    }

    // Translation strings table
    foreach ($trans_offsets as $offset) {
        $data .= pack('V', $offset[0]);   // string length
        $data .= pack('V', $offset[1]);   // string offset
    }

    // Strings data
    foreach ($originals as $i => $original) {
        $data .= $original . "\0";
        $data .= $translations[$i] . "\0";
    }

    // Write file
    return file_put_contents($mo_file, $data) !== false;
}
