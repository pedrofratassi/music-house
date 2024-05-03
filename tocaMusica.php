<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/musica.ico" type="image/x-icon">
    <link rel="stylesheet" href="musicPlayer.css">
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
            <a href="#">Contato</a>
            <button class="botaoLogin_PopUp">Login</button>
        </nav>
   </header>

    <div class="music">
        <h2 class="title">Nome da Música</h2>
        <div class="player">
            <audio src=""></audio>
            <div class="botaoMusic">
                <span class="previa">
                    <ion-icon name="play-back-outline"></ion-icon>
                </span>
                <span class="playPause">
                    <ion-icon name="play-outline"></ion-icon>
                </span>
                <span class="proxima">
                    <ion-icon name="play-forward-outline"></ion-icon>
                </span>
            </div>
        </div>
    </div>

    <script src="js/streaming.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>