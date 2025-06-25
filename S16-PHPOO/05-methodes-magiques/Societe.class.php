<?php 

/*

    Les Méthodes Magiques en PHP 

    Les méthodes magiques sont des fonctions spéciales en PHP qui commencent toujours par deux underscores __  Elles permettent d'intercepter certaines opérations sur les objets et d'ajouter des comportements personalisés. 

    1 --  __construct() : Le constructeur 
        Le constructeur est une méthode appelée automatiquement lors de la création d'une nouvelle instance d'une classe. Elle est utilisée pour initialiser les propriétés d'un objet 

    2 -- __destruct() : Le destructeur 
        Le destructeur est appelé automatiquement lorsque l'objet est détruit (avec unset()) ou lorsque le script se termine.
        Il peut être utilisé pour effectuer des actions de nettoyage, comme la fermeture d'une connexion à une bdd ou des opérations de sauvegarde/logs 

    3 -- __set() : Modifier/Creer/Affecter une valeur dans une prop non définie 
        Cette méthode me permet de gérer dynamiquement le fait que quelqu'un essaie de manipuler une prop qui n'existe pas 

    4 -- __get() : Manipulation d'une prop non définie 
        Cette méthode me permet de gérer dynamiquement et de limiter le fait que quelqu'un tente d'accéder à une prop qui n'existe pas 

    5 -- __call() et __callStatic() : Appel de méthodes non définies
        Ces méthodes sont déclenchées lorsque l'on appelle une méthode inexistantes dans la classe 

    6 -- __toString() : Conversion d'un objet en chaine de caractères
        Lorsqu'un objet est utilisé comme un string (par exemple un echo d'un objet)

    7 -- __invoke() : Appeler un objet comme une fonction 

    8 -- __sleep()  __wakeup() 
*/

class Societe 
    {
        public $nom;
        public $ville;

        public function __construct($nom, $ville) {
            $this->nom = $nom;
            $this->ville = $ville;
            echo "Lancement du __construct() <hr>";
        }

        public function __destruct() {
            echo "C'est fini pour aujourd'hui <hr>";
        }

        public function __set($nom, $valeur) {
            echo "Tentative de manipulation de la prop $nom avec la valeur $valeur mais cela ne fonctionne pas ! Cette prop n'existe pas ! <hr>";
        }

        public function __get($nom) {
            echo "Tentative de récupération de la prop $nom mais elle n'existe pas !!!!<hr>";
        }

        public function __call($nom, $param) {
            echo "Tentative d'exécuter une méthode $nom mais elle n'existe pas ! <br> les params envoyés étaient : " . implode(" - ", $param) . "<hr>";
        }
    }


    $soc = new Societe("Nintendo", "Kyoto");

    $soc->pays = "Japon";

    echo "Affichage de la prop pays $soc->pays";

    var_dump($soc);

    $soc->affichePays("coucou", 123);

