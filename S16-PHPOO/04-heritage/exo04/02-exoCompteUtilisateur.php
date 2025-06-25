<?php 

/*

Exercice : Héritage et surcharge (gestion des comptes utilisateurs)

Objectif : Créer une classe de base CompteUtilisateur qui gère les informations générales d'un utilisateur. Ensuite, créer une classe dérivée ComptePremium qui hérite de CompteUtilisateur et qui ajoute des fonctionnalités spécifiques aux comptes premium.

Énoncé :

    Crée une classe CompteUtilisateur avec les propriétés protégées $nom et $email, ainsi qu'une méthode afficherInfos() qui affiche les informations de l'utilisateur.
    Crée une classe ComptePremium qui hérite de CompteUtilisateur et surcharge la méthode afficherInfos() pour ajouter "Compte Premium" dans les informations affichées.

    */

class CompteUtilisateur {
    protected $nom;
    protected $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function afficherInfos() {
        echo "Nom : {$this->nom}<br>";
        echo "Email : {$this->email}<br>";
    }
}

class ComptePremium extends CompteUtilisateur {
    public function afficherInfos() {
        parent::afficherInfos();
        echo "Type de compte : Compte Premium<br>";
    }
}

$user = new CompteUtilisateur("Pierro", "lolo@mail.com");

$user->afficherInfos();

$premium = new ComptePremium("Alex", "lex@mail.com");
$premium->afficherInfos();