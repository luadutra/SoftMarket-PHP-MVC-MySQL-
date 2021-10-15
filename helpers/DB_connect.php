<?php

class DB_connect {
    
    protected $conn;
    
    public function __construct() 
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "softmarket";
               
        $this->conn = new mysqli($host, $user, $password, $db);
        $this->conn->set_charset("utf8");
        
        if($this->conn->connect_error) {
            die('Erro na Conexão: ' . $this->conn->connect_error);
        }
    }
}