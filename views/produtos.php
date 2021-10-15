<?php include("inc/header.php"); 

$objProduto = new Produtos_Controller();
$produtos = $objProduto->produtos();

$objTipo = new Tipos_Produtos_Controller();
$tipos_produtos = $objTipo->tipos_produtos();

?>

<div class="content">
    <h2 class="title">CADASTRO DE PRODUTOS</h2>
    <hr>
    <nav>
        <a href="/projeto_euax/produtos" class="block">
            <button class="nav-button <?php echo $uriSegments[1] == 'produtos' ? 'active' : '' ?>">Produtos</button>
        </a>
        <a href="/projeto_euax/tipos_produtos" class="block">
            <button class="nav-button <?php echo $uriSegments[1] == 'tipos_produtos' ? 'active' : '' ?>">Tipos de Produto</button>
        </a>
    </nav>

    <div class="card">
        <form action="produtos/add_produtos" name="form-produtos" method="POST">
            <div class="flex">
                <input type="hidden" name="id">

                <div class="input-group w-25">
                    <label>Produto</label>
                    <input type="text" name="nome" class="input" required>
                </div>
                
                <div class="input-group w-25">
                    <label>Tipo de Produto</label>
                    <select name="id_tipos_produtos" class="select" required>
                        <option>Selecione</option>
                        <?php foreach($tipos_produtos as $tipo): ?>
                            <option value="<?php echo $tipo[0] ?>"><?php echo $tipo[1] ?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="input-group w-50 flex no-pad">
                    <div class="input-group w-25">
                        <label>Preço Unitário</label>
                        <input type="text" name="preco" class="input text-center" required mascara="moeda">
                    </div>

                    <div class="input-group w-50">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="input">
                    </div>
                </div>
            </div>
            <div class="input-group flex justify-end">
                <button class="btn-default no-marg pointer">Salvar</button>
            </div>
        </form>

        <div class="table">
            <label>Produtos cadastrados</label>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Tipo de Produto</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($produtos)) { ?>
                        <?php foreach($produtos as $produto) { ?>
                            <tr>
                                <td align="center"><?php echo $produto[0] ?></td>
                                <td><?php echo $produto[1] ?></td>
                                <td><?php echo $produto[4] ?></td>
                                <td align="center">R$ <?php echo formato_decimal($produto[2]) ?></td>
                                <td><?php echo $produto[3] ?></td>
                                <td class="table-action text-center">
                                    <i class="fas fa-pencil-alt pointer" onclick="editar_produtos(<?php echo $produto[0] ?>)"></i>
                                    <a href="/projeto_euax/produtos/remove_produtos/?id=<?php echo $produto[0] ?>">
                                        <i class="fas fa-trash-alt pointer" onclick="return confirm('Tem certeza que deseja excluir este Produto?')"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include("inc/footer.php") ?>
