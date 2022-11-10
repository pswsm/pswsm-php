<?php namespace practica\dom {
/*
 * Makes the DOM for the register page responses
 *
 * @param string $username The username to register
 * @param int $regRetCode The return code of the register function
 * @return string The dom for the given return code
 */
function domRegistered(string $username, int $regRetCode): string {
	$dom = "";
	switch ($regRetCode) {
		case 0:
			$dom = "<p>User $username registered correctly. You may login now.</p>";
			break;

		case 1:
			$dom = "<p>User $username already exists.</p>";
			break;

		case 2:
			$dom = "<p>Database not available. Our technicians are fixing it, please try again later<p>";
			break;

		default:
			$dom = "<p>Something went wrong, try again later.";
			break;
	}
	return $dom;
}
} ?>
