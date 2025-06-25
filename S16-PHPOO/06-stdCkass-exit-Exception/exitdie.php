<?php 

/* 

    exit et die : Arrêter l'exécution d'un script

    Les fonctions exit() et die() en PHP sont utilisées pour arrêter immédiatement l'exécution d'un script. 
    Elles peuvent afficher un message, ou pas 

    Contrairement aux Exception nous n'avons pas accès à un détails spécifique de l'erreur rencontrée car elles ne passent pas non plus par le système de try/catch 

    On s'en sert régulièrement pour stopper l'exécution du code après une restriction d'accès, par exemple sur une page admin, si l'utilisateur n'est pas admin, on le redirige et on stoppe l'exécution du code de la page

    Dans ce cas précis, si on ne die/exit pas la page, l'utilisateur malveillant pourrait potentiellement récupérer les données de la page malgré tout, via divers outils de navigateur car il sera malgré tout "passé" sur cette page même si cela n'a duré que quelques millisecondes

*/

echo "<h1>Coucou</h1>";

// Arreter le script 
// if (!file_exists(("fichier.txt"))) {
//     exit("Erreur : le fichier n'existe pas"); // A partir d'ici l'exécution du code s'arrête !
// }



if (!file_exists(("fichier.txt"))) {
    die("Erreur : le fichier n'existe pas"); // A partir d'ici l'exécution du code s'arrête !
}

echo "<h1>Au revoir</h1>";