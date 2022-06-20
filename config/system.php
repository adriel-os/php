<?php
class config_System
{

    private static $instance;

    public static function getConfig()
	{
        if (!isset(self::$instance))
		{
			self::$instance['charset'] 	= 'utf-8';
			self::$instance['secret'] 	= "dowjd8wd83jd3*jeoc@3d#hce%co920dc";
            self::$instance['locale']   = 'pt-br';
        }
        return self::$instance;
    }
	
}
