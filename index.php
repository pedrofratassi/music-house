<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UFT-8">
    <link rel="shortcut icon" href="image/musica.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css" type="text/css">
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

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close-sharp"></ion-icon>
        </span>

        <!-- Formulário de Login -->
        <div class="form-box login">
            <h2>Login</h2>
            <form action="processaUsuario.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="senha" required>
                    <label>Senha</label>
                </div>
                <button type="submit" class="botao" name="login">Login</button>
                <div class="login-resgistrado">
                    <p>Não tem nenhuma Conta? <a href="#" class="registro-link">Registre aqui</a></p>
                </div>
            </form>
        </div>

        <!-- Formulário de Registro -->
        <div class="form-box register">
            <h2>Registração</h2>
            <form action="processaUsuario.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Nome de Usuário</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="senha" required>
                    <label>Senha</label>
                </div>
                <button type="submit" class="botao" name="register">Registro</button>
                <div class="login-resgistrado">
                    <p>Já possuí uma Conta? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
        
        <script src="js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>