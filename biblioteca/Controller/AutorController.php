<?php
namespace Controller;

include_once '../Model/Autor.php';
include_once '../Repository/AutorRepository.php';
require_once '../db/Database.php';

use Model\Autor;
use Repository\AutorRepository;
use db\Database;


class AutorController {
    private $repository;

    public function __construct() {
        $this->repository = new AutorRepository();
    }

    // Cadastra um novo autor
    public function cadastrarAutor($nome, $nacionalidade) {
        $autor = new Autor(null, $nome, $nacionalidade);
        $this->repository->save($autor);
    }

    // Edita um autor
    public function editarAutor($id, $nome, $nacionalidade) {
        $autor = $this->repository->findById($id);
        if ($autor) {
            $autor->setNome($nome);
            $autor->setNacionalidade($nacionalidade);
            $this->repository->save($autor);
        }
    }

    // Apaga um autor
    public function excluirAutor($id) {
        $this->repository->delete($id);
    }

    // Lista todos os autores
    public function listarAutores() {
        return $this->repository->findAll();
    }

    // Lista um autor pelo Id
    public function getAutorById($id) {
        return $this->repository->findById($id);
    }
}
?>
