<?php

class Auth_Adapter_Db extends Auth_Adapter_Abstract {

    private $db_user_field = null;
    private $db_password_field = null;
    private $table = null;
    private $db = null; //conexao
	public $dados=null;

    public function __construct() 
    {
        $this->db = Db_Connection::factory(config_Database::getConfig());
        $this->setTable(config_Database::getConfig()['tabela_usuario']);
        $this->db_user_field = config_Database::getConfig()['tabela_usuario_loginField'];
        $this->db_password_field = config_Database::getConfig()['tabela_usuario_passwordField'];
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable($table) {
        $this->table = $table;
        return $this;
    }

    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
        return $this;
    }

    public function autenticate() {
        $sql = "select *
        from 
        {$this->table} a 
        where 
        {$this->db_user_field} = '{$this->user}' and 
        {$this->db_password_field} = '{$this->password}';";

        $stm = $this->db->prepare($sql);

        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        if($result != false and count($result) > 1)
		{
			$this->dados=$result;
            return true;
		}
        else
            return false;
    }

}