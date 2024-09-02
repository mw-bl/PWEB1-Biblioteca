<?php

namespace Repository;

require_once '../db/Database.php';
use db\Database;

class EmprestimoRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function salvarEmprestimo(Livro $livro, Estudante $estudante): bool {
        $conn = $this->db->getConnection();

        $sql = "INSERT INTO Emprestimo (livro_id, estudante_id, data_emprestimo) VALUES (?, ?, CURDATE())";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $livroId = $livro->getId();
        $estudanteId = $estudante->getId();
        $stmt->bind_param("ii", $livroId, $estudanteId);

        if ($stmt->execute()) {
            $stmt->close();
            // Atualizar a disponibilidade do livro
            $this->atualizarDisponibilidadeLivro($livroId, false);
            return true;
        }
        return false;
    }

    public function registrarDevolucao(Livro $livro, Estudante $estudante): bool {
        $conn = $this->db->getConnection();

        $sql = "UPDATE Emprestimo SET data_devolucao = CURDATE() WHERE livro_id = ? AND estudante_id = ? AND data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $livroId = $livro->getId();
        $estudanteId = $estudante->getId();
        $stmt->bind_param("ii", $livroId, $estudanteId);

        if ($stmt->execute()) {
            $stmt->close();
            // Atualizar a disponibilidade do livro
            $this->atualizarDisponibilidadeLivro($livroId, true);
            return true;
        }
        return false;
    }

    public function buscarLivrosEmprestados(Estudante $estudante): array {
        $conn = $this->db->getConnection();

        $sql = "SELECT l.id, l.titulo, l.ano, l.genero, l.autor_id 
                FROM Livro l
                INNER JOIN Emprestimo e ON l.id = e.livro_id
                WHERE e.estudante_id = ? AND e.data_devolucao IS NULL";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $estudanteId = $estudante->getId();
        $stmt->bind_param("i", $estudanteId);
        $stmt->execute();
        $result = $stmt->get_result();

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livro = new Livro($row['titulo'], $row['ano'], $row['genero'], $row['autor_id']);
            $livro->setId($row['id']);
            $livros[] = $livro;
        }

        $stmt->close();
        return $livros;
    }

    private function atualizarDisponibilidadeLivro($livroId, $disponivel) {
        $conn = $this->db->getConnection();

        $sql = "UPDATE Livro SET disponivel = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("ii", $disponivel, $livroId);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
