<?php
$auth = Auth::getInstance();
if($auth->isLogged())
{
    $auth->logout();
    new view_default_auth(['msg'=>'Você fez logoff!']);
}
else
{  
   new view_default_auth(array('msg'=>'Você precisa estar logado para sair!'));
}

