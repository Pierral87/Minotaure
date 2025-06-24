<?php

/*

-- Héritage simple

L'héritage est un concept clé de la programmation orientée objet, permettant de créer des classes dérivées qui héritent des propriétés et méthodes d'une classe parente. Cela permet de réutiliser du code et d'ajouter des fonctionnalités supplémentaires dans des classes enfants.

Ici on va faire une classe Animal, de laquelle découle une classe Chien et Chat. Ces deux sous classes vont bénéficier des propriétés et méthodes de la classe Animal.

Bien sûr, la classe enfant peut contenir ses propres méthodes et ses propres propriétés

ATTENTION à respecter un contexte cohérent pour l'héritage
    C'est à dire : Il faut pouvoir que A est un B 
        Une voiture est un vehicule 
        Un chien est un animal 
        Un admin est un user
        Un ControllerUser est un Controller

*/

class Animal
{
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer()
    {
        echo "$this->nom se déplace";
    }
}


class Chien extends Animal // Ici via le mot clé extends, on défini un héritage entre les deux classes ! C'est à dire Chien hérite de Animal et "reçoit" ses props et méthodes pour peu qu'elles soient public ou protected (le private ne transite pas à l'heritage)
{
    public function aboyer()
    {
        echo "$this->nom aboie : Woof !";
    }
}


class Chat extends Animal 
{
    public function miauler()
    {
        echo "$this->nom miaule : Nyan nyan !";
    }
}
$chien = new Chien("Milou");

$chien->seDeplacer();
$chien->aboyer();

echo "<hr>";

$chat = new Chat("Neko");

$chat->seDeplacer();
$chat->miauler();

// Attention à l'héritage je récupère uniquement les éléments public et protected
    // Dans la sous classe ces éléments garderont le même niveau de visibilité, une prop public restera public dans la sous classe, une prop protected restera protected dans la sous classe
    // Les éléments de visibilité private ne seront pas récupérés à l'héritage