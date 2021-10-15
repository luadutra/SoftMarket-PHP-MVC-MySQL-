<?php include("inc/header.php"); 

$objTipo = new Tipos_Produtos_Controller();
$tipos_produtos = $objTipo->tipos_produtos();

?>

<div class="content">
    <h2 class="title">CADASTRO DE TIPOS DE PRODUTOS</h2>
    <hr>
    <nav>
        <a href="/projeto_euax/produtos" class="block">
            <button class="nav-button <?php echo $uriSegments[1] == 'produtos' ? 'active' : '' ?>">Produtos</button>
        </a>
        <a href="/projeto_euax/tipos_produtos" class="block">
            <button class="nav-button <?php echo $uriSegments[1] == 'tipos_produtos' ? 'active' : '' ?>">Tipos de Produtos</button>
        </a>
    </nav>

    <div class="card">
        <form action="tipos_produtos/add_tipos_produtos" name="form-tipos-produtos" method="POST">
            <div class="flex">
                <input type="hidden" name="id">

                <div class="input-group w-50">
                    <label>Tipo</label>
                    <input type="text" name="nome" class="input">
                </div>
                
                <div class="input-group w-25">
                    <label>Alíquota de Imposto (%)</label>
                    <input type="text" name="imposto" class="input text-center" mascara="moeda">
                </div>

                <div class="input-group w-25 mt-12">
                    <button class="btn-default no-marg pointer">Salvar</button>
                </div>
            </div>
        </form>

        <div class="table">
            <label>Tipos de Produtos Cadastrados</label>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Imposto (%)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tipos_produtos as $tipo): ?>
                        <tr>
                            <td align="center"><?php echo $tipo[0] ?></td>
                            <td><?php echo $tipo[1] ?></td>
                            <td align="center"><?php echo formato_decimal($tipo[2]) ?> %</td>
                            <td class="table-action text-center">
                                <i class="fas fa-pencil-alt pointer" onclick="editar_tipos_produtos(<?php echo $tipo[0] ?>)"></i>
                                <a href="/projeto_euax/tipos_produtos/remove_tipos_produtos/?id=<?php echo $tipo[0] ?>">
                                    <i class="fas fa-trash-alt pointer" onclick="return confirm('Tem certeza que deseja excluir este Tipo de Produto?')"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include("inc/footer.php") ?>