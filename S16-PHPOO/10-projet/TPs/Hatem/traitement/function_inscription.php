<?php
session_start();

require_once '../config/database.php';
require_once '../classes/User.php';
require_once '../classes/Validator.php';

// Sécurisation des entrées
$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';
$role = $_POST['role'] ?? 'user';

$errors = [];

// Validation
if (!Validator::notEmpty($nom, $email, $mot_de_passe)) {
    $errors[] = "Tous les champs sont obligatoires.";
}

if (!Validator::isEmail($email)) {
    $errors[] = "Email invalide.";
}

if (!Validator::isPasswordStrong($mot_de_passe)) {
    $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
}

if (empty($errors)) {
    $user = new User($pdo);

    // Vérifie si l'utilisateur existe déjà
    if ($user->findByEmail($email)) {
        $errors[] = "Un utilisateur avec cet email existe déjà.";
    } else {
        $created = $user->create($nom, $email, $mot_de_passe, $role);

        if ($created) {
            $_SESSION['success'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
            header('Location: ../public/connexion.php');
            exit;
        } else {
            $errors[] = "Erreur lors de l'inscription.";
        }
    }
}

$_SESSION['errors'] = $errors;
header('Location: ../public/inscription.php');
exit;
