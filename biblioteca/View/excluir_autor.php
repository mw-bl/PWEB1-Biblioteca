<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

$id = $_GET['id'];

// Realiza um GET para pegar o Id do autor
$controller = new AutorController();
// Chama a função excluirAutor() para realizar a exclusao do autor
$controller->excluirAutor($id);
header('Location: listar_autores.php');
exit;
?>

