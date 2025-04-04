<?php 

/* 

Les API (Application Programming Interface) 

Une API c'est un ensemble de règles qui permet à une application d'accèder aux services et/ou aux données d'une autre application.
Globalement, une API permet à des systèmes différents de communiquer entre eux.
Par exemple, sur mon site, je veux afficher des informations en rapport avec la météo d'un endroit bien spécifiques, pour ça, je fais appel à une API qui sera connectée à un suivi météo. Cela pourrait être des résultats sportifs ou un calcul spécifique gérer par une API extérieure.

En PHP on utilisera des fonctions telles que file_get_contents() pour récupérer le contenu d'une requête API (souvent de forme json) et ensuite refiltrer ce json avec json_decode() pour le transformer en array et le rendre exploitable.


*/

// J'ai récupéré l'URL de l'api avec déjà des params sur le site de open-meteo.com 
// Pour savoir ce dont j'ai besoin je lis la doc, le but étant ensuite de rendre ces appels API dynamique grâce au PHP
$apiURL = "https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&hourly=temperature_2m,relative_humidity_2m,weather_code";

// Récupération du contenu de l'API
$response = file_get_contents($apiURL);

// var_dump($response);

// Décodage du fichier JSON en un array association
$data = json_decode($response, true);

// var_dump($data);

// Je pioche ici un élément du résultat de mon API
if (isset($data["latitude"])) {
    echo "La latitude de cet appel meteo est : " . $data["latitude"];
} else {
    echo "Données non récupérée";
}