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

    public function emprestarLivro($livro, $estudante) {
        $conn = $this->db->getConnection();
        $dataEmprestimo = date('Y-m-d');

        $sql = "INSERT INTO biblioteca (livro_id, estudante_id, data_emprestimo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $stmt->bind_param("iis", $livro->getId(), $estudante->getIdEstudante(), $dataEmprestimo);
        $stmt->execute();
        $stmt->close();
    }

    public function devolverLivro($livro, $estudante) {
        $conn = $this->db->getConnection();
        $dataDevolucao = date('Y-m-d');

        $sql = "UPDATE biblioteca SET data_devolucao=? WHERE livro_id=? AND estudante_id=? AND data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $stmt->bind_param("sii", $dataDevolucao, $livro->getId(), $estudante->getIdEstudante());
        $stmt->execute();
        $stmt->close();
    }

    public function listarLivrosEmprestados($estudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT b.id, l.titulo, b.data_emprestimo, b.data_devolucao FROM biblioteca b 
                INNER JOIN livro l ON b.livro_id = l.id
                WHERE b.estudante_id=? AND b.data_devolucao IS NULL";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $stmt->bind_param("i", $estudante->getIdEstudante());
        $stmt->execute();
        $result = $stmt->get_result();

        $livrosEmprestados = [];
        while ($row = $result->fetch_assoc()) {
            $livrosEmprestados[] = [
                'titulo' => $row['titulo'],
                'data_emprestimo' => $row['data_emprestimo'],
                'data_devolucao' => $row['data_devolucao']
            ];
        }

        $stmt->close();
        return $livrosEmprestados;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
