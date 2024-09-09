<?php
namespace Controller;

include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';
include_once '../Repository/EmprestimoRepository.php';
require_once '../db/Database.php';

use Model\Livro;
use Model\Estudante;
use Repository\EmprestimoRepository;
use db\Database;

class EmprestimoController {
    private $repository;

    public function __construct() {
        $this->repository = new EmprestimoRepository();
    }

    // Empresta um livro
    public function emprestarLivro($livroId, $estudanteId) {
        $dataEmprestimo = date('Y-m-d');
        $this->repository->registrarEmprestimo($livroId, $estudanteId, $dataEmprestimo);
    }

    // Devolve um livro
    public function devolverLivro($livroId, $estudanteId, $dataDevolucao) {
        return $this->repository->registrarDevolucao($livroId, $estudanteId, $dataDevolucao);
    }

    // Lista os livros emprestados
    public function listarLivrosEmprestados() {
        return $this->repository->listarLivrosEmprestados();
    }
}
?>
