<?php
namespace App\Models;

class Cargo {
    private $conn;
    private $table = "cargos";

    public function __construct($db) { $this->conn = $db; }

    public function listar($nome = '') {
        $query = "SELECT * FROM " . $this->table . " WHERE nome LIKE ? ORDER BY nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["%$nome%"]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function salvar($data) {
        $params = [
            ':nome'    => $data['nome'],
            ':salario' => $data['salario']
        ];

        if (isset($data['id']) && !empty($data['id'])) {
            $query = "UPDATE " . $this->table . " SET nome = :nome, salario = :salario WHERE id = :id";
            $params[':id'] = $data['id']; 
        } else {
            $query = "INSERT INTO " . $this->table . " (nome, salario) VALUES (:nome, :salario)";
        }

        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);
    }

    public function excluir($id) {     
        try {
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            
            if ($e->getCode() == '23000') {
                return false; 
            }
            throw $e;
        }
    }
}