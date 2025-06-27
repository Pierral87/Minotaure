<?php
require_once 'config/database.php';
require_once 'entity/Userr.php';
require_once 'processor/UserManager.php';
require_once 'components/menu.php';

$pdo = Database::connect();
$userManager = new UserManager($pdo);

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new Userr();
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->getRole('user');

    if (empty($user->getUsername()) || empty($user->getEmail()) || empty($user->getPassword())) {
        $error = "Tous les champs sont requis.";
    } elseif (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } else {
        if ($userManager->register($user)) {
            $success = "Inscription réussie. <a href='login.php'>Se connecter</a>";
        } else {
            $error = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
    <div class="page-wrapper d-flex flex-column justify-center align-items-center min-vh-100">
        <div class="container-sm mt-5" style="max-width: 500px;">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="card-title">Inscription</h2>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>