<?php
function formatToName(string $name, string $surnames): string {
	$fName = ucfirst($name);
	$sepSurnames = explode(" ", $surnames);
	$fSepSurnames = [];
	for ($i = 0; $i < count($sepSurnames); $i++) {
		$fSepSurnames[$i] = ucfirst($sepSurnames[$i]);
	}
	return implode(" ", [$fName, implode(" ", $fSepSurnames)]);
}

if (!is_null(filter_input(INPUT_GET, 'submit'))) {
	$formatFullName = formatToName(filter_input(INPUT_GET, "nom"), filter_input(INPUT_GET, "cognom"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form</title>
</head>
<body>
<form action="index.php" method="GET">
	<div>
		<label for="nom">Introdueix el nom:</label><br>
		<input type="text" id="nom" name="nom" placeholder="elteunom">
	</div>
	<br>
	<div>
		<label for="cognom">Introdueix el cognom o cognoms:</label><br>
		<input type="text" name="cognom" id="cognom" placeholder="elteucognom">
	</div>
	<br>
	<div>
		<button type="submit" id="submit" name="submit">Enviar</button>
		<button type="reset" id="reset" name="reset">Netejar</button>
	</div>
</form>
<hr>
<span><?php if (isset($formatFullName)) { echo $formatFullName; }; ?></span>
</body>
</html>
