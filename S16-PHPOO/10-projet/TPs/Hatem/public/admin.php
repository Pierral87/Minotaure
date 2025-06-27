<?php
require_once '../config/database.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';

include_once '../includes/header.php';
include_once '../includes/menu.php';


if (!Auth::isAdmin()) {
    header('Location: index.php');
    exit;
}

$userModel = new User($pdo);
$utilisateurs = $userModel->all();


if (!empty($_SESSION['success'])) {
    echo "<div class='bg-green-100 text-green-700 p-2 rounded mb-2'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if (!empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='bg-red-100 text-red-700 p-2 rounded mb-2'>$error</div>";
    }
    unset($_SESSION['errors']);
}
?>

<h2 class="text-2xl font-bold mb-4">Gestion des utilisateurs</h2>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-blue-600 text-white">
            <th class="p-2 text-left">ID</th>
            <th class="p-2 text-left">Nom</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2 text-left">Rôle</th>
            <th class="p-2 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $user): ?>
            <tr class="border-b">
                <td class="p-2"><?= htmlspecialchars($user['id']) ?></td>
                <td class="p-2"><?= htmlspecialchars($user['nom']) ?></td>
                <td class="p-2"><?= htmlspecialchars($user['email']) ?></td>
                <td class="p-2"><?= htmlspecialchars($user['role']) ?></td>
                <td class="p-2">
                    <?php if ($user['role'] !== 'admin'): ?>
                        <form method="POST" action="../traitement/function_suppression.php" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">Supprimer</button>
                        </form>
                    <?php else: ?>
                        <span class="text-gray-500 italic">Admin</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../includes/footer.php'; ?>
