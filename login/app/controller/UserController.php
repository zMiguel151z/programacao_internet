<?php 

require_once __DIR__ . "/../model/usuario.php";

Class UserController{

    private Usuario $usuarioModel;
    
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function index(){
        if(isset($_SESSION['id_usuario'])){
            header("Location: index.php?action=painelUsuario");
            exit;
        }
        include __DIR__ . "/../view/login.php"; 
    }

    public function autenticar(){
        if(!isset($_POST['email'], $_POST['senha'])){
            header("Location: index.php");
            exit; 
        }

        $email = trim($_POST['email']); 
        $senha = $_POST['senha']; 

        if(empty($email) || empty($senha)){
            $erro = "Preencha seu email e senha";
            include __DIR__ . "/../view/login.php";
            return;
        }

        $usuario = $this->usuarioModel->buscarPorEmail($email);

        

        $erro = "E-mail ou senha estão incorretos";
        include __DIR__ . '/../view/login.php';
        return;

    }

    public function param_existe($var) {
        return trim($var ?? '') !== '';
    }
    
    public function criar() {
        $nome  = trim($_POST["nome"]  ?? '');
        $email = trim($_POST["email"] ?? '');
        $senha = $_POST["senha"] ?? '';
    
        if (!self::param_existe($nome) || !self::param_existe($email) || !self::param_existe($senha)) {
            $erro = "Preencha todos os campos";
            include __DIR__ . "/../view/cadastro.php";
            return;
        }
    
        if ($this->usuarioModel->buscarPorEmail($email)) {
            $erro = "Email já existe";
            include __DIR__ . "/../view/cadastro.php";
            return;
        }
    
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $this->usuarioModel->criar($nome, $email, $senhaHash);
        header("location: index.php");
        exit;
    }

    public function atualizar(){
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php");
            exit;
        }

        $id    = $_POST["id"] ?? '';
        $nome  = trim($_POST["nome"]  ?? '');
        $email = trim($_POST["email"] ?? '');
        $senha = $_POST["senha"] ?? '';

        if (!self::param_existe($id) || !self::param_existe($nome) || !self::param_existe($email) || !self::param_existe($senha)) {
            $_SESSION['erro_usuario'] = "Preencha todos os campos";
            header("Location: index.php?action=painelUsuario");
            exit;
        }

        if ((int) $id !== (int) $_SESSION['id_usuario']) {
            header("Location: index.php?action=painelUsuario");
            exit;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $this->usuarioModel->atualizar((int) $id, $nome, $email, $senhaHash);

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        unset($_SESSION['erro_usuario']);
        header("Location: index.php?action=painelUsuario");
        exit;
    }

    public function deletar(){
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php");
            exit;
        }

        $this->usuarioModel->Deletar($_SESSION['id_usuario']);
        include __DIR__ . "/../view/login.php";
        exit;
    }
    
    public function painel(){
        if(!isset($_SESSION['id_usuario'])){
            header("Location: index.php");
            exit; 
        }
        include __DIR__ . '/../view/painel.php';
    }

    public function logout(){
        session_destroy(); 

        
        header("Location: index.php");
        exit;
    }

    
    
}
