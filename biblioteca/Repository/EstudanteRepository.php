<?php

namespace Repository;

require_once '../db/Database.php';
include_once '../Model/Estudante.php';
use Model\Estudante;
use db\Database;

class EstudanteRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function save(Estudante $estudante) {
        $conn = $this->db->getConnection();

        if ($estudante->getIdEstudante()) {
            $sql = "UPDATE estudante SET nome=? WHERE idEstudante=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("si", $estudante->getNome(), $estudante->getIdEstudante());
        } else {
            $sql = "INSERT INTO estudante (nome) VALUES (?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("s", $estudante->getNome());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findById($idEstudante) {
        $conn = $this->db->getConnection();

        $sql = "SELECT idEstudante, nome FROM estudante WHERE idEstudante=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $idEstudante);
        $stmt->execute();
        $stmt->bind_result($idEstudante, $nome);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Estudante($idEstudante, $nome);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();

        $sql = "SELECT idEstudante, nome FROM estudante";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $estudantes = [];
        while ($row = $result->fetch_assoc()) {
            $estudantes[] = new Estudante($row['idEstudante'], $row['nome']);
        }

        $result->free();
        return $estudantes;
    }

    public function delete($idEstudante) {
        $conn = $this->db->getConnection();

        $sql = "DELETE FROM estudante WHERE idEstudante=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $idEstudante);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
