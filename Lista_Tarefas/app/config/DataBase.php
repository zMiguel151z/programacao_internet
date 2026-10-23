<?php


class DataBase{

   private $host = "127.0.0.1";
   private $user = "root";
   private $senha = "";
   private $banco = "todo_list";

   public mysqli $conn;

    public function conectar(){
        $this->conn = new mysqli($this->host,$this->user,$this->senha,$this->banco);

        if ($this->conn->connect_error) {
            die ("Algo deu errado com a conexão" . $this->conn->connect_error); 
        }

        return $this->conn;

    }


}