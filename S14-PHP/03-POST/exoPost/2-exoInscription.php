<?php

/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, crypter le mot de passe avec password_hash et l'insérer dans  $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies

*/ 



session_start();
// session_destroy();

// Simulation de la "base de données" en tableau dans $_SESSION
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    // Contrôles de validation
    if (empty($pseudo)) {
        $errors[] = "Le pseudo est requis.";
    }

    if (!$email) {
        $errors[] = "L'email n'est pas valide.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit faire au moins 6 caractères.";
    }

    if ($password !== $passwordConfirm) {
        $errors[] = "Les mots de passe ne se correspondent pas.";
    }

    // Vérifier si l'utilisateur existe déjà
    foreach ($_SESSION['users'] as $user) {
        if ($user['pseudo'] === $pseudo) {
            $errors[] = "Le pseudo est déjà pris.";
            break;
        }
    }

    // Si pas d'erreurs, on enregistre l'utilisateur
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['users'][] = ['pseudo' => $pseudo, 'email' => $email, 'password' => $hashedPassword];
        $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Inscription</h1>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <?php 
            echo "<pre>";
            print_r($_SESSION["users"]);
            echo "</pre>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>