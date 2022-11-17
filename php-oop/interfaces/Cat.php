<?php namespace oop\animals {
require_once "./animal.php";
use oop\animals\Animal;

class Cat extends Animal {
	public function __construct(string $name, private int $cuteness) {
		parent::__construct($name);
		$this->cuteness = $cuteness;
	}

	public function sound() {
		echo "bup!";
	}

	public function getCuteness() {
		return $this->cuteness;
	}

	public function __toString() {
		return sprintf("{Name: %s, Cuteness Level: %d}", $this->getName, $this->getCuteness());
	}
}

} ?>
