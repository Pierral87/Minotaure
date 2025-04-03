<?php 

/* 

    Le système de session en PHP est un mécanisme qui permet de maintenir des informations entre le serveur et le client tout au long de sa navigation, peu importe s'il change de page ou pas ! 

    En PHP, comme tout le reste... Nous avons une superglobale associée à ce système, la globale $_SESSION ! ENCORE UNE FOIS, c'est un tableau array :) 

    ATTENTION, par défaut $_SESSION n'existe pas ! Il existe uniquement s'il y a un session_start() sur la page, on fera ainsi en sorte de l'intégrer à chacune de nos pages (souvent présent dans le fichier partials _config.php)

    $_SESSION c'est un array vide dans lequel je peux stocker toutes les informations de mon choix !  

    Ces informations pourront m'aider à réinterpréter certains éléments sur mon site web tout au long de la navigation de l'utilisateur

        Exemples d'utilisation : 
            - Stocker des informations utilisateurs (après une connexion/identification réussie), des données de connexion "pseudo", "email", "role" (admin/membre) pour les gestions d'accès, 
            - Panier d'un site ecommerce
            - Etat d'un utilisateur (connecté ou pas)
            - Messages flash (message temporaire à afficher une fois à l'utilisateur)

    Fonctionnement des sessions : 

        Démarrage d'une session : On débute une session avec l'instruction session_start(), cela va créer un identifiant unique de session côté serveur (un SESSID) et également un cookie sur l'ordinateur de l'utilisateur possédant le même id 

        Stockage de données dans $_SESSION : On le manipule comme un array associatif (avec les clés étant des string)

        Persistance entre les pages : Tant que la session est active ces informations seront accessibles sur toutes les pages 

*/

session_start();

$_SESSION["username"] = "Pierra";
$_SESSION["role"] = "admin";
$_SESSION["messages"][] = "Vous êtes bien inscrit";

unset($_SESSION["messages"]);

// session_destroy() : Détruit toutes les données de la session sur le serveur. Cependant cela ne supprime pas automatiquement le cookie côté client.

// session_unset() : supprime toutes les variables de session sans détruire la session elle même

// session_regenerate_id() : Change l'ID de session pour renforcer la sécurité, particulièrement utilisé après des opérations "critiques", par exemple après une connexion réussie, après une commande eshop ou autre pour éviter ce qu'on appelle la "Fixation de session"
// Attention à ne pas lancer cette opération trop souvent pour des risques de synchro des données stockées dans $_SESSION

// Etendre la durée de la session pour maintenir la connexion 

ini_set("session.cookie_lifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du cookie de session
ini_set("session.gc_maxlifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du fichier de session serveur (passé ce laps de temps, on considère la session comme périmée)


// PHP possède un système de "nettoyage automatique" des fichiers de sessions sur le serveur c'est ce qu'on appelle le GC pour Garbage Collection
// En gros à chaque opération sur les sessions serveur il y a une petite probabilité que l'opération de nettoyage se lance et supprimer les fichiers de sessions expirés du serveur 

// Voir exemple de manipulation dans l'exo POST Connexion utilisateur 


//  Bonne pratiques avec $_SESSION 
        // - Protéger les données sensibles : Ne jamais stocker des informations sensibles directement dans $_SESSION (password etc)
        // - Sécuriser les sessions : Utiliser session_regenerate_id() lors des changements d'états sensibles pour éviter les fixations de session
        // - Limiter la durée de vie des sessions : Définir une expiration de session pour éviter que des sessions restent actives trop longtemps 
