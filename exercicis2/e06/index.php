<?php
require_once 'lib/fnDrinks.php';
require_once 'lib/fnHtmlDom.php';

use pswsm\patates;
use pswsm\patates_dom;

//initialize variables
$error = "";
//get data sent from form
if (filter_has_var(INPUT_POST, 'btnSubmit')) { //assess that form has been sent
    //get selected drink from data sent by form
	$selectedQuilos = trim(filter_input(INPUT_POST, 'quilos', FILTER_SANITIZE_NUMBER_INT));
    try {
        //get drink price from array of data
        $price = patates\getPatatesPrice($selectedQuilos);
    } catch (\Exception $ex) { //catch error when drink name is not found
        $error = "pes $selectedQuilos: not found";
        $price = 0.0;
    }
} else {
    $selectedQuilos = "";
    $price = 0.0;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Patates</title>
        <link rel="stylesheet" href="css/drinks.css" />
    </head>
    <body>
        <h2>Demana Patates</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset>
                <legend>Order your patates here</legend> 
                <div>
                    <label for="quilos">Quilos de patates:</label><br>
                    <!-- write a selector for drinks -->
                    <?php
                    //get all drink names
                    $preus = patates\getPatates();
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
        <?php if (isset($error) && strlen($error)>0) : ?>
        <p class="error"><?php echo $error ?? "";?></p>
        <?php endif; ?>
    </body>
</html>
