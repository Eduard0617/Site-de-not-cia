<?php
    session_start();
    if($_SESSION['email'] !== 'edufeenandessilva0617@gmail.com') {
        echo "Você não é o Admin";
        header("refresh:3 ../index.php");
        exit();
    } 

include('../conexao.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_noticia'])) {
    $id_noticia = $_POST['id_noticia'];
    $status = $_POST['status'];

    if ($status == 'aprovada') {
        // Atualiza o status da notícia para 'aprovada'
        try {
            $query = "UPDATE noticia SET status = 'aprovada' WHERE id_noticia = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id_noticia);
            $stmt->execute();
            
            echo "<h2>Notícia aprovada com sucesso!</h2>";
        } catch (Exception $e) {
            echo "<h1>Erro ao aprovar a notícia!</h1>";
        }
    } elseif ($status == 'rejeitada') {
        // Deleta a notícia
        try {
            $query = "DELETE FROM noticia WHERE id_noticia = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id_noticia);
            $stmt->execute();
            
            echo "<h2>Notícia rejeitada e removida com sucesso!</h2>";
        } catch (Exception $e) {
            echo "<h1>Erro ao excluir a notícia!</h1>";
        }
    }
}

// Busca todas as notícias pendentes
$query = "SELECT * FROM noticia WHERE status = 'pendente'";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Administrador</title>
</head>
<body>
    <button type="button" onclick="window.location.href='../logout.php'">Sair</button>
    <h1>Página do Administrador</h1>

    <h2>Notícias Pendentes</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {
        // Exibe cada notícia pendente com opções de aprovar ou rejeitar
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<form method='POST' action='pgAdmin.php'>";
            echo "<p><strong>" . htmlspecialchars($row['titulo_noticia']) . "</strong><br>";
            echo htmlspecialchars($row['descricao_noticia']) . "</p>";
            
            // Exibe a imagem, se houver
            if ($row['arquivo']) {
                echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' style='max-width: 300px;'/><br>";
            }
            
            // Opções de aprovar ou rejeitar
            echo "<input type='hidden' name='id_noticia' value='" . $row['id_noticia'] . "'>";
            echo "<button type='submit' name='status' value='aprovada'>Aprovar</button>";
            echo "<button type='submit' name='status' value='rejeitada'>Rejeitar</button>";
            echo "</form><hr>";
        }
    } else {
        echo "<p>Não há notícias pendentes de aprovação no momento.</p>";
    }
    ?>

    <a href="../index.php">Voltar à página principal</a>
</body>
</html>
