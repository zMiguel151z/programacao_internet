<?php 
/**
 * UserController.php — Controller responsável pelo usuário.
 *
 * No padrão MVC:
 * - Model (Usuario) conversa com o banco;
 * - View (login.php, cadastro.php, painel.php...) é o HTML;
 * - Controller (esta classe) recebe a requisição, valida os dados,
 *   chama o model e decide qual view mostrar ou para onde redirecionar.
 *
 * Glossário rápido:
 * - $_POST: dados enviados por formulários com method="POST".
 * - $_SESSION: "memória" do usuário entre páginas (precisa de session_start()).
 * - header("Location: ..."): manda o navegador para outra URL.
 * - exit: encerra o script na hora.
 */

require_once __DIR__ . "/../model/usuario.php";

Class UserController{

    // Aqui guardamos o model que fala com a tabela "usuarios".
    private Usuario $usuarioModel;
    
    /**
     * Construtor: roda automaticamente ao fazer "new UserController()".
     * Cria o model de usuário, que já abre a conexão com o banco.
     */
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    /**
     * Mostra a tela inicial (login) — ou o painel, se o usuário já estiver logado.
     *
     * @return void
     */
    public function index(){
        // isset() verifica se a chave existe na sessão.
        // Se existe id_usuario, é porque alguém já fez login.
        if(isset($_SESSION['id_usuario'])){
            header("Location: index.php?action=painelUsuario");
            exit;
        }

        // Não está logado: mostra o formulário de login.
        include __DIR__ . "/../view/login.php"; 
    }

    /**
     * Autentica o usuário comparando a senha digitada com o hash do banco.
     *
     * @return void
     */
    public function autenticar(){
        // isset() pergunta: "os campos email e senha vieram no POST?"
        // Se não vieram, não há o que validar: volta para o login.
        if (!isset($_POST['email'], $_POST['senha'])) {
            header("Location: index.php");
            exit;
        }
    
        // trim() remove espaços do começo/fim do e-mail.
        // A senha NÃO usa trim de propósito (espaço pode fazer parte da senha).
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];
    
        // empty() é true para "", "0", null ou valor inexistente.
        if (empty($email) || empty($senha)) {
            $erro = "Preencha seu email e senha";
            include __DIR__ . "/../view/login.php";
            return; // return sai só deste método (não encerra o site)
        }
    
        // Pede ao model para procurar o usuário pelo e-mail.
        // Pode voltar um array (achou) ou null (não achou).
        $usuario = $this->usuarioModel->buscarPorEmail($email);
    
        // Verifica a senha com o hash salvo no banco.
        // password_verify() compara o texto digitado com o hash; nunca
        // comparamos senha com senha, porque o banco guarda só o hash.
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login correto: guarda os dados na sessão.
            $_SESSION['id_usuario']   = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            // Mensagem "flash": aparece uma vez no painel e depois é apagada.
            $_SESSION["sucesso"] = "Login realizado com sucesso!";

            // Redireciona para o painel.
            header("Location: index.php?action=painelUsuario");
            exit;
        }
    
        // Mesma mensagem para email inexistente e senha errada
        // (não revelamos qual dos dois estava errado, por segurança).
        $erro = "E-mail ou senha estão incorretos";
        include __DIR__ . '/../view/login.php';
    }

    /**
     * Cadastra um novo usuário.
     *
     * @return void
     */
    public function criar() {
        // trim() limpa espaços; ?? '' usa string vazia se o campo não existir.
        $nome  = trim($_POST["nome"]  ?? '');
        $email = trim($_POST["email"] ?? '');
        $senha = $_POST["senha"] ?? '';
    
        // Validação simples: nenhum campo pode ficar vazio.
        if (empty($nome) || empty($email) || empty($senha)) {
            $erro = "Preencha todos os campos";
            include __DIR__ . "/../view/cadastro.php";
            return;
        }
    
        // Se buscarPorEmail devolver algo, o e-mail já está cadastrado.
        if ($this->usuarioModel->buscarPorEmail($email)) {
            $erro = "Email já existe";
            include __DIR__ . "/../view/cadastro.php";
            return;
        }
    
        // password_hash() transforma a senha em um "hash" (senha embaralhada).
        // PASSWORD_DEFAULT escolhe o algoritmo mais seguro disponível.
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Grava no banco: nome, e-mail e o hash (nunca a senha original).
        $this->usuarioModel->criar($nome, $email, $senhaHash);

        // Depois de cadastrar, volta para a tela de login.
        header("location: index.php");
        exit;
    }

    /**
     * Atualiza os dados do usuário logado.
     *
     * @return void
     */
    public function atualizar(){
        // Proteção: só usuário logado pode atualizar.
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php");
            exit;
        }

        // Lê os campos enviados pelo formulário do modal.
        $id    = trim($_POST["id"] ?? '');
        $nome  = trim($_POST["nome"]  ?? '');
        $email = trim($_POST["email"] ?? '');
        $senha = $_POST["senha"] ?? '';

        // Todos os campos são obrigatórios.
        if (empty($id) || empty($nome) || empty($email) || empty($senha)) {
            // Guarda o erro na sessão para mostrar no painel (flash message).
            $_SESSION['erro_usuario'] = "Preencha todos os campos";
            header("Location: index.php?action=painelUsuario");
            exit;
        }

        // (int) converte para inteiro. O usuário só pode editar a própria conta:
        // se o id enviado for diferente do id da sessão, ignora.
        if ((int) $id !== (int) $_SESSION['id_usuario']) {
            header("Location: index.php?action=painelUsuario");
            exit;
        }

        // Gera o hash da nova senha e manda o model atualizar no banco.
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $this->usuarioModel->atualizar((int) $id, $nome, $email, $senhaHash);

        // Mantém a sessão sincronizada com os novos dados.
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        // Limpa qualquer erro antigo e volta ao painel.
        unset($_SESSION['erro_usuario']);
        header("Location: index.php?action=painelUsuario");
        exit;
    }

    /**
     * Apaga a conta do usuário logado.
     *
     * @return void
     */
    public function deletar(){
        // Proteção: só usuário logado pode deletar a conta.
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php");
            exit;
        }

        // O model apaga o usuário; as tarefas dele caem por ON DELETE CASCADE.
        $this->usuarioModel->Deletar($_SESSION['id_usuario']);

        // Mostra a tela de login novamente.
        include __DIR__ . "/../view/login.php";
        exit;
    }
    
    /**
     * Mostra o painel do usuário (somente se estiver logado).
     *
     * @return void
     */
    public function painel(){
        // Sem id na sessão = não logado: manda para o login.
        if(!isset($_SESSION['id_usuario'])){
            header("Location: index.php");
            exit; 
        }
        include __DIR__ . '/../view/painel.php';
    }

    /**
     * Encerra a sessão (logout) e volta para o login.
     *
     * @return void
     */
    public function logout(){
        // session_destroy() apaga os dados da sessão no servidor.
        session_destroy(); 

        
        header("Location: index.php");
        exit;
    }

    
    
}
