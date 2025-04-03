<?php

/*

    EXERCICE COOKIE :
            Mémorisation d'un choix de langue par l'utilisateur : 

                Etapes : 
                    - 1 Créer 4 liens HTML représentant des langues 
                    - 2 Via le GET, transmettre les informations de la langue cliquée
                    - 3 En fonction de la langue cliquée, créer un cookie correspondant
                    - 4 Vérifier le fonctionnement en revenant sur la page pour voir si la langue a été mémorisée (afficher la langue sélectionnée ou une phrase dans la langue en question)
                    - 5 Bien faire en sorte que le choix de langue soit cohérent (quelle serait la priorité entre le cookie, le choix utilisateur, le choix par défaut)

*/ 

$langues_dispo = [
    'fr' => 'Francais',
    'en' => 'English',
    'jp' => '日本語 (Japonais)',
    'kr' => '한국어 (Coréen)'
];

$langue_nav = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

$langue_defaut = 'fr';

if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $langues_dispo)) {
    $langue_choisie = $_GET['lang'];
    setcookie('langue', $langue_choisie, time() + (3 * 24 * 60 * 60), "/");
} elseif (isset($_COOKIE['langue']) && array_key_exists($_COOKIE['langue'], $langues_dispo)) {
    $langue_choisie = $_COOKIE['langue'];
    setcookie('langue', $langue_choisie, time() + (3 * 24 * 60 * 60), "/"); 
} elseif ( array_key_exists($langue_nav, $langues_dispo)) {
    $langue_choisie = $langue_nav;
    setcookie('langue', $langue_choisie, time() + (3 * 24 * 60 * 60), "/"); 
} else {
    $langue_choisie = $langue_defaut;
    setcookie('langue', $langue_choisie, time() + (3 * 24 * 60 * 60), "/");
}

$affichage = [
    'fr' => "Langue choisie Francais",
    'en' => "English chosen language",
    'jp' => "選択した言語 日本語",
    'kr' => "선택한 언어 한국어"
];

// var_dump($_SERVER);

?>
<!DOCTYPE html>
<html lang="<?= $langue_choisie ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COOKIE</title>
    <style>
        body {
            @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            background-color: #232426;
        }
        h1 {
            text-align: center;
            color: #8F60D0;
        }

        h2 {
            text-align: center;
            color:rgb(255, 255, 255);
        }
        ul {
            background-color: #1c1d1f;
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #8F60D0;
            list-style: none;
        }

        li {
            margin: 10px 0;
            width: 100%;
            text-align: center;
        }

        li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: white;
            background-color: #8F60D0;
            border-radius: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        li a:hover {
            background-color: #7a4eb5;
            transform: scale(1.05);
        }

    </style>
</head>

<body>
    <h1><?= $affichage[$langue_choisie] ?></h1>

    <h2>Choisis la langue :</h2>
    <ul>
        <li><a href="?lang=fr">Français</a></li>
        <li><a href="?lang=en">Anglais</a></li>
        <li><a href="?lang=jp">Japonais</a></li>
        <li><a href="?lang=kr">Coréen</a></li>
    </ul>
</body>
</html>
