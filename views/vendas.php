
<?php include("inc/header.php"); ?>

<?php 

    $objProduto = new Produtos_Controller();
    $produtos = $objProduto->produtos();

    $objVenda = new Vendas_Controller();
    $vendas = null;

    $url = $_SERVER['REQUEST_URI'];
    $aux = explode('cod=',$url);

    if(mb_strpos($url,'cod=')) { 
        $codigo = end($aux); 
    }

    if(isset($codigo) && $codigo > 0) {
        $vendas = $objVenda->vendas($codigo);
    }
    
?>

<div class="content">
    <h2 class="title">CAIXA ABERTO</h2>
    <hr>
    <div class="card vendas">
        <form action="vendas/add_vendas" name="form-vendas" method="POST">
            <div class="flex">
                <div class="input-group w-25">
                    <label>Código da Venda</label>
                    <input type="text" name="codigo_venda" class="input text-center" readonly value="<?php echo $_SESSION['codigo_registro_venda'] ?>">
                </div>

                <div class="input-group w-50">
                    <input type="hidden" name="id">

                    <label>Produto</label>
                    <select name="id_produto" class="select">
                        <option>Selecione</option>
                        <?php foreach($produtos as $produto) { ?>
                            <option value="<?php echo $produto[0] ?>"><?php echo $produto[1] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="input-group w-25">
                    <label>Quantidade</label>
                    <input type="text" name="quantidade" class="input text-center">
                </div>
                <div class="input-group w-25">
                    <button class="btn-default w-100 mt-12"><i class="fas fa-cart-plus"></i> Incluir no carrinho</button>
                </div>
            </div>
        </form>

        <div class="table">
            <label>Itens do carrinho</label>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Tipo</th>
                        <th>Preço Unitário (R$)</th>
                        <th>Quantidade</th>
                        <th>Total sem Imposto (R$)</th>
                        <th>Imposto (R$)</th>
                        <th>Total com Imposto (R$)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($vendas)) { ?>
                        <?php foreach($vendas['itens'] as $venda) { ?>
                            <tr>
                                <td align="center"><?php echo $venda['id'] ?></td>
                                <td><?php echo $venda['produto'] ?></td>
                                <td><?php echo $venda['tipos_produtos'] ?></td>
                                <td align="right"><?php echo formato_decimal($venda['preco']) ?></td>
                                <td align="right"><?php echo $venda['quantidade'] ?></td>
                                <td align="right"><?php echo formato_decimal($venda['total_sem_imposto']) ?></td>
                                <td align="right"><?php echo formato_decimal($venda['imposto']) ?></td>
                                <td align="right"><?php echo formato_decimal($venda['total_com_imposto']) ?></td>
                                <td class="table-action text-center">
                                    <a href="/projeto_euax/vendas/remove_vendas?id=<?php echo $venda['id']."&cod=".$_SESSION['codigo_registro_venda'] ?>">
                                        <i class="fas fa-trash-alt pointer" onclick="return confirm('Tem certeza que deseja excluir este item?')"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <div class="flex justify-end">
                <div class="w-50">
                    <?php if(!empty($vendas) && $vendas['total_compra'] > 0) { ?>
                        <a href="/projeto_euax/vendas/finaliza_venda">
                            <button class="btn-default btn-checkout no-marg pointer">Finalizar Compra</button>
                        </a>
                    <?php } ?>
                    &nbsp;
                    <?php if(!empty($vendas) && $vendas['total_compra'] > 0) { ?>
                        <a href="/projeto_euax/vendas/cancela_vendas/?cod=<?php echo $_SESSION['codigo_registro_venda'] ?>">
                            <button class="btn-default btn-cancel no-marg pointer">Cancelar Compra</button>
                        </a>
                    <?php } ?>
                </div>
                <div class="w-50">
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td align="right">R$ <?php echo isset($vendas['subtotal']) ? formato_decimal($vendas['subtotal']) : '0,00' ?></td>
                        </tr>
                        <tr>
                            <td>Subtotal dos Impostos</td>
                            <td align="right">R$ <?php echo isset($vendas['subtotal_impostos']) ? formato_decimal($vendas['subtotal_impostos']) : '0,00' ?></td>
                        </tr>
                        <tr>
                            <td><h3>Total da compra</h3></td>
                            <td align="right"><h3>R$ <?php echo isset($vendas['total_compra']) ? formato_decimal($vendas['total_compra']) : '0,00' ?></h3></td>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
            
<?php include("inc/footer.php") ?>
