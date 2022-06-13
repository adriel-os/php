<?php

class Auth implements Auth_Interface {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }

    public function write(Auth_Adapter_Abstract $adapter) {
        if ($adapter->autenticate()) {
            $_SESSION['Auth']['autenticate'] = true;
            $_SESSION['Auth']['login'] = $adapter->getUser();
			$_SESSION['Auth']['id'] = $adapter->dados['id'];
			$_SESSION['Auth']['nome'] = ucwords($adapter->dados['nome']);
            return true;
        }
        else
            return false;
    }

    public function isLogged() {
        if (isset($_SESSION['Auth']['autenticate']))
            return true;
        else
            return false;
    }

    public function logout() {
        unset($_SESSION['Auth']);   
    }

}