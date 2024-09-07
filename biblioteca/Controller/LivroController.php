<?php
namespace Controller;

include_once '../Model/Livro.php';
include_once '../Repository/LivroRepository.php';
include_once '../Repository/AutorRepository.php';
require_once '../db/Database.php';

use Model\Livro;
use Repository\LivroRepository;
use Repository\AutorRepository;

class LivroController {
    private $repository;
    private $autorRepository;

    public function __construct() {
        $this->repository = new LivroRepository();
        $this->autorRepository = new AutorRepository();
    }

    public function cadastrarLivro($titulo, $ano, $autorId) {
        $autor = $this->autorRepository->findById($autorId);
        if ($autor) {
            $livro = new Livro(null, $titulo, $ano, $autor);
            $this->repository->save($livro);
        }
    }

    public function editarLivro($id, $titulo, $ano, $autorId) {
        $livro = $this->repository->findById($id);
        if ($livro) {
            $autor = $this->autorRepository->findById($autorId);
            if ($autor) {
                $livro->setTitulo($titulo);
                $livro->setAno($ano);
                $livro->setAutor($autor);
                $this->repository->save($livro);
            }
        }
    }

    public function excluirLivro($id) {
        $this->repository->delete($id);
    }

    public function listarLivros() {
        return $this->repository->findAll();
    }

    public function getLivroById($id) {
        return $this->repository->findById($id);
    }
}
?>
