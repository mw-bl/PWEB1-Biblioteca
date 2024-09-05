<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

$id = $_GET['id'];

$controller = new AutorController();
$controller->excluirAutor($id);
header('Location: listar_autores.php');
exit;
?>
