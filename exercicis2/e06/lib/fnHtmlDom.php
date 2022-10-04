<?php

namespace pswsm\patates_dom;

/**
 * echoes html code for a select element with values given in array parameter
 * @param name the name for the selector element
 * @param array the array of values for the selector 
 */
function renderSlider(string $name, array $values, mixed $valueSel = "") {
	echo "<input id=", $name, "min=", min($values), "max=", max($values), "step=", $values[0] - $values[1], ">";
}

