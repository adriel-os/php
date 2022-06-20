<?php
// Atenção: Não fazer funções de busca dentro do API_Model

abstract class Model_Abstract
{
	public $db;
	private $metodos;
    private $atributos;

	public function __construct() 
	{
		$this->db = Db_Connection::factory(config_Database::getConfig());
		$this->metodos = array_values(get_class_methods(get_called_class()));
        $this->atributos = array_keys(get_class_vars(get_called_class()));
    }
	
	function __set($attr, $valor)
    {
        switch($attr)
        {
            case 'id';
                if(!isset($this->id) and is_null($this->id))
                $this->getById($valor);
                else
                $this->id = $valor;
            break;
            default;
                $this->populate(array($attr=>$valor));
            break;
        }

    }

    function __get($attr)
    {
        return $this->{$attr};
    }

	function insert()
    {
        if(isset($this->id))
        {
            $this->msg[]=  'O ID do Objeto já está definido, não é possível fazer novo insert;';
            return false;
        }
        
        $campos = '';        
        $valores = ''; 
        foreach($this->atributos as $index => $attr)
        {
            if(in_array($attr, array('db', 'tabela', 'metodos', 'atributos', 'id')))
            continue;

            if($campos == '')
            {
                $campos = $attr;        
				if(is_integer($this->$attr))
				{
					$valores .=  $this->$attr;
				}
				else
				{      
					$valores .= "'".  $this->$attr ."'";
				}
            }
            else
            {
				$campos .= ', '. $attr;  

				if(is_integer($this->$attr))
				{
					$valores .= ', '.  $this->$attr;
				}
				else
				{      
					$valores .= ", '".  $this->$attr . "'";
				}
                
            } 
        }

        $sql = 'insert into '. $this->tabela . ' ('.$campos.') values ('.$valores.');';
        $query = $this->db->prepare($sql);
		

		//echo '</br>'. $sql .'</br>';
		$result = $query->execute();
		if($result)
		$this->id = $this->db->lastInsertId();
    }

	function update()
	{
		if(isset($this->id) and !is_null($this->id))
		{      
        	$valores = '';

        	foreach($this->atributos as $index => $attr)
        	{
            if(in_array($attr, array('db', 'tabela', 'metodos', 'atributos', 'id')))
            continue;

            if($valores == '')
            {
                        
				if(is_integer($this->$attr))
				{
					$valores .=  $attr .' = '. $this->$attr;
				}
				else
				{      
					$valores .= $attr . " = '".  $this->$attr ."'";
				}
            }
            else
            {
				if(is_integer($this->$attr))
				{
					$valores .= ', '. $attr  . ' = ' . $this->$attr;
				}
				else
				{      
					$valores .= ',' . $attr . " = '" .  $this->$attr . "'";
				}
            } 
       		}
		}
		else
		{
			$this->msg[]='Impossível realizar update de ' . $this->tabela . ' quando o ID não estiver setado.';
		}

		$sql = 'update ' . $this->tabela . ' set ' . $valores . ' where id = '. $this->id .';';
		$this->sql = $sql;

			$query = $this->db->prepare($sql);

            if($query->execute())
			{
				return true;
			}
			else
			{
				$this->msg[] = 'Erro ao realizar updade de ' . $this->tabela . ' id = '. $this->id;
			}
	}

	function delete()
	{
		if(isset($this->id) and !is_null($this->id))
		{      	

			$sql = 'delete from ' . $this->tabela . ' where id = '. $this->id .';';
			//echo $sql;
			$query = $this->db->prepare($sql);

            if($query->execute())
			{
				return true;
			}
			else
			{
				$this->msg[] = 'Erro ao realizar delete de ' . $this->tabela . ' id = '. $this->id;
			}
		}
	}
	
    function getById($id)
    {
        if($id != false and isset($id))
        {
            $sql = "Select * from {$this->tabela} where id='$id'";
            $query = $this->db->prepare($sql);

            $query->execute();
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$result = $query->fetchAll();
            $this->populate($result[0]);
			$this->id = $id;
        }
    }

