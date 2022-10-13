<?php namespace pswsm\createUser {
define('DB_FILE', './db/db.txt');

function pwdOk(string $username, string $password): array {
	if (file_exists(DB_FILE)) {
		$fileHandle = fopen(DB_FILE, "rb");
		while (!feof($fileHandle)) {
			fscanf($fileHandle, "%s\n", $line);
			$kvs = explode(":", $line);
			$line_kv[$kvs [0]] = $kvs[1];
			$inDb = [false, false];
			if (in_array($username, array_keys($line_kv))) {
				$inDb[0] = true;
			}
			if ($inDb[0] && $line_kv[$username] == $password) {
				$inDb[1] = true;
			}
		}
		fclose($fileHandle);
	}
	return $inDb;
}

function createUser(string $username, string $password): void {
	$fileHandle = fopen(DB_FILE, "a");
	fprintf($fileHandle, "%s:%s\n", $username, $password);
	fclose($fileHandle);
}
} ?>
