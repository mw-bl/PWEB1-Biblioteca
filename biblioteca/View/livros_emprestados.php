<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/BibliotecaController.php';
use Controller\BibliotecaController;

$controller = new BibliotecaController();

$livrosEmprestados = $controller->livrosEmprestados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Emprestados</title>
</head>
<body>
    <h1>Livros Emprestados</h1>
    <a href="index.php">Voltar para a página inicial</a>

    <?php if (!empty($livrosEmprestados)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estudante</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livrosEmprestados as $emprestimo): ?>
                    <tr>
                        <td><?= $emprestimo['livro']->getTitulo() ?></td>
                        <td><?= $emprestimo['estudante']->getNome() ?></td>
                        <td><?= $emprestimo['data_emprestimo'] ?></td>
                        <td><?= $emprestimo['data_devolucao'] ?? 'Não devolvido' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum livro emprestado no momento.</p>
    <?php endif; ?>
</body>
</html>
