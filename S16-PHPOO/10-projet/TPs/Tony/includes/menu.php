<?php
if (!isset($_SESSION)) session_start();
?>

<nav>
    <?php if (!isset($_SESSION['user'])): ?>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    <?php else: ?>
        <a href="logout.php">Déconnexion</a>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
    <?php endif; ?>
</nav>