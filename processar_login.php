<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Aqui você pode adicionar a lógica para validar o nome de usuário e senha
        // ou realizar qualquer outra ação necessária com os dados.
        // Por exemplo, verificar se as credenciais correspondem a um usuário registrado.

        // Exemplo básico de verificação de credenciais (apenas para fins ilustrativos)
        if ($username === 'admin' && $password === '123456') {
            echo 'Login bem-sucedido!';
        } else {
            echo 'Credenciais inválidas. Tente novamente.';
        }
    }
?>
