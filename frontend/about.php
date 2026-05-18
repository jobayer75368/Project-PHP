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
                    <h2 class="text-danger fw-bold mb-4">Who We Are</h2>

                    <p class="fs-5 text-secondary">
                        We are passionate about technology and modern web development. Our goal is to create fast,
                        secure, and user-friendly digital experiences that help businesses grow in the online world.
                    </p>

                    <p class="fs-5 text-secondary">
                        From frontend design to backend development, we focus on building responsive websites,
                        scalable applications, and clean user interfaces using modern technologies like PHP,
                        Laravel, JavaScript, and Bootstrap.
                    </p>

                    <p class="fs-5 text-secondary">
                        We believe technology should solve real problems. That is why we continuously learn,
                        improve, and develop innovative IT solutions that make systems more efficient and accessible
                        for everyone.
                    </p>
                </div>

                <!-- Image -->
                <div class="col-lg-6 col-12 text-center" data-aos="fade-left">
                    <img
                        src="/frontend/assests/images/4804443.jpg"
                        alt="IT Solutions"
                        class="img-fluid rounded shadow">
                </div>

            </div>
        </div>
    </section>

    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>