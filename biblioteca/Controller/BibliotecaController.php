<?php

namespace Controller;

include_once '../Model/Biblioteca.php';
include_once '../Repository/BibliotecaRepository.php';
require_once '../db/Database.php';

use Model\Biblioteca;
use Repository\BibliotecaRepository;
use db\Database;


class BibliotecaController {
    private $biblioteca;
    private $repository;

    public function __construct() {
        $this->biblioteca = new Biblioteca();
        $this->repository = new BibliotecaRepository();
    }

    public function emprestarLivro($livroId, $estudanteId): bool {
        $livro = $this->repository->findLivroById($livroId);  // Supondo que existe um método para buscar um livro por ID
        $estudante = $this->repository->findEstudanteById($estudanteId);  // Supondo que existe um método para buscar um estudante por ID

        if ($livro && $estudante) {
            $resultado = $this->biblioteca->emprestarLivro($livro, $estudante);
            if ($resultado) {
                return $this->repository->registrarEmprestimo($livro, $estudante);
            }
        }
        return false;
    }

    public function devolverLivro($livroId, $estudanteId): bool {
        $livro = $this->repository->findLivroById($livroId);
        $estudante = $this->repository->findEstudanteById($estudanteId);

        if ($livro && $estudante) {
            $resultado = $this->biblioteca->devolverLivro($livro, $estudante);
            if ($resultado) {
                return $this->repository->registrarDevolucao($livro);
            }
        }
        return false;
    }

    public function listarLivrosEmprestados($estudanteId) {
        $estudante = $this->repository->findEstudanteById($estudanteId);

        if ($estudante) {
            return $this->repository->getLivrosEmprestados($estudante);
        }
        return [];
    }
}

?>
