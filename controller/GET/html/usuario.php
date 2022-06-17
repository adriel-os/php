<?php
echo 'Model Usuario';

$usuario = new Model_Usuario();
$usuario->id=19;

echo '<pre>';
//var_dump($usuario);
echo '</pre>';
var_dump($usuario->update());

echo '<pre>';
$usuario->delete();
echo '</pre>';