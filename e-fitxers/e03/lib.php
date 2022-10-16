<?php namespace pswsm\chooseFile {
define('FILES_DIR', './db');

/**
 * Builds the path of the given file in realtion to this exercise
 *
 * @param string $fileName The name of the file
 * @return string The realtive path, accordig this exercise
 */
function buildPath($fileName): string {
	return FILES_DIR . "/$fileName";
}

/**
 * Returns the listing of $folder
 *
 * @param string $folder The folder to list
 * @return array An array with each file and directory inside $folder
 */
function listFiles(string $folder): array {
	return scandir($folder);
}

/**
 * Creates options for a <select> tag
 *
 * @param array $options An array with the options
 * @return string Returns the DOM HTML code
 */
function createOptions(array $options): string {
	$dom = "";
	foreach ($options as $option) {
		if (!is_dir(buildPath($option))) {
			$dom = $dom . "<option value=$option>$option</option>\n";
		};
	};
	return $dom;
}

/**
 * Counts the occurrences for each starting letter of each word in the file
 *
 * @param string $fileName The filename of the file
 * @return array An associative array with (string) letter as key, (int) count as value
 */
function listWords(string $fileName): array {
	$fileContents = file(buildPath($fileName), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$counts = [];
	foreach ($fileContents as $line) {
		$explodedLine = explode(" ", strtoupper($line));
		foreach ($explodedLine as $word) {
			if (array_key_exists($word[0], $counts)) {
				$counts[$word[0]] += 1;
			} else {
				$counts[$word[0]] = 1;
			}
		}
	}
	ksort($counts);
	return $counts;
}

/**
 * Makes the DOM for the counting results
 *
 * @param array $listing An array with letter countings
 * @return string The DOM
 */
function createListing(array $listing): string {
	$dom = "";
	foreach ($listing as $letter => $count) {
		$dom = $dom . "<p>$letter: $count";
	};
	return $dom;
}
} ?>
