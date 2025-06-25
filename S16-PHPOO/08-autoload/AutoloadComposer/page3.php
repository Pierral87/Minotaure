<?php

use ProjetPierra\Controller\UtilisateurController;
use ProjetPierra\Model\UtilisateurModel;

require("vendor/autoload.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Test d'autoload de composer, je vais instancier une classe ici en dessous</h1>

    <?php 

    $utilisateurController = new UtilisateurController;
    $utilisateurModel = new UtilisateurModel;

?>
    
</body>
</html>