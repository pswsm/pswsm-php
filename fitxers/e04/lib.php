<?php namespace pswsm\textAreaFile {
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
 * Makes the DOM for the file content
 *
 * @param string $file The file to read to contents
 * @return string The DOM
 */
function createTextArea(string $file): string {
	$dom = "<textarea class=\"textarea\" readonly>" . file_get_contents(buildPath($file)) . "</textarea>";
	return $dom;
}
} ?>
