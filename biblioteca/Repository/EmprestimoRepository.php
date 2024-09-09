<?php
namespace Repository;

require_once '../db/Database.php';
use db\Database;

class EmprestimoRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrarEmprestimo($idLivro, $idEstudante, $dataEmprestimo) {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM emprestimo WHERE idLivro = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idLivro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return false;
        }

        $sql = "INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $idLivro, $idEstudante, $dataEmprestimo);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function registrarDevolucao($idLivro, $idEstudante, $dataDevolucao) {
        $conn = $this->db->getConnection();

        $sql = "UPDATE emprestimo SET dataDevolucao = ? WHERE idLivro = ? AND idEstudante = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $dataDevolucao, $idLivro, $idEstudante);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }
    
        $stmt->close();
        return false;
    }

    public function listarLivrosEmprestados() {
        $conn = $this->db->getConnection();

        if ($conn === null) {
            error_log("Falha na conexão com o banco de dados.");
            return [];
        }

        $sql = "SELECT livro.id AS livro_id, livro.titulo, livro.ano, emprestimo.dataEmprestimo, emprestimo.dataDevolucao
                FROM emprestimo
                JOIN livro ON emprestimo.idLivro = livro.id";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Erro ao preparar a consulta: " . $conn->error);
            return [];
        }

        if (!$stmt->execute()) {
            error_log("Erro ao executar a consulta: " . $stmt->error);
            return [];
        }

        $result = $stmt->get_result();
        if ($result === false) {
            error_log("Erro ao obter o resultado: " . $conn->error);
            return [];
        }

        $livrosEmprestados = [];
        while ($row = $result->fetch_assoc()) {
            $livrosEmprestados[] = $row;
        }

        $stmt->close();
        return $livrosEmprestados;
    }
}

?>
