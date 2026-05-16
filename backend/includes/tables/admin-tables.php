<?php require_once __DIR__ ."/../../session.php" ?>
<?php 

require_once __DIR__ . "/../db_connection.php";

try{
  $sql = "SELECT * FROM admins";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $admins = $statement->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e){
     echo "Error getting Data:".$sql."<br>".$e->getMessage();
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
            <h1 class="h3 mb-0 text-gray-800">Admins Table</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Admins Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Admins Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Admins Tables</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($admins as $admin): ?>
                      <tr>
                        <td> <?php echo $admin['id'] ?></td>
                        <td> <?php echo $admin['name'] ?></td>
                        <td> <?php echo $admin['email'] ?></td>
                        <td> <?php echo $admin['created_at' ]?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

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
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

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