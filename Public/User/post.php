<?php
require_once '../../Config/config.php';
require_once '../../App/Controller/FanficController.php';

if (isset($_FILES['imagem']) && !empty($_FILES['imagem'])) {
    $imagem = "../../Resources/Assets/Uploads/" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
} else {
    $imagem = "";
}

$fanficController = new FanficController($pdo);

if (isset($_POST['titulo']) && 
    isset($_POST['sinopse']) &&
    isset($_POST['categoria_id'])) {

    $fanficController->criarFanfic($imagem, $_POST['titulo'],  $_POST['sinopse'], $_POST['categoria_id'], $_SESSION['usuarioNomedeUsuario'], $_SESSION['usuarioId']);
    header('Location: #');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style.css">
    <link rel="shortcut icon" href="Public/Assets/_31554896-b491-466e-b129-d77e088c3b0c-removebg-preview.png" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="perfil.php">Voltar</a>
        <h1>Fanfic</h1>
    </header>
    
    <form action="post.php" method="post" enctype="multipart/form-data">
        <input type="file" name="imagem" accept="image/*" required>
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="sinopse" cols="30" rows="10" placeholder="Escreva aqui sua sinopse!" required></textarea>
        <select name="categoria_id" placeholder="Tags" required>
            <option>Tags...</option>
            <option value="1">Fantasia</option>
            <option value="2">Terror</option>
            <option value="3">Romance</option>
            <option value="4">Drama</option>
            <option value="5">Aventura</option>
            <option value="6">Suspense</option>
            <option value="7">Ação</option>
            <option value="8">Comédia</option>
            <option value="9">Guerra</option>
            <option value="10">Luta</option>
        </select>
        <button type="submit">Adicionar fanfic</button>
    </form>
</body>
</html>