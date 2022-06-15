<?php

class Router
{

    public $uri;    	
    public $method;  	
    public $query;   	
    public $variables; 
    public $controller;

    function __construct($request)//usar variavel $_SERVER
    {
        $this->uri     = $request['REQUEST_URI'];
        $this->method  = $request['REQUEST_METHOD'];
        $this->query   = $request['QUERY_STRING'];
        $this->self   = $request['PHP_SELF'];
        $this->root  = $request['DOCUMENT_ROOT'];

        $this->set_variables();
        if($this->set_controller())
        {
            $this->require_controller();
        }
        
        
      
    }

    function set_controller()
    {
        $result = strtolower(strstr($this->uri, '/'));
        if(strpos($result, '?') > 0)
        {
            $result = strstr($result, '?', true);
        }
        
        if(strpos($result, '.php') > 0)
        {
            $result = strstr($result, '.php', true);
        }

        if($result == '/')
        {
            $result = '/index';
        }
    
        $result = 'controller'.$result;
       

        $result = $result .'.php';

        if(!file_exists($this->root.'/'.$result))
        {
            echo '<span style="border:1px solid orange; margin:15px; padding:6px;">Controller não encontrado:'.$result.'</span>';
            return false;
        }
        $this->controller = $result;       
        return true;
    }

    
    function set_variables()
    {
    // Pegar as variaveis da queryString
    // transforma em array de valores
        if(is_null($this->query) or $this->query == '')
        {
            return false;
        }

        if(strrpos($this->query, "&") > 0)
            $URI_vars = explode('&', $this->query);
        else 
            $URI_vars[] = $this->query;

            $result = array();
            foreach($URI_vars as $pos => $var)
            {
                $varTemp = explode( '=', $var);
                $result[$varTemp[0]] =$varTemp[1];
            }
            $URI_vars = $result;
            $this->variables = $URI_vars;
            return true;
    }

    function require_controller()
    {
        ${$this->method} = $this->variables;
        // echo $this->controller;
        require_once($this->controller);
    }

function __destruct() {}

}


$rotas = new Router($_SERVER);