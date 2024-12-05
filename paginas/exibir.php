<?php
    include("../conexao.php");

    // Verificar se o ID foi passado pela URL
    if (isset($_GET['id_noticia'])) {
        $id_noticia = $_GET['id_noticia'];

        // Consulta para pegar a notícia completa
        $query = "SELECT titulo_noticia, descricao_noticia, arquivo FROM noticia WHERE id_noticia = '$id_noticia' AND status = 'aprovada'";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "<p>Notícia não encontrada.</p>";
            exit;
        }
    } else {
        echo "<p>ID da notícia não fornecido.</p>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/exibir.css">
    
    <title>Exibir Notícia</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg" style="background-color:#d31d1d;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand custom-nav" href="#" style="margin-left: 5px">Visitante</a>
      <h1 class="navbar-brand mx-auto" style="font-size: 35px;">NOTÍCIAS NEWS</h1>
      <button class="btn btn-secondary btn-sm custom-button" style="background-color: white; color: black"
        onclick="window.location.href='../logout.php'">Cadastrar</button>
    </div>
  </nav>
  
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="titulo-noticia"><?php echo htmlspecialchars($row['titulo_noticia']); ?></h5>
            <p class="descricao-noticia"><?php echo htmlspecialchars($row['descricao_noticia']); ?></p>

            <?php
                if (!empty($row['arquivo'])) {
                    echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' class='img-fluid img-centralizada' />";
                }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg text-white text-center py-3" style="margin-top: 40vw; background-color:#d31d1d; ">
    <p>&copy; 2024 Noticias. Todos os direitos reservados.</p>
  </footer>
</body>
</html>
