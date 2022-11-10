<?php namespace practica\login {
define('FIELDNAMES', ["username", "password", "role", "name", "surname"]);
/**
 * Authenticate user
 *
 * @param string $username	The username
 * @param string $password	The password
 * @param string $db		Optional. DB File location
 * @return int				Reutrn codes:
 * 							0 => Login OK
 * 							1 => Username not found
 * 							2 => Username OK, password not correct
 * 							3 => Could not open database
 */
function userAuth(string $username, string $password, string $db = "/home/pswsm/code/pswsm-php/pt11v0/db/users.txt"): int {
	if (file_exists($db)) {
		$fileHandle = fopen($db, "r");
		while (!feof($fileHandle)) {
			$line = fgetcsv($fileHandle, separator: ";");
			if ($line != false) {
				for ($i=0; $i < count($line); $i++) { 
					$line_kv[FIELDNAMES[$i]] = $line[$i];
				}
				$retCode = 1;
				if ($username == $line_kv["username"]) {
					$retCode = 0;
				}
				if ($retCode == 0 && !($line_kv["password"] == $password)) {
					$retCode = 2;
				}
				if ($retCode != 1) {
					fclose($fileHandle);
					return $retCode;
				}
			}
		}
		fclose($fileHandle);
		return $retCode;
	}
	return 3;
}

/**
 * Create user
 *
 * @param string $username	The username
 * @param string $password	The password
 * @param string $role		Optional. The role of the user
 * @param string $db		Optional. DB File location
 * @return int				Returns codes:
* 							0 => User creation OK
* 							1 => User already exists
* 							2 => Could not connect with DB
 */
function userMake(string $username, string $password, string $name, string $surname, string $role = "registered", string $db = "/home/pswsm/code/pswsm-php/pt11v0/db/users.txt"): int {
	if (file_exists($db)) {
		if (userAuth($username, "", db: $db) == 1) {
			$fileHandle = fopen($db, "a+");
			fputcsv($fileHandle, array($username, $password, $role, $name, $surname), separator: ";");
			fclose($fileHandle);
			return 0;
		}
		return 1;
	}
	return 2;
}

/*
 * Gets the role from given user
 *
 * @param string $username The username of the user who we want the role
 * @param string $db option Where are the users located
 * @return array|int An array with the user data or an error code
 */
function getRole(string $username, string $db = "/home/pswsm/code/pswsm-php/pt11v0/db/users.txt"): array|int {
	if (file_exists($db)) {
		$fileHandle = fopen($db, "r");
		while (!feof($fileHandle)) {
			$line = fgetcsv($fileHandle, separator: ";");
			if ($line != false) {
				for ($i=0; $i < count($line); $i++) { 
					$line_kv[FIELDNAMES[$i]] = $line[$i];
				}
				if ($line_kv["username"] == $username) {
					fclose($fileHandle);
					return $line_kv;
				}
			}
		}
		fclose($fileHandle);
	}
	return 1;
}
} ?>
