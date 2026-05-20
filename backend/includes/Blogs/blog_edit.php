<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";
$id = $_GET['id'] ?? null;

$statement = $pdo->prepare("SELECT * FROM blogs WHERE id=?");
$statement->execute([$id]);
$blog = $statement->fetch(PDO::FETCH_ASSOC);
if (!$blog) {
    die("Blog not found");
}
$featured_image = $blog['featured_image'];
//update
$title = $slug = $short_description = $long_description = $status = "";
$errors = [];
$created_by = $_SESSION['user_id'];
function sanitize(string $data)
{
    $data = trim(htmlspecialchars($data));
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title'])) {
        $title = sanitize($_POST['title']);
    } else {
        $errors['title'] = "Blog Title is required";
    }

    if (!empty($_POST['slug'])) {
        $slug = sanitize($_POST['slug']);
        $slug = strtolower(str_replace(' ', '-', $slug));
    } else {
        $errors['slug'] = "Slug is required";
    }

    if (!empty($_POST['short_description'])) {
        $short_description = sanitize($_POST['short_description']);
    } else {
        $errors['short_description'] = "Short Description is required";
    }

    if (!empty($_POST['long_description'])) {
        $long_description = sanitize($_POST['long_description']);
    } else {
        $errors['long_description'] = "Long Description is required";
    }

    if (!empty($_POST['status'])) {
        $status = sanitize($_POST['status']);
    } else {
        $errors['status'] = "Status is required";
    }

    if (!empty($_FILES['featured_image']['name'])) {

        // delete old image
        if (!empty($blog['featured_image'])) {

            $oldImagePath = __DIR__ . "/../../../" . ltrim($blog['featured_image'], '/');

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $fileName = time() . "-" . $_FILES['featured_image']['name'];
        $targetPath = __DIR__ . "/../../uploads/" . $fileName;
        move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath);
        $featured_image = BASE_URL . "uploads/" . $fileName;
    }

    if (empty($errors)) {
        $sql = "UPDATE blogs SET title=?, slug=?, short_description=?, long_description=?,featured_image=?, status=?, created_by=?  WHERE id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $slug, $short_description, $long_description, $featured_image, $status, $created_by, $id]);
        header("Location: /admin/blog/list");
        exit();
    }
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Blog</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Blog Manage</li>
                            <li class="breadcrumb-item active" aria-current="page"> Edit Blog</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">

                                <div class="table-responsive p-3">
                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="title">Blog Title</label>
                                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Enter Title" value="<?php echo $blog['title'] ?>">

                                            <p class="text-danger"><?php echo isset($errors['title']) ? $errors['title'] : ""; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" aria-describedby="slug" placeholder="Enter Slug" value="<?php echo $blog['slug'] ?>">

                                            <p class="text-danger"><?php echo isset($errors['slug']) ? $errors['slug'] : ""; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea class="form-control" id="short_description" name="short_description" aria-describedby="short_description"><?php echo $blog['short_description'] ?>
                                                </textarea>

                                            <p class="text-danger"><?php echo isset($errors['short_description']) ? $errors['short_description'] : ""; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="long_description">Long Description</label>
                                            <textarea class="form-control" id="long_Description" name="long_description" aria-describedby="long_description"><?php echo $blog['long_description']; ?>
                                            </textarea>

                                            <p class="text-danger"><?php echo isset($errors['long_description']) ? $errors['long_description'] : ""; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="featured_image">Featured Image</label>
                                            <input type="file" class="form-control" id="featured_image" name="featured_image" aria-describedby="featured_image" placeholder="Enter Featured image" value="<?php echo $blog['featured_image'] ?>">

                                            <p class="text-danger"><?php echo isset($errors['featured_image']) ? $errors['featured_image'] : ""; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="draft" <?php echo $blog['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                                <option value="pending" <?php echo $blog['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="published" <?php echo $blog['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <input class="btn btn-primary" type="submit" value="Update">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer"></div>
                            </div>

                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- modal  -->
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