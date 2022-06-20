<?php

class Language{

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Language();
        }
        return self::$instance;
    }

    function setup_locale()
    {
        
    }

}