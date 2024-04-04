<?php
include_once('./database/connection.php');

class UsuarioModel{

    protected $id;
    protected $nome;
    protected $sobrenome;
    protected $email;
    protected $senha;
    
    public function __construct($id = null, $nome = null, $sobrenome = null, $email = null, $senha = null){
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->id = $id;
    }

    public function insert() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (:nome, :sobrenome, :email, :senha)");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':sobrenome', $this->sobrenome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
            header('Location:/login');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function verificar() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario) {
                $senha_hash = hash('sha256', $this->senha);
                if ($senha_hash === $usuario['senha']) {
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
                    $_SESSION['email'] = $usuario['email'];
                    header('Location:/');
                    exit();
                } else {
                    header('Location:/login');
                    exit();
                }
            } else {
                header('Location:/login');
                exit();
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    public function all() {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT * FROM usuarios";
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
            
            $sql = "SELECT * FROM usuarios WHERE id = :id";
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
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':sobrenome', $this->sobrenome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('Location:/painel/usuarios');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}