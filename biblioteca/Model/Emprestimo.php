<?php
namespace Model;

use Repository\EmprestimoRepository;

class Emprestimo {
    private $livros;

    public function __construct() {
        $this->livros = [];
    }

    public function emprestarLivro($livro, $estudante) {
        $repo = new EmprestimoRepository();
        return $repo->registrarEmprestimo($livro->getId(), $estudante->getIdEstudante());
    }

    public function devolverLivro($livro, $estudante) {
        $repo = new EmprestimoRepository();
        return $repo->registrarDevolucao($livro->getId(), $estudante->getIdEstudante());
    }

    public function livrosEmprestados($estudante) {
        $repo = new EmprestimoRepository();
        return $repo->listarLivrosEmprestados($estudante->getIdEstudante());
    }
}
?>
