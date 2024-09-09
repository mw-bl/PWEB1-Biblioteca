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

    // Cadastra um livro
    public function cadastrarLivro($titulo, $ano, $autor) {
        $livro = new Livro(null, $titulo, $ano, $autor);
        $this->repository->save($livro);
    }

    // Edita um livro
    public function editarLivro($id, $titulo, $ano, $autor) {
        $livro = $this->repository->findById($id);
        if ($livro) {
            $livro->setTitulo($titulo);
            $livro->setAno($ano);
            $livro->setAutor($autor);
            $this->repository->save($livro);
        }
    }

    // Apaga um livro
    public function excluirLivro($id) {
        $this->repository->delete($id);
    }

    // Lista os livros
    public function listarLivros() {
        return $this->repository->findAll();
    }

    // Lista um livro pelo Id
    public function getLivroById($id) {
        return $this->repository->findById($id);
    }
}
?>
