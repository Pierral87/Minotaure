<?php
session_start();

if (isset($_GET['update']) && isset($_GET['qty'])) {
    $id = (int)$_GET['update'];

    foreach ($_GET['qty'] as $productId => $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = max(1, (int)$quantity);
        }
    }

    header('Location: panier.php');
    exit;
}


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    unset($_SESSION['cart'][$id]);
    header('Location: panier.php');
    exit;
}


if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
    header('Location: panier.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <div class="container-xl py-5">
        <h1 class="mb-4">Votre panier 🛒</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="get" class="d-flex align-items-center">
                                <?php $total = 0; ?>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <?php
                                        $sub = $item['price'] * $item['quantity'];
                                        $total += $sub;
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['nom']) ?></td>
                                        <td><?= number_format($item['price'], 2) ?> €</td>
                                        <td>
                                            <input type="hidden" name="update" value="<?= $item['id'] ?>">
                                            <input type="number" name="qty[<?=$item['id']?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control form-control-sm w-75 me-2">
                                        </td>
                                        <td><?= number_format($sub, 2) ?> €</td>
                                        <td>
                                            <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total</td>
                                <td><?= number_format($total, 2) ?> €</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="index.php" class="btn btn-outline-primary">← Continuer mes achats</a>
                <button type="submit" class="btn btn-sm btn-secondary">OK</button>
                <a href="?empty=1" class="btn btn-outline-danger">Vider le panier</a>
            </div>
            </form>
        <?php else: ?>
            <div class="alert alert-info">Votre panier est vide.</div>
            <a href="index.php" class="btn btn-primary">← Retour à la boutique</a>
        <?php endif; ?>
    </div>
</div>
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
