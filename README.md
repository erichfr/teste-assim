# Sistema de Gestão Assim Saúde

Este projeto é um sistema de gestão de funcionários e cargos desenvolvido para o teste técnico da Assim Saúde. O sistema permite o cadastro completo de funcionários, gestão de cargos e geração de relatórios de salários.

## Ferramentas Utilizadas

- **Backend:** PHP 8.1+ (Arquitetura MVC)
- **Banco de Dados:** MySQL 8.0
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript (jQuery)
- **Componentes de UI:** SweetAlert2 (Alertas), jQuery Mask (Máscaras de input)
- **Containerização:** Docker & Docker Compose
- **Ferramenta de Banco:** Adminer (disponível via container)

## Estrutura

O projeto está organizado da seguinte forma:

- `/src`: Contém a lógica de negócio (Models e Controllers).
- `/public`: Contém os arquivos acessíveis pelo navegador (CSS, JS, Views).
- `/docker`: Configurações de ambiente.
- `index.php`: Ponto de entrada (Router).

## Instalação e Execução

Para rodar o projeto localmente, você precisará ter o **Docker** e o **Docker Compose** instalados em sua máquina.

### 1. Clonar o Repositório
```bash
git clone https://github.com/erichfr/teste-assim
cd teste-assim
```
### 2. Subir o Ambiente Docker
```bash
docker-compose up -d --build
```
### 3. Acessar o sistema
Após os containers estarem "Up", acesse pelo seu navegador:</br>
URL do Sistema: http://localhost:8080</br>
Adminer (Banco): http://localhost:8081

### 4. Configuração do Banco de Dados
O sistema está configurado para criar as tabelas automaticamente via script inicial, mas caso precise acessar o banco manualmente via Adminer:</br>

- **Servidor:** `db`
- **Usuário:** `root`
- **Senha:** `root`
- **Banco de Dados::** `assim_saude`

### 4. Funcionalidades Implementadas

- **Gestão de Cargos: Cadastro, listagem, edição e exclusão de cargos com valor salarial.**
- **Gestão de Funcionários: - Cadastro completo com campos de endereço e contato.**
- **Relatório: Listagem cruzada de funcionários e cargos com filtros de pesquisa.**

### 5. Observações

- **Se o sistema redirecionar para localhost/index.php (sem a porta 8080), limpe o cache do seu navegador ou utilize uma Janela Anônima.**
- **Gestão de Funcionários: - Cadastro completo com campos de endereço e contato.**
- **Certifique-se de que as portas 8080 e 3306 não estejam sendo usadas por outros serviços.**


