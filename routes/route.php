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
    
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = [
        '/usuarios' => 'usuarios',
        '^\/buscar\/usuarios\/(\d+)$' => 'usuarios',
        '/login' => 'login',
        '/fornecedores' => 'fornecedor',
        '/produtos' => 'produtos',
        '^\/atualizar\/usuarios\/(\d+)$' => 'usuarios',
        '^\/delete\/usuarios\/(\d+)$' => 'usuarios',
        '^\/delete\/produtos\/(\d+)$' => 'produtos', 
        '^\/delete\/fornecedores\/(\d+)$' => 'fornecedor', 
    ];

    foreach ($post as $key => $value) {
        if (preg_match("~^$key$~", $_SERVER['REQUEST_URI'], $matches)) {;
            include_once("./controller/{$value}Controller.php");
            $class = ucfirst($value).'Controller';
            $controller = new $class();

            if (strpos($_SERVER['REQUEST_URI'], 'delete') !== false) {
                preg_match('/^\/delete\/(\w+)\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches);
                $controller->delete($matches[2]);
            } elseif(strpos($_SERVER['REQUEST_URI'], 'buscar') !== false) {
                preg_match('/^\/buscar\/(\w+)\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches);
                $controller->buscarPorId($matches[2]);
            } elseif(strpos($_SERVER['REQUEST_URI'], 'atualizar') !== false) {
                preg_match('/^\/atualizar\/(\w+)\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches);
                $controller->atualizar($matches[2]);
            } elseif ($value == 'login') {
                $controller->logar();
            } elseif (strpos($_SERVER['REQUEST_URI'], 'Update') !== false) {
                $controller->atualizar();
            } else {
                $controller->cadastrar();
            }
        }
    }
}