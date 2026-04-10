<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . "/includes/head.php" ?>
<body>

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <header class="hero-section text-center">
        <div class="container" data-aos="fade-down">
            <h1 class="display-4 fw-bold">Welcome to Contact Page</h1>
            <p class="lead">Projukti ebong lifestyle niye protidin-er notun jante thakun.</p>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 overflow-hidden" data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" class="card-img-top" alt="post">
                    <div class="card-body p-4">
                        <span class="badge bg-soft-primary text-primary mb-2" style="background: #e0e7ff;">Technology</span>
                        <h2 class="h3">Web Design-er Shera 5-ti Tool</h2>
                        <p class="text-muted">2024-e web design ke aro shohoj korte nicher tool gulo apnar proyojon...</p>
                        <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Read More →</a>
                    </div>
                </div>

                <div class="card mb-4 overflow-hidden" data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97" class="card-img-top" alt="post">
                    <div class="card-body p-4">
                        <span class="badge bg-soft-success text-success mb-2" style="background: #dcfce7;">Programming</span>
                        <h2 class="h3">Python Keno Shekha Uchit?</h2>
                        <p class="text-muted">Data Science theke shuru kore Automation—Python-er proyojoniyota ekhon shobar upore...</p>
                        <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Read More →</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card p-4 mb-4" data-aos="fade-left">
                    <h5 class="widget-title">Categories</h5>
                    <div class="category-list">
                        <a href="#" class="category-link"><span>Web Design</span> <span class="badge bg-light text-dark">12</span></a>
                        <a href="#" class="category-link"><span>Gadgets</span> <span class="badge bg-light text-dark">8</span></a>
                        <a href="#" class="category-link"><span>Mobile Apps</span> <span class="badge bg-light text-dark">5</span></a>
                        <a href="#" class="category-link"><span>Lifestyle</span> <span class="badge bg-light text-dark">3</span></a>
                    </div>
                </div>

                <div class="card p-4 mb-4 sticky-top" style="top: 90px;" data-aos="fade-left">
                    <h5 class="widget-title">Recent Blogs</h5>
                    
                    <a href="#" class="recent-post-item">
                        <img src="https://picsum.photos/id/1/200" class="recent-post-img" alt="thumb">
                        <div>
                            <p class="recent-post-title">Mastering Bootstrap 5</p>
                            <span class="recent-post-date">Dec 28, 2024</span>
                        </div>
                    </a>

                    <a href="#" class="recent-post-item">
                        <img src="https://picsum.photos/id/2/200" class="recent-post-img" alt="thumb">
                        <div>
                            <p class="recent-post-title">AI Content Writing Tips</p>
                            <span class="recent-post-date">Dec 25, 2024</span>
                        </div>
                    </a>

                    <a href="#" class="recent-post-item">
                        <img src="https://picsum.photos/id/3/200" class="recent-post-img" alt="thumb">
                        <div>
                            <p class="recent-post-title">CSS Grid vs Flexbox</p>
                            <span class="recent-post-date">Dec 20, 2024</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ ."/includes/footer.php" ?>
    <?php require_once __DIR__ ."/includes/script.php"?>
    
</body>
</html>