<?php namespace oop\user {
class User {

	public function __construct(private string $username, private string $password, private string $pname, private string $surname) {
		$this->username = $username;
		$this->password = $password;
		$this->pname = $pname;
		$this->surname = $surname;
	}

	public function getUsername() {
		return $this->username;
	}
}
} ?>
