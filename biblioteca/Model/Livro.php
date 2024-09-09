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

    // Getter do Id do Livro
    public function getId() {
        return $this->id;
    }

    // Getter e Setter do Titulo do Livro
    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    // Getter e Setter do Ano do Livro
    public function getAno() {
        return $this->ano;
    }
    public function setAno($ano) {
        $this->ano = $ano;
    }

    // Getter e Setter do Autor do Livro
    public function getAutor() {
        return $this->autor;
    }
    public function setAutor($autor) {
        $this->autor = $autor;
    }
}
?>
