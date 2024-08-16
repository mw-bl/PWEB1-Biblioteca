<?php
namespace Model;

class Estudante {
    private $id;
    private $nome;
    private $matricula;

    public function __construct($id, $nome, $matricula) {
        $this->id = $id;
        $this->nome = $nome;
        $this->matricula = $matricula;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        return $this->nome = $nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }
    public function setMatricula($matricula) {
        return $this->matricula = $matricula;
    }
}
?>
