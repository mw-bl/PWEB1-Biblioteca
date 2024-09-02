<?php

namespace Model;

use Model\Livro;
use Model\Estudante;
use Repository\EmprestimoRepository;

class Biblioteca {
    private $livros; // Lista de todos os livros disponíveis na biblioteca

    public function __construct() {
        $this->livros = [];
        $this->emprestimoRepository = new EmprestimoRepository(); // Repositório para gerenciar empréstimos
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante): bool {
        if ($livro->isDisponivel()) {
            // Salvar o empréstimo no banco de dados
            return $this->emprestimoRepository->salvarEmprestimo($livro, $estudante);
        }
        return false;
    }

    public function devolverLivro(Livro $livro, Estudante $estudante): bool {
        if (!$livro->isDisponivel()) {
            // Atualizar o registro de empréstimo no banco de dados
            return $this->emprestimoRepository->registrarDevolucao($livro, $estudante);
        }
        return false;
    }

    public function livrosEmprestados(Estudante $estudante): array {
        // Busca os livros emprestados no banco de dados
        return $this->emprestimoRepository->buscarLivrosEmprestados($estudante);
    }
}

?>
