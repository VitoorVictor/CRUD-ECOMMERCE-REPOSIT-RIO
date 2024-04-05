<?php
include_once('./database/connection.php');

class FornecedorModel{

    protected $razao;
    protected $email;
    protected $cnpj;
    protected $telefone;
    
    public function __construct($razao = null, $email = null, $cnpj = null, $telefone = null){
        $this->razao = $razao;
        $this->email = $email;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
    }

    public function insert() {
        try {
            $id = $_SESSION['id']; 
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("INSERT INTO fornecedores (`razao_social`, email, cnpj, telefone, usuarios_id) VALUES (:razao_social, :email, :cnpj, :telefone, :usuarios_id)");
            $stmt->bindParam(':razao_social', $this->razao);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':cnpj', $this->cnpj);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':usuarios_id', $id);
            $stmt->execute();
            header('Location: /painel/fornecedores');
            exit; 
        } catch(PDOException $e) {
            echo $e->getMessage(); 
        }
    }

    public function all() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT * FROM fornecedores";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage(); 
        }
    }

    public function select() {
        if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) {
            $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlParts = explode('/', $urlPath);
            $id = end($urlParts);
        }
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT * FROM fornecedores WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {

            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}