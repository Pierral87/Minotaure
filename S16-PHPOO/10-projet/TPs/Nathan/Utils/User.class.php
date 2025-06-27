<?php 

require_once __DIR__ . '/../config.class.php';


class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $role;

    public function __construct($nom, $prenom, $email, $password) {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->role = 'user';
    }

    public function setNom($nom) {
        if(empty($nom)) {
            return "Code erreur : USN001";
        }

        if(iconv_strlen($nom) < 3) {
            return "Code erreur : USN002";
        }

        $this->nom = $nom;
        return true;
    }

    public function setPrenom($prenom) {
        if(empty($prenom)) {
            return "Code erreur : USP001";
        }

        if(iconv_strlen($prenom) < 3) {
            return "Code erreur : USP002";
        }

        $this->prenom = $prenom;
        return true;
    }

    public function setEmail($email) {
        if(empty($email)) {
            return "Code erreur : USE001";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Code erreur : USE002";
        }

        $this->email = $email;
        return true;
    }

    public function setPassword($password) {
        if(empty($password)) {
            return "Code erreur : USPS001";
        }

        if(iconv_strlen($password) < 8) {
            return "Code erreur : USPS002";
        }

        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return true;
    }

    public function setRole($role) {
        $this->role = "user";
        return true;
    }

    public function insertUser() {
        $db = new Config();
        $pdo = $db->getPDO();

        if(self::emailExists($this->email)) {
            return "UIS002";
        }

        try {
            $query = $pdo->prepare("INSERT INTO users (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$this->nom, $this->prenom, $this->email, $this->password, $this->role]);
            return true;
        } catch (PDOException $e) {
            return "UIS001";
        }
    }

    public static function emailExists($email) {
        $db = new Config();
        $pdo = $db->getPDO();
        $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user) {
            return true;
        }
        return false;
    }
    
    public static function login($email, $password) {
        $db = new Config();
        $pdo = $db->getPDO();
        $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['password'])) {
            $finalUser = $user;
            unset($finalUser['password']);
            return $finalUser;
        }
        return "ULG001";
    }



    public static function getAllUsers() {
        $db = new Config();
        $pdo = $db->getPDO();
        $query = $pdo->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteUser($id) {
        $db = new Config();
        $pdo = $db->getPDO();
        $query = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $query->execute([$id]);
        return true;
    }
}

