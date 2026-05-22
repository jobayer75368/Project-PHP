<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";

try {
    $sql = "SELECT blogs.*, users.name AS posted_by
    FROM blogs
    JOIN users ON blogs.created_by = users.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching blogs: " . $e->getMessage());
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
                        <h1 class="h3 mb-0 text-gray-800">Blogs Manage</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Blog List</li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="/admin/blog/create">Blog Create</a></li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Posted By</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($blogs)): ?>
                                                <?php foreach ($blogs as $blog): ?>
                                                    <tr>
                                                        <td><?= $blog['id'] ?></td>
                                                        <td><?= $blog['title'] ?></td>
                                                        <td><?= $blog['slug'] ?></td>
                                                        <td>
                                                            <img
                                                                class="rounded"
                                                                src="<?= !empty($blog['featured_image'])
                                                                            ? $blog['featured_image']
                                                                            : '/frontend/assests/images/no-image.png'; ?>"
                                                                height="80">
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $statusClass = match ($blog['status']) {
                                                                'draft' => 'badge-secondary',
                                                                'pending' => 'badge-warning',
                                                                'published' => 'badge-success',
                                                                default => 'badge-dark'
                                                            };
                                                            ?>

                                                            <span class="badge <?= $statusClass; ?>">
                                                                <?= ucfirst($blog['status']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $blog['posted_by'] ?></td>
                                                        <td>
                                                            <?= date("d M Y", strtotime($blog['created_at'])) ?>
                                                        </td>
                                                        <td class="">
                                                            <a href="/admin/blog/edit?id=<?php echo $blog['id']; ?>" class="btn btn-primary p-1 mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            <a href="/admin/blog/delete?id=<?php echo $blog['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to delete this blog?')" class="btn btn-danger p-1"><i class="fa-solid fa-trash text-white"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No Blogs found</td>
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