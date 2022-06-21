<?php

abstract class Auth_Adapter_Abstract {

    protected $user = null;
    protected $password = null;

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
		$no_chars = array("!", "/'", '"', ".", "-", " ", "&", ";", "%", "|");
		$user=str_replace($no_chars, '', $user);
        $this->user = $user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($senha) {
		$no_chars = array("!", "/'", '"', ".", "-", " ", "&", ";", "%", "|");
		$senha=str_replace($no_chars, '', $senha);
        $this->password = sha1($senha);
    }

    abstract public function autenticate();

}