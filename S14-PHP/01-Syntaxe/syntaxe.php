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

        echo "Nous sommes le : " . date("d/m/Y") . " et il est : ". date("H:i:s") . "<br>";

        echo "Copyright &copy; " . date("Y") . "<hr>";



















        // echo "<script>alert('coucou');</script>"

        // Balise de fermeture PHP
        ?>

    </div>

</body>

</html>