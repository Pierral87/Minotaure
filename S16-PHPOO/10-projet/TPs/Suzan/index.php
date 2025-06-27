<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <link rel="stylesheet" href="styles/index.css?v=1">
</head>
<body>
    <header class="header">
        <h1 class="header__title">My App</h1>
    </header>

    <nav class="navbar">
        <ul class="navbar__list">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="navbar__item"><span class="navbar__username"><?= $_SESSION['username'] ?></span></li>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li class="navbar__item"><a href="Admin.php" class="navbar__link">Admin</a></li>
                <?php endif; ?>
                <li class="navbar__item"><a href="Logout.php" class="navbar__link">Déconnexion</a></li>
            <?php else: ?>
                <li class="navbar__item"><a href="register.php" class="navbar__link">Inscription</a></li>
                <li class="navbar__item"><a href="login.php" class="navbar__link">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
