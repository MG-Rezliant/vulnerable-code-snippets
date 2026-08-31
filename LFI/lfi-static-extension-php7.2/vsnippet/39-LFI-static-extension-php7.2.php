&lt;?php
//Ignore the design setup below:
include_once('./ignore/design/design.php');
$design = Design(__FILE__);

/*
* YesWeHack - Vulnerable Code Snippet
*/

?>

&lt;?php
/*
* - [ GOAL ] -
* Use the Local File Inclusion (LFI) vulnerability to archive a remote code execution (RCE)
*/

#Load a page (view) provided by the application:
if ( isset($_GET['page']) ) {
    // Modified by Rezilant AI, 2026-08-31 06:56:20 GMT, Implement allowlist to prevent LFI/RCE by restricting page inclusion to pre-approved files only
    // Define allowed pages
    $allowedPages = [
        'home',
        'about',
        'contact',
        'products',
        'services'
    ];

    // Get and validate the page parameter
    $requestedPage = $_GET['page'];

    // Check if requested page is in the allowlist
    if (in_array($requestedPage, $allowedPages, true)) {
        include($_SERVER['DOCUMENT_ROOT'] . '/views/' . $requestedPage . '.php');
    } else {
        // Handle invalid page request - show error for unauthorized access attempt
        echo '&lt;h1>Page not found!&lt;/h1>';
        // Or log the attempt and show error
    }
    // Original Code
    // include($_SERVER['DOCUMENT_ROOT'] . '/views/' . $_GET['page'] . '.php');
} else {
    echo '&lt;h1>I want a page!&lt;/h1>';
}
?>

&lt;html>
&lt;head>
    &lt;title>Vsnippet #39 - PHP - Local file inclusion (LFI) to remote code execution (RCE)&lt;/title>
    &lt;link rel="stylesheet" href="./assets/css/styles.css">
&lt;/head>
&lt;body>
&lt;!-- Navigation Bar -->
&lt;ul class="navbar">
    &lt;a href="./?page=home">Home&lt;/a>
    &lt;a href="./?page=about">About&lt;/a>
    &lt;a href="./?page=contact">Contact&lt;/a>
&lt;/ul>
&lt;div>
&lt;?= $design ?>
&lt;/div>
&lt;body>
&lt;/html>