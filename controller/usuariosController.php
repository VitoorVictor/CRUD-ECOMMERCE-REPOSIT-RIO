<?php
include_once('./database/models/usuarioModel.php');
class UsuariosController
{
    public function index()
    {
        if($_SERVER['REQUEST_URI'] == '/painel/usuarios'){
            include_once('./view/painel/painelUsuario.php');
        }
        else{
            include_once('./view/cadastroView.php');
        }
    }

    public function cadastrar()
    {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha =  $_POST['senha'];
        $senha = hash('sha256', $senha);
        $usuario = new UsuarioModel($id = null, $nome, $sobrenome, $email, $senha);
        $usuario->insert();
    }

    public function delete($id){
        $usuario = new UsuarioModel();
        $usuario->delete($id);
    }

    public function atualizar()
    {   
        $senha = $this->select($_POST['id']);
        if($senha == $_POST['senha']){
            $senha = $_POST['senha'];
        }else{
            $senha = hash('sha256', $_POST['senha']);
        }
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $usuario = new UsuarioModel($id,$nome, $sobrenome, $email, $senha);
        $usuario->update($id);
    }

    public function select($id) {
        try {
            $connection = new Connection();
            $pdo = $connection->getPdo();
            $sql = "SELECT senha FROM usuarios WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['senha'];
        } catch(PDOException $e) {
            echo $e->getMessage(); 
        }
    }

    public function viewUpdate(){
        include_once('./view/usuarioUpdate.php');
    }
}