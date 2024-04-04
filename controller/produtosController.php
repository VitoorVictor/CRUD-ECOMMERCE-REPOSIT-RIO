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
        $carrinho_id = $_POST['carrinho_id'];
        $produto = new ProdutoModel($nome, $descricao, $preco, $fornecedores_id, $carrinho_id);
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
            return $stmt->fetch(PDO::FETCH_ASSOC)['senha'];
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