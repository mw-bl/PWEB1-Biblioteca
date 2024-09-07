<?php
namespace Controller;

include_once '../Model/Estudante.php';
include_once '../Repository/EstudanteRepository.php';
require_once '../db/Database.php';

use Model\Estudante;
use Repository\EstudanteRepository;

class EstudanteController {
    private $repository;

    public function __construct() {
        $this->repository = new EstudanteRepository();
    }

    public function cadastrarEstudante($nome) {
        $estudante = new Estudante(null, $nome);
        $this->repository->save($estudante);
    }

    public function editarEstudante($idEstudante, $nome) {
        $estudante = $this->repository->findById($idEstudante);
        if ($estudante) {
            $estudante->setNome($nome);
            $this->repository->save($estudante);
        }
    }

    public function excluirEstudante($idEstudante) {
        $this->repository->delete($idEstudante);
    }

    public function listarEstudantes() {
        return $this->repository->findAll();
    }

    public function getEstudanteById($idEstudante) {
        return $this->repository->findById($idEstudante);
    }
}
?>
