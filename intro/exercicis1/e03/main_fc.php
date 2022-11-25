<?php
include "f_to_c.php";

function do_math() {
    $fdeg = 90.2;
    $cdeg = 5.7;
    echo "<p>", $fdeg, "°F in Celsius is: ", pswsm\temp\ftoc($fdeg), "</p>";
    echo "<p>", $cdeg, "°C in Fahrenheit is: ", pswsm\temp\ctof($cdeg), "</p>";
}
?>
