<?php
session_start();

$users = $_SESSION["users"];
$getUser = [];
$id = $_GET["id"];

foreach ($users as $user) {
    if ($user['id'] == $id) {
        $getUser = $user;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Utilisateur</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $getUser['prenom']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $getUser['nom']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $getUser['email']; ?></td>
                </tr>
                <tr>
                    <td>
                        <a class="btn btn-warning">Modifier</a>
                        <a class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>