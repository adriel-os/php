<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
set_include_path("../" . PATH_SEPARATOR ."../lib/" . PATH_SEPARATOR . "lib/Auth/". PATH_SEPARATOR . "lib/" . PATH_SEPARATOR . "../lib/Db/" . PATH_SEPARATOR . "Controllers/" . PATH_SEPARATOR . "config/" . PATH_SEPARATOR . get_include_path());
session_start();

require_once 'Loader.php';
require_once 'Router.php';

// instanciando as rotas
$rotas = new Router($_SERVER);

//var_dump($db);