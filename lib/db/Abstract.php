<?php

abstract class Db_Abstract {

    protected $id = null;
    protected $_table = null;

    public function __construct(array $options = null) {
        if (count($options))
            $this->setOptions($options);
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods))
                $this->$method($value);
        }
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if (!is_null($this->id)) {
            throw new Exception('ID nao pode ser alterado');
        }
        $this->id = (int) $id;
        return $this;
    }

    abstract protected function _insert();

    abstract protected function _update();

    public function save() {
        if (is_null($this->getId())) {
            $res = $this->_insert();
            if ($res) {
                
                $this->setId($this->getDb()->lastInsertId());
                return $this->getId();
            }
        }
        else
            return $this->_update();
    }

    public function fetchAll() {
        $db = $this->getDb();
        $stm = $db->prepare("select * from " . $this->_table);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find() {
        $db = $this->getDb();
        $stm = $db->prepare("select * from " . $this->_table . ' where id=:id');
        $stm->bindValue(':id', $this->getId());
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function delete() {
        $db = $this->getDb();
        $stm = $db->prepare("delete from " . $this->_table . ' where id=:id');
        $stm->bindValue(':id', $this->getId());
        return $stm->execute();
    }

    public function getDb() {
        global $config;
        return API_Db_Connection::factory($config);
    }
	public function select($sql) {
        $db = $this->getDb();
        $stm = $db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}