	function populate($dataset)
    {
        foreach($this->atributos as $pos => $attr)
		{
            if(!isset($this->$attr))
            {
                if(isset($dataset[$attr]))
                {
                    $metodo = 'set_'.$attr;
                    //Se não tiver metodo "set_Nomedoatributo" implementado, então, aplicar o valor direto
                    if(in_array($metodo, $this->metodos))
                    {
						//echo $metodo;
                        $this->$metodo($dataset[$attr]);
                    }
                    else
                    $this->$attr=$dataset[$attr];
                }
                else
                {
					if($attr !== 'id')
					{
                    	// se não encontrar o atributo da classe no ArrayKey do dataset, então apresentar a mensagem.
                    	$this->msg[] =  '</br>O atributo "'.$attr.'" da Classe "'. get_called_class() .'", não foi encontrado no dataset.</br>';
					}
                }
             }
        }
    }
	############################################################
	# # FUNÇÕES Para Ajudar Validar tipos em comuns de dados # #
	############################################################


	public function dateToMysql($valor)
	{
		$valor = trim($valor);
		$valor = str_replace(array(' ', '-', '/','.'), "", $valor);
		$dia=substr ($valor , 0 , 2);
		$mes=substr ($valor , 2 , 2);
		$ano=substr ($valor , 4 , 4);
		
		return "{$ano}-{$mes}-{$dia}";
	}

	# getTimestamp
	public function getTimestamp($date)//converte dd/mm/yyyy em segundos desde unix epoch (January 1 1970 00:00:00 GMT)
	{
		$partes = explode('-', $date);
		return mktime(0, 0, 0, $partes[1], $partes[2], $partes[0]);
	}
	
	# dayMysql
	public function dayMysql($date)//converte dd/mm/yyyy em segundos desde unix epoch (January 1 1970 00:00:00 GMT)
	{
		$partes = explode('-', $date);
		return  $partes[2];
	}
	
	# yearMysql
	public function yearMysql($date)//converte dd/mm/yyyy em segundos desde unix epoch (January 1 1970 00:00:00 GMT)
	{
		$partes = explode('-', $date);
		return  $partes[0];
	}
	
	# monthMysql
	public function monthMysql($date)//converte dd/mm/yyyy em segundos desde unix epoch (January 1 1970 00:00:00 GMT)
	{
		$partes = explode('-', $date);
		return  $partes[1];
	}
	
	# dateToDays
	public function dateToDays($valor)
	{
		$valor = $this->getTimestamp($valor);
		return ($valor/(60*60*24));
	}
	
	# segundosEmHoras
	function segundosEmHoras($resultado)
	{
		if(is_int($resultado))
		{
		$hora=($resultado /(60*60)) - ($resultado /(60*60)-intval($resultado /(60*60)));
		$minuto=60*($resultado /(60*60)- $hora)-((60*($resultado /(60*60)- $hora)) - intval(60*($resultado /(60*60)- $hora)));
		$segundo= $resultado - ($hora *(60*60)) - ($minuto * 60);
		if($segundo == 60)
		{
			$segundo =0;
			$minuto++; 
		}
		
		if($minuto == 60)
		{
			$minuto = 0;
			$hora++;
		}
		
		return str_pad($hora,2, '0', STR_PAD_LEFT).':'.str_pad($minuto,2, '0', STR_PAD_LEFT).':'.str_pad($segundo,2, '0', STR_PAD_LEFT);
		}
		else
		return false;
	}
	
	# horaEmSegundos
	function horaEmSegundos($hora)
	{
	if(is_int($hora))
	$hora = ($hora) * 3600;
	else
	{
		if($hora = explode( ':', $hora))
		{

			if(is_array($hora) and count($hora) === 1)
			$hora = (intval($hora[0]) * 3600);
			
			if(is_array($hora) and count($hora) === 2)
			$hora = (intval($hora[0]) * (60*60)) + (intval($hora[1]) * 60);
			
			if(is_array($hora) and count($hora) === 3)
			$hora = (intval($hora[0]) * (60*60)) + (intval($hora[1]) * 60) + intval($hora[2]);
		}
		else
		return false;
	}
		return $hora;
	}

	# duracao
	function duracao($horaInicial, $horaFinal)
	{
		//Separa Hora e Minutos
		if(!$horaInicial=$this->horaEmSegundos($horaInicial ))
		return false;
		if(!$horaFinal=$this->horaEmSegundos($horaFinal ))
		return false;

		if($horaFinal < $horaInicial)
		$resultado = $horaInicial-$horaFinal;
		else
		$resultado = $horaFinal-$horaInicial;

		return $this->segundosEmHoras($resultado);
		
	}
	
}