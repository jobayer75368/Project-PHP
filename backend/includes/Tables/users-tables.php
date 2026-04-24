<?php
require_once __DIR__ ."/../../session.php";

require_once __DIR__ . "/../db_connection.php";

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
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Users Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">

              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
                </div>

                <div class="table-responsive">
                  <table class="table align-items-center table-flush">

                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                          <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                              <span class="badge badge-success">
                                <?= $user['status'] ?>
                              </span>
                            </td>
                            <td>
                              <a href="#" class="btn btn-sm btn-primary">Detail</a>
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

                <div class="card-footer"></div>
              </div>

            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

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