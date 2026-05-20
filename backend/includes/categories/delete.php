<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";
$id = $_GET['id'] ?? null;
if ($id) {
    $statement = $pdo->prepare("DELETE FROM categories WHERE id=?");
    $statement->execute([$id]);
}

header("Location: /admin/category/list");
exit();
