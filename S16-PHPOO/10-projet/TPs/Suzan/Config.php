<!--

CREATE DATABASE projet_pdo;

USE projet_pdo;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

-->


<?php

class Config {
    const APP_NAME = "projet_pdo";

    private static $settings = [
        "db_host" => "localhost",
        "db_name" => "projet_pdo",
        "db_login" => "root",
        "db_password" => "root"
    ];

    private static $pdo;

    public static function getSetting($key) {
        return self::$settings[$key];
    }

    public static function setSetting($key, $value) {
        self::$settings[$key] = $value;
    }

    public static function getAppName() {
        return self::APP_NAME;
    }

    public static function getPDO() {
        if (!self::$pdo) {
            try {
                $host = self::$settings['db_host'];
                $dbname = self::$settings['db_name'];
                $login = self::$settings['db_login'];
                $password = self::$settings['db_password'];
                
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$pdo = new PDO($dsn, $login, $password, $options);
            } catch (PDOException $e) {
                echo "Site momentanément indisponible, revenez plus tard.";
                error_log($e->getMessage());
                exit;
            }
        }
        return self::$pdo;
    }
}

