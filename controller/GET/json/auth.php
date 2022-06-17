<?php

$auth = Auth::getInstance();


if(isset($_GET['logout']) and $_GET['logout'] == 'true')
{
    $auth->logout();
    echo json_encode(array('logged'=>false, 'msg'=>'Usuário realizou logout'));
}

if($auth->isLogged())
{
  
    echo json_encode($authAdapter->dados);
    return true;
}
else
{
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
            echo json_encode($authAdapter->dados);
            return true;
        }
        else
        {
            echo json_encode(array('logged'=>false, 'msg'=>'usuário ou senha invalidos.'));
            return false;
        }
    }
    echo json_encode(array('logged'=>false, 'msg'=>'Parâmetros de login não localizados.'));
    return false;
}
