<?php
namespace Model;

class Biblioteca {
    private $id;
    private $livro;
    private $estudante;
    private $dataEmprestimo;
    private $dataDevolucao;

    public function __construct($id, $livro, $estudante, $dataEmprestimo, $dataDevolucao = null) {
        $this->id = $id;
        $this->livro = $livro;
        $this->estudante = $estudante;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
    }

    public function getId() {
        return $this->id;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function setLivro($livro) {
        $this->livro = $livro;
    }

    public function getEstudante() {
        return $this->estudante;
    }

    public function setEstudante($estudante) {
        $this->estudante = $estudante;
    }

    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }

    public function setDataEmprestimo($dataEmprestimo) {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    public function getDataDevolucao() {
        return $this->dataDevolucao;
    }

    public function setDataDevolucao($dataDevolucao) {
        $this->dataDevolucao = $dataDevolucao;
    }
}
?>
