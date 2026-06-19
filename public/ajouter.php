<?php

require_once __DIR__ . '/../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu'] ?? '');

    if ($contenu !== '') {
        $statement = $pdo->prepare(
            "INSERT INTO messages (contenu) VALUES (:contenu)"
        );

        $statement->execute([
            'contenu' => $contenu
        ]);
    }
}

header('Location: index.php');
exit;
 