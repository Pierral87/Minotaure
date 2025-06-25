<?php 

/* 

    Exercice : Restreindre l'accès à une page uniquement un rôle prévu, le rôle admin 

    Enoncé : 
        Simulez un utilisateur connecté dans la session, prévoir un indice qui contiendra les informations de l'utilisateur notamment son rôle 
        Si l'utilisateur n'a pas le rôle admin, empéchez le d'accèder à cette page avec un message d'erreur à la place du contenu de la page


*/

session_start();

class Utilisateur {
    private string $nom;
    private string $role;

    public function __construct(string $nom, string $role) {
        $this->nom = $nom;
        $this->role = $role;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }
}

$_SESSION['utilisateur'] = new Utilisateur('Tony', 'admin');

$utilisateur = $_SESSION['utilisateur'];

if (!$utilisateur->isAdmin()) {
    echo "<h1>Accès refusé</h1>";
    echo "<p>Désolé, vous n'avez pas les droits pour accéder à cette page.</p>";
    exit;
}

echo "<h1>Hello, " . $utilisateur->getNom() . "</h1>";
echo "<p>Ceci est la super page des admins du site</p>";