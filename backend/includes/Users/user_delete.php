<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";
$id = $_GET['id'] ?? null;

if ($id) {

    $statement = $pdo->prepare("SELECT featured_image FROM users WHERE id=?");
    $statement->execute([$id]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && !empty($user['featured_image'])) {

        $imagePath = __DIR__ . "/../../../" . ltrim($user['featured_image'], '/');

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $statement = $pdo->prepare("DELETE FROM users WHERE id=?");
    $statement->execute([$id]);
}

header("Location: /admin/users/list");
exit();
