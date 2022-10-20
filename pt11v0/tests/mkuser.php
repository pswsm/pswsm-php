<?php
require_once "/home/pswsm/code/pswsm-php/pt11v0/libs/login.php";
use practica\login as login;

$mkUser = login\userMake("pswsm1", "1234", "pau", "figueras", db: "/home/pswsm/code/pswsm-php/pt11v0/tests/test_db.txt");

if ($mkUser == 0) {
	echo "User created ok";
} else {
	echo "could not create user";
}

?>
