<?php
namespace Model;

use Model\Livro;
use Model\Estudante;

class Biblioteca {
    private $livros;
    public function __construct($livros = []) {
        $this->livros = $livros;
    }

    public function getLivros() {
        return $this->livros;
    }

    public function setLivros($livros) {
        $this->livros = $livros;
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante, $repository) {
        $success = $repository->emprestarLivro($livro, $estudante);
        if ($success) {
            foreach ($this->livros as $key => $l) {
                if ($l->getId() == $livro->getId()) {
                    unset($this->livros[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    public function devolverLivro(Livro $livro, Estudante $estudante, $repository) {
        $success = $repository->devolverLivro($livro, $estudante);
        if ($success) {
            array_push($this->livros, $livro);
            return true;
        }
        return false;
    }

    public function livrosEmprestados(Estudante $estudante, $repository) {
        return $repository->livrosEmprestados($estudante);
    }
}
?>
