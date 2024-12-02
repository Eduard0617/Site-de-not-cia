<?php
    include ('../conexao.php');
    
    # Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
        $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
        $novoNomeArquivo = "";

        # Validar se os campos título e descrição não estão vazios
        if (empty($titulo) || empty($descricao)) {
            echo "<h2>Por favor, preencha todos os campos!</h2>";
        } else {
            # Preparando a imagem
            if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {
                $nomeArquivo = $_FILES['arquivo']['name'];
                $extensao = strtolower(substr($nomeArquivo, -4)); // Extensão do arquivo
                $novoNomeArquivo = md5(time()) . $extensao;  // Gerar nome único para o arquivo
                $diretorio = "../arquivo/";

                // Move o arquivo para o diretório
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNomeArquivo)) {
                    // Inserção no banco de dados usando prepared statement
                    try {
                        $stmt = $mysqli->prepare("INSERT INTO noticia (titulo_noticia, descricao_noticia, arquivo, data, status) VALUES (?, ?, ?, NOW(), 'pendente')");
                        $stmt->bind_param("sss", $titulo, $descricao, $novoNomeArquivo);  // "sss" indica que são 3 parâmetros do tipo string
                        $stmt->execute();

                        echo "Dados enviados para aprovação";
                    } catch (Exception $e) {
                        echo "<h1>Erro ao cadastrar dados!</h1> <h2>Confira se os dados cadastrados estão corretos</h2>";
                    }
                } else {
                    echo "<h2>Erro ao fazer upload da imagem</h2>";
                }
            } else {
                echo "<h2>Por favor, envie uma imagem válida</h2>";
            }
        }
    }

    # Consultando todas as notícias
    $result = mysqli_query($mysqli, "SELECT * FROM noticia");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Notícias</title>
</head>
<body>
    <h1>Site de Notícias</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <p>
            <label>Título</label>
            <input type="text" name="titulo" required />
        </p>
        <p>
            <label>Descrição</label>
            <input type="text" name="descricao" required />
        </p>
        <p>
            <label>Imagem</label>
            <input type="file" name="arquivo" required />
        </p>
        <p>
            <button type="submit">Criar</button>
        </p>
    </form>
</body>
</html>
