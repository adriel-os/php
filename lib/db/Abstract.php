<?php
// classe para tratar comportamentos gerais da conexão com o banco
abstract class Db_Abstract {

    protected $id = null;
    protected $_table = null;

    public function __construct(array $options = null) {
        if (count($options))
            $this->setOptions($options);
    }
    
    public function getDb() {
        global $config;
        return API_Db_Connection::factory($config);
    }

    function get_tables()
    {
        $sql = "SELECT table_name
        FROM information_schema.tables
        WHERE table_schema= 'public'
        AND table_type='BASE TABLE'";
    }

}