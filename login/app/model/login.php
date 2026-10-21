<?php

require_once __DIR__ . "/../config/database.php";

class Login{

    private mysqli $conn;

    public function __construct(){
        $banco = new Database();
        $this->conn = $banco->conectar();
    }


    public function autenticar(string $email, string $senha): ?array {
        $stmt = $this->conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $usuario = $stmt->get_result()->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return null;
    }

    public function buscar(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT id, nome, email FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $usuario = $stmt->get_result()->fetch_assoc();

        return $usuario ?: null;
    }

    public function criar(string $nome, string $email, string $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senhaHash);
        return $stmt->execute();
    }
    public function atualizar(int $id, string $nome, string $email, string $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = ? , email = ? , senha = ? WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $senhaHash,$id);
        return $stmt->execute();
    }
    public function deletar(int $id){
        $sql = "DELETE FROM usuarios WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}