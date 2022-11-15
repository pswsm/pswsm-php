<?php
define('FILE_DB', './db/test.csv');

require_once "./libs/userClass.php";
require_once "./libs/persistUsers.php";

use oop\persisUsers\UPersists;
use oop\user\User;

session_start();

$userPersist = new UPersists(FILE_DB, ";");
$userList = $userPersist->readAllUsers();
$userCount = $userPersist->countUsers();

if (filter_has_var(INPUT_POST, "submit")) {
	$user = new User(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["pwd"]), htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["surname"]));
	if (!isset($_SESSION["users"])) {
		$_SESSION["users"] = [$user];
	} else {
		$_SESSION["users"] = array_merge($_SESSION["users"], [$user]);
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercici 1</title>
</head>
<body>
<form action='<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method="POST">
		<div>
			<label for="username">Nom d'usuari</label>
			<input type="text" placeholder="username" name="username">
		</div>
		<div>
			<label for="pwd">Contrasenya</label>
			<input type="password" name="pwd">
		</div>
		<div>
			<label for="name">Nom</label>
			<input type="text" placeholder="Pau" name="name">
		</div>
		<div>
			<label for="surname">Cognom</label>
			<input type="text" placeholder="username" name="surname">
		</div>
		<div>
			<input type="submit" name="submit">
			<input type="reset">
		</div>
	</form>
<ul>Total user count
<?php
if (isset($userCount)) {
	echo "<li>$userCount</li>";
}
?>
	</ul>
	<ul>From userPersist
<?php
if (isset($userList)) {
	foreach ($userList as $user) {
		echo "<li>$user</li>";
	}
} else {
	echo "<li>No users atm</li>";
}
?>
	</ul>
	<ul>From session
<?php
if (isset($_SESSION["users"])) {
	foreach ($_SESSION["users"] as $user) {
		echo "<li>$user</li>";
	}
}
?>
	</ul>
</body>
</html>
