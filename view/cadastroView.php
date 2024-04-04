<?php
    if(isset($_SESSION['id'])){
        header('Location:/');
    }
?>
<?php
    include_once('painel/head.php');
?>

<main class="bg-violet-950 flex justify-center items-center w-dvw h-dvh">
    <div class="max-w-screen-xl w-full h-full flex-col items-center">
        <?php
            include_once('headerComponente.php');
        ?>
        <form action="/usuarios" method="POST" class="flex flex-col gap-2 items-center mt-40">
            <h1 class="text-white text-3xl font-semi-bold">CADASTRAR</h1>
            <input class="rounded-lg required border-solid placeholder:text-black h-9 border border-black w-60"
                type="text" name="nome" placeholder="  nome">
            <input class="rounded-lg required border-solid placeholder:text-black h-9 border border-black w-60"
                type="text" name="sobrenome" placeholder="  sobre nome">
            <input class="rounded-lg required border-solid placeholder:text-black h-9 border border-black w-60"
                type="text" name="email" placeholder="  email">
            <input class="rounded-lg required border-solid placeholder:text-black h-9 border border-black w-60"
                type="password" name="senha" placeholder="  senha">
            <button
                class="rounded-lg border-solid text-black bg-violet-900 h-9 border-black border text-white w-24 ">CADASTRAR</button>
        </form>
    </div>
</main>