---------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------
---------- LES EVENEMENTS -------------------------------------------------------------
---------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------

-- Un évènement permet de programmer des actions sur notre bdd, par rapport à une notion de temps 
-- Gérer une insertion à une date spécifique
-- Gérer des copies de tables chaque jour à une heure spécifique
-- Gérer des insertions automatiques chaque minute 

-- Il se peut que sur votre serveur les évènements soient désactivés
SHOW GLOBAL VARIABLES LIKE 'event_scheduler'; -- On peut voir ici si les évènements sont sur ON ou OFF
SET GLOBAL event_scheduler = 1; -- Permet de passer sur ON nos évènements 


USE entreprise;
-- Syntaxe de création d'un évènement 
CREATE EVENT insert_employes 
ON SCHEDULE EVERY 1 MINUTE 
DO INSERT INTO employes (prenom) VALUES ("Pierra");
-- Cet évent au dessus gère une insertion dans la table employes, chaque minute 


-- Cet évènement est de type "one time", c'est une seule insertion unique à l'heure de maintenant + 2 minutes 
CREATE EVENT insert2 
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 2 MINUTE 
DO INSERT INTO employes (prenom) VALUES ("Boby");

-- Via les évènements on peut aussi lancer des procédures stockées 


-- On peut aussi faire des évènements recurring (qui se répète) en spécifiant une date de départ (pas forcément tout de suite)
CREATE EVENT insert_employes3 
ON SCHEDULE EVERY 1 MINUTE STARTS "2024-12-18 15:27:00"
DO INSERT INTO employes (prenom) VALUES ("Polo");

-- On peut aussi définir une date de fin d'un évènement recurring 

CREATE EVENT insert_employes4
ON SCHEDULE EVERY 1 MINUTE
ENDS CURRENT_TIMESTAMP + INTERVAL 5 MINUTE
DO INSERT INTO employes (prenom) VALUES ("Willy");


CREATE TABLE IF NOT EXISTS journal (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

INSERT INTO journal (titre, texte) VALUES ("Bientot Noel", "Les enfants vont recevoir plein de cadeaux ! ");

CREATE TABLE IF NOT EXISTS journal_copie (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DELIMITER $
CREATE EVENT backup_journal
    ON SCHEDULE EVERY 1 MINUTE 
        DO 
            BEGIN 
            DELETE FROM journal_copie;

            INSERT INTO journal_copie SELECT * FROM journal; 
            END 
        $


 ----- EXERCICES --------------------

-- 	 Exercice 1 : Notification pour les emprunts en retard

-- Créez un événement qui :

--     Exécute tous les jours à minuit.
--     Inscrit dans une table emprunts_en_retard (à créer) les abonnés qui ont des emprunts dont la date_rendu est NULL et dont la date_sortie dépasse 30 jours.
	CREATE TABLE emprunts_en_retard (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_abonne INT NOT NULL,
  id_livre INT NOT NULL,
  date_sortie DATE NOT NULL
) ENGINE=InnoDB;

DELIMITER $
--  STARTS "2024-12-20 00:00:00"
CREATE EVENT IF NOT EXISTS check_emprunt_retard 
ON SCHEDULE EVERY 1 DAY
DO 
  BEGIN 
    INSERT INTO emprunts_en_retard (id_abonne, id_livre, date_sortie)  
      SELECT e.id_abonne, e.id_livre, e.date_sortie  
        FROM emprunt e
        WHERE e.date_rendu IS NULL AND e.date_sortie < DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        AND NOT EXISTS(
        SELECT 1
        FROM emprunts_en_retard  er
        WHERE er.id_abonne = e.id_abonne
        AND er.id_livre = e.id_livre
        AND er.date_sortie = e.date_sortie
    );
  END $



-- Exercice 2 : Archivage des emprunts terminés

--     Créez une table historique_emprunts pour stocker les emprunts dont la date_rendu est renseignée.
--     Créez un événement qui exécute tous les mois pour déplacer les emprunts terminés dans cette table.
CREATE TABLE historique_emprunts (
  id_emprunt INT NOT NULL,
  id_livre INT NOT NULL,
  id_abonne INT NOT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE NOT NULL,
  PRIMARY KEY (id_emprunt)
) ENGINE=InnoDB;

-- STARTS CURDATE() + INTERVAL 1 MONTH
DELIMITER $
CREATE EVENT IF NOT EXISTS archiver_emprunt 
ON SCHEDULE EVERY 1 MONTH 
DO 
  BEGIN 
    INSERT INTO historique_emprunts (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) 
      SELECT e.id_emprunt, e.id_livre, e.id_abonne, e.date_sortie, e.date_rendu 
        FROM emprunt e
        WHERE date_rendu IS NOT NULL;
        DELETE FROM emprunt WHERE date_rendu IS NOT NULL;
  END $


-- Exercice 3 : Comptage des emprunts mensuels

--     Créez une table stats_emprunts pour stocker les statistiques mensuelles (mois, année, nombre d’emprunts).
--     Créez un événement qui s’exécute chaque début de mois pour calculer le nombre d’emprunts effectués le mois précédent.
CREATE TABLE stats_emprunts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mois INT NOT NULL,
  annee INT NOT NULL,
  total_emprunts INT NOT NULL
) ENGINE=InnoDB;

-- STARTS '2024-12-01 00:00:00'
CREATE EVENT calculer_stats_mensuelles
ON SCHEDULE EVERY 1 MONTH 
DO
  BEGIN 
INSERT INTO stats_emprunts (mois, annee, total_emprunts)
SELECT MONTH(date_sortie), YEAR(date_sortie), COUNT(*)
FROM emprunt
WHERE date_sortie BETWEEN DATE_SUB(CURDATE(), INTERVAL 12 YEAR) AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
GROUP BY MONTH(date_sortie), YEAR(date_sortie);
  END $

-- Exercice 4 : Notification d’emprunts par auteur

--     Créez un événement qui exécute tous les jours pour insérer dans une table statistiques_auteurs les statistiques des emprunts par auteur pour les livres empruntés la veille.
CREATE TABLE statistiques_auteurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  auteur VARCHAR(25),
  total_emprunts INT,
  date_stat DATE
) ENGINE=InnoDB;

-- STARTS '2024-11-14 00:00:00'
CREATE EVENT calculer_stats_auteurs
ON SCHEDULE EVERY 1 DAY 
DO
INSERT INTO statistiques_auteurs (auteur, total_emprunts, date_stat)
SELECT l.auteur, COUNT(e.id_emprunt), CURDATE() - INTERVAL 1 DAY
FROM livre l
JOIN emprunt e ON l.id_livre = e.id_livre
WHERE e.date_sortie = CURDATE() - INTERVAL 1 DAY
GROUP BY l.auteur;