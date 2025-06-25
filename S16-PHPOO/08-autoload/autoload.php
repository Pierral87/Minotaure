<?php 

/*

    Autoloading en PHP 

    En PHP, l'autoload nous permet de require/include les fichiers de classes sans avoir à se soucier nous même de faire les require include en tête de page ! 

    Le système va comprendre de lui même les classes que je suis en train de manipuler sur ma page et va de lui même les require ! 

    Cela nous évite de faire des lignes et des lignes d'instruction require, comme ci-après

    require("fichiera.php");
    require("fichierb.php");
    require("fichierc.php");
    require("fichierd.php");
    require("fichiere.php");
    require("fichierf.php");
    require("fichierg.php");
    require("fichierh.php");

    Dès qu'une classe est mentionnée, que ce soit une instanciation ou un appel d'un élément static, l'autoload va se lancer et inclure le fichier contenant cette classe.
    Evidemment le système comprends lorsqu'une classe est déjà présente sur le fichier, il ne la réinsère pas 


*/

// Ici ma fonction me permettant de lancer le require du fichier contenant la classe
function inclusionAuto($class) {
    // echo "<h2>J'ai récupéré la classe : $class</h2>";

    // Je concatène le nom de la classe avec mes conventions de nommage de fichier/dossier, en lien absolu (c'est mieux), pour réussir à atteindre le fichier à require
    $file = __DIR__ . "/Classes/" . $class . ".class.php";
    // Ici je fais juste un echo de test pour me rendre compte de qu'est ce qui est exactement require
    echo $file . "<hr>";
    require_once $file;
}


// spl_autoload_register est une fonction qui se déclenche dès lors qu'il y a mention d'une classe, instanciation, appel d'un élément static ou autre
// Elle va être capable de récupérer le nom de cette classe, et d'exécution la fonction ou la méthode que je lui ai spécifié entre parenthèses
// Dans notre cas, elle va être capable de la lancer la fonction inclusionAuto, en transmettant en param de cette fonction, le nom de la classe recherchée
spl_autoload_register("inclusionAuto");



// On peut tester ici l'instanciation d'une classe TestA, on remarque bien que l'autoload est bien capable d'aller chercher la classe TestA en faisant un require du fichier TestA.class.php 
// $testA = new TestA;

// var_dump($testA);