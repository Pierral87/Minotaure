<?php 

/*

    1 --- stdClass : L'objet générique en PHP 

    En PHP, la classe stdClass est une classe générique utilisée pour créer des objets simples. Elle est souvent utilisée lorsque nous avons besoin d'un objet mais qu'on ne souhaite pas déclarer explicitement une classe. Cet objet nous sert simplement à stocker des données, comme un tableau array, mais en ayant le souhait de rester dans un contexte 100% géré avec des objets 

    On récupère souvent des objets stdClass pour traiter des datas, par exemple sur un PDOStatement en faisant un fetch en mode FETCH_OBJ
    Sinon on peut quand même instancier un objet de cette classe comme une classe classique
*/

// Créer un objet vide de type stdClass

$objet = new stdClass();
$objet->nom = "Pierra";
$objet->age = 37;

echo "Nom de l'objet : " . $objet->nom . " et son âge : " . $objet->age;
// Ci dessus, contrairement à Societe dans le chapitre 5, nous n'avons pas d'erreur pour l'affectation et la création de nouvelles props (dans le chap 5 on avait une erreur Deprecated). Pourquoi ? Car c'est justement son but ! De stocker des données de notre choix 

// Aussi lorsqu'on fait une conversion de type, par exemple d'un array en objet, on récupèrera un objet stdClass 

$array = ["pseudo" => "lolo", "age" => 12];

// Conversion du array en objet 
$objet2 = (object) $array;

var_dump($objet2);

// L'objet stdClass, simple et léger à utiliser pour des objets temporaires ou des structures de données sans logique métier/méthodes