<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";

$id = $_GET['id'] ?? null;
$statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
$statement->execute([$id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    die("User not found");
}
//update
$status = $role = "";
$errors = [];
function sanitize(string $data)
{
    $data = htmlspecialchars(trim($data));
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = sanitize($_POST['status']);
    $role = sanitize($_POST['role']);

    if (empty($errors)) {
        $sql = "UPDATE users SET status=?,role=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $role, $id]);
        header("Location: /admin/users/list");
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
                        <h1 class="h3 mb-0 text-gray-800">Users Edit</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/users/list">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">

                                <div class="table-responsive p-3">
                                    <form action="" method="POST" autocomplete="off">

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="active"
                                                    <?= trim(strtolower($user['status'])) == 'active' ? 'selected' : ''; ?>>Active
                                                </option>


                                                <option value="inactive"
                                                    <?= trim(strtolower($user['status'])) == 'inactive' ? 'selected' : ''; ?>>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Status</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="admin" <?= trim(strtolower($user['role'])) == 'admin' ? 'selected' : ''; ?>>Admin
                                                </option>


                                                <option value="subscriber" <?= trim(strtolower($user['role'])) == 'subscriber' ? 'selected' : ''; ?>>Subscriber
                                                </option>
                                            </select>
                                        </div>
                                        <p class="text-danger"><?php echo isset($errors['slug']) ? $errors['slug'] : ""; ?></p>
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