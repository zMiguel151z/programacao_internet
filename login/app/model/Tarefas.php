<?php
 require_once __DIR__ . "/../config/database.php";

 class Tarefas{
    private mysqli $conn;

    public function __construct(){
        $banco = new DataBase();

        $this->conn = $banco->conectar();
    }

    #listar 
    public function listar(int $user_id){
        $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    #criar
    public function criar(string $descricao, int $user_id){
        $descricao = $this->conn->real_escape_string($descricao);
        $user_id = intval($user_id);
        $sql = "INSERT INTO tarefas (descricao,usuario_id) VALUES ('$descricao','$user_id')";
        return $this->conn->query($sql);
        
    }

    #excluir 
    public function deletar(int $id){
        $id = intval($id);
        $sql = "DELETE FROM tarefas WHERE id = '$id' ";
        return $this->conn->query($sql);
    }
    
    #atualizar
    public function atualizar(string $descricao, int $id){
        $descricao = $this->conn->real_escape_string($descricao);
        $id = intval($id);
        $sql = "UPDATE tarefas SET descricao = '$descricao' WHERE id = '$id' ";

        return $this->conn->query($sql);
    }

 }