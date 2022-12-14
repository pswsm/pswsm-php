<?php
require_once "./libs/userlib.php";
require_once "./libs/loginDom.php";
use practica\login as login;
use practica\dom as dom;

session_start();
if (filter_has_var(INPUT_POST, "loginsubmit")) {
	$username = htmlspecialchars(trim($_POST["username"]));
	$uAuth = login\userAuth(
		$username,
		htmlspecialchars($_POST["password"]),
		db: "./db/users.txt"
	);
	$dom = dom\mkLogin($uAuth, login\getRole($username));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once "./topmenu.php" ?>
<div class="container-fluid">
  <h2>Login form</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="username">Email:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" name="loginsubmit" class="btn btn-default">Submit</button>
  </form>
  <p><?php if (isset($dom)) { echo $dom; }; ?></p>
</div>
</body>
</html>
