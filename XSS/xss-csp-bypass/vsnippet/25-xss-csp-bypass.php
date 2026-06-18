<?php
/*
* YesWeHack - Vulnerable Code Snippet
*/

function GetNonce() {
    return base64_encode(random_bytes(20));
}

$nonce = GetNonce();
header("Content-Security-Policy: script-src 'nonce-$nonce'");

//Ignore the php code below (design only)
include_once('./ignore/design/design.php');
$title = 'Vsnippet #25 - Cross Site Scripting (XSS) CSP bypass';
$design = Design(__FILE__, $title);
?>

<!DOCTYPE html>
<html>
    <head>
      <title><?= $title ?></title>
    </head>
<body>
<h1><?= $title ?></h1>

<!-- Modified by Rezilant AI, 2026-06-18 23:34:08 GMT, Sanitized user input to prevent XSS by encoding special characters -->
<p><?= isset($_GET["message"]) ? htmlentities($_GET["message"], ENT_QUOTES, 'UTF-8') : 'session expired' ?></p>

<!-- Original Code -->
<!-- <p><?= ( isset($_GET["message"]) ) ? $_GET["message"] : 'session expired' ?></p> -->

<input type="hidden" id="host" value="<?= $_SERVER['HTTP_HOST'] ?>">

<script nonce="<?= $nonce ?>">
   const URLparams = new URLSearchParams(window.location.search);
   const logout = URLparams.get('logout') || false;
    if ( logout ) {
        const host = document.querySelector('#host').value;
        const scrptTag = document.createElement('script');

        scrptTag.nonce = document.currentScript.nonce;
        scrptTag.src = ("//" + host + '/checkLogout.js');

        document.body.appendChild(scrptTag);
    }
</script>

<div>
<?= $design ?>
</div>
</body>
</html>