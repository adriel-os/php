<?php

function classLoader($class_name) 
{
    if(strpos($class_name, '_') !== false)
        $class_name = str_replace("_", "/", $class_name).".php";
    else
        $class_name = $class_name.'.php';
	
    require_once $class_name;
}

spl_autoload_register('classLoader')

?>