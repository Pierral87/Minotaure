<?php
session_start();
require_once '../includes/header.php';
?>


<section>
    <h2>Bienvenue</h2>
    
    <?php if (!isset($_SESSION['user'])): ?>
        <p><a href="inscription.php">S'inscrire</a></p>
        <p><a href="connexion.php">Se connecter</a></p>
    <?php else: ?>
        <p>Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong></p>
        <p><a href="logout.php">Se déconnecter</a></p>
    
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <p><a href="admin.php">Accès admin</a></p>
        <?php endif; ?>
    <?php endif; ?>
</section>

