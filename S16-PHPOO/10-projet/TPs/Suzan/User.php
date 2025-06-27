<?php
require_once 'Config.php';

class User {
    private $id;
    private $username;
    private $email;
    private $role;
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPDO();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        if (in_array($role, ['user', 'admin'])) {
            $this->role = $role;
        }
    }

    public function register($username, $email, $password, $role = 'user') {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hash,
            ':role' => $role,
        ]);
    }

   public function login($usernameOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $usernameOrEmail,
            ':email' => $usernameOrEmail
        ]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->email = $user['email'];
            $this->role = $user['role'];
            return true;
        }
        return false;
    }


    public function getAllUsers() {
        $sql = "SELECT id, username, email, role FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function deleteUserById($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function updateUser($id, $username, $email, $role) {
        $sql = "UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id
        ]);
    }

}
