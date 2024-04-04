<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $get = [
        '/' => 'home',
        '/carrinho' => 'carrinho',
        '/painel'  => 'painel',
        '/painel/usuarios'  => 'usuarios',
        '^\/usuarios\/(\d+)$'  => 'usuarios',
        '^\/fornecedores\/(\d+)$'  => 'fornecedor',
        '^\/produtos\/(\d+)$'  => 'produtos',
        '/painel/fornecedores'  => 'fornecedor',
        '/painel/produtos'  => 'produtos',
        '/login' => 'login',
        '/logout' => 'logout',
        '/cadastro' => 'usuarios',
    ];
    
    if($_SERVER['REQUEST_URI'] == '/painel'){
        header('Location:/painel/usuarios');
    }

    foreach ($get as $pattern => $value) {
        if (preg_match("~^$pattern$~", $_SERVER['REQUEST_URI'], $matches)) {
            include_once("./controller/{$value}Controller.php");
            $class = ucfirst($value) . 'Controller';
            if(isset($matches[1])){
                $id = $matches[1]; 
                $controller = new $class();
                $controller->viewUpdate($id);
            } else {
                $controller = new $class();
                $controller->index();
            }  
        }    
    }
    
}else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $post = [
        '/usuarios' => 'usuarios',
        '/login' => 'login',
        '/fornecedores' => 'fornecedor',
        '/produtos' => 'produtos',
        '/usuariosUpdate' => 'usuarios',
        '/produtosUpdate' => 'produtos',
        '^\/delete\/usuarios\/(\d+)$' => 'usuarios',
        '^\/delete\/produtos\/(\d+)$' => 'produtos', 
        '^\/delete\/fornecedores\/(\d+)$' => 'fornecedor', 
    ];
    foreach ($post as $key => $value) {
        if ($_SERVER['REQUEST_URI'] == $key) {
            include_once("./controller/{$value}Controller.php");
            $class = ucfirst($value).'Controller';
            $controller = new $class();
            if (strpos($_SERVER['REQUEST_URI'], 'delete') !== false) {
                preg_match('/^\/delete\/(\w+)\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches);
                $controller->delete($matches[1], $matches[2]);
            } else if ($value == 'login') {
                $controller->logar();
            } elseif (strpos($_SERVER['REQUEST_URI'], 'Update') !== false) {
                $controller->atualizar();
            } else {
                $controller->cadastrar();
            }
        }
    }
}