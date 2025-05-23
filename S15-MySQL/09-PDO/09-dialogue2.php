<?php

// Pour éviter les injections XSS (du code CSS/JS dans les commentaires)
// Il est possible d'utiliser des fonctions permettant d'échapper les caractères pour qu'ils ne soient pas interprétés, notamment les tags "<" ">"
// Par exemple htmlspecialchars(), htmlentities(), strip_tags()
// Exemple d'injection css et js : 
    // <style>body{display:none}</style>
    // <script>while(true){alert(achetez notre antivirus!);}</script>

// Pour se protéger des injections SQL, on utilisera toujours prepare() pour nos requêtes, si on utilise query on est sensible aux injections !
// Notre formulaire se transforme donc en une console sql libre d'accès 
// Quelques injections problematiques pour nous 

    // Pour injecter depuis le champ message, il faut d'abord cloturer la requête pour ensuite lancer la requête de notre choix
     // ', NOW()); DELETE FROM commentaire;   // là on comprends qu'on peut injecter et que nous avons pas mal de droits ! 
     // ', NOW()); TRUNCATE commentaire; // là je comprends que j'ai des droits de structure ! 
     // ', NOW()); DROP DATABASE dialogue; // Si j'ai réussi à trouver le nom de la bdd...
     // ', NOW()); SELECT DATABASE() INTO OUTFILE 'c:/wamp64/tmp/fichierhack.txt';   // Me permet de récupérer le nom de la base et l'insérer dans un fichier .txt si j'ai les droits "FILE"
     // ', NOW()); INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ("coucou", LOAD_FILE('c:/wamp64/tmp/fichierhack.txt)), NOW()); // Là j'insère dans la table commentaire, le contenu du fichier .txt au préalablement récupéré, ce qui me permet de visualiser son contenu ! 
     // ', NOW()); DO SLEEP(10);  // Si les messages d'erreur PDO sont désactivés, je suis quand même capable de comprendre si mon form est sensible aux injections en intégrant une commande DO SLEEP(), si ma page charge pendant autant de seconde que je l'ai spécifié, alors mon DO SLEEP a été interprété = sensible aux injections !! 

     // Lorsqu'un formulaire est sensible aux injections c'est l'entièreté de ma base qui est compromise ! Aussi bien pour des actions malveillante type suppression/drop etc, que pour du vol de données ! (On pourrait récupérer la liste de nos utilisateurs, de nos produits, de nos commandes, d'autres informations privées)







/*
EXERCICE :
-----------
- Création d'un espace de dialogue / de tchat

- 01 - Création de la BDD : dialogue
     -  Table : commentaire
     - Champs de la table commentaire :
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME
        
- 02 - Créer une connexion à cette base avec PDO
- 03 - Création d'un formulaire html permettant de poster un message
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation
- 04 - Récupération des saisies du form avec controle 
- 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
- 06 - Requete de récupération des messages afin de les afficher dans cette page
- 07 - Affichage des messages avec un peu mise en forme
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date en français
- 10 - Amélioration du css
*/

// 02 - Créer une connexion à cette base avec PDO
$host = 'mysql:host=localhost;dbname=dialogue'; 
$login = 'root'; // login
$password = ''; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
    // PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
    // PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT, 
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
);
$pdo = new PDO($host, $login, $password, $options);


$req = '';
// - 04 - Récupération des saisies du form avec controle 
if( isset($_POST['pseudo']) && isset($_POST['message']) ) {
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);

    // - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
    $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
    // LA LIGNE CI DESSOUS LANCE LA REQUETE EN QUERY POUR TESTER LES INJECTIONS
    // $enregistrement = $pdo->query($req);


    // CI DESSOUS ON LANCE LA REQUETE EN PREPARE POUR SE PROTEGER DES INJECTIONS
    // Pour éviter les injections SQL il faut privilégier prepare() car $pseudo et $message viennent du formulaire et pourrait contenir du code malveillant.
    // Avec prepare les injections ne sont pas possibles.
    $enregistrement = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
    $enregistrement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $enregistrement->bindParam(':message', $message, PDO::PARAM_STR);
    $enregistrement->execute();

    // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
    // header('location:09-dialogue2.php');
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$liste_commentaire = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!-- Google font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Playfair display -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <!-- Roboto -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            * {
                font-family: 'Roboto', sans-serif;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif;
            }
        </style>

        <title>Dialogue</title>
    </head>
    <body class="bg-secondary" >
        <div class="container bg-light g-0">
            <div class='row '>
                <div class="col-12">
                    <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                    <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">
                        
                        <?php echo $req; // on affiche la requete pour voir les injections SQL ?>
                    
                        <hr>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                        <div class="mb-3">
                            <hr>
                            <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class='row mt-5'> 
                <div class="col-12">               
                    <!-- Affichage des commentaire -->
                    <p class="w-75 mx-auto mb-3"><?php
                        // - 08 - Affichage en haut des messages du nombre de message présent dans la bdd
                        echo 'il y a : <b>' . $liste_commentaire->rowCount() . '</b> messages';
                    ?></p>
                    <?php 
                        // - 07 - Affichage des commentaire avec un peu mise en forme
                        while($commentaire = $liste_commentaire->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date_fr'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>';
                        }
                    
                    
                    ?>
                
                    
                </div>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>