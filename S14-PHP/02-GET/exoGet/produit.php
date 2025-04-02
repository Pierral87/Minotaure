<?php
session_start();

$id = $_GET['id'];
$produit_trouve = null;

foreach ($_SESSION['produits'] as $produit) {
    if ($produit['id'] == $id) {
        $produit_trouve = $produit;
        break;
    }
}
?>
....

<body>

    <h1><?= $produit_trouve['nom'] ?></h1>
    <img src="<?= $produit_trouve['image'] ?>" alt="<?= $produit_trouve['nom'] ?>" style="width:400px;height:400px;">
    <p><strong>Description:</strong> <?= $produit_trouve['description'] ?></p>
    <p><strong>Catégorie:</strong> <?= $produit_trouve['categorie'] ?></p>

    <a href="3-exoProductList.php">Retour à la liste des produits</a>

</body>