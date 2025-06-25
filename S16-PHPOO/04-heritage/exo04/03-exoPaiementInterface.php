<?php 

/* 

Exercice : Gérer une simulation d'un mode de paiement via des classes, traits et interfaces


Énoncé :

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utilise un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter.
    Dans une des classes (par exemple PaiementCarte), empêcher la surcharge d'une méthode en la marquant comme final.

    */

interface PaiementInterface {
    public function executerPaiement();
}

trait ValidationPaiement {
    public function valider() {
        return true;
    }
}

abstract class Paiement implements PaiementInterface {
    use ValidationPaiement;

    protected $montant;

    public function __construct($montant) {
        $this->montant = $montant;
    }

    abstract protected function traiterPaiement();

    public function executerPaiement() {
        if ($this->valider()) {
            return $this->traiterPaiement();
        } else {
            return "Validation du paiement échouée.";
        }
    }
}

class PaiementCarte extends Paiement {
    private $numeroCarte;

    public function __construct($montant, $numeroCarte) {
        parent::__construct($montant);
        $this->numeroCarte = $numeroCarte;
    }

    final protected function traiterPaiement() {
        return "Paiement de {$this->montant}€ effectué par carte (n° {$this->numeroCarte}).";
    }
}

class PaiementVirement extends Paiement {
    private $iban;

    public function __construct($montant, $iban) {
        parent::__construct($montant);
        $this->iban = $iban;
    }

    protected function traiterPaiement() {
        return "Paiement de {$this->montant}€ effectué par virement (IBAN {$this->iban}).";
    }
}