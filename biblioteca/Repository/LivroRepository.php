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

        $sql = "INSERT INTO livro (titulo, ano, autor) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("sss", $livro->getTitulo(), $livro->getAno(), $livro->getAutor());
        $stmt->execute();
        $stmt->close();
    }

    // perguntar a Pedro ou Chat
    public function update(Livro $livro) {
        $conn = $this->db->getConnection();

        if ($livro->getId()) {
            $sql = "UPDATE livro SET titulo=?, ano=?, autor=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $livro->getTitulo(), $livro->getAno(), $livro->getAutor(), $id->getId());
        }
        else {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $stmt->execute();
        $stmt->close();
    }

    // perguntar a Pedro ou Chat
    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT titulo, ano, autor, autorId FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($titulo, $ano, $autor);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Autor($titulo, $ano, $autor);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT titulo, ano, autor FROM livro";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['titulo'], $row['ano'], $row['autor']);
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
