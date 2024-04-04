<?php
include_once('./database/models/usuarioModel.php');
class LoginController
{
    public function index()
    {
        include_once('./view/loginView.php');
    }

    public function logar(){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $usuario = new UsuarioModel($id = null, $nome = null, $sobrenome = null, $email, $senha);
        $usuario->verificar();
    }
}