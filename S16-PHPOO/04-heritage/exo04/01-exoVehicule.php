<?php 

/*

    Exercice  - Options d'héritage 

    Modifier le code des classes ci dessous pour répondre aux questions suivantes : 

        1 - Faire en sorte de ne pas pouvoir avoir d'objet Vehicule (abstract sur la classe vehicule)
        2 - OBLIGATION pour la Renault et la Peugeot de posséder EXACTEMENT la même méthode démarrer() (final sur la method demarrer)
        3 - OBLIGATION pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (abstract sur la methode carburant)
        4 - La Renault doit effectuer 70 tests de plus que le vehicule de base, la Peugeot doit effectuer 30 tests de plus que le vehicule de base (on redéclare nombreDeTests dans les sous classes en appelant parent::nombreDeTests pour récupérer la valeur d'origine à laquelle on ajoute les 30 et 70 tests de plus par classe)

*/


abstract class Vehicule 
{
    final public function demarrer()
    {
        return "Je demarre comme ça";
    }

    abstract public function carburant();

    public function nombreDeTests() 
    {
        return 100;
    }
}

class Peugeot extends Vehicule
{
    public function carburant() 
    {
        return "essence";
    }

    public function nombreDeTests()
    {
        return parent::nombreDeTests() + 30;
    }
}

class Renault extends Vehicule
{
    public function carburant() 
    {
        return "diesel";
    }

     public function nombreDeTests()
    {
        return parent::nombreDeTests() + 70;
    }
}