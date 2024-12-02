<?php
    include ('../conexao.php');
        #Insert do título e descrição da notícia
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
        $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
        $novoNomeArquivo = "";

    #Preparando a imagem
    if(isset($_FILES['arquivo'])) {
        $nomeArquivo = $_FILES['arquivo'] ['name'];
        $extensao = strtolower (substr($_FILES['arquivo'] ['name'], -4));
        $novoNomeArquivo = md5(time()) . $extensao;
        $diretorio = "../arquivo/";
        move_uploaded_file($_FILES['arquivo'] ['tmp_name'], $diretorio.$novoNomeArquivo);
    }

    #Inserindo os dados
    try {
        mysqli_query($mysqli, "INSERT INTO noticia (titulo_noticia, descricao_noticia, arquivo, data, status) VALUES ('$titulo', '$descricao', '$novoNomeArquivo', NOW(), 'pendente')");
        
        echo "dados enviados para aprovação";
    } catch (Exception $e) {
        echo "<h1>Erro ao cadastrar dados!</h1> <h2>Confira se os dados cadastrados estão corretos</h2>";
    }
}
    $result = mysqli_query($mysqli, "SELECT * FROM noticia");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Site de Notícias</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <p>
            <label>Título</label>
            <input type="text" name="titulo"/>
        </p>
        <p>
            <label>Descrição</label>
            <input type="text" name="descricao"/>
        </p>
        <p>
            <label>Imagem</label>
            <input type="file" required name="arquivo"/>
        </p>
        <p>
            <button type="submit">Criar</button>
        </p>
    </form>
</body>
</html>
