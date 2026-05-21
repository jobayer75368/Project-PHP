<?php
require_once __DIR__ . '/../../backend/includes/db_connection.php';

// settings 

$statement = $pdo->prepare("SELECT * FROM settings WHERE id=:id");
$statement->execute([':id' => 1]);
$settings = $statement->fetch(PDO::FETCH_ASSOC);

?>
<footer class="py-4 bg-white border-top text-center mt-5">
        <p class="text-muted mb-0"><?= $settings['website_footer'] ?></p>
</footer>