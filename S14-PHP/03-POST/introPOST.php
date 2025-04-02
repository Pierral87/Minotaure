<?php

// var_dump($_POST);
// var_dump($_SERVER);

/*

    Le protocole POST, tout comme GET est l'un des principaux protocole de communication client/serveur web

    Contrairement à GET qui envoie les données dans l'URL, POST les envoie dans "le corps de la requête HTTP", ce qui rend les saisies invisible et les transmet "discrètement" au serveur

    Pour pouvoir manipuler POST, il faut ajouter l'attribut method="post" dans notre balise form
    Les valeurs qui seront reçues seront les valeurs des inputs/textarea/select etc de formulaire POUR PEU QUE les attributs name soient bien renseignés dans chacun de ces éléments
    Le name se retrouvera être une key de notre array et la valeur saisie, sera la valeur rattachée à cette key

    L'outil associé à POST en PHP, c'est une superglobale $_POST, encore un tableau array ! 

    Afin de sécuriser le traitement de nos données en POST, on commencera toujours par un if $_SERVER["REQUEST_METHOD"] == "POST" pour s'assurer que l'on commence un traitement en sachant que notre formulaire est correctement manipulé

    Contextes d'utilisation de POST : 
        - Formulaire d'inscription / connexion
        - Enregistrement en BDD 
        - Telechargement de pièces jointes

    On utilisera TOUJOURS post pour les form, même si on pourrait utiliser GET, cela reste relativement rare, on préfère toujours POST

*/

$content = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["email"], $_POST["message"])) {

    // trim est une fonction qui nous permet de supprimer les espaces en début et en fin de chaine de caractères
    // Ces espaces sont souvent des saisies accidentelles et pourraient nous déranger pour la suite de l'exécution de nos app
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    $content .= "<div class='card'>
  <div class='card-header bg-primary text-white'>
    <h5>Informations reçues</h5>
  </div>
  <div class='card-body'>
    <p class='card-text'>$name</p>
    <p class='card-text'>$email</p>
    <p class='card-text'>$message</p>
  </div>
</div>";
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>
                <form action="" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                    <?= $content ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>