<?php
require_once __DIR__ . "/../backend/includes/db_connection.php";

$slug = $_GET['slug'] ?? '';

$categoryStmt = $pdo->prepare(
    "SELECT * FROM categories WHERE slug=?"
);

$categoryStmt->execute([$slug]);

$category = $categoryStmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die('Category not found');
}

// Fetch blogs of this category
$blogStmt = $pdo->prepare(
    "SELECT * FROM blogs
     WHERE category_id=? 
     AND status='published'
     ORDER BY created_at DESC"
);

$blogStmt->execute([$category['id']]);

$blogs = $blogStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body>

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">
                <?= htmlspecialchars($category['name']); ?>
            </h1>
        </div>
    </header>

    <div class="container py-5">

        <div class="row g-4">

            <?php if (!empty($blogs)): ?>

                <?php foreach ($blogs as $blog): ?>

                    <div class="col-lg-4 col-md-6">

                        <div class="card h-100 shadow-sm border-0">

                            <img
                                src="<?= $blog['featured_image']; ?>"
                                class="card-img-top"
                                style="height:220px;object-fit:cover;">

                            <div class="card-body">

                                <h4>
                                    <?= htmlspecialchars($blog['title']); ?>
                                </h4>

                                <p class="text-muted">
                                    <?= htmlspecialchars($blog['short_description']); ?>
                                </p>

                                <a
                                    href="/blog/<?= $blog['slug']; ?>"
                                    class="btn btn-link p-0 fw-bold text-decoration-none">

                                    Read More →

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        No blogs found in this category.

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>