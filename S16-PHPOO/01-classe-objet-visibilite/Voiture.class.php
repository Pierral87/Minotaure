<?php


// Déclaration d'une classe
// Une classe en PHP est un modèle qui définit des propriétés et des méthodes qui seront partagées par les objets créés à partir de cette classe.
class Voiture
{
    // Propriétés (et non pas des variables)
    public $marque;
    public $couleur;
    protected $km = 0;
    private $nbPortes;

    public function ajoutKm($nbr) {

        $this->km += $nbr;
    }

    // Méthodes (et non pas des fonctions)
    public function demarrer()
    {
        return "La voiture démarre.<hr>";
    }

}


// Instanciation d'une classe 
// Pour utiliser une classe, on doit créer un objet à partir de celle-ci. C'est ce qu'on appelle l'instanciation

// Instanciation de la classe Voiture 
$voiture1 = new Voiture();

// Le var_dump ne me retourne que les propriétés 
var_dump($voiture1);

// Pour voir les méthodes on utilise get_class_methods
var_dump(get_class_methods($voiture1));

// Assignation de valeurs aux propriétés
$voiture1->marque = "Toyota";
$voiture1->couleur = "Rouge";
var_dump($voiture1);

$voiture2 = new Voiture();

$voiture2->marque = "Peugeot";
$voiture2->couleur = "Bleue";
var_dump($voiture2);


// J'appelle ici ma méthode démarrer
echo $voiture1->demarrer();

// $voiture1->km = 150; // Fatal error, je ne peux pas accéder à une prop protected depuis l'espace global
// $voiture1->nbPortes = 5; // Fatal error, je ne peux pas accéder à une prop private depuis l'espace global

// L'accès à ces données est limité à l'espace local de ma classe ! 
// Pour manipuler un prop protected ou private, je dois créer une méthode qui me permet d'intéragir sur la donnée

$voiture1->ajoutKm(100);
var_dump($voiture1);

// Il existe 3 niveaux de visibilité : 
    // Public : Les propriétés/méthodes publiques sont accessibles depuis n'importe où, scope global et scope local de la classe 
    // Protected : Les propriétés/méthodes protected sont accessibles uniquement depuis l'espace local de la classe ET seront aussi récupérées dans les sous classes par l'héritage
    // Private : Les propriétés/méthodes private sont accessibles uniquement depuis l'espace local de la classe ET NE SONT PAS transmises à l'héritage

    // On va considérer que dans la majorité des cas, nos propriétés sont d'un niveau de visibilité protected ou private, car on veut pouvoir toujours contrôler les informations qui sont envoyées à ces propriétés et éventuellement de créer des logs
    // A contrario, les méthodes seront plutôt de visibilité public (en majorité) car justement les méthodes que l'on développe on s'attend à les appeler depuis notre espace global
    // Si une méthode est protected ou private on la comprends plutôt comme étant une portion de code rattachée à une autre méthode, elle, public
