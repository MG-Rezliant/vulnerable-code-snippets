&lt;?php
//Ignore the design setup below:
include_once('./ignore/design/design.php');
$title = 'Vsnippet #36 - Unrestricted File Upload Vulnerability';
$design = Design(__FILE__);

/*
* YesWeHack - Vulnerable Code Snippet
*/
?>

&lt;?php
if ( isset($_POST['markdown']) && isset($_POST['convert']) ) {
    // Modified by Rezilant AI, 2026-04-29 14:27:42 GMT, Added whitelist validation for convert parameter to prevent command injection
    // Whitelist of allowed formats
    $allowedFormats = ['html', 'pdf', 'docx', 'txt'];
    
    $convert_input = ( strlen($_POST['convert']) > 0 ) ? $_POST['convert'] : 'html';
    
    // Validate against whitelist
    if (!in_array($convert_input, $allowedFormats, true)) {
        die(htmlspecialchars("Invalid format specified", ENT_QUOTES, 'UTF-8'));
    }
    
    $convert = $convert_input; // Safe to use after validation
    
    file_put_contents('markdown.md', $_POST['markdown']);
    // Modified by Rezilant AI, 2026-04-29 14:27:42 GMT, Added htmlspecialchars to prevent XSS when echoing shell output
    $output = shell_exec("pandoc markdown.md -t ". $convert ." -o ./files/converted");
    echo htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    
    // Original Code
    // $convert = ( strlen($_POST['convert']) > 0 ) ? $_POST['convert'] : 'html';
    // file_put_contents('markdown.md', $_POST['markdown']);
    // echo shell_exec("pandoc markdown.md -t ". escapeshellcmd($convert) ." -o ./files/converted");
    
    unlink('markdown.md');
}
?>

&lt;html>
&lt;title>&lt;?= $title ?>&lt;/title>
&lt;body>
&lt;h1>&lt;?= $title ?>&lt;/h1>
&lt;center>
&lt;h1>Convert markdown to HTML&lt;/h1>
&lt;div>
    &lt;form id="convertForm" action="" method="POST" enctype="multipart/form-data">
        &lt;textarea form="convertForm" rows="16" cols="70" type="text" name="markdown">&lt;/textarea>&lt;br>
        &lt;input type="text" name="convert" placeholder="convert to... (Ex: html)">&lt;br>
        &lt;input type="submit" name="submit" value="Convert to HTML">
    &lt;/form>
&lt;/div>

&lt;h1> Converted File Output &lt;/h1>
&lt;iframe id="output" src="/files/converted">&lt;/iframe>
&lt;/center>

&lt;div>
&lt;?= $design ?>
&lt;/div>
&lt;style>
#output {
    background: #FFFFFF;
    border: solid 3px #09d8c4;
    border-radius: 22px;
    width: 500px;
    height: 420px;
} 
&lt;/style>
&lt;body>
&lt;/html>