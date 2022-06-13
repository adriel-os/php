<?php

interface Auth_Interface {

    public function write(Auth_Adapter_Abstract $adapter);
    public function isLogged();
    public function logout();


}