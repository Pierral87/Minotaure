<?php

/* 

    finalisation des classes et des méthodes 

    Le mot-clé final amène des restrictions sur l'héritage ou après héritage 

    Classe finale : une classe marquée comme final ne peut pas être extends, elle ne peut pas servir de modèle pour un héritage
    Méthode finale : Une méthode marquée comme final ne peut pas être surchargée dans les classes filles 

    Ci dessous dans la classe Animal, la methode seDeplacer() est une méthode finale, je la récupère bien à l'héritage, MAIS, je ne peux pas la surcharger dans Chien

    Plus bas, la classe Chat étant une classe final, je ne peux plus faire d'héritage à partir de celle ci

*/

class Animal
{
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    // Ici je défini la méthode comme étant une méthode finale, elle ne pourra pas être surchargée après héritage
    final public function seDeplacer()
    {
        echo "$this->nom se déplace";
    }
}

$animal = new Animal("Bibo");
$animal->seDeplacer();

class Chien extends Animal {

    // Erreur si je tente d'override la méthode, elle est finale, je ne peux plus intéragir dessus car elle est considérée comme étant dans son état "final"
    // public function seDeplacer() {echo "$this->nom court à toute vitesse"; }
}

$chien = new Chien("Rex");
$chien->seDeplacer();


// Je peux aussi définir des classes entières comme étant final, dans ce cas, je ne peux pas hériter de cette classe, elle n'aura aucune sous classe
final class Chat extends Animal {

    // Erreur si je tente d'override la méthode, elle est finale, je ne peux plus intéragir dessus car elle est considérée comme étant dans son état "final"
    // public function seDeplacer() {echo "$this->nom court à toute vitesse"; }
}


// Je ne peux pas hériter de Chat car c'est une classe finale
// class MaineKoun extends Chat {}