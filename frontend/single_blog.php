<?php
require_once __DIR__ . "/../backend/includes/db_connection.php";
require_once __DIR__ . "/../backend/config.php";

$slug = $_GET['slug'] ?? '';

$sql = "SELECT blogs.*, users.name AS posted_by
FROM blogs
LEFT JOIN users ON blogs.created_by = users.id
WHERE slug=? AND blogs.status='published' LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$slug]);

$blog = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$blog) {
    die('Blog not found');
}

$recentSql = "SELECT blogs.*, categories.name AS category_name, users.name AS posted_by
        FROM blogs
        LEFT JOIN categories ON blogs.category_id = categories.id
        LEFT JOIN users ON blogs.created_by = users.id
        WHERE blogs.status='published'
        ORDER BY blogs.created_at DESC
        LIMIT 3";

$recentSqlStmt = $pdo->prepare($recentSql);
$recentSqlStmt->execute();

$recentBlogs = $recentSqlStmt->fetchAll(PDO::FETCH_ASSOC);

// Comments table insert
$errors = [];
$name = $comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['name'])) {
        $name = trim(htmlspecialchars($_POST['name']));
    } else {
        $errors['name'] = 'Name is required';
    }

    if (!empty($_POST['comment'])) {
        $comment = trim(htmlspecialchars($_POST['comment']));
    } else {
        $errors['comment'] = 'Comment is required';
    }

    if (empty($errors)) {

        $sql = "INSERT INTO comments (blog_id, name, comment)
                VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $blog['id'],
            $name,
            $comment
        ]);

        header("Location: /blog/" . $blog['slug']);
        exit();
    }
}

// Fetch comments
$sql = "SELECT * FROM comments
        WHERE blog_id=?
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$blog['id']]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body>

    <?php require_once __DIR__ . "/includes/navbar.php" ?>
    <header class="hero-section text-center">
        <div class="container d-flex flex-column align-items-center" data-aos="fade-down">

            <h1 class="display-4 fw-bold">
                Our Blogs
            </h1>
            <h2 class="fw-bold w-75 mt-3 text-center">
                <?= htmlspecialchars($blog['title']); ?>
            </h2>
        </div>
    </header>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden mb-5">
                    <img
                        src="<?= $blog['featured_image']; ?>"
                        class="img-fluid"
                        alt="<?= htmlspecialchars($blog['title']); ?>">
                    <div class="card-body p-4 p-lg-5">
                        <span class="badge bg-primary mb-3">
                            <?= ucfirst($blog['status']); ?>
                        </span>
                        <h1 class="mb-3">
                            <?= htmlspecialchars($blog['title']); ?>
                        </h1>
                        <p class="text-muted mb-4">
                            Posted on
                            <?= date('F d, Y', strtotime($blog['created_at'])); ?>
                            by
                            <?= $blog['posted_by']; ?>
                        </p>
                        <p class="lead text-muted">
                            <?= nl2br(htmlspecialchars($blog['short_description'])); ?>
                        </p>

                        <hr class="my-4">

                        <div style="line-height: 1.9; font-size: 17px;">
                            <?= nl2br(htmlspecialchars($blog['long_description'])); ?>
                        </div>
                    </div>
                </div>
                <!-- Comment Form -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Leave a Comment</h3>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="<?= $name ?>">

                                <small class="text-danger">
                                    <?= $errors['name'] ?? '' ?>
                                </small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Comment</label>

                                <textarea
                                    name="comment"
                                    rows="5"
                                    class="form-control"><?= $comment ?></textarea>

                                <small class="text-danger">
                                    <?= $errors['comment'] ?? '' ?>
                                </small>
                            </div>
                            <button class="btn btn-primary">
                                Submit Comment
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Comments List -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="mb-4">
                            Comments (<?= count($comments); ?>)
                        </h3>
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $singleComment): ?>
                                <div class="border-bottom pb-3 mb-3">
                                    <h6 class="mb-1 fw-bold">
                                        <?= htmlspecialchars($singleComment['name']); ?>
                                    </h6>
                                    <small class="text-muted d-block mb-2">
                                        <?= date('F d, Y h:i A', strtotime($singleComment['created_at'])); ?>
                                    </small>
                                    <p class="mb-0">
                                        <?= nl2br(htmlspecialchars($singleComment['comment'])); ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>

                            <p class="text-muted mb-0">
                                No comments yet.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Blogs -->
            <div class="col-lg-4">
                <div class=" card p-4 mb-4 sticky-top" style="top: 90px;" data-aos="fade-left">
                    <h5 class="widget-title">Recent Blogs</h5>

                    <?php if (!empty($recentBlogs)): ?>
                        <?php foreach ($recentBlogs as $recentBlog): ?>
                            <a href="/blog/<?= $recentBlog['slug']; ?>" class="recent-post-item">
                                <img
                                    src="<?php echo !empty($recentBlog['featured_image']) ? $recentBlog['featured_image'] : '/frontend/assests/images/no-image.png'; ?>"
                                    class="recent-post-img"
                                    alt="<?= htmlspecialchars($recentBlog['title']); ?>">
                                <div>
                                    <p class="recent-post-title">
                                        <?= htmlspecialchars($recentBlog['title']); ?>
                                    </p>
                                    <span class="recent-post-date">
                                        <?= date('M d, Y', strtotime($recentBlog['created_at'])); ?>
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