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

    /**
     * Realiza o empréstimo de um livro para um estudante.
     * 
     * @param Livro $livro
     * @param Estudante $estudante
     * @return bool Retorna true se o empréstimo for bem-sucedido, false caso contrário.
     */
    public function emprestarLivro(Livro $livro, Estudante $estudante): bool {
        if ($livro->isDisponivel()) {
            // Salvar o empréstimo no banco de dados
            return $this->emprestimoRepository->salvarEmprestimo($livro, $estudante);
        }
        return false;
    }

    /**
     * Realiza a devolução de um livro por um estudante.
     * 
     * @param Livro $livro
     * @param Estudante $estudante
     * @return bool Retorna true se a devolução for bem-sucedida, false caso contrário.
     */
    public function devolverLivro(Livro $livro, Estudante $estudante): bool {
        if (!$livro->isDisponivel()) {
            // Atualizar o registro de empréstimo no banco de dados
            return $this->emprestimoRepository->registrarDevolucao($livro, $estudante);
        }
        return false;
    }

    /**
     * Obtém uma lista de livros emprestados por um determinado estudante.
     * 
     * @param Estudante $estudante
     * @return array Retorna uma lista de objetos Livro que estão emprestados para o estudante.
     */
    public function livrosEmprestados(Estudante $estudante): array {
        // Busca os livros emprestados no banco de dados
        return $this->emprestimoRepository->buscarLivrosEmprestados($estudante);
    }
}

?>
