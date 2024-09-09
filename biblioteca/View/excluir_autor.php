<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

// Realiza um GET para pegar o Id do autor
$id = $_GET['id'];

// Chama a função excluirAutor() do Controller para realizar a exclusao do autor
$controller = new AutorController();
$controller->excluirAutor($id);
header('Location: listar_autores.php');
exit;
?>

