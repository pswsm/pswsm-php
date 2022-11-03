<?php namespace practica\menus {
define('FIELDNAMES', ["id", "category", "name", "price"]);
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
				if ($retCode == 0) {
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
} ?>
