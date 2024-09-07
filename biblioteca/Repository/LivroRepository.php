<?php

namespace Repository;

require_once '../db/Database.php';
include_once '../Model/Livro.php';
include_once '../Model/Autor.php';
use Model\Livro;
use Model\Autor;
use db\Database;

class LivroRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function save(Livro $livro) {
        $conn = $this->db->getConnection();

        if ($livro->getId()) {
            $sql = "UPDATE livro SET titulo=?, ano=?, autor_id=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("siii", $livro->getTitulo(), $livro->getAno(), $livro->getAutor()->getId(), $livro->getId());
        } else {
            $sql = "INSERT INTO livro (titulo, ano, autor_id) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("sii", $livro->getTitulo(), $livro->getAno(), $livro->getAutor()->getId());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findById($id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT l.id, l.titulo, l.ano, a.id AS autor_id, a.nome AS autor_nome, a.nacionalidade AS autor_nacionalidade 
                FROM livro l 
                JOIN autor a ON l.autor_id = a.id 
                WHERE l.id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $ano, $autorId, $autorNome, $autorNacionalidade);

        if ($stmt->fetch()) {
            $autor = new Autor($autorId, $autorNome, $autorNacionalidade);
            $stmt->close();
            return new Livro($id, $titulo, $ano, $autor);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();

        $sql = "SELECT l.id, l.titulo, l.ano, a.id AS autor_id, a.nome AS autor_nome, a.nacionalidade AS autor_nacionalidade 
                FROM livro l 
                JOIN autor a ON l.autor_id = a.id";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $autor = new Autor($row['autor_id'], $row['autor_nome'], $row['autor_nacionalidade']);
            $livros[] = new Livro($row['id'], $row['titulo'], $row['ano'], $autor);
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
