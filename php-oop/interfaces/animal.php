<?php namespace oop\animals {
require_once "./interfaces.php";
use oop\interfaces\Speaker;

abstract class Animal implements Speaker {

	public function __construct(private string $name = null) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public abstract function sound();
}
} ?>
