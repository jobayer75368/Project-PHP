<?php
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/includes/db_connection.php";
$admin = [];
try {
  $sql = "SELECT * FROM admins WHERE id=:id";
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':id' => 1
  ]);
  $admin = $statement->fetch(PDO::FETCH_ASSOC);
  //   echo "<pre>";
  //   var_dump($admin);
  //   echo "<pre>";
} catch (PDOException $e) {
  echo "Error getting Data:" . $sql . "<br>" . $e->getMessage();
};
?>



<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once __DIR__ . "/includes/sidebar.php" ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php require_once __DIR__ . "/includes/topbar.php" ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </div>

          <div class="container">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4 rounded-lg">
              <div class="card-body d-flex align-items-center">
                <div class="position-relative">
                  <img src="img/user.jpg" class="rounded-circle border" alt="Profile" style="width: 100px; height: 100px; object-fit: cover;">
                  <span class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1 shadow-sm" style="right: 5px; bottom: 5px;">
                    <i class="fas fa-camera text-success" style="font-size: 0.8rem;"></i>
                  </span>
                </div>
                <div class="ml-4">
                  <h4 class="font-weight-bold mb-1" style="color: #004d40;"><?php echo $admin['name'] ?></h4>
                  <p class="text-muted mb-1">Administrator</p>
                  <p class="text-muted small mb-0"><i class="fas fa-map-marker-alt mr-1"></i> <?php ?></p>
                </div>
              </div>
            </div>

            <!-- Personal Information Card -->
            <div class="card shadow-sm border-0 mb-4 rounded-lg">
              <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h5 class="font-weight-bold" style="color: #004d40;">Personal Information</h5>
                  <button class="btn btn-warning text-white btn-sm px-3" style="background-color: #f57c00; border: none;">
                    Edit <i class="fas fa-pen ml-1" style="font-size: 0.7rem;"></i>
                  </button>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block"> Name</label>
                    <span class="font-weight-bold"><?php echo $admin['name'] ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Email Address</label>
                    <span class="font-weight-bold"><?php echo $admin['email'] ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">User Role</label>
                    <span class="font-weight-bold">Admin</span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Phone Number</label>
                    <span class="font-weight-bold"><?php ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Date of Birth</label>
                    <span class="font-weight-bold"><? ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Admin Since</label>
                    <span class="font-weight-bold"></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address Card -->
            <div class="card shadow-sm border-0 mb-4 rounded-lg">
              <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h5 class="font-weight-bold" style="color: #004d40;">Address</h5>
                  <button class="btn btn-outline-secondary btn-sm px-3">
                    Edit <i class="fas fa-pen ml-1" style="font-size: 0.7rem;"></i>
                  </button>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Country</label>
                    <span class="font-weight-bold"><?php ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">City</label>
                    <span class="font-weight-bold"><?php ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Postal Code</label>
                    <span class="font-weight-bold"><?php ?></span>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <?php require_once __DIR__ . "/includes/modal.php"  ?>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php require_once __DIR__ . "/includes/footer.php" ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js     -->
  <?php require_once __DIR__ . "/includes/script.php" ?>
  <!-- js  -->
</body>

</html>