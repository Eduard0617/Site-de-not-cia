<?php
include('../conexao.php');
session_start();

if (!isset($_SESSION['email'])) {
    echo "Você precisa estar logado para acessar esta página.";
    header("refresh:3; index.php");
    exit();
}

$email_sessao = $_SESSION['email'];

$query_login = "SELECT email FROM login WHERE email = '$email_sessao'";
$result_login = mysqli_query($mysqli, $query_login);


// Consulta para pegar as notícias
$query_noticias = "SELECT titulo_noticia, descricao_noticia, arquivo FROM noticia WHERE status ='aprovada'";
$result_noticias = mysqli_query($mysqli, $query_noticias);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Escritor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/escritor.css">
    </head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color:#d31d1d;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand custom-escritor" href="#" style="margin-left: 5px">Página do Escritor</a>
            <h1 class="navbar-brand mx-auto" style="font-size: 35px;">Noticias</h1>
            <button class="btn btn-secondary btn-sm custom-criar" style="background-color: white; color: black; margin-right: 5px;"
                onclick="window.location.href='inserindoNoticia.php'">Criar Noticia</button>
            <button class="btn btn-secondary btn-sm custom-criar" style="background-color: white; color: black"
                onclick="window.location.href='../logout.php'">Sair</button>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php
            if (mysqli_num_rows($result_noticias) > 0) {
                while ($row = mysqli_fetch_assoc($result_noticias)) {
                    echo "<div class='col-md-4 mb-4'>"; // Coloca o card dentro de uma coluna responsiva
                    echo "<div class='card' style='width: 100%;'>";
                    echo "<div class='card-body'>";
                    // Título da notícia com estilo personalizado
                    echo "<h5 class='card-title'>" . htmlspecialchars($row['titulo_noticia']) . "</h5>";
                    // Descrição da notícia com estilo personalizado
                    echo "<p class='card-text'>" . htmlspecialchars($row['descricao_noticia']) . "</p>";

                    // Verificar se existe o campo 'arquivo' e se não está vazio
                    if (!empty($row['arquivo'])) {
                        echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' class='img-fluid' style='max-height: 200px; object-fit: cover; margin-bottom: 15px;' />";
                    }
                    echo "</div>"; // Fim do card-body
                    echo "</div>"; // Fim do card
                    echo "</div>"; // Fim da coluna
                }
            } else {
                echo "<p>Não há notícias aprovadas no momento.</p>";
            }
            ?>
        </div>
    </div>
    
    <footer class="bg text-white text-center py-3" style="margin-top: 40vw; background-color:#d31d1d">
    <p>&copy; 2024 Noticias. Todos os direitos reservados.</p>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
