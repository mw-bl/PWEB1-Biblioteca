<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

$controller = new LivroController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $livro = $controller->getLivroById($id);
} else {
    header('Location: listar_livros.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $autor_id = $_POST['autor_id'];
    $genero = $_POST['genero'];
    $controller->editarLivro($titulo, $ano, $autor_id, $genero);
    header('Location: listar_livros.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <a href="listar_livros.php">Voltar para a lista</a>
    <form action="editar_livro.php?id=<?php echo $id; ?>" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>" required>
        <br>
        <label for="ano">Ano:</label>
        <input type="text" id="ano" name="ano" value="<?php echo htmlspecialchars($livro->getAno()); ?>" required>
        <br>
        <label for="autor_id">Id do Autor:</label>
        <input type="text" id="autor_id" name="autor_id" value="<?php echo htmlspecialchars($livro->getAutorId()); ?>" required>
        <br>
        <label for="genero">Genero:</label>
        <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($livro->getGenero()); ?>" required>
        <br>
        <input type="submit" value="Atualizar">
    </form>

</body>
</html>
