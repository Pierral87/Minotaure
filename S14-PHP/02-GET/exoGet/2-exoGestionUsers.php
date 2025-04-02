<?php
// require_once("_config.php");

session_start();

/* 

    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
                4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
                5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
                6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/

$_SESSION["users"] = [
    ["id" => 1, "prenom" => "David", "nom" => "flemme", "email" => "lebg@david.fr"],
    ["id" => 2, "prenom" => "Dave", "nom" => "flemme", "email" => "lebg@dav.fr"],
    ["id" => 3, "prenom" => "Dive", "nom" => "flemme", "email" => "lebg@dive.fr"],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Utilisateur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $users = $_SESSION['users'];
                    foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['prenom'] . " " . $user['nom']?></td>
                            <td>
                                <a class="btn btn-primary" href='2-exoGestionUsers-voir.php?id=<?php echo $user["id"]?>'>Voir</a>
                                <a class="btn btn-warning">Modifier</a>
                                <a class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>