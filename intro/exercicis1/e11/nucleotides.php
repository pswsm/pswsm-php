<?php namespace pswsm\dna {
define ('ATCG', ['a' => 't', 't' => 'a', 'c' => 'g', 'g' => 'c']);

function base_exists(string $base): bool {
	if (!array_key_exists($base, ATCG)) {
		return false;
	}
	return true;
}

function complement(string $chain): string {
	$test_sequence = strtolower($chain);
	$compl_sequence = [];
	foreach (str_split($test_sequence) as $c) {
		if (base_exists($c)) {
			$compl_sequence[count($compl_sequence)] = ATCG[$c];
		} else {
			printf("Found %s: not a DNA character.\n", $c);
			return '';
		}
	}
	$compl_sequence = implode('', $compl_sequence);
	return strtoupper($compl_sequence);
}
}?>
