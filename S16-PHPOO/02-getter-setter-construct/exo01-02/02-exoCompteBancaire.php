<?php

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/

class CompteBancaire
{
    protected $titulaire;
    protected $solde;

    public function __construct($titulaire, $solde)
    {
        $this->setTitulaire($titulaire);
        $this->setSolde($solde);
    }

    public function getTitulaire()
    {
        return $this->titulaire;
    }

    public function setTitulaire($titulaire)
    {
        $titulaire = trim($titulaire);
        try {
            if (iconv_strlen($titulaire) >= 3) {
                $this->titulaire = $titulaire;
            } else {
                throw new Exception("Le titulaire doit contenir au moins 3 caractères");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSolde()
    {
        return $this->solde;
    }

    public function setSolde($solde)
    {
        try {
            if (!is_numeric($solde)) {
                throw new Exception("Le solde doit être un nombre.");
            }

            if ($solde < -200) {
                // je laisse 200e de découvert je suis quelqu'un de cool
                throw new Exception("Le solde ne peut pas être en dessous de 200e faut remplir le compte BG.");
            }

            $this->solde = floatval($solde);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function afficherSolde()
    {
        echo "Le solde du compte de " . $this->getTitulaire() . " est de " . $this->getSolde() . " euros </br>";
    }

    public function retirer($montant)
    {
        try {
            if ($montant > 0) {
                $newSolde = $this->getSolde() - $montant;
                $this->setSolde($newSolde);
            } else {
                throw new Exception("Le montant doit être positif");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deposer($montant)
    {
        try {
            if ($montant > 0) {
                $newSolde = $this->getSolde() + $montant;
                $this->setSolde($newSolde);
            } else {
                throw new Exception("Le montant doit être positif");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

//test
$test = new CompteBancaire("John Doe", 1000);

//get
print 'titulaire : ' . $test->getTitulaire() . '<br>';

//set
$test->setTitulaire("Nathan Test");
print 'titulaire : ' . $test->getTitulaire() . '<br>';

//get solde
print 'solde : ' . $test->getSolde() . '<br>';

//setsolde
$test->setSolde(2000);
print 'solde : ' . $test->getSolde() . '<br>';

//afficher solde
$test->afficherSolde();

//retirer
$test->retirer(500);
print 'solde : ' . $test->getSolde() . '<br>';

//deposer
$test->deposer(1000);
print 'solde : ' . $test->getSolde() . '<br>';

//set a 0
$test->setSolde(0);

//retirer 201
$test->retirer(201);
// $test->afficherSolde();

