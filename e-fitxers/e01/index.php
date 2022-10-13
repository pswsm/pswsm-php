<?php
// https://www.php.net/manual/en/filter.filters.sanitize.php
// El filtre FILTER_SANITIZE_STRING s'ha deprecat en favor de la funcio htmlspecialchars()

include_once "lib.php";
use pswsm\login as login;
$data = login\getDataFromFile();

if (\filter_has_var(INPUT_POST, "submit")) {
	$userExists = login\pwdOk(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
	if ($userExists == [true, true]) {
		$allOk = true;
	} else if ($userExists == [true, false]) {
		$usernameOk = true;
	} else {
		$noneOk = true;
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
	<p class="has-text-centered is-size-1">Validar desde fitxer</p>
	<div class="columns">
		<div class="column"></div>
		<div class="column is-two-thirds">
			<div class="box">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<p class="is-size-4 has-text-centered">Validar dades desde un fixter:</p><br>
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
			if (isset($usernameOk)) {
				echo "<p>Password is incorrect</p>";
			} else if (isset($allOk)) {
				echo "<p>Logged in as: " . htmlspecialchars($_POST["username"]);
			} else if (isset($noneOk)) {
				echo "User not found!";
			}
			?>
			</div>
		</div>
		<div class="column"></div>
	</div>
</body>
</html>
