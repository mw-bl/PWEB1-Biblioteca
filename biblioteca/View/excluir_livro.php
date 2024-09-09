<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

// Realiza um GET para pegar o Id do livro
$id = $_GET['id'];

// Chama a função excluirLivro() do Controller para realizar a exclusao do livro pelo ID chamado
$controller = new LivroController();
$controller->excluirLivro($id);
header('Location: listar_livros.php');
exit;
?>
