<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrainement PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Entrainement Syntaxe PHP</h2>

        <!-- 
            Il est possible d'écrire de l'HTML dans un fichier.php 
            En revanche, l'inverse n'est pas possible !
        -->

        <?php
        // Balise d'ouverture PHP 

        // Si je suis à l'intérieur d'un fichier .html les lignes suivantes ne sont pas interprétées !
        // Car je passe par l'interpréteur PHP uniquement si le fichier est un .php, dans le cash d'un .html, la page est directement renvoyée à l'utilisateur
        echo "<h3>Coucou, test</h3>";
        echo "salut";

        // Ceci est un commentaire sur une seule ligne
        # Ceci est un commentaire sur une seule ligne
        /* 
            Commentaires sur plusieurs 
            lignes (entre les deux indicateurs)
        */

        // La doc officielle : 
        // https://www.php.net/

        // Les bonnes pratiques et conventions d'écriture 
        // https://phptherightway.com // en anglais 
        // https://eilgin.github.io/php-the-right-way/  // en fr


        echo "<h2>01 - Instructions d'affichage</h2>";

        // echo est une instruction d'affichage du langage PHP, elle me permet de générer un affichage à l'écran de l'utilisateur (de renvoyer en gros une sortie html)

        // En PHP on oublie pas, chaque instruction se termine par un ; 
        echo "Bonjour";
        echo " à tous";
        echo "<br>";

        print "Nous sommes mardi<br>"; // Autre instruction permettant de générer un affichage, quasiment similaire à echo, seule différence sur ses possibilités face à la concaténation

        echo "<h2>02 - Variables : déclaration / affectation / type</h2>";
        // Une variable est un espace nommé permettant de conserver une valeur
        // Une variable se déclare avec le signe $ 
        // Caractères autorisés : a-z A-Z 0-9 _ 
        // PHP est sensible à la casse (une minuscule n'est pas équivalente à une majuscule)
        // Un nom de variable ne peut pas commencer par un chiffre 

        // gettype() est une fonction prédéfinie permettant de nous renvoyer une chaine de caractère représentant le type d'une variable.

        // On nommera toujours nos variables en suivant la convention de nommage : 
        // camelCase, c'est à dire, on commence par une minuscule et on met des majuscules à chaque nouveau "mot" de la variable par exemple $maVariable   $uneSuperVariable 

        // D'autres conventions de nommage :
        // snake_case, en séparant les mots par des underscore $ma_variable,  $ma_super_variable
        // kebab-case, en séparant les mots par des tirets $ma-variable, $ma-super-variable
        // PascalCase, chaque mot commence par une majuscule $MaVariable, $MaSuperVariable (les noms des classes en PHP)
        // UPPERCASE, tout en majuscule (pour les noms des constantes en PHP)

        $a = 123; // Déclaration d'une variable "a" contenant la valeur 123
        echo $a;
        echo gettype($a); // ici un entier = un integer
        echo "<br>";

        $a = 1.5;  // On change la valeur contenue dans la variable $a (opération autorisée par PHP)
        echo $a;
        echo gettype($a); // ici un float ou double en php ! 
        echo "<br>";

        $a = "Une chaine";
        echo $a;
        echo gettype($a);
        echo "<br>";

        $a = false;
        echo $a; // Nous renvoie 1 car true = 1 = existe     (les booléen ne sont pas sensibles à la casse true = TRUE, false = FALSE)
        echo gettype($a); // Ici un type booléen 
        // var_dump($a); // dans le cas d'une variable false, cela n'affiche rien, mais je peux la vérifier avec un var_dump
        echo "<br>";

        // Il existe deux autres types, les array et les objets que nous verrons plus tard 

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des string (sous forme de texte ou comprise dans des variables) les uns avec les autres
        // Le caractère de concaténation en PHP : le point   "."     (mais il est aussi possible de concaténer avec la virgule "," )

        // Le caractère de concaténation peut toujours se traduire par "suivi de"

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concaténation
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation
        echo $x . " " . $y . "<br>";

        // Avec la virgule
        echo $x, " ", $y, "<br>";

        // Concaténation lors de l'affectation
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Cela écrase la valeur précédente 
        echo $prenom . "<br>";

        // Pour rajouter sans écraser :
        $prenom2 = "Pierre";
        $prenom2 = $prenom2 . "-Alexandre";
        echo $prenom2;
        // Raccourci d'écriture 
        $prenom3 = "Pierre";
        $prenom3 .= "-Alexandre"; // Avec le .= on rajoute sans écraser 

        // On utilise très régulièrement cette instruction .= en PHP ! 

        echo $prenom3;

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Dans des guillemets, une variable est reconnue et donc sera interprétée
        // Dans des apostrophes, une variable ne sera pas reconnue et donc traitée comme un string (le nom de la variable)

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // Une constante comme une variable permet de conserver une valeur.
        // En revanche comme son nom l'indique, cette valeur restera constante ! On ne pourra plus la modifier dans le code 
        // Par convention d'écriture, une constante s'écrit tout en MAJUSCULE

        define("URL", "http://www.monsite.fr");
        echo URL . "<br>";

        // URL = "autre chose"; // Parse error
        // define("URL", "autre chose"); // Warning, URL déjà définie !

        // Constantes magiques 
        // Déjà inscrites au langage 
        // /!\ deux underscores avant et après 

        echo __FILE__ . "<br>";
        echo __LINE__ . "<br>";
        echo __DIR__ . "<br>";

        echo "<h2>Exercice variables</h2>";
        // Créer 3 variables, l'une contient la valeur "bleu", l'autre "blanc", l'autre "rouge"
        // Il faut ensuite gérer un affichage avec un seul echo pour obtenir : bleu - blanc - rouge 

        $a = "bleu";
        $b = "blanc";
        $c = "rouge";

        echo $a . " - " . $b . " - " . $c . "<br>";

        echo "$a - $b - $c <br>";

        echo "<h2>06 - Opérations arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition : 
        echo $a + $b  . "<br>"; // Affiche 15
        // Soustraction : 
        echo $a - $b  . "<br>"; // Affiche 5
        // Multiplication : 
        echo $a * $b  . "<br>"; // Affiche 50       
        // Division : 
        echo $a / $b  . "<br>"; // Affiche 2
        // Modulo : (le restant de la division en terme d'entier)
        echo $a % $b  . "<br>"; // Affiche 0
        // Puissance :
        echo $a ** $b . "<br>"; // Affiche 100 000

        // Opération / affectation 
        $a += $b; // Equivaut à écrire $a = $a + $b;
        $a -= $b; // Equivaut à écrire $a = $a - $b;
        $a *= $b; // Equivaut à écrire $a = $a * $b;
        $a /= $b; // Equivaut à écrire $a = $a / $b;
        $a %= $b; // Equivaut à écrire $a = $a % $b;
        $a **= $b; // Equivaut à écrire $a = $a ** $b;

        echo "<h2>07 - Conditions & opérateurs de comparaison</h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // Si la condition est juste, c'est à dire que $x est bien supérieur à $y alors le code présent à l'intérieur de ces accolades/brackets va s'exécuter
            echo "Vrai, la valeur de x est bien supérieure à la valeur de y<br>";
        } else {
            echo "Faux<br>";
        }

        // Plusieurs conditions obligatoires : AND ou && 
        if ($x > $y && $y > $z) {
            echo "OK pour les deux conditions<br>";
        } else {
            echo "Faux, l'une ou l'autre ou les deux sont fausses<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR ou || 
        if ($x > $y || $y < $z) { // Ici la première est vraie, la seconde est fausse donc je rentre dans le if
            echo "OK pour au moins une des conditions<br>";
        } else {
            // Je rentre ici uniquement si elles sont toutes fausses 
            echo "Faux pour toutes les conditions<br>";
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont vérifiées, c'est refusé ! : XOR 
        if ($x < $y xor $y > $z) {
            echo "OK une seule et unique condition est bonne ! <br>";
        } else {
            echo "Toutes les conditions sont fausses ou toutes les conditions sont vraies<br>";
        }

        // if elseif else
        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) { // Si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // Si x est différent de 10
            echo "Réponse B<br>";
        } elseif ($y == $z) { // Si y est égal à z
            echo "Réponse C<br>";
        } else { // Sinon
            echo "Réponse D<br>";
        }

        // si $x est = à 8, alors la Réponse A et la Réponse B sont bonnes, par contre, on sortira toujours d'un bloc if lorsque la première condition est rencontrée !
        // Je tombe donc dans la réponse A ! 


        // Comparaison stricte 
        $a = 1; // 1 en type integer
        echo gettype($a);
        echo "<br>";
        $b = "1"; // 1 en type string
        echo gettype($b);
        echo "<br>";

        // // On peut faire du casting de type en PHP pour changer le type d'un élément sans changer la valeur
        // $astring = (string) $a; // Ici je peux transformer un int, en string numérique, ça fonctionne !
        // echo $astring;
        // echo gettype($astring);
        // echo "<br>";

        // // Ici malheureusement de transformer un vrai string en integer, cela ne fonctionne pas, la valeur de l'integer devient "0" et la valeur du string est perdue
        // $c = "coucou";
        // $cint = (integer) $c;
        // echo  $cint;
        // echo gettype($cint);

        // Comparaison des valeurs uniquement 
        if ($a == $b) {
            echo "Ok, ces deux variables ont la même valeur<br>";
        } else {
            echo "Non, ces deux variables ont des valeurs différentes<br>";
        }

        // Comparaison des valeurs ET des types avec "==="
        if ($a === $b) {
            echo "Ok, ces deux variables ont la même valeur ET le même type<br>";
        } else {
            echo "Non, ces deux variables ont des valeurs différentes ET/OU des types différents<br>";
        }

        /* 
            Opérateurs de comparaison 
            ----------------------------------
            =           affectation (ce n'est pas un opérateur de comparaison)
            ==          est égal à
            !=          est différent de 
            ===         est strictement égal à (valeur et type)
            !==         est strictement différent de 
            >           strictement supérieur à
            >=          supérieur ou égal à 
            <           strictement inférieur à
            <=          inférieur ou égal 
        */


        // Les autres syntaxes pour les if  
        if ($a === $b) {
            echo "Ok, ces deux variables ont la même valeur ET le même type<br>";
        } // Si je n'en ai pas besoin, je ne suis pas obligé d'écrire le else !  
        echo "<hr>";

        if ($a === $b) echo "Ok, ces deux variables ont la même valeur ET le même type<br>";
        else echo "Non, ces deux variables ont des valeurs différentes ET/OU des types différents<br>";
        // Il est possible de ne pas mettre les accolades, par contre, je serai limité à une seule instruction par if/elseif/else 

        // Ici syntaxe avec les ":" plutôt que les accolades et le endif pour clôturer le if
        // On gagne en lisibilité par rapport au nommage de l'instruction de fermeture
        // Et aussi cette syntaxe est régulièrement utilisée pour fermer le php pour écrire du html, réouvrir le php pour le else ou else if etc, etc / Pour des ouvertures/fermetures successives de PHP 
        if ($a === $b) : ?>
            Ok, ces deux variables ont la même valeur ET le même type<br>
        <?php else : ?>
            Non, ces deux variables ont des valeurs différentes ET/OU des types différents<br>
        <?php endif;


        // Ecriture ternaire
        // On utilise le if ternaire pour faire des if très court qui partagent la même action, ici dans notre cas l'action est toujours un "echo", c'est la valeur qui est echo qui diffère dans le if ou dans le else
        echo ($a === $b) ? "Ok <br>" : "Faux<br>";


        // Deux outils de controle existent en PHP et sont très largement utilisés via des if
        // isset() et empty() 
        // isset() permet de savoir si une information (variable ou autre) existe  (true si elle existe, false si elle n'existe pas)
        // empty() permet de savoir aussi si une information contient bien quelque chose ! (true si elle n'existe pas ou est vide, false si elle existe et contient bien quelque chose)

        // Bonne pratique veut qu'on utilise toujours isset pour vérifier qu'un élément existe avant de vérifier son conteu
        // On utilisera donc toujours isset dans un premier temps, et empty dans un second temps si nécessaire pour vérifier les valeurs 

        // exemple : saisie d'un formulaire 
        $nom = "Bob";
        if (isset($nom)) { // Si la variable $nom existe je rentre ici
            echo "La variable nom est définie !<br>";
            if (empty($nom)) {
                echo "Par contre la variable nom est vide !<br>";
            } else {
                echo "Et la variable est bien remplie !<br>";
            }
        } else {
            echo "La varible nom n'existe pas<br>";
        }

        // isset() - Très régulièrement utilisé pour vérifier que l'on reçoit bien les variables attendues avant de commencer un traitement (par exemple des éléments venant d'un formulaire, on ne commence pas à traiter le form si je n'ai pas toutes les informations attendues)
        // empty() - Plutôt utilisé pour vérifier si un élément à saisi obligatoire est bien saisi ! On l'utilisera toujours APRES avoir déjà fait un isset()


        // Ci dessous, autre type de condition ternaire qui inclut un test "isset", la condition si dessous indique que "si $pseudoForm existe, alors sa valeur sera transmise à $pseudo, sinon, la valeur transmise sera "Pas de pseudo"

        $pseudoForm = "Bruce";
        $pseudo = $pseudoForm ?? "Pas de pseudo";

        echo "<hr>";
        echo $pseudo;

        echo "<h2>Conditions switch</h2>";
        // Autre outil permettant de mettre en place des conditions 

        // Avec une condition switch, on va tester différentes valeurs d'une même variable, c'est le seul cas d'utilisation de switch ! Pour les if plus complexe, la syntaxe n'est pas du tout adaptée 

        $couleur = "rouge";
        switch ($couleur) {
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
                break;
            default: // équivaut au else 
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
                break; // break non obligatoire car c'est la fin de l'accolade
        }

        // EXERCICE : refaire cette condition des couleurs avec if / elseif / else 

        $couleur = "vert";
        if ($couleur == "bleu") echo "Vous aimez le bleu<br>";
        elseif ($couleur == "rouge") echo "Vous aimez le rouge<br>";
        elseif ($couleur == "vert") echo "Vous aimez le vert<br>";
        else echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";

        echo "<h2>08 - Fonctions prédéfinies</h2>";

        // Inscrites au langage, on se contente de les utiliser ! (tout comme gettype, isset, empty, etc etc)

        // https://www.php.net/manual/fr/indexes.functions.php

        // Quelques exemples : 

        // Fonction date() 
        // https://www.php.net/manual/fr/function.date.php
        // Nous permet de formater une date ! 

        // Changement du fuseau horaire pour coller à l'heure française
        date_default_timezone_set("Europe/Paris");

        echo "Nous sommes le : " . date("d/m/Y") . " et il est : " . date("H:i:s") . "<br>";

        echo "Copyright &copy; " . date("Y") . "<hr>";

        // La fonction date accepte un second argument, une date en timestamp!
        // Le timestamp c'est le nombre de secondes écoulées depuis le premier janvier 1970 (horodatage UNIX)
        // Difficile à connaître de tête... On va utiliser strtotime pour transformer une date format string en timestamp !
        echo date("d/m/Y H:i:s", strtotime("22-10-2012")) . "<hr>";

        // Fonctions de manipulation de string 

        // strlen() / iconv_strlen()
        // Fonction permettant de compter le nombre de caractères dans une chaine 

        echo strlen("bônjôùr"); // ATTENTION strlen compte le nombre d'octets et pas le nombre de caractères, ce serait problématique de l'utiliser pour des vérifications de tailles sur des saisies (pseudo, mot de passe, etc.)
        echo iconv_strlen("bônjôùr"); // iconv_strlen compte exactement le nombre de caractères, accentués/spéciaux ou pas 

        // strpos()
        // Indique la position d'un élément dans une chaine 
        $email = "mail@mail.fr";
        echo "Position du @ dans la chaine " . strpos($email, "@") . "<br>";

        // substr()
        // Permet de découper une chaine de caractère 
        $phrase = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident similique atque quae et odio totam aliquid ad ut? Quos eaque quaerat tempora. Odio hic facere sequi earum, quam explicabo assumenda.";

        echo substr($phrase, 0, 25) . '... <a href="">Lire la suite</a><hr>';

        // ucfirst() upperCase first, met la première lettre d'une chaine en maj

        // Les fonctions de test (retourne true si c'est le type en question, sinon false)
        // is_int, is_array, is_string, is_bool, is_numeric

        // Même si ma fonction est déclarée plus bas, l'appel fonctionne ici ! Les fonctions sont préchargées en priorité, avant le reste de la page
        separateur();

        echo "<h2>09 - Fonctions utilisateur</h2>";

        // Ce sont des fonctions que l'on développe nous même ! 

        // Fonction permettant d'afficher 3 <hr>


        // Déclaration : 
        function separateur()
        {
            echo "<hr><hr><hr>";
        }

        // Exécution :
        separateur();

        //  Fonction avec argument (param)
        // Fonction permettant de dire bonjour à un user
        function dire_bonjour($pseudo)
        {
            return "Bonjour " . $pseudo . ", bienvenue sur notre site<hr>";
        }

        echo dire_bonjour("Pierra");

        // Fonction permettant de calculer un prix TTC
        function applique_tva($prix)
        {
            return "Le montant TTC pour le prix $prix est de : " . ($prix * 1.2) . "€<hr>"; // tva à 20%
        }

        echo applique_tva(500);

        // EXERCICE : Refaire une fonction similaire pour le taux de TVA, mais, avec la possibilité de choisir le taux à appliquer 
        // Après avoir développé cette fonction, rendez le taux facultatif
        // Si le taux n'est pas défini par l'utilisateur, c'est le taux de 20% de TVA qui s'applique

        function tva_taux($prix, $taux = 20)
        {
            if (is_numeric($prix) && is_numeric($taux)) {
                return "Le montant TTC pour le prix $prix et au taux de $taux% est de : " . $prix * (1 + ($taux / 100)) . "€<hr>";
            } else return "Vous devez fournir absolument des valeurs numériques !<hr>";
        }

        echo tva_taux(100, "");
        echo tva_taux(100);

        // EXERCICE : 
        // Ci-après, une fonction "meteo"
        // Régler cette fonction pour gérer "en" et "au" en fonctoin de la saison et le "s" sur les degrés en fonction de si la temmperature est au pluriel ou pas

        function meteo($saison, $temperature)
        {
            $debut = "Nous sommes en $saison";
            $suite = " et il fait $temperature degré(s)<hr>";

            return $debut . $suite;
        }

        separateur();

        echo meteo("printemps", 20);
        echo meteo("été", 40);
        echo meteo("automne", 12);
        echo meteo("hiver", 1);

        separateur();

        function meteo2($saison, $temperature)
        {
            if ($saison == "printemps") {
                $debut = "Nous sommes au $saison";
            } else {
                $debut = "Nous sommes en $saison";
            }

            if ($temperature >= -1 && $temperature <= 1) {
                $suite = " et il fait $temperature degré<hr>";
            } else {
                  $suite = " et il fait $temperature degrés<hr>";
            }
            return $debut . $suite;
        }

        echo meteo2("printemps", 20);
        echo meteo2("été", 40);
        echo meteo2("automne", 12);
        echo meteo2("hiver", 1);

        separateur();

        function meteo3($saison, $temperature)
        {
            $prep = ($saison == "printemps") ? "au" : "en";
            $s = (abs($temperature) <= 1) ? "" : "s";

            return "Nous sommes $prep $saison et il fait $temperature degré$s <hr>";
        }

        echo meteo3("printemps", 20);
        echo meteo3("été", 40);
        echo meteo3("automne", 12);
        echo meteo3("hiver", 1);

        // ENVIRONNEMENT / SCOPE 
        //  Global : le script complet 
        // Local : à l'intérieur d'une fonction / classe / méthode 

        // L'existence d'une variable dépend de l'environnement où on la déclare 
        // Une variable déclarée dans un espace local (dans les accolades de la déclaration d'une fonction) n'existe QUE dans cette fonction 

        separateur();

        $animal = "chat"; // Variable déclarée dans l'espace global


        echo $animal . "<br>"; // chat

        function foret()
        {
            $animal = "chien"; // Variable déclarée dans l'espace local, elle est différente de celle de l'espace global
            return $animal;
        }

        echo $animal . "<br>"; // chat
        foret(); // exécution de la fonction, un string contenant chien est envoyé dans le vide, rien ne se passe
        echo $animal . "<br>"; // chat
        echo foret() . "<br>"; // chien
        echo $animal . "<br>"; // chat 
        $animal = foret(); // Uniquement ici j'impacte la variable de mon espace global, qui prendra la valeur return par la fonction foret()
        echo $animal . "<br>";

        $pays = "France"; // Variable déclarée dans l'espace global

        function affiche_pays()
        {
            global $pays; // Avec le mot clé global, il est possible de récupérer une variable dans l'espace global pour le ramener dans la fonction
            $pays = "Espagne";
        }

        echo $pays; // France (je n'ai pas encore exécuté ma fonction)

        affiche_pays(); // On exécute la fonction affiche_pays donc la variable globale $pays prends une nouvelle valeur, celle prévue dans la fonction (Espagne)

        echo $pays; // Espagne

        separateur();

        // Il est possible de typer les arguments d'une fonction ainsi que son return 
        function identite(string $nom, int $age = 35, int $cp = 00): string // Si en phase de dev, je ne retourne pas un string, alors cela m'indiquera une erreur
        {
            return "$nom a $age ans et habite dans le $cp<hr>";
        }

        echo identite("Pierra", 30, 30); // Si je transmet des types non attendus (malgré la flexibilité du langage) j'aurai un TypeError
        echo identite(nom: "Lolo", cp:47); // Depuis PHP 8 On peut appeler les arguments par leur nom, ce qui me permet de fournir certains param facultatif sans forcément citer tous les autres avant ! (Si j'ai 10 param facultatif dans ma fonction et que je veux saisir le dernier uniquement, avant j'étais obligé de tous les saisir, maintenant plus besoin !)






















        // echo "<script>alert('coucou');</script>"

        // Balise de fermeture PHP
        ?>

    </div>

</body>

</html>