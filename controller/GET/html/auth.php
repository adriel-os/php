<?php

$auth = Auth::getInstance();

if($auth->isLogged())
{
    header("location: /usuario");
}
else
{  
    new view_default_auth();
}
