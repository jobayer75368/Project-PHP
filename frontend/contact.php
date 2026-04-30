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
        <!-- Contact Info Cards -->
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

        <!-- Contact Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="card-title fw-bold mb-4">Send us a Message</h3>
                        
                        <form method="POST" action="">
                            <div class="mb-4">
                                <label for="name" class="form-label fw-500">Full Name</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-md" 
                                    id="name" 
                                    name="name"
                                    placeholder="Your Name"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-500">Email Address</label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-md" 
                                    id="email" 
                                    name="email"
                                    placeholder="your@email.com"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="subject" class="form-label fw-500">Subject</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-md" 
                                    id="subject" 
                                    name="subject"
                                    placeholder="What is this about?"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label fw-500">Message</label>
                                <textarea 
                                    class="form-control form-control-md" 
                                    id="message" 
                                    name="message"
                                    rows="6"
                                    placeholder="Your message here..."
                                    required
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                class="btn btn-primary btn-md w-100 fw-bold"
                                style="transition: all 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,123,255,0.3)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                            >
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
    
</body>
</html>