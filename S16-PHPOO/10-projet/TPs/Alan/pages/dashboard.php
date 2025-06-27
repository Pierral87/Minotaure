<?php
session_start();
require_once '../autoload.php';

if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit;
}
if ($_SESSION['user']['role'] === 'admin') {
    header("Location: dashboardAdmin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-info">
            Bienvenue <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong><br>
            Vous êtes connecté en tant qu'utilisateur.
        </div>
        <a href="deconnexion.php" class="btn btn-danger">Se déconnecter</a>
    </div>
</body>
</html>
