<?php namespace practica\tests {
require_once "/home/pswsm/code/pswsm-php/pt11v0/libs/userlib.php";
use practica\login as login;

function test_unexistiting_user() {
	echo "Test with incorrect user:\n";
	$user = login\userAuth("pswsm-test", "1234", db: "/home/pswsm/code/pswsm-php/pt11v0/tests/test_db.txt");

	switch ($user) {
		case 0:
			printf("Code %d. Login OK.\n", $user);
			break;

		case 1:
			printf("Code %d. Username not found.\n", $user);
			break;
		
		case 2:
			printf("Code %d. Password incorrect.\n", $user);
			break;
		
		case 3:
			printf("Code %d. Could not contact database.\n", $user);
			break;
		
		default:
			printf("Unexpected return value.\n");
			break;
	}
}

function test_existiting_user() {
	echo "Test with existing user:\n";
	$user = login\userAuth("pswsm", "1234", db: "/home/pswsm/code/pswsm-php/pt11v0/tests/test_db.txt");

	switch ($user) {
		case 0:
			printf("Code %d. Login OK.\n", $user);
			break;

		case 1:
			printf("Code %d. Username not found.\n", $user);
			break;
		
		case 2:
			printf("Code %d. Password incorrect.\n", $user);
			break;
		
		case 3:
			printf("Code %d. Could not contact database.\n", $user);
			break;
		
		default:
			printf("Unexpected return value.\n");
			break;
	}
}

test_existiting_user();
test_unexistiting_user();

} ?>
