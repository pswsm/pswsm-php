<?php
include "lib.php";
$monedes = \pswsm\monedes\getMonedes();
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
			<legend>Order your patates here</legend> 
			<div>
				<label for="quilos">Quilos de patates:</label><br>
				<!-- write a selector for drinks -->
				<?php
				//get all drink names
				$preus = pswsm\monedes\getMonedes();
				//DEBUG: add a test drink not in initial array to check drink not found error (REMOVE FOR PRODUCTION!!!)
				//echo selector with all drink names
				patates_dom\renderSlider("quilos", $preus);
				?>
				<button type="submit" name="btnSubmit" value="submit">Submit</button>
			</div>
		</fieldset>
		<fieldset>
			<legend>Receipt</legend> 
			<div>
				<label for="selectedDrink">Pes: </label>
				<input type="text" name="quilos" disabled="disabled" value="<?php echo $selectedQuilos . " kg" ?? ""; ?>" />
			</div>
			<div>
				<label for="price">Unit price: </label>
				<input type="text" name="price" disabled="disabled" value="<?php echo number_format($price ?? 0.0, 2); ?>" />
			</div>
		</fieldset>
	</form>
</body>
</html>
