<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../restrict.php";

// Current User data 
$id = $_SESSION['user_id'] ?? null;

$statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
$statement->execute([$id]);
$currentUser = $statement->fetch(PDO::FETCH_ASSOC);

// ALl users data 
try {
  $sql = "SELECT * FROM users";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error fetching users: " . $e->getMessage());
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
            <h1 class="h3 mb-0 text-gray-800">Users Table</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item">Users</li>
            </ol>
          </div>

          <div class="row ">
            <div class="col-lg-12 mb-4 ">

              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
                </div>
                <?php if ($currentUser['role'] !== 'admin'): ?>
                  <div class="table-responsive text-center">
                    <h2>Only Admin can access Users Table!</h2>
                  </div>
                <?php else : ?>
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">

                      <thead class="thead-light">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th>Joined Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php if (!empty($users)): ?>
                          <?php foreach ($users as $user): ?>
                            <tr>
                              <td><?= $user['id'] ?></td>
                              <td><span><img class="rounded-circle border border-dark mr-2"
                                    width="60"
                                    height="60" src=" <?= empty($user['featured_image']) ? '/frontend/assests/images/no-image.png' : BASE_URL . $user['featured_image']; ?>" alt=""></span>
                                <span> <?= $user['name'] ?></span>
                              </td>
                              <td><?= $user['email'] ?></td>
                              <td><?= $user['role'] ?></td>
                              <td>
                                <span class="badge <?= ($user['status'] == 'inactive') ? 'badge-danger' : 'badge-success'; ?> ">
                                  <?= $user['status'] == 'inactive' ? 'Inactive' : 'Active'; ?>
                                </span>
                              </td>
                              <td>
                                <?= date("d M Y", strtotime($user['created_at'])) ?>
                              </td>
                              <td>
                                <a href="/admin/users/edit?id=<?php echo $user['id']; ?>" class="btn btn-primary p-1 mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="/admin/user/delete?id=<?php echo $user['id'] ?>"
                                  onclick="return confirm('Are you sure you want to delete this User?')" class="btn btn-danger p-1"><i class="fa-solid fa-trash text-white"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="5" class="text-center">No users found</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>

                    </table>
                  </div>
                <?php endif; ?>
                <div class="card-footer"></div>
              </div>

            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
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