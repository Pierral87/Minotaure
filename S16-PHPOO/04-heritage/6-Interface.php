<?php 

/*

    --- Interface 

    Une interface est une structure qui définit un ensemble de méthodes vides, un peu similaire à une classe abstract, sauf que, ce n'est pas une classe ! 
    Elle ne peut pas contenir de propriétés, ni de méthodes déjà implémentées, sont seul but est de définir des méthodes vides, obligatoire à implémenter dans les classes qui "importe" qui "implements" cette interface

    Egalement, on peut importer plusieurs interface dans une classe ! Contrairement à l'héritage qui est limité à une seule classe

*/
interface AnimalCommunication {
    // public $voix; // Error, une interface ne peut pas contenir de propriétés

    public function communiquer();

}

interface Carnivore {

    public function devorer();

}

// $carnivore = new Carnivore; // Je ne peux pas instancier une interface

class Chien implements AnimalCommunication, Carnivore{  // class Chien extends AnimalCommunication {  cannot extends une interface
    public $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function communiquer() {
        echo "Le chien aboie";
    }

    public function devorer() {
        echo "Le chien devore sa proie";
    }
}

