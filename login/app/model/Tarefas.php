<?php
/**
 * Tarefas.php — Model (camada de dados) da tabela "tarefas".
 *
 * Cada tarefa pertence a um usuário (coluna usuario_id). Por isso todos os
 * métodos recebem também o id do usuário: assim ninguém vê ou altera
 * tarefas de outra pessoa.
 *
 * Lembrete: prepared statement usa "?" no lugar dos valores e bind_param
 * liga cada valor ao seu "?" (evita SQL Injection).
 */

require_once __DIR__ . "/../config/database.php";

 class Tarefas{
    // Conexão com o banco, guardada para ser usada pelos métodos.
    private mysqli $conn;

    /**
     * Construtor: roda ao fazer "new Tarefas()".
     * Abre a conexão e guarda em $this->conn.
     */
    public function __construct(){
        $banco = new DataBase();

        $this->conn = $banco->conectar();
    }

    /**
     * Lista as tarefas de um usuário, da mais nova para a mais antiga.
     *
     * @param int $usuario_id id do usuário logado
     * @return array lista de tarefas (cada item é um array com id, descricao...)
     */
    #listar 
    public function listar(int $usuario_id){
        // intval() garante que o id seja número inteiro.
        $usuario_id = intval($usuario_id);

        // WHERE usuario_id = ? filtra só as tarefas deste usuário.
        // ORDER BY data_criacao DESC = mais recentes primeiro.
        $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC";
        $stmt = $this->conn->prepare($sql);

        // "i" = inteiro (o id do usuário).
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        // get_result() devolve o conjunto de resultados da consulta.
        $result = $stmt->get_result();
    
        // fetch_all(MYSQLI_ASSOC) devolve TODAS as linhas como arrays
        // associativos (ex.: $tarefa['descricao']).
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Cria uma nova tarefa para o usuário.
     *
     * @param string $descricao texto da tarefa
     * @param int    $usuario_id dono da tarefa
     * @return bool true se gravou
     */
    #criar
    public function criar(string $descricao, int $usuario_id){
        $usuario_id = intval($usuario_id);

        // Insere descrição e dono. Os "?" são preenchidos pelo bind_param.
        $sql = "INSERT INTO tarefas (descricao,usuario_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);

        // "si" = string (descrição) + inteiro (id do usuário).
        $stmt->bind_param("si",$descricao,$usuario_id);
        $resultado =  $stmt->execute();
        $stmt->close();
        return $resultado;
        
        
    }

    /**
     * Apaga uma tarefa do usuário.
     * O "AND usuario_id = ?" impede apagar tarefa de outra pessoa.
     *
     * @param int $id id da tarefa
     * @param int $usuario_id id do usuário logado
     * @return bool true se apagou
     */
    #excluir 
    public function deletar(int $id,int $usuario_id){
        $id = intval($id);
        $usuario_id = intval($usuario_id);

        $sql = "DELETE FROM tarefas WHERE id = ? AND usuario_id = ? ";
        $stmt = $this->conn->prepare($sql);

        // "ii" = dois inteiros (id da tarefa e id do usuário).
        $stmt->bind_param("ii",$id,$usuario_id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
    
    /**
     * Altera a descrição de uma tarefa do usuário.
     *
     * @param string $descricao novo texto
     * @param int    $id id da tarefa
     * @param int    $usuario_id id do usuário logado
     * @return bool true se atualizou
     */
    #atualizar
    public function atualizar(string $descricao,int $id,int $usuario_id){
        $id = intval($id);
        $usuario_id = intval($usuario_id);

        $sql = "UPDATE tarefas SET descricao = ? WHERE id = ? AND usuario_id = ? ";
        $stmt = $this->conn->prepare($sql);

        // "sii" = string (descrição) + inteiro (id) + inteiro (usuário).
        $stmt->bind_param("sii",$descricao,$id,$usuario_id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

 }
