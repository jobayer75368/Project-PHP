<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";

$id = $_SESSION['user_id'] ?? null;

$statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
$statement->execute([$id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    die("User not found");
}

//update
$name = $email = "";
$errors = [];
function sanitize(string $data)
{
    $data = trim(htmlspecialchars($data));
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])) {
        $name = sanitize($_POST['name']);
    } else {
        $errors['name'] = "Name is required";
    }

    if (!empty($_POST['email'])) {
        $email = sanitize($_POST['email']);
    } else {
        $errors['slug'] = "Email is required";
    }

    if (empty($errors)) {
        $sql = "UPDATE users SET name=?, email=?  WHERE id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $id]);
        header("Location: /admin/user/profile");
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/user/profile">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Profile Edit</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            <div class="card">

                                <div class="table-responsive p-3">
                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter Name" value="<?php echo $user['name'] ?>">

                                            <p class="text-danger"><?php echo isset($errors['name']) ? $errors['name'] : ""; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter Slug" value="<?php echo $user['email'] ?>">

                                            <p class="text-danger"><?php echo isset($errors['email']) ? $errors['email'] : ""; ?></p>
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