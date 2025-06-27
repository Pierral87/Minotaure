<?php
session_start();
require_once 'config/database.php';
require_once 'processor/UserManager.php';
require_once 'components/menu.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Accès réservé aux administrateurs.</div></div>";
    exit;
}

$pdo = Database::connect();
$userManager = new UserManager($pdo);

if (isset($_GET['delete'])) {
    $userManager->delete((int)$_GET['delete']);
    header('Location: admin.php');
    exit;
}

$users = $userManager->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="card-title">Gestion des utilisateurs</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user->getId() ?></td>
                                        <td><?= htmlspecialchars($user->getUsername()) ?></td>
                                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                                        <td>
                                            <span class="badge <?= $user->getRole() === 'admin' ? 'bg-green' : 'bg-gray' ?>" style="color: white;">
                                                <?= $user->getRole() ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($user->getId() !== $_SESSION['user']['id']): ?>
                                                <a href="?delete=<?= $user->getId() ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Supprimer cet utilisateur ?')">
                                                    Supprimer
                                                </a>
                                            <?php else: ?>
                                                <span>-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
