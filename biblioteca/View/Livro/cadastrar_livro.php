<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

$controller = new LivroController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autorId = $_POST['autor_id'];
    $controller->cadastrarLivro($titulo, $ano, $autorId);
    header('Location: listar_livros.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
</head>
<body>
    <h1>Cadastrar Novo Livro</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <form action="cadastrar_livro.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required>
        <br>
        <label for="autor_id">Autor ID:</label>
        <input type="number" id="autor_id" name="autor_id" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
