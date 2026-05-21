<?php

require_once __DIR__ . '/../backend/includes/db_connection.php';
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=:id");
$statement->execute([':id' => 1]);
$settings = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body>

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <!-- Hero Section -->
    <header class="hero-section text-center py-5 bg-dark text-white">
        <div class="container" data-aos="fade-down">
            <h1 class="display-4 fw-bold">About Us</h1>
            <p class="lead mt-3">
                Building modern digital solutions with creativity, technology, and innovation.
            </p>
        </div>
    </header>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Text Content -->
                <div class="col-lg-6 col-12" data-aos="fade-right">
                    <h2 class="text-primary fw-bold mb-4"><?= $settings['about_title'] ?></h2>

                    <p class="fs-5 text-secondary">
                        <?= nl2br($settings['about_details']) ?>
                    </p>
                </div>

                <!-- Image -->
                <div class="col-lg-6 col-12 text-center" data-aos="fade-left">
                    <img
                        src="<?php echo !empty($settings['about_image']) ? $settings['about_image'] : ''; ?>"
                        class="img-fluid rounded shadow">
                </div>

            </div>
        </div>
    </section>

    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>