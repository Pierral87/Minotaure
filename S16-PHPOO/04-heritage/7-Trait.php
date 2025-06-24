<?php

/*

    --- Traits 
        Les traits permettent de regrouper des méthodes et des props que l'on peut réutiliser dans des classes sans utiliser l'héritage
            De ce fait, je peux importer plusieurs traits dans une classe ! 
            Egalement, les éléments de visibilité private seront aussi transmit à la classe qui importe ces traits ! 


*/

trait Identifiable
{
    public $nomIdent;
    private $test;

    public function afficherId()
    {
        echo "Mon ID est : " . uniqid();
    }
}

trait Register
{
    public function insertBdd()
    {
        echo "J'insère dans la bdd";
    }
}

// $ident = new Identifiable; // Je ne peux pas créer un objet d'un trait 

class Utilisateur1
{
    use Identifiable, Register;
}


$user = new Utilisateur1;

var_dump($user);

$user->nomIdent = "Pierra";
echo $user->nomIdent . "<hr>";
$user->afficherId();
$user->insertBdd();
