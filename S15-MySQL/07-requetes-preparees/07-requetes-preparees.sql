--------------------------------------------------------------------
--------------------------------------------------------------------
--------------------- REQUETES PREPAREES ---------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------

-- Cycle d'une requête préparée : Analyse de requête / Interprétation / Exécution 

-- Dans un premier temps, on fournit la requête au système, elle sera analysée et mémorisée
-- Second temps, interprétation de la requête préparée en fonction des éléments à passer en param (les params que l'on va filtrer via diverses fonctions avant de les envoyer)
-- Dernière étape, exécution de la requête 

USE entreprise;

    -- Une requête non préparée : 
        -- La requête ci dessous, supposément envoyée par un formulaire de recherche, me permet de récupérer les informations de Jean-Pierre (Jean-Pierre qui serait la saisie d'un form)
        SELECT * FROM employes WHERE prenom = "Jean-Pierre";

        -- Ici, si la requête n'est pas préparée, libre à l'utilisateur de tenter une injection SQL...
            -- Une injection SQL = une tentative d'attaque sur ma BDD en ajoutant une requête dans une autre 

        saisie du user : Jean-Pierre 
        -- saisie du user mal intentionné : "; DROP DATABASE entreprise;
        SELECT * FROM employes WHERE prenom = ""; DROP DATABASE entreprise;";"
        -- Avec la requête ci dessus, l'utilisateur a réussi à intégrer une requête mal intentionnée dans la requête d'origine, malheureusement, il a réussi à DROP ma base :( 

    -- La requête préparée me permet de me protéger de ce genre d'attaque car elle va filtrer les params reçus pour empêcher d'interpreter de nouvelles instructions

    -- Ici je prépare une requête qui va attendre une valeur prenom que je vais fournir dans un second temps 
    PREPARE querysearch FROM "SELECT * FROM employes WHERE prenom=?";
        SET @prenom = "Jean-Pierre"; -- Variable supposée reçue du formulaire 
        EXECUTE querysearch USING @prenom;

    PREPARE requete2 FROM 'SELECT * FROM employes WHERE prenom=?';
    SET @prenom2 = "'DROP DATABASE entreprise;";
    EXECUTE requete2 USING @prenom2; -- Ici la requête du DROP ne s'execute pas