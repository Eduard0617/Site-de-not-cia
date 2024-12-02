<?php
    include("../conexao.php");

    $query = "SELECT titulo_noticia, descricao_noticia FROM noticia";
    $result = mysqli_query($mysqli, $query);
    
    echo "você é um visitante";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias news</title>
</head>
<body>
    <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form method='POST' action='pgAdmin.php'>";
                echo "<p><strong>" . htmlspecialchars($row['titulo_noticia']) . "</strong><br>";
                echo htmlspecialchars($row['descricao_noticia']) . "</p>";
                
                // Exibe a imagem, se houver
                if ($row['arquivo']) {
                    echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' style='max-width: 300px;'/><br>";
                }
            }
        }
    ?>
</body>
</html>