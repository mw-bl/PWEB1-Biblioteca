<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/BibliotecaController.php';
include_once '../Controller/EstudanteController.php';
include_once '../Controller/LivroController.php';

use Controller\BibliotecaController;
use Controller\EstudanteController;
use Controller\LivroController;

$bibliotecaController = new BibliotecaController();
$estudanteController = new EstudanteController();
$livroController = new LivroController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livroId = $_POST['livro'];
    $estudanteId = $_POST['estudante'];
    $bibliotecaController->emprestarLivro($livroId, $estudanteId);
    header('Location: listar_livros_emprestados.php');
    exit;
}

$estudantes = $estudanteController->listarEstudantes();
$livros = $livroController->listarLivros();

// Verificar o conteúdo de estudantes
if (!$estudantes) {
    echo "Nenhum estudante encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar Livro</title>
</head>
<body>
    <h1>Emprestar Livro</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <form action="emprestar_livro.php" method="post">
        <label for="livro">Livro:</label>
        <select name="livro" id="livro" required>
            <?php
            foreach ($livros as $livro) {
                echo "<option value='{$livro->getId()}'>{$livro->getTitulo()}</option>";
            }
            ?>
        </select>
        <br>
        <label for="estudante">Estudante:</label>
        <select name="estudante" id="estudante" required>
            <?php
            if (!empty($estudantes)) {
                foreach ($estudantes as $estudante) {
                    echo "<option value='{$estudante->getIdEstudante()}'>{$estudante->getNome()}</option>";
                }
            } else {
                echo "<option value=''>Nenhum estudante disponível</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Emprestar">
    </form>
</body>
</html>
