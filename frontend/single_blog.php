<?php
require_once __DIR__ . "/../backend/includes/db_connection.php";
require_once __DIR__ . "/../backend/config.php";

$slug = $_GET['slug'] ?? '';

// Fetch single blog
$sql = "SELECT * FROM blogs WHERE slug=? AND status='published' LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$slug]);

$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die('Blog not found');
}

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
    <div class="container py-5">
        <div class="row justify-content-center">
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
        </div>
    </div>
    <?php require_once __DIR__ . "/includes/footer.php" ?>
    <?php require_once __DIR__ . "/includes/script.php" ?>

</body>

</html>