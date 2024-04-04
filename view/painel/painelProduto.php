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
                            <select class="rounded-lg border-solid placeholder:text-black h-9 border border-black"
                                name="fornecedor" id="">
                                <?php
                                    $obj = new fornecedorModel();
                                    $fornecedor = $obj->all();
                                    foreach ($fornecedor as $fornecedo) {
                                    ?>
                                <option value="<?php echo $fornecedo['id'] ?>"><?php echo $fornecedo['razao-social'] ?>
                                </option>
                                <?php } ?>
                            </select>
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
                            foreach ($produtos as $produto) {
                            ?>
                            <tr class="border-solid border-black border">
                                <td class="ps-2"><?php echo $produto['nome']; ?></td>
                                <td class="text-end w-10">
                                    <a class="update" href="/produtos/<?php echo $produto['id'];?>">
                                        <span class="material-symbols-outlined">settings</span>
                                    </a>
                                </td>
                                <td class="text-end w-10 pe-2">
                                    <form method="POST" action="/delete/produtos/<?php echo $produto['id']; ?>">
                                        <button type="submit"><span
                                                class="material-symbols-outlined">delete</span></button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
<script>
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