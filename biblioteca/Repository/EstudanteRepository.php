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

        if ($estudante->getId()) {
            $sql = "UPDATE estudante SET nome=? matricula=? curso=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("sssi", $estudante->getNome(), $estudante->getMatricula(), $estudante->getCurso(), $estudante->getId());
        } else {
            $sql = "INSERT INTO estudante (nome, matricula, curso) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("sss", $estudante->getNome(), $estudante->getMatricula(), $estudante->getCurso());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, nome, matricula, curso FROM estudante WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $matricula, $curso);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Estudante($id, $nome, $matricula, $curso);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, nome, matricula, curso FROM estudante";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $estudantes = [];
        while ($row = $result->fetch_assoc()) {
            $estudantes[] = new Estudante($row['id'], $row['nome'], $row['matricula'], $row['curso']);
        }

        $result->free();
        return $estudantes;
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM estudante WHERE id=?";
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
