<?php
session_start();
require_once 'User.php';

$user = new User();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    if (empty($errors)) {
        if ($user->register($username, $email, $password)) {
            $success = true;
        } else {
            $errors[] = "Nom d'utilisateur ou email déjà utilisé.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/register.css">
    <title>Inscription</title>
</head>
<body class="body">
    <div class="container">
        <h1 class="title">Inscription</h1>
        <?php if ($success): ?>
            <p class="success-message">
                Inscription réussie. Vous pouvez maintenant <a href="Login.php" class="link">vous connecter</a>.
            </p>
        <?php else: ?>
            <?php if ($errors): ?>
                <ul class="error-list">
                    <?php foreach ($errors as $error): ?>
                        <li class="error-item"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form method="post" action="" class="form">
                <div class="form-group">
                    <label for="username" class="form-label">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" value="<?= $username ?? '' ?>" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" id="email" name="email" value="<?= $email ?? '' ?>" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                <button type="submit" class="form-button">S'inscrire</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
