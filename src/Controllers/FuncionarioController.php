<?php
namespace App\Controllers;

use App\Models\Funcionario;
use App\Utils\Validator;

class FuncionarioController {
    private $model;

    public function __construct($db) {
        $this->model = new Funcionario($db);
    }

    public function salvar($data) {

        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        
        if (!Validator::validarCPF($data['cpf'])) {
            return ['status' => 'error', 'message' => 'CPF inválido'];
        }

        if ($this->model->cpfExiste($data['cpf'], $data['id'] ?? null)) {
            return ['status' => 'error', 'message' => 'Este CPF já está cadastrado'];
        }

        if (!Validator::validarDataNascimento($data['data_nascimento'])) {
            return ['status' => 'error', 'message' => 'Data de nascimento inválida'];
        }

        if (empty($data['nome']) || empty($data['id_cargo'])) {
            return ['status' => 'error', 'message' => 'Campos obrigatórios ausentes'];
        }

        $res = $this->model->salvar($data);
        return $res ? ['status' => 'success', 'message' => 'Dados salvos!'] : ['status' => 'error', 'message' => 'Erro ao salvar'];
    }

    public function listar($busca) {

        return $this->model->listar($busca);
    }

    public function obter($id) {

        return $this->model->obterPorId($id);
    }

    public function excluir($id) {

        $sucesso = $this->model->excluir($id);
        return $sucesso ? ['status' => 'success', 'message' => 'Excluído!'] : ['status' => 'error'];
    }

    public function listarRelatorio($nome, $id_cargo) {
        
        return $this->model->listarRelatorio($nome, $id_cargo);
    }
}