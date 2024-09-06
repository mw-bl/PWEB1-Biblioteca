<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/BibliotecaController.php';
use Controller\BibliotecaController;

$controller = new BibliotecaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livroId = $_POST['livro_id'];
    $estudanteId = $_POST['estudante_id'];
    $controller->devolverLivro($livroId, $estudanteId);
    header('Location: devolver_livro.php');
    exit;
}

$estudantes = $controller->listarEstudantes();
$livrosEmprestados = isset($_POST['estudante_id']) ? $controller->listarLivrosEmprestados($_POST['estudante_id']) : [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolver Livro</title>
</head>
<body>
    <h1>Devolver Livro</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <form action="devolver_livro.php" method="post">
        <label for="estudante">Selecione o Estudante:</label>
        <select name="estudante_id" id="estudante" required>
            <?php foreach ($estudantes as $estudante): ?>
                <option value="<?= $estudante->getId() ?>"><?= $estudante->getNome() ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <?php if (!empty($livrosEmprestados)): ?>
            <label for="livro">Selecione o Livro:</label>
            <select name="livro_id" id="livro" required>
                <?php foreach ($livrosEmprestados as $livro): ?>
                    <option value="<?= $livro->getId() ?>"><?= $livro->getTitulo() ?></option>
                <?php endforeach; ?>
            </select>
            <br>
        <?php endif; ?>

        <input type="submit" value="Devolver Livro">
    </form>
</body>
</html>
