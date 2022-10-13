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
	if (in_array($username, $usernames)) {
		$inDb[0] = true;
	}
	if ($inDb[0] && $userData[$username] == $password) {
		$inDb[1] = true;
	}
	return $inDb;
}
} ?>
