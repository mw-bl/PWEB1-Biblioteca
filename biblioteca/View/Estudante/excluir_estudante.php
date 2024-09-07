<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$id = $_GET['id'];

$controller = new EstudanteController();
$controller->excluirEstudante($id);
header('Location: listar_estudantes.php');
exit;
?>
