<?php

require_once __DIR__ . '/../app/db.php';

$statement = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Application PHP + MySQL</title>
</head>
<body>
    <h1>Application full stack avec NGINX, PHP et MySQL</h1>

    <form action="ajouter.php" method="POST">
        <label for="contenu">Nouveau message :</label>
        <input type="text" id="contenu" name="contenu" required>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Messages</h2>

    <?php if (count($messages) === 0): ?>
        <p>Aucun message pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages as $message): ?>
                <li>
                    <?= htmlspecialchars($message['contenu']) ?>
                    <small>
                        — <?= htmlspecialchars($message['created_at']) ?>
                    </small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>