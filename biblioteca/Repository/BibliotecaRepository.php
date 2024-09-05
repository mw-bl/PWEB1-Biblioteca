<?php

namespace Repository;

require_once '../db/Database.php';
include_once '../Model/Biblioteca.php';
include_once '../Model/Livro.php';
include_once '../Model/Estudante.php';
use Model\Biblioteca;
use Model\Livro;
use Model\Estudante;
use db\Database;

class BibliotecaRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT id FROM emprestimos WHERE livro_id=? AND data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $livro->getId());
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return false;
        }

        $stmt->close();
        $sql = "INSERT INTO emprestimos (livro_id, estudante_id, data_emprestimo) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $livro->getId(), $estudante->getId());
        $stmt->execute();
        $stmt->close();
        
        return true;
    }

    public function devolverLivro(Livro $livro, Estudante $estudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT id FROM emprestimos WHERE livro_id=? AND estudante_id=? AND data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $livro->getId(), $estudante->getId());
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt->close();
            return false;
        }

        $stmt->close();
        $sql = "UPDATE emprestimos SET data_devolucao = NOW() WHERE livro_id=? AND estudante_id=? AND data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $livro->getId(), $estudante->getId());
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function livrosEmprestados(Estudante $estudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT l.id, l.titulo, l.ano, l.autor_id 
                FROM emprestimos e 
                JOIN livro l ON e.livro_id = l.id 
                WHERE e.estudante_id = ? AND e.data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $estudante->getId());
        $stmt->execute();
        $result = $stmt->get_result();

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['id'], $row['titulo'], $row['ano'], $row['autor_id']);
        }

        $stmt->close();
        return $livros;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
