<?php
require_once 'entity/Userr.php';

class UserManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register(Userr $user): bool {
        // Check if the user already exists
        $existingUser = $this->findByEmail($user->email);
        if ($existingUser) {
            return false; // User already exists
        }
        
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $user->username,
            $user->email,
            password_hash($user->password, PASSWORD_BCRYPT),
            $user->role ?? 'user'
        ]);
    }

    public function findByEmail($email): ?Userr {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new Userr();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            return $user;
        }
        return null;
    }

    public function getAll(): array {
        return $this->pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_CLASS, Userr::class);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    }

    public function updateRole(int $id, string $role): bool {
        return $this->pdo->prepare("UPDATE users SET role = ? WHERE id = ?")->execute([$role, $id]);
    }
}