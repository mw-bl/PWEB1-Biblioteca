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

    // Chama o método de empréstimo e armazena o retorno
    $mensagem = $controller->emprestarLivro($livroId, $estudanteId);
    header('Location: emprestar_livro.php?mensagem=' . urlencode($mensagem));
    exit;
}

// Obtém os dados para preencher os selects
$livrosDisponiveis = $controller->listarLivrosDisponiveis();
$estudantes = $controller->listarEstudantes();

// Verifica se há uma mensagem de sucesso ou erro para exibir
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : null;
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

    <!-- Exibe a mensagem de sucesso ou erro, se houver -->
    <?php if ($mensagem): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form action="emprestar_livro.php" method="post">
        <label for="livro">Selecione o Livro:</label>
        <select name="livro_id" id="livro" required>
            <?php foreach ($livrosDisponiveis as $livro): ?>
                <option value="<?= $livro->getId() ?>"><?= htmlspecialchars($livro->getTitulo()) ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="estudante">Selecione o Estudante:</label>
        <select name="estudante_id" id="estudante" required>
            <?php foreach ($estudantes as $estudante): ?>
                <option value="<?= $estudante->getId() ?>"><?= htmlspecialchars($estudante->getNome()) ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <input type="submit" value="Emprestar Livro">
    </form>
</body>
</html>
