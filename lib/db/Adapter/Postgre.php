<?php

class API_Db_Adapter_Postgre implements API_Db_Adapter_Interface {

    private static $instance;

    public static function getConnection() 
	{
        if (!isset(self::$instance)) 
		{
			$config	=config_Database::getConfig();
			$opcoes = array(PDO::POSTGRES_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
            $dsn = $config['adapter'] . ":host=" . $config['hostname'] . ";dbname=" . $config['dbname'].';charset=UTF8';
            try 
			{
				self::$instance = new PDO($dsn, $config['user'], $config['password'],$opcoes);
            } 
			catch (PDOException $e)
			{
				die($e->getMessage());
            }
        }
        return self::$instance;
    }
}