<?php

if (!function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool
    {
        $needle_len = strlen($needle);
        return ($needle_len === 0 || 0 === substr_compare($haystack, $needle, -$needle_len));
    }
}

// $out = fopen('php://output', 'w');
// fwrite($out, "Cross-Origin-Opener-Policy");

if (str_ends_with($_SERVER["SCRIPT_FILENAME"], 'js')) {
    header("Cross-Origin-Opener-Policy: same-origin");
    header("Cross-Origin-Embedder-Policy: require-corp");
    header('Content-Type: application/javascript');
    readfile($_SERVER["SCRIPT_FILENAME"]);
    return true;
} elseif (str_ends_with($_SERVER["SCRIPT_FILENAME"], '.wasm')) {
    header("Cross-Origin-Opener-Policy: same-origin");
    header("Cross-Origin-Embedder-Policy: require-corp");
    header('Content-Type: application/wasm');
    readfile($_SERVER["SCRIPT_FILENAME"]);
    return true;
} else {
    header("Cross-Origin-Opener-Policy: same-origin");
    header("Cross-Origin-Embedder-Policy: require-corp");
    header('Content-Type: ' . mime_content_type($_SERVER["SCRIPT_FILENAME"]));    
    readfile($_SERVER["SCRIPT_FILENAME"]);
    return true;
}

return false;
