<?php 

/*

    EXERCICE POST :
    Choix plat au restaurant : 

        Etapes : 
        - 1 Créer un form en POST avec simplement un champ select (liste déroulante) avec plusieurs choix de plat possible puis un bouton de validation
        - 2 Traiter la réponse en exploitant POST puis en affichant un message indiquant le choix de l'utilisateur

*/ 

$plat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["plat"])) {
    $plat = $_POST["plat"];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix du plat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f8;
            padding: 40px;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        .result {
            margin-top: 20px;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Choisissez votre plat préféré</h1>

        <form action="" method="post" class="mb-4">
            <select class="form-control form-control-lg mb-3" name="plat">
                <option disabled selected>Choisir un plat</option>
                <option>Poulet au curry coco</option>
                <option>Spaghetti à la bolognaise maison</option>
                <option>Salade méditerranéenne</option>
                <option>Poké bowl au saumon</option>
                <option>Gratin dauphinois</option>
            </select>
            <button type="submit" class="btn btn-primary w-100">Valider mon choix</button>
        </form>

            <div class="result">Vous avez choisi : <?= $plat ?></div>

    </div>

</body>
</html>