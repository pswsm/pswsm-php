<?php namespace oop\user {
class User {

	public function __construct(private string $username, private string $password) {
		$this->username = $username;
		$this->password = $password;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setUsername(string $username) {
		$this->username = $username;
	}

	public function setPassword(string $password) {
		$this->password = $password;
	}

	public function __toString() {
		return sprintf("{Username: %s, Password: %s}", $this->username, $this->password);
	}
}
} ?>
