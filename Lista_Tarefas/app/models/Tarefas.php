<?php
 require_once __DIR__ . "/../config/DataBase.php";

 class Tarefas{
    private mysqli $conn;

    public function __construct(){
        $banco = new DataBase();

        $this->conn = $banco->conectar();
    }

    #listar 

    public function listar() {
        $lista = [];
        $sql = "SELECT * FROM tarefas ORDER BY data_criacao DESC";
        $resultado = $this->conn->query($sql);

        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }

        return $lista;
    }

    #criar

    public function criar(string $descricao){
        $descricao = $this->conn->real_escape_string($descricao);
        $sql = "INSERT INTO tarefas (descricao) VALUES ('$descricao')";
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