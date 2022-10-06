<?php namespace pswsm\monedes {
define('MONEDES', ['EUR' => 1, 'USD' => 0.9, 'JPY' => 143, 'SEK' => 10.83, 'CHF' => 0.98]);

function canvi(string $mFrom, float $quantity): float {
	return MONEDES[$mFrom] * $quantity;
}

function getMonedes() {
	return array_keys(MONEDES);
}

function monedesDom() {

}

}
?>
