<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

// Realiza um GET para pegar o Id do estudante
$id = $_GET['id'];

// Chama a função excluirAutor() do Controller para realizar a exclusao do estudante pelo ID chamado
$controller = new EstudanteController();
$controller->excluirEstudante($id);
header('Location: listar_estudantes.php');
exit;
?>
