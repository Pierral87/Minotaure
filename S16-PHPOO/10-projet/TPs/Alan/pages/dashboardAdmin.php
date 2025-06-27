<?php
session_start();
require_once '../autoload.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}
$manager = new UserManager();

if (isset($_GET['delete'])) {
    $manager->deleteUser($_GET['delete']);
    header("Location: dashboardAdmin.php");
    exit;
}

$users = $manager->getAllUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Admin</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>    
                        <th>ID</th><th>Nom</th><th>Email</th><th>Rôle</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['role'] ?></td>
                            <td>
                                <?php if ($u['id'] !== $_SESSION['user']['id']): ?>
                                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                                <?php else: ?>
                                    <span class="text-muted">Vous</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="deconnexion.php" class="btn btn-danger mt-3">Se déconnecter</a>
    </div>
</body>
</html>
