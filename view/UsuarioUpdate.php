<?php 
include_once('./database/models/usuarioModel.php');
if(!isset($_SESSION['id'])){
    header('Location: /');
}
?>
<?php
include_once('painel/head.php');
?>
<?php
$usuarios = new UsuarioModel();
$usuarios = $usuarios->select();
foreach($usuarios as $usuario){ ?>
<main class="flex justify-center w-full h-full bg-violet-950">
    <div class="w-full max-w-screen-xl flex flex-col">
        <?php include_once('headerComponente.php') ?>
        <div class="flex flex-col h-full gap-4 w-full justify-center items-center">
            <h1 class="text-white font-bold text-3xl">USUARIOS</h1>
            <input id="nome" type="text" name=" <?php echo $usuario['nome'] ?>"
                class="bg-white text-black rounded-lg px-3 py-2 w-80 placeholder-black"
                placeholder=" <?php echo $usuario['nome'] ?>" value="<?php echo $usuario['nome'] ?>">
            <input id="sobrenome" type="text" name=" <?php echo $usuario['sobrenome'] ?>"
                class="bg-white text-black rounded-lg px-3 py-2 w-80  placeholder-black"
                placeholder="<?php echo $usuario['sobrenome'] ?>">
            <div class="w-80 flex gap-2 mb-10">
                <input id="email" type="text" name="<?php echo $usuario['email'] ?>"
                    class="bg-white text-black rounded-lg px-3 py-2 placeholder-black w-full"
                    placeholder="<?php echo $usuario['email'] ?>">
                <input id="senha" name="senha" placeholder=" senha" value="<?php echo $usuario['senha'] ?>"
                    class="bg-white w-full text-black rounded-lg placeholder-black" type="password">
                <input id="id" name="id" value="<?php echo $usuario['id'] ?>"
                    class="hidden bg-white w-full text-black rounded-lg placeholder-black" type="password">
            </div>
            <button
                class="cursor-pointer hover:bg-violet-800 text-black rounded-lg px-3 py-2 placeholder-black bg-violet-900	border border-black text-white text-semibold w-30"
                onclick="atualizarSenha()">ATUALIZAR</button>
        </div>
    </div>
</main>
<script>
    function atualizarSenha() {
        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var email = $('#email').val();
        var id = $('#id').val();
        var senha = $('#senha').val();

        $.ajax({
            type: 'POST',
            url: '/usuariosUpdate',
            data: {
                nome: nome,
                sobrenome: sobrenome,
                email: email,
                senha: senha,
                id: id
            },
            success: function (response) {
                alert(response);
            },
            error: function (xhr, status, error) {
                alert('Erro ao atualizar a senha: ' + xhr.responseText);
            }
        });
    }
</script>
<?php } ?>