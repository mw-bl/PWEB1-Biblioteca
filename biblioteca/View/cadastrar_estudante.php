<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $controller->cadastrarEstudante($nome, $matricula);
    header('Location: listar_estudantes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Estudante</title>
</head>
<body>
    <h1>Cadastrar Novo Estudante</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <form action="cadastrar_estudante.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
