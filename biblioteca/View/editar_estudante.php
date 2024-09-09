<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $estudante = $controller->getEstudanteById($id);
} else {
    header('Location: listar_estudantes.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $controller->editarEstudante($id, $nome);
    header('Location: listar_estudantes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudante</title>
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
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 4rem auto;
            padding: 2rem;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
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

        .form-item {
            margin-bottom: 16px;
        }

        .form-item label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #595959;
        }

        .form-item input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-item input:focus {
            border-color: #40a9ff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.2);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #379936;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #1b4c1b;
        }

        @media (max-width: 768px) {
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
    <div class="navbar">Editar Estudante</div>
    <div class="container">
        <a href="listar_estudantes.php" class="back-link">Voltar para a lista</a>
        <form action="editar_estudante.php?id=<?php echo $id; ?>" method="post">
            <div class="form-item">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($estudante->getNome()); ?>" required>
            </div>
            <button type="submit" class="btn">Atualizar</button>
        </form>
    </div>
</body>
</html>

