<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include "defs.php";

$words = ["sprite", "spirit", "spitiuous", "sprint", "spray"];
$word1 = "spray";
$word2 = "anything";
echo "Word list: [<br>";
foreach ($words as $w) {
    echo $w, "<br>";
}
echo "]";

$positionW1 = pswsm\arrays\searchWord($words, $word1);
echo "<p>Word to search was: ", $word1, "</p>";
if ($positionW1 = -1) {
    echo "<p>Word not found</p>";
} else {
    echo "<p>Word found at position ", $positionW1, "</p>";
};
echo "<hr>";
$positionW2 = pswsm\arrays\searchWord($words, $word2);
echo "<p>Word to search was: ", $word2, "</p>";
if ($positionW1 = -1) {
    echo "<p>Word not found</p>";
} else {
    echo "<p>Word found at position ", $positionW2, "</p>";
};
?>
</body>
</html>
