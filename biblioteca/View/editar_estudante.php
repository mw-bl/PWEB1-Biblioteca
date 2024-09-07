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
    $matricula = $_POST['matricula'];
    $controller->editarEstudante($id, $nome, $matricula);
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
</head>
<body>
    <h1>Editar Estudante</h1>
    <a href="listar_estudantes.php">Voltar para a lista</a>
    <form action="editar_estudante.php?id=<?php echo $id; ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($estudante->getNome()); ?>" required>
        <br>
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" value="<?php echo htmlspecialchars($estudante->getMatricula()); ?>" required>
        <br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
