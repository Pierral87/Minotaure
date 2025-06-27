<?php
class Auth {
    public static function isLogged() {
        return isset($_SESSION['user']);
    }

    public static function isAdmin() {
        return self::isLogged() && $_SESSION['user']['role'] === 'admin';
    }

    public static function requireAdmin() {
        if (!self::isAdmin()) {
            header("Location: index.php");
            exit;
        }
    }
}
