<form action="index.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="usernameadd">Username:</label>
        <input type="text" class="form-control" id="usernameadd" placeholder="Enter username" name="usernameadd" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="passwordadd">Password:</label>
        <input type="password" class="form-control" id="passwordadd" placeholder="Enter password" name="passwordadd" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nameadd">Name:</label>
        <input type="text" class="form-control" id="nameadd" placeholder="Enter name" name="nameadd" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="surnameadd">Surname:</label>
        <input type="text" class="form-control" id="surnameadd" placeholder="Enter surname" name="surnameadd" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="idadd">ID:</label>
        <input type="number" class="form-control" id="idadd" placeholder="Enter id" name="idadd" required>
    </div>
    <button type="submit" name="action" value="user/add">Add user</button>
</form>

<form method="POST" action="index.php">
<div class="form-group">
	<label for="id">ID:</label>
	<input type="number" name="id" id="id" placeholder="enter id" value="<?php echo (isset($params['user'])) ? $params['user']->getId() : 0; ?>" <?php echo (isset($params['user'])) ? 'readonly' : ''; ?>/>
</div>
<div class="form-group">
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" placeholder="enter username" value="<?php echo (isset($params['user'])) ? $params['user']->getUsername() : ''; ?>" <?php echo (!isset($params['user'])) ? 'disabled' : ''; ?>/>
</div>
<div class="form-group">
	<label for="password">Password:</label>
	<input type="text" name="password" id="password" placeholder="enter password" value="<?php echo (isset($params['user'])) ? $params['user']->getPassword() : ''; ?>" <?php echo (!isset($params['user'])) ? 'disabled' : ''; ?>/>
</div>
<div class="form-group">
	<label for="role">Role: </label>
	<input type="text" name="role" id="role" placeholder="enter role" value="<?php echo (isset($params['user'])) ? $params['user']->getRole() : ''; ?>" <?php echo (!isset($params['user'])) ? 'disabled' : ''; ?>/>
</div>
<div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" placeholder="enter name" value="<?php echo (isset($params['user'])) ? $params['user']->getName() : ''; ?>" <?php echo (!isset($params['user'])) ? 'disabled' : ''; ?>/>
</div>
<div class="form-group">
	<label for="surname">Surname:</label>
	<input type="text" name="surname" id="surname" placeholder="enter surname" value="<?php echo (isset($params['user'])) ? $params['user']->getSurname() : ''; ?>" <?php echo (!isset($params['user'])) ? 'disabled' : ''; ?>/>
</div>
<div class="form-group">
	<button type="submit" name="action" value='user/find'>Find</button>
	<button type="submit" name='action' value='user/modify'>Modify</button>
	<button type="submit" name="action" value="user/remove">Remove</button>
	<button type="reset">Reset</button>
</div>
</form>

<?php
$result = $params['result']??null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
} 
?>
