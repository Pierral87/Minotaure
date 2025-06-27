<?php
session_start();
require_once 'User.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo "Accès refusé.";
    exit;
}

$user = new User();

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: admin.php');
    exit;
}

$pdo = Config::getPDO();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id' => $id]);
$editUser = $stmt->fetch();

if (!$editUser) {
    header('Location: Admin.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'user';

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Nom d'utilisateur invalide.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }
    if (!in_array($role, ['user', 'admin'])) {
        $errors[] = "Rôle invalide.";
    }

    if (empty($errors)) {
        $user->updateUser($id, $username, $email, $role);
        header('Location: admin.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier utilisateur</title>
    <link rel="stylesheet" href="styles/edit.css">
</head>
<body>

<div class="edit-container">

    <h1 class="edit-title">Modifier utilisateur</h1>

    <?php if ($errors): ?>
        <ul class="edit-error-list">
            <?php foreach ($errors as $error): ?>
                <li class="edit-error-item"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="edit-form">
        <div class="edit-form-group">
            <label for="username" class="edit-form-label">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" 
                   value="<?= $_POST['username'] ?? $editUser['username'] ?>" 
                   required class="edit-form-input">
        </div>

        <div class="edit-form-group">
            <label for="email" class="edit-form-label">Email :</label>
            <input type="email" id="email" name="email" 
                   value="<?= $_POST['email'] ?? $editUser['email'] ?>" 
                   required class="edit-form-input">
        </div>

        <div class="edit-form-group">
            <label for="role" class="edit-form-label">Rôle :</label>
            <select name="role" id="role" class="edit-form-input">
                <option value="user" <?= (($editUser['role'] ?? '') === 'user') ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= (($editUser['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="edit-form-button">Enregistrer</button>
    </form>

    <p><a href="Admin.php" class="edit-link-return">Retour à la gestion des utilisateurs</a></p>
</div>

</body>
</html>
