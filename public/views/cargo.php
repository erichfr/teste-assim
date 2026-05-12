<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Gestão de Cargos</h4>
    </div>
    <div class="card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-9">
                <input type="text" id="pesquisaNomeCargo" class="form-control" placeholder="Pesquisar cargo por nome...">
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary w-100" onclick="buscarCargos()">Pesquisar</button>
            </div>
        </div>

        <div class="table-responsive mb-4" style="max-height: 200px;">
            <table class="table table-sm table-hover border">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Salário (R$)</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="tabelaCargos">
                    <tr><td colspan="3" class="text-center text-muted">Use a pesquisa para listar cargos.</td></tr>
                </tbody>
            </table>
        </div>

        <hr>

        <h5 id="tituloFormCargo">Novo Cargo</h5>
        <form id="formCargo">
            <input type="hidden" name="id" id="cargoId">
            <div class="row g-3">
                <div class="col-md-7">
                    <label class="form-label">Nome do Cargo *</label>
                    <input type="text" name="nome" id="cargoNome" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Salário *</label>
                    <input type="number" step="0.01" name="salario" id="cargoSalario" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                    <button type="button" id="btnExcluirCargo" class="btn btn-danger d-none" onclick="excluirCargo()">Excluir</button>
                </div>
            </div>
        </form>
    </div>
</div>