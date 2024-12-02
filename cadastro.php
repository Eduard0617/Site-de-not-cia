<?php
    include('conexao.php');

    if(isset($_POST['email']) || isset($_POST['senha'])) {
        if(strlen($_POST['email']) == 0) {
            echo "Preencha seu email";
        } elseif (strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else {
            $email = $mysqli -> real_escape_string($_POST['email']);
            $senha = $mysqli -> real_escape_string($_POST['senha']);

            // Verificar se o e-mail já está cadastrado
            $sql_check_email = "SELECT * FROM login WHERE email = '$email'";
            $sql_query_check = $mysqli -> query($sql_check_email);

            if($sql_query_check->num_rows > 0) {
                echo "Este e-mail já está cadastrado. Tente outro.";
            } else {
                // Caso o e-mail não exista, realiza a inserção
                $sql_code = "INSERT INTO login (email, senha) VALUES ('$email', '$senha')";
                if ($mysqli->query($sql_code)) {
                    echo "Cadastro realizado com sucesso!";
                } else {
                    echo "Falha ao cadastrar. Tente novamente.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Criar uma conta</h1>
    <form action="cadastro.php" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email" required>
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </p>
        <p>
            <button type="submit">Criar</button>
        </p>
    </form>
    <br>
</body>
</html>
