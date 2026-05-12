<?php
namespace App\Models;

use PDO;

class Funcionario {
    private $conn;
    private $table = "funcionarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cpfExiste($cpf, $id = null) {
        $query = "SELECT id FROM " . $this->table . " WHERE cpf = :cpf";
        $params = [':cpf' => $cpf];

        if ($id) {
            $query .= " AND id != :id";
            $params[':id'] = $id;
        }

        $query .= " LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    public function salvar($data) {
        $params = [
            ':nome'            => $data['nome'],
            ':data_nascimento' => $data['data_nascimento'],
            ':cpf'             => $data['cpf'],
            ':cep'             => !empty($data['cep']) ? $data['cep'] : null,
            ':logradouro'      => !empty($data['logradouro']) ? $data['logradouro'] : null,
            ':numero'          => !empty($data['numero']) ? $data['numero'] : null,
            ':complemento'     => !empty($data['complemento']) ? $data['complemento'] : null,
            ':bairro'          => !empty($data['bairro']) ? $data['bairro'] : null,
            ':municipio'       => !empty($data['municipio']) ? $data['municipio'] : null,
            ':uf'              => !empty($data['uf']) ? $data['uf'] : null,
            ':email'           => !empty($data['email']) ? $data['email'] : null,
            ':telefone'        => !empty($data['telefone']) ? $data['telefone'] : null,
            ':id_cargo'        => $data['id_cargo']
        ];

        if (isset($data['id']) && !empty($data['id'])) {
            $query = "UPDATE " . $this->table . " SET 
                        nome=:nome, data_nascimento=:data_nascimento, cpf=:cpf, cep=:cep, 
                        logradouro=:logradouro, numero=:numero, complemento=:complemento, 
                        bairro=:bairro, municipio=:municipio, uf=:uf, email=:email, 
                        telefone=:telefone, id_cargo=:id_cargo 
                    WHERE id = :id";
            $params[':id'] = $data['id'];
        } else {
            $query = "INSERT INTO " . $this->table . " 
                        (nome, data_nascimento, cpf, cep, logradouro, numero, complemento, bairro, municipio, uf, email, telefone, id_cargo) 
                    VALUES 
                        (:nome, :data_nascimento, :cpf, :cep, :logradouro, :numero, :complemento, :bairro, :municipio, :uf, :email, :telefone, :id_cargo)";
            unset($params[':id']); 
        }

        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute($params);
    }

    public function listarRelatorio($nome = '', $id_cargo = '') {
        $query = "SELECT f.nome, f.telefone, c.nome as cargo, c.salario 
                  FROM " . $this->table . " f 
                  JOIN cargos c ON f.id_cargo = c.id 
                  WHERE f.nome LIKE :nome";
        
        $params = [':nome' => "%$nome%"];
        
        if (!empty($id_cargo)) {
            $query .= " AND f.id_cargo = :id_cargo";
            $params[':id_cargo'] = $id_cargo;
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar($busca = '') {
        $query = "SELECT f.*, c.nome as cargo_nome 
                FROM funcionarios f 
                JOIN cargos c ON f.id_cargo = c.id 
                WHERE f.nome LIKE :busca OR f.cpf LIKE :busca";
                
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':busca' => "%$busca%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}