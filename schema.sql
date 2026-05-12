CREATE DATABASE IF NOT EXISTS assim_saude;
USE assim_saude;

CREATE TABLE IF NOT EXISTS cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL, 
    salario DECIMAL(10, 2) NOT NULL  
);

CREATE TABLE IF NOT EXISTS funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,  
    data_nascimento DATE NOT NULL,  
    cpf VARCHAR(14) NOT NULL UNIQUE,  
    cep VARCHAR(9),
    logradouro VARCHAR(255),
    numero VARCHAR(20),
    complemento VARCHAR(100),
    bairro VARCHAR(100),
    municipio VARCHAR(100),
    uf CHAR(2),
    email VARCHAR(150),
    telefone VARCHAR(20),
    id_cargo INT NOT NULL, 
    FOREIGN KEY (id_cargo) REFERENCES cargos(id)
);