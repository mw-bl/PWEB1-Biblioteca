<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

$controller = new AutorController();

// Realiza um POST para cadastrar um autor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $controller->cadastrarAutor($nome, $nacionalidade);
    header('Location: listar_autores.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Autor</title>
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
            max-width: 600px;
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

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #1b4c1b;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
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

        .input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .input:focus {
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
        <h1>Cadastrar Novo Autor</h1>
        <a href="index.php" class="back-link">Voltar para a página inicial</a>
        <form action="cadastrar_autor.php" method="post" class="form">
            <div class="form-item">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="input" required>
            </div>
            <div class="form-item">
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" class="input" required>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </div>
</body>
</html>
