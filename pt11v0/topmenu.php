<?php
require_once "libs/navbarDom.php";
use practica\dom as dom;
?>
<nav class="navbar navbar-default">
<div class="container col-md-10">
<div class="navbar-header">
<a class="navbar-brand" href="https://www.proven.cat">ProvenSoft</a>
</div>
<ul class="nav navbar-nav">
<li><a href='index.php'>Home</a></li>
<li><a href='daymenu.php'>Day Menu</a></li>
<li><a href='register.php'>Register</a></li>
<li><a href='login.php'>Login</a></li>
<?php
if (isset($user)) {
	echo "<li><a href='logout.php'>Logout</a></li>";
}
?>
</ul>
<?php 
if (isset($user, $name, $role, $surn)) {
	echo dom\mkNavDom($user, $role, $name, $surn);
} else {
	echo "Not logged in.";
}
?>
</div>
</nav>
