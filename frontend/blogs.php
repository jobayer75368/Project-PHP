<?php
require_once __DIR__ . "/../backend/includes/db_connection.php";

// Fetch all published blogs with category
$sql = "SELECT blogs.*, categories.name AS category_name
        FROM blogs
        LEFT JOIN categories
        ON blogs.category_id = categories.id
        WHERE blogs.status='published'
        ORDER BY blogs.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body>

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <header class="hero-section text-center">
        <div class="container" data-aos="fade-down">

            <h1 class="display-4 fw-bold">
                All Blogs
            </h1>

            <p class="lead">
                Explore all published blogs and latest articles.
            </p>

        </div>
    </header>

    <div class="container py-5">

        <div class="row g-4">
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>

                    <a class="col-lg-4 col-md-6 text-decoration-none" href="/blog/<?= $blog['slug']; ?>">
                        <div
                            class="card h-100 border-0 shadow-sm overflow-hidden"
                            data-aos="fade-up">

                            <img
                                src="<?php echo !empty($blog['featured_image']) ? $blog['featured_image'] : '/frontend/assests/images/no-image.png'; ?>"
                                class="card-img-top"
                                style="height: 230px; object-fit: cover;"
                                alt="<?= htmlspecialchars($blog['title']); ?>">

                            <div class="card-body d-flex flex-column p-4">

                                <span
                                    class="badge bg-soft-primary text-primary mb-3"
                                    style="background: #e0e7ff; width: fit-content;">
                                    <?= htmlspecialchars($blog['category_name'] ?? 'Uncategorized'); ?>
                                </span>

                                <h4 class="mb-3">
                                    <?= htmlspecialchars($blog['title']); ?>
                                </h4>

                                <p class="text-muted flex-grow-1">
                                    <?= substr(htmlspecialchars($blog['short_description']), 0, 50); ?>
                                </p>

                                <div class="mt-3">
                                    <small class="text-muted d-block mb-2">
                                        <?= date('F d, Y', strtotime($blog['created_at'])); ?>
                                    </small>
                                    <span

                                        class="btn btn-link p-0 text-decoration-none fw-bold">

                                        Read More →

                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        No published blogs found.

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>