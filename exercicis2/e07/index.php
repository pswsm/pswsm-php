<?php
include "lib.php";
$monedes = \pswsm\monedes\getMonedes();

if (\filter_has_var(INPUT_POST, "submit")) {
	$canvi = \pswsm\monedes\canvi(filter_input(INPUT_POST, "mOrigen"), filter_input(INPUT_POST, "mOrigQtt"), filter_input(INPUT_POST, "mDesti"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Conersor monedes</title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<fieldset>
			<legend>Coin exchange rate</legend> 
			<div>
				<?php
				$preus = pswsm\monedes\getMonedes();
				?>
				<select id="mOrigen" name="mOrigen">
				<?php
				\pswsm\monedes\monedesDom($preus);
				?>
				</select>
				<input type="number" name="mOrigQtt">
				<span>&nbsp;to&nbsp;</span>
				<select id="mDesti" name="mDesti">
				<?php
				\pswsm\monedes\monedesDom($preus);
				?>
				</select>
				<br>
				<button type="submit" name="submit" value="submit">Submit</button>
			</div>
		</fieldset>
		<fieldset>
			<legend>Receipt</legend> 
			<div>
				<label for="price">Canvi: </label>
				<input type="text" name="price" disabled="disabled" value="<?php isset($canvi) ? printf('%f', $canvi) : printf(''); ?>" />
			</div>
		</fieldset>
	</form>
</body>
</html>
