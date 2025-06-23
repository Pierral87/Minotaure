<?php 

// Utilisation d'éléments static pour stocker des éléments en rapport avec la "config" serveur
// Plutôt que de faire un fichier PHP classique (le partials _config.php), je peux tout gérer à l'intérieur d'une classe 

// Cela nous permet de centraliser les informations de configuration

class Config {
    const BASE_URL = "https://www.monsite.com/";
   
    const UPLOAD_PATH = "C:/wamp64/www/upload";

    const DB_NAME = "eshop";
    const DB_LOGIN = "root";
    const DB_PASSWORD = "password";
}

// Utilisation pour PDO par exemple

$host = "";

// $pdo = new PDO($host, Config::DB_LOGIN, Config::DB_PASSWORD);
