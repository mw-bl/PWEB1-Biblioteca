<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

// Chama a função listarAutores() do controller para fazer a listagem dos autores
$controller = new AutorController();
$autores = $controller->listarAutores();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
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
            if (confirm("Tem certeza que deseja excluir este autor?")) {
                window.location.href = 'excluir_autor.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="navbar">Lista de Autores</div>
    <div class="container">
        <a href="index.php">Voltar para a página inicial</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Nacionalidade</th>
                <th>Ações</th>
            </tr>
            <?php
            if (!empty($autores)) {
                foreach ($autores as $autor) {
                    echo "<tr>
                        <td>" . $autor->getId() . "</td>
                        <td>" . $autor->getNome() . "</td>
                        <td>" . $autor->getNacionalidade() . "</td>
                        <td>
                            <a href='editar_autor.php?id=" . $autor->getId() . "'>Editar</a>
                            <button onclick='confirmarExclusao(" . $autor->getId() . ")'>Excluir</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum autor encontrado</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

