<?php
/**
 * index.php — Porta de entrada do sistema (o "front controller").
 *
 * Toda requisição do site chega neste arquivo. Ele lê o parâmetro "action"
 * da URL (ex.: index.php?action=autenticarUsuario) e decide qual método
 * do controller deve ser executado. Pense nele como o "cérebro" que liga
 * cada endereço (URL) à ação correspondente.
 */

// session_start() inicia (ou retoma) a sessão do usuário.
// Sessão é a "memória" do site: guarda dados (id, nome, e-mail) entre uma
// página e outra. Precisa ser chamada antes de qualquer saída (echo/HTML).
session_start();

// require_once carrega o arquivo apenas uma vez. __DIR__ é a pasta deste arquivo.
// Sem os controllers não conseguiríamos criar os objetos usados logo abaixo.
require_once __DIR__ . '/app/controller/UserController.php';
require_once __DIR__ . '/app/controller/TarefaController.php';


// "new" cria um objeto (instância) de cada controller.
// A partir daqui temos $userController e $tarefaController prontos para uso.
$userController = new UserController();
$tarefaController = new TarefaController();


// $_GET é um array com os dados enviados pela URL no formato ?chave=valor.
// O operador ?? diz: "use $_GET['action']; se ele não existir, use 'index'".
$action = $_GET['action'] ?? 'index';

// switch compara $action com cada "case" e executa o bloco correspondente.
switch($action){
    case 'autenticarUsuario':
        // POST do formulário de login: valida e-mail/senha e cria a sessão.
        $userController->autenticar();
        break; // break encerra este case (senão cairia no próximo)

    case 'cadastrarUsuario':
        // Apenas mostra a tela de cadastro. O include "cola" o HTML da view aqui.
        include __DIR__ . '/app/view/cadastro.php';
        break;

    case 'criarUsuario':
        // POST do formulário de cadastro: grava o novo usuário no banco.
        $userController->criar();
        break;

    case 'atualizarUsuario':
        // POST do modal de edição: atualiza os dados do usuário logado.
        $userController->atualizar();
        break;

    case 'deletarUsuario':
        // POST do modal de exclusão: apaga a conta do usuário logado.
        $userController->deletar();
        break;

    case 'painelUsuario':
        // painel() desenha o cabeçalho do painel (e protege por sessão);
        // index() do TarefaController lista as tarefas do usuário.
        $userController->painel();
        $tarefaController->index();
        break;

    case 'logoutUsuario':
        // Encerra a sessão e volta para a tela de login.
        $userController->logout();
        break;

    case 'criarTarefa':
        // POST do formulário "Adicionar tarefa".
        $tarefaController->criar();
        break;

    case 'excluirTarefa':
        // Link "Excluir" de uma tarefa (o id vem pela URL, em $_GET).
        $tarefaController->deletar();
        break;

    case 'editarTarefa':
        // POST do modal "Editar tarefa".
        $tarefaController->atualizar();
        break;

    default:
        // Nenhuma action conhecida: mostra o login (ou o painel, se já logado).
        $userController->index();
        break;
}
?>
