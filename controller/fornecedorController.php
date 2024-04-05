<?php
include_once('./database/models/fornecedorModel.php');

class FornecedorController
{
    public function index(){
        include_once('./view/painel/painelFornecedores.php');
    }

    public function cadastrar()
    {
        $razao = $_POST['razao'];
        $cnpj = $_POST['cnpj'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $fornecedor = new FornecedorModel($razao, $email, $cnpj, $telefone);
        $fornecedor->insert();
    }
    
    public function delete($id){
        $produto = new FornecedorModel();
        $produto->delete($id);
    }

    public function viewUpdate(){
        include_once('./view/FornecedoresUpdate.php');
    }
}