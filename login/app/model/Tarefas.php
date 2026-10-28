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
        $user_id = intval($user_id);
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
        $sql = "INSERT INTO tarefas (descricao,usuario_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si",$descricao,$user_id);
        $resultado =  $stmt->execute();
        $stmt->close();
        return $resultado;
        
        
    }

    #excluir 
    public function deletar(int $tarefa_id,int $user_id){
        $terafa_id = intval($tarefa_id);
        $user_id = intval($user_id);
        $sql = "DELETE FROM tarefas WHERE id = ? AND usuario_id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii",$tarefa_id,$user_id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
    
    #atualizar
    public function atualizar(string $descricao,int $tarefa_id,int $user_id){
        $descricao = $this->conn->real_escape_string($descricao);
        $terafa_id = intval($tarefa_id);
        $user_id = intval($user_id);
        $sql = "UPDATE tarefas SET descricao = ? WHERE id = ? AND usuario_id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii",$descricao,$tarefa_id,$user_id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

 }