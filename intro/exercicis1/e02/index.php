<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Pau Figueras"
    <meta charset="UTF-8">
    <title>BMI Calc</title>
</head>
<body>
<?php
include "main.php";

$result = pswsm\bmi\bmi_calc(57, 1.77);
echo "<p>Your BMI index is: ", number_format($result[0], 2, ".", ""), ", meaning you are ", $result[1], ".";
?>
</body>
</html>
