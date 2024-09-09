<?php
namespace Model;

use Repository\EmprestimoRepository;

class Emprestimo {
    private $livros;

    public function __construct() {
        $this->livros = [];
    }

    // Função para emprestar um livro
    public function emprestarLivro($livro, $estudante) {
        $repo = new EmprestimoRepository();
        return $repo->registrarEmprestimo($livro->getId(), $estudante->getIdEstudante());
    }

    // Função para devolver um livro
    public function devolverLivro($livro, $estudante) {
        $repo = new EmprestimoRepository();
        return $repo->registrarDevolucao($livro->getId(), $estudante->getIdEstudante());
    }

    // Função para listar os livros emprestados
    public function livrosEmprestados($estudante) {
        $repo = new EmprestimoRepository();
        return $repo->listarLivrosEmprestados($estudante->getIdEstudante());
    }
}
?>
