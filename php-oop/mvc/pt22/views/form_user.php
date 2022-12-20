<?php
	$user = $params['user']??null;  //?? is the 'null coalescing operator'.
	$action = $params['action']??"findItem";
	$result = $params['result']??null;
	if (is_null($user)) {
		$user = new User(0, "");
	}
	$disable = (($action == "findItem")||($action == "itemForm"))?"disabled":"";
	if (!is_null($result)) {
		echo <<<EOT
			<div>
				<p class="alert">$result</p>
			</div>
		EOT;
	} 
?>
<form id="item-form" method="post" action="edituser">
	<label for="id">Id: </label>
	<input type="text" name="id" id="id" placeholder="enter id" value="<?php echo (isset($user)) ? $user->getId() : ''; ?>" <?php echo (!isset($user)) ? 'disabled' : ''; ?>/>

	<label for="username">Username: </label>
	<input type="text" name="username" id="username" placeholder="enter username" value="<?php echo (isset($user)) ? $user->getUsername() : ''; ?>" <?php echo (isset($user)) ? 'disabled' : ''; ?>/>

	<label for="password">Password: </label>
	<input type="text" name="password" id="password" placeholder="enter password" value="<?php echo (isset($user)) ? $user->getPassword() : ''; ?>" <?php echo (isset($user)) ? 'disabled' : ''; ?>/>

	<label for="role">Role: </label>
	<input type="text" name="role" id="role" placeholder="enter role" value="<?php echo (isset($user)) ? $user->getRole() : ''; ?>" <?php echo (isset($user)) ? 'disabled' : ''; ?>/>

	<label for="name">Name: </label>
	<input type="text" name="name" id="name" placeholder="enter name" value="<?php $user->getName() ?>" <?php echo (isset($user)) ? 'disabled' : ''; ?>/>

	<label for="surname">Surname: </label>
	<input type="text" name="surname" id="surname" placeholder="enter surname" value="<?php $user->getSurname() ?>" <?php echo (isset($user)) ? 'disabled' : ''; ?>/>

	<button type="button" id="findUser" name="findUser">Find</button>
	<button type="button" id="modifyUser" name="modifyUser">Modify</button>
	<button type="button" id="removeUser" name="removeUser">Remove</button>
	<button type="reset">Reset</button>
</form>
