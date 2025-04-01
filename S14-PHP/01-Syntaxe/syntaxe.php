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
        echo identite(nom: "Lolo", cp: 47); // Depuis PHP 8 On peut appeler les arguments par leur nom, ce qui me permet de fournir certains param facultatif sans forcément citer tous les autres avant ! (Si j'ai 10 param facultatif dans ma fonction et que je veux saisir le dernier uniquement, avant j'étais obligé de tous les saisir, maintenant plus besoin !)

        echo "<h2>10 - Structure itérative : Boucles</h2>";

        // Il existe plusieurs outils de boucle en PHP 

        // Boucle for = on tourne obligatoirement avec un compteur numérique, la syntaxe est prévue pour ça !
        // Besoin de 3 informations 
        // Une valeur de départ (compteur)
        // Une condition d'entrée (basée sur le compteur)
        // Une incrémentation ou décrémentation (du compteur)

        for ($i = 0; $i < 10; $i++) {
            echo "$i ";
        }

        separateur();

        // Boucle while = boucle en fonction d'une condition (pas forcément numérique)

        $i = 0; // valeur de départ
        while ($i < 10) { // condition d'entrée
            echo "$i ";
            $i++; // Incrémentation
        }

        separateur();

        // Il est possible de sortir d'une boucle avec le mot clé break;

        $i = 0; // valeur de départ
        while ($i < 100) { // condition d'entrée
            echo "$i ";
            if ($i == 20) break;
            $i++; // Incrémentation
        }


        // Autre syntaxe de boucle avec le "end" plutôt que l'accolade

        $i = 0; // valeur de départ
        while ($i < 10) : // condition d'entrée
            echo "$i ";
            $i++; // Incrémentation
        endwhile;

        separateur();

        for ($i = 0; $i < 10; $i++) :
            echo "$i ";
        endfor;

        separateur();

        /////////////////////////////////////////////////

        // EXERCICES DE BOUCLE 

        // Exercice 1 : Régler cette boucle 
        for ($i = 0; $i < 10; $i++) {
            echo $i . ' - ';
        }
        // Résultat actuel : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 -
        // Résultat souhaité : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9
        separateur();

        for ($i = 0; $i < 10; $i++) {
            if ($i < 9)  echo $i . ' - ';
            else echo $i;
        }
        separateur();
        for ($i = 0; $i < 10; $i++) {
            echo ($i < 9) ? "$i - " : $i;
        }

        separateur();
        // Exercice 2 
        // Afficher des nombres allant de 1 à 100
        for ($i = 1; $i <= 100; $i++) :
            echo "$i ";
        endfor;

        // Exercice 3 
        // Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge 
        for ($i = 1; $i <= 100; $i++) :
            echo ($i == 50) ? "<span style='color:red'>$i </span>" : "$i ";
        endfor;
        separateur();
        // Exercice 4
        // Afficher des nombres allant de 2000 à 1930
        for ($i = 2000; $i >= 1930; $i--) :
            echo "$i ";
        endfor;

        // Exercice 5
        // Afficher le titre suivant 10 fois : <h1>Titre à afficher 10 fois</h1>
        for ($i = 0; $i < 10; $i++) {
            echo "<h1>Titre à afficher 10 fois</h1>";
        }
        separateur();
        // Exercice 6
        // Afficher le titre suivant "<h1>Je m'affiche pour la Nème fois</h1>"
        // Remplacer le N par la valeur du tour de boucle, gérer l'exception du premier tour 1ère fois et non pas 1ème fois
        for ($i = 1; $i <= 10; $i++) {
            $n = ($i == 1) ? "ère" : "ème";
            echo "<h1>Je m'affiche pour la $i $n fois</h1>";
        }

        echo "<h2>11 - Tableaux de données Array</h2>";
        // Array est un nouveau type de données 
        // C'est un type qui nous permet de conserver un ensemble de valeur 
        // Un array est toujours composé de "deux colonnes"
        // Une colonne qui représente la clé/l'index d'accès à une valeur
        // Une autre colonne correspondant à la valeur en question associée à cet index 

        // Déclaration d'un tableau array
        $tab_jours = array("lundi", "mardi", "mercredi", "jeudi", "vendredi");

        // echo $tab_jours; 
        // Je ne peux pas faire un echo sur un array, Error : Array to string conversion 

        // Deux instructions me permettent de vérifier le contenu d'un array, print_r et var_dump
        echo "<pre>";
        print_r($tab_jours);
        echo "</pre>";
        separateur();
        var_dump($tab_jours);
        // Array
        //     (
        //         [0] => lundi
        //         [1] => mardi
        //         [2] => mercredi
        //         [3] => jeudi
        //         [4] => vendredi
        //     )

        // Affichons mardi, comment faire ? 
        echo $tab_jours[1];
        // On manipulera toujours les array en piochant dans la var et en indiquant entre crochets l'indice que je souhaite afficher 

        // Quelques fonctions en rapport avec les tableaux array
        // array_push()
        // Permet d'ajouter un ou plusieurs éléments en fin de tableau 
        array_push($tab_jours, "samedi", "dimanche");
        var_dump($tab_jours);

        // array_unshift pour ajouter des éléments en début de tableau 
        // is_array pour contrôler qu'une variable est bien de type array 
        // in_array pour contrôler qu'un élément fait parti d'un tableau array (pour vérifier par exemple des valeurs autorisées (des extensions de fichier pour les images par exemple))

        // Autres façons de déclarer un tableau 
        $tab_mois = ["janvier", "fevrier", "mars", "avril"];
        var_dump($tab_mois);

        // Autre façon pour ajouter un élément dans un array
        $tab_mois[] = "mai";
        $tab_mois[] = "juin";
        var_dump($tab_mois);

        $tab_fruits[] = "pomme"; // Cette syntaxe permet également de créer le tableau 
        $tab_fruits[] = "banane";
        var_dump($tab_fruits);

        // Pour connaître la taille d'un tableau array : 
        // count() ou sizeof() 
        echo "Taille du tableau contenant les mois : " . count($tab_mois) . "<br>";
        echo "Taille du tableau contenant les mois : " . sizeof($tab_mois) . "<br>";

        // Affichage du array tab_mois entier dans une liste ul li 
        echo "<ul>";
        for ($i = 0; $i < count($tab_mois); $i++) {
            echo "<li>" . $tab_mois[$i] . "</li>";
        }
        echo "</ul>";

        // En PHP il est possible d'avoir des indices non pas numériques mais en lettres ! C'est ce qu'on appelle un tableau avec des indices nommés, en fait, un tableau ASSOCIATIF
        $user = array("pseudo" => "Pierro", "password" => "azerty", "email" => "pierro@lolo.com", "age" => 30);

        var_dump($user);

        // Je peux rajouter des éléments en nommant les indices également
        $user["ville"] = "Paris";
        $user["cp"] = 75000;
        var_dump($user);

        // Sur ce dernier tableau, les index en toutes lettres ne me permettent pas de faire une boucle comme je l'ai fais précédemment avec les indices numériques 

        // Par contre, nous avons un outil adapté à ça, la boucle foreach ! 
        // La boucle foreach est spécifiques aux array et aux objets et permet de parcourir l'intégralité d'un array 

        // Deux syntaxes possibles 
        // La première permet de récupérer uniquement les valeurs de chaque indice de l'array 

        separateur();

        foreach ($user as $valeur) { // Ici je nomme la variable $valeur qui me permettra de récupérer la valeur de chaque élément du array
            echo "- $valeur <br>";
        }

        separateur();
        // La deuxième me permet de récupérer aussi le nom des indices ! Pour effectuer des traitements différents d'un indice à l'autre (ignorer un password, mettre une balise <img> pour afficher une image) 

        foreach ($user as $indice => $valeur) { // Ici je nomme deux variables, la première après "as" recevra le nom de l'indice et celle après la double flèche => recevra la valeur rattachée à cet indice pour chaque tour de boucle
            if ($indice != "password")  echo "- $indice : $valeur <br>";
        }

        // Il est possible d'avoir un array dans un autre array
        // C'est un array à deux niveaux (ou plus), on appelle ça un array multidimensionnel 

        $panier = array("numero_produit" => array(1, 2, 3), "prix" => array(10, 15, 30), "quantite" => array(1, 3, 4), "titre_produit" => array("chaussettes", "tshirt", "pantalon"));

        var_dump($panier);
        //         array (size=4)
        //   'numero_produit' => 
        //     array (size=3)
        //       0 => int 1
        //       1 => int 2
        //       2 => int 3
        //   'prix' => 
        //     array (size=3)
        //       0 => int 10
        //       1 => int 15
        //       2 => int 30
        //   'quantite' => 
        //     array (size=3)
        //       0 => int 1
        //       1 => int 3
        //       2 => int 4
        //   'titre_produit' => 
        //     array (size=3)
        //       0 => string 'chaussettes' (length=11)
        //       1 => string 'tshirt' (length=6)
        //       2 => string 'pantalon' (length=8)

        // Pour un manipuler un array à plusieurs niveaux ?
        // Si je veux afficher chaussettes ? 
        // Pour ça il me suffit de rentrer dans les indices un à un, à chaque fois avec leur paire de crochets 
        echo $panier["titre_produit"][0];

        echo "<h2>12 - Inclusion de fichier</h2>";
        // On créer un fichier séparé exemple.php (je le nomme _exemple.php)
        // On ajoute un peu de contenu dans ce fichier
        
        // On va maintenant s'intéresser à inclure ce fichier sur notre page syntaxe.php 

        // Pour ça, deux instructions : include et require 
        // Ces deux instructions sont similaires, elles ramènent le contenu entier d'un fichier vers une autre page 
            // La différence entre les deux, ce sont leurs gestions des erreurs, le include va générer une erreur "warning" le code continue, le require va générer une erreur "fatal_error" le code s'arrête !

        // Egalement ces deux instructions existent en version _once qui permettent de ne pas réinclure le fichier s'il est déjà présent sur cette page 

        // Généralement on nomme ces fichiers de "portions de page" différemment, pour les différencier des fichiers qui contiennent des pages entières (tout comme des fichiers qui contiennent uniquement des Classes en orienté objet), on appelle ça des "partials" et on les nomme généralement en débutant leur nom par un "_" 

        echo "<b>Premier appel avec include : </b><hr>";
        include "_exemple.php";

        echo "<b>Deuxième appel avec include_once : </b><hr>";
        include_once "_exemple.php";

        echo "<b>Troisième appel avec require : </b><hr>";
        require "_exemple.php";

        echo "<b>Quatrième appel avec require_once : </b><hr>";
        require_once "_exemple.php";


































        // echo "<script>alert('coucou');</script>"

        // Balise de fermeture PHP
        ?>

    </div>

</body>

</html>