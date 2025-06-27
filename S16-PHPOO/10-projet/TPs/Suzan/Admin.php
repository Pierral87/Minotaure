<?php
session_start();
require_once 'User.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo "Accès refusé.";
    exit;
}

$user = new User();

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $idToDelete = (int)$_GET['delete'];

    if ($idToDelete === $_SESSION['user_id']) {
        echo "Vous ne pouvez pas supprimer votre propre compte.";
    } else {
        $user->deleteUserById($idToDelete);
        header('Location: Admin.php');
        exit;
    }
}

$users = $user->getAllUsers();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin - Gestion des utilisateurs</title>
</head>
<body>
    <div class="container admin-container">
        <h1 class="title">Admin - Gestion des utilisateurs</h1>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
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
                        <a href="Edit.php?id=<?= $u['id'] ?>" class="link edit-link">Modifier</a> | 
                        <a href="Admin.php?delete=<?= $u['id'] ?>" class="link delete-link" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <p><a href="index.php" class="link return-link">Retour à l'accueil</a></p>
    </div>
</body>
</html>
