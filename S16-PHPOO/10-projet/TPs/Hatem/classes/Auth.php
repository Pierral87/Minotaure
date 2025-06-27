<?php

class Auth {
    public static function login($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
    }

    public static function logout() {
        session_destroy();
        header('Location: connexion.php');
        exit;
    }

    public static function check() {
        return isset($_SESSION['user']);
    }

    public static function user() {
        return $_SESSION['user'] ?? null;
    }

    public static function isAdmin() {
        return self::check() && $_SESSION['user']['role'] === 'admin';
    }
}
