<?php 

/* 

Exercice 2 : Gestion de Panier avec static et const

Objectif : Créer un système simple de gestion de panier avec une classe Panier qui utilise des propriétés et méthodes statiques pour gérer le nombre total de produits et des constantes pour définir des paramètres spécifiques au panier.

Énoncé :

    Créez une classe Panier qui contiendra :
        Une constante MAX_ITEMS qui définira le nombre maximum d'articles dans le panier.
        Une propriété statique $totalItems qui contiendra le nombre total d'articles.
        Une méthode statique ajouterProduit($quantite) qui permet d'ajouter un produit au panier (en respectant la limite définie par MAX_ITEMS).
        Une méthode statique afficherTotal() qui affiche le nombre total d'articles dans le panier.

        */

class Panier {
    const MAX_ITEMS = 100;
    public static $totalItems = 0;

    public static function ajouterProduit($quantite) {
        if (self::$totalItems + $quantite <= self::MAX_ITEMS) {
            self::$totalItems += $quantite;
        } 
    }

    public static function afficherTotal() {
        echo "Total d'articles : " . self::$totalItems;
    }
}


Panier::ajouterProduit(4);
Panier::afficherTotal();