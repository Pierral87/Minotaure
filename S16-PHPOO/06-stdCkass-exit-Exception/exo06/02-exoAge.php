<?php

/* 

Exercice : Validation d'âge avec gestion des exceptions

Objectif : Créer un script qui demande à l'utilisateur de saisir son âge pour accéder à une section réservée d'un site. Si l'âge est inférieur à 18 ans, lancer une exception et afficher un message d'erreur, sinon on affiche le reste de la page.

*/


function verifAge($age)
{
    if ($age >= 18) {
        return true;
    } else {
        throw new Exception('Vous n\'avez pas l\'age requis pour accéder à cette page');
    }
}

$age = 0;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $age = $_POST['age'];

        // if ($age < 18) {
        //     throw new Exception('Vous n\'avez pas l\'age requis pour accéder à cette page');
        // }

        verifAge($age);
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<div>
    <form action="" method="post">
        <label for="age">Age</label>
        <input type="number" name="age" id="age">
        <button type="submit">Valider</button>
    </form>
</div>

<?php if ($age >= 18) : ?>
    <section>
        <h1>Section réservée</h1>
        <div>
            <img src="https://media.tenor.com/x8v1oNUOmg4AAAAM/rickroll-roll.gif" alt="">
        </div>
    </section>
<?php endif; ?>