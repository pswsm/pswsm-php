<?php namespace pswsm\temp {

/*
 * Converts Fahrenheit units to Celsius units
 * @param $fh Fahrenheit temperatura as float
 * @return Celsius temperature as float
 */
function ftoc(float $fh): float { 
    return (float)($fh - 32) * 0.552;
}
/*
 * Converts Celsius units to Fahrenheit units
 * @param $c Celsius Temperature as float
 * @return Fahrenheit temperature as float
 */
function ctof(float $c): float { 
    return (float)($c * 1.8) + 32;
}
}
?>
