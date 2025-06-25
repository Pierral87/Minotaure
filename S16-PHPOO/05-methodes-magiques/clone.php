<?php 

class Ecole 
{
    public $nom = "Cloud Campus";
    public $statut = "Centre de formation";

    public function __clone() {
        // Lorsqu'on modifie des éléments ici dans la méthode magique __clone, cela intervient sur l'objet cloné ! et non pas l'objet qui sert de modèle au clone !
        // Dans notre contexte plus bas, le $this représente ici $ecole3, objet id #3
        $this->statut = "Inconnu";
    }
}


$ecole1 = new Ecole;
var_dump($ecole1); // objet [1] : id #1 dans la mémoire serveur

$ecole1->nom = "Pierra Formation";
var_dump($ecole1); // objet [1] : id #1 dans la mémoire serveur

$ecole2 = new Ecole;
var_dump($ecole2); // objet [2] : id #2 dans la mémoire serveur

$ecole3 = clone $ecole1; // Ici, si je ne fais pas un clone, je rajoute simplement une variable $ecole3 qui pointera vers le même objet que la variable $ecole1 c'est à dire l'objet id #1
// En faisant un clone je m'assure de dédoubler l'objet, en en créant un nouveau qui est maintenant indépendant du premier, on a tout simplement récupérer toutes les valeurs de ses propriétés, on en a fait un clone ! 
// Je peux lancer l'instruction clone sans forcement définir la méthode magique associée
// Si je défini la méthode magique __clone() alors tout le code à l'intérieur de la méthode magique sera exécuté lorsqu'un clone survient ! On peut s'en servir pour peut être remettre par défaut des propriétés qu'on ne souhaite pas copier d'un objet à l'autre
var_dump($ecole3);

$ecole3->statut = "Entreprise Dev Online"; // Si je n'ai pas fait un clone, ici, cela modifiera l'objet #1, qu'il soit appelé par $ecole3 ou $ecole1
var_dump($ecole3);


$ecole1->statut = "Ecole"; // Si je n'ai pas fait un clone, ici, cela modifiera l'objet #1, qu'il soit appelé par $ecole3 ou $ecole1

echo "Ecole 1 : ";
var_dump($ecole1);
echo "<hr>";
echo "Ecole 2 : ";
var_dump($ecole2);
echo "<hr>";
echo "Ecole 3 : ";
var_dump($ecole3);
echo "<hr>";


