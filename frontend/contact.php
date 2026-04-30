<?php 
require_once __DIR__."/../backend/includes/db_connection.php";

$name = $email=$subject =$message="";
$error = [];
function sanitize(string $data){
    $data= trim(htmlspecialchars($data));
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $subject = sanitize($_POST["subject"]);
    $message = sanitize($_POST["message"]);

    if(empty($name)){
        $error["name"]="Your name is required";
    }
    if(empty($email)){
        $error["email"]= "Email is required!";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error["email"] = "Invalid Email address!";
    }
    if(empty($message)){
        $error["message"]="message is required";
    }

    if(empty($error)){
        $sql = "INSERT INTO contacts (name, email, subject, message)
                VALUES (:name, :email,:subject,:message)";
        $statement=$pdo->prepare($sql);
        $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
        echo "success";
        exit();
    } else {
        echo "error";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . "/includes/head.php" ?>
<body>

<?php require_once __DIR__ . "/includes/navbar.php" ?>

<header class="hero-section text-center">
    <div class="container" data-aos="fade-down">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead">Get in touch with us today</p>
    </div>
</header>

<div class="container my-5">
    <!-- Contact Info Cards (unchanged) -->
    <div class="row g-4 mb-5">
        <div class="col-md-4" data-aos="fade-up">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-telephone-fill text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="card-title">Phone</h5>
                    <p class="card-text text-muted">+880 1234-567890</p>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-envelope-fill text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="card-title">Email</h5>
                    <p class="card-text text-muted">info@example.com</p>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-geo-alt-fill text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="card-title">Location</h5>
                    <p class="card-text text-muted">Dhaka, Bangladesh</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    
                        <div class="alert alert-success" role="alert">
                            <?php echo isset($email)? "Message sent successfully!":""; ?>
                        </div>
                    <h3 class="card-title fw-bold mb-4">Send us a Message</h3>

                    <form id="contactForm">
                        <div class="mb-4">
                            <label class="form-label fw-500">Full Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" placeholder="Your Name">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-500">Email Address</label>
                            <input type="email" class="form-control form-control-sm" name="email" placeholder="your@email.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-500">Subject</label>
                            <input type="text" class="form-control form-control-sm" placeholder="What is this about?" name="subject">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-500">Message</label>
                            <textarea class="form-control form-control-sm" name="message" placeholder="Your message here..." rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md w-100 fw-bold">
                            Send Message
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ ."/includes/footer.php" ?>
<?php require_once __DIR__ ."/includes/script.php"?>

<!-- ✅ AJAX -->
<script>
document.getElementById("contactForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch(window.location.href, {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        if(data.trim() === "success"){
            document.getElementById("successMsg").style.display = "block";
            document.getElementById("contactForm").reset();
        }
    })
    .catch(err => console.log(err));
});
</script>

</body>
</html>