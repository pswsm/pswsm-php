<?php namespace pswsm\monedes {
define('MONEDES', ['EUR' => 1, 'USD' => 0.9, 'JPY' => 143, 'SEK' => 10.83, 'CHF' => 0.98]);

function canvi(string $mFrom, float $quantity, string $mTo): float {
	$result = (MONEDES[$mTo] / MONEDES[$mFrom]) * $quantity;
	return $result;
}

function getMonedes() {
	return array_keys(MONEDES);
}

function monedesDom($keys) {
	$dom = "";
	foreach ($keys as $key) {
		$dom = $dom . "<option value=$key>$key</option>";
	};
	echo $dom;
}

}
?>
