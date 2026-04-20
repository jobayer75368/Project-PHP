<!DOCTYPE html>
<html lang="en">
 <!-- head  -->
  <?php require_once __DIR__ ."/includes/head.php" ?>
  <!-- head   -->
<body>

    <!-- navbar  -->
     <?php require_once __DIR__ ."/includes/navbar.php" ?>
     <!-- navbar  -->

    <div class="container py-5">
        <div class="row error">
            <div class="col-md-12 text-center">
                <h1>404 Error!</h1>
                <p>Sorry Something went wrong!</p>
                <a class="btn btn-info" href="/">Back To Homepage</a>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . "/includes/footer.php"?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>