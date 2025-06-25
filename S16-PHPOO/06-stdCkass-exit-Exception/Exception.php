<?php

/*

    --- Les exceptions en PHP 

    Les exceptions en PHP permettent de gérer les erreurs et les conditions anormales de manière contrôlée.
    Contrairement aux fatal error qui arrêtent immédiatement le script, les exceptions me donne un moyen d'intercepter les erreurs et de les traiter proprement

    On utilisera toujours les exceptions via des blocs try/catch 

    dans le try : je teste du code, si une erreur me déclenche une exception, je tombe dans le catch
    dans le catch : je récupère l'exception lancée dans le try et je peux en vérifier le message d'erreur ainsi que d'autres informations 

    je peux aussi rajouter un bloc finally : il s'exécutera quoi qu'il arrive après le try ou après le catch 

*/


function diviser($a, $b)
{
    // Ici je dev une fonction qui gère une division entre deux nombres
    // J'ai un cas précis, de divison par zéro, qui est pour moi impossible, donc je lance une exception si jamais cela devait survenir ! 
    if ($b == 0) {
        // Ici c'est une instanciation d'un objet Exception, il n'est pas simplement créé dans une variable mais il est throw ! S'il n'était pas throw, il resterait coincé dans le scope local de cette fonction 
        // Le throw c'est un peu comme un return, c'est pour faire sortir l'exception de la fonction et c'est rattaché au bloc try catch
        throw new Exception("Division par zéro interdite !");
    }

    return $a / $b;
}

echo "<h2>Résultat de division</h2>";
// echo diviser(10,0); // Si je ne suis pas dans un try catch, j'ai ici une fatal error uncaught Exception le code s'arrête


// Grâce au try catch ci dessous j'évite la fatal error et j'affiche plutôt le message d'erreur défini dans l'exception
// Cela me permet de gérer proprement l'erreur et de ne pas avoir une fatal error et un arrêt du code si je ne l'ai pas choisi
try {
    echo diviser(10, 0);
} catch (Exception $e) {
    // var_dump($e);
    // var_dump(get_class_methods($e));

    // Ici dans $e j'ai tous les détails de l'objet Exception à savoir, le message d'erreur, la ligne du throw de l'exception, la ligne qui déclenche l'erreur qui induit le lancement de l'exception ainsi que la fonction appelée et les params fournis (on appelle ça une trace)
    echo $e->getMessage();
    echo $e->getTraceAsString();
}


echo "<h2>Fin de script</h2>";


// La classe Exception est libre d'utilisation et n'est pas une classe finale, donc je peux créer des sous classes à Exception
class NomInvalideException extends Exception {}

function verifierNom($nom)
{
    if (iconv_strlen($nom) < 3) {
        throw new NomInvalideException(("Le nom doit avoir au moins 3 caractères."));
    } else {
        return true;
    }
}

try {
    verifierNom("Jo");
} catch (NomInvalideException $e) {
    echo "Erreur : " . $e->getMessage();
}


// On peut mettre plusieurs catch pour gérer différemment les différents types d'Exception
try {
    verifierNom("Jon");
} catch (NomInvalideException $e) {
    echo "Erreur : " . $e->getMessage();
} catch (PDOException $e) {
    echo 'Erreur BDD';
} finally {
    echo "<h2>Finally !</h2>";
}
