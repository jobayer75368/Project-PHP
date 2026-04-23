<?php require_once __DIR__ ."/session.php" ?>
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
        <?php require_once __DIR__ . "/includes/topbar.php"?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="text-center">
            <img src="/backend/assets/img/error.svg" style="max-height: 100px;" class="mb-3">
            <h3 class="text-gray-800 font-weight-bold">Oopss!</h3>
            <p class="lead text-gray-800 mx-auto">404 Page Not Found</p>
            <a href="dashboard.php">&larr; Back to Dashboard</a>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.php" class="btn btn-primary">LogOut</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>        

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php require_once __DIR__ ."/includes/footer.php" ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php require_once __DIR__ ."/includes/script.php" ?>

</body>

</html> 