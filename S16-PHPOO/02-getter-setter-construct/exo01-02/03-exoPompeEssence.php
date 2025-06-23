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