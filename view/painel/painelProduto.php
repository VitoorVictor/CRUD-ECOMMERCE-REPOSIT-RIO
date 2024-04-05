<?php 
    include_once('head.php');
    if(!isset($_SESSION['id'])){
        header('Location: /');
    }
    include_once('./database/models/fornecedorModel.php');
    include_once('./database/models/produtoModel.php');
?>

<body>
    <div class="w-full h-full flex justify-center">
        <section id="modal" class="bg-black bg-opacity-50 fixed w-full h-full flex justify-center items-center hidden">
            <div class="bg-violet-950 max-w-4xl w-full p-2 text-end rounded-lg">
                <span class="material-symbols-outlined text-white criar cursor-pointer">
                    close
                </span>
                <form action="/produtos" method="post" class="w-full flex justify-center items-center">
                    <div class="flex flex-col gap-2 items-center justify-center max-w-sm w-full">
                        <div>
                            <h1 class="text-white text-3xl font-semi-bold">PRODUTOS</h1>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input
                                class=" w-full rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  nome" required name="nome">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input
                                class=" w-full rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  descricao" required name="descricao">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  preço" required name="preco">
                            <select required
                                class="rounded-lg border-solid placeholder:text-black h-9 border border-black"
                                name="fornecedor" id="">
                                <?php
                                    $obj = new fornecedorModel();
                                    $fornecedor = $obj->all();
                                    if($fornecedor != null){
                                        foreach ($fornecedor as $fornecedo) {
                                        ?>
                                <option value="<?php echo $fornecedo['id'] ?>"><?php echo $fornecedo['razao_social'] ?>
                                </option>
                                <?php } } ?>
                            </select>
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
                <form action="/produtos" method="post" class="w-full flex justify-center items-center">
                    <div class="flex flex-col gap-2 items-center justify-center max-w-sm w-full">
                        <div>
                            <h1 class="text-white text-3xl font-semi-bold">PRODUTOS</h1>
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input
                                class=" w-full rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  nome" required name="nome">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2 min-[320px]:justify-center">
                            <input
                                class=" w-full rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  descricao" required name="descricao">
                        </div>
                        <div class="flex justify-between w-full flex-wrap gap-2">
                            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black "
                                type="text" placeholder="  preço" required name="preco">
                            <select required
                                class="rounded-lg border-solid placeholder:text-black h-9 border border-black"
                                name="fornecedor" id="">
                                <?php
                                    $obj = new fornecedorModel();
                                    $fornecedor = $obj->all();
                                    if($fornecedor != null){
                                        foreach ($fornecedor as $fornecedo) {
                                        ?>
                                <option value="<?php echo $fornecedo['id'] ?>"><?php echo $fornecedo['razao_social'] ?>
                                </option>
                                <?php } } ?>
                            </select>
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
                <div class="max-w-4xl w-full min-h-96 bg-violet-600  p-4 
             overflow-scroll min-w-96">
                    <?php
                        include_once('./database/models/fornecedorModel.php');
                    ?>
                    <div class="flex w-full justify-center gap-10 mb-4">
                        <h1 class="text-white text-3xl font-semi-bold">PRODUTOS</h1>
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
                            $obj = new ProdutoModel();
                            $produtos = $obj->all();
                            if($produtos != null){
                            foreach($produtos as $produto) {
                            ?>
                            <tr class="border-solid border-black border">
                                <td class="ps-2"><?php echo $produto['nome']; ?></td>
                                <td class="text-end w-10">
                                    <a class="update" href="/produtos/<?php echo $produto['id'];?>">
                                        <span class="material-symbols-outlined">settings</span>
                                    </a>
                                </td>
                                <td class="text-end w-10 pe-2">
                                    <?php 
                                        echo '<a onclick="deletar('.$produto["id"].')" id="deletar'.$produto["id"].'">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>';
                                    ?>
                                </td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
<script>
    
    function atualizar() {
        var nome = $('#nome').val();
        var descricao = $('#descricao').val();
        var fornecedores_id = $('#fornecedores_id').val();
        var id = $('#id').val();
        var preco = $('#preco').val();
        $.ajax({
            type: 'POST',
            url: '/produtosUpdate',
            data: {
                nome: nome,
                descricao: descricao,
                fornecedores_id: fornecedores_id,
                preco: preco,
                id: id
            },
            error: function (xhr, status, error) {
                alert('Erro ao atualizar a senha: ' + xhr.responseText);
            }
        });
    }

    function deletar(id) {
        $.ajax({
            type: 'POST',
            url: '/delete/produtos/' + id,
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