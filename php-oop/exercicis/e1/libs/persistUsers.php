<?php namespace oop\persisUsers {
include_once "./libs/userClass.php";
use oop\user\User;
class UPersists {

	public function __construct(private ?string $file = null, private ?string $sep = null) {
		$this->file = $file;
		$this->sep = $sep;
	}

	public function getFile(): string {
		return $this->file;
	}

	public function getSep():string {
		return $this->sep;
	}

	public function setFile(string $file) {
		$this->file = $file;
	}

	public function setSep(string $sep) {
		$this->sep = $sep;
	}

	public function countUsers(): int {
		$result = 0;
		if (is_readable($this->file)) {
			$lines = file($this->file, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
			if ($lines != false) {
				$result = count($lines);
			}
		}
		return $result;
	}

	public function readAllUsers(): array {
		$result = array();
		if (is_readable($this->file)) {
			$fh = fopen($this->file, 'r');
			if ($fh != false) {
				while (!feof($fh)) {
					$line = fgetcsv($fh, separator: $this->sep);
					if ($line != false) {
						if (count($line) == 2) {
							$uname = $line[0];
							$passw = $line[1];
							array_push($result, new User($uname, $passw));
						}
					}
				}
			}
			fclose($fh);
		}
		return $result;
	}
}
} ?>
