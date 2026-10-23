<?php
session_start();
require_once __DIR__ . '/app/controller/UserController.php';
require_once __DIR__ . '/app/controller/TarefaController.php';


$userController = new UserController();
$tarefaController = new TarefaController();


$action = $_GET['action'] ?? 'index';
switch($action){
    case 'autenticarUsuario':
        $userController->autenticar();
        break;
    case 'cadastrarUsuario':
         include __DIR__ . '/app/view/cadastro.php';
        break;
        
    case 'criarUsuario':
        $userController->criar();
        break;
        
    case 'atualizarUsuario':
        $userController->atualizar();
        break;
        
    case 'deletarUsuario':
        $userController->deletar();
        break;

    case 'painelUsuario':
        $userController->painel();
        $tarefaController->index();
        break;

    case 'logoutUsuario':
        $userController->logout();
        break;

    case 'criarTarefa':
        $tarefaController->criar();
        break;

    case 'excluirTarefa':
        $tarefaController->deletar();
        break;

    case 'editarTarefa':
        $tarefaController->atualizar();
        break;

    default:
        $userController->index();
        break;
}
?>

<script>
    function mostrarMensagem(texto) {
        alert(texto);
    }

    mostrarMensagem(<?= json_encode($_SESSION['erro']) ?>;);
    
</script>