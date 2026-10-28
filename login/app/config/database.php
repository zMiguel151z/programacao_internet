<?php
/**
 * database.php — Configuração e criação da conexão com o MySQL.
 *
 * Esta classe guarda os dados de acesso ao banco e oferece o método
 * conectar(), que devolve uma conexão pronta para ser usada pelos models.
 */

Class Database {
    // Dados de acesso ao servidor MySQL.
    // private = só esta classe pode ler/alterar esses valores.
    private $host = "127.0.0.1";   // endereço do servidor (localhost)
    private $user = "root";        // usuário do MySQL
    private $senha = "";           // senha do MySQL (vazia no XAMPP padrão)
    private $banco = "banco_tarefas"; // nome do banco de dados usado

    // Aqui ficará guardada a conexão. O tipo mysqli diz que é um objeto MySQLi.
    public mysqli $conn;

    /**
     * Abre a conexão com o banco e a devolve.
     *
     * @return mysqli conexão aberta
     */
    public function conectar(){
        // "new mysqli(...)" cria o objeto de conexão usando host, usuário,
        // senha e nome do banco informados acima.
        $this->conn = new mysqli($this->host, $this->user, $this->senha, $this->banco);

        // connect_error só tem valor quando a conexão falhou.
        if($this->conn->connect_error){
            // die() mostra a mensagem e encerra o script imediatamente.
            die("Deu erro na conexão do banco" . $this->conn->connect_error);
        }

        // Devolve a conexão para quem chamou o método.
        return $this->conn;
    }
}


?>
