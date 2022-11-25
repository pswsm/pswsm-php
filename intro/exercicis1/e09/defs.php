<?php namespace pswsm\arrops {
function maths(array $arr): array {
	$operations = [];
	$operations[0] = min($arr); // Min
	$operations[1] = max($arr); // Max
	$operations[2] = $arr[floor(count($arr)/2)]; // Median
	$operations[3] = array_sum($arr) / count($arr); // Average
	return $operations;
};
}
?>
