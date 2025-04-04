<?php
session_start();
$id = $_GET['id'] ?? null;

$produit = null;
foreach ($_SESSION['produits'] as $p) {
    if ($p['id'] == $id) {
        $produit = $p;
        break;
    }
}

if (!$produit) {
    echo "Produit introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produit['nom']) ?></title>
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <div class="container-xl py-4">
        <a href="index.php" class="btn btn-secondary mb-3">← Retour à la boutique</a>
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= $produit['image'] ?>" class="card-img" alt="Produit">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title"><?= htmlspecialchars($produit['nom']) ?></h2>
                        <p class="badge text-muted"><?= htmlspecialchars($produit['categorie']) ?></p>
                        <p class="card-text"><?= htmlspecialchars($produit['description']) ?></p>
                        <a href="index.php" class="btn btn-primary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
