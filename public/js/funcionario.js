$(document).ready(function() {
    $('#funcCpf').mask('000.000.000-00', {reverse: true});
    $('#funcTelefone').mask('(00) 00000-0000');
    $('#funcCep').mask('00000-000');

    carregarCargos();

    $('#formFuncionario').submit(function(e) {
        e.preventDefault();
        const dados = $(this).serialize();

        $.post('/index.php?module=funcionario&action=salvar', dados, function(res) {
            if(res.status === 'success') {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Registro salvo com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                limparForm();
            } else {
                if (res.status === 'error') {
                    Swal.fire({
                        title: 'Erro!',
                        text: res.message,
                        icon: 'error'
                    });
                }
            }
        });
    });

    $('#funcCep').blur(function() {
        let cep = $(this).val().replace(/\D/g, ''); 

        if (cep !== "" && cep.length === 8) {
            $('#funcLogradouro').val('...');
            $('#funcBairro').val('...');
            $('#funcMunicipio').val('...');
            $('#funcUf').val('...');

            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(dados) {
                if (!("erro" in dados)) {
                    $('#funcLogradouro').val(dados.logradouro);
                    $('#funcBairro').val(dados.bairro);
                    $('#funcMunicipio').val(dados.localidade);
                    $('#funcUf').val(dados.uf);
                    $('#funcNumero').focus(); 
                } else {
                    alert("CEP não encontrado.");
                    limparCamposEndereco();
                }
            }).fail(function() {
                alert("Erro ao consultar o CEP.");
            });
        }
    });
});

function listarFuncionarios() {
    const busca = $('#funcPesquisa').val() || ''; 
    
    $.get(`index.php?module=funcionario&action=listar&busca=${busca}`, function(data) {
        let rows = '';
        if (data.length === 0) {
            rows = '<tr><td colspan="4" class="text-center">Nenhum funcionário encontrado.</td></tr>';
        } else {
            data.forEach(f => {
                rows += `
                <tr onclick="selecionarFuncionario(${f.id})" style="cursor:pointer">
                    <td>${f.nome}</td>
                    <td>${f.cpf}</td>
                    <td>${f.cargo_nome}</td>
                    <td><small class="text-primary">Editar</small></td>
                </tr>`;
            });
        }
        $('#tabelaFuncionarios').html(rows);
    });
}

function selecionarFuncionario(id) {
    $.get(`index.php?module=funcionario&action=obter&id=${id}`, function(f) {
        if (!f) {
            Swal.fire('Erro', 'Não foi possível carregar os dados.', 'error');
            return;
        }

        $('#funcId').val(f.id);
        $('#funcNome').val(f.nome);
        $('#funcCpf').val(f.cpf);
        $('#funcDataNasc').val(f.data_nascimento);
        $('#funcCargo').val(f.id_cargo);
        $('#funcEmail').val(f.email);
        $('#funcTelefone').val(f.telefone);
        $('#funcCep').val(f.cep);
        $('#funcLogradouro').val(f.logradouro);
        $('#funcNumero').val(f.numero);
        $('#funcComplemento').val(f.complemento);
        $('#funcBairro').val(f.bairro);
        $('#funcMunicipio').val(f.municipio);
        $('#funcUf').val(f.uf);
        
        $('#btnExcluirFunc').removeClass('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        
    }, 'json'); 
}

function carregarCargos() {
    $.get('index.php?module=cargo&action=listar', function(data) {
        let options = '<option value="">Selecione um cargo...</option>';
        data.forEach(cargo => {
            options += `<option value="${cargo.id}">${cargo.nome}</option>`;
        });
        $('#funcCargo').html(options);
    });
}

function excluirFuncionario() {
    const id = $('#funcId').val();
    
    Swal.fire({
        title: 'Excluir Funcionário?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('index.php?module=funcionario&action=excluir', { id: id }, function(res) {
                if (res.status === 'success') {
                    Swal.fire('Deletado!', res.message, 'success');
                    limparForm(); 
                    listarFuncionarios();
                } else {
                    Swal.fire('Erro!', res.message, 'error');
                }
            });
        }
    });
}

function limparCamposEndereco() {
    $('#funcLogradouro').val('');
    $('#funcBairro').val('');
    $('#funcMunicipio').val('');
    $('#funcUf').val('');
}

function limparForm() {
    $('#formFuncionario')[0].reset();
    $('#funcId').val('');
    $('#btnExcluirFunc').addClass('d-none');
    $('#funcNome').focus();
    limparCamposEndereco();
}