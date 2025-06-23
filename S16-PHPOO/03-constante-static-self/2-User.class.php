<?php 

// A quoi ça nous sert le static ?
// Par exemple à stocker des constantes en rapport avec des valeurs de traitement
// Ici avec une classe User, je vais stocker dans des constantes les "appelations" des rôles de mon site web, admin, user etc

// Le fait de les gérer dans les gérer permet d'éviter de se tromper 

class User {

    // Les autres dev vont devoir respecter les appels des rôles utilisateurs via ces constantes 
    const ROLE_ADMIN = "admin";
    const ROLE_EDITOR = "editor";
    const ROLE_USER = "user";

    protected $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }
}

$user = new User(User::ROLE_USER);
echo $user->isAdmin() ? "Cet utilisateur est admin" :  "Cet utilisateur n'est pas admin";