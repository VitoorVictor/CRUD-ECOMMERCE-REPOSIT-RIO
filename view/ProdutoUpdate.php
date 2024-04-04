<?php 
    include_once('./database/models/produtoModel.php');
    include_once('./database/models/fornecedorModel.php');
if(!isset($_SESSION['id'])){
    header('Location: /');
}
?>
<?php
include_once('painel/head.php');
?>
<?php
$produtos = new ProdutoModel();
$produtos = $produtos->select();
foreach($produtos as $produto){ ?>
<main class="flex justify-center w-full h-full bg-violet-950">
    <div class="w-full max-w-screen-xl flex flex-col">
        <?php include_once('headerComponente.php') ?>
        <div class="flex flex-col h-full gap-4 w-full justify-center items-center">
            <h1 class="text-white font-bold text-3xl">PRODUTOS</h1>
            <input id="nome" type="text" name="<?php echo $produto['nome']?>"
                class="bg-white text-black rounded-lg px-3 py-2 w-80 placeholder-black"
                placeholder="<?php echo $produto['nome']?>" value="<?php echo $produto['nome']?>">
            <input type="text" id="descricao" name="<?php echo $produto['descricao']?>"
                class="bg-white text-black rounded-lg px-3 py-2 w-80  placeholder-black"
                placeholder="<?php echo $produto['descricao']?>" value="<?php echo $produto['descricao']?>">
            <div class="w-80 flex gap-2 mb-10">
                <select id="fornecedores_id" name="<?php echo $produto['fornecedores_id']?>"
                    class="bg-white text-black rounded-lg px-3 py-2 placeholder-black w-full"
                    placeholder="<?php echo $produto['fornecedores_id']?>">
                    <?php
                        $obj = new fornecedorModel();
                        $fornecedores = $obj->all();
                        foreach ($fornecedores as $fornecedor) {
                    ?>
                    <option value="<?php echo $fornecedor['id']?>"><?php echo $fornecedor['razao_social']?></option>
                    <?php } ?>
                </select>
                <input name="<?php echo $produto['preco']?>"
                    class="bg-white w-full text-black rounded-lg placeholder-black" type="number"
                    value="<?php echo $produto['preco']?>" id="preco" placeholder="<?php echo $produto['preco']?>">
                <input class="hidden" type="text" id="id" name="id" value="<?php echo $produto['id']?>">
            </div>
            <button
                class="cursor-pointer hover:bg-violet-800 text-black rounded-lg px-3 py-2 placeholder-black bg-violet-900	border border-black text-white text-semibold w-30"
                onclick="atualizar()">ATUALIZAR</button>
        </div>
    </div>
</main>
<?php } ?>
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
</script>