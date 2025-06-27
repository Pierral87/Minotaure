<nav class="my-4">
   <ul class="flex gap-4">
    <?php if (isset($_SESSION['user'])): ?>
        <li><a href="deconnexion.php" class="text-blue-600 hover:underline">Déconnexion</a></li>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <li><a href="admin.php" class="text-blue-600 hover:underline">Administration</a></li>
        <?php endif; ?>
    <?php else: ?>
        <li><a href="inscription.php" class="text-blue-600 hover:underline">Inscription</a></li>
        <li><a href="connexion.php" class="text-blue-600 hover:underline">Connexion</a></li>
    <?php endif; ?>
</ul>
</nav>
