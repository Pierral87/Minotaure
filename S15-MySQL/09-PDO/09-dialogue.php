<?php 

/* 

EXERCICE :
-----------
- Création d'un espace de dialogue / de tchat

- 01 - Création de la BDD : dialogue
     -  Table : commentaire
     - Champs de la table commentaire :
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME
        
- 02 - Créer une connexion à cette base avec PDO
- 03 - Création d'un formulaire html permettant de poster un message
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation
- 04 - Récupération des saisies du form avec controle 
- 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
- 06 - Requete de récupération des messages afin de les afficher dans cette page
- 07 - Affichage des messages avec un peu mise en forme
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date en français
- 10 - Amélioration du css

*/
$host = 'mysql:host=localhost;dbname=dialogue';
$login = 'root';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);


// - 02 - Créer une connexion à cette base avec PDO
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$erreur = '';
// - 04 - Récupération des saisies du form avec controle 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($pseudo) || empty($message)) {
        $erreur .= 'Tous les champs sont obligatoires.';
    } else {
        // - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (?, ?, NOW())");
        $stmt->execute([$pseudo, $message]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$stmt = $pdo->query("SELECT pseudo, message, date_enregistrement FROM commentaire ORDER BY date_enregistrement DESC");
// fetchAll pour récupérer un array contenant tout les messages
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
// un count sur cet array pour comprendre le nombre de messages
$totalMessages = count($messages);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini tchat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">💬 Espace de dialogue</h1>

    <!-- - 08 - Affichage en haut des messages du nombre de messages présents dans la bdd -->
    <p><strong><?= $totalMessages ?></strong> message<?= $totalMessages > 1 ? 's' : '' ?> dans la base de données.</p>

    <?php if ($erreur): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <!-- - 03 - Création d'un formulaire html permettant de poster un message
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation -->
    <form method="post" class="mb-5">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!-- - 07 - Affichage des messages avec un peu mise en forme -->
    <?php foreach ($messages as $msg): ?>
        <div class="card mb-3">
            <div class="card-header">
                <strong><?= htmlspecialchars($msg['pseudo']) ?></strong>
                <span class="text-muted float-end">
                        <!-- - 09 - Affichage de la date en français -->
                    <?= date("d/m/Y H:i:s", strtotime($msg['date_enregistrement'])) ?>
                </span>
            </div>
            <div class="card-body">
                <p class="card-text"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>