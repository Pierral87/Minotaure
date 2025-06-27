<?php
session_start();

require_once '../config/database.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';
require_once '../classes/Validator.php';

$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

$errors = [];

// Validation
if (!Validator::notEmpty($email, $mot_de_passe)) {
    $errors[] = "Tous les champs sont obligatoires.";
}

if (!Validator::isEmail($email)) {
    $errors[] = "Email invalide.";
}

if (empty($errors)) {
    $userModel = new User($pdo);
    $user = $userModel->findByEmail($email);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        Auth::login($user);
        $_SESSION['success'] = "Connexion réussie.";
        header('Location: ../public/index.php');
        exit;
    } else {
        $errors[] = "Identifiants incorrects.";
    }
}

$_SESSION['errors'] = $errors;
header('Location: ../public/connexion.php');
exit;
