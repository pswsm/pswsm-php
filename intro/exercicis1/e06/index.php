<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include "defs.php";

$fullAge = pswsm\dates\get_detail_age("2003-10-20");
echo "<p>Your age is: ", $fullAge, "</p>";
?>
</body>
</html>
