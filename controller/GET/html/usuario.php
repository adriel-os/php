<?php
echo 'Model Usuario';

$usuario = new Model_Usuario();
//$usuario->id=19;
$usuario->populate(array('nome', 'login', 'senha'));
echo '<pre>';
//var_dump($usuario);
echo '</pre>';
var_dump($usuario->update());

echo '<pre>';
$usuario->delete();
echo '</pre>';