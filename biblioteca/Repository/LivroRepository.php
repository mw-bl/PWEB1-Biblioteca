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
            $sql = "UPDATE livro SET titulo=?, ano=?, autor_id=?, genero=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("ssisi", $livro->getTitulo(), $livro->getAno(), $livro->getAutorId(), $livro->getGenero(), $livro->getId());
        } else {
            $sql = "INSERT INTO livro (titulo, ano, autor_id, genero) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("ssis", $livro->getTitulo(), $livro->getAno(), $livro->getAutorId(), $livro->getGenero());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, autor_id, genero FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $ano, $autorId, $genero);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Livro($titulo, $ano, $autorId, $genero, $id);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, autor_id, genero FROM livro";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['titulo'], $row['ano'], $row['autor_id'], $row['genero'], $row['id']);
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
