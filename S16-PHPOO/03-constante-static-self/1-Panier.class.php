<?php

// Ici, on voit de nouvelles notions 
    // Les éléments qui appartiennent aux classes et pas aux objets, tout ce qui est static et const
    // On voit également la nouvelle syntaxe Class::$prop ou Class:method()
    // Puis le self:: qui correspond à son équivalent $this-> dans le contexte objet


class Panier {

    // Ici lorsque je défini une prop comme étant static alors elle appartient uniquement à la classe et pas à ses instances (pas à ses objets)
    public static $prixTotal = 0;
    // Idem pour une constante, ici déclarée avec const, on appelle ça une constante de classe, forcément static ! Par défaut public
    // Depuis une version récente de PHP on peut déclarer des constantes protected et private si on le souhaite
    const TVA = 20;
    public $nomPanier = "Mon Panier";

    // Pour une méthode static, pas de différence, comme les props, on va appeler ça avec Class::method()
    public static function afficherTotal() {
        // Tout comme nous possédons $this dans le contexte objet (référence à l'objet courant/en train d'être utilisé), on a l'équivalent dans le contexte static, "à l'intérieur de toi même/la classe elle même"
        return "Total avec TVA : " . self::$prixTotal * (1 + (self::TVA /100 )) . "€<hr>";
    }

    public function ajouterPrix($prix) {
        self::$prixTotal += $prix;
    }
}


// echo $prixTotal; // Undefined variable prixTotal tant que je n'ai pas instancié si la prop $prixTotal est une prop "normale" c'est à dire appartenant à l'objet

// J'aurai accès à la prop normale seulement après l'instanciation
// Par contre, si la prop est considérée "static" alors, elle n'appartient plus à l'objet mais elle appartient à la classe !
$panier = new Panier;
// $panier->prixTotal;
// Je ne vois plus rien ici dans le var_dump, la prop $prixTotal ne s'affiche pas ! 
var_dump($panier);

// Pour manipuler une prop ou une méthode statique, nouvelle syntaxe "::" 
// On nomme le nom de la classe à laquelle appartient la prop, suivi de "::" ainsi que le nom de la prop ATTENTION, il faut spécifier le "$" devant le nom de la prop
Panier::$prixTotal = 100;
echo "Prix total du panier : " . Panier::$prixTotal . "<hr>"; 
echo "TVA du panier : " . Panier::TVA . "<hr>"; 

echo Panier::afficherTotal();

$panier->ajouterPrix(150);

echo Panier::afficherTotal();




// Tests de syntaxe en PHP entre static et non static 

echo $panier->nomPanier; // Ok normal, sur un objet, j'appelle une prop de l'objet 
$panier->ajouterPrix(1500); // Ok normal, sur un objet j'appelle une méthode de l'objet 
// $panier->TVA;  Erreur, je ne peux pas appeler une constante dans une contexte objet (non static)



// Etrangement... Les syntaxes ci dessous fonctionnent... Cela est dû à la flexibilité et la souplesse du langage PHP et au fait qu'il soit permissif sur de nombreuses instructions
// ATTENTION, on utilisera jamais ces syntaxes là, elles seront par ailleurs non autorisées dans d'autres langages de programmation OO, donc, il faut s'habituer à travailler proprement en respectant les contextes de manipulation des éléments selon leur nature
echo $panier::TVA;
echo $panier::$prixTotal;
echo $panier->afficherTotal();
echo $panier::afficherTotal();


