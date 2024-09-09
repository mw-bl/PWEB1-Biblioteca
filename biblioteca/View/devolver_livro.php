<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EmprestimoController.php';

use Controller\EmprestimoController;

$emprestimoController = new EmprestimoController();

// Realiza um POST para devolver um livro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLivro = intval($_POST['idLivro']);
    $idEstudante = intval($_POST['idEstudante']);
    $dataDevolucao = date('Y-m-d');

    $resultado = $emprestimoController->devolverLivro($idLivro, $idEstudante, $dataDevolucao);

    if ($resultado) {
        header("Location: livros_emprestados.php");
        exit();
    } else {
        echo "<p>Erro ao devolver o livro. Verifique se o livro está emprestado e tente novamente.</p>";
    }
}

$livrosEmprestados = $emprestimoController->listarLivrosEmprestados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolver Livro</title>
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
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select, button {
            margin-bottom: 12px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #379936;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1b4c1b;
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

            input, select, button {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            input, select, button {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">Biblioteca IFCE</div>
    <div class="container">
        <h1>Devolver Livro</h1>
        <form action="devolver_livro.php" method="POST">
            <label for="idLivro">Selecionar Livro:</label>
            <select name="idLivro" id="idLivro" required>
                <?php
                if (!empty($livrosEmprestados)) {
                    foreach ($livrosEmprestados as $livro) {
                        echo "<option value='" . htmlspecialchars($livro['livro_id']) . "'>" . htmlspecialchars($livro['titulo']) . " (ID: " . htmlspecialchars($livro['livro_id']) . ")</option>";
                    }
                } else {
                    echo "<option value='' disabled>Nenhum livro emprestado encontrado</option>";
                }
                ?>
            </select>
            <label for="idEstudante">ID do Estudante:</label>
            <input type="number" name="idEstudante" id="idEstudante" required>

            <label for="dataDevolucao">Data de Devolução:</label>
            <input type="date" name="dataDevolucao" id="dataDevolucao" required>


            <button type="submit">Devolver Livro</button>
        </form>
    </div>
</body>
</html>
