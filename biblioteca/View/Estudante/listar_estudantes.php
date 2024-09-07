<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();
$estudantes = $controller->listarEstudantes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudantes</title>
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
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este estudante?")) {
                window.location.href = 'excluir_estudante.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>Lista de Estudantes</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Matrícula</th>
            <th>Ações</th>
        </tr>
        <?php
        if (!empty($estudantes)) {
            foreach ($estudantes as $estudante) {
                echo "<tr>
                    <td>" . $estudante->getId() . "</td>
                    <td>" . $estudante->getNome() . "</td>
                    <td>" . $estudante->getMatricula() . "</td>
                    <td>
                        <a href='editar_estudante.php?id=" . $estudante->getId() . "'>Editar</a>
                        <button onclick='confirmarExclusao(" . $estudante->getId() . ")'>Excluir</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum estudante encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
