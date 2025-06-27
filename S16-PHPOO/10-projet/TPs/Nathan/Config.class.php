<?php 

class Config {
    private $db_host = "localhost";
    private $db_name = "phpoo";
    private $db_user = "root";
    private $db_pass = "";
    private $pdo = null;

    public function connectDB() {
        try {
            $this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            return true;
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function getPDO() {
        if($this->pdo === null) {
            $this->connectDB();
        }
        return $this->pdo;
    }
}