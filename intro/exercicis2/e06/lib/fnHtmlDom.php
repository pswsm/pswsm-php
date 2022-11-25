<?php

namespace pswsm\patates_dom;

/**
 * echoes html code for a select element with values given in array parameter
 * @param name the name for the selector element
 * @param array the array of values for the selector 
 */
function renderSlider(string $name, array $values) {
	$minVal = min($values);
	$maxVal = max($values);
	$step = $values[1] - $values[0];
	echo "(Minim $minVal kg, màxim $maxVal kg. Diferència $step)";
	echo "<input type='range' name='$name' id='$name' min='$minVal' max='$maxVal' step='$step'>";
}

