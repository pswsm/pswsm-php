<?php namespace pswsm\login {
define('DB_FILE', './db/db.txt');

function getDataFromFile(): array {
	$lines = file(DB_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$lines_kv = [];
	for ($i=0; $i < count($lines); $i++) { 
		$kvs = explode(":", $lines[$i]);
		$lines_kv[$kvs [0]] = $kvs[1];
	}
	unset($lines);
	return $lines_kv;
}

function pwdOk(string $username, string $password): array {
	if (file_exists(DB_FILE)) {
		$fileHandle = fopen(DB_FILE, "rb");
		while (!feof($fileHandle)) {
			fscanf($fileHandle, "%s\n", $line);
			$kvs = explode(":", $line);
			$line_kv[$kvs [0]] = $kvs[1];
			if (in_array($username, array_keys($line_kv))) {
				$userOk = true;
			} else {
				$userOk = false;
			}
			if ($userOk && $line_kv[$username] == $password) {
				$pswdOk = true;
			} else {
				$pswdOk = false;
			}
		}
	}
	fclose($fileHandle);
	return [$userOk, $pswdOk];
}
} ?>
