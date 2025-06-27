<?php

namespace ProjetAdmin\Controller;

use Exception;
use ProjetAdmin\Model\UserModel;

// Ici, je vais commencer à définir mon UserController
// Controller car c'est notre élément "principal" de notre architecture, c'est lui qui va comprendre les scénarios utilisateur, c'est à dire tous les flux d'entrées dans notre appli pour un contexte ou un autre

// On va toujours définir un controller indépendant pour une entité, ici on développpe donc le Controller en rapport avec la manipulation de l'entité User
class UserController
{

    // La prop ci dessous va contenir un objet de type Model, pour nous UserModel, c'est l'élément qui va nous permettre d'aller piocher dans la BDD
    protected $model;

    public function __construct()
    {
        // echo "<h2>Initialisation du Controller UserController</h2>";

        // Dès l'instanciation de notre Controller, on lui associe son Model
        $this->model = new UserModel();
    }

    // Ici la méthode qui va nous permettre de comprendre les flux de l'utilisateur, c'est à dire, les différents cas d'accès pour lesquels on demandera des data différentes et des vues différentes

    // Ici je vais dev la méthode render qui me permet de gérer l'affichage de mes vues, le but de cette méthode est d'être capable de mixer un "layout" ce qu'on considère être une structure/squelette de site web couplé à un "template" que l'on considère être l'agencement du contenu de la page à l'intérieur du layout ainsi que de la data à afficher sur cette page, on va transmettre ça sous forme de param 

    public function render($layout, $template, $parameters = array())
    {
        // extract() me permet de transformer les clés d'un array en variable, qui auront pour valeur la valeur associée dans le array
        extract($parameters);

        ob_start(); // On démarre ici une mise en tampon pour mettre "en attente" l'affichage à l'utilisateur, cette mise en mémoire en tampon va me permettre de modéliser la page en plusieurs étapes avant de la "libérer" pour l'utilisateur 

        // Ici je fais un require du "template" c'est à dire le corps de ma page, il va se préchargé
        require_once "src/View/$template";

        // Ici ob_get_clean() me permet de supprimer la mémoire tampon et d'insérer l'intégralité de son contenu (à savoir, le template require ci dessus), dans la variable $content
        // A ce niveau là, $content contient un morceau de page entière
        $content = ob_get_clean();

        ob_start();
        // Ici je fais un require_once de mon layout, le but étant de faire un echo du $content créé précédemment pour insérer le contenu de la page à l'intérieur du layout
        require_once "src/View/$layout";

        // l'opération flush me permet de libérer la mémoire tampon et de générer l'affichage pour l'utilisateur 
        return ob_end_flush();
    }

    public function handleRequest()
    {

        // Ici je me base sur ce qui se trouve dans l'url pour comprendre quelle est l'opération demandée par l'utilisateur
        // On va tester la bonne réaction de notre handleRequest en manipulant le param op dans notre URL
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
        } else {
            $op = null;
        }

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = null;
        }

        try {
            // Ici les différents cas possible de scénars utilisateurs

            // Si l'utilisateur demande un ajout d'un utilisateur
            if ($op == "add") {
                $this->add();
            } elseif ($op == "select") { // Si on veut select un seul user
                $this->select($id);
            } elseif ($op == "delete") { // Si on veut delete un user
                $this->delete();
            } elseif ($op == "update") { // Si on veut update un user
                $this->update();
            } else { // Sinon, cas par défaut, on affiche tous les users
                $this->selectAll();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    // Si je tombe ici, cas par défaut de l'arrivée sur l'index en appelant le UserController, c'est que le Controller a décidé qu'il souhaite afficher tous les users à l'utilisateur, pour ça je vais avoir besoin de faire plusieurs actions, notamment la récupération des enregistrements de la bdd 
    public function selectAll()
    {
        // echo "<h3>COUCOU Je suis la méthode par défaut d'arrivée sur le UserController, je suis selectAll()</h3>";
        $users = $this->model->modelSelectAll();

        // require_once("src/View/ListUsers.php");
        // var_dump($users);

        $this->render("layout.php", "ListUsers.php", [
            "title" => "Liste des utilisateurs",
            "users" => $users
        ]);
    }

    public function select($id) {
        $user = $this->model->modelSelectOne($id);
        // var_dump($user);

        $this->render("layout.php", "OneUser.php", [
            "title" => "Affichage du user n° $id",
            "user" => $user
        ]);
    }
    
}
