<?php
namespace Model;

use Repository\BibliotecaRepository;

class Biblioteca {
    private $livros;

    public function __construct() {
        $this->livros = [];
    }

    public function emprestarLivro($livro, $estudante) {
        $repo = new BibliotecaRepository();
        return $repo->registrarEmprestimo($livro->getId(), $estudante->getIdEstudante());
    }

    public function devolverLivro($livro, $estudante) {
        $repo = new BibliotecaRepository();
        return $repo->registrarDevolucao($livro->getId(), $estudante->getIdEstudante());
    }

    public function livrosEmprestados($estudante) {
        $repo = new BibliotecaRepository();
        return $repo->listarLivrosEmprestados($estudante->getIdEstudante());
    }
}
?>
