<?php
// recarregar classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/src/' . str_replace(['App\\', '\\'], ['', '/'], $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Config\Database;
use App\Controllers\CargoController;
use App\Controllers\FuncionarioController;

$database = new Database();
$db = $database->getConnection();

$module = $_GET['module'] ?? '';
$action = $_GET['action'] ?? '';

// rotas
if ($module) {
    header("Content-Type: application/json");
    if ($module === 'cargo') {
        $controller = new CargoController($db);
        echo json_encode($controller->processRequest($_SERVER["REQUEST_METHOD"], $action, $_REQUEST));
    } elseif ($module === 'funcionario') {
        $controller = new FuncionarioController($db);
        if ($action === 'salvar') echo json_encode($controller->salvar($_POST));
        if ($action === 'relatorio') echo json_encode($controller->listarRelatorio($_GET['nome'] ?? '', $_GET['id_cargo'] ?? ''));
        if ($action === 'excluir') echo json_encode($controller->excluir($_POST['id'])); 
        if ($action === 'listar') {
            echo json_encode($controller->listar($_GET['busca'] ?? ''));
            exit; 
        }
        if ($action === 'obter') {
            $id = $_GET['id'] ?? null;
            echo json_encode($controller->obter($id));
            exit; 
        }
    }
    exit;
}

// rota de interface
$page = $_GET['page'] ?? 'relatorio';
include __DIR__ . '/public/views/layout.php';