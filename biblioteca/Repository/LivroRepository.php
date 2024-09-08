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
            $sql = "UPDATE livro SET titulo=?, ano=?, autor=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisi", $livro->getTitulo(), $livro->getAno(), $livro->getAutor(), $livro->getId());
        } else {
            $sql = "INSERT INTO livro (titulo, ano, autor) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sis", $livro->getTitulo(), $livro->getAno(), $livro->getAutor());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, autor FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $ano, $autor);
        
        if ($stmt->fetch()) {
            $stmt->close();
            return new Livro($id, $titulo, $ano, $autor);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, autor FROM livro";
        $result = $conn->query($sql);
        
        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['id'], $row['titulo'], $row['ano'], $row['autor']);
        }

        $result->free();
        return $livros;
    }
    
    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
