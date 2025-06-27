    <?php

    class UserManager {
        private $pdo;

        public function __construct() {
            $this->pdo = Database::connect();
        }
        public function register($username, $email, $password) {
            try {
                $hash = password_hash($password, PASSWORD_DEFAULT); 
                $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                if ($stmt->execute([$username, $email, $hash])) {
                    return " Inscription réussie.";
                } else {
                    return " Une erreur est survenue lors de l'inscription.";
                }
            } catch (PDOException $e) {
                return " Erreur : " . $e->getMessage();
            }
        }

        public function login($username, $password) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data && password_verify($password, $data['password'])) {
                return new User($data['id'], $data['username'], $data['email'], $data['password'], $data['role']);
            }

            return false;
        }

        public function getAllUsers() {
            $stmt = $this->pdo->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteUser($id) {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        }

    }
