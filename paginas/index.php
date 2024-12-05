<?php
    include("../conexao.php");

    $query = "SELECT id_noticia, titulo_noticia, descricao_noticia, arquivo FROM noticia WHERE status = 'aprovada'"; // Certifique-se de que 'arquivo' está sendo buscado
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/visitante.css">
    <title>Noticias</title>
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
      <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 mb-4'>"; 
                echo "<div class='card' style='width: 100%;'>";
                echo "<div class='card-body'>";

                echo "<h5 class='titulo-noticia'>" . htmlspecialchars($row['titulo_noticia']) . "</h5>"; 
                echo "<p class='descricao-noticia'>" . htmlspecialchars($row['descricao_noticia']) . "</p>";
           
                if (!empty($row['arquivo'])) {
                  echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia img-centralizada' class='img-fluid img-centralizada' style='max-height: 200px; object-fit: cover; margin-bottom: 15px;' />";
                }

                $id_noticia = $row['id_noticia'];
                echo "<a href='exibir.php?id_noticia=$id_noticia' class='btn btn-primary'>Ver mais</a>";
                
                echo "</div>";
                echo "</div>"; 
                echo "</div>"; 
            }
        } else {
            echo "<p>Não há notícias disponíveis no momento.</p>";
        }
      ?>
    </div>
  </div>

  <footer class="bg text-white text-center py-3" style="background-color:#d31d1d;">
    <p>&copy; 2024 Noticias. Todos os direitos reservados.</p>
  </footer>
</body>
</html>
