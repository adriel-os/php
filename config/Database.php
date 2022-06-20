<?php
class config_Database
{

    private static $instance;

    public static function getConfig()
	{
        if (!isset(self::$instance))
		{
			self::$instance['adapter'] 		= "postgres";
			self::$instance['hostname'] 	= "localhost";
			self::$instance['dbname']		= "entregas";
			self::$instance['user']			= "postgres";
			self::$instance['password']		= "postgres";
			self::$instance['tabela_usuario'] 	='usuarios';
			self::$instance['tabela_usuario_loginField'] = 'login';
			self::$instance['tabela_usuario_passwordField'] = 'senha';
         
        }
        return self::$instance;
    }
	
}
