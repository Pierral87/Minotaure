<?php
require_once '../classes/User.php';
require_once '../includes/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $loggedUser = $user->login($email, $password);
    if ($loggedUser) {
        $_SESSION['user'] = $loggedUser;
        header('Location: admin.php');
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
<section>
    <h2>Connexion</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Adresse email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</section>