<div id="menu"
    class="hidden sm:block fixed sm:static max-h-max h-full w-44 bg-violet-950 text-white flex flex-col items-center pt-2">
    <div class="flex items-center justify-between sm:justify-center w-full p-2">
        <span class="text-white text-3xl font-semi-bold">PAINEL</span>
        <span class="material-symbols-outlined cursor-pointer btnMenu sm:hidden">
            menu
        </span>
    </div>
    <div id="usuarios" class="w-full text-center hover:bg-violet-900">
        <a href="/painel/usuarios">USUARIOS</a>
    </div>
    <div id="fornecedores" class="w-full text-center hover:bg-violet-900">
        <a href="/painel/fornecedores">FORNECEDORES</a>
    </div>
    <div id="produtos" class="w-full text-center hover:bg-violet-900">
        <a href="/painel/produtos">PRODUTOS</a>
    </div>
</div>

<script>
    var usuarios = document.getElementById('usuarios');
    var fornecedores = document.getElementById('fornecedores');
    var produtos = document.getElementById('produtos');

    var urlAtual = window.location.href;

    if (urlAtual.includes('usuarios')) {
        usuarios.classList.add('bg-violet-900');
    } else if (urlAtual.includes('fornecedores')) {
        fornecedores.classList.add('bg-violet-900');
    } else if (urlAtual.includes('produtos')) {
        produtos.classList.add('bg-violet-900');
    }
</script>