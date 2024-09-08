<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EmprestimoController.php';

use Controller\EmprestimoController;

$emprestimoController = new EmprestimoController();

$livrosEmprestados = $emprestimoController->listarLivrosEmprestados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Emprestados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function confirmarDevolucao(id) {
            if (confirm("Tem certeza que deseja devolver este livro?")) {
                window.location.href = 'devolver_livro.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>Livros Emprestados</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Título do Livro</th>
            <th>Nome do Estudante</th>
            <th>Data de Empréstimo</th>
            <th>Ações</th>
        </tr>
        <?php
        if (!empty($livrosEmprestados)) {
            foreach ($livrosEmprestados as $emprestimo) {
                echo "<tr>
                    <td>" . $emprestimo->getId() . "</td>
                    <td>" . $emprestimo->getLivro()->getTitulo() . "</td>
                    <td>" . $emprestimo->getEstudante()->getNome() . "</td>
                    <td>" . $emprestimo->getDataEmprestimo() . "</td>
                    <td>
                        <button onclick='confirmarDevolucao(" . $emprestimo->getId() . ")'>Devolver</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum livro emprestado encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
