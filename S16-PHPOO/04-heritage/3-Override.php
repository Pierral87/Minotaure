<?php

/* 

    Override (surcharge)

    La surcharge ou override permet à une classe enfant de réécrire une méthode héritée de la classe parente afin de modifier son comportement 

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

class Oiseau extends Animal
{
    // Ici je redéfinit la méthode seDeplacer, je fais un override, cette méthode remplace donc celle héritée
    public function seDeplacer()
    { // On pense ici qu'il est nécessaire de remplacer la méthode seDeplacer par un autre comportement, donc l'override est judicieux
        echo "$this->nom vole dans les airs";
        // Je pourrais si je le souhaite, récupérer la méthode parent en utilisant le code parent::seDeplacer(), un peu comme la syntaxe self:: mais là on ne parle pas d'élément static, cela nous permet juste de réatteindre la classe parente
    }
}

$oiseau = new Oiseau("Yuzo");
$oiseau->seDeplacer();
