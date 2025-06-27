<?php

require_once __DIR__ . '/../Utils/User.class.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = User::login($email, $password);

    if(is_array($user)) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: ../Dashboard/index.php');
        exit();
    } else if($user == "ULG001") {
        echo "Error : ULG001";
    } else {
        echo "Erreur lors de la connexion";
    }
}

?>

<h1>Connexion</h1>

<form action="login.php" method="post">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="submit" value="Connexion">
</form>
