<?php 

require_once __DIR__ . '/../config/database.php'; 

Class Usuario{
    private mysqli $conn; 

    public function __construct(){
        $db = new Database(); 
        $this->conn = $db->conectar(); 
    }

    public function buscarPorEmail(string $email){
         $email = $this->conn->real_escape_string($email);
         $sql = "SELECT * FROM usuarios WHERE email = ?";
         $stmt = $this->conn->prepare($sql); 
         $stmt->bind_param("s", $email); 
         $stmt->execute();

         $resultado = $stmt->get_result();
         return $resultado->fetch_assoc();
    }

    public function criar(string $nome,string $email,string $senha){
        $nome = $this->conn->real_escape_string($nome);
        $email = $this->conn->real_escape_string($email);
        $senha = $this->conn->real_escape_string($senha);

        $sql = "INSERT INTO usuarios (nome,email,senha) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss",$nome,$email,$senha);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
        
    }
    public function atualizar(int $id,string $nome,string $email,string $senha){
        $id = intval($id);
        $nome = $this->conn->real_escape_string($nome);
        $email = $this->conn->real_escape_string($email);
        $senha = $this->conn->real_escape_string($senha);

        $sql = "UPDATE usuarios SET nome = ?,email = ?,senha = ? WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi",$nome,$email,$senha,$id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;

        
    }
    public function Deletar(int $id){
         $id = intval($id);

         $sql = "DELETE FROM usuarios WHERE id = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param("i",$id);
         $resultado = $stmt->execute();
         $stmt->close();
         return $resultado;
        
    }

}



?>