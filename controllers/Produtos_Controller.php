<?php

require_once "./models/Produtos_Model.php";

class Produtos_Controller {

    public $produtos;

    public function __construct() {
        $this->produtos = new Produtos_Model();
        
    }

    public function exibe_produtos() {
        include('./views/produtos.php');
    }

    public function produtos() {
        $result = $this->produtos->busca_produtos();
        return $result;
    }

    public function busca_produtos_disponiveis() {
        $result = $this->produtos->busca_produtos(true);
        return $result;
    }

    public function add_produtos() {

        $product['id'] = $_POST['id'];
        $product['nome'] = $_POST['nome'];
        $product['id_tipos_produtos'] = $_POST['id_tipos_produtos'];
        $product['preco'] = formato_moeda($_POST['preco']);
        $product['descricao'] = $_POST['descricao'];

        if($this->produtos->add_produtos_item($product)) {
            echo("Operação Concluída com Sucesso!");
        } else {
            echo("Erro na Inserção!");
        }
        header("Refresh: 2; /projeto_euax/produtos");
        exit();
    }

    public function produtos_item($id) {
        return $this->produtos->busca_produtos_id($id);
    } 

    public function produtos_json($id) {
        die(json_encode($this->produtos->busca_produtos_id($id)));
    } 

    public function remove_produtos($id) {
        $this->produtos->remove_produtos($id);
        echo("Produto Removido com Sucesso!");
        header("Refresh: 2; /projeto_euax/produtos");
        exit();
    }
}