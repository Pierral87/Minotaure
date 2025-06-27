<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-xl">
        <a class="navbar-brand" href="index.php">Mini-site Auth</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="./register.php">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link" href="./login.php">Connexion</a></li>
                <?php else: ?>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="./logout.php">Déconnexion</a></li>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="./admin.php">Admin</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
