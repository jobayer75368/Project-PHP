<?php
session_start();
require_once __DIR__ . "/includes/db_connection.php";

$name = "";
$email = "";
$password = "";
$confirmPassword = "";

$error = [];

function sanitize($data){
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $confirmPassword = sanitize($_POST["confirmPassword"]);

    if (empty($name)) {
        $error["name"] = "Name is required!";
    }

    if (empty($email)) {
        $error["email"] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["email"] = "Invalid Email!";
    }

    if (empty($password)) {
        $error["password"] = "Password is required!";
    }

    if (empty($confirmPassword)) {
        $error["confirmPassword"] = "Confirm Password is required!";
    } elseif ($password !== $confirmPassword) {
        $error["confirmPassword"] = "Passwords do not match!";
    }

    if (empty($error)) {

        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $error["email"] = "Email already exists!";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password)
                    VALUES (:name, :email, :password)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            header("Location: /login");
            exit();
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
                  <h1 class="h4 text-gray-900 mb-4">Register</h1>
                </div>

                <form class="user" method="POST">

                  <div class="form-group">
                    <input type="text" class="form-control" name="name"
                      placeholder="Enter Your Name" value="<?= $name ?>">
                    <p class="text-danger"><?= $error["name"] ?? "" ?></p>
                  </div>

                  <div class="form-group">
                    <input type="email" class="form-control" name="email"
                      placeholder="Enter Email Address" value="<?= $email ?>">
                    <p class="text-danger"><?= $error["email"] ?? "" ?></p>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" name="password"
                      placeholder="Create Password">
                    <p class="text-danger"><?= $error["password"] ?? "" ?></p>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" name="confirmPassword"
                      placeholder="Confirm Password">
                    <p class="text-danger"><?= $error["confirmPassword"] ?? "" ?></p>
                  </div>

                  <div class="form-group">
                    <input value="Register" class="btn btn-primary btn-block" type="submit">
                  </div>

                </form>

                <hr>

                <div class="text-center">
                  <a class="font-weight-bold small" href="/login">
                    Already have an account? Login
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