<?php include_once '../includes/header.php'; ?>
<?php include_once '../includes/menu.php'; ?>

<?php
if (!empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='bg-red-100 text-red-700 p-2 rounded mb-2'>$error</div>";
    }
    unset($_SESSION['errors']);
}

if (!empty($_SESSION['success'])) {
    echo "<div class='bg-green-100 text-green-700 p-2 rounded mb-2'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}
?>


<h2 class="text-xl font-bold mb-4">Connexion</h2>

<form method="POST" action="../traitement/function_connexion.php" class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <label class="block mb-2">
        Email :
        <input type="email" name="email" class="w-full border rounded p-2 mt-1" required>
    </label>

    <label class="block mb-4">
        Mot de passe :
        <input type="password" name="mot_de_passe" class="w-full border rounded p-2 mt-1" required>
    </label>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Se connecter</button>
</form>

<?php include_once '../includes/footer.php'; ?>
