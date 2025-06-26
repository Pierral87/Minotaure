<?php

/*

    -- Utilisation de l'autoloading de Composer pour nos propres classes 

Composer, outre le fait d'être un outil puissant de gestion de dépendances d'un projet, il nous permet aussi d'intégrer directement un autoload sur notre projet.

L'autoload de composer est basé sur la norme PSR-4 qui va mapper les namespaces aux dossiers du projet et on définira un projet racine 

Il faut créer le fichier composer.json

{
    "autoload" : {
        "psr-4": {
            "ProjetPierra\\": "src/"
        }
    }
}

Ici on spécifie l'appel de l'autoload de composer, en norme psr4 et on lui dit de lier notre namespace principal ProjetPierra au dossier src/ 

Une fois qu'on a fait ça, on doit dumper l'autoload avec la commande 
(ATTENTION A BIEN ETRE DANS LE DOSSIER RACINE DU PROJET, POUR MOI ICI LE DOSSIER AutoloadComposer)
composer dump-autoload 
Composer va alors installer l'autoload dans notre projet (il va créer le dossier vendor et y installer ce dont il a besoin)

Maintenant il nous suffit d'inclure sur la page ici l'autoload de composer et il ajoutera les fichiers automatiquement comme nos autoload fait main
*/

use ProjetPierra\Controller\UtilisateurController;
use ProjetPierra\Model\UtilisateurModel;


// Ici ci dessous le require de l'autoload de composer (il se trouve à la racine de vendor)
require("vendor/autoload.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Test d'autoload de composer, je vais instancier une classe ici en dessous</h1>

    <?php 

    $utilisateurController = new UtilisateurController;
    $utilisateurModel = new UtilisateurModel;

?>
    
</body>
</html>