CREATE DATABASE bibliotheque;
USE bibliotheque;

CREATE TABLE abonne (
  id_abonne INT NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(25) NOT NULL,
  PRIMARY KEY (id_abonne)
) ENGINE=InnoDB ;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');


CREATE TABLE livre (
  id_livre INT NOT NULL AUTO_INCREMENT,
  auteur VARCHAR(25) NOT NULL,
  titre VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_livre)
) ENGINE=InnoDB ;

INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');

CREATE TABLE emprunt (
  id_emprunt INT NOT NULL AUTO_INCREMENT,
  id_livre INT DEFAULT NULL,
  id_abonne INT DEFAULT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE DEFAULT NULL,
  PRIMARY KEY  (id_emprunt)
) ENGINE=InnoDB ;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2016-12-07', '2016-12-11'),
(2, 101, 2, '2016-12-07', '2016-12-18'),
(3, 100, 3, '2016-12-11', '2016-12-19'),
(4, 103, 4, '2016-12-12', '2016-12-22'),
(5, 104, 1, '2016-12-15', '2016-12-30'),
(6, 105, 2, '2017-01-02', '2017-01-15'),
(7, 105, 3, '2017-02-15', NULL),
(8, 100, 2, '2017-02-20', NULL);

-- QUels sont les id_livre des livres qui n'ont pas été rendu à la bibliothèque ? 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+
-- Attention, la valeur NULL se teste avec IS ou IS NOT 

-- Pour avoir les titres de ces livres, je dois réussir à aller piocher l'information dans la table livre (alors que l'information "non rendu" se trouve dans la table emprunt)
-- 2 possibilités :
    -- Requête imbriquée
    -- Jointure


----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------
----------- REQUETES IMBRIQUEES (sur plusieurs tables) ---------------------------------
----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------
-- Quels sont les titres des livres qui n'ont pas été rendu à la bibliothèque ?

-- Quel est le titre du livre id 105 ?
SELECT titre FROM livre WHERE id_livre = 105;

-- Quels sont les titres des livres id 105 et 100 ?
SELECT titre FROM livre WHERE id_livre IN (105,100);

-- Quelle est la requête qui me permet de récupérer les id 105 et 100 ?
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;

-- Donc, la requête imbriquée serait ? 
-- Quels sont les titres des livres qui n'ont pas été rendu à la bibliothèque ?
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
-- Les requêtes imbriquées s'executent, si on voulait l'imaginer de façon logique, par la fin : J'ai besoin du résultat de la requête de second niveau pour mener à bien la requête de premier niveau 
-- Il me faut forcément un champ commun ! Ici la primary key de livre (id_livre) grâce a sa relation avec emprunt, existe en tant que foreign key dans la table emprunt, ce qui me permet de chercher une condition dans la table emprunt, tout en affichant une information venant de la table livre
-- Dans ce cas précis, je suis obligé d'utiliser IN car la sous requête me renvoie plus d'un résultat, un "=" ne fonctionnera pas 

-- EXERCICE 1 : Quels sont les prénoms des abonnés n'ayant pas rendu un livre à la bibliotheque.

-- En jointure (pour plus tard)
-- SELECT DISTINCT a.prenom FROM abonne a
-- JOIN emprunt e ON a.id_abonne = e.id_abonne 
-- WHERE e.date_rendu IS NULL;
SELECT prenom FROM abonne WHERE id_abonne IN 
     (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);
+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+

-- EXERCICE 2 : Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
SELECT id_livre FROM emprunt WHERE id_abonne = 
    (SELECT id_abonne FROM abonne WHERE prenom = "Chloe");
+----------+
| id_livre |
+----------+
|      100 |
|      105 |
+----------+

-- EXERCICE 3 : Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE date_sortie = "2016-12-07");
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+
-- EXERCICE 4 : combien de livre Guillaume a emprunté à la bibliotheque ?
SELECT COUNT(*) FROM emprunt WHERE id_abonne = 
    (SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
+----------+
| COUNT(*) |
+----------+
|        2 |
+----------+
-- EXERCICE 5 : Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE id_livre IN 
        (SELECT id_livre FROM livre WHERE auteur = "alphonse daudet"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+
-- EXERCICE 6 : Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne = 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
-- EXERCICE 7 : Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre NOT IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne = 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-----------------+
| titre           |
+-----------------+
| Bel-Ami         |
| Le pere Goriot  |
| Le Petit chose  |
| La Reine Margot |
+-----------------+
-- EXERCICE 8 : Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne = 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));

-- EXERCICE 9 : Qui a emprunté le plus de livre à la bibliotheque ?
SELECT prenom FROM abonne WHERE id_abonne = 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1);
+--------+
| prenom |
+--------+
| Benoit |
+--------+

