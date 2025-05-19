-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------
------------ SYNTAXE MYSQL --------------------------------------------------------------
-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------



-- Ceci est un commentaire en MySQL, jusqu'à la fin de la ligne
/* 

    Commentaire entre les deux indicateurs 

*/

-- Lien utile, la documentation SQL : https://sql.sh/

-- Pour se connecter à la console MySQL : 

        -- Wamp : Ouvrir le menu MySQL et console MySQL : login : root, password :  vide
        -- Xampp : Ouvrir le shell (le terminal) et on écrit :   mysql -u root -p
        -- Mamp : /Applications/MAMP/Library/bin/mysql -u root -p root

-- Les requêtes MySQL ne sont pas sensibles à la casse, en revanche, une convention d'écriture nous demande d'écrire les mots clés en majuscule 
-- SELECT prenom FROM user WHERE id_user = 12;

-- Chaque instruction doit se terminer par un ; 

-- Pour créer une BASE 
CREATE DATABASE une_bdd;

SHOW DATABASES; -- Pour voir la liste des BDDs sur le serveur
SHOW TABLES; -- Pour voir la liste des tables de la BDD actuellement sélectionnée
SHOW WARNINGS; -- Les warnings de la dernière requête exécutée

USE une_bdd; -- Pour se positionner avec le terminal sur une BDD afin de pouvoir intéragir dessus
SELECT DATABASE(); -- Pour vérifier quelle est la base actuellement sélectionnée

DROP DATABASE une_bdd; -- Pour supprimer une BDD 
DROP TABLE nom_de_table; -- Pour supprimer une table 

