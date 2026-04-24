<?php
session_start();
require_once __DIR__ . "/includes/db_connection.php";

$email = "";
$password = "";
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($email)) {
        $error["email"] = "Email is required!";
    }

    if (empty($password)) {
        $error["password"] = "Password is required!";
    }

    if (empty($error)) {

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];

            header("Location: /admin/users-tables");
            exit();

        } else {
            $error["default"] = "Invalid email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body class="bg-gradient-login">
<div class="container-login">
  <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Login</h1>
                </div>

                <form class="user" method="POST">

                  <div class="form-group">
                    <input type="email" class="form-control" name="email"
                      placeholder="Enter Email Address" value="<?= $email ?>">
                    <p class="text-danger"><?= $error["email"] ?? "" ?></p>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" name="password"
                      placeholder="Password">
                    <p class="text-danger"><?= $error["password"] ?? "" ?></p>
                  </div>

                  <p class="text-danger text-center">
                    <?= $error["default"] ?? "" ?>
                  </p>

                  <div class="form-group">
                    <input value="Login" class="btn btn-primary btn-block" type="submit">
                  </div>

                </form>

                <hr>

                <div class="text-center">
                  <a class="font-weight-bold small" href="/register">
                    Create an Account
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/includes/script.php" ?>
</body>
</html>