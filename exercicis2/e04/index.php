<?php
function calculate(string $operador, string $operand1, string $operand2): string {
	$result = match ($operador) {
		"+" => (int)$operand1 + (int)$operand2,
		"-" => (int)$operand1 + (int)$operand2,
		"*" => (int)$operand1 + (int)$operand2,
		"/" => (int)$operand1 + (int)$operand2
	};
	return $result;
}

if (!is_null(filter_input(INPUT_POST, 'submit'))) {
	$formatSports = calculate(filter_var($_POST["operador"]), filter_var($_POST["operand1"]), filter_var($_POST["operand2"]));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form</title>
</head>
<body>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
	<div>
		<label for="nom">Introdueix el primer operand:</label><br>
		<input type="number" id="operand1" name="operand1" placeholder="0">
	</div>
	<div>
		<label for="nom">Introdueix el segon operand:</label><br>
		<input type="number" id="operand2" name="operand2" placeholder="0">
	</div>
	<br>
	<div>
		<p>Tipus d'operació que vol fer:</p><br>
		<input type="radio" name="operador" id="suma" value="+">
		<label for="suma">+</label><br>
		<input type="radio" name="operador" id="resta" value="-">
		<label for="resta">-</label><br>
		<input type="radio" name="operador" id="multi" value="*">
		<label for="multi">̣×</label><br>
		<input type="radio" name="operador" id="divisio" value="/">
		<label for="divisio">÷</label><br>
	</div>
	<br>
	<div>
		<button type="submit" id="submit" name="submit">Enviar</button>
		<button type="reset" id="reset" name="reset">Netejar</button>
	</div>
	<hr>
	<div>
		<label for="resultat">Resultat:</label><br>
		<input id="resultat" type="number" name="resultat" readonly="" value=<?php isset($formatSports) ? printf("%d", $formatSports) : printf("") ?>>
	</div>
</form>
<hr>
</body>
</html>
