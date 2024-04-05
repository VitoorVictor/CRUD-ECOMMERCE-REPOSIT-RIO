<?php 
    include_once('head.php');
    if(!isset($_SESSION['id'])){
        header('Location: /');
    }
?>

<body>
    <div class="w-full h-full flex justify-center">
        <section id="modal" class="bg-black bg-opacity-50 fixed w-full h-full flex justify-center items-center hidden">
            <div class="bg-violet-950 max-w-4xl w-full p-2 text-end rounded-lg">
                <span class="material-symbols-outlined text-white criar cursor-pointer">
                    close
                </span>
                <form action="/fornecedores" method="post" class="w-full flex justify-center items-center">
                    <div class="flex flex-col gap-2 items-center justify-center max-w-sm w-full">
                        <div>
                            <h1 class="text-white text-3xl font-semi-bold">FORNECEDORES</h1>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  razão social" required name="razao">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  cnpj" required name="cnpj">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  email" required name="email">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  telefone" required name="telefone">
                        </div>
                        <button
                            class="rounded-lg border-solid text-black bg-violet-900 h-9 border-black border text-white w-24">CRIAR</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="modalUpdate"
            class="bg-black bg-opacity-50 fixed w-full h-full flex justify-center items-center hidden">
            <div class="bg-violet-950 max-w-4xl w-full p-2 text-end rounded-lg">
                <span class="material-symbols-outlined text-white update cursor-pointer">
                    close
                </span>
                <form action="/fornecedores" method="post" class="w-full flex justify-center items-center">
                    <div class="flex flex-col gap-2 items-center justify-center max-w-sm w-full">
                        <div>
                            <h1 class="text-white text-3xl font-semi-bold">FORNECEDORES</h1>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  razão social" required name="razao">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  cnpj" required name="cnpj">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  email" required name="email">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  telefone" required name="telefone">
                        </div>
                        <button
                            class="rounded-lg border-solid text-black bg-violet-900 h-9 border-black border text-white w-24">ATUALIZAR</button>
                    </div>
                </form>
            </div>
        </section>

        <main class="flex justify-between items-center h-dvh w-full">
            <?php include_once('componentes/menuLateral.php') ?>
            <section class="flex-1 flex flex-col w-full h-full items-center gap-10">
                <?php include_once('./view/headerComponente.php') ?>
                <div class="max-w-4xl w-full min-h-96 bg-violet-600 p-4 
             overflow-scroll min-w-96">
                    <?php
                        include_once('./database/models/fornecedorModel.php');
                    ?>
                    <div class="flex w-full justify-center gap-10 mb-4">
                        <h1 class="text-white text-3xl font-semi-bold">FORNECEDORES</h1>
                        <button
                            class="rounded-lg border-solid text-black bg-violet-900 h-9 border-black border text-white w-24 criar">CRIAR</button>
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
                            $obj = new FornecedorModel();
                            $fornecedores = $obj->all();
                            if($fornecedores != null){
                            foreach ($fornecedores as $fornecedor) {
                            ?>
                            <tr class="border-solid border-black border">
                                <td class="ps-2"><?php echo $fornecedor['razao_social']; ?></td>
                                <td class="text-end w-10">
                                    <?php 
                                        echo '<a onclick="atualizar('.$fornecedor["id"].')" id="atualizar'.$fornecedor["id"].'">
                                         <span class="material-symbols-outlined">settings</span>
                                        </a>';
                                    ?>
                                </td>
                                <td class="text-end w-10 pe-2">
                                    <?php 
                                        echo '<a onclick="deletar('.$fornecedor["id"].')" id="deletar'.$fornecedor["id"].'">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>';
                                    ?>
                                </td>
                            </tr>
                            <?php } } ?>
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
            url: '/delete/fornecedores/' + id,
            data: {},
            success: function (response) {
                $('#deletar' + id).closest('tr').remove();
            },
            error: function (xhr, status, error) {
                alert(response);
                alert('Erro ao atualizar ao deletar: ' + xhr.responseText);
            }
        });
    }

    function atualizar(id) {
        $.ajax({
            type: 'POST',
            url: '/atualizar/fornecedores/' + id,
            data: {},
            success: function (response) {
                $('#atualizar' + id).closest('tr').remove();
            },
            error: function (xhr, status, error) {
                alert(response);
                alert('Erro ao atualizar ao atualizar: ' + xhr.responseText);
            }
        });
    }

    modal = document.getElementById('modal');
    btnModal = document.querySelectorAll('.criar');

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

    modalUpdate = document.getElementById('modalUpdate');
    btnModalUpdate = document.querySelectorAll('.update');

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.contains('hidden') ? modal.classList.remove('hidden') : modal.classList.add(
                'hidden');
        }
    });

    btnModalUpdate.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            modal.classList.contains('hidden') ? modal.classList.remove('hidden') : modal.classList.add(
                'hidden');
        });
    });
</script>