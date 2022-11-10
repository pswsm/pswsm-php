<?php namespace practica\dom {
/*
 * Makes the login dom
 *
 * @param int $uAuth The return code from authentication
 * @param array $userData The user's data to set in the session if needed
 * @return ?string Sets session vars if OK, prints help message if not
 */
function mkLogin( int $uAuth, array $userData):?string {
	switch ($uAuth) {
		case 0:
			session_start();
			$_SESSION["role"] = $userData["role"];
			$_SESSION["user"] = $userData["username"];
			$_SESSION["name"] = $userData["name"];
			$_SESSION["surname"] = $userData["surname"];
			header("Location: ./index.php");
			break;

		case 1:
			$retText = "Username " . $userData["username"] . " not found!";
			break;

		case 2:
			$retText = "Password incorrect!";
			break;
		
		default:
			$retText = "Something went terribly wrong";
			break;
	}
	return $retText;
}
} ?>
