<?php

use ProjetAdmin\Controller\UserController;

require_once("vendor/autoload.php");
require_once("partials/_config.php");

// Ici index.php c'est le point d'entrée de notre architecture
// On considère qu'en MVC on ne change jamais de page, ce sont les pages qui viennent à nous ! 
// En fait grâce à l'architecture MVC, c'est le contenu de index qui sera changeant via des require qui vont insérer différent templates/layouts en fonction des flux (des scénarios d'entrés de l'utilisateur sur notre site)

// On défini ici les controllers qui existent dans notre app pour gérer le routage
$controllers = ["user", "product"];

// Cette condition me permet de gérer le routage, à savoir, quel Controller est à utiliser et donc qu'est ce que je vais amener comme données à l'utilisateur par rappport à son scénario d'accès à mon site 
if (isset($_GET["ctrl"]) && in_array($_GET["ctrl"], $controllers)) {
    if ($_GET["ctrl"] == "product") {
        $controller = new ProductController;
    } elseif ($_GET["ctrl"] == "user") {
        $controller = new UserController;
    }
} else {
    // On instancie le controller et voyons ce qu'il se passe
    $controller = new UserController;
}

$controller->handleRequest();