<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

$id = $_GET['id'];

$controller = new LivroController();
$controller->excluirLivro($id);
header('Location: listar_livros.php');
exit;
?>
