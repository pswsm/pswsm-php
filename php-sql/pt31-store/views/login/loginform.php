<?php
$disabled = (isset($_SESSION['username'])) ? 'disabled' : '' ;
echo ($disabled === 'disabled') ? 'Already loggged in!' : '';
echo <<<EOT
<h1>Login Page</h1>
<form method='POST' action="index.php">
	<div class="form-group col-sm-6 mt-4">
		<label class="form-label" for="username">Username:</label>
		<input class="form-control" type="text" name="username" placeholder="Username">
	</div>
	<div class="form-group col-sm-6 mt-4">
		<label class="form-label" for="password">Password:</label>
		<input class="form-control" type="password" name="password" placeholder="Password">
	</div>
	<div class="form-group mt-4">
		<button class="btn btn-outline-primary" type="submit" name="action" value="login" {$disabled}>Log In</button>
		<button class="btn btn-outline-danger" type="reset">Reset form</button>
	</div>
</form>
EOT;
if (isset($params['message'])) {
	$msg = $params['message'];
	echo "<p>$msg!</p>";
}
