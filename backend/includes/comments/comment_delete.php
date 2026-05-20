<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";

$id = $_GET['id'] ?? null;

if ($id) {

    $statement = $pdo->prepare("SELECT status FROM comments WHERE id=?");
    $statement->execute([$id]);

    $comment = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare("DELETE FROM comments WHERE id=?");
    $statement->execute([$id]);
}

header("Location: /admin/comments");
exit();
