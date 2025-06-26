<?php 

/*

--- Singleton

Le Singleton garantit qu'une classe n'a qu'une seule instance dans toute l'application.

// Un singleton est composé de 3 caractéristiques :
    // - Une prop privée et statique qui conservera l'instance unique de la classe
    // - Un constructeur privé afin d'empêcher la création d'objet depuis l'extérieur de la classe
    // - Une méthode statique qui permet soit d'instancier la classe soit de retourner l'unique instance créée.

    Avantages du Singleton :

    Contrôle centralisé de l'accès à une ressource unique (exemple : connexion DB).
    Facile à implémenter.

*/



class Singleton {

    // Cette prop contient l'unique instance de la classe Singleton
    private static $instance = null;

    // Le __construct() private m'empêche de pouvoir instancier la classe depuis le scope global, incapable de faire un new Singleton dans mon scope global
    private function __construct() {
        echo "<h2>Une instance de l'objet Singleton</h2>";
    }

    // Cette méthode va me créer la première et unique instance la classe, uniquement si la prop $instance est vide ! (c'est à dire qu'aucune instance de cette classe n'est pour l'instant créée)
    // Après ça, la méthode va simplement me faire un return de la prop static $instance, qui conservera l'unique objet Singleton
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}


// $objet = new Singleton;

// Ci dessous, bien que je pense créer plusieurs variables et donc plusieurs objets Singleton, en fait non, chacune de ces variables $objet $objet2 $objet3 représente le même objet
// C'est visible avec un var_dump() qui nous indique que l'id de l'objet est l'id #1
$objet = Singleton::getInstance();
var_dump($objet);
$objet2 = Singleton::getInstance();
var_dump($objet2);
$objet3 = Singleton::getInstance();
var_dump($objet3);
