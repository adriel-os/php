<?php

class Db_Connection {

    public static function factory($adapter = array('adapter'=>'postgre')) 
    {
        switch ($adapter['adapter']) 
		{
			case "postgres":
            case "postgre":
            case "pgsql":
				return Db_Adapter_Postgre::getConnection();
            break;
        }
    }

}