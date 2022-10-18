<?php namespace practica {
/**
 * Authenticate user
 *
 * @param string $username	The username
 * @param string $password	The password
 * @param string $db		DB File location
 * @return array|int		Reutrns an array with 2 booleans or int 1 if error
 */
function userAuth(string $username, string $password, string $db = "../db/users.txt"): array|int {
	if (file_exists($db)) {
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
		return $inDb;
	}
	return 1;
}

/**
 * Create user
 *
 * @param string $username	The username
 * @param string $password	The password
 * @param string $db		DB File location
 * @return int Returns 0 if everything ok
 */
function userMake(string $username, string $password, string $db = "../db/users.txt"): int {
	$fileHandle = fopen($db, "a");
	fprintf($fileHandle, "%s:%s\n", $username, $password);
	fclose($fileHandle);
	return 0;
}
} ?>
