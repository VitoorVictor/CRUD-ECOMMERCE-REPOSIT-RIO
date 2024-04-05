<?php
include_once('./database/models/produtoModel.php');
class ProdutosController
{
    public function index(){
        include_once('./view/painel/painelProduto.php');
    }

    public function cadastrar()
    {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $fornecedores_id = $_POST['fornecedor'];
        $produto = new ProdutoModel($id=null, $nome, $descricao, $preco, $fornecedores_id);
        $produto->insert();
    }

    public function select($id) {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT senha FROM produtos WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return json_encode($result);
        } catch(PDOException $e) {
            echo $e->getMessage(); 
        }
    }
    

    public function atualizar()
    {   
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $fornecedores_id = $_POST['fornecedores_id'];
        $produto = new ProdutoModel($id,$nome, $preco, $descricao, $fornecedores_id);
        $produto->update($id);
    }

    public function delete($id){
        $produto = new ProdutoModel();
        $produto->delete($id);
    }

    public function viewUpdate(){
        include_once('./view/ProdutoUpdate.php');
    }
}