TRUNCATE nom_de_table; -- Pour vider une table en gardant sa structure (attention c'est une requête de type structure)
DELETE FROM nom_de_table; -- Pour vider la table (requête classique de type action)

DESC nom_de_table; -- Pour avoir une DESCription de la structure d'une table 

CREATE DATABASE entreprise;
USE entreprise;

-- Création d'une table employes dans la base entreprise
CREATE TABLE IF NOT EXISTS employes (
  id_employes int NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

-- Insertions dans la table employes 
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);

-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
------------- REQUETES DE SELECTION (On questionne la BDD) --------------------
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------

-- Affichage complet des données d'une table 
SELECT * FROM employes;

-- Selection de simplement quelques champs de la table 
SELECT nom, prenom FROM employes;

-- Exercice : Affichez la liste des différents services de la table employes
SELECT service FROM employes;
-- Pour éviter les doublons on utilise DISTINCT 
SELECT DISTINCT service FROM employes;
+---------------+
| service       |
+---------------+
| direction     |
| commercial    |
| production    |
| secretariat   |
| comptabilite  |
| informatique  |
| communication |
| juridique     |
| assistant     |
+---------------+

-- CONDITION WHERE
-- Affichage des employés du service informatique 
SELECT * FROM employes WHERE service = "informatique"; -- '' ou "" pas de différences ici 
+-------------+---------+--------+------+--------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service      | date_embauche | salaire |
+-------------+---------+--------+------+--------------+---------------+---------+
|         701 | Mathieu | Vignal | m    | informatique | 2013-04-03    |    2500 |
|         802 | Damien  | Durand | m    | informatique | 2014-07-05    |    2250 |
|         854 | Daniel  | Chevel | m    | informatique | 2015-09-28    |    3100 |
+-------------+---------+--------+------+--------------+---------------+---------+

-- BETWEEN
-- Affichage des employés ayant été embauché entre 2015 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND "2025-05-19";
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND NOW(); -- fonction NOW retourne la date et l'heure de maintenant
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND CURDATE(); -- fonction CURDATE() retourne la date d'aujourd'hui

+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         854 | Daniel    | Chevel  | m    | informatique | 2015-09-28    |    3100 |
|         876 | Nathalie  | Martin  | f    | juridique    | 2016-01-12    |    3550 |
|         900 | Benoit    | Lagarde | m    | production   | 2016-06-03    |    2550 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
|         990 | Stephanie | Lafaye  | f    | assistant    | 2017-03-01    |    1775 |
+-------------+-----------+---------+------+--------------+---------------+---------+

SELECT NOW(); -- Nous renvoie la date et l'heure de l'instant d'exécution 

-- LIKE : la valeur approchante 
-- Nous permet de lancer une recherche sur une information écrite partiellement 
-- Affichage des prénoms commençant par la lettre "s"
SELECT prenom FROM employes WHERE prenom LIKE "s%";
-- % : signifie "peu importe ce qui se trouve à cette place"
+-----------+
| prenom    |
+-----------+
| Stephanie |
+-----------+
-- Affichage des prénoms finissant par les lettres "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie";
+-----------+
| prenom    |
+-----------+
| Elodie    |
| Melanie   |
| Nathalie  |
| Emilie    |
| Stephanie |
+-----------+
-- Affichage des prenoms contenant les lettres "ie" (début, fin, milieu)
SELECT prenom FROM employes WHERE prenom LIKE "%ie%";
+-------------+
| prenom      |
+-------------+
| Jean-pierre |
| Elodie      |
| Melanie     |
| Julien      |
| Mathieu     |
| Thierry     |
| Damien      |
| Daniel      |
| Nathalie    |
| Emilie      |
| Stephanie   |
+-------------+

-- EXCLUSION
-- Tous les employés sauf ceux d'un service particulier, par exemple sauf le service commercial 
SELECT * FROM employes WHERE service != "commercial";
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Les opérateurs de comparaison : 
-- =  est égal à 
-- != est différent de
-- > strictement supérieur
-- >= supérieur ou égal
-- < strictement inférieur
-- <= inférieur ou égal 

-- Les employes ayant un salaire supérieur à 3000
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
-- Guillemets non obligatoire pour les valeurs numériques 
+----------+-------------+--------------+---------+
| nom      | prenom      | service      | salaire |
+----------+-------------+--------------+---------+
| Laborde  | Jean-pierre | direction    |    5000 |
| Winter   | Thomas      | commercial   |    3550 |
| Collier  | Melanie     | commercial   |    3100 |
| Blanchet | Laura       | direction    |    4500 |
| Chevel   | Daniel      | informatique |    3100 |
| Martin   | Nathalie    | juridique    |    3550 |
+----------+-------------+--------------+---------+

-- ORDER BY pour ordonner les résultats
-- Affichage de tous les employés dans l'ordre alphabétique
SELECT * FROM employes ORDER BY nom; -- Par défaut on classe par ordre ascendant "ASC", c'est à dire, croissant/alphabétique/chronologique
SELECT * FROM employes ORDER BY nom ASC; -- On peut le spécifier, mais ce n'est pas obligatoire
SELECT * FROM employes ORDER BY nom DESC; -- L'inverse étant l'ordre descendant

-- Il est possible d'ordonner sur plusieurs champs. Si le premier a des valeurs similaires (ici nos services), on peut classer ensuite par un autre champ
SELECT service, nom, prenom FROM employes ORDER BY service, nom;
+---------------+----------+-------------+
| service       | nom      | prenom      |
+---------------+----------+-------------+
| assistant     | Lafaye   | Stephanie   |
| commercial    | Collier  | Melanie     |
| commercial    | Gallet   | Clement     |
| commercial    | Miller   | Guillaume   |
| commercial    | Perrin   | Celine      |
| commercial    | Sennard  | Emilie      |
| commercial    | Winter   | Thomas      |
| communication | Thoyer   | Amandine    |
| comptabilite  | Grand    | Fabrice     |
| direction     | Blanchet | Laura       |
| direction     | Laborde  | Jean-pierre |
| informatique  | Chevel   | Daniel      |
| informatique  | Durand   | Damien      |
| informatique  | Vignal   | Mathieu     |
| juridique     | Martin   | Nathalie    |
| production    | Dubar    | Chloe       |
| production    | Lagarde  | Benoit      |
| secretariat   | Cottet   | Julien      |
| secretariat   | Desprez  | Thierry     |
| secretariat   | Fellier  | Elodie      |
+---------------+----------+-------------+

-- LIMIT pour limiter le nombre de résultat
-- Affichage des employés 3 par 3 
-- Syntaxe du LIMIT :   LIMIT position_de_depart(offset), nombre_de_lignes
SELECT * FROM employes LIMIT 0, 3;
+-------------+-------------+---------+------+------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service    | date_embauche | salaire |
+-------------+-------------+---------+------+------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction  | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial | 2011-05-03    |    3550 |
+-------------+-------------+---------+------+------------+---------------+---------+
SELECT * FROM employes LIMIT 3, 3;
+-------------+---------+---------+------+--------------+---------------+---------+
| id_employes | prenom  | nom     | sexe | service      | date_embauche | salaire |
+-------------+---------+---------+------+--------------+---------------+---------+
|         417 | Chloe   | Dubar   | f    | production   | 2011-09-05    |    1900 |
|         491 | Elodie  | Fellier | f    | secretariat  | 2011-11-22    |    1600 |
|         509 | Fabrice | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
+-------------+---------+---------+------+--------------+---------------+---------+
SELECT * FROM employes LIMIT 6, 3;
+-------------+-----------+----------+------+------------+---------------+---------+
| id_employes | prenom    | nom      | sexe | service    | date_embauche | salaire |
+-------------+-----------+----------+------+------------+---------------+---------+
|         547 | Melanie   | Collier  | f    | commercial | 2012-01-08    |    3100 |
|         592 | Laura     | Blanchet | f    | direction  | 2012-05-09    |    4500 |
|         627 | Guillaume | Miller   | m    | commercial | 2012-07-02    |    1900 |
+-------------+-----------+----------+------+------------+---------------+---------+


-- On peut se passer de spécifier l'offset, dans ce cas, on affichera simplement le nombre de ligne souhaitées dans l'ordre du résultat
-- Ici les 3 premières d'un jeu de résultat
SELECT * FROM employes LIMIT 3;

-- Affichage des employés avec leur salaire annuel 
SELECT nom, prenom, service, salaire * 12 FROM employes;
-- La même requête mais on renomme la colonne du calcul
SELECT nom, prenom, service, salaire * 12 AS salaire_annuel FROM employes;
-- AS nous permet de donner un nouveau nom à la colonne lors de la récupération. Ainsi, lorsque je vais récupérer mes résultats en PHP, mon array de résultats aura des noms de clés appropriés (pas d'espace)

+----------+-------------+---------------+----------------+
| nom      | prenom      | service       | salaire_annuel |
+----------+-------------+---------------+----------------+
| Laborde  | Jean-pierre | direction     |          60000 |
| Gallet   | Clement     | commercial    |          27600 |
| Winter   | Thomas      | commercial    |          42600 |
| Dubar    | Chloe       | production    |          22800 |
| Fellier  | Elodie      | secretariat   |          19200 |
| Grand    | Fabrice     | comptabilite  |          34800 |
| Collier  | Melanie     | commercial    |          37200 |
| Blanchet | Laura       | direction     |          54000 |
| Miller   | Guillaume   | commercial    |          22800 |
| Perrin   | Celine      | commercial    |          32400 |
| Cottet   | Julien      | secretariat   |          16680 |
| Vignal   | Mathieu     | informatique  |          30000 |
| Desprez  | Thierry     | secretariat   |          18000 |
| Thoyer   | Amandine    | communication |          25200 |
| Durand   | Damien      | informatique  |          27000 |
| Chevel   | Daniel      | informatique  |          37200 |
| Martin   | Nathalie    | juridique     |          42600 |
| Lagarde  | Benoit      | production    |          30600 |
| Sennard  | Emilie      | commercial    |          21600 |
| Lafaye   | Stephanie   | assistant     |          21300 |
+----------+-------------+---------------+----------------+

------------- Fonctions d'agrégation ---------------------------------

-- SUM() pour avoir la somme
-- La masse salariale annuelle de l'entreprise
SELECT SUM(salaire * 12) AS masse_salariale FROM employes;
+-----------------+
| masse_salariale |
+-----------------+
|          623580 |
+-----------------+

-- AVG() la moyenne
-- Affichage du salaire moyen de l'entreprise
SELECT AVG(salaire) AS salaire_moyen FROM employes;

-- ROUND() pour arrondir à l'entier
-- ROUND(valeur, 2) pour arrondir avec 2 décimales
SELECT ROUND(AVG(salaire)) AS salaire_moyen_arrondi FROM employes; -- à l'entier
SELECT ROUND(AVG(salaire), 1) AS salaire_moyen_arrondi FROM employes; -- à une décimale

-- COUNT() permet de compter le nombre de ligne d'un jeu de résultat
-- Le nombre d'employés dans l'entreprise : 
SELECT COUNT(*) AS nombre_employes FROM employes; -- COUNT() va faire +1 pour chaque ligne correspondant à la requête et nous renvoie le total
-- On laisse toujours * dans les parenthèses du COUNT, comme ça on s'assure de compter la totalité des lignes d'un jeu de résultat
-- Si jamais je spécifie un champ dans les parenthèses, si pour une ligne, ce champ est NULL, alors il ne sera pas comptabilisé
+-----------------+
| nombre_employes |
+-----------------+
|              20 |
+-----------------+

-- MIN() et MAX()
-- salaire minimum 
SELECT MIN(salaire) FROM employes;
+--------------+
| MIN(salaire) |
+--------------+
|         1390 |
+--------------+
-- salaire maximum
SELECT MAX(salaire) FROM employes;
+--------------+
| MAX(salaire) |
+--------------+
|         5000 |
+--------------+

-- EXERCICE : Affichez le salaire minimum ainsi que le prénom de l'employé ayant ce salaire...... Vérifiez bien les résultats !
SELECT prenom, MIN(salaire) FROM employes;
+-------------+--------------+
| prenom      | MIN(salaire) |
+-------------+--------------+
| Jean-pierre |         1390 |
+-------------+--------------+
-- Cette requête me sort Jean-Pierre, le résultat est FAUX ! Pourquoi ?
-- MIN est une fonction d'agrégation elle ne peut me retourner qu'un seul résultat, ainsi cette requête m'affiche simplement le salaire minimum ainsi que le premier prénom qu'elle trouve dans la table (le premier enregistrement) donc Jean-Pierre

-- Le concept des fonctions d'agrégation est, qu'elles passent sur l'entièreté du jeu de résultat pour effectuer une opération ou une recherche et ne sont capable de n'en ressortir qu'une seule ligne de résultat (sauf si on les couple avec l'instruction GROUP BY)
-- SUM va regarder toutes les lignes et faire une somme et sortir un seul résultat
-- AVG va regarder toutes les lignes et faire la moyenne et sortir un seul résultat
-- etc. 


-- 2 solutions

-- 1 : requête imbriquée
SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

-- 2 : avec un order by et un limit 
SELECT prenom, salaire FROM employes ORDER BY salaire ASC LIMIT 1;
+--------+---------+
| prenom | salaire |
+--------+---------+
| Julien |    1390 |
+--------+---------+

-- IN & NOT IN pour tester plusieurs valeurs 
-- Affichage des employes des services commercial et comptabilite 
SELECT * FROM employes WHERE service = "commercial" OR service = "comptabilite";
SELECT * FROM employes WHERE service IN ("commercial", "comptabilite");
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         388 | Clement   | Gallet  | m    | commercial   | 2010-12-15    |    2300 |
|         415 | Thomas    | Winter  | m    | commercial   | 2011-05-03    |    3550 |
|         509 | Fabrice   | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
|         547 | Melanie   | Collier | f    | commercial   | 2012-01-08    |    3100 |
|         627 | Guillaume | Miller  | m    | commercial   | 2012-07-02    |    1900 |
|         655 | Celine    | Perrin  | f    | commercial   | 2012-09-10    |    2700 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+--------------+---------------+---------+
-- l'inverse NOT IN
SELECT * FROM employes WHERE service NOT IN ("commercial", "comptabilite");
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Plusieurs conditions : AND 
-- On veut un employé du service commercial ayant un salaire inférieur ou égal à 2000
SELECT * FROM employes WHERE service = "commercial" AND salaire <= 2000 LIMIT 1;
+-------------+-----------+--------+------+------------+---------------+---------+
| id_employes | prenom    | nom    | sexe | service    | date_embauche | salaire |
+-------------+-----------+--------+------+------------+---------------+---------+
|         627 | Guillaume | Miller | m    | commercial | 2012-07-02    |    1900 |
+-------------+-----------+--------+------+------------+---------------+---------+

SELECT * FROM employes 
WHERE service = "commercial" 
AND salaire <= 2000 
LIMIT 1;

-- L'un ou l'autre d'un ensemble de conditions : OR 
-- EXERCICE : Affichez les employés du service production ayant un salaire égal à 1900 ou 2300 ...... Vérifiez vos résultats !
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR salaire = 2300;
-- Résultat incorrect avec la requête ci dessus, cela nous sort Clément Gallet du service commercial ayant un salaire à 2300 ???
+-------------+---------+--------+------+------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service    | date_embauche | salaire |
+-------------+---------+--------+------+------------+---------------+---------+
|         388 | Clement | Gallet | m    | commercial | 2010-12-15    |    2300 |
|         417 | Chloe   | Dubar  | f    | production | 2011-09-05    |    1900 |
+-------------+---------+--------+------+------------+---------------+---------+
-- Le système comprend que les deux premières conditions sont liées par le AND, par contre le OR indique que la condition qui suit est indépendante, d'où le fait que Clement fasse parti du résultat 

-- Pour corriger ça, plusieurs possibilités 
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR service = "production" AND salaire = 2300;
SELECT * FROM employes WHERE service = "production" AND (salaire = 1900 OR salaire = 2300);
SELECT * FROM employes WHERE service = "production" AND salaire IN (1900, 2300);
+-------------+--------+-------+------+------------+---------------+---------+
| id_employes | prenom | nom   | sexe | service    | date_embauche | salaire |
+-------------+--------+-------+------+------------+---------------+---------+
|         417 | Chloe  | Dubar | f    | production | 2011-09-05    |    1900 |
+-------------+--------+-------+------+------------+---------------+---------+


-- GROUP BY : Pour regrouper des "blocs" à l'intérieur d'un résultat pour permettre d'utiliser les fonctions d'agrégation et recevoir plusieurs lignes de résultats 

-- Nombre d'employés
SELECT COUNT(*) FROM employes;
-- Nombre d'employés par service
SELECT COUNT(*), service FROM employes; -- Résultat incorrect ici comme le MIN(salaire) et prenom, cela me sort simplement le premier service associé au COUNT de tous les employés, le but étant ici de manipuler GROUP BY pour "regrouper" chaque ligne d'un service pour pouvoir les compter séparément
-- En quelque sorte, chaque bloc de service est "extrait" du résultat de base et la fonction d'agrégation s'applique sur chaque bloc séparément
SELECT COUNT(*) AS nombre_employes, service FROM employes GROUP BY service;
-- Ici les services sont traités séparément les uns des autres, ce qui permet d'appliquer le COUNT pour chaque service
+-----------------+---------------+
| nombre_employes | service       |
+-----------------+---------------+
|               2 | direction     |
|               6 | commercial    |
|               2 | production    |
|               3 | secretariat   |
|               1 | comptabilite  |
|               3 | informatique  |
|               1 | communication |
|               1 | juridique     |
|               1 | assistant     |
+-----------------+---------------+

-- Il est possible de mettre des conditions sur les GROUP BY avec : HAVING 
-- Nombre d'employés par service pour les services ayant plus de 2 employés
-- On ne peut mettre dans le HAVING qu'une condition en rapport avec le résultat de la fonction d'agrégation associée
SELECT COUNT(*) AS nombre_employes, service FROM employes GROUP BY service HAVING COUNT(*) > 2;
+-----------------+--------------+
| nombre_employes | service      |
+-----------------+--------------+
|               6 | commercial   |
|               3 | secretariat  |
|               3 | informatique |
+-----------------+--------------+

-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
------------- REQUETES D'INSERTION (Action : enregistrement) ------------------
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------

INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, service, date_embauche) VALUES (NULL, "Pierral", "Lacaze", 2000, "m", "Web", CURDATE());
-- Vérification de l'insertion
SELECT * FROM employes;

