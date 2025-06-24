<?php

/*

    --- Classes abstraites et méthodes abstraites 

    Une classe abstraite ne peut pas être instanciée directement, mais elle sert de modèle pour d'autres classes. 
    Elle peut contenir des méthodes abstraites, qui doivent être définies dans les classes enfants.

        Méthode abstraite : Une méthode déclarée mais non implémentée dans une classe abstraite. Par contre, elle oblige les classes filles à définir cette méthode ! 


    Notre classe Animals est abstraite et ne peut pas être instanciée. Les méthodes abstraites communiquer() et seDeplacer() sont à définir OBLIGATOIREMENT dans Chien et Chat et toutes les autres.

    L'utilisation des classes abstraites permet de fournir un cadre strict de développement pour que les équipes de dev travaillent de la même manière avec les mêmes noms de méthode.


*/


abstract class Animals // Ici je défini la classe comme étant abstraite, je ne peux plus l'instancier
{
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    // Les deux méthodes ci dessous sont abstraites, elles ne peuvent pas contenir de "corps", je ne peux pas mettre les {}
    // Ces deux méthodes sont à redéfinir dans les sous classes 
    abstract public function communiquer();
    abstract public function seDeplacer();
}

// $animal = new Animals("Poki"); // Error je ne peux pas instancier une classe abstract



class Chien extends Animals // Ici héritage d'une classe abstract j'ai l'obligation d'implémenter les méthodes abstract
{

    public function communiquer()
    {
        echo "aboyer";
    }

    public function seDeplacer()
    {
        echo "Le chien court à toute vitesse !";
    }
}

class Chat extends Animals // Ici héritage d'une classe abstract j'ai l'obligation d'implémenter les méthodes abstract
{

    public function communiquer()
    {
        echo "miauler";
    }

    public function seDeplacer()
    {
        echo "Le chat se déplace furtivement !";
    }
}

$chien = new Chien("Milou");

$chien->communiquer() . "<hr>";
$chien->seDeplacer() . "<hr>";


$chat = new Chat("Neko");

$chat->communiquer() . "<hr>";
$chat->seDeplacer() . "<hr>";


