<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

// Chama a função listarLivros() do controller para fazer a listagem dos livros
$controller = new LivroController();
$livros = $controller->listarLivros();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
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
            margin: 4rem auto;
            max-width: 1200px;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #266b25;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #379936;
            color: white;
        }

        td {
            background-color: #fff;
        }

        button {
            background-color: #266b25;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }

        button:hover {
            background-color: #1b4c1b;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            table {
                font-size: 12px;
            }

            button {
                padding: 4px 8px;
            }
        }
    </style>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este livro?")) {
                window.location.href = 'excluir_livro.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="navbar">Lista de Livros</div>
    <div class="container">
        <a href="index.php">Voltar para a página inicial</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Ano</th>
                <th>Autor</th>
                <th>Ações</th>
            </tr>
            <?php
            if (!empty($livros)) {
                foreach ($livros as $livro) {
                    echo "<tr>
                        <td>" . $livro->getId() . "</td>
                        <td>" . $livro->getTitulo() . "</td>
                        <td>" . $livro->getAno() . "</td>
                        <td>" . $livro->getAutor() . "</td>
                        <td>
                            <a href='editar_livro.php?id=" . $livro->getId() . "'>Editar</a>
                            <button onclick='confirmarExclusao(" . $livro->getId() . ")'>Excluir</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum livro encontrado</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
