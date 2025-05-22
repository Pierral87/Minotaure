<?php

// -------------------------------------------------------------------
// -------------------------------------------------------------------
// ---------- PDO : PHP DATA OBJECT ----------------------------------
// -------------------------------------------------------------------
// -------------------------------------------------------------------

// PDO est une classe prédéfinie de PHP, elle représente une connexion à un serveur de BDD 
// On va manipuler MySQL via cet outil PDO ! 
// Evidemment, on peut manipuler d'autres SGBD avec PDO 

echo "<h2>01 - Connexion à la BDD</h2>";
// Pour créer une connexion à la BDD nous avons besoin de plusieurs informations 
// Voir doc : https://www.php.net/manual/fr/class.pdo.php
// - Le host et nom de la bdd 
// - Le login de connexion à la bdd
// - Le password de connexion à la bdd
// - Eventuellement un array contenant des options 

$host = "mysql:host=localhost;dbname=entreprise";  // hôte + nom de la bdd
$login = "root";
$password = ""; // Pas de password sur XAMPP et WAMP, mais sur MAMP il faut bien renseigner root 
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);


// Création de l'objet de PDO : 
// Je crée toujours mon objet PDO dans un try catch, nous ne sommes jamais à l'abri d'un problème du serveur de BDD (indépendament du serveur web lui même)
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "<h3>Site momentanément indisponible, revenez plus tard</h3>";
    exit;
}

// Si le var_dump me sort un résultat et me présente bien un objet de type PDO, alors c'est bon ! La connexion a fonctionnée !
var_dump($pdo);

echo "<h2>02 - Requêtes de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD 

// On va utiliser ici la méthode "query" qui lance une requête directement (un peu comme on les lance dans la console)
// /!\ ATTENTION /!\ avec l'utilisation de la méthode query, nous sommes sensible aux injections SQL !!!
    // On considère qu'il vaudra toujours mieux, utiliser la méthode prepare que nous verrons plus bas 

// $stmt = $pdo->query("INSERT INTO employes (prenom, nom, salaire, sexe, date_embauche, service) VALUES ('Bob', 'Leponge', 50, 'm', CURDATE(), 'restauration')");

// $stmt est un objet de type PDOStatement, c'est une sorte de sous objet de PDO qui "représente" la réponse à une requête sous forme d'un jeu de résultat
// Pas de réponse particulière sur une requête de type action mais nous avons accès à des informations

// PDOStatement possède de nombreuses méthodes qui nous retournent des informations, notamment rowCount qui nous retourne le nombre de lignes impactées par la requête ou le nombre de lignes retournées par la requête
// Toujours intéressant de l'utiliser pour vérifier les doublons d'utilisateur (pseudo/email déjà pris), pour lister le nombre de messages dans un tchat ou autre 
// echo "Nombre de lignes impactées par la requête : " . $stmt->rowCount() . "<hr>";

echo "<h2>03 - Requêtes de sélection pour une seule ligne de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes WHERE id_employes = 994");
// +-------------+--------+---------+------+--------------+---------------+---------+
// | id_employes | prenom | nom     | sexe | service      | date_embauche | salaire |
// +-------------+--------+---------+------+--------------+---------------+---------+
// |         994 | Bob    | Leponge | m    | restauration | 2025-05-22    |      50 |
// +-------------+--------+---------+------+--------------+---------------+---------+

var_dump($stmt);
// Actuellement, je ne peux pas exploirer la réponse de la BDD dans PDOStatement, je n'ai pas accès directement au résultat sur cet objet
// Pour la rendre exploitable, il faut transformer/extraire le résultat grâce à la méthode fetch() 

// FETCH_ASSOC : Pour récupérer un array associatif (c'est à dire les clés du array comme les colonnes du résultat)
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);
// array (size=7)
//   'id_employes' => int 994
//   'prenom' => string 'Bob' (length=3)
//   'nom' => string 'Leponge' (length=7)
//   'sexe' => string 'm' (length=1)
//   'service' => string 'restauration' (length=12)
//   'date_embauche' => string '2025-05-22' (length=10)
//   'salaire' => float 50

