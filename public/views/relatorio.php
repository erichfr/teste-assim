<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Relatório de Funcionários</h4>
    </div>
    <div class="card-body">
        <form id="formFiltroRelatorio" class="row g-3 mb-4">
            <div class="col-md-5">
                <label class="form-label">Filtrar por Nome</label>
                <input type="text" id="filtroNome" class="form-control" placeholder="Digite o nome...">
            </div>
            <div class="col-md-4">
                <label class="form-label">Filtrar por Cargo</label>
                <select id="filtroCargo" class="form-select">
                    <option value="">Todos os Cargos</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Cargo</th>
                        <th>Salário (R$)</th>
                    </tr>
                </thead>
                <tbody id="tabelaRelatorio">
                    </tbody>
            </table>
        </div>
    </div>
</div>