-- Ici c'est l'affichage de chaque id abonné et de son nombre d'emprunts
SELECT id_abonne, COUNT(*) as nombre_emprunt FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC;

-- Si jamais plusieurs abonnés avaient le même nombre d'emprunt et que l'on souhaite tous les afficher (et pas seulement 1 à cause du LIMIT 1)
-- (On a rajouté un emprunt à l'abonné 1 pour faire le test)
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
        (SELECT MAX(nbr_emprunt) FROM (SELECT COUNT(*) AS nbr_emprunt FROM emprunt GROUP BY id_abonne) AS compte));
        -- Ici il y a une création d'une table temporaire (sans la nommer) pour récupérer la valeur "nbr_emprunt" par id_abonne, on récupère la valeur MAX() de ce nombre d'emprunt qui nous permet de mener à bien nos autres requêtes (celles avec le HAVING COUNT(*) = MAX(nbr_emprunt))
        -- Grâce à ce procédé on est capable de sortir plusieurs prenoms contrairement à la solution initiale
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+

----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------
----------- REQUETES EN JOINTURE -------------------------------------------------------
----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------

-- Une jointure est toujours possible 
-- Une imbriquée est possible uniquement si les champs que l'on récupère proviennent d'une seule table 

-- Avec des requêtes imbriquées, on parcourt les tables les unes après les autres en transitant par le "champ commun"
-- Avec des requêtes en jointure, on peut mélanger les champs de sorties, les appels de tables, les conditions sans que cela pose problème 

-- Nous aimerions connaître les dates de sorties et les dates de rendu pour l'abonne Guillaume 
-- En imbriquée, non faisable car Guillaume est une info présente sur la table abonne et les dates sont présentes sur la table emprunt, je ne peux pas les afficher simultanément

-- Ci dessous abonne.prenom, j'utilise le prefixe de table abonne. pour faire comprendre au système que je parle du champ prénom de la table abonne, ce qui peut éviter des ambiguités
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu  -- Ce que je veux afficher, de plusieurs tables différentes
FROM emprunt, abonne                                           -- Les tables dont j'ai besoin dans ma requêt 
WHERE prenom = "Guillaume"                                     -- Une condition
AND abonne.id_abonne = emprunt.id_abonne;                      -- La création de la jointure, je spécifie au système le champ commun entre les deux tables

-- On peut indiquer des alias de table pour raccourci d'écriture pour les prefixes de tables 
-- Ci dessous on défini un prefixe e pour emprunt et a pour abonne 
SELECT a.prenom, e.date_sortie, e.date_rendu  
FROM emprunt e, abonne a                                          
WHERE prenom = "Guillaume"                                     
AND a.id_abonne = e.id_abonne;   

-- Autres syntaxes pour les jointures
-- En utilisant INNER JOIN ou JOIN 
-- Avec cette méthode on joint les tables une par une 

-- INNER JOIN ou JOIN aucune différences, ce sont des jointures "interne"
SELECT a.prenom, e.date_sortie, e.date_rendu  
FROM abonne a 
INNER JOIN emprunt e ON e.id_abonne = a.id_abonne  -- Ici la syntaxe ON  un_id = un_id_autretable est utilisée si jamais les champs communs ne sont pas nommés exactement de la même manière
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu  
FROM abonne a 
INNER JOIN emprunt e USING (id_abonne) -- Dans notre base, les id pk et fk s'appellent exactement de la même manière, donc je peux utiliser USING plutôt que ON 
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu  
FROM abonne a 
JOIN emprunt e USING (id_abonne)
WHERE a.prenom = "Guillaume";

