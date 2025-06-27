<?php

require_once __DIR__ . '/../Utils/user.class.php';

// formulaire de création d'un utilisateur
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = new User($nom, $prenom, $email, $password);
    $insertUser = $user->insertUser();

    //gere l'erreur de mail deja existant
    if($insertUser == "UIS002") {
        echo "Erreur : UIS002";
    } else if($insertUser == "UIS001") {
        echo "Erreur : UIS001";
    } else {
        echo "Utilisateur créé";
    }
}
?>
<h1>Inscription</h1>

<form action="register.php" method="post">
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prénom">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="submit" value="Créer">
</form>
