<?php 
    include_once('head.php');
    if(!isset($_SESSION['id'])){
        header('Location: /');
    }
?>

<body>
    <div class="w-full h-full flex justify-center">
        <?php
            include_once('./database/models/usuarioModel.php');
        ?>
        <section id="modal" class="bg-black bg-opacity-50 fixed w-full h-full flex justify-center items-center hidden">
            <div class="bg-violet-950 max-w-4xl w-full p-2 text-end rounded-lg">
                <span class="material-symbols-outlined text-white criar cursor-pointer">
                    close
                </span>
                <form action="/cadastro" method="POST" class="w-full flex justify-center items-center">
                    <div class="flex flex-col gap-2 items-center justify-center max-w-sm w-full">
                        <div>
                            <h1 class="text-white text-3xl font-semi-bold">USUARIOS</h1>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  nome" name="nome" required>
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  sobrenome" name="sobrenome" required>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  email" name="email" required>
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="password" placeholder="  senha" name="senha">
                            <input type="hidden" name="painel" value="true" required>
                        </div>
                        <button
                            class="rounded-lg border-solid text-black bg-violet-900 h-9 border-black border text-white w-24">CRIAR</button>
                    </div>
                </form>
            </div>
        </section>

        <main class="flex justify-between items-center h-dvh max-w-screen-xl w-full pt-2">
            <?php include_once('componentes/menuLateral.php') ?>
            <section class="flex-1 flex flex-col w-full h-full items-center gap-10 p-2">
                <?php include_once('./view/headerComponente.php') ?>
                <div class="max-w-4xl w-full min-h-96 bg-violet-600 rounded-lg p-4 
             overflow-scroll min-w-96">
                    <?php
                        include_once('./database/models/usuarioModel.php');
                    ?>
                    <div class="flex w-full justify-center gap-10 mb-4">
                        <h1 class="text-white text-3xl font-semi-bold">USUARIOS</h1>
                    </div>
                    <table class="w-full p-8 text-white">
                        <thead class="border-solid border-black border">
                            <tr>
                                <th class="text-start ps-2">NOME</th>
                                <th colspan="2" class="text-end pe-2">OPÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $parametro;
                        $obj = new UsuarioModel();
                        $usuarios = $obj->all();
                        foreach ($usuarios as $usuario) {
                        ?>
                            <tr class="border-solid border-black border">
                                <td class="ps-2"><?php echo $usuario['nome']; ?></td>
                                <td class="text-end w-10">
                                    <?php 
                                        if ($usuario['id'] == $_SESSION['id']) {
                                        echo '<a class="update" href="/usuarios/' . $usuario["id"] . '">
                                                    <span class="material-symbols-outlined">settings</span>
                                                </a>';
                                        } 
                                    ?>
                                </td>
                                <td class="text-end w-10 pe-2">
                                <td class="text-end w-10 pe-2">
                                    <?php 
                                    echo '<a onclick="deletar('.$usuario["id"].')" id="deletar'.$usuario["id"].'">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>';
                                    ?>
                                </td>

                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>

<script>
    function deletar(id) {
        $.ajax({
            type: 'POST',
            url: '/delete/usuarios/' + id,
            data: {},
            success: function (response) {
                $('#deletar' + id).closest('tr').remove();
                console.log('Usuário excluído com sucesso!');
            },
            error: function (xhr, status, error) {
                alert('Erro ao atualizar ao deletar: ' + xhr.responseText);
            }
        });
    }

    modal = document.getElementById('modal');
    btnModal = document.querySelectorAll('.criar');
    btnMenu = document.querySelectorAll('.btnMenu');
    menu = document.getElementById('menu');

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.contains('hidden') ? modal.classList.remove('hidden') : modal.classList.add(
                'hidden');
        }
    });

    btnModal.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            modal.classList.contains('hidden') ? modal.classList.remove('hidden') : modal.classList.add(
                'hidden');
        });
    });

    btnMenu.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                btnMenu.textContent = 'close'
            } else {
                menu.classList.add('hidden');
                btnMenu.textContent = 'menu'
            }
        });
    });
</script>