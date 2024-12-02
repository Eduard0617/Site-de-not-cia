<?php
session_start();
if ($_SESSION['email'] !== 'edufeenandessilva0617@gmail.com') {
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

      echo "<script>alert('Notícia Aprovada com Sucesso!');</script>";
    } catch (Exception $e) {
      echo "<script>alert('Erro ao aprovar Notícia');</script>";
    }
  } elseif ($status == 'rejeitada') {
    // Deleta a notícia
    try {
      $query = "DELETE FROM noticia WHERE id_noticia = ?";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $id_noticia);
      $stmt->execute();

      echo "<script>alert('Notícia Rejeitada e Removida com Sucesso!.');</script>";
    } catch (Exception $e) {
      echo "<script>alert('Erro ao excluir notícia.');</script>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/admin.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg" style="background-color:#d31d1d;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand custom-nav" href="#" style="margin-left: 5px">Administração</a>
      <h1 class="navbar-brand mx-auto" style="font-size: 35px;">Notícias Pendentes</h1>
      <button class="btn btn-secondary btn-sm custom-button" style="background-color: white; color: black"
        onclick="window.location.href='../logout.php'">Sair</button>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // Exibe cada notícia pendente em um card
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='col-md-4 mb-4'>";
          echo "<div class='card' style='width: 100%;'>";

          // Exibe o conteúdo do card
          echo "<div class='card-body text-center'>";
          echo "<h5 class='card-title'>" . htmlspecialchars($row['titulo_noticia']) . "</h5>";
          echo "<p class='card-text'>" . htmlspecialchars($row['descricao_noticia']) . "</p>";

          // Exibe a imagem, se houver
          if ($row['arquivo']) {
            echo "<img src='../arquivo/" . htmlspecialchars($row['arquivo']) . "' alt='Imagem da notícia' class='img-fluid' style='max-height: 200px; object-fit: cover; margin-bottom: 15px;'/>";
          }

          // Formulário com opções de aprovação ou rejeição
          echo "<form method='POST' action='pgAdmin.php' class='d-flex justify-content-center'>";
          echo "<input type='hidden' name='id_noticia' value='" . $row['id_noticia'] . "'>";
          echo "<button type='submit' name='status' value='aprovada' class='btn btn-success btn-sm mx-2'>Aprovar</button>";
          echo "<button type='submit' name='status' value='rejeitada' class='btn btn-danger btn-sm mx-2'>Rejeitar</button>";
          echo "</form>";
          echo "</div>"; // Fim do card-body
          echo "</div>"; // Fim do card
          echo "</div>"; // Fim da coluna
        }
      } else {
        echo "<p>Não há notícias pendentes de aprovação no momento.</p>";
      }
      ?>
    </div> <!-- Fim da row -->
  </div> <!-- Fim da container -->


  <footer class="bg text-white text-center py-3" style='margin-top: 30vw; background-color:#d31d1d'>
    <p>&copy; 2024 Noticias. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>