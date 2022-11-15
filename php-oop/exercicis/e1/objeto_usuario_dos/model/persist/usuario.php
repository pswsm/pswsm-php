<?php

class User{
    protected $username;
    protected $password;

    public function __construct($username,$password){
        $this->username=$username;
        $this->password=$password;
    }

    public function getusername(){
        return $this->username;
    }

    public function getpassword(){
        return $this->password;
    }

    public function setusername($username) {
        $this->username = $username;
    }

    public function setpassword($password) {
        $this->password = $password;
    }

    public function __toString() {
        return sprintf("%s{[username:%s][password:%s]}", get_class($this), $this->username, $this->password);
    }
}