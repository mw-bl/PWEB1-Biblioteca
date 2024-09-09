<?php
namespace Model;

class Estudante {
    private $idEstudante;
    private $nome;

    public function __construct($idEstudante, $nome) {
        $this->idEstudante = $idEstudante;
        $this->nome = $nome;
    }

    // Getter do Id do Estudante
    public function getIdEstudante() {
        return $this->idEstudante;
    }

    // Getter e Setter do Nome do Estudante
    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
}
?>
