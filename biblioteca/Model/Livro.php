<?php
namespace Model;

class Livro {
    private $titulo;
    private $ano;
    private $genero;

    public function __construct($id, $titulo, $ano, $genero) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->genero = $genero;
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

    public function getGenero() {
        return $this->genero;
    }
    public function setGenero($genero) {
        return $this->genero = $genero;
    }

}
?>