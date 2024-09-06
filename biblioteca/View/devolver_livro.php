<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/BibliotecaController.php';
use Controller\BibliotecaController;

$controller = new BibliotecaController();

// Se a requisição for POST e o estudante foi selecionado, carrega os livros emprestados.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estudante_id'])) {
    $estudanteId = $_POST['estudante_id'];
    $livrosEmprestados = $controller->livrosEmprestados($estudanteId);
} else {
    $livrosEmprestados = [];
}

// Lista de todos os estudantes
$estudantes = $controller->listarEstudantes();
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

    <!-- Primeiro formulário: seleção de estudante -->
    <form action="devolver_livro.php" method="post">
        <label for="estudante">Selecione o Estudante:</label>
        <select name="estudante_id" id="estudante" required>
            <option value="">Selecione...</option>
            <?php foreach ($estudantes as $estudante): ?>
                <option value="<?= $estudante->getId() ?>" <?= isset($estudanteId) && $estudanteId == $estudante->getId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($estudante->getNome()) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Carregar Livros Emprestados">
    </form>

    <?php if (!empty($livrosEmprestados)): ?>
        <!-- Segundo formulário: devolver livro, visível apenas após selecionar um estudante -->
        <form action="devolver_livro.php" method="post">
            <input type="hidden" name="estudante_id" value="<?= htmlspecialchars($estudanteId) ?>">
            <label for="livro">Selecione o Livro:</label>
            <select name="livro_id" id="livro" required>
                <?php foreach ($livrosEmprestados as $livro): ?>
                    <option value="<?= $livro->getId() ?>"><?= htmlspecialchars($livro->getTitulo()) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <input type="submit" value="Devolver Livro">
        </form>
    <?php endif; ?>
</body>
</html>
