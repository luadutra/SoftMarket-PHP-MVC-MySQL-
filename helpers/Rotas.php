<?php

$site_url = $_SERVER['REQUEST_URI'];
$aux1 = explode('id=',$site_url);
$aux2 = explode('cod=',$site_url);
$id_url = end($aux1);
$id_remove = explode('&',$id_url)[0];

if(mb_strpos($site_url,'cod=')) { 
    $cod_url = end($aux2); 
}

try {

    switch($site_url) {

        case '/':
            include('views/login.php');
        break;

        case '/projeto_euax/vendas':
            $vendas = new Vendas_Controller();
            $vendas->exibe_vendas();
        break;

        case '/projeto_euax/tipos_produtos':
            $tipos_produtos = new Tipos_Produtos_Controller();
            $tipos_produtos->exibe_tipos_produtos();
        break;
        
        case '/projeto_euax/tipos_produtos/add_tipos_produtos':
            $tipos_produtos = new Tipos_Produtos_Controller();
            $tipos_produtos->add_tipos_produtos();
        break;
        
        case '/projeto_euax/produtos':
            $produtos = new Produtos_Controller();
            $produtos->exibe_produtos();
        break;
        
        case '/projeto_euax/produtos/add_produtos':
            $produtos = new Produtos_Controller();
            $produtos->add_produtos();
        break;
        
        case '/projeto_euax/vendas/finaliza_venda':
            $vendas = new Vendas_Controller();
            $vendas->finaliza_venda();
        break;

        case isset($_POST['codigo_venda']):
            $vendas = new Vendas_Controller();
            $vendas->add_vendas();
        break;

        case '/projeto_euax/vendas/remove_vendas?id='.$id_remove.'&cod='.@$cod_url:
            $vendas = new Vendas_Controller();
            $vendas->remove_vendas($id_remove, $cod_url);
        break;

        case '/projeto_euax/vendas/cancela_vendas/?cod='.@$cod_url:
            $vendas = new Vendas_Controller();
            $vendas->cancela_vendas();
        break;

        case (isset($cod_url) && '/projeto_euax/vendas/?cod='.$cod_url):
            $vendas = new Vendas_Controller();
            $vendas->exibe_vendas();
        break;

        case '/projeto_euax/tipos_produtos/tipos_produtos_item/?id='.$id_url:
            $tipos_produtos = new Tipos_Produtos_Controller();
            $tipos_produtos->tipos_produtos_item($id_url);
        break;

        case '/projeto_euax/tipos_produtos/remove_tipos_produtos/?id='.$id_url:
            $tipos_produtos = new Tipos_Produtos_Controller();
            $tipos_produtos->remove_tipos_produtos($id_url);
        break;

        case '/projeto_euax/produtos/produtos_item/?id='.$id_url:
            $produtos = new Produtos_Controller();
            $produtos->produtos_item($id_url);
        break;

        case '/projeto_euax/produtos/remove_produtos/?id='.$id_url:
            $produtos = new Produtos_Controller();
            $produtos->remove_produtos($id_url);
        break;

        case '/projeto_euax/produtos/produtos_json/?id='.$id_url:
            $produtos = new Produtos_Controller();
            $produtos->produtos_json($id_url);
        break;
        
        default:
            include('views/login.php');
        break;

    }

} catch(Exception $e) {

    echo "Ocorreu um Erro: " . $e->getMessage();

}
