<?php 

/*

    Exercice  - Options d'héritage 

    Modifier le code des classes ci dessous pour répondre aux questions suivantes : 

        1 - Faire en sorte de ne pas pouvoir avoir d'objet Vehicule 
        2 - OBLIGATION pour la Renault et la Peugeot de posséder EXACTEMENT la même méthode démarrer()
        3 - OBLIGATION pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence 
        4 - La Renault doit effectuer 70 tests de plus que le vehicule de base, la Peugeot doit effectuer 30 tests de plus que le vehicule de base

*/


class Vehicule 
{
    public function demarrer()
    {
        return "Je demarre comme ça";
    }

    public function carburant() 
    {
        return "essence ou diesel";
    }

    public function nombreDeTests() 
    {
        return 100;
    }
}

class Peugeot 
{

}

class Renault 
{

}