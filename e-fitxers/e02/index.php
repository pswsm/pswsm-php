<?php
// https://www.php.net/manual/en/filter.filters.sanitize.php
// El filtre FILTER_SANITIZE_STRING s'ha deprecat en favor de la funcio htmlspecialchars()

include_once "lib.php";
use pswsm\createUser as cu;

if (\filter_has_var(INPUT_POST, "submit")) {
	$userExists = cu\pwdOk(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
	if ($userExists == [true, true]) {
		$allOk = true;
	} else if ($userExists == [true, false]) {
		$usernameOk = true;
	} else {
		cu\createUser(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
		$createdUser = true;
	}
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validar desde un fitxer</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
	<p class="has-text-centered is-size-1">Crear usuari</p>
	<div class="columns">
		<div class="column"></div>
		<div class="column is-two-thirds">
			<div class="box">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<p class="is-size-4 has-text-centered">Crear un usuari</p><br>
					<div class="field">
						<div class="control">
							<label class="label" for="">Nom d'usuari:</label>
							<input id="username" class="input" type="text" name="username">
							<label class="label" for="">Contrasenya:</label>
							<input id="password" class="input" type="password" name="password">
						</div>
					</div>
					<div class="field is-grouped">
						<div class="control">
							<input id="submit" class="button" type="submit" name="submit">
							<input class="button" type="reset">
						</div>
					</div>
				</form>
			</div>
			<div class="container">
			<?php
			if (isset($usernameOk) || isset($allOk)) {
				echo "<p>User already exists</p>";
			}  else if (isset($createdUser)) {
				echo "<p>Created user \"" . htmlspecialchars($_POST["username"]) . "\"</p>";
			}
			?>
			</div>
		</div>
		<div class="column"></div>
	</div>
</body>
</html>
