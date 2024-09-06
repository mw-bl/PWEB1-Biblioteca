<?php
namespace Controller;

include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';
include_once '../Repository/BibliotecaRepository.php';
require_once '../db/Database.php';

use Model\Livro;
use Model\Estudante;
use Repository\BibliotecaRepository;
use db\Database;

class BibliotecaController {
    private $repository;

    public function __construct() {
        $this->repository = new BibliotecaRepository();
    }

    public function emprestarLivro($livroId, $estudanteId) {
        $livroRepository = new LivroRepository();
        $estudanteRepository = new EstudanteRepository();

        $livro = $livroRepository->findById($livroId);
        $estudante = $estudanteRepository->findById($estudanteId);

        if ($livro && $estudante) {
            $success = $this->repository->emprestarLivro($livro, $estudante);
            if ($success) {
                return "Livro emprestado com sucesso.";
            } else {
                return "Este livro já está emprestado.";
            }
        }
        return "Livro ou estudante não encontrado.";
    }

    public function devolverLivro($livroId, $estudanteId) {
        $livroRepository = new LivroRepository();
        $estudanteRepository = new EstudanteRepository();

        $livro = $livroRepository->findById($livroId);
        $estudante = $estudanteRepository->findById($estudanteId);

        if ($livro && $estudante) {
            $success = $this->repository->devolverLivro($livro, $estudante);
            if ($success) {
                return "Livro devolvido com sucesso.";
            } else {
                return "Nenhum empréstimo ativo para este livro.";
            }
        }
        return "Livro ou estudante não encontrado.";
    }

    public function listarLivrosEmprestados($estudanteId) {
        $estudanteRepository = new EstudanteRepository();
        $estudante = $estudanteRepository->findById($estudanteId);

        if ($estudante) {
            return $this->repository->livrosEmprestados($estudante);
        }
        return "Estudante não encontrado.";
    }
}
?>
