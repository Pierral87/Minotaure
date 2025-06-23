<?php 


// Getter - Setter - Construct - This 

// --- Le constructeur (__construct)
//  Le constructeur est une méthode spéciale dans une classe qui est automatiquement appelée lors de la création d'un objet à partir de cette classe. On s'en sert souvent pour initialiser les propriétés de l'objet dès sa création

// --- Le mot clé $this 
// En PHP, le mot clé $this fait référence à l'objet courant dans lequel il est utilisé. Il permet d'accèder aux propriétés et méthodes de cet objet depuis l'intérieur de la classe

// --- Les Getters 
// Un getter est une méthode public qui permet d'accéder aux propriétés d'une classe, tout en gardant les props elles mêmes protected ou private. Cela permet de mieux contrôler et sécuriser l'accès aux données

// --- Les setters 
// Un setter est une méthode publique qui permet de modifier la valeur d'une propriété private ou protected. Comme pour les getters, cela permet de valider et contrôler les changements sur les propriétés

    // On peut considérer qu'il y aura toujours une paire getter/setter pour chaque propriété de l'objet, même si aucune vérification/contrôle n'est fait dans le setter, on réfléchit à l'évolutivité de notre système, si je n'effectue un contrôle sur le setter aujourd'hui, peut être que je voudrais le mettre en place demain, cela ne changera pas mes appels setNom() getNom()



// Ici je défini une classe Utilisateur avec deux props, $nom et $email
class Utilisateur 
{
    protected $nom;
    protected $email;

    // Constructeur pour initialiser les propriétés
    public function __construct($nom, $email) {
        // Ici le __construct se lance dès que j'instancie un objet, c'est uen méthode magique, il comprend de lui même dans quel scénario il doit se lancer. Donc, dès qu'il voit une instanciation de sa classe.
        // Ensuite, libre à mois d'écrire ici tout le code que je souhaite exécuter lorsque la classe s'instancie
        // Je profite de cette "automatisation" pour initialiser directement mes props $nom et $email, pour cela je vais appeler leurs setters respectifs
        echo "<h2>Initialisation en cours d'un objet User</h2>";
        $this->setNom($nom);
        $this->setEmail($email);
    }


    // Getter pour récupérer la donnée qui a été set par le setter (généralement pour l'afficher et ou la retraiter)
    public function getNom() {
        return $this->nom;
    }


// Setter pour modifier le nom, on en profite pour appliquer quelques contrôles
    public function setNom(string $newNom) {
        if(iconv_strlen($newNom) >= 1) {
            // $this représente l'objet courant, c'est à dire l'objet en train d'être utilisé, l'objet qui lance actuellement la méthode setNom, pour nous plus bas c'est $user, donc $this se retranscrit finalement en $user
            $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas être vide" , E_USER_NOTICE);
        }
    }

    // Idem ici pour l'email, une paire getter/setter
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($newMail) {
        $this->email = $newMail;
    }
}

// Instanciation d'un objet de la classe Utilisateur


// Je viens de définir un constructeur donc je mets en commentaire les lignes suivantes, car maintenant les params sont obligatoires à l'instanciation
// $user = new Utilisateur();
// Les lignes ci dessous si mes props sont public
// $user->nom = "Pierra";
// $user->email = "pierra@mail.com";

// Les lignes ci dessous si les props sont protected, pour donner des valeurs aux props via les setter
// $user->setNom("Pierra");
// $user->setEmail("pierra@mail.com");

// Ci dessous l'instanciation en fournissant directement les params dans le new Utilisateur, ce qui permet en une seule instruction de gérer l'instanciation et l'assignation des props
$user = new Utilisateur("Pierra", "pierra@mail.com");

var_dump($user);

// $user->setNom(""); // Ici grâce au contrôle de mon setter, cette ligne ne peut pas s'exécuter et me déclenche une erreur

echo "Prenom du \$user : " . $user->getNom();
