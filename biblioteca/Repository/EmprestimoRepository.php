<?php
namespace Repository;

require_once '../db/Database.php';
use db\Database;

class EmprestimoRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrarEmprestimo($idLivro, $idEstudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM emprestimo WHERE idLivro = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sqlVerifica);
        $stmt->bind_param("i", $idLivro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($resultVerifica->num_rows > 0) {
        }

        $sql = "INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo) VALUES (?, ?, CURDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idLivro, $idEstudante);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function registrarDevolucao($idLivro, $idEstudante) {
        $conn = $this->db->getConnection();

        $sql = "UPDATE emprestimo SET dataDevolucao = CURDATE() WHERE idLivro = ? AND idEstudante = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idLivro, $idEstudante);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    public function listarLivrosEmprestados($idEstudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT livro.id, livro.titulo, livro.ano, livro.autor
                FROM emprestimo
                JOIN livro ON emprestimo.idLivro = livro.id
                WHERE emprestimo.idEstudante = ? AND emprestimo.dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEstudante);
        $stmt->execute();
        $result = $stmt->get_result();

        $livrosEmprestados = [];
        while ($row = $result->fetch_assoc()) {
            $livrosEmprestados[] = $row;
        }

        $stmt->close();
        return $livrosEmprestados;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
