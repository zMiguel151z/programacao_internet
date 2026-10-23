<?php
session_start();
require_once __DIR__ . '/app/controller/UserController.php';
require_once __DIR__ . '/app/controller/TarefaController.php';


$userController = new UserController();
$tarefaController = new TarefaController();


$action = $_GET['action'] ?? 'index';
switch($action){
    case 'autenticar':
        $userController->autenticar();
        break;

    case 'painel':
        $userController->painel();
        $tarefaController->index();
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'criar':
        $tarefaController->criar();
        break;

    case 'excluir':
        $tarefaController->deletar();
        break;

    case 'editar':
        $tarefaController->atualizar();
        break;

    default:
        $userController->index();
        break;
}


