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

function pwdOk(array $userData, string $username, string $password): array {
	$usernames = array_keys($userData);
	$inDb = [false, false];
	for ($i=0; $i < count($usernames); $i++) {
		if ($usernames[$i] == $username) {
			$inDb[0] = true;
		}
	}
	if ($inDb) {
		if ($userData[$username] == $password) {
			$inDb[1] = true;
		}
	}
	return $inDb;
}
} ?>
