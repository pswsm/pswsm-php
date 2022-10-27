<?php namespace practica\dom {
/*
 * This functions return a string, it being the DOM of the user info when logged in
 *
 * @param $user		string The username
 * @param $role		string The role of the user
 * @param $name		string The name  of the user
 * @param $surname 	string The surname of the user
 * @return 			string The dom with a generated list for a bootstrap 3.4.1 navbar, aligned to the right.
 */
function mkNavDom(string $user, string $role, string $name, string $surname): string {
	$persinfo = "$name $surname";
	$userinfo = "Logged in as: $user.";
	$roleinfo = "You are: $role";
	return "<ul class='navbar-right nav navbar-nav'><li><p class='navbar-text'>$persinfo<br>$userinfo</p></li><li><p class='navbar-text'>$roleinfo</p></li></ul>";
}

function mkMenu(string $menuName, string $href): string {
	return "<li><a href=$href>$menuName</a></li>";
}

function mkAvailMenus(?string $role): string {
	if (is_null($role)) {
		$role = '';
	}
	switch ($role) {
		case 'registered':
			$menus = array(
				mkMenu("Home", "./index.php"),
				mkMenu("Day Menu", "./menus/daymenu.php"),
				mkMenu("View Menus", "./menus/viewmenus.php"),
				mkMenu("Logout", "./logout.php")
			);
			break;
		
		case 'staff':
			$menus = array(
				mkMenu("Home", "./index.php"),
				mkMenu("Day Menu", "./menus/daymenu.php"),
				mkMenu("View Menus", "./menus/viewmenus.php"),
				mkMenu("Admin Menus", "./menus/adminmenu.php"),
				mkMenu("Logout", "./logout.php")
			);
			break;
		
		case 'administrator':
			$menus = array(
				mkMenu("Home", "./index.php"),
				mkMenu("Day Menu", "./menus/daymenu.php"),
				mkMenu("View Menus", "./menus/viewmenus.php"),
				mkMenu("Admin Menus", "./menus/adminmenu.php"),
				mkMenu("Admin Users", "./menus/adminusers.php"),
				mkMenu("Logout", "./logout.php")
			);
			break;
		
		default:
			$menus = array(
				mkMenu("Home", "./index.php"),
				mkMenu("Day Menu", "./menus/daymenu.php"),
				mkMenu("Register", "./register.php"),
				mkMenu("Login", "./login.php")
			);
			break;
	}
	$domMenus = "<ul class='nav navbar-nav'>" . implode('', $menus) . "</ul>";
	return $domMenus;
}

/*
 * This functions makes the dom for when the user is not logged in
 *
 * @return string 	The DOM with a list for a bootstrap 3.4.1 navbar, aligned to the right.
 */
function mkNavNotLogged(): string {
	return "<ul class='navbar-right nav navbar-nav'><li><p class='navbar-text'>Not logged in.</p></ul>";
}
} ?>
