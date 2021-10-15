$(document).ready(function() {
    mascaras();
});

function editar_tipos_produtos(id) {
    $.ajax({
        url: '/projeto_euax/tipos_produtos/tipos_produtos_item/',
        type: 'GET',
        dataType: 'json',
        data: {'id': id}
    })
    .done(function(data) {
        var form = $('[name=form-tipos-produtos]');
        form.find('[name=id]').val(data[0][0]);
        form.find('[name=nome]').val(data[0][1]);
        form.find('[name=imposto]').val(data[0][2].toString().replace(".", ","));
    })
    .fail(function(data){
        console.log('Ocorreu um erro!');
    });
}

function editar_produtos(id) {
    $.ajax({
        url: 'produtos/produtos_json/',
        type: 'GET',
        dataType: 'json',
        data: {'id': id}
    })
    .done(function(data){
        var form = $('[name=form-produtos]');
        form.find('[name=id]').val(data[0][0]);
        form.find('[name=nome]').val(data[0][2]);
        form.find('[name=preco]').val(data[0][4].toString().replace(".", ","));
        form.find('[name=descricao]').val(data[0][3]);

        $('select[name=id_tipos_produtos] option').each(function() {
            if($(this).val() == data[0][1]) {
                $(this).prop('selected', true);
            }
        });

    })
    .fail(function(data) {
        console.log('Ocorreu um erro!');
    });
}

function mascaras() {
    $("[mascara=moeda]").on("focus", function () {
        $(this).mask('000.000.000,00', {
            reverse: true
        });
    });
}