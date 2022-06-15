<?php

$auth = Auth::getInstance();

if(isset($_GET['logout']) and $_GET['logout'] == 'true')
{
    $auth->logout();
    require_once 'view/login.php';
}
var_dump( $auth->isLogged());
if($auth->isLogged())
{
  
    require_once 'view/home.php';
}
else
{
    //var_dump($_SERVER);
    if(isset($_POST['login']) and isset($_POST['password']))
    {
        echo 'oko';
        // realizar login aqui
        $authAdapter = new Auth_Adapter_Db($db);
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
        }
    }
  
    require_once 'view/login.php';
}
