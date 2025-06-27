<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: pages/dashboardAdmin.php");
        exit;
    } else {
        header("Location: pages/dashboard.php");
        exit;
    }
}

?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h1 class="mb-4">Bienvenue</h1>
            <a href="connexion.php" class="btn btn-primary me-2">Connexion</a>
            <a href="inscription.php" class="btn btn-secondary">Inscription</a>
    </div>
</body> 
</html>
