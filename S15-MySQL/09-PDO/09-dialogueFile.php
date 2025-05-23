<?php


/*

Plutôt que d'utiliser une BDD, on peut aussi simplement les stocker les informations dans fichier.txt s'il n'y a rien de sensible grâce aux fonctions "f"

Les données seront enregistrées dans un fichier texte sous forme de lignes, chaque ligne représentera un enregistrement avec un format : 
    pseudo|message|date
*/





$req = '';
// - 04 - Récupération des saisies du form avec controle 
if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);
    $date = date('d/m/Y à H:i:s');

    // Préparation de la ligne à insérer dans le fichier txt
    $ligne = "$pseudo|$message|$date" . PHP_EOL;

    // Ouverture d'un fichier nommé commentaires.txt, en mode "a" qui permet sa création s'il n'existe pas
    $fichier = fopen("commentaires.txt", "a");
    if ($fichier) {
        fwrite($fichier, $ligne);
        fclose($fichier);
    }



    // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
    // header('location:09-dialogue2.php');
}

// - 06 - Requete de récupération des messages dans le fichier .txt afin de les afficher dans cette page
$commentaires = [];
if (file_exists("commentaires.txt")) {
    $lignes = file('commentaires.txt');
    // var_dump($lignes);
    foreach ($lignes as $ligne) {
        // Chaque ligne étant séparées par des | cela me permet d'utiliser la fonction explode en tenant compte du séparateur | pour les transformer en array
        // var_dump(explode('|', $ligne));
        list($pseudo, $message, $date) = explode('|', $ligne);
        $commentaires[] = [
            "pseudo" => $pseudo,
            "message" => $message,
            "date" => $date
        ];
    }
}

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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>Dialogue</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">

                    <?php echo $req; // on affiche la requete pour voir les injections SQL 
                    ?>

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
                                                // echo 'il y a : <b>' . $liste_commentaire->rowCount() . '</b> messages';
                                                ?></p>
                <?php
                foreach ($commentaires as $commentaire) {
                    // - 07 - Affichage des commentaire avec un peu mise en forme
                    // while($commentaire = $liste_commentaire->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>';
                    // }

                }


                ?>


            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>