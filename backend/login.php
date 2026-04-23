<?php
session_start();
require_once __DIR__ . "/includes/db_connection.php";
$name = "";
$email= "";
$password = "";

$error = [];
function sanitize($data){
    $data= trim(htmlspecialchars($data));
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    
    if (empty($name)) {
        $error["name"] = "Name is required!";
    }

    if(empty($email)){
        $error["email"]= "Email is required!";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error["email"] = "Invalid Email address!";
    }

    if(empty($password)){
        $error["password"]="Password is required!";
    }
    if(empty($error)){
      $sql = "SELECT * FROM admins WHERE email=:email LIMIT 1";
      $statement = $pdo->prepare($sql);
      $statement->execute([
        ':email' => $email
      ]);
      $admin = $statement->fetch(PDO::FETCH_ASSOC);

      if($admin && password_verify($password, $admin['password'])){
        $_SESSION['admin_id']= $admin['id'];
        header("Location: /admin/dashboard");
        exit();

      }else{
        $error["default"]="Invalid Email or Password!";
      }
    }

}
?>




<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ ."/includes/head.php" ?>

<body class="bg-gradient-login">
  <!-- Login Content -->
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
                      <input type="text" class="form-control " id="exampleInputName" aria-describedby="emailHelp"
                        placeholder="Enter Your Name" name="name" value="<?php echo $name?>">
                        <p class="text-danger"><?php echo isset($error["name"]) ? $error["name"]:""; ?></p>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" name="email" value="<?php echo $email ?>">
                        <p class="text-danger"><?php echo isset($error["email"]) ? $error["email"]:""; ?></p>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                      <p class="text-danger"><?php echo (isset($error["password"])) ? $error["password"]: (isset($error["default"])? $error["default"] :""); ?></p>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <input value="Login" class="btn btn-primary btn-block" type="submit">
                    </div>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="register.html">Create an Account!</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <?php require_once __DIR__ ."/includes/script.php" ?>
</body>

</html>