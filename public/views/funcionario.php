<div class="card shadow-sm mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary">Pesquisar Funcionários</h5>
    </div>
    <div class="card-body">
        <div class="row g-2">
            <div class="col-md-10">
                <input type="text" id="funcPesquisa" class="form-control" placeholder="Digite Nome ou CPF...">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-secondary w-100" onclick="listarFuncionarios()">Pesquisar</button>
            </div>
        </div>
        
        <div class="table-responsive mt-3" style="max-height: 250px;">
            <table class="table table-hover table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabelaFuncionarios">
                    <tr><td colspan="4" class="text-center text-muted">Realize uma busca para listar.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Dados do Funcionário</h5>
    </div>
    <div class="card-body">
        <form id="formFuncionario">
            <input type="hidden" name="id" id="funcId">
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nome Completo *</label>
                    <input type="text" name="nome" id="funcNome" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">CPF *</label>
                    <input type="text" name="cpf" id="funcCpf" class="form-control" placeholder="000.000.000-00" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Data de Nascimento *</label>
                    <input type="date" name="data_nascimento" id="funcDataNasc" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Cargo *</label>
                    <select name="id_cargo" id="funcCargo" class="form-select" required>
                        <option value="">Selecione...</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">E-mail</label>
                    <input type="email" name="email" id="funcEmail" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Telefone</label>
                    <input type="text" name="telefone" id="funcTelefone" class="form-control">
                </div>
            </div>

            <h6 class="mt-4 border-bottom pb-2">Endereço (Opcional)</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-2">
                    <label class="form-label">CEP</label>
                    <input type="text" name="cep" id="funcCep" class="form-control" placeholder="00000-000">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Logradouro</label>
                    <input type="text" name="logradouro" id="funcLogradouro" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Número</label>
                    <input type="text" name="numero" id="funcNumero" class="form-control">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Complemento</label>
                    <input type="text" name="complemento" id="funcComplemento" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Bairro</label>
                    <input type="text" name="bairro" id="funcBairro" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Município</label>
                    <input type="text" name="municipio" id="funcMunicipio" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">UF</label>
                    <input type="text" name="uf" id="funcUf" class="form-control" maxlength="2">
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">Salvar Funcionário</button>
                <button type="button" class="btn btn-outline-secondary" onclick="limparForm()">Novo / Limpar</button>
                <button type="button" id="btnExcluirFunc" class="btn btn-danger d-none" onclick="excluirFuncionario()">Excluir</button>
            </div>
        </form>
    </div>
</div>