<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon site</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Minotaure/S16-PHPOO/10-projet/projet/css/style.css">

</head>
<body>

<header>
    <div class="container">
        <h1>Site</h1>

        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>

                <?php if (!isset($_SESSION['user'])): ?>
                    <li><a href="inscription.php">S'inscrire</a></li>
                    <li><a href="connexion.php">Se connecter</a></li>
                <?php else: ?>
                    <li>Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <li><a href="admin.php">Espace Admin</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<hr>
