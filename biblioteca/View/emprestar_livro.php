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
        $resultado = $emprestimoController->emprestarLivro($idLivro, $idEstudante);
        if ($resultado) {
            header('Location: livros_emprestados.php');
            exit;
        } else {
            $erro = "Livro já emprestado ou erro ao registrar o empréstimo.";
        }
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
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 4rem auto 0 auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form {
            width: 100%;
        }

        .form-item {
            margin-bottom: 16px;
        }

        .form-item label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #595959;
        }

        .select, .input, .btn {
            width: 100%;
            padding: 8px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #fff;
        }

        .select:focus, .input:focus {
            border-color: #40a9ff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.2);
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #379936;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #1b4c1b;
        }

        .erro {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 2rem auto;
                padding: 1rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .btn {
                font-size: 0.8rem;
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">Biblioteca IFCE</div>
    <div class="container">
        <h1>Emprestar Livro</h1>
        <form method="POST" action="emprestar_livro.php" class="form">
            <div class="form-item">
                <label for="idLivro">Selecione o Livro:</label>
                <select name="idLivro" id="idLivro" class="select" required>
                    <option value="">Escolha um livro</option>
                    <?php foreach ($livrosDisponiveis as $livro): ?>
                        <option value="<?= htmlspecialchars($livro->getId()) ?>"><?= htmlspecialchars($livro->getTitulo()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-item">
                <label for="idEstudante">Selecione o Estudante:</label>
                <select name="idEstudante" id="idEstudante" class="select" required>
                    <option value="">Escolha um estudante</option>
                    <?php foreach ($estudantes as $estudante): ?>
                        <option value="<?= htmlspecialchars($estudante->getIdEstudante()) ?>"><?= htmlspecialchars($estudante->getNome()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Emprestar Livro</button>
            
            <?php if (isset($erro)): ?>
                <p class="erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>