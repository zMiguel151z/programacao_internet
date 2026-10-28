<?php 
/**
 * Usuario.php — Model (camada de dados) da tabela "usuarios".
 *
 * Um "model" é a classe que conversa com o banco de dados. O controller
 * NÃO escreve SQL: ele chama métodos daqui (buscarPorEmail, criar, etc.).
 *
 * Glossário rápido:
 * - prepared statement: SQL com "?" no lugar dos valores; o banco recebe
 *   o comando e os dados separados, o que evita SQL Injection.
 * - bind_param: "amarra" os valores nos "?" (o "s"/"i" indica o tipo).
 */

require_once __DIR__ . '/../config/database.php'; 

Class Usuario{
    // Guarda a conexão com o banco. private = só esta classe usa.
    private mysqli $conn; 

    /**
     * Construtor: roda automaticamente quando fazemos "new Usuario()".
     * Aqui abrimos a conexão uma única vez e guardamos em $this->conn.
     */
    public function __construct(){
        $db = new Database();          // cria o objeto de configuração do banco
        $this->conn = $db->conectar(); // abre e guarda a conexão
    }

    /**
     * Procura um usuário pelo e-mail.
     *
     * @param string $email e-mail digitado no formulário
     * @return array|null os dados do usuário (id, nome, email, senha) ou null
     */
    public function buscarPorEmail(string $email){
         // real_escape_string "escapa" caracteres especiais (como aspas).
         // Observação: o prepared statement abaixo já protege contra SQL
         // Injection; este escape é redundante, mas foi mantido como está.
         $email = $this->conn->real_escape_string($email);

         // SQL com "?" = espaço reservado para o valor (prepared statement).
         $sql = "SELECT * FROM usuarios WHERE email = ?";

         // prepare() envia o comando ao banco e devolve um objeto statement.
         $stmt = $this->conn->prepare($sql); 

         // bind_param() liga o valor ao primeiro "?".
         // "s" significa string (texto). Se fossem dois, seria "ss".
         $stmt->bind_param("s", $email); 

         // execute() roda o comando no banco.
         $stmt->execute();

         // get_result() devolve o resultado da consulta.
         $resultado = $stmt->get_result();

         // fetch_assoc() pega UMA linha como array associativo
         // (ex.: $linha['email']). Se não achar ninguém, devolve null.
         return $resultado->fetch_assoc();
    }

    /**
     * Insere um novo usuário no banco.
     *
     * @param string $nome  nome completo
     * @param string $email e-mail (único)
     * @param string $senha senha JÁ criptografada (hash)
     * @return bool true se gravou com sucesso
     */
    public function criar(string $nome,string $email,string $senha){
        // Escapa os valores (ver observação em buscarPorEmail).
        $nome = $this->conn->real_escape_string($nome);
        $email = $this->conn->real_escape_string($email);
        $senha = $this->conn->real_escape_string($senha);

        // INSERT INTO ... VALUES (?,?,?) = três espaços reservados.
        $sql = "INSERT INTO usuarios (nome,email,senha) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);

        // "sss" = três strings, na ordem nome, email, senha.
        $stmt->bind_param("sss",$nome,$email,$senha);

        // execute() retorna true/false (deu certo ou não).
        $resultado = $stmt->execute();

        // close() libera o statement da memória.
        $stmt->close();

        return $resultado;
        
    }

    /**
     * Atualiza nome, e-mail e senha de um usuário pelo id.
     *
     * @param int    $id    id do usuário
     * @param string $nome  novo nome
     * @param string $email novo e-mail
     * @param string $senha nova senha já criptografada (hash)
     * @return bool true se atualizou
     */
    public function atualizar(int $id,string $nome,string $email,string $senha){
        // intval() garante que o id seja um número inteiro.
        $id = intval($id);

        // Escapa os textos (ver observação em buscarPorEmail).
        $nome = $this->conn->real_escape_string($nome);
        $email = $this->conn->real_escape_string($email);
        $senha = $this->conn->real_escape_string($senha);

        // UPDATE altera a linha cujo id é o último "?".
        $sql = "UPDATE usuarios SET nome = ?,email = ?,senha = ? WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);

        // "sssi" = três strings + um inteiro (o id).
        $stmt->bind_param("sssi",$nome,$email,$senha,$id);

        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;

        
    }

    /**
     * Apaga um usuário pelo id.
     * As tarefas dele também são apagadas por causa do ON DELETE CASCADE
     * definido no banco (o banco "arrasta" os registros dependentes).
     *
     * @param int $id id do usuário
     * @return bool true se apagou
     */
    public function Deletar(int $id){
         $id = intval($id);

         // DELETE apaga a linha cujo id é o "?".
         $sql = "DELETE FROM usuarios WHERE id = ?";
         $stmt = $this->conn->prepare($sql);

         // "i" = inteiro.
         $stmt->bind_param("i",$id);

         $resultado = $stmt->execute();
         $stmt->close();
         return $resultado;
        
    }

}



?>
