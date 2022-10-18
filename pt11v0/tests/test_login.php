<?php
require_once "../libs/practica.php";
use practica as pt;

$user = pt\userAuth("pswsm-test", "1234", "./test_db.txt");
if ($user == 1) {
	printf("%s", "Could not create user");

}
?>
