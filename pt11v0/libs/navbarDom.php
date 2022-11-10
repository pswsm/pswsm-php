<?php namespace practica\dom {
/*
 * Makes the navbar according to bootstrap and how it was originally
 *
 * @param string $user The user
 * @param string $role The role of the user
 * @param string $name The name of the user
 * @param string $surname The surname of the user
 * @return string The dom for the navbar
 */
function mkNavDom(string $user = '', string $role = '', string $name = '', string $surname = ''): string {
	$register = mkMenu("Register", "register.php");
	$login = mkMenu("Login", "login.php");
	$logout = mkMenu("Logout", "logout.php");
	$home = mkMenu("Home", "index.php");
	$daymenu = mkMenu("Day Menu", "daymenu.php");
	$viewmenu = mkMenu("View Menus", "viewmenus.php");
	$admmenus = mkMenu("Admin Menus", "adminmenus.php");
	$admusers = mkMenu("Admin Users", "adminusers.php");
	$persinfo = "$name $surname";
	$userinfo = "Logged in as: $user.";
	$roleinfo = "You are: $role";
	switch ($role) {
		case 'registered':
			$nav = "<ul class='nav navbar-nav'>$home$daymenu$viewmenu$logout</ul><p class='navbar-text navbar-right'>$persinfo<br>$userinfo</p><p class='navbar-text navbar-right'>$roleinfo</p>";
			break;
		
		case 'staff':
			$nav = "<ul class='nav navbar-nav'>$home$daymenu$viewmenu$admmenus$logout</ul><p class='navbar-text navbar-right'>$persinfo<br>$userinfo</p><p class='navbar-text navbar-right'>$roleinfo</p>";
			break;
		
		case 'administrator':
			$nav = "<ul class='nav navbar-nav'>$home$daymenu$viewmenu$admmenus$admusers$logout</ul><p class='navbar-text navbar-right'>$persinfo<br>$userinfo</p><p class='navbar-text navbar-right'>$roleinfo</p>";
			break;
		
		default:
			$home = mkMenu("Home", "index.php");
			$daymenu = mkMenu("Day Menu", "menus/daymenu.php");
			$nav = "<ul class='nav navbar-nav'>$home$daymenu$register$login</ul><p class='navbar-text navbar-right'>Not logged in</p>";
			break;
	}
	return $nav;
}

/*
 * Makes a clickable menu for the navbar
 *
 * @param string $title The title of the menu
 * @param string $href Where the link points to
 * @return string The DOM for a single menu
 */
function mkMenu(string $title, string $href): string {
	return "<li><a href=$href>$title</a></li>";
}
} ?>
