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

    // Novo método para listar livros disponíveis para empréstimo
    public function listarLivrosDisponiveis() {
        $livroRepository = new LivroRepository();
        return $livroRepository->findLivrosDisponiveis(); // Método que retorna os livros não emprestados
    }

    // Novo método para listar todos os estudantes
    public function listarEstudantes() {
        $estudanteRepository = new EstudanteRepository();
        return $estudanteRepository->findAll(); // Método que retorna todos os estudantes
    }

    public function livrosEmprestados($estudanteId) {
        $estudanteRepository = new EstudanteRepository();
        $estudante = $estudanteRepository->findById($estudanteId);

        if ($estudante) {
            return $this->repository->livrosEmprestados($estudante);
        }
        return "Estudante não encontrado.";
    }
}

?>
