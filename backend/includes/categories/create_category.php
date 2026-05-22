<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";
$name = $slug = "";
$errors = [];
$status = 1;
function sanitize(string $data)
{
    $data = trim(htmlspecialchars($data));
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])) {
        $name = sanitize($_POST['name']);
    } else {
        $errors['name'] = "Category Name is required";
    }
    if (!empty($_POST['slug'])) {
        $slug = sanitize($_POST['slug']);
        $slug = strtolower(str_replace(' ', '-', $slug));
    } else {

        $errors['slug'] = "Category Slug is required";
    }
    if (empty($errors)) {
        $sql = "INSERT INTO categories (name, slug,status)
                    VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $slug, $status]);
        header("Location: /admin/category/list");
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
                        <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/category/list">Category List</a></li>
                            <li class="breadcrumb-item">Category Create</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">

                                <div class="table-responsive p-3">
                                    <form action="" method="post" autocomplete="off">
                                        <div class="form-group mb-3">
                                            <label for="name">Category Name</label>
                                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter Name" value="<?php echo $name ?>">
                                        </div>
                                        <p class="text-danger"><?php echo isset($errors['name']) ? $errors['name'] : ""; ?></p>
                                        <div class="form-group">
                                            <label for="slug">Category Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" aria-describedby="name" placeholder="Enter Slug" value="<?php echo $slug ?>">
                                        </div>
                                        <p class="text-danger"><?php echo isset($errors['slug']) ? $errors['slug'] : ""; ?></p>
                                        <div class="mt-3">
                                            <input class="btn btn-primary" type="submit" value="submit">
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