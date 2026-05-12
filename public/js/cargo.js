$(document).ready(function() {
    $('#formCargo').submit(function(e) {
        e.preventDefault();
        const dados = $(this).serialize();
        $.post('index.php?module=cargo&action=salvar', dados, function(res) {
            Swal.fire({
                    title: 'Sucesso!',
                    text: 'Cargo guardado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            limparFormCargo();
            buscarCargos();
        });
    });
});

function buscarCargos() {
    const nome = $('#pesquisaNomeCargo').val();
    $.get(`index.php?module=cargo&action=listar&nome=${nome}`, function(data) {
        let html = '';
        data.forEach(c => {
            html += `
            <tr onclick="selecionarCargo(${c.id}, '${c.nome}', ${c.salario})" style="cursor:pointer">
                <td>${c.nome}</td>
                <td>${parseFloat(c.salario).toLocaleString('pt-BR')}</td>
                <td><small class="text-primary">Editar</small></td>
            </tr>`;
        });
        $('#tabelaCargos').html(html || '<tr><td colspan="3" class="text-center">Nenhum cargo encontrado.</td></tr>');
    });
}

function selecionarCargo(id, nome, salario) {
    $('#cargoId').val(id);
    $('#cargoNome').val(nome);
    $('#cargoSalario').val(salario);
    $('#tituloFormCargo').text('Editar Cargo');
    $('#btnExcluirCargo').removeClass('d-none');
}

function excluirCargo() {
    const id = $('#cargoId').val();
    
    Swal.fire({
        title: 'Tem certeza?',
        text: "Deseja realmente remover este cargo?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(`index.php?module=cargo&action=excluir`, {id: id}, function(res) {
                if(res.status === 'success') {
                    Swal.fire('Excluído!', res.message, 'success');
                    limparFormCargo();
                    buscarCargos();
                } else {
                    Swal.fire('Atenção!', res.message, 'error');
                }
            });
        }
    });
}

function limparFormCargo() {
    $('#formCargo')[0].reset();
    $('#cargoId').val('');
    $('#tituloFormCargo').text('Novo Cargo');
    $('#btnExcluirCargo').addClass('d-none');
}