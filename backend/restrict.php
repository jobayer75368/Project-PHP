<?php

require_once __DIR__ . "/session.php";
require_once __DIR__ . "/includes/db_connection.php";

// Current logged-in user
$userId = $_SESSION['user_id'] ?? null;

// Restrict if user is not logged in
if (!$userId) {
    die("Access Restricted");
}

// Get user status
$activityStmt = $pdo->prepare("SELECT status FROM users WHERE id=?");
$activityStmt->execute([$userId]);

$activeUser = $activityStmt->fetch(PDO::FETCH_ASSOC);

// Restrict inactive users
if (!$activeUser || $activeUser['status'] === 'inactive') {
    die("Access Restricted");
}
