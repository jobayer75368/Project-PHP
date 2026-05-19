<?php

require_once __DIR__ . "/session.php";
require_once __DIR__ . "/includes/db_connection.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/restrict.php";




$id = $_GET['id'] ?? null;
$user = [];

// Upload Image
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_FILES['featured_image']['name'])) {

  $fileName = time() . "-" . $_FILES['featured_image']['name'];
  $targetPath = __DIR__ . "/uploads/" . $fileName;
  move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath);
  $db_Path = "/uploads/" . $fileName;
  // Update database
  $sql = "UPDATE users SET featured_image = :featured_image WHERE id = :id";
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':featured_image' => $db_Path,
    ':id' => $id
  ]);
}
try {

  $sql = "SELECT * FROM users WHERE id = :id";
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':id' => $id
  ]);

  $user = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

  echo "Error getting data: " . $e->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    if ($activeUser['status'] == 'active')
      require_once __DIR__ . "/includes/sidebar.php"
    ?>
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
              <div class="card-body d-flex justify-content-between">

                <div class="d-flex align-items-center">

                  <img
                    id="previewImg"
                    src="<?= BASE_URL . $user['featured_image']; ?>"
                    class="rounded-circle border border-dark"
                    width="150"
                    height="150">
                  <div class="ml-4">
                    <h4 class="font-weight-bold mb-1" style="color: #004d40;"><?php echo $user['name'] ?></h4>
                    <p class="text-muted mb-1">Administrator</p>
                    <p class="text-muted small mb-0"><i class="fas fa-map-marker-alt mr-1"></i> <?php ?></p>
                  </div>

                </div>


                <div class="d-flex h-50">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" id="fileUpload" name="featured_image" hidden accept="image/*">

                    <!-- Edit Button (shown initially) -->
                    <label id="editBtn" for="fileUpload"
                      class="btn btn-outline-secondary btn-sm px-3 w-100 "
                      style="cursor:pointer;">
                      Edit<i class="fas fa-pen ml-1" style="font-size: 0.7rem;"></i>
                    </label>

                    <!-- Save Button (hidden initially) -->
                    <input id="saveBtn" type="submit" class="btn btn-outline-primary btn-sm px-3 w-100" style="cursor:pointer; display:none;" value="Save">
                  </form>
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
                    <span class="font-weight-bold"><?php echo $user['name'] ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Email Address</label>
                    <span class="font-weight-bold"><?php echo $user['email'] ?></span>
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
  <script>
    const fileUpload = document.getElementById('fileUpload');
    const previewImg = document.getElementById('previewImg');
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');

    fileUpload.addEventListener('change', function(e) {
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
          // Update preview image
          previewImg.src = event.target.result;

          // Hide edit button, show save button
          editBtn.style.display = 'none';
          saveBtn.style.display = 'flex';
        };

        reader.readAsDataURL(file);
      }
    });

    // Optional: Reset when you cancel or want to change again
    saveBtn.addEventListener('click', function(e) {
      // Your form submission logic here
      // e.preventDefault() if needed
    });
  </script>
  <!-- js  -->
</body>

</html>