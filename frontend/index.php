<?php
require_once __DIR__ . "/../backend/includes/db_connection.php";

$sql = "SELECT blogs.*, categories.name AS category_name
        FROM blogs
        LEFT JOIN categories
        ON blogs.category_id = categories.id
        WHERE blogs.status='published'
        ORDER BY blogs.created_at DESC
        LIMIT 3";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//categories
$categorySql = "SELECT * FROM categories ORDER BY id DESC";
$categoryStmt = $pdo->prepare($categorySql);
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . "/includes/head.php" ?>

<body>
    <?php require_once __DIR__ . "/includes/navbar.php" ?>
    <?php require_once __DIR__ . "/includes/header.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <div class="card mb-4 overflow-hidden" data-aos="fade-up">
                            <img
                                src="<?= $blog['featured_image']; ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($blog['title']); ?>">
                            <div class="card-body p-4">
                                <span class="badge bg-soft-primary text-primary mb-2"
                                    style="background: #e0e7ff;">
                                    <?= htmlspecialchars($blog['category_name'] ?? 'Uncategorized'); ?>
                                </span>
                                <h2 class="h3">
                                    <?= ($blog['title']); ?>
                                </h2>
                                <p class="text-muted">
                                    <?= ($blog['short_description']); ?>
                                </p>
                                <a href="/blog/<?= $blog['slug']; ?>" class="btn btn-link p-0 text-decoration-none fw-bold">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                    <div class="alert alert-warning">
                        No blogs found.
                    </div>

                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="card p-4 mb-4" data-aos="fade-left">
                    <h5 class="widget-title">Categories</h5>
                    <div class="category-list">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <a href="/category/<?= $category['slug']; ?>"
                                    class="category-link">
                                    <span>
                                        <?= htmlspecialchars($category['name']); ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No categories found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card p-4 mb-4 sticky-top" style="top: 90px;" data-aos="fade-left">
                    <h5 class="widget-title">Recent Blogs</h5>

                    <?php if (!empty($blogs)): ?>
                        <?php foreach ($blogs as $blog): ?>
                            <a href="/blog/<?= $blog['slug']; ?>" class="recent-post-item">
                                <img
                                    src="<?= $blog['featured_image']; ?>"
                                    class="recent-post-img"
                                    alt="<?= htmlspecialchars($blog['title']); ?>">
                                <div>
                                    <p class="recent-post-title">
                                        <?= htmlspecialchars($blog['title']); ?>
                                    </p>
                                    <span class="recent-post-date">
                                        <?= date('M d, Y', strtotime($blog['created_at'])); ?>
                                    </span>
                                </div>

                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>