<?php
    include('../conexao.php');
     session_start();

     // Verifica se o e-mail está armazenado na sessão
     if ($_SESSION['email'] !== $result) {
        
         echo "Você precisa estar logado para acessar esta página.";
         
         header("refresh:3; ../index.php");
         exit();
     }

     $query = "SELECT email,senha FROM login";
     $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escritor</title>
</head>
<body>
    <button type="button" onclick="window.location.href='inserindoNoticia.php'">Criar notícia</button>
</body>
</html>