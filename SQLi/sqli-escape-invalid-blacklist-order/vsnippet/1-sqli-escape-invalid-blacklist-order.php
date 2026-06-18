<?php
include_once('./ignore/design/design.php');
include("./ignore/db/db.php");
$title = 'Vsnippet #7 - SQL injection - Mix-up of variables';
$design = Design(__FILE__);

/*
* YesWeHack - Vulnerable code snippets
*/
?>

<?php

$query = ( isset($_GET['q']) ) ? $_GET['q'] : '';

$lst_blacklist = array("\"", "`", "'", "\\" );

foreach ( $lst_blacklist as $char ) {
  if ( str_contains($query, $char) ) {
     $query = str_replace($char, ("\\".$char), $query);
  }
}

// Modified by Rezilant AI, 2026-06-18 16:32:38 GMT, Replaced direct query concatenation with prepared statement to prevent SQL injection
$stmt = $mysqlDB->prepare("SELECT * FROM `products` WHERE category = ?");
$stmt->bind_param("s", $query);
$stmt->execute();
$result = $stmt->get_result();

// Original Code
// $result = $mysqlDB->query("SELECT * FROM `products` WHERE category = '$query'");

// In case we got any data back from our database, output it:
if ( $result->num_rows > 0 ) {
    while($row = $result->fetch_assoc()) {
      echo "Id: " . $row["id"] . "\n",
      "Stock: " . $row["stock"] . "\n",
      "Category: " .$row["category"] . "\n",
      "Color: " .$row["color"] . "\n";
    }
} else {
  echo "0 results for $query";
}

$mysqlDB->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
</head>
<body>
<h1><?= $title ?></h1>


<div>
<?= $design ?>
</div>
<body>
</html>