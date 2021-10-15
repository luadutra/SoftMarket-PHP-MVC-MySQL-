<?php

date_default_timezone_set( 'America/Sao_Paulo' );
require_once("./helpers/DB_connect.php");

class Vendas_Model extends DB_connect {

    protected $conexao;

    public function __construct() {
        $this->conexao = new DB_connect();
    }

    public function add_vendas($produto) {

        if(empty($produto['id'])) {

            $registro = date('Y-m-d H:i:s');
            $insert = "INSERT INTO vendas (codigo_venda, id_produto, quantidade, data_venda) VALUES (".$produto['codigo_venda'].", ".$produto['id_produto'].", ".$produto['quantidade'].", '".$registro."')";
            $result = mysqli_query($this->conexao->conn, $insert);
            
        } else {

            $update = "UPDATE vendas SET codigo_venda=".$produto['codigo_venda'].", id_produto=".$produto['id_produto'].", quantidade=".$produto['quantidade']." WHERE id=".$produto['id'];
            $result = mysqli_query($this->conexao->conn, $update);                
        
        }

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function busca_vendas($codigo_venda) {
        $query  = "SELECT v.id, p.id as id_produto, p.nome as produto, tp.nome as tipos_produtos, v.quantidade, p.preco, tp.imposto 
                   FROM vendas as v
                   INNER JOIN produtos as p ON p.id = v.id_produto
                   INNER JOIN tipos_produtos as tp ON tp.id = p.id_tipos_produtos
                   WHERE v.codigo_venda = '".$codigo_venda. "'";

        $result = mysqli_query($this->conexao->conn, $query);
        $vendas = mysqli_fetch_all($result);

        return $vendas;
    }

    public function remove_vendas($id, $cod) {
        $delete = "DELETE FROM vendas WHERE id=".$id." AND codigo_venda=".$cod;
        mysqli_query($this->conexao->conn, $delete);
    }

    public function remove_vendas_id($id, $codigo_venda) {
        $delete = "DELETE FROM vendas WHERE id_produto=" . $id. " AND codigo_venda='".$codigo_venda."'";
        mysqli_query($this->conexao->conn, $delete);
    }
}