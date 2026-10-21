<?php

Class Database {
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $banco = "login";

    public mysqli $conn;

    public function conectar(){
        $this -> conn = new mysqli($this->host, $this->user, $this->senha, $this->banco);

        if($this->conn->connect_error){
            die("Deu erro na conexão do banco" . $this->conn->connect_error);
        }

        return $this->conn;
    }
}


?>
