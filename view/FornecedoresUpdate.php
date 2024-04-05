<?php 
include_once('./database/models/usuarioModel.php');
if(!isset($_SESSION['id'])){
    header('Location: /');
}
?>
<?php
include_once('painel/head.php');
?>
<main class="flex justify-center w-full h-full bg-violet-950">
    <div class="w-full  flex flex-col">
        <?php include_once('headerComponente.php') ?>
        <form action="" class="flex flex-col h-full gap-4 w-full justify-center items-center">
            <h1 class="text-white font-bold text-3xl">FORNECEDORES</h1>
            <input type="text" name="razao"
                class="bg-white text-black rounded-lg px-3 py-2 w-80 placeholder-black" placeholder="RAZÃO SOCIAL">
            <input type="text" name="email" class="bg-white text-black rounded-lg px-3 py-2  w-80  placeholder-black"
                placeholder="EMAIL">
            <input type="text" name="cnpj" class="bg-white text-black rounded-lg px-3 py-2 w-80   placeholder-black"
                placeholder="CNPJ">
            <input type="text" name="telefone"
                class="bg-white text-black rounded-lg px-3 py-2  w-80 mb-9  placeholder-black" placeholder="TELEFONE">
            <input type="submit" 
                class="cursor-pointer hover:bg-violet-800 text-black rounded-lg px-3 py-2 placeholder-black bg-violet-900	border border-black text-white text-semibold w-30"
                value="ATUALIZAR">
        </form>
    </div>
</main>