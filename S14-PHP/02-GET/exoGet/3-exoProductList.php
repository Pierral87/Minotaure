<?php
session_start();

/* 

    EXERCICE GET : 
        Créer une page d'accueil de site ecommerce avec une liste de produit et page produit

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [produits], insérer des données fictives dde produits, par exemple, id, nom, description, categorie, image (utilisez picsum pour générer des photos aléatoires) (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un affichage de liste des produits représentant les produits présents dans votre array session
                4 - Rajouter un menu de votre choix permettant de choisir la catégorie de produits
                5 - Créer une communication de votre choix par GET via ce menu ou filtre pour n'afficher que les produits d'une certaine catégorie
                6 - Sur chaque affichage produit, créer un bouton qui amènera sur la fiche produit (autre page) pour n'avoir que ce produit là d'affiché (utilisation de GET ici aussi)
                7 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/


if (!isset($_SESSION['produits'])) {
    $_SESSION['produits'] = [
        ["id" => 1, "nom" => "Produit A", "description" => "Description du produit A", "categorie" => "Électronique", "image" => "https://picsum.photos/200?random=1"],
        ["id" => 2, "nom" => "Produit B", "description" => "Description du produit B", "categorie" => "Vêtements", "image" => "https://picsum.photos/200?random=2"],
        ["id" => 3, "nom" => "Produit C", "description" => "Description du produit C", "categorie" => "Électronique", "image" => "https://picsum.photos/200?random=3"],
    ];
} 

$categorie = $_GET["categorie"] ?? null;

$produits_affiches = array_filter($_SESSION['produits'], function($produit) use ($categorie) {
    return $categorie ? $produit['categorie'] == $categorie : true;
});
?>

<body>

    <h1>Bienvenue sur notre site e-commerce !</h1>

    <h3>Filtrer par catégorie :</h3>
    <ul>
        <li><a href="3-exoProductList.php?categorie=Électronique">Électronique</a></li>
        <li><a href="3-exoProductList.php?categorie=Vêtements">Vêtements</a></li>
        <li><a href="3-exoProductList.php?categorie=Maison">Maison</a></li>
        <li><a href="3-exoProductList.php">Tous les produits</a></li>
    </ul>

    <h2>Liste des produits</h2>
    <div class="produits">
        <?php foreach ($produits_affiches as $produit): ?>
            <div class="produit">
                <img src="<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>" style="width:200px;height:200px;">
                <h3><?= $produit['nom'] ?></h3>
                <p><?= $produit['description'] ?></p>
                <p><strong>Catégorie:</strong> <?= $produit['categorie'] ?></p>
                <a href="produit.php?id=<?= $produit['id'] ?>">Voir le produit</a>
            </div>
        <?php endforeach; ?>
    </div>

</body>