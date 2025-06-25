<?php

// Ici je défini un namespace pour ce fichier, c'est une sorte de "dossier virtuel" qui me permet de catégoriser mes classes

// Il est toujours bon de spécifier un namespace à nos classes pour éviter les conflits de nom (deux classes du meme nom) dans un meme projet

// A terme et avec un autoload activé, on va faire correspondre nos namespace à nos dossiers réels !

// Par exemple ce fichier UtilisateurA.php possédant le namespace LibrairieA, devra se trouver dans un dossier nommé lui aussi LibrairieA
namespace LibrairieA;

class Userr
{
    public function getNom()
    {
        return "Boba";
    }
}


echo __NAMESPACE__;


// ATTENTION 
// Lorsque je me trouve dans un namespace je suis dans une sorte de scope global dans lequel je n'ai pas accès aux classes prédéfinies de PHP, il pense que je les cherche dans le même space de ma page

// Pour réatteindre une classe prédéfinie de PHP n'ayant pas de namespace, je peux simplement rajouter un "\" devant le nom de la classe, cela me permet de sortir du namespace de la page en cours 

try {

} catch (\Exception $e) {

}

// $pdo = new \PDO("", "", "");