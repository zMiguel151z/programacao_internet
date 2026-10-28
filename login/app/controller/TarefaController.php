<?php
/**
 * TarefaController.php — Controller responsável pelas tarefas.
 *
 * Recebe as ações de tarefa (criar, excluir, editar), valida o básico,
 * chama o model Tarefas e redireciona de volta para o painel.
 */

require_once __DIR__ . "/../model/Tarefas.php";

class TarefaController{
    // Model que conversa com a tabela "tarefas".
    private Tarefas $tarefaModel;

    /**
     * Construtor: roda ao fazer "new TarefaController()".
     * Cria o model (que já abre a conexão com o banco).
     */
    public function __construct(){
       $this->tarefaModel = new Tarefas();
    }

    /**
     * Lista as tarefas do usuário logado e mostra a view.
     *
     * @return void
     */
    public function index(){
        // $_SESSION['id_usuario'] foi gravado no login.
        // Passamos esse id para o model listar só as tarefas do dono.
        $tarefas = $this->tarefaModel->listar($_SESSION['id_usuario']);

        // A variável $tarefas fica disponível dentro da view incluída.
        include __DIR__ . "/../view/listar.php";
    }

    /**
     * Cria uma tarefa nova.
     *
     * @return void
     */
    public function criar(){
        // Só cria se: a descrição veio no POST, não é vazia e há usuário logado.
        // trim() remove espaços; empty() detecta vazio.
        if(isset($_POST['descricao']) && !empty(trim($_POST['descricao'])) && !empty($_SESSION['id_usuario']) ){
            $this->tarefaModel->criar($_POST['descricao'],$_SESSION['id_usuario']);
        }

        // Depois de criar (ou ignorar), volta ao painel.
        header("Location: index.php?action=painelUsuario");
    }

    /**
     * Exclui uma tarefa.
     *
     * @return void
     */
    public function deletar(){
        // O id da tarefa chega pela URL (link "Excluir"), em $_GET.
        // Só exclui se o id existe e o usuário está logado.
        if(isset($_GET['id']) && isset($_SESSION['id_usuario'])){
            $this->tarefaModel->deletar($_GET['id'],$_SESSION['id_usuario']);
        }
        header("Location: index.php?action=painelUsuario");
    }

    /**
     * Atualiza a descrição de uma tarefa.
     *
     * @return void
     */
    public function atualizar(){
         // O id e a nova descrição vêm do formulário do modal (POST).
         if(isset($_POST['id']) && isset($_SESSION['id_usuario']) && isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            $this->tarefaModel->atualizar($_POST['descricao'],$_POST['id'],$_SESSION['id_usuario']);
         }
         header("Location: index.php?action=painelUsuario");
    }

}
