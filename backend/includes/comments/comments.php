<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";

try {
    $sql = "SELECT comments.*, blogs.title AS blog_title
    FROM comments
    JOIN blogs ON comments.blog_id = blogs.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching comments: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php require_once __DIR__ . "/../head.php" ?>

<!-- head -->

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once __DIR__ . "/../sidebar.php" ?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <?php require_once __DIR__ . "/../topbar.php" ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Commetns Manage</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Comments</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Comment</th>
                                                <th>Blog</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($comments)): ?>
                                                <?php foreach ($comments as $comment): ?>
                                                    <tr>
                                                        <td><?= $comment['id'] ?></td>
                                                        <td><?= $comment['name'] ?></td>
                                                        <td><?= $comment['comment'] ?></td>
                                                        <td><?= $comment['blog_title'] ?></td>
                                                        <td>
                                                            <?php
                                                            $statusClass = match ($comment['status']) {
                                                                'pending' => 'badge-warning',
                                                                'approved' => 'badge-success',
                                                                default => 'badge-dark'
                                                            };
                                                            ?>

                                                            <span class="badge <?= $statusClass; ?>">
                                                                <?= ucfirst($comment['status']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date("d M Y, h:i A", strtotime($user['created_at'])) ?></td>
                                                        <td class="d-lg-flex">
                                                            <?php if ($comment['status'] == 'pending') : ?>
                                                                <a href="/admin/comment/approve?id=<?php echo $comment['id']; ?>" onclick="return confirm('Are you sure you want to Approve this Comment?')" class="btn btn-primary p-1 mr-lg-2 mb-2 mb-lg-0">Approve</a>
                                                            <?php else: ?>
                                                            <?php endif; ?>
                                                            <a href="/admin/comment/delete?id=<?php echo $comment['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to delete this Comment?')" class="btn btn-danger p-1"><?= $comment['status'] == 'pending' ? 'Reject' : 'Delete' ?></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No Comment found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="card-footer"></div>
                            </div>

                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- moda  -->
            <?php require_once __DIR__ . "/../modal.php"  ?>
            <!-- Footer -->
            <?php require_once __DIR__ . "/../footer.php" ?>
            <!-- footer -->

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require_once __DIR__ . "/../script.php" ?>
</body>

</html>