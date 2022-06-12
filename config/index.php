<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
set_include_path("../../../" . PATH_SEPARATOR ."../../"  . PATH_SEPARATOR ."../" . PATH_SEPARATOR . "../config/" . PATH_SEPARATOR ."../../config/" . PATH_SEPARATOR ."../lib/" . PATH_SEPARATOR ."../../lib/" . PATH_SEPARATOR ."../lib/" . PATH_SEPARATOR . "lib/" . PATH_SEPARATOR . "../lib/Db/" . PATH_SEPARATOR . "Controllers/" . PATH_SEPARATOR . "config/" . PATH_SEPARATOR . get_include_path());
session_start();

require_once 'loader.php';

$db = Db_Connection::factory(config_Database::getConfig());

var_dump($db);