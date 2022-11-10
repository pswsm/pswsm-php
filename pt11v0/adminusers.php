<?php
session_start();
$allowedRoles = ["administrator"];
if (!(in_array($_SESSION["role"], $allowedRoles))) {
	header("location: error.php");
}
$user = $_SESSION['user'];
$role = $_SESSION['role'];
$name = $_SESSION['name'];
$surn = $_SESSION['surname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Users</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/main.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once("./topmenu.php") ?>
	<h1>Welcome to the Admin Menus!</h1>
	<p>Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.</p>
</body>
</html>
