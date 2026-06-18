<?php
//Ignore the design setup below:
include_once('./ignore/design/design.php');
$title = 'Vsnippet #26 - TITLE';
$design = Design(__FILE__, $title);

/*
* YesWeHack - Vulnerable Code Snippet
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
</head>
<body>
<center>
<h1><?= $title ?></h1>

<!-- Account Pages -->

<b>Logged in as Guest</b>
<div id="itemlist">
    <ul>
        <li><a href="?page=orders.html">Orders</a></li>
        <li><a href="?page=edit.html">Edit</a></li>
        <li><a href="?page=profile.html">Profile</a></li>
    </ul>
</div>


<?php
$page = "profile.html";

if ( isset($_GET["page"]) ) {
    $page = $_GET["page"];
    $page = preg_replace("/[\\\\\/:]/", "_", $page, 10);
}
echo "Current page:\t" . htmlentities($page);
// Modified by Rezilant AI, 2026-06-18 23:33:24 GMT, Added htmlentities() wrapper to prevent XSS by encoding HTML special characters in file output
echo htmlentities(file_get_contents("./account/$page"), ENT_QUOTES, 'UTF-8');
// Original Code
//echo file_get_contents("./account/$page");
?>

</center>
<div>
<?= $design ?>
</div>
<body>
</html>