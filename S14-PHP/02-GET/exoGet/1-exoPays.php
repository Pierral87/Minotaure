<?php 

/* 

    EXERCICE : 
        La base de la manipulation de GET 
        
            Etapes :
                - Créer 4 liens indiquant 4 pays différents 
                - Sur chaque lien, créer une valeur GET à transmettre sur la même page
                - En fonction de la valeur transmise, afficher un message (par exemple pour un choix "France", afficher "Vous êtes français")

*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisissez un pays</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Choisissez un pays</h1>
    
    <div class="flex space-x-4 mb-6">
        <a href="?pays=fr" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow">France</a>
        <a href="?pays=es" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow">Espagne</a>
        <a href="?pays=us" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow">USA</a>
        <a href="?pays=kmf" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow">Comores</a>
    </div>
    
    <div class="text-lg font-medium">
        <?php
        if (isset($_GET['pays'])) {
            $pays = ($_GET['pays']);
            $messages = [
                'fr' => 'Vous êtes français.',
                'es' => 'Vous êtes espagnol.',
                'us' => 'Vous êtes américain.',
                'kmf' => 'Vous êtes comorien.'
            ];
            
            echo "<p class='p-4 bg-white shadow rounded-lg'>" . ($messages[$pays] ?? " ") . "</p>";
        }
        ?>
    </div>
</body>
</html>