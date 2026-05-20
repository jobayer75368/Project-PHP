<?php require_once __DIR__ . "/session.php";
require_once __DIR__ . "/includes/db_connection.php";


// For Blogs 
$sql = "SELECT blogs.*,
                COUNT(blogs.id) AS total_posts,
                COUNT(CASE WHEN status='pending' THEN 1 END) AS pending_posts
                FROM blogs";
$statement = $pdo->prepare($sql);
$statement->execute();
$blogs = $statement->fetch(PDO::FETCH_ASSOC);

// For Categories 
$categorySql = "SELECT categories.*,
                COUNT(categories.id) AS total_categories
                FROM categories";
$categoryStmt = $pdo->prepare($categorySql);
$categoryStmt->execute();
$categories = $categoryStmt->fetch(PDO::FETCH_ASSOC);

// For Counting Users 
$userSql = "SELECT users.*,
                COUNT(users.id) AS total_users
                FROM users";
$userStmt = $pdo->prepare($userSql);
$userStmt->execute();
$users = $userStmt->fetch(PDO::FETCH_ASSOC);

// For Activity 
$userId = $_SESSION['user_id'];

$activityStmt = $pdo->prepare("SELECT status FROM users WHERE id=?");
$activityStmt->execute([$userId]);
$activeUser = $activityStmt->fetch(PDO::FETCH_ASSOC);

// For Comments
$sql = "SELECT comments.*,
                COUNT(comments.id) AS total_comments,
                COUNT(CASE WHEN status='pending' THEN 1 END) AS pending_comments
                FROM comments";
$statement = $pdo->prepare($sql);
$statement->execute();
$comments = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "/includes/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    if ($activeUser['status'] == 'active') {
      require_once __DIR__ . "/includes/sidebar.php";
    }
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php require_once __DIR__ . "/includes/topbar.php" ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <?php if ($activeUser['status'] == 'inactive'): ?>
            <div class="container d-flex align-items-center justify-content-center vh-100">
              <h1>The Admin has restricted your Activity!</h1>
            </div>
          <?php else : ?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div>

            <div class="row mb-3">
              <!-- Total number of blogs-->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Number of Blogs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $blogs['total_posts'] ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                          <span>This month</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-blog text-primary fa-2x"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Earnings (Annual) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total number of Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $categories['total_categories'] ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                          <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                          <span>Since last years</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-layer-group fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- New User Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Number of Users</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $users['total_users'] ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                          <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                          <span>Since last month</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Blogs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $blogs['pending_posts'] ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                          <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                          <span>Since yesterday</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-blog text-warning fa-2x"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Total Comments -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Number of comments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $comments['total_comments'] ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-comments text-primary fa-2x"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Comments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $comments['pending_comments'] ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-comments text-warning fa-2x"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
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