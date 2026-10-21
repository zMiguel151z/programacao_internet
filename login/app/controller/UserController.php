<?php

require_once __DIR__ . "/../model/login.php";

class UserController {

    private Usuario $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

   public function index(){
       if(isset($_SESSION['id'])){
           header("Location: index.php?action=index");
           exit;
       }
   }

   public function autenticar(){
       if(!isset($_POST['email'], $_POST['senha'])){
           header("Location: index.php");
           exit;
       }

       $email = trim($_POST['email']);
       $senha = $_POST['senha'];

       if(empty($email) || empty($senha)){
           $erro = "prencha os dados!";
           include __DIR__ . "/../view/login.php";
       }

       $usuario = $this->usuarioModel->buscar($email);

       if($usuario && password_verify($senha, $usuario["senha"])){
           session_regenerate_id(true);
           $_SESSION['id'] = $usuario['id'];
           $_SESSION['nome'] = $usuario['nome'];

           header("Location: index.php?action=painel");
           exit;
       }

       $erro = "dados incorretos ou invalidos";
       include __DIR__ . "/../view/login.php";

   }

   public function painel(){
       if(!isset($_SESSION['id'])){
           header("Location: index.php");
           exit;
       }
       include __DIR__ . "/../view/painel.php";
   }

   public function logout(){
       session_destroy();
       header("Location: index.php");
       exit;
   }
   
   public function buscarUsuario(): ?array {
        return $this->usuarioModel->buscar((int) $_SESSION['usuario_id']);
    }

   public function criar(string $nome, string $email, string $senha){
        return $this->usuarioModel->criar($nome, $email, $senha);
    }

   public function atualizar(string $nome, string $email, string $senha){
        return $this->usuarioModel->atualizar($_SESSION['usuario_id'], $nome, $email, $senha);
    }

   public function deletar(){
        return $this->usuarioModel->deletar($_SESSION['id']);
    }
}
