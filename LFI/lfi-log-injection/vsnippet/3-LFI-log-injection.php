&lt;?php
include_once('./ignore/design/design.php');
$title = 'Vsnippet #31 - Local File Inclusion (LFI)';
$design = Design(__FILE__, $title);

/**
 * YesWeHack - Vulnerable Code Snippet
 */
?>

&lt;?php

// Secure the input from path traversal
function IncludeFilter($str) {
    while (True) {
        if ( strpos($str, "../") == false ) {
            break;
        }
        $str = str_replace("../", "", $str);
    }
    return $str;
}

// Normalize slash related to OS
function OSPath($str){
    if ( strtolower(PHP_OS) == "linux" ) {
        $str = str_replace("\\", "/", $str);
        
    } else {
        $str = str_replace("/", "\\", $str);
    }
    return $str;
}

// Log the given value to a the log file
function Logging($value) {
    file_put_contents("logs/log.txt", (date("[Y-m-d]") . "$value\n"), FILE_APPEND);
}

// Modified by Rezilant AI, 2026-07-03 08:40:32 GMT, Replaced dynamic path construction with allowlist-based file inclusion to prevent LFI attacks
// Define allowed language files
$allowedLanguages = [
    'en' => 'home/lang/english.php',
    'es' => 'home/lang/spanish.php',
    'fr' => 'home/lang/french.php',
    'de' => 'home/lang/german.php'
];

// Get and validate the language parameter
$lang = $_GET['lang'] ?? 'en';

// Check if the requested language exists in the allowlist
if (array_key_exists($lang, $allowedLanguages)) {
    $filePath = OSPath($allowedLanguages[$lang]);
    Logging($lang);
    include($filePath);
} else {
    // Default to English or show error
    Logging($lang . " (invalid, defaulted to en)");
    include(OSPath('home/lang/english.php'));
}

// Original Code
// $lang = ( isset($_GET['lang']) ) ? $_GET['lang'] : "en";
// 
// Logging($lang);
// include(OSPath("home/" . IncludeFilter($lang)));

?>

&lt;html>
&lt;head>
&lt;title>&lt;?= $title ?>&lt;/title>
&lt;/head>
&lt;body>
&lt;div>
&lt;?= $design ?>
&lt;/div>
&lt;body>
&lt;/html>