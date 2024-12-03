<?php
include('../conexao.php');
#Insert do título e descrição da notícia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $novoNomeArquivo = "";

    #Preparando a imagem
    if (isset($_FILES['arquivo'])) {
        $nomeArquivo = $_FILES['arquivo']['name'];
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novoNomeArquivo = md5(time()) . $extensao;
        $diretorio = "../arquivo/";
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNomeArquivo);
    }

    #Inserindo os dados
    try {
        mysqli_query($mysqli, "INSERT INTO noticia (titulo_noticia, descricao_noticia, arquivo, data, status) VALUES ('$titulo', '$descricao', '$novoNomeArquivo', NOW(), 'pendente')");

        echo "<script> alert('Notícia enviada para aprovação!'); </script>";
    } catch (Exception $e) {
        echo "<script> alert('Erro ao enviar notícia, verifique os dados inseridos'); </script>";
    }
}
$result = mysqli_query($mysqli, "SELECT * FROM noticia");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/escritor.css">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color:#d31d1d;">
        <div class="container-fluid">
            <!-- Botão Voltar no canto esquerdo -->
            <button class="btn btn-secondary btn-sm custom-button" style="background-color: white; color: black; margin-left: 5px;"
                onclick="window.location.href='pgEscritor.php'">Voltar</button>

            <!-- Título centralizado -->
            <h1 class="navbar-brand mx-auto" style="font-size: 35px;">Criação de Notícia</h1>

            <!-- Botão Sair no canto direito -->
            <button class="btn btn-secondary btn-sm custom-button" style="background-color: white; color: black; margin-right: 5px;"
                onclick="window.location.href='../logout.php'">Sair</button>
        </div>
    </nav>


    <!-- Container para centralizar o card -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card" style="width: 100%; max-width: 500px; padding: 20px;">
            <div class="card-body">
                <h2 class="card-title text-center">Criar Notícia</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control custom-titulo" required />
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control custom-descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="arquivo" class="form-label">Imagem</label>
                        <input type="file" name="arquivo" id="arquivo" class="form-control" required />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn custom-criar" style="background-color: #d31d1d; color: white;">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>