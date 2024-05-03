<?php
require_once 'conexao.php';

if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        // Selecionar o cliente com o email fornecido no banco de dados
        $sql = "SELECT * FROM Clientes WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $_POST['email']]);
        $cliente = $stmt->fetch();

        if ($cliente && password_verify($_POST['senha'], $cliente['senha'])) {
            // Login bem-sucedido
            // Redirecionar para index.php
            header('Location: index.php');
            exit(); // Certifique-se de sair após o redirecionamento
        } else {
            // Email ou senha incorretos
            echo 'Email ou senha incorretos.';
        }
    } else {
        // Campos de email e senha não foram fornecidos
        echo 'Por favor, forneça email e senha.';
    }
} elseif (isset($_POST['register'])) {

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['senha'])) {

        $senhaCriptografada = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Inserir novo cliente no banco de dados
        $sql = "INSERT INTO Clientes (nome, email, senha, data_cadastro) VALUES (:nome, :email, :senha, CURRENT_DATE)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $_POST['username'],
            ':email' => $_POST['email'],
            ':senha' => $senhaCriptografada
        ]);

        // Redirecionar para index.php
        header('Location: index.php');
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        // Campos obrigatórios não foram fornecidos
        echo 'Por favor, preencha todos os campos.';
    }
} else {
    // Nenhum formulário válido foi enviado
    echo 'Nenhum formulário válido foi enviado.';
}
