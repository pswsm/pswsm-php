<?php
require_once "./libs/menuviewer.php";
use practica\dom as dom;
session_start();
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$role = $_SESSION['role'];
	$name = $_SESSION['name'];
	$surn = $_SESSION['surname'];
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DAWBI-M07-Pt11</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container-fluid">
        <?php include_once "./topmenu.php";?>
        <div class="container">
        <h2>Day menu</h2>
		<?php echo dom\mkDayMenu(db: "./db/daymenu.txt") ?>
        </div>
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>
