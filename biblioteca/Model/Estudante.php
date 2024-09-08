<?php
namespace Model;

class Estudante {
    private $idEstudante;
    private $nome;

    public function __construct($idEstudante, $nome) {
        $this->idEstudante = $idEstudante;
        $this->nome = $nome;
    }

    public function getIdEstudante() {
        return $this->idEstudante;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
}
?>
