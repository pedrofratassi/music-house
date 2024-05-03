<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/musica.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilo_servico.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Music House</title>
</head>
<body>


    <header>
        <h2 class="logo">Music House</h2>
        <nav class="navigation">
            <a href="index.php">Início</a>
            <a href="pesquisarBanda.php">Pesquisar Banda</a>
            <a href="tocaMusica.php">Toca Música</a>
            <a href="sobre.php">Sobre</a>
            <a href="contato.php">Contato</a>
            <button class="botaoLogin_PopUp">Login</button>
        </nav>
    </header>

    <div class="music">
        <h2 class="title">Nome do Artista</h2>
        <div class="bloco">
            <div class="linha">
                <div class="coluna">
                    <form>
                        <input type="text" class="form-control" id="nomeArtista" placeholder="Digite o Nome do Artista">
                        <button type="button" class="botaoPrimario" onclick="buscarArtistas(document.getElementById('nomeArtista').value)">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="content">
        <script src="js/buscarArtistas.js"></script>
        <h3 id="name"></h3>
        <img id="picture" src="" alt="">
        <div id="title"></div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>