// FETCH_NUM : Pour récupérer un array indexé numériquement (les clés sont nommées en commençant par 0)
// $data = $stmt->fetch(PDO::FETCH_NUM);
// var_dump($data);
// array (size=7)
//   0 => int 994
//   1 => string 'Bob' (length=3)
//   2 => string 'Leponge' (length=7)
//   3 => string 'm' (length=1)
//   4 => string 'restauration' (length=12)
//   5 => string '2025-05-22' (length=10)
//   6 => float 50

// FETCH_BOTH : Pour récupérer un array à la fois indexé numériquement et associativement, c'est le mode par défaut de fetch
// $data = $stmt->fetch(PDO::FETCH_BOTH);
// var_dump($data);
// array (size=14)
//   'id_employes' => int 994
//   0 => int 994
//   'prenom' => string 'Bob' (length=3)
//   1 => string 'Bob' (length=3)
//   'nom' => string 'Leponge' (length=7)
//   2 => string 'Leponge' (length=7)
//   'sexe' => string 'm' (length=1)
//   3 => string 'm' (length=1)
//   'service' => string 'restauration' (length=12)
//   4 => string 'restauration' (length=12)
//   'date_embauche' => string '2025-05-22' (length=10)
//   5 => string '2025-05-22' (length=10)
//   'salaire' => float 50
//   6 => float 50

// FETCH_OBJ : Pour récupérer non pas un array mais un objet ! Avec les propriétés aux noms des colonnes du résultat
// $data = $stmt->fetch(PDO::FETCH_OBJ);
// var_dump($data);

// En fonction du mode de fetch choisi, on manipulera la donnée différemment en rapport aux index différents
echo $data["prenom"] . "<hr>";
// echo $data[1];
// echo $data->prenom;

echo "<h2>04 - Requêtes de sélection pour plusieurs lignes de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes");
echo "Nombre d'employés : " . $stmt->rowCount() . "<hr>";

// Une ligne traitée avec fetch, n'existe plus dans la réponse ! C'est pour ça que à chaque fois qu'on lance fetch, on passe à la ligne suivante.

// Pour traiter l'entièreté du résultat, alors, je peux faire une boucle sur l'appel de fetch

// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);

// fetch() me retourne false lorsqu'il n'y a plus de résultats
// La boucle while est donc la plus adaptée, on mettra l'instruction fetch à l'intérieur de la condition du while, fetch retourne false quand il n'y a plus de résultats donc la boucle s'arrête 

// while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($ligne);
//     echo "<hr>";
// }

// Ici des petites zones bleues en CSS
echo '<div style="display:flex; flex-wrap: wrap; justify-content: space-between">';
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <div style="margin-top: 20px; padding: 1%; width: 20%; background-color: steelblue; color: white">
        ID : <?= $ligne['id_employes'] ?><br>
        Prénom :<?= $ligne['prenom'] ?><br>
        Nom :<?= $ligne['nom'] ?><br>
        Service :<?= $ligne['service'] ?><br>
        Salaire :<?= $ligne['salaire'] ?><br>
        Sexe :<?= $ligne['sexe'] ?><br>
        Date embauche :<?= $ligne['date_embauche'] ?><br>
    </div>
<?php endwhile;
echo '</div><br><br>';


$stmt = $pdo->query("SELECT * FROM employes");

// Ici un tableau html à structure fixe 
echo '<style>th, td { padding: 10px; } </style>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
echo '<th>Id employes </th>';
echo '<th>Prénom </th>';
echo '<th>Nom </th>';
echo '<th>Sexe </th>';
echo '<th>Service </th>';
echo '<th>Date embauche </th>';
echo '<th>Salaire </th>';
echo '</tr>';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

echo '<hr><hr><hr>';

// Maintenant, on sait manipuler des données venant d'une BDD, libre à nous de les interpréter différemment en fonction du contexte
    // Par exemple ci dessus les petites cards bleues pour un affiche type "page d'accueil eshop présentation de produit"
        // Puis, l'affichage en tableau plutôt type dashboard/gestion en back office (cf exo gestion USER php procédural GET)


    // On va mettre en place un code qui permet de générer un tableau à la bonne taille dynamiquement pour s'adapter au nombre de colonnes de ma requête 

