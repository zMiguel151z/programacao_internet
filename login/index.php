<?php
session_start();
require_once __DIR__ . '/app/controller/UserController.php';
$controller = new UserController();
$action = $_GET['action'] ?? 'index';
switch($action){
    case 'autenticar':
        $controller->autenticar();
        break;

    case 'painel':
        $controller->painel();
        break;

    case 'logout':
        $controller->logout();
        break;

    default:
        $controller->index();
        break;
}