-- EXERCICE 1 : Nous aimerions connaitre les dates de sortie et les dates de rendu pour les livres écrit par Alphonse Daudet
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM abonne a 
JOIN emprunt e ON e.id_abonne = a.id_abonne 
JOIN livre l ON l.id_livre = e.id_livre 
WHERE l.auteur = "alphonse daudet";
+--------+-------------+------------+
| prenom | date_sortie | date_rendu |
+--------+-------------+------------+
| Laura  | 2016-12-12  | 2016-12-22 |
+--------+-------------+------------+
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016 
SELECT a.prenom 
FROM emprunt e 
JOIN livre l ON e.id_livre = l.id_livre 
JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE l.titre = "une vie"
AND YEAR(e.date_sortie) = 2016;
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Chloe     |
+-----------+
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
SELECT a.prenom, COUNT(*) as nbr_emprunt 
FROM abonne a, emprunt e 
WHERE a.id_abonne = e.id_abonne 
GROUP BY a.id_abonne;
+-----------+-------------+
| prenom    | nbr_emprunt |
+-----------+-------------+
| Guillaume |           3 |
| Benoit    |           3 |
| Chloe     |           2 |
| Laura     |           1 |
+-----------+-------------+
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné
SELECT a.prenom, COUNT(*) as nbr_emprunt_a_rendre 
FROM abonne a 
JOIN emprunt e ON e.id_abonne = a.id_abonne 
WHERE e.date_rendu IS NULL 
GROUP BY a.prenom;
+-----------+----------------------+
| prenom    | nbr_emprunt_a_rendre |
+-----------+----------------------+
| Chloe     |                    1 |
| Benoit    |                    1 |
| Guillaume |                    1 |
+-----------+----------------------+
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?
SELECT a.prenom, l.titre, e.date_sortie 
FROM abonne a 
JOIN emprunt e ON a.id_abonne = e.id_abonne 
JOIN livre l ON e.id_livre = l.id_livre
ORDER BY prenom;
+-----------+-------------------------+-------------+
| prenom    | titre                   | date_sortie |
+-----------+-------------------------+-------------+
| Benoit    | Bel-Ami                 | 2016-12-07  |
| Benoit    | Les Trois Mousquetaires | 2017-01-02  |
| Benoit    | Une vie                 | 2017-02-20  |
| Chloe     | Une vie                 | 2016-12-11  |
| Chloe     | Les Trois Mousquetaires | 2017-02-15  |
| Guillaume | Une vie                 | 2016-12-07  |
| Guillaume | La Reine Margot         | 2016-12-15  |
| Guillaume | Une vie                 | 2025-05-20  |
| Laura     | Le Petit chose          | 2016-12-12  |
+-----------+-------------------------+-------------+



----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------
----------- JOINTURES EXTERNES ---------------------------------------------------------
----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------

-- Enregistrez vous dans la table abonné 
INSERT INTO abonne (prenom) VALUES ("Pierral");
SELECT * FROM abonne;
+-----------+-----------+
| id_abonne | prenom    |
+-----------+-----------+
|         1 | Guillaume |
|         2 | Benoit    |
|         3 | Chloe     |
|         4 | Laura     |
|         5 | Pierral   |
+-----------+-----------+

-- Affichez tous les prenoms des abonnés SANS EXCEPTION ainsi que les id_livre des livres qu'ils ont emprunté si c'est le cas.
SELECT a.prenom, e.id_livre 
FROM abonne a, emprunt e 
WHERE a.id_abonne = e.id_abonne
ORDER BY prenom;

-- Avec une jointure comme on a appris jusqu'à présent (jointure interne), le nouvel abonné n'apparait pas dans le résultat !
-- Lors d'une jointure interne on ne récupère que les éléments qui ont une correspondance dans la jointure ! A savoir uniquement les abonnés qui ont des emprunts !
SELECT a.prenom, e.id_livre 
FROM abonne a 
INNER JOIN emprunt e ON e.id_abonne = a.id_abonne
ORDER BY prenom;

-- Pour récupérer l'entièreté des éléments d'un table, incluant ceux qui n'ont pas de correspondance, on va utiliser une jointure externe, soit avec LEFT JOIN, soit avec RIGHT JOIN
-- La table qui sera "en bout" du sens d'écriture (la première citée si je fais un LEFT JOIN ou la dernière citée si je fais un RIGHT JOIN) sera celle dont l'entièreté du contenu sera récupéré en plus des correspondances

-- Ci dessous avec LEFT JOIN, on récupère bien Pierral sans emprunt
SELECT a.prenom, e.id_livre 
FROM abonne a LEFT JOIN emprunt e ON e.id_abonne = a.id_abonne
ORDER BY prenom;

-- Ci dessous, cette fois ci avec RIGHT JOIN, on change le sens d'écriture, on récupère bien Pierral sans emprunt
SELECT a.prenom, e.id_livre 
FROM emprunt e RIGHT JOIN abonne a ON e.id_abonne = a.id_abonne
ORDER BY prenom;
+-----------+----------+
| Benoit    |      100 |
| Benoit    |      105 |
| Benoit    |      101 |
| Chloe     |      105 |
| Chloe     |      100 |
| Guillaume |      100 |
| Guillaume |      104 |
| Guillaume |      100 |
| Laura     |      103 |
| Pierral   |     NULL |
+-----------+----------+

-- EXERCICE 1 : Affichez tous les livres sans exception puis les id_abonne ayant emprunté ces livres si c'est le cas
-- EXERCICE 2 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre
-- EXERCICE 3 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre ainsi que les livres non empruntés :)