<?php 

/* 

$_FILES est une superglobale de PHP ! Encore un array ! 

Elle est utilisée pour récupérer les informations sur les pièces jointes envoyées par un formulaire HTML !  

ATTENTION, un nouvel attribut est à ajouter au formulaire sinon on ne récupèrera rien du tout ! 
l'attribut :  enctype="multipart/form-data"  dans notre balise form 

On traitera ainsi les input type="file"

Egalement, un input type="file" n'est pas visible dans le $_POST mais uniquement dans le $_FILES 

On retrouvera plusieurs informations importantes visible dans un var_dump ou print_r, notamment, le nom du fichier envoyé et surtout le "tmp_name" qui nous indique le chemin physique vers le fichier temporaire représentant cet envoi sur le serveur ! Ce fichier temporaire disparait à la fin de l'exécution de la page, si je ne le traite pas immédiatement, il est perdu.

"error" qui représente un int en rapport avec un code d'erreur sur l'exécution de l'upload



*/

var_dump($_POST);
var_dump($_FILES);

// Si je souhaite uploader une image, j'aurai plusieurs vérifications à faire 
// var_dump(__DIR__); // On pourrait travailler en lien absolu pour le chemin d'accès au dossier upload grâce à la constante magique __DIR__ qui nous le chemin d'accès physique au dossier en cours 
$uploadDir = "upload/";
$uploadMessage = "";

// Extensions de fichier autorisées
$allowedExtensions = ["jpg", "jpeg", "png", "gif"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["fichier"]["tmp_name"]; // Ici je récupère le chemin vers le fichier temporaire
        $fileName = basename($_FILES["fichier"]["name"]); // Ici je récupère uniquement le nom du fichier 
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Ici je récupère uniquement l'extension du fichier 

        // Est ce que l'extension du fichier correspond aux extensions autorisées 
        if (in_array($fileExtension, $allowedExtensions)) {
            $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName); // Ici je filtre le nom du fichier en remplaçant tous les caractères problématiques par des "_" 
            $fileName = strtolower(pathinfo($fileName, PATHINFO_FILENAME)); // là je mets le nom tout en minuscule et j'extrait uniquement le nom du fichier (je n'ai plus l'extension)

            // On ajoute un id unique devant le nom du fichier pour éviter les doublons de nom à l'upload et on reforme la totalité du nom du fichier avec aussi l'extension 
            $fileName = uniqid() . "_" . $fileName . "." . $fileExtension;

            $destPath = $uploadDir . $fileName; 

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $uploadMessage = "<div class='alert alert-success'>Fichier envoyé avec succès !</div>";
            } else {
                $uploadMessage = "<div class='alert alert-danger'>Erreur lors de l'envoi du fichier.</div>";
            }
        } else {
            $uploadMessage = "<div class='alert alert-danger'>Désolé extensions non autorisée !</div>";
        }

    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Upload de fichier</h1>

                <?= $uploadMessage ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Sélectionnez un fichier à télécharger</label>
                        <input type="file" class="form-control" id="fichier" name="fichier">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
