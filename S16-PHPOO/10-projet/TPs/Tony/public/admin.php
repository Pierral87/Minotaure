<?php
session_start();
require_once '../includes/header.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';
Auth::requireAdmin();

$user = new User();
$users = $user->getAllUsers();

if (isset($_GET['delete'])) {
    $user->deleteUser($_GET['delete']);
    header("Location: admin.php");
    exit;
}
?>

<section>
    <div>
        <h2>Panneau d'administration</h2>
        <p>Bienvenue <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
    </div>

    <div class="main">
        <h2>Utilisateurs inscrits</h2>
        <ul>
            <?php foreach ($users as $u): ?>
                <li>
                    <?= htmlspecialchars($u['username']) ?> - <?= $u['email'] ?> (<?= $u['role'] ?>)
                    <?php if ($u['id'] != $_SESSION['user']['id']): ?>
                        <a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
