<?php 
    include_once('painel/head.php');
    include_once('./database/models/produtoModel.php');
?>

<body>
    <div class="bg-gray-300 flex justify-center w-full h-full">
        <div class="w-full">
            <?php include_once('headerComponente.php') ?>
            <div class="flex items-stretch justify-center mt-40">
                <h1 class="text-5xl font-bold mb-8 text-purple-800 mt-2 mr-20">Produtos</h1>
                <button
                    class="bg-purple-800 text-white font-semibold px-10 rounded-lg text-lg font-bold">Enviar</button>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 mt-8 mx-auto max-w-7xl">
                <?php
                    $produtos = new ProdutoModel();
                    $produtos = $produtos->all();
                    foreach($produtos as $produto) { 
                        echo '
                        <div class="bg-purple-800 rounded-lg shadow-md w-64">
                            <div class="text-white font-bold text-xl mb-4 ml-2">' . $produto['nome'] . '</div>
                            <div class="flex justify-between items-center text-white text-xl mb-2 ml-2">
                                <input type="checkbox" class="form-checkbox h-6 w-6 text-purple-800 border-2 border-purple-800 rounded-lg mr-2">
                            </div>
                        </div>';
                    }  
                    ?>
            </div>
        </div>
    </div>
</body>