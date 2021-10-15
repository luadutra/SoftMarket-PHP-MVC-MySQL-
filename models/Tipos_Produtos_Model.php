<?php

require_once("./helpers/DB_connect.php");

class Tipos_Produtos_Model extends DB_connect {
    
    protected $conexao;

    public function __construct() {
        $this->conexao = new DB_connect();
    }

    public function busca_tipos_produtos() {
        $query = "SELECT * FROM tipos_produtos ORDER BY nome";
        $result = mysqli_query($this->conexao->conn, $query);

        $arr_tipos_produtos = mysqli_fetch_all($result);

        return $arr_tipos_produtos;
    }

    public function add_tipos_produtos($tipo) {
        if(empty($tipo['id'])) {

            if($this->verifica_tipos_produtos($tipo['nome'])) {
                return false;               
            } else {
                $result = mysqli_query($this->conexao->conn, "INSERT INTO tipos_produtos (nome, imposto) VALUES ('".$tipo['nome']."', '".$tipo['imposto']."')");
            }

        } else {

            $update = "UPDATE tipos_produtos SET nome='".$tipo['nome']."', imposto=".$tipo['imposto']." WHERE id=".$tipo['id'];
            $result = mysqli_query($this->conexao->conn, $update);   

        }

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function busca_tipos_produtos_id($id) {
        $query = "SELECT * FROM tipos_produtos WHERE id=" . $id;
        $result = mysqli_query($this->conexao->conn, $query);
        $tipos_produtos = mysqli_fetch_all($result);
    
        print_r(json_encode($tipos_produtos));
    }

    public function verifica_tipos_produtos($nome) {
        $query = "SELECT * FROM tipos_produtos WHERE nome='" . $nome . "'";
        $result = mysqli_query($this->conexao->conn, $query);

        if(mysqli_num_rows($result)) {
            return true;
        }

        return false;
    }

    public function remove_tipos_produtos($id) {
        $delete = "DELETE FROM tipos_produtos WHERE id=" . $id;
        mysqli_query($this->conexao->conn, $delete);
    }
}