<?php
require_once __DIR__ . '/app/controllers/controller.php'; 

$controller = new tarefaController(); 
$action = $_GET['action'] ?? 'index'; 
switch ($action){
    case 'criar': 
        $controller->criar(); 
        echo "criado";
        break; 
    case 'excluir': 
        $controller->deletar(); 
        echo "deletado";
        break; 
    case 'editar': 
        $controller->atualizar(); 
        echo "atualizado";
        break;
    default:
        $controller->index(); 
        break; 
}
