<?php namespace practica\dom {

function mkLoginDom(string $uAuth, string $user, string $role):?string {
	switch ($uAuth) {
		case 0:
			setcookie("loggedUser", json_encode(["user" => $user, "role" => $role]));
			header("Location: ./index.php");
			break;

		case 1:
			$retText = "Username \"$user\" not found!";
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
