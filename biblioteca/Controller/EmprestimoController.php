<?php
namespace Controller;

include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';
include_once '../Repository/EmprestimoRepository.php';
require_once '../db/Database.php';

use Model\Livro;
use Model\Estudante;
use Repository\EmprestimoRepository;

class EmprestimoController {
    private $repository;

    public function __construct() {
        $this->repository = new EmprestimoRepository();
    }

    public function emprestarLivro($livroId, $estudanteId) {
        $livro = new Livro($livroId, "", 0, null);
        $estudante = new Estudante($estudanteId, "");
        $this->repository->emprestarLivro($livro, $estudante);
    }

    public function devolverLivro($livroId, $estudanteId) {
        $livro = new Livro($livroId, "", 0, null);
        $estudante = new Estudante($estudanteId, "");
        $this->repository->devolverLivro($livro, $estudante);
    }

    public function listarLivrosEmprestados($estudanteId) {
        $estudante = new Estudante($estudanteId, "");
        return $this->repository->listarLivrosEmprestados($estudante);
    }
}
?>