$stmt = $pdo->query("SELECT prenom, nom, service, salaire FROM employes");
// Il existe une méthode dans PDOStatement : columnCount()    - cela me retourne le nombre de colonnes de la requête
// Il existe aussi une méthode getColumnMeta() qui prends en param un numéro de colonne et me retourne des informations en rapport avec cette colonne
echo "Nombre de colonnes dans le résultat : " . $stmt->columnCount();
// var_dump($stmt->getColumnMeta(0));


echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
for($i = 0; $i < $stmt->columnCount(); $i++) {
    $infoColonne = $stmt->getColumnMeta($i);
    echo "<th>" . ucfirst($infoColonne["name"]) . "</th>";
}
echo '</tr>';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

echo '<hr><hr><hr>';

echo "<h2>05 - Requêtes de sélection pour plusieurs lignes de résultat avec fetchAll()</h2>";

// fetch() permet de traiter une seule ligne à la fois
// fetchAll() traite toutes les lignes en une seule fois sauf que l'on obtient un tableau à plusieurs niveaux
    // Ce sera plutôt fetchAll() qui sera préféré à l'utilisation, car lorsque l'on mettra en place une architecture MVC, nous aurons besoin de transmettre tous les résultats sous forme d'une seule variable 


$stmt = $pdo->query("SELECT * FROM employes");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($data);
// array (size=24)
//   0 => 
//     array (size=7)
//       'id_employes' => int 350
//       'prenom' => string 'Jean-pierre' (length=11)
//       'nom' => string 'Laborde' (length=7)
//       'sexe' => string 'm' (length=1)
//       'service' => string 'direction' (length=9)
//       'date_embauche' => string '2010-12-09' (length=10)
//       'salaire' => float 5000

// La manière d'afficher les données est donc un peu différente
// Si je veux afficher le prenom Jean-Pierre ? 
echo "Premier employé de la BDD : " . $data[0]["prenom"]  . "<hr>";

//  EXERCICE : Affichez les noms et prénoms des employés dans une liste ul li 

// Le faire avec fetch 
$stmt = $pdo->query("SELECT nom, prenom FROM employes");
echo "<ul>";
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo '<li>' . $ligne["nom"] . " " . $ligne["prenom"] . "</li>";
}
echo "</ul><hr><hr><hr>";

// Le faire aussi avec fetchAll
$stmt = $pdo->query("SELECT nom, prenom FROM employes");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<ul>";
foreach($data AS $ligne){
echo '<li>' . $ligne["nom"] . " " . $ligne["prenom"] . "</li>";
}
echo "</ul>";

echo "<h2>06 - Requêtes préparées pour se protéger des injections SQL !</h2>";

// prepare() permet de sécuriser les requêtes pour éviter les injections SQL 
// Si la requête contient des informations provenant de l'utilisateur (pour mener à bien cette requête) alors OBLIGATION de faire prepare (et surtout pas query)
// Dans le doute, on préfèrera toujours utiliser prepare()

$nom = "laborde"; // Information supposée récupérée d'un formulaire. On cherche un user dont le nom serait laborde

// Première étape préparation de la requête 

// Première syntaxe possible, avec des "?" remplaçant les valeurs attendues à réinsérer au niveau du execute
// Cette syntaxe bien que rapide, manque de lisibilité
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = ?");
$stmt->execute([$nom]); // On fourni dans les params du execute un array qui contient les valeurs à coller à la place de nos "?" (DANS L'ORDRE)
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);

// Sur des requêtes à nombreux param, cela complexifie la lisibilité
// $stmt = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES (?,?,?,?,?,?)");
// $stmt->execute([$prenom, $nom, $sexe, $service, $salaire, $dateEmbauche]);

// On préfèrera utiliser la syntaxe avec les "tokens" "marqueurs nominatif"
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // On nomme les valeurs attendus par un mot précédé de ":"
$stmt->bindParam(":nom", $nom, PDO::PARAM_STR); // Pour chaque marqueur nominatif, on executera la fonction bindParam avec le filtre qui correspond
// En MySQL on pourra toujours envoyer nos valeurs en PARAM_STR (string), car MySQL est capable de refaire le tri des bons types à l'insertion dans la table
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);
