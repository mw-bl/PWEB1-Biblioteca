<?php

namespace Model;

include_once 'Livro.php';
include_once 'Estudante.php';

use Model\Livro;
use Model\Estudante;

class Biblioteca {
    private $livros = [];

    public function __construct() {
        // Inicializar a lista de livros (ou carregar do banco, se necessário)
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante): bool {
        if ($livro->isDisponivel()) {
            $livro->setDisponivel(false);
            // Aqui, você pode salvar a informação do empréstimo no banco de dados
            return true;
        }
        return false;
    }

    public function devolverLivro(Livro $livro, Estudante $estudante): bool {
        if (!$livro->isDisponivel()) {
            $livro->setDisponivel(true);
            // Aqui, você pode atualizar a informação de devolução no banco de dados
            return true;
        }
        return false;
    }

    public function livrosEmprestados(Estudante $estudante): array {
        // Retorna uma lista de livros que o estudante tem emprestado
        $livrosEmprestados = [];

        foreach ($this->livros as $livro) {
            if ($livro->getEstudanteId() === $estudante->getId() && !$livro->isDisponivel()) {
                $livrosEmprestados[] = $livro;
            }
        }

        return $livrosEmprestados;
    }
}

?>
