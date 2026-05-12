$(document).ready(function() {
    carregarCargosFiltro();
    buscarDadosRelatorio();

    $('#formFiltroRelatorio').submit(function(e) {
        e.preventDefault();
        buscarDadosRelatorio();
    });
});

function carregarCargosFiltro() {
    $.get('/index.php?module=cargo&action=listar', function(data) {
        let options = '<option value="">Todos os Cargos</option>';
        data.forEach(cargo => {
            options += `<option value="${cargo.id}">${cargo.nome}</option>`;
        });
        $('#filtroCargo').html(options);
    });
}

function buscarDadosRelatorio() {
    const filtros = {
        nome: $('#filtroNome').val(),
        id_cargo: $('#filtroCargo').val()
    };

    $.get('/index.php?module=funcionario&action=relatorio', filtros, function(res) {
        let rows = '';
        if (res.length === 0) {
            rows = '<tr><td colspan="4" class="text-center">Nenhum registro encontrado.</td></tr>';
        } else {
            res.forEach(item => {
                rows += `
                    <tr>
                        <td>${item.nome}</td>
                        <td>${item.telefone || '-'}</td>
                        <td>${item.cargo}</td>
                        <td>${parseFloat(item.salario).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                    </tr>`;
            });
        }
        $('#tabelaRelatorio').html(rows);
    });
}