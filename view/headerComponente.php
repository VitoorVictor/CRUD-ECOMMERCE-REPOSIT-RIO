<header class="bg-violet-600 w-full p-3 flex justify-between items-center text-3xl">
    <div class="text-white font-bold">
        <?php
            if(strpos($_SERVER['REQUEST_URI'], 'painel') !== false){
                echo '<a href="/">Logo</a>';
            }elseif(isset($_SESSION['nome']) !== false){
                echo '<a href="/painel">Painel</a>';
            }elseif(isset($_SESSION['nome']) == false){
                echo '<a href="/">Logo</a>';
            }
        ?>
    </div>
    <div class="flex justify-between items-center rounded-lg gap-2">
        <?php 
            if(!isset($_SESSION['nome'])){
                echo ' <a href="/cadastro" class="text-lg text-white">Cadastro</a>
                ';
            }
        ?>
        <?php 
            if(!isset($_SESSION['nome'])){
                echo ' <a href="/login" class="text-lg text-white">Logar</a>
                ';
            }
        ?>
        <?php 
            if(isset($_SESSION['nome'])){
                echo ' <a href="/" class="material-symbols-outlined text-lg text-white">shopping_cart</a>
                ';
            }
        ?>
        <?php 
            if(isset($_SESSION['nome'])){
                echo '<a href="/logout"> <span class="material-symbols-outlined text-lg  text-white">logout</span> </a>';
            }
        ?>
        <a class="text-white text-gray-800 font-semibold text-lg p-1 rounded-lg">
            <?php 
                if(isset($_SESSION['nome'])){
                    echo '<span class="text-white">'.$_SESSION["nome"].'</span>';
                }
            ?>
        </a>
    </div>
</header>