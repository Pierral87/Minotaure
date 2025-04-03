<?php 

/* 

Les cookies sont des petits fichiers de données que les serveurs web stockent sur l'ordinateur d'un utilisateur via le navigateur. 
Ils permettent aux applications web de conserver des informations d'une session à une autre. Par exemple des choix de préférences utilisateurs ou des informations de session (connexion), même après la fermeture du navigateur.

En PHP on gère les cookies avec la superglobale $_COOKIE, encore une fois, un tableau array ! 

Utilisations principales des cookies via PHP : 
    - Stockage d'informations long terme : Contrairement à la $_SESSION qui stocke des données côté serveur de façon généralement temporaire, un cookie va persister plus longtemps (en fonction de sa date d'expiration)
    - Personnalisation : Ils sont généralement utilisés pour enregistrer des préférences, comme la langue, la devise, le thème ou autre et améliorer l'expérience utilisateur lors des prochaines visites
    - Suivi utilisateur : Ils permettent de suivre les utilisateurs d'une page à l'autre, voire d'un site à l'autre (ce que font les publicités ciblées)

Pour créer un cookie on utilise la fonction setcookie(), qui attend en param :  
    - name : le nom du cookie 
    - value : la valeur contenue dans ce cookie 
    - expire : la date de péremption du cookie en timestamp 
    - path : pour rendre accessible le cookie seulement sur une partie du site 
    - domaine : sur quel nom de domaine
    - secure : pour limiter la création du cookie à exclusivement une connexion HTTPS (sécurisée)
    - httponly : pour limiter l'utilisation du cookie au protocole HTTP et non pas aux langages de script tels que JS 

*/

var_dump($_COOKIE);
// Ici j'ai créé un cookie qui s'appelle CookieTest avec une valeur Valeur test et une expiration dans un an ! 
// time() me retourne le timestamp de l'instant T auquel je rajoute le nombre de secondes qu'il y a dans une année
// setcookie("CookieTest", "Valeur test", time() + (365 * 24 * 3600) );

// var_dump($_SERVER);

$theme = "";

if (isset($_GET["theme"])) {
    $theme = $_GET["theme"];
    setcookie("theme", $theme, time() + (365 * 24 * 3600));
} elseif (isset($_COOKIE["theme"])) {
    $theme = $_COOKIE["theme"];
    setcookie("theme", $theme, time() + (365 * 24 * 3600));
} else {
    setcookie("theme", "clair", time() + (365 * 24 * 3600));
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: <?= $theme === 'sombre' ? '#333' : '#fff'; ?>; color: <?= $theme === 'sombre' ? '#fff' : '#000'; ?>;">
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light <?= $theme === 'clair' ? 'disabled' : ''; ?>">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark <?= $theme === 'sombre' ? 'disabled' : ''; ?>">Thème Sombre</a>
        </p>
        <p>Thème actuel : <strong><?= ucfirst($theme) ?></strong></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>