-- Comme l'id est auto incrémenté, je peux ne pas le citer à l'insertion
INSERT INTO employes (prenom, nom, salaire, sexe, service, date_embauche) VALUES ("Pierral", "Lacaze", 2000, "m", "Web", CURDATE());

-- Il est possible de ne pas préciser les champs. En revanche, on est dans ce cas obligé de donner autant de valeur qu'il y a de champs dans la table et en respectant l'ordre de la structure
INSERT INTO employes VALUES (NULL, "Pierral", "Lacaze", "m", "Web", CURDATE(), 2000);

-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
------------- REQUETES DE MODIFICATION (Action : modification) ----------------
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------

-- On modifie le salaire d'un employé
UPDATE employes SET salaire = 2100 WHERE id_employes = 991;
-- Plusieurs modifications sont possibles en une seule fois
UPDATE employes SET salaire = 220, service = "informatique", sexe = "f" WHERE id_employes = 992;

-- REPLACE 
-- REPLACE se comporte à la fois comme une requête d'insertion mais aussi comme une requête de modification
-- Si l'enregistrement n'est pas trouvé alors il est inséré, sinon il sera "modifié"
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "Web", CURDATE(), 3000);
-- Ci dessus premier lancement, la ligne est insérée
REPLACE INTO employes VALUES (994, "Pola", "Loli", "f", "informatique", CURDATE(), 3000);
-- Query OK, 2 rows affected (0.00 sec)
-- 2 rows affected ???
-- En fait, REPLACE ne modifie pas un enregistrement, il le supprimer pour le réinsérer ! 

