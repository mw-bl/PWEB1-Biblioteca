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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #379936;
            color: white;
            width: 100%;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .container {
            margin: 4rem auto 0 auto;
            max-width: 800px;
            padding: 2rem;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #1b4c1b;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            border: 1px solid #d9d9d9;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            color: #595959;
        }

        td {
            background-color: #fff;
        }

        .no-books {
            text-align: center;
            color: #595959;
            padding: 16px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 2rem auto;
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            button {
                padding: 4px 8px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">Biblioteca IFCE</div>
    <div class="container">
        <h1>Livros Emprestados</h1>
        <a href="index.php">Voltar para a página inicial</a>
        <table>
            <tr>
                <th>ID Livro</th>
                <th>Título do Livro</th>
                <th>Ano do Livro</th>
                <th>Data de Empréstimo</th>
                <th>Data de Devolução</th>
            </tr>
            <?php
            if (!empty($livrosEmprestados)) {
                foreach ($livrosEmprestados as $livro) {
                    echo "<tr>
                        <td>" . htmlspecialchars($livro['livro_id']) . "</td>
                        <td>" . htmlspecialchars($livro['titulo']) . "</td>
                        <td>" . htmlspecialchars($livro['ano']) . "</td>
                        <td>" . htmlspecialchars($livro['dataEmprestimo']) . "</td>
                        <td>" . (empty($livro['dataDevolucao']) ? 'Não devolvido' : htmlspecialchars($livro['dataDevolucao'])) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-books'>Nenhum livro emprestado encontrado</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
