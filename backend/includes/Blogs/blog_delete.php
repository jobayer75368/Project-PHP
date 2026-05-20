<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";
$id = $_GET['id'] ?? null;

if ($id) {

    $statement = $pdo->prepare("SELECT featured_image FROM blogs WHERE id=?");
    $statement->execute([$id]);

    $blog = $statement->fetch(PDO::FETCH_ASSOC);

    if ($blog && !empty($blog['featured_image'])) {

        $imagePath = __DIR__ . "/../../../" . ltrim($blog['featured_image'], '/');

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $statement = $pdo->prepare("DELETE FROM blogs WHERE id=?");
    $statement->execute([$id]);
}

header("Location: /admin/blog/list");
exit();
