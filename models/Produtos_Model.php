<?php

require_once("./helpers/DB_connect.php");

class Produtos_Model extends DB_connect {

    protected $conexao;

    public function __construct() {
        $this->conexao = new DB_connect();
    }

    public function busca_produtos() {
        $query  = "SELECT p.id, p.nome as produto, p.preco, p.descricao, tp.nome as tipos_produtos, tp.imposto 
                   FROM produtos as p
                   INNER JOIN tipos_produtos as tp ON tp.id = p.id_tipos_produtos
                   ORDER BY p.nome";
                   
        $result = mysqli_query($this->conexao->conn, $query);
        $arr_produtos = mysqli_fetch_all($result);

        return $arr_produtos;
    }

    public function add_produtos_item($produto) {
        if(empty($produto['id'])) {

            if($this->verifica_produtos($produto['nome'])) {

                return false;  

            } else {

                $insert = "INSERT INTO produtos (nome, preco, id_tipos_produtos, descricao) VALUES ('".$produto['nome']."', '".$produto['preco']."', '".$produto['id_tipos_produtos']."', '".$produto['descricao']."')";
                $result = mysqli_query($this->conexao->conn, $insert);
                
            }

        } else {

            $update = "UPDATE produtos SET nome='".$produto['nome']."', preco=".$produto['preco'].", id_tipos_produtos=".$produto['id_tipos_produtos'].", descricao='".$produto['descricao']."' WHERE id=".$produto['id'];
            $result = mysqli_query($this->conexao->conn, $update);   

        }

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function busca_produtos_id($id) {
        $query = "SELECT * FROM produtos WHERE id=" . $id;
        $result = mysqli_query($this->conexao->conn, $query);

        return mysqli_fetch_all($result);
    }

    public function verifica_produtos($nome) {
        $query = "SELECT * FROM produtos WHERE nome='".$nome."'";
        $result = mysqli_query($this->conexao->conn, $query);

        if(mysqli_num_rows($result)) {
            return true;
        }
        
        return false;
    }

    public function remove_produtos($id) {
        $delete =" DELETE FROM produtos WHERE id=" . $id;
        mysqli_query($this->conexao->conn, $delete);
    }

}