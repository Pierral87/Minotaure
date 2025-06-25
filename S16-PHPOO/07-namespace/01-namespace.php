<?php 

/*

Les namespaces en PHP sont un moyen d'organiser et de structure les classes de manière logique evitant ainsi les conflits de noms, particulièrement sur des gros projets qui amènent des librairies extérieures etc 

Les namespaces permettent d'éviter les collisions en séparant les classes dans des espaces de noms 

Sans namespaces les classes sont déclarées dans un espace global.

Par bonne pratique, on veillera TOUJOURS à donner un namespace à nos classes et également à faire correspondre le namespace au nom du dossier dans lequel elles se trouvent ! Tout ça pour l'autoload du chapitre suivant 

*/



require("UtilisateurA.php");
require("UtilisateurB.php");

// J'instancie l'utilisateur de la librairie A 
// Pour instancier un objet venant d'une classe possédant un namespace, je dois spécifier son FQN !
// FQN : Full Qualified Name 
// C'est à dire je dois spécifier le nom entier de la classe, avec aussi son namespace
// On sépare toujours un namespace, d'un autre namespace, du nom de la classe, par un antislash !

// Je possède grâce à la ligne ci dessous, un objet de type non pas Userr tout court, mais de type LibrairieA\Userr
$userA = new LibrairieA\Userr;
// $userB = new LibrairieB\Userr;

var_dump($userA);
// var_dump($userB);
echo $userA->getNom();

use LibrairieA\Userr as Usair;
use LibrairieB\Userr;


$userB = new Userr;
$userA = new Usair;