-- ATTENTION NE JAMAIS UTILISER REPLACE 
    -- TRES GRAVE sur une base possedant des relations et contraintes d'intégrité en mode CASCADE (CASCADE = reaction en chaine), la suppression avant remplacement pourrait entrainer des suppressions inattendues dans la BDD 

-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
------------- REQUETES DE SUPPRESSION (Action : Supprimer) --------------------
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------

DELETE FROM employes; -- Cette requête supprime toutes les données de la table
DELETE FROM employes WHERE id_employes = 991; -- Ici on supprime un employé, celui à l'id 991
DELETE FROM employes WHERE service = informatique; -- Ici on supprime les employés du service informatique
DELETE FROM employes WHERE service = comptabilite AND sexe = "m";

-- Très simple, on supprime simplement tous les enregistrements rencontrés en rapport avec la ou les conditions annoncées.


--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- EXERCICES :
--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- 1 -- Afficher la profession de l'employé 547.
-- 2 -- Afficher la date d'embauche d'Amandine.	
-- 3 -- Afficher le nom de famille de Guillaume	
-- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
-- 5 -- Afficher le nombre de commerciaux.
-- 6 -- Afficher le salaire moyen des informaticiens (+arrondie).	
-- 7 -- Afficher les 5 premiers employés après avoir classé leur nom de famille par ordre alphabétique. 
-- 8 -- Afficher le coût des commerciaux sur 1 année.	
-- 9 -- Afficher le salaire moyen par service. (service + salaire moyen)
-- 10 -- Afficher le nombre de recrutement sur l'année 2010 
-- 11 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 a 2017
-- 12 -- Afficher le nombre de service différent 
-- 13 -- Afficher tous les employés (sauf ceux du service production et secrétariat)
-- 14 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
-- 15 -- Afficher les commerciaux ayant été recrutés avant 2012 de sexe masculin et gagnant un salaire supérieur a 2500 €
-- 16 -- Qui a été embauché en dernier 
-- 17 -- Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé 
-- 18 -- Afficher le prénom du comptable gagnant le meilleur salaire 
-- 19 -- Afficher le prénom de l'informaticien ayant été recruté en premier 
-- 20 -- Augmenter chaque employé de 100 €
-- 21 -- Supprimer les employés du service secrétariat