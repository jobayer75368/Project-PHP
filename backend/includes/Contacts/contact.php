<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../db_connection.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../restrict.php";
$contacts = [];
try {
  $sql = "SELECT * FROM contacts ORDER BY id DESC;";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $contacts = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error getting Data:" . $sql . "<br>" . $e->getMessage();
};
?>


<!DOCTYPE html>
<html lang="en">

<!-- head  -->
<?php require_once __DIR__ . "/../head.php" ?>
<!-- head  -->

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
            <h1 class="h3 mb-0 text-gray-800">Contacts Mange</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item">Contact List</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Contacts Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Contact list</h6>
                </div>
                <?php if ($_SESSION['user_id'] !== 1): ?>
                  <div class="table-responsive text-center">
                    <h2>Only Admin can access Contact List!</h2>
                  </div>
                <?php else: ?>
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Message</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($contacts as $contact): ?>
                          <tr>
                            <td> <?php echo $contact['id'] ?></td>
                            <td> <?php echo $contact['name'] ?></td>
                            <td> <?php echo $contact['email'] ?></td>
                            <td> <?php echo $contact['subject'] ?></td>
                            <td> <?php echo $contact['message'] ?></td>
                            <td><?= date("d M Y, h:i A", strtotime($contact['created_at'])) ?></td>
                            <td><a href="/admin/contacts/delete?id=<?php echo $contact['id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-danger p-1"><i class="fa-solid fa-trash text-white"></i></a></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <!-- modal  -->
          <?php require_once __DIR__ . "/../modal.php"  ?>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php require_once __DIR__ . "/../footer.php" ?>

      <!-- footer  -->
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php require_once __DIR__ . "/../script.php" ?>
</body>

</html>