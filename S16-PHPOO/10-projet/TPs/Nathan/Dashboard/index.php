<?php

require_once __DIR__ . '/../Utils/User.class.php';

session_start();
$user = $_SESSION['user'];
//récuperation de tous les utilisateurs
$users = User::getAllUsers();
var_dump($user);

if($user['role'] !== 'admin') {
    header('Location: ../Auth/login.php');
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteUser =User::deleteUser($id);
    if($deleteUser) {
        echo "Utilisateur supprimé";
        header('Location: index.php');
    } else {
        echo "Erreur lors de la suppression de l'utilisateur";
    }
}

?>

<h1>Dashboard</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $utilisateur): ?>
        <tr>
            <td><?= $utilisateur['id'] ?></td>
            <td><?= $utilisateur['nom'] ?></td>
            <td><?= $utilisateur['prenom'] ?></td>
            <td><?= $utilisateur['email'] ?></td>
            <?php if($user['id'] !== $utilisateur['id']): ?>
                <td>
                    <a href="index.php?id=<?= $utilisateur['id'] ?>">Supprimer</a>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table