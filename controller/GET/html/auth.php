<?php

$auth = Auth::getInstance();


if(isset($_GET['logout']) and $_GET['logout'] == 'true')
{
    $auth->logout();
    require_once 'view/login.php';
}

if($auth->isLogged())
{
  
    require_once 'view/home.php';
}
else
{  
    require_once 'view/login.php';
}
