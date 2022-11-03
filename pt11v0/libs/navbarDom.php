<?php namespace practica\dom {
function mkNavDom(string $user = '', string $role = '', string $name = '', string $surname = ''): string {
	$register = mkMenu("Register", "register.php");
	$login = mkMenu("Login", "login.php");
	$logout = mkMenu("Logout", "logout.php");
	$home = mkMenu("Home", "index.php");
	$daymenu = mkMenu("Day Menu", "menus/daymenu.php");
	$viewmenu = mkMenu("View Menus", "menus/viewmenus.php");
	$admmenus = mkMenu("Admin Menus", "menus/adminmenus.php");
	$admusers = mkMenu("Admin Users", "menus/adminusers.php");
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

function mkMenu(string $title, string $href): string {
	return "<li><a href=$href>$title</a></li>";
}
} ?>
