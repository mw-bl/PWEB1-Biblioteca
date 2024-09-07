<?php
namespace Model;

class Livro {
    private $id;
    private $titulo;
    private $ano;
    private $autor;

    public function __construct($id, $titulo, $ano, $autor) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->autor = $autor;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        return $this->titulo = $titulo;
    }

    public function getAno() {
        return $this->ano;
    }
    public function setAno($ano) {
        return $this->ano = $ano;
    }

    public function getAutor() {
        return $this->autor;
    }
    public function setAutor($autor) {
        return $this->autor = $autor;
    }
}
?>
