<?php
session_start();

require_once '../config/database.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';

if (!Auth::isAdmin()) {
    $_SESSION['errors'][] = "Accès interdit.";
    header('Location: ../public/index.php');
    exit;
}


if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['errors'][] = "ID invalide.";
    header('Location: ../public/admin.php');
    exit;
}

$id = (int) $_POST['id'];


$userModel = new User($pdo);
$userModel->delete($id);

$_SESSION['success'] = "Utilisateur supprimé avec succès.";
header('Location: ../public/admin.php');
exit;
