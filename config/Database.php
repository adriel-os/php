<?php
class config_Database
{

    private static $instance;

    public static function getConfig()
	{
        if (!isset(self::$instance))
		{
			self::$instance['adapter'] 		= "postgres";
			self::$instance['hostname'] 	= "ipg03.aws.itarget.com.br";
			self::$instance['dbname']		= "icaseweb_asbran";
			self::$instance['user']			= "postgres";
			self::$instance['password']		= "e0Oq4BibnDpb5IbLrCl5";
			self::$instance['tabela_usuario'] 	='usuarios';
			self::$instance['tabela_usuario_loginField'] = 'login';
			self::$instance['tabela_usuario_passwordField'] = 'senha';
         
        }
        return self::$instance;
    }
	
}
