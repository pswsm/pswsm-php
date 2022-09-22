<?php namespace pswsm\arrays {
function searchWord(array $words, string $word): int {
	$word_found = false;
	$counter = 0;
	foreach ($words as $w) {
		echo $w;
		if ($w == $word) {
			return $counter;
		} else {
			$counter++;
		}
	}
	return -1;
}
}?>
