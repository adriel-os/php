<?php

//  autoloder pattern para classes 
//  nome da classe deve conter o mesmo
//  mapeamento da pasta e nome do aquivo
//  A classe "Model_Usuario" é igual a "model/usuario.php"

function classLoader($class_name) 
{
    if(strpos($class_name, '_') !== false)
        $class_name = str_replace("_", "/", $class_name).".php";
    else
        $class_name = $class_name.'.php';
	
    require_once $class_name;
}

spl_autoload_register('classLoader');

?>