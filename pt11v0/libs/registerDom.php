<?php namespace practica\dom {
function domRegistered(string $username, int $regRetCode): string {
	echo "fn start ok";
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
