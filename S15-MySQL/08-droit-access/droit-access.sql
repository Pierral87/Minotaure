----------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------
---------------------- GESTION DES ACCES UTILISATEURS ----------------------------------------------------
----------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

/* 

Nos BDD nous permettent de stocker des données
    Ces BDDS vont fonctionner en liaison avec notre site web (pages html avec du PHP ou autre lançant les intéractions avec la BDD)
    Donc finalement, n'importe quel utilisateur de notre app/site se "connecte" et "manipule" notre BDD 

Il est donc absolument nécessaire de veiller à ce que les utilisateurs ne possèdent pas plus de droits que nécessaire

En dehors des accès que l'on va déjà gérer dans notre site web, par exemple les droits d'accès aux pages admin, via des rôles d'utilisateurs, on va aussi mettre des blocages et insérer des notions de sécurité dans notre BDD 

Notamment en gérant des comptes utilisateurs avec des accès bien spécifiques pour leurs roles 

Depuis le début on utilise root, c'est le superadmin de la BDD avec TOUS les droits 
    -- NE JAMAIS UTILISER ROOT SUR UN VRAI PROJET QUI PART EN PROD
        -- Il faudra créer des utilisateurs spécifiques

*/

-- CREATE USER 'nomuser'@'host' IDENTIFIED BY 'password'
CREATE USER 'pierra'@'localhost' IDENTIFIED BY 'azerty';

-- Suppression d'un utilisateur
DROP USER 'login'@'host';

-- On donne ensuite les accès (avec un compte qui possède les droits GRANT, pour nous root), à pierra sur entreprise table employes SELECT, INSERT, UPDATE uniquement sur le champ service  
    -- Si je veux donner les droits sur toutes les tables d'entreprise j'écrirais entreprise.* ou bien sur toutes les bases du serveur j'écrirais *.* 
GRANT SELECT, INSERT, UPDATE(service) 
    ON entreprise.employes 
        TO 'pierra'@'localhost';

-- On peut aussi mettre en place des limitations de ressources 
    -- MAX_QUERIES_PER_HOUR : Le nombre de requêtes qu'il peut exécuter par heure 
    -- MAX_UPDATES_PER_HOUR : Le nombre de modif qu'il peut exécuter par heure
    -- MAX_CONNECTIONS_PER_HOUR : Le nombre de fois qu'il peut se connecter à notre serveur 
-- Intéressant de mettre ça en place pour se protéger d'attaque de type ddos/force brute pour préserver la bande passante du serveur et éviter qu'il encaisse des millions de requêtes en quelques secondes 
-- ATTENTION, on veillera à mettre une limite suffisamment élevée pour ne pas que nos utilisateurs se retrouvent bloqués dans une utilisation normale de notre site web 

CREATE USER 'alex'@'localhost' IDENTIFIED BY 'azerty'
WITH MAX_QUERIES_PER_HOUR 5
MAX_UPDATES_PER_HOUR 5
MAX_CONNECTIONS_PER_HOUR 5;

GRANT SELECT, INSERT, UPDATE(service) 
    ON entreprise.employes 
        TO 'alex'@'localhost';

-- Lorsque l'on modifie des droits, ils ne sont pas toujours pris en compte immédiatement, il faut lancer la commande : FLUSH PRIVILEGES;
FLUSH PRIVILEGES;

-- EXERCICE : 
-- Créer les comptes utilisateur suivants : 
        -- secretaire : avec le password de votre choix, on lui attribue le privilège de lecture sur les champs suivants id_employes, nom, prenom, sexe, service sur la table employes 
        CREATE USER 'secretaire'@'localhost'  IDENTIFIED BY 'azerty';
        GRANT SELECT(id_employes, nom, prenom, sexe, service) 
        ON entreprise.employes 
        TO 'secretaire'@'localhost';
        -- directeur : avec le password de votre choix, on lui attribue les privilèges suivants : selection, modification, insertion, suppression sur la bdd entreprise en plus des droits d'attribution de droits à d'autres utilisateurs 
        CREATE USER 'directeur'@'localhost'  IDENTIFIED BY 'azerty';
        GRANT SELECT, UPDATE, INSERT, DELETE, GRANT OPTION
        ON entreprise.* 
        TO 'directeur'@'localhost';

        -- informaticien : mot de passe au choix, donnez lui tous les droits mais une limitation de ressources à 10 requêtes maximum par heure et un nombre de connexion de 6 maximum par heure
        CREATE USER 'informaticien'@'localhost'  IDENTIFIED BY 'azerty'
        WITH MAX_QUERIES_PER_HOUR 10 
        MAX_CONNECTIONS_PER_HOUR 6;
        GRANT ALL
        ON entreprise.employes 
        TO 'informaticien'@'localhost';

    -- Déconnectez vous du compte root, et connectez vous en tant que secrétaire et répondre aux requêtes suivantes : 
            -- 1 -- Afficher la profession de l'employé 417
            SELECT service FROM employes WHERE id_employes = 417;
            -- 2 -- Afficher le nombre de commerciaux 
            SELECT COUNT(*) AS nombre_commerciaux FROM employes WHERE service = "commercial";
            -- 3 -- Afficher le nombre de services différents 
            SELECT COUNT(DISTINCT service) FROM employes;
            -- 4 -- Augmenter le salaire de chaque employés de 100 euros 
            UPDATE employes SET salaire = salaire + 100;

    -- Déconnectez vous du compte secrétaire et connectez vous en tant que directeur et répondre aux requêtes suivantes : 
            -- 1 -- Afficher la date d'embauche de Amandine 
            SELECT date_embauche FROM employes WHERE prenom = "Amandine";
            -- 2 -- Afficher le salaire moyen par service 
            SELECT AVG(salaire) AS salaire_moyen, service FROM employes GROUP BY service;
            -- 3 -- Afficher les informations de l'employé du service commercial gagnant le salaire le plus élevé 
            SELECT * FROM employes WHERE service = "commercial" ORDER BY salaire DESC LIMIT 1;

    -- Déconnectez vous de directeur, connectez vous comme informaticien
            -- 1 -- Lancez plusieurs requêtes pour tester le maximum de requêtes autorisées
            -- 2 -- Reconnectez vous plusieurs fois pour tester le nombre de connexion autorisées 