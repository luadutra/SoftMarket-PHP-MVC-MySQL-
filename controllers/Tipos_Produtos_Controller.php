<?php

require_once "./models/Tipos_Produtos_Model.php";

class Tipos_Produtos_Controller {

    public $tipos_produtos;

    public function __construct() {
        $this->tipos_produtos = new Tipos_Produtos_Model();
    }

    public function exibe_tipos_produtos() {
        include('./views/tipos_produtos.php');
    }

    public function tipos_produtos() {
        $result = $this->tipos_produtos->busca_tipos_produtos();
        return $result;
    }

    public function add_tipos_produtos() {
        $novoTiposProdutos['id'] = $_POST['id'];
        $novoTiposProdutos['nome'] = $_POST['nome'];
        $novoTiposProdutos['imposto'] = formato_moeda($_POST['imposto']);

        if($this->tipos_produtos->add_tipos_produtos($novoTiposProdutos)) {
            echo("Operação Concluída com Sucesso!");
        } else {
            echo("Erro na Inserção!");
        }

        header("Refresh: 2; /projeto_euax/tipos_produtos");
        exit();
    }

    public function tipos_produtos_item($id) {
        return $this->tipos_produtos->busca_tipos_produtos_id($id);
    }   

    public function remove_tipos_produtos($id) {
        $this->tipos_produtos->remove_tipos_produtos($id);
        echo("Tipo de Produto Removido com Sucesso!");
        header("Refresh: 2; /projeto_euax/tipos_produtos");
        exit();
    }
}

