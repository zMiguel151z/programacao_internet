<?php

require_once __DIR__ . "/../model/login.php";

class LoginController {

    private Login $loginModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->loginModel = new Login();
    }

    public function login(string $email, string $senha): bool {
        $usuario = $this->loginModel->autenticar($email, $senha);

        if ($usuario === null) {
            return false;
        }

        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        return true;
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
    }

    public function estaLogado(): bool {
        return isset($_SESSION['usuario_id']);
    }

    public function exigirLogin(): void {
        if (!$this->estaLogado()) {
            header("Location: /app/view/login.php");
            exit;
        }
    }

    public function buscarUsuario(): ?array {
        return $this->loginModel->buscar((int) $_SESSION['usuario_id']);
    }

    public function criar(string $nome, string $email, string $senha){
        return $this->loginModel->criar($nome, $email, $senha);
    }

    public function atualizar(string $nome, string $email, string $senha){
        return $this->loginModel->atualizar($_SESSION['usuario_id'], $nome, $email, $senha);
    }

    public function deletar(int $id){
        return $this->loginModel->deletar($_SESSION['usuario_id']);
    }   
}