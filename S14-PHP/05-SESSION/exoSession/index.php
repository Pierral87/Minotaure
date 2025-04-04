<?php
session_start();

if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    foreach ($_SESSION['produits'] as $p) {
        if ($p['id'] == $id) {
            if (!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = $p;
                $_SESSION['cart'][$id]['quantity'] = 1;
            } else {
                $_SESSION['cart'][$id]['quantity']++;
            }
            header('Location: index.php');
            exit;
        }
    }
    
}


if (!isset($_SESSION['produits'])) {
    $_SESSION['produits'] = [
        ['id' => 1, 'nom' => 'T-shirt Noir', 'description' => 'Un joli t-shirt noir en coton bio.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/400?random=1', 'price' => 19.99],
        ['id' => 2, 'nom' => 'Casque Audio', 'description' => 'Casque stéréo haute qualité.', 'categorie' => 'Électronique', 'image' => 'https://picsum.photos/400?random=2', 'price' => 89.90],
        ['id' => 3, 'nom' => 'Chaussures Running', 'description' => 'Confort optimal pour le sport.', 'categorie' => 'Chaussures', 'image' => 'https://picsum.photos/400?random=3', 'price' => 59.50],
        ['id' => 4, 'nom' => 'Jeans Slim', 'description' => 'Jeans bleu coupe slim.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/400?random=4', 'price' => 49.00],
        ['id' => 5, 'nom' => 'Montre Connectée', 'description' => 'Gardez un œil sur votre santé.', 'categorie' => 'Électronique', 'image' => 'https://picsum.photos/400?random=5', 'price' => 129.99],
        ['id' => 6, 'nom' => 'Baskets Blanches', 'description' => 'Look décontracté et épuré.', 'categorie' => 'Chaussures', 'image' => 'https://picsum.photos/400?random=6', 'price' => 65.00],
        ['id' => 7, 'nom' => 'Sweat à capuche', 'description' => 'Idéal pour les soirées fraîches.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/400?random=7', 'price' => 39.95],
        ['id' => 8, 'nom' => 'Écouteurs Bluetooth', 'description' => 'Liberté sans fil au quotidien.', 'categorie' => 'Électronique', 'image' => 'https://picsum.photos/400?random=8', 'price' => 49.99],
        ['id' => 9, 'nom' => 'Sandales Été', 'description' => 'Légères et respirantes.', 'categorie' => 'Chaussures', 'image' => 'https://picsum.photos/400?random=9', 'price' => 34.90],
        ['id' => 10, 'nom' => 'Blouson en cuir', 'description' => 'Style intemporel.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/400?random=10', 'price' => 159.00],
    ];    
}    

$categories = array_unique(array_column($_SESSION['produits'], 'categorie'));
$categorieChoisie = $_GET['categorie'] ?? null;

$produits = $_SESSION['produits'];
if ($categorieChoisie) {
    $produits = array_filter($produits, fn($p) => $p['categorie'] === $categorieChoisie);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique Tabler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <a class="navbar-brand" href="#">Ma Boutique</a>
            <div class="navbar-nav flex-row order-md-last">
                <a href="reset.php" class="btn btn-outline-danger">Reset session</a>
                <a href="panier.php" class="btn btn-outline-primary ms-2">Mon panier</a>
            </div>
        </div>
    </header>

    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row mb-4">
                    <div class="col">
                        <h2 class="page-title">Produits</h2>
                        <div class="btn-list">
                            <a href="index.php" class="btn <?= $categorieChoisie ? 'btn-outline-primary' : 'btn-primary' ?>">Tous</a>
                            <?php foreach ($categories as $cat): ?>
                                <a href="?categorie=<?= urlencode($cat) ?>" class="btn <?= ($categorieChoisie === $cat) ? 'btn-primary' : 'btn-outline-primary' ?>">
                                    <?= htmlspecialchars($cat) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="row row-cards">
                    <?php foreach ($produits as $produit): ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <img src="<?= $produit['image'] ?>" class="card-img-top" alt="Produit">
                                <div class="card-body">
                                    <h3 class="card-title"><?= htmlspecialchars($produit['nom']) ?></h3>
                                    <p><?= htmlspecialchars($produit['description']) ?></p>
                                    <div class="badge"><?= htmlspecialchars($produit['price']) ?> €</div>
                                    <div class="badge"><?= htmlspecialchars($produit['categorie']) ?></div>
                                    <div class="btn-group mt-3 w-100">
                                        <a href="produit.php?id=<?= $produit['id'] ?>" class="btn btn-outline-secondary w-50">Voir</a>
                                        <a href="?add=<?= $produit['id'] ?>" class="btn btn-primary w-50">Ajouter 🛒</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
