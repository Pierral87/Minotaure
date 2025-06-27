<?php
session_start();
require_once 'User.php';

$user = new User();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($login) || empty($password)) {
        $errors[] = "Veuillez remplir tous les champs.";
    } else {
        if ($user->login($login, $password)) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = $user->getRole();

            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Identifiant ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <div class="container login-container">
        <h1 class="title">Connexion</h1>

        <?php if ($errors): ?>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li class="error-item"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post" action="" class="form">
            <div class="form-group">
                <label for="login" class="form-label">Nom d'utilisateur ou Email :</label>
                <input type="text" id="login" name="login" class="form-input" value="<?= $login ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="form-button">Se connecter</button>
        </form>
    </div>
</body>
</html>
