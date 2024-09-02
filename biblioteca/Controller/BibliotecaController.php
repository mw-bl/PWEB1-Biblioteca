<?php

namespace Controller;

include_once '../Model/Biblioteca.php';
include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';
include_once '../Repository/EmprestimoRepository.php';

use Model\Biblioteca;
use Model\Livro;
use Model\Estudante;
use Repository\EmprestimoRepository;

class BibliotecaController {
    private $biblioteca;

    public function __construct() {
        $this->biblioteca = new Biblioteca();
    }

    public function emprestarLivro($livroId, $estudanteId): bool {
        $livro = $this->buscarLivroPorId($livroId);
        $estudante = $this->buscarEstudantePorId($estudanteId);

        if ($livro && $estudante) {
            return $this->biblioteca->emprestarLivro($livro, $estudante);
        }

        return false;
    }

    public function devolverLivro($livroId, $estudanteId): bool {
        $livro = $this->buscarLivroPorId($livroId);
        $estudante = $this->buscarEstudantePorId($estudanteId);

        if ($livro && $estudante) {
            return $this->biblioteca->devolverLivro($livro, $estudante);
        }

        return false;
    }

    public function listarLivrosEmprestados($estudanteId): array {
        $estudante = $this->buscarEstudantePorId($estudanteId);
        if ($estudante) {
            return $this->biblioteca->livrosEmprestados($estudante);
        }

        return [];
    }

    private function buscarLivroPorId($livroId) {
        $livroRepository = new LivroRepository();
        return $livroRepository->findById($livroId);
    }

    private function buscarEstudantePorId($estudanteId) {
        $estudanteRepository = new EstudanteRepository();
        return $estudanteRepository->findById($estudanteId);
    }
}
?>
