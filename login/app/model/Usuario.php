<?php

require_once __DIR__ . "/../config/database.php";

class Usuario{

    private mysqli $conn;

    public function __construct(){
        $banco = new Database();
        $this->conn = $banco->conectar();
    }


    public function buscar(string $email): ?array {
        $stmt = $this->conn->prepare("SELECT nome FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
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
