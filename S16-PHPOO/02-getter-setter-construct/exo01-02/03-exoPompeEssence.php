<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
            - Le réservoir d'un véhicule contient maximum 50 litres (on décide de ne pas permettre aux voitures d'avoir des tailles de réservoir différents)
            - La méthode donnerEssence() distribue automatiquement le plein à la voiture (On ne laisse pas la possibilité de choisir le nombre de litres que la personne veut, si c'est possible on met forcément le plein entier)
            - Gérez les exceptions qui peuvent être rencontrées à l'appel de la méthode donnerEssence()

 */

class Vehicule
{
    private $litresReservoir;
    public function __construct($litresReservoir = 0)
    {
        $this->setLitresReservoir($litresReservoir);
    }
    public function getLitresReservoir()
    {
        return $this->litresReservoir;
    }
    public function setLitresReservoir($litresReservoir)
    {
        if (is_numeric($litresReservoir) && $litresReservoir >= 0 && $litresReservoir <= 50) {
            $this->litresReservoir = $litresReservoir;
        } else {
            trigger_error("Le réservoir doit contenir entre 0 et 50 litres", E_USER_NOTICE);
        }
    }
}

class Pompe
{
    private $litrestock;

    public function __construct($litrestock = 100)
    {
        $this->setLitreStock($litrestock);
    }

    public function getLitreStock()
    {
        return $this->litrestock;
    }

    public function setLitreStock($litrestock)
    {
        if (is_numeric($litrestock) && $litrestock >= 0) {
            $this->litrestock = $litrestock;
        } else {
            trigger_error("Le stock de la pompe doit être positif", E_USER_NOTICE);
        }
    }

    public function donnerEssence(Vehicule $vehicule)
    {
        $litresManquants = 50 - $vehicule->getLitresReservoir();
        $litresVoiture = $vehicule->getLitresReservoir();
        $litresPompe = $this->getLitreStock();

        // Scénar 1 : La voiture n'a pas besoin d'essence elle a déjà le plein
        if ($litresManquants <= 0) {
            trigger_error("Le véhicule est déjà plein.", E_USER_NOTICE);
            return;
        }
        // Scénar 2 : La pompe est vide ! Impossible de donner de l'essence
        if ($litresPompe === 0) {
            trigger_error("Le stock de la pompe est vide.", E_USER_NOTICE);
            return;
        }
        // Scénar 3 : La pompe a assez pour faire le plein ! Je donne le plein à la voiture et je soustrait à la pompe les litresManquants
        if ($litresPompe >= $litresManquants) {
            $vehicule->setLitresReservoir(50);
            $this->setLitreStock($litresPompe - $litresManquants);
        }

        // Scénar 4 : La pompe a de l'essence, mais pas assez pour faire le plein ! Je donne quand même à la voiture ce que je peux.
        else {
            // trigger_error( "Le stock de la pompe est insuffisant pour faire le plein du véhicule." , E_USER_NOTICE);
            $vehicule->setLitresReservoir($litresVoiture + $litresPompe);
            $this->setLitreStock(0);
        }
    }
}

$voiture = new Vehicule(30);
$pompe = new Pompe(20);

$pompe->donnerEssence($voiture);
var_dump($voiture);
var_dump($pompe);
