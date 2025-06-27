<?php
session_start();
require_once 'config/database.php';
require_once 'processor/UserManager.php';
require_once 'components/menu.php';

$pdo = Database::connect();
$userManager = new UserManager($pdo);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $userManager->findByEmail($email);

    if ($user && password_verify($password, $user->getPassword())) {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
    <div class="page-wrapper d-flex flex-column justify-center align-items-center min-vh-100">
        <div class="container-sm mt-5" style="max-width: 500px;">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="card-title">Connexion</h2>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>