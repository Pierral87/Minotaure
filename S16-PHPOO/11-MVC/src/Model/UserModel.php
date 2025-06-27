<?php 
namespace ProjetAdmin\Model;

use PDO;
use PDOException;

class UserModel {

    // Ici on va conserver l'élément PDO
    protected $db;

    public function __construct() {
        // echo "<h2>Initialisation du Model UserModel</h2>";
    }


    // Ici cette méthode me sert à créer l'objet PDO et le retourner
    // Si l'objet PDO est déjà présent dans la prop $db je vais simplement le retourner
    public function getDb()
    {
        if (!$this->db) {
            try {
                $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, [
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                ]);
            } catch (PDOException $e) {
                echo "Erreur de connexion à la BDD";
                echo $e->getMessage();
                exit;
            }
        }

        return $this->db;
    }

    // Ici cette méthode me sert à faire la selection de tous les users
    public function modelSelectAll() {
       return $this->getDb()->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modelSelectOne($id) {
          return $this->getDb()->query("SELECT * FROM users WHERE id_user = $id")->fetch(PDO::FETCH_ASSOC);
    }

}