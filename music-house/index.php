<?php
// Conexão com o banco de dados (substitua os valores conforme suas configurações)
$host = 'localhost';
$dbname = 'MusicHouse';
$user = 'postgres';
$password = '123';

try {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=MusicHouse", "postgres", "123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o botão de registro foi acionado
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validação dos campos (pode ser adaptada de acordo com as necessidades)
        if (empty($username) || empty($email) || empty($password)) {
            die('Por favor, preencha todos os campos.');
        }

        // Insere o novo usuário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO Users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $password]);

        echo 'Registro realizado com sucesso!';
    }

    // Verifica se o botão de login foi acionado
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validação dos campos (pode ser adaptada de acordo com as necessidades)
        if (empty($email) || empty($password)) {
            die('Por favor, preencha todos os campos.');
        }

        // Verifica se o usuário existe no banco de dados
        $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = ? AND password = ?');
        $stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        if (!$user) {
            die('Email ou senha incorretos.');
        }

        // Inicie a sessão ou faça as operações necessárias para manter o usuário logado
        // ...

        echo 'Login realizado com sucesso!';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o botão de registro foi acionado
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Validação dos campos (pode ser adaptada de acordo com as necessidades)
            if (empty($username) || empty($email) || empty($password)) {
                die('Por favor, preencha todos os campos.');
            }
    
            // Verifica se o usuário já possui uma conta
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = ?');
            $stmt->execute([$email]);
            $existingUser = $stmt->fetch();
    
            if ($existingUser) {
                die('Este email já está registrado. Faça login em vez de se registrar.');
            }
    
            // Insere o novo usuário no banco de dados
            $stmt = $pdo->prepare('INSERT INTO Users (username, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, $password]);
    
            echo 'Registro realizado com sucesso!';
        }
    
        // Verifica se o botão de login foi acionado
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Validação dos campos (pode ser adaptada de acordo com as necessidades)
            if (empty($email) || empty($password)) {
                die('Por favor, preencha todos os campos.');
            }
    
            // Verifica se o usuário existe no banco de dados
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = ? AND password = ?');
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch();
    
            if (!$user) {
                die('Email ou senha incorretos.');
            }
    
            // Inicie a sessão ou faça as operações necessárias para manter o usuário logado
            // ...
    
            echo 'Login realizado com sucesso!';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UFT-8">
    <link rel="shortcut icon" href="icon/musica.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css" type="text/css">

<title>Music House</title>
</head>
<body>

   <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="#">Início</a>
            <a href="pesquisarBanda.php">Pesquisar Banda</a>
            <a href="tocaMusica.php">Toca Música</a>
            <a href="read.me">Sobre</a>
            <a href="#">Contato</a>
            <button class="botaoLogin_PopUp">Login</button>
        </nav>
   </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close-sharp"></ion-icon>
        </span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="#">
                <div class="input-box">
                   <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                   <input type="email" require> 
                   <label>Email</label>
                </div>
                <div class="input-box">
                   <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                   <input type="password" require> 
                   <label>Senha</label>
                </div>
                <div class="lembrar-esquecer">
                    <label><input type="checkbox">Lembre-me</label>
                    <br>
                    <a href="#">Eu aceito os Termos de Uso</a>
                </div>
                <button type="submit" class="botao">Login</button>
                <div class="login-resgistrado">
                    <p>Não tem nenhuma Conta? <a href="#" class="registro-link">Registre</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registração</h2>
            <form action="#">
            <div class="input-box">
                   <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                   <input type="text" require> 
                   <label>Nome de Usuário</label>
                </div>
                <div class="input-box">
                   <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                   <input type="email" require> 
                   <label>Email</label>
                </div>
                <div class="input-box">
                   <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                   <input type="password" require> 
                   <label>Senha</label>
                </div>
                <div class="lembrar-esquecer">
                    <label><input type="checkbox">Lembre-me</label>
                    <a href="#">Esqueceu Senha?</a>
                </div>
                <button type="submit" class="botao">Registrar</button>
                <div class="login-resgistrado">
                    <p>Já possuí uma Conta? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
