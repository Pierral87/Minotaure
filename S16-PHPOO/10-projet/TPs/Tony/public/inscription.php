<?php
require_once '../classes/User.php';
require_once '../includes/header.php';

$message = '';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($username && $email && $password && $confirm) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Email invalide.";
        } elseif ($password !== $confirm) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            $success = $user->register($username, $email, $password);
            if ($success) {
                $message = "Inscription réussie. <a href='connexion.php'>Se connecter</a>";
            } else {
                $message = "Erreur : nom d'utilisateur ou email déjà utilisé.";
            }
        }
    } else {
        $message = "Tous les champs doivent être remplis.";
    }
}
?>


<section>
    <h2>Inscription</h2>
    
    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <form method="post">
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" id="username" name="username" required><br><br>
    
        <label for="email">Adresse email</label><br>
        <input type="email" id="email" name="email" required><br><br>
    
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" required><br><br>
    
        <label for="confirm">Confirmer le mot de passe</label><br>
        <input type="password" id="confirm" name="confirm" required><br><br>
    
        <button type="submit">S'inscrire</button>
    </form>
</section>
