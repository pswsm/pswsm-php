<?php namespace oop\animals {
require_once "./interfaces.php";
use oop\interfaces\Speaker;

abstract class Animal implements Speaker {
	public abstract function sound();
}
} ?>
