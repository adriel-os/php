<?php
$auth = Auth::getInstance();
//var_dump($_SERVER);
    if(isset($_POST['login']) and isset($_POST['password']))
    {

        // Realizar login Aqui
        $authAdapter = new Auth_Adapter_Db();
        $authAdapter->setUser($_POST['login']);
        $authAdapter->setPassword($_POST['password']);

        if($authAdapter->autenticate())
        {
            //se der certo então grava em $_SESSION
            $auth->write($authAdapter);
            require_once 'view/home.php';
            die();
        }
        else
        {
            $err = array('msg'=>'Usuário ou senha invalidos!');
            require_once 'view/login.php';
        }
    }