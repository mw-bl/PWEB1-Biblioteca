<?php

namespace Repository;

require_once '../db/Database.php';
include_once '../Model/Livro.php';
use Model\Livro;
use db\Database;

class LivroRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function save(Livro $livro) {
        $conn = $this->db->getConnection();

        if ($livro->getId()) {
            $sql = "UPDATE Livro SET titulo=?, ano=?, genero=?, autor_id=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("ssisi", $livro->getTitulo(), $livro->getAno(), $livro->getAutorId(), $livro->getGenero(), $livro->getId());
        } else {
            $sql = "INSERT INTO livro (titulo, ano, genero, autor_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("sssi", $livro->getTitulo(), $livro->getAno(), $livro->getGenero(), $livro->getAutorId());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, genero, autor_id FROM Livro";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro( $row['id'], $row['titulo'], $row['ano'], $row['genero'], $row['autor_id']);
        }

        $result->free();
        return $livros;
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
