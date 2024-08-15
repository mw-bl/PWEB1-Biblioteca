<?php
namespace Controller;

include_once '../Model/Livro.php';
include_once '../Repository/LivroRepository.php';
require_once '../db/Database.php';

use Model\Livro;
use Repository\LivroRepository;
use db\Database;


class LivroController {
    private $repository;

    public function __construct() {
        $this->repository = new LivroRepository();
    }

    public function cadastrarLivro($titulo, $ano, $autor) {
        $livro = new Livro($titulo, $ano, $autor);
        $this->repository->save($livro);
    }

    public function editarLivro($titulo, $ano, $autor) {
        $livro->setTitulo($titulo);
        $livro->setAno($ano);
        $livro->setAutor($autor);
        $this->repository->save($livro);
    }

    // ajustar as outras partes ligadas a essa
    public function excluirLivro($id) {
        $this->repository->delete($id);
    }

    public function listarLivros() {
        return $this->repository->findAll();
    }

}
?>
