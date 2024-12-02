<?php
    include("../conexao.php");

    $query = "SELECT titulo_noticia, descricao_noticia, arquivo FROM noticia WHERE status = 'aprovada'"; // Certifique-se de que 'arquivo' está sendo buscado
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/visitante.css">
    <title>Noticias news</title>
    <style>
        /* Estilo personalizado para o título da notícia */
        .titulo-noticia {
            font-size: 1.75rem; /* Tamanho maior para o título */
            font-weight: bold;
            color: #d31d1d; /* Cor personalizada (vermelho) */
        }

        /* Estilo da descrição da notícia */
        .descricao-noticia {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg" style="background-color:#d31d1d;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand" href="#" style="margin-left: 5px">Visitante</a>
      <h1 class="navbar-brand mx-auto" style="font-size: 35px;">NOTÍCIAS</h1>
      <button class="btn btn-secondary btn-sm" style="background-color: white; color: black"
        onclick="window.location.href='../logout.php'">Sair</button>
    </div>
  </nav>
  
  <div class="container mt-4">
    <div class="row">
      <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 mb-4'>"; // Coloca o card dentro de uma coluna responsiva
                echo "<div class='card' style='width: 100%;'>";
                echo "<div class='card-body'>";
                // Título da notícia com estilo personalizado
                echo "<h5 class='titulo-noticia'>" . htmlspecialchars($row['titulo_noticia']) . "</h5>";
                // Descrição da notícia com estilo personalizado
                echo "<p class='descricao-noticia'>" . htmlspecialchars($row['descricao_noticia']) . "</p>";
                
                // Verificar se existe o campo 'arquivo' e se não está vazio
                if (!empty($row['arquivo'])) {
                    echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' class='img-fluid' style='max-height: 200px; object-fit: cover; margin-bottom: 15px;' />";
                }
                echo "</div>"; // Fim do card-body
                echo "</div>"; // Fim do card
                echo "</div>"; // Fim da coluna
            }
        } else {
            echo "<p>Não há notícias disponíveis no momento.</p>";
        }
      ?>
    </div>
  </div>

  <footer class="bg text-white text-center py-3" style="margin-top: 24vw; background-color:#d31d1d">
    <p>&copy; 2024 Noticias. Todos os direitos reservados.</p>
  </footer>
</body>
</html>
