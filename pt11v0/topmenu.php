<?php
require_once "libs/navbarDom.php";
use practica\dom as dom;
?>
<nav class="navbar navbar-default">
<div class="container col-md-10">
<div class="navbar-header">
<a class="navbar-brand" href="https://www.proven.cat">ProvenSoft</a>
</div>
<?php
echo dom\mkAvailMenus($role);
?>
<?php
if (isset($user, $name, $role, $surn)) {
	echo dom\mkNavDom($user, $role, $name, $surn);
} else {
	echo dom\mkNavNotLogged();
}
?>
</div>
</nav>
