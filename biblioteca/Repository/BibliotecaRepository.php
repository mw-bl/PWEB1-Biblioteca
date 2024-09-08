<?php
namespace Repository;

require_once '../db/Database.php';
use db\Database;

class BibliotecaRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrarEmprestimo($idLivro, $idEstudante) {
        $conn = $this->db->getConnection();

        // Verifica se o livro já está emprestado
        $sqlVerifica = "SELECT * FROM emprestimo WHERE idLivro = ? AND dataDevolucao IS NULL";
        $stmtVerifica = $conn->prepare($sqlVerifica);
        $stmtVerifica->bind_param("i", $idLivro);
        $stmtVerifica->execute();
        $resultVerifica = $stmtVerifica->get_result();

        if ($resultVerifica->num_rows > 0) {
            return false;  // O livro já está emprestado
        }

        // Registra o empréstimo
        $sql = "INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo) VALUES (?, ?, CURDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idLivro, $idEstudante);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function registrarDevolucao($idLivro, $idEstudante) {
        $conn = $this->db->getConnection();

        // Verifica se há um empréstimo ativo desse livro para esse estudante
        $sql = "UPDATE emprestimo SET dataDevolucao = CURDATE() WHERE idLivro = ? AND idEstudante = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idLivro, $idEstudante);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;  // Livro devolvido com sucesso
        }

        $stmt->close();
        return false;  // Nenhum empréstimo ativo encontrado
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
