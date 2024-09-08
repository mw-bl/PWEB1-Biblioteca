<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EmprestimoController.php';
include_once '../Controller/LivroController.php';
include_once '../Controller/EstudanteController.php';

use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

$emprestimoController = new EmprestimoController();
$livroController = new LivroController();
$estudanteController = new EstudanteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLivro = intval($_POST['idLivro']);
    $idEstudante = intval($_POST['idEstudante']);

    if ($idLivro && $idEstudante) {
        $emprestimoController->emprestarLivro($idLivro, $idEstudante);
        header('Location: livros_emprestados.php');
        exit;
    } else {
        $erro = "Selecione um livro e um estudante.";
    }
}

$livrosDisponiveis = $livroController->listarLivros();
$estudantes = $estudanteController->listarEstudantes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar Livro</title>
    <style>
        form {
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        select, button {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
        .erro {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Emprestar Livro</h1>
    <form method="POST" action="emprestar_livro.php">
        <label for="idLivro">Selecione o Livro:</label>
        <select name="idLivro" id="idLivro" required>
            <option value="">-- Escolha um livro --</option>
            <?php foreach ($livrosDisponiveis as $livro): ?>
                <option value="<?= $livro['id'] ?>"><?= $livro['titulo'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="idEstudante">Selecione o Estudante:</label>
        <select name="idEstudante" id="idEstudante" required>
            <option value="">-- Escolha um estudante --</option>
            <?php foreach ($estudantes as $estudante): ?>
                <option value="<?= $estudante['idEstudante'] ?>"><?= $estudante['nome'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Emprestar Livro</button>
        
        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
