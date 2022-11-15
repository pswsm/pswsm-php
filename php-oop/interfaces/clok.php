<?php namespace oop\clock {
require_once "./interfaces.php";
use oop\interfaces\Speaker;

class Clock implements Speaker {
	public function sound() {
		echo "Tic-Tac";
	}
}

} ?>
