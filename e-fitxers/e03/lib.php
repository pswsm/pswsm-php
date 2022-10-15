<?php namespace pswsm\chooseFile {
define('FILES_DIR', './db');

function listFiles(): array {
	return scandir(FILES_DIR);
}

function createOptions(array $options): string {
	$dom = "";
	foreach ($options as $option) {
		if (!is_dir(FILES_DIR . "/$option")) {
			$dom = $dom . "<option value=$option>$option</option>\n";
		};
	};
	return $dom;
}
} ?>
