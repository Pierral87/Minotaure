<?php
class Database {
    private static $host = 'localhost';
    private static $dbname = 'mon-site';
    private static $user = 'root';
    private static $pass = '';

    public static function connect() {
        try {
            return new PDO(
                'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8',
                self::$user,
                self::$pass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}


// PHPMYADMIN

// CREATE DATABASE mon_site CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

// USE mon_site;

// CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     role ENUM('user', 'admin') DEFAULT 'user',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );