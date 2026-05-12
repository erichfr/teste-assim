<?php
namespace App\Controllers;

use App\Models\Cargo;

class CargoController {
    private $model;

    public function __construct($db) {
        $this->model = new Cargo($db);
    }

    public function processRequest($method, $action, $data) {
        switch ($action) {
            case 'listar':
                return $this->model->listar($data['nome'] ?? '');
            case 'salvar':
                if (empty($data['nome']) || empty($data['salario'])) {
                    return ['status' => 'error', 'message' => 'Nome e Salário são obrigatórios'];
                }
                return $this->model->salvar($data);
            case 'excluir':
                $sucesso = $this->model->excluir($data['id']);
                if (!$sucesso) {
                    return [
                        'status' => 'error', 
                        'message' => 'Não é possível excluir este cargo pois existem funcionários vinculados a ele.'
                    ];
                }
                return ['status' => 'success', 'message' => 'Cargo excluído com sucesso!'];
            default:
                return ['status' => 'error', 'message' => 'Ação inválida'];
        }
    }
}