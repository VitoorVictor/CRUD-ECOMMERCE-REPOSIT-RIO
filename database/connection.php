<?php

class Connection {

    private $host = 'localhost';
    private $dbname = 'mydb';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
    
            if (!$this->databaseExists()) {
                $this->createDatabase();
            }
    
            $this->selectDatabase();
    
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            die();
        }
    }
    
    private function selectDatabase() {
        try {
            $this->pdo->exec("USE $this->dbname");
        } catch(PDOException $e) {
            echo "Erro ao selecionar o banco de dados: " . $e->getMessage();
            die();
        }
    }
    
    
    
    private function databaseExists() {
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->dbname'");
        return $stmt->rowCount() > 0;
    }

    private function createDatabase() {
        try {
            $sql = file_get_contents('banco.sql');
            $this->pdo->exec($sql);
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            die();
        }
    }
    

    public function getPdo() {
        return $this->pdo;
    }
}
?>