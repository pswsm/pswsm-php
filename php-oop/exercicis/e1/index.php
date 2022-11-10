<?php
require_once "./lib.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercici 1</title>
</head>
<body>
	<form action="">
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
</body>
</html>
