<?php
require_once "/home/pswsm/code/pswsm-php/pt11v0/libs/userlib.php";
use practica\login as login;

$mkUser = login\userMake("pswsm1", "1234", "pau", "figueras", db: "/home/pswsm/code/pswsm-php/pt11v0/tests/test_db.txt");

switch ($mkUser) {
	case 0:
		echo "User created successfully.\n";
		break;
	
	case 1:
		echo "User already exists.\n";
		break;
	
	case 2:
		echo "Could not connect to DB.\n";
		break;
	
	default:
		echo "Something went terribly wrong.\n";
		break;
}

?>
