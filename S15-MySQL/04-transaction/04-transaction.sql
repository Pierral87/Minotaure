
-- Les transactions sont possibles avec le moteur InnoDB 
-- Les transactions nous permettent de créer un environnement de travail temporaire afin d'exécuter des requêtes
-- Généralement on ouvre une transaction lorsqu'un opération a besoin de plusieurs requêtes pour être menée à bien
    -- EXEMPLE : Un virement bancaire,  je dois enlever de l'argent à A pour ensuite le donner à B, 
        -- Je vais valider la transmission de l'argent à B uniquement si j'ai réussi à retirer l'argent à A
        -- Egalement, je peux ne pas ajouter l'argent à B si je n'ai pas réussi à le retirer à A 
        -- Si tout s'est bien passé, je peux valider les deux requêtes ! Si non, on annule tout ! 

    -- On peut manipuler les transactions avec la console pour tester/valider des requêtes 
    
    -- Généralement, on manipule ça dans le langage back couplé avec des bloc try/catch

-- Dans le try je tente de lancer mes requêtes, et si tout va bien je les valider avec COMMIT
-- Si une erreur dans le bloc try, je tombe dans le bloc catch et j'annule je ROLLBACK les requêtes 

-- En PHP avec pdo 
$pdo->beginTransaction();
try {
    -- ici du code
    -- si pas d'erreur le code se poursuit jusqu'à la fin du try
    -- Si pas d'erreur, je peux valider mes requêtes, et les COMMIT
    -- si erreur, je suis transporté dans le bloc catch
    $pdo->commit();
}
catch (e Exception)
{
    -- si je tombe ici c'est que il y a eu une erreur dans mon try
    -- si je suis dans une transaction alors si je tombe dans le catch je vais ROLLBACK mes requêtes
    $pdo->rollback();
}

USE entreprise; 

START TRANSACTION; -- démarre une transaction 
SELECT * FROM employes; -- On vérifie nos données 

UPDATE employes SET salaire = +100; -- Ici mauvaise requête, je me trompe et je mets le salaire de tous à 100 au lieu d'ajouter 100 
SELECT * FROM employes; -- On vérifie nos données 

ROLLBACK; -- ROLLBACK me permet d'annuler toutes les modifications depuis le début de ma transaction
COMMIT; -- COMMIT me permet de valider toutes les modifications depuis le début de ma transaction
-- Si je ferme la console, cela fait un ROLLBACK
-- ATTENTION un COMMIT comme un ROLLBACK, TERMINE la transaction ! 



-- TRANSACTION AVANCEE & SAVEPOINT 

START TRANSACTION;

SELECT * FROM employes; -- On vérifie les données

SAVEPOINT point1; -- On crée un point de sauvegarde nommé "point1"

UPDATE employes SET salaire = 5000;

SELECT * FROM employes; -- On vérifie les donnnées

SAVEPOINT point2; -- On crée un point de sauvegarde nommé "point2"

UPDATE employes SET salaire = 2000; 
UPDATE employes SET service = "web" WHERE service = "informatique";

-- Retour au point 2 
ROLLBACK TO point2;
-- Si je fais un ROLLBACK TO un point de sauvegarde, la transaction est toujours en cours, je dois COMMIT; ou ROLLBACK; pour la cloturer

ROLLBACK;


-- /!\ ATTENTION, à l'intérieur d'une transaction on peut tester et ROLLBACK uniquement les requêtes "classiques", des 4 types (select, insert, update, delete), MAIS certaines autres instructions notamment les requêtes de type structure passeront outre la transaction et seront bel et bien appliquées à notre BDD (DELETE on peut le ROLLBACK, mais TRUNCATE non ! Il sera bien pris en compte !)




