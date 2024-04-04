<header class="bg-violet-600 w-full p-3 flex justify-between items-center rounded-lg text-3xl m-3">
    <div class="text-white font-bold">
        <a href="/">LOGO</a>
        <?php 
            if(isset($_SESSION['nome'])){
                echo '<a href="/painel">Painel</a>';
            }
        ?>
        </div>
    <div class="flex justify-between items-center rounded-lg gap-2">
        <a class="text-white text-gray-800 font-semibold text-lg p-1 rounded-lg">
            <?php 
                if(isset($_SESSION['nome'])){
                    echo $_SESSION['nome'];
                }
            ?>
        </a>
        <?php 
            if(isset($_SESSION['nome'])){
                echo '<a href="/logout"> <span class="material-symbols-outlined text-white">logout</span> </a>';
            }
        ?>
        <?php 
            if(isset($_SESSION['nome'])){
                echo ' <a href="/" class="material-symbols-outlined text-lg text-white">shopping_cart</a>
                ';
            }
        ?>
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
    </div>
</header>