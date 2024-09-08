<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EmprestimoController.php';

use Controller\EmprestimoController;

$emprestimoController = new EmprestimoController();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $emprestimoController->devolverLivro($id);

    header('Location: livros_emprestados.php');
    exit;
}
?>
