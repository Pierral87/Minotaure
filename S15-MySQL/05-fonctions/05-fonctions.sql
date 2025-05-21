------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- FONCTIONS PREDEFINIES -----------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Documentation pour voir toutes les fonctions MySQL : https://sql.sh/ 

USE bibliotheque;

SELECT DATABASE(); -- Indiquant la base actuellement utilisée

INSERT INTO livre (auteur, titre) VALUES ("Harry Potter", "JK Rowling");
SELECT LAST_INSERT_ID(); -- Le dernier id inséré auto incrémenté dans la BDD (de la session en cours!!!) 
                            -- Instruction utile lorsqu'après une insertion on souhaite récupérer immédiatement la primary key qui vient de s'incrémenter, pour par la suite lancer un traitement spécifique (une redirection avec la key dans le GET par exemple)


SELECT CONCAT("a", "b", "c"); -- Permet de concaténer des informations
SELECT CONCAT_WS(" - ", "a", "b", "c"); -- Permet de concaténer avec un séparateur

SELECT CONCAT_WS(" ", id_abonne, prenom) AS liste FROM abonne;

SELECT SUBSTRING("bonjour", 4);
SELECT LOCATE("j", "bonjour");
SELECT REPLACE("www.bonjour.com", "w", "W");
SELECT UPPER("Coucou");

SELECT TRIM("        Pierral    ") as trim;

SELECT DATE_ADD(CURDATE(), INTERVAL 7 DAY);
SELECT DATE_ADD(CURDATE(), INTERVAL 1 MONTH);
SELECT DATE_ADD("2025-05-02", INTERVAL 1 YEAR);

SELECT DATE_ADD(date_sortie, INTERVAL 1 MONTH) FROM emprunt;

SELECT CURDATE(); -- La date du jour
SELECT CURTIME(); -- l'heure de l'instant
SELECT NOW(); -- La date du jour et l'heure de l'instant

SELECT CURDATE() + 0; 

-- DATE_FORMAT(date, format) pour choisir le format de date à afficher 

SELECT DATE_FORMAT(NOW(), "%d/%m/%Y");
+--------------------------------+
| DATE_FORMAT(NOW(), "%d/%m/%Y") |
+--------------------------------+
| 21/05/2025                     |
+--------------------------------+



------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- FONCTIONS UTILISATEURS ----------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Fonctions écrites et exécutées par le développeur pour un traitement spécifique
-- Cela fonction de la même manière que tout autre langage de programmation, la fonction a un comportement défini, elle a des params d'entrées (ou pas), et un ou plusieurs params de sortie

DELIMITER $ -- On change le delimiter (c'est à dire on modifie le ";" par le $) car nous allons devoir écrire des ";" dans le corps de notre fonction, si on le laisse comme delimiter par défaut, on ne va pas pouvoir créer notre fonction (cela mettra fin à l'instruction en cours)

-- On reçoit un argument INT et on précise que la fonction renverra du texte
CREATE FUNCTION calcul_tva(nb INT) RETURNS TEXT 
COMMENT "FOnction permettant le calcul de la TVA"
BEGIN 
    RETURN CONCAT_WS(": ", "Le resultat est ", (nb*1.20));
END $
DELIMITER ;
SELECT calcul_tva(100);

-- EXERCICE 1 : Le même calcul de TVA avec le choix du taux
DELIMITER $ 
CREATE FUNCTION calcul_tva_taux(nb INT, taux FLOAT) RETURNS TEXT 
COMMENT "FOnction permettant le calcul de la TVA"
BEGIN 
    RETURN CONCAT_WS(": ", "Le resultat est ", (nb*(1+(taux/100))));
END $

SELECT calcul_tva_taux(100,5);

-- EXERCICE 2 : Faire une fonction qui me retourne le nombre d'employés pour un service envoyé en param de la fonction 
-- DECLARE est autorisé entre un BEGIN et END pour déclarer une variable locale
DELIMITER $ 
CREATE FUNCTION nombre_employes(service_recu VARCHAR(255)) RETURNS INT
COMMENT "Fonction qui retourne le nombre d'employés dans le service transmit en param"
BEGIN
DECLARE resultat INT; 
SELECT COUNT(*) FROM employes WHERE service = service_recu INTO resultat;
RETURN resultat;
END $ 
DELIMITER ;
SELECT nombre_employes("informatique");
SELECT nombre_employes("direction");
SELECT nombre_employes("commercial");



------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- PROCEDURES STOCKEES -------------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Une procédure est similaire à une fonction
-- En MySQL la différence réside dans le fait qu'une fonction retourne une simple valeur typée (INT, VARCHAR, autre) via return alors que la procédure me retourne un jeu de résultat d'une requête
-- On s'en sert essentiellement pour encapsuler la complexité d'une requête (par exemple, une jointure compliquée)

-- Les avantages d'une procédure stockée 
    -- Moins de risque de se tromper : Plus facile de lancer une procédure déjà définie par exemple register_user, selectAll(), plutôt que d'à chaque fois réécrite une requête à la main 
    -- Meilleure compréhension : Il est plus facile de comprendre le nom d'une procédure (en rapport avec son action), que de lire une requête entière
    -- Facilité d'utilisation : Si d'autres personnes manipulent la BDD, même sans connaissances avancées du SQL ou du projet, ils pourront comprendre facilement l'objectif de la procédure
    -- Evolutivité : Si la requête est amené à changer, elle ne sera modifié qu'à un seul endroit, dans notre BDD et non pas à tous les endroits du code de notre app (site web, appli mobile, soft local) 
    -- Sécurité : On laisse le travail à une seule personne en charge de la BDD
    -- Optimisation : La procédure se lance plus rapidement qu'une requête à la main car elle est "préchargée" dans le serveur

USE entreprise; 

-- Une procédure qui sélectionne tous les employés 
DELIMITER $
CREATE PROCEDURE selectAllEmployes()
BEGIN 
    SELECT * FROM employes; 
END $ 
DELIMITER ; 

CALL selectAllEmployes();

-- Exercice 1 : Faire une procédure qui prends en param le prenom d'un employé et qui affiche le service et le salaire de cet employé
-- Exercice 2 : Faire une procédure qui va modifier le salaire d'un employé, premier param le prenom de l'employé et second param le nouveau salaire
-- Exercice 3 : Retour sur la table bibliothèque, faire une procédure qui englobe la jointure d'affichage de tous les emprunts de la bdd, on veut un affichage prenom, titre, auteur, date_sortie, date_rendu

