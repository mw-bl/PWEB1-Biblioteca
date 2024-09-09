<?php
namespace db;

class Database {
    private $conn;

    public function __construct() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "root";
        $dbname = "Biblioteca";

        $this->conn = new \mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
    public function testConnection() {
        if ($this->conn) {
            echo "Conexão estabelecida.";
        } else {
            echo "Falha na conexão.";
        }
    }
}
?>
