<?php
    if(isset($_SESSION['id'])){
        header('Location:/');
    }
?>
<?php
    include_once('painel/head.php');
?>

<main class="bg-violet-950 flex justify-center w-full h-full">
    <div class="w-full h-full flex-col items-center">
        <?php
            include_once('headerComponente.php');
        ?>
        <form action="/login" method="POST" class="flex flex-col w-full gap-2 items-center mt-40">
            <h1 class="text-white text-3xl font-semi-bold">LOGIN</h1>
            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black w-60" type="text"
                placeholder="  email" name="email">
            <input class="rounded-lg border-solid placeholder:text-black h-9 border border-black w-60" type="password"
                placeholder="  senha" name="senha">
            <button
                class="rounded-lg border-solid text-black bg-violet-900 h-9 w-20 border-black border text-white  ">LOGAR
            </button>
        </form>
    </div>
</main>