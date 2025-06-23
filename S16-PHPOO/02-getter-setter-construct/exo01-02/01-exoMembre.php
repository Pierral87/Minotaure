<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters et gérer les cas d'erreurs d'une façon ou d'une autre 
   
 ************************** */

class Membre
{
    protected $pseudo;
    protected $email;

    public function __construct($pseudo, $email)
    {
        $this->setPseudo($pseudo);
        $this->setEmail($email);
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo(string $newPseudo)
    {
        if (!empty($newPseudo)) {
            $this->pseudo = $newPseudo;
        } else {
            trigger_error("Le pseudo ne peut pas être vide", E_USER_NOTICE);
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $newEmail)
    {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $this->email = $newEmail;
        } else {
            trigger_error("L'email n'est pas du bon format", E_USER_NOTICE);
        }
    }
}

$membre = new Membre("Pseudoname", "email@gmail.com");
$membre2 = new Membre("Pseudoname", "email.com");

var_dump($membre);
var_dump($membre2);
