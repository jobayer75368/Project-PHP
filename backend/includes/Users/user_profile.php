<?php

require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";




$id = $_SESSION['user_id'] ?? null;

// Upload Image
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_FILES['featured_image']['name'])) {

  $fileName = time() . "-" . $_FILES['featured_image']['name'];
  $targetPath = __DIR__ . "/../../uploads/" . $fileName;
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


$UserSql = "SELECT * FROM users WHERE id = :id";
$statement = $pdo->prepare($UserSql);
$statement->execute([
  ':id' => $id
]);

$user = $statement->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/../head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once __DIR__ . "/../sidebar.php" ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php require_once __DIR__ . "/../topbar.php" ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item">Profile</li>
            </ol>
          </div>

          <div class="container">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4 rounded-lg">
              <div class="card-body d-flex justify-content-between">

                <div class="d-flex align-items-center">

                  <img
                    id="previewImg"
                    src="<?= empty($user['featured_image']) ? '/frontend/assests/images/no-image.png' : BASE_URL . $user['featured_image']; ?>"
                    class="rounded-circle border border-dark"
                    width="150"
                    height="150">
                  <div class="ml-4">
                    <h4 class="font-weight-bold text-primary mb-1"><?php echo $user['name'] ?></h4>
                    <p class="text-muted mb-1"><?= ucfirst($user['role']) ?></p>
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
                      Upload<i class="fas fa-upload ml-1" style="font-size: 0.7rem;"></i>
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
                  <h5 class="font-weight-bold text-primary">Personal Information</h5>
                  <a href="/admin/user/profile/update?id=<?php echo $user['id']; ?>" class="btn btn-outline-secondary p-1 mr-1 btn-sm px-3">Edit <i class="fas fa-pen ml-1" style="font-size: 0.7rem;"></i></a>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Name</label>
                    <span class="font-weight-bold"><?php echo $user['name'] ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Email Address</label>
                    <span class="font-weight-bold"><?php echo $user['email'] ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">User Role</label>
                    <span class="font-weight-bold"><?= ucfirst($user['role']) ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block"><?= ucfirst($user['role']) ?> Since</label>
                    <span class="font-weight-bold"><?= date("d M Y", strtotime($user['created_at'])) ?></span>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="text-muted small d-block">Last Update</label>
                    <span class="font-weight-bold"><?= date("d M Y", strtotime($user['updated_at'])) ?></span>
                  </div>


                </div>
              </div>
            </div>

          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <?php require_once __DIR__ . "/../modal.php"  ?>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php require_once __DIR__ . "/../footer.php" ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js     -->
  <?php require_once __DIR__ . "/../script.php" ?>
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
    saveBtn.addEventListener('click', function(e) {});
  </script>
  <!-- js  -->
</body>

</html>