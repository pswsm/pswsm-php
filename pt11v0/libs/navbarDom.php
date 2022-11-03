<?php namespace practica\dom {
function mkNavDom(string $user, string $role, string $name, string $surname): string {
	$persinfo = "$name $surname";
	$userinfo = "Logged in as: $user.";
	$roleinfo = "You are: $role";
	return "<p>$persinfo<br>$userinfo<br>$roleinfo</p>";
}
} ?>
