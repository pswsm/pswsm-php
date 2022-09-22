<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercici 09</title>
</head>
<body>
<?php
include "defs.php";

$theArray = range(1, 32, 0.5);

$results = \pswsm\arrops\maths($theArray);

echo "Min: $results[0]\nMax: $results[1]\nMedian: $results[2]\nAverage: $results[3]";

?>
</body>
</html>
