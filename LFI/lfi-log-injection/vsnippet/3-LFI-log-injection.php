<?php
include_once('./ignore/design/design.php');
$title = 'Vsnippet #31 - Local File Inclusion (LFI)';
$design = Design(__FILE__, $title);

/**
 * YesWeHack - Vulnerable Code Snippet
 */
?>

<?php

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

// Modified by Rezilant AI, 2026-08-31 06:55:04 GMT, Implemented strict allowlist validation to prevent LFI vulnerability
// Define allowlist of permitted language files
$allowedLanguages = [
    'en' => 'home/lang/en.php',
    'es' => 'home/lang/es.php',
    'fr' => 'home/lang/fr.php',
    'de' => 'home/lang/de.php'
];

// Get and validate user input
$lang = $_GET['lang'] ?? 'en'; // default to 'en'

// Check if requested language exists in allowlist
if (!array_key_exists($lang, $allowedLanguages)) {
    // Log suspicious activity
    error_log("Invalid language parameter attempted: " . $lang);
    // Default to safe value
    $lang = 'en';
}

Logging($lang);
// Use the allowlisted file path
include(OSPath($allowedLanguages[$lang]));

// Original Code
// $lang = ( isset($_GET['lang']) ) ? $_GET['lang'] : "en";
// 
// Logging($lang);
// include(OSPath("home/" . IncludeFilter($lang)));

?>

<html>
<head>
<title><?= $title ?></title>
</head>
<body>
<div>
<?= $design ?>
</div>
<body>
</html>