<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

// Cria uma instância do controlador com a conexão
$controller = new LivroController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autor_id = $_POST['autor_id'];
    $genero = $_POST['genero'];
    $controller->cadastrarLivro($titulo, $ano, $autor_id, $genero);
    header('Location: cadastrar_livros.php');
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
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <label for="ano">Matricula:</label>
        <input type="text" id="ano" name="ano" required>
        <br>
        <label for="autor_id">Id do Autor:</label>
        <input type="text" id="autor_id" name="autor_id" required>
        <br>
        <label for="genero">Genero:</label>
        <input type="text" id="genero" name="genero" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
