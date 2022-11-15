<?php 
define("USERFILE","files/users.txt");

require_once 'model/persist/usuario.php';
require_once 'model/persist/userpersist.php';

session_start();

$userPersist = new UserFilePersist("files/users.txt",";");
if(isset($_SESSION['userlist'])){
    $userlist = unserialize($_SESSION['userlist']);
}else{
    $userlist=array();
}
if(filter_has_var(INPUT_POST,"submit")){
    // reb la variable user del formulari
    $username = \filter_input(\INPUT_POST, 'username');
    
    // reb la variable pass del formulare
    $pass = \filter_input(\INPUT_POST, 'password');
    $user = new User($username,$pass);
    // $user_perisister = new UserFilePersist(USERFILE,";");
    $added = $user_perisister->addUser($user,"files/users.txt");
    if($added){
        printf("<p>si</p>");
    }else{
        printf("<p>no</p>");
    }
}else{
    $username = "";
    $pass = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 2</title>
</head>
<body>
<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
    <div>
        <label for="">Username</label>
        <div>
            <input type="text" id="username" name="username" value="<?php echo $username ?>">
        </div>
    </div>
    <div>
        <label for="">Password</label>
        <div>
            <input type="text" id="password" name="password" value="<?php echo $pass ?>">
        </div>
    </div>
    <div>
        <button type="submit" value ="sent" name="submit">Send</button>
    </div>
</form>
<h3>Current users</h3>
<ul>
    <?php 
    // to do read user list from file
    // $user_perisister = new UserFilePersist(USERFILE,";");
    $userlist = $user_perisister->readAllUser();
    echo "tienes ".count($userlist)." usuarios";
    foreach($userlist as $usuario){
        printf("<li>%s</li>",$usuario);
    }
    ?>
</ul>
<!-- <?php echo $userlist?> -->
</body>
</html>
