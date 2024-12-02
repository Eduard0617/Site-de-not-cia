<?php
    include('conexao.php');

    if(isset($_POST['email']) || isset($_POST['senha'])) {
        if(strlen($_POST['email']) == 0) {
            echo "<script> alert('Preencha seu email'); </script>";
        } elseif (strlen($_POST['senha']) == 0) {
            echo "<script> alert('Preencha sua senha'); </script>";
        } else {
            $email = $mysqli -> real_escape_string($_POST['email']);
            $senha = $mysqli -> real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli -> query($sql_code) or die ("Falha na execução: " . $mysqli -> error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {

                $usuario = $sql_query -> fetch_assoc();

                if(!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['email'] = $usuario['email'];
                $_SESSION['senha'] = $usuario['senha'];

                if($usuario['email'] == 'edufeenandessilva0617@gmail.com'){
                    header("Location: paginas/pgAdmin.php");
                } else {
                    header("Location: paginas/pgEscritor.php");
                }
                exit;
            } else {
                echo "<script> alert('Falha ao logar! Email ou senha incorretos'); </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <h1>Acesse sua conta</h1>
        <form action="index.php" method="POST">
            <p>
                <label style="color: black;">E-mail</label>
                <input type="text" name="email">
            </p>
            <p>
                <label style="color: black;">Senha</label>
                <input type="password" name="senha">
            </p>
            <p>
                <button type="submit">Entrar</button> <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>
            </p>
        </form>
        <br>
        <a href="paginas/pgVisitante.php"> Continuar sem cadastro</a>
    </div>
</body>
</html>