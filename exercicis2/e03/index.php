<?php
function formatToDiv(string $name, array $sports): string {
	$fName =  "<strong>Nom:</strong><br>" . ucfirst($name) . "<br>";
	$sportsStr = "<strong>Esports:</strong><br>" . implode("<br>", $sports);
	return "<div>" . implode(" ", [$fName, $sportsStr]) . "</div>";
}

if (!is_null(filter_input(INPUT_POST, 'submit'))) {
	$formatSports = formatToDiv($_POST["nom"], isset($_POST["esports"]) ? $_POST["esports"] : ["Cap"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form</title>
</head>
<body>
<form action="index.php" method="POST">
	<div>
		<label for="nom">Introdueix el nom:</label><br>
		<input type="text" id="nom" name="nom" placeholder="elteunom">
	</div>
	<br>
	<div>
		<label>Introdueix el cognom o cognoms:</label><br>
		<input type="checkbox" name="esports[]" id="snowboard" value="snowboard">
		<label for="snowboard">Snowboard</label><br>
		<input type="checkbox" name="esports[]" id="esquí" value="esquí">
		<label for="esquí">Esquí</label><br>
		<input type="checkbox" name="esports[]" id="futbol" value="futbol">
		<label for="futbol">Futbol</label><br>
		<input type="checkbox" name="esports[]" id="basquet" value="basquet">
		<label for="basquet">Basquet</label><br>
		<input type="checkbox" name="esports[]" id="descens" value="descens">
		<label for="descens">Descens</label><br>
	</div>
	<br>
	<div>
		<button type="submit" id="submit" name="submit">Enviar</button>
		<button type="reset" id="reset" name="reset">Netejar</button>
	</div>
</form>
<hr>
<span><?php if (isset($formatSports)) { echo $formatSports; }; ?></span>
</body>
</html>
