<?php
require_once '../autoload.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manager = new UserManager();
    $message = $manager->register($_POST['username'], $_POST['email'], $_POST['password']);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Formulaire d'inscription</h2>

        <?= $message ?>

        <form method="post" class="card p-4 shadow">
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>

        <p class="mt-3">Déjà inscrit ? <a href="connexion.php">Connexion</a></p>
    </div>
</body>
</html>
