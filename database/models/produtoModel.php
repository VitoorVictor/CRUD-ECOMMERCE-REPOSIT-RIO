<?php
include_once('./database/connection.php');

class ProdutoModel{
    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $fornecedores_id;
    
    public function __construct($id = null, $nome = null, $preco = null, $descricao = null, $fornecedores_id = null){
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->fornecedores_id = $fornecedores_id;
    }

    public function insert() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, descricao, fornecedores_id ) VALUES (:nome, :preco, :descricao, :fornecedores_id)");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':fornecedores_id', $this->fornecedores_id);
            $stmt->execute();
            header('Location:/painel/produtos');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function all() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT * FROM produtos";
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
            $sql = "SELECT * FROM produtos WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    public function update($id) {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, fornecedores_id = :fornecedores_id, preco = :preco WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':fornecedores_id', $this->fornecedores_id);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {

            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}