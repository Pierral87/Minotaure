<?php 

/*

  Amélioration de notre autoload pour gérer aussi les namespaces en rapport avec les sous-dossiers

    En gros namespace = dossier 

    // Dans les projets modernes en PHP on utilisation des conventions d'organisation
        // On utilisera la norme PSR-4
        // La norme PSR4 défini les noms des namespaces comme étant les noms des dossiers


*/

// use MonProjet\Controller\UtilisateurController;

function inclusionAuto($class) {
  
   
    // Ici je défini mes classes comme étant dans le dossier src 
    // A la suite de ça, le nom de la classe, comme il contient le namespace de cette forme là : namespace\namespace2\class   
    // Va me permettre tout simplement de rentrer dans mes dossiers 
    $file = __DIR__ . "/src/" . $class . ".class.php";

    // J'utilise str replace pour remplacer les antislash par des slash afin d'éviter tout problème de lien defectueux

    // Tout le reste de mon autoload ne change pas ! On est maintenant capable d'aller piocher des fichiers dans des dossiers différent POUR PEU que les noms des dossiers correspondent aux noms des namespaces des classe 
    $file = str_replace("\\","/", $file);
    echo $file . "<hr>";
    require_once $file;
}


spl_autoload_register("inclusionAuto");

// $userController = new UtilisateurController;