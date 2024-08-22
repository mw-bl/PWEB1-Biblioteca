<?php

namespace Repository;

require_once '../db/Database.php';
include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';

use Model\Livro;
use Model\Estudante;
use db\Database;

class BibliotecaRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrarEmprestimo(Livro $livro, Estudante $estudante): bool {
        $conn = $this->db->getConnection();

        // Registro do empréstimo
        $sql = "UPDATE livro SET disponivel=0, estudante_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("ii", $estudante->getId(), $livro->getId());
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function registrarDevolucao(Livro $livro): bool {
        $conn = $this->db->getConnection();

        // Registro da devolução
        $sql = "UPDATE livro SET disponivel=1, estudante_id=NULL WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $livro->getId());
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getLivrosEmprestados(Estudante $estudante): array {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT * FROM livro WHERE estudante_id=? AND disponivel=0";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $estudante->getId());
        $stmt->execute();
        
        $result = $stmt->get_result();
        $livrosEmprestados = [];
        
        while ($row = $result->fetch_assoc()) {
            $livro = new Livro($row['titulo'], $row['ano'], $row['autor_id'], $row['genero'], $row['id']);
            $livrosEmprestados[] = $livro;
        }

        $stmt->close();
        return $livrosEmprestados;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}

?>
