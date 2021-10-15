<?php

session_start();

require_once("helpers/Helper.php");
require_once("./models/Vendas_Model.php");

class Vendas_Controller {

    public $vendas;
    public $produtos;

    public function __construct() {

        $this->vendas = new Vendas_Model();
        $this->produtos = new Produtos_Model();

        if(!isset($_SESSION['codigo_registro_venda']) || $_SESSION['codigo_registro_venda'] == null) {
            $_SESSION['codigo_registro_venda'] = str_replace(array("-", " ", ":", "pm", "am"), "", date('YmdHis'));
        }
        
    }

    public function exibe_vendas() {
        include('./views/vendas.php');
    }

    public function add_vendas() {
        $product['codigo_venda'] = $_POST['codigo_venda'];
        $product['id_produto']   = $_POST['id_produto'];
        $product['quantidade']   = $_POST['quantidade'];
        
        $this->vendas->add_vendas($product);
        
        header("Refresh: 0; /projeto_euax/vendas?cod=".$product['codigo_venda']);
        exit();
    }

    public function vendas($codigo_venda) {
        $tmp = $this->vendas->busca_vendas($codigo_venda);

        $subtotal = 0;
        $subtotal_impostos = 0;
        $total_compra = 0;

        $result = [];

        if(!empty($tmp)) {
            
            for($i = 0; $i < count($tmp); $i++) {

                $result[$i]['id'] = $tmp[$i][0];
                $result[$i]['id_produto'] = $tmp[$i][1];
                $result[$i]['produto'] = $tmp[$i][2];
                $result[$i]['tipos_produtos'] = $tmp[$i][3];
                $result[$i]['preco'] = $tmp[$i][5];
                $result[$i]['quantidade'] = $tmp[$i][4];
                $result[$i]['total_sem_imposto'] = $tmp[$i][5] * $tmp[$i][4];
                $result[$i]['imposto'] = $tmp[$i][6];
                $result[$i]['imposto'] = ($tmp[$i][5] * $tmp[$i][4]) * ($tmp[$i][6] / 100);
                $result[$i]['total_com_imposto'] = ($tmp[$i][5] * $tmp[$i][4]) + ($tmp[$i][5] * $tmp[$i][4]) * ($tmp[$i][6] / 100);
    
                $subtotal += $tmp[$i][5] * $tmp[$i][4];
                $subtotal_impostos += ($tmp[$i][5] * $tmp[$i][4]) * ($tmp[$i][6] / 100);
                $total_compra += ($tmp[$i][5] * $tmp[$i][4]) + ($tmp[$i][5] * $tmp[$i][4]) * ($tmp[$i][6] / 100);
    
            }
        }
        
        $valores['itens'] = $result;
        $valores['subtotal'] = $subtotal;
        $valores['subtotal_impostos'] = $subtotal_impostos;
        $valores['total_compra'] = $total_compra;

        return $valores;
    }

    public function remove_vendas($id, $cod = null) {
        $this->vendas->remove_vendas($id, $cod);
        header("Refresh: 0; /projeto_euax/vendas?cod=".$cod);
        exit();
    }

    public function cancela_vendas() {
        $vendas = $this->vendas($_GET['cod']);

        foreach($vendas['itens'] as $produto) {
            $id = $produto['id_produto'];
            $this->vendas->remove_vendas_id($id, $_GET['cod']);
        }

        session_destroy();
        header('location: /projeto_euax/vendas');
    }

    public function finaliza_venda() {
        session_destroy();
        header('location: /projeto_euax/vendas');
    }
}