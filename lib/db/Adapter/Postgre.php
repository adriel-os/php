<?php

class Db_Adapter_Postgre implements Db_Adapter_Interface {

    private static $instance;

    public static function getConnection() 
	{
        if (!isset(self::$instance)) 
		{
			$config	=config_Database::getConfig();
			
            $dsn = 'pgsql' . ":host=" . $config['hostname'] . ";dbname=" . $config['dbname'];
            try 
			{
                
                //echo $dsn . $config['user'] . $config['password'] ;
				self::$instance = new PDO($dsn, $config['user'], $config['password']);
            } 
			catch (PDOException $e)
			{
                
				die($e->getMessage());
            }
        }
        return self::$instance;
    }
}