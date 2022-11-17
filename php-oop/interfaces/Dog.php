<?php namespace oop\animals {
require_once "./animal.php";
use oop\animals\Animal;

class Dog extends Animal {
	public function __construct(string $name, private string $color) {
		parent::__construct($name);
		$this->color = $color;
	}

	public function sound() {
		echo "bup!";
	}

	public function getColor() {
		return $this->color;
	}

	public function __toString() {
		return sprintf("{Name: %s, Color: %s}", $this->getName, $this->getColor());
	}
}

} ?>
