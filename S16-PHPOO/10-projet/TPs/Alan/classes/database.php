<?php

class Database {
    public static function connect() {
        try {
            $host = 'mysql:host=localhost;dbname=test';
            $login = 'root';
            $password = '';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];

            return new PDO($host, $login, $password, $options);
        } catch (Exception $e) {
            die("Site hors service.");
        }